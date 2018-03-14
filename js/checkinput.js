<script>
$("document").ready(function() {

	$("#email").bind("focus", clearError);
	$("#email").bind("blur", testEmail);

});

function clearError ()
{
	$("#check1").css("visibility", "hidden");
}
function testEmail ()
{
	var emailadres = $("#email").val();
	var gebruikersnaam = "";
//	alert (emailadres);
	/* 
	Het emailadres is wel of niet ingevuld:
	1. Niet ingevuld: altijd fout!
	2. Wel ingevuld:
		1. Het is een ongeldig emailadres: altijd fout!
		2. Het is een geldig emailadres:
			1. Het emailadres komt niet voor in tabel Persoon: nieuwe gebruiker, gebruikersnaam laten invullen.
			2. Het emailadres komt wel voor in tabel Persoon:
				1. Er is geen gebruikersnaam beschikbaar: nieuwe gebruiker voor berichten, gebruikersnaam laten invullen
				2. Er is wel een gebruikersnaam beschikbaar: 
					1. Approved = FALSE: nieuwe gebruiker maar gebruikersnaam invullen
					2. Approved = TRUE: bestaande gebruiker en gebruikersnaam invullen
	*/
					
	if (emailadres === "")
	{
		fout();
	}
	else
	{
		if (!IsEmail(emailadres))
		{
			fout();
		}
		else
		{
			getGebruikersnaam (emailadres);
		}
	}
}

function getGebruikersnaam (email) {
$.ajax({
	type: "GET",
	url: "plaats.php?email=" + email,
	success: invullen
	});
}	

function invullen(data, status) 
{
	var gebruikersnaam = data;
	if (gebruikersnaam != "")
	{
		$("#gebruikersnaam").val(gebruikersnaam);
		$("#titel").focus();
	}
	goed();
}

function IsEmail(email) {
  var filter = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  if (filter.test(email))
	return true;
	else
return false;
}

function goed ()
{
	$("#checksymbol").attr("src", "images/good.png");
	$("#check1").css("visibility", "visible");
}

function fout ()
{
	$("#checksymbol").attr("src", "images/wrong.png");
	$("#check1").css("visibility", "visible");
}
</script>