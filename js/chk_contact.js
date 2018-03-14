function IsEmail(email) {
  var filter = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})$/;
  if (filter.test(email))
	return true;
	else
	return false;
}

function IsTelnr(telnr) {
  var filter = /^([0-9]{10})$/;
  if (filter.test(telnr))
	return true;
	else
	return false;
}


$("document").ready(function() {
	
	var errors = 0x000F;
	$("#knop").prop( "disabled", true );
	
	$("#naam").bind("focus", function (){$("#naam").css("background-color", "white")});
	$("#emailadres").bind("focus", function (){$("#emailadres").css("background-color", "white")});
	$("#telnr").bind("focus", function (){$("#telnr").css("background-color", "white")});
	$("#tekst").bind("focus", function (){$("#tekst").css("background-color", "white")});
	
	$("#naam").bind("blur", function (){
		if ($("#naam").val().length < 5) {
			$("#naam").css("background-color", "#FFBBBB");
			errors = errors | 0x0001;
			}
			else errors = errors & ~0x0001;
		if (errors === 0x0000) 
				$("#knop").prop( "disabled", false );
				else $("#knop").prop( "disabled", true );
				
		});

	$("#emailadres").bind("blur", function (){
		if (!IsEmail($("#emailadres").val())) {
			$("#emailadres").css("background-color", "#FFBBBB");
			errors = errors | 0x0002;
			}
			else errors = errors & ~0x0002;
		if (errors === 0x0000) 
				$("#knop").prop( "disabled", false );
				else $("#knop").prop( "disabled", true );
		});

	$("#telnr").bind("blur", function (){
		if (!IsTelnr($("#telnr").val())) {
			$("#telnr").css("background-color", "#FFBBBB");
			errors = errors | 0x0004;
			}
			else errors = errors & ~0x0004;
		if (errors === 0x0000) 
				$("#knop").prop( "disabled", false );
				else $("#knop").prop( "disabled", true );
		});

	$("#tekst").bind("blur", function (){
		if ($("#tekst").val().length < 10) {
			$("#tekst").css("background-color", "#FFBBBB");
			errors = errors | 0x0008;
			}
			else errors = errors & ~0x0008;
		if (errors === 0x0000) 
				$("#knop").prop( "disabled", false );
				else $("#knop").prop( "disabled", true );
		});
			
});
