function IsEmail(email) {
  var filter = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})$/;
  if (filter.test(email))
	return true;
	else
	return false;
}


$('#messages').hide();

$('#nb_button').click( function() {
	var naam = $('input[name="naam"]');
	var email = $('input[name="emailadres"]');

	naam.next('p').text('');
	email.next('p').text('');
	var fout = 0;

	if (naam.val().length < 3) {
		naam.next('p').text('Naam invullen aub');
		fout++;
	}
	if (IsEmail (email.val()) === false) {
		email.next('p').text('Een geldig emailadres invullen aub');
		fout++;
	}

	if (fout === 0) {
		$.ajax({
			type: 'POST',
			url: 'process_nb.php',
			dataType: 'json',
			data: { 
				'naam': naam.val(),
				'emailadres': email.val(), 
			},
			success: function(data) {
				if (data.success)
							naam.val('');
							email.val('');
							$('#messages').slideDown();
			},
			error: function() {
				alert ('Bah, alles ging fout!');
				naam.next('p').text('Er heeft zich een fout voorgedaan bij het verwerken van je emailadres. Probeer het later nog eens ajb.');
			}
		});
	}
});
		
