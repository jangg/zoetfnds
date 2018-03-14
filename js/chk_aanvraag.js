function EnableButton (e) {
	if (e === 0x0000) 
			$("#knop").prop( "disabled", false );
			else $("#knop").prop( "disabled", true );
	
}

function IsPostcode(postcode) {
  var filter = /^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i;
  if (filter.test(postcode))
	return true;
	else
	return false;
}

function IsEmail(email) {
  var filter = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})$/;
  if (filter.test(email))
	return true;
	else
	return false;
}

function IsTelnr(telnr) {
  var filter = /^([0-9]{10})$/;
  var result = true;
/*
  if (telnr !== '')
  {
	  result = (filter.test(telnr));
  }
*/
  result = (filter.test(telnr));
  return result;
}

function IsOkFile (file) {
	var ok = true;
	var filename = file.name;
	var filetype = filename.substr(filename.lastIndexOf('.')+1);

//  	alert (filename + '<>' + file.size + '<>' + filetype);

	if (filetype === 'pdf' || filetype === 'doc'  || filetype === 'docx' || filetype === 'xls'|| filetype === 'xlsx' || filetype === 'txt' || filetype === 'rtf')
		ok = true;
		else ok = false;
	if (file.size > 5242880)
		ok = false;
	return ok;
}

$("document").ready(function() {

/* initiele waarde van error moet zijn:
	bit = 0: waarde is goed
	bit = 1: waarde is fout

	|||| ||--------------- niet gebruikt
	|||| |||-------------- orgnaam
	|||| ||||------------- fileupload3
	|||| |||| |----------- fileupload2
	|||| |||| ||---------- fileupload1
	|||| |||| |||--------- emailadres
	|||| |||| ||||-------- telnr
	|||| |||| |||| |------ woonplaats
	|||| |||| |||| ||----- postcode
	|||| |||| |||| |||---- adres
	|||| |||| |||| ||||--- naam
    0000 0000 0011 1111 ofwel 0x003F
    
    Als orgcb wordt aangevinkt, dan is ook orgnaam verplicht
*/
		
	var errors = 0x003F;

	$("#orgcb").bind("click", function (){
		if ($('#orgcb').is(':checked')) {
				$('#orginfo').slideDown();
				errors = errors | 0x0200;
			} else {
				$('#orginfo').slideUp();
				errors = errors & ~0x0200;
				/* alle org velden leegmaken */
				$("#orgnaam").val("");
				$("#orgadres").val("");
				$("#orgpostcode").val("");
				$("#orgwoonplaats").val("");
				$("#orgtelnr").val("");
				$("#orgemailadres").val("");
				$("#orgkvknummer").val("");
				$("#orgurlwebsite").val("");
				$("#orgreknr").val("");
				$("#orgrechtsvorm").val("");
			}
		if (errors === 0x0000) 
				$("#knop").prop( "disabled", false );
				else $("#knop").prop( "disabled", true );
		});
			
	$("#clear1").click(function(event){
		event.preventDefault();
		$("#fileToUpload1").replaceWith('<input type="file" class="form-control fileUpload" name="file1" id="fileToUpload1">');
		errors = errors & ~0x0040;
		if (errors === 0x0000) 
				$("#knop").prop( "disabled", false );
				else $("#knop").prop( "disabled", true );
	});
	$("#clear2").click(function(event){
		event.preventDefault();
		$("#fileToUpload2").replaceWith('<input type="file" class="form-control fileUpload" name="file2" id="fileToUpload2">');
		errors = errors & ~0x0080;
		if (errors === 0x0000) 
				$("#knop").prop( "disabled", false );
				else $("#knop").prop( "disabled", true );
	});
	$("#clear3").click(function(event){
		event.preventDefault();
		$("#fileToUpload3").replaceWith('<input type="file" class="form-control fileUpload" name="file3" id="fileToUpload3">');
		errors = errors & ~0x0100;
		if (errors === 0x0000) 
				$("#knop").prop( "disabled", false );
				else $("#knop").prop( "disabled", true );
	});
	
	$("#naam").bind("focus", function (){$("#naam").css("background-color", "white")});
	$("#adres").bind("focus", function (){$("#adres").css("background-color", "white")});
	$("#postcode").bind("focus", function (){$("#postcode").css("background-color", "white")});
	$("#woonplaats").bind("focus", function (){$("#woonplaats").css("background-color", "white")});
	$("#telnr").bind("focus", function (){$("#telnr").css("background-color", "white")});
	$("#emailadres").bind("focus", function (){$("#emailadres").css("background-color", "white")});
	$("#fileToUpload1").bind("focus", function (){$("#fileToUpload1").css("background-color", "white")});
	$("#fileToUpload2").bind("focus", function (){$("#fileToUpload2").css("background-color", "white")});
	$("#fileToUpload3").bind("focus", function (){$("#fileToUpload3").css("background-color", "white")});

	$("#orgnaam").bind("focus", function (){$("#orgnaam").css("background-color", "white")});
	$("#orgadres").bind("focus", function (){$("#orgadres").css("background-color", "white")});
	$("#orgpostcode").bind("focus", function (){$("#porgostcode").css("background-color", "white")});
	$("#orgwoonplaats").bind("focus", function (){$("#orgwoonplaats").css("background-color", "white")});
	$("#orgtelnr").bind("focus", function (){$("#orgtelnr").css("background-color", "white")});
	$("#orgemailadres").bind("focus", function (){$("#orgemailadres").css("background-color", "white")});
	$("#orgkvknummer").bind("focus", function (){$("#orgkvknummer").css("background-color", "white")});
	$("#orgurlwebsite").bind("focus", function (){$("#orgurlwebsite").css("background-color", "white")});

	
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
	$("#adres").bind("blur", function (){
		if ($("#adres").val().length < 5) {
			$("#adres").css("background-color", "#FFBBBB");
			errors = errors | 0x0002;
			}
			else errors = errors & ~0x0002;
		if (errors === 0x0000) 
				$("#knop").prop( "disabled", false );
				else $("#knop").prop( "disabled", true );
		});

	$("#postcode").bind("blur", function (){
		if (!IsPostcode($("#postcode").val())) {
			$("#postcode").css("background-color", "#FFBBBB");
			errors = errors | 0x0004;
			}
			else errors = errors & ~0x0004;
		if (errors === 0x0000) 
				$("#knop").prop( "disabled", false );
				else $("#knop").prop( "disabled", true );
		});

	$("#woonplaats").bind("blur", function (){
		if ($("#woonplaats").val().length < 5) {
			$("#woonplaats").css("background-color", "#FFBBBB");
			errors = errors | 0x0008;
			}
			else errors = errors & ~0x0008;
		if (errors === 0x0000) 
				$("#knop").prop( "disabled", false );
				else $("#knop").prop( "disabled", true );
		});


	$("#telnr").bind("blur", function (){
		if (!IsTelnr($("#telnr").val())) {
			$("#telnr").css("background-color", "#FFBBBB");
			errors = errors | 0x0010;
			}
			else errors = errors & ~0x0010;
		if (errors === 0x0000) 
				$("#knop").prop( "disabled", false );
				else $("#knop").prop( "disabled", true );
		});

	$("#emailadres").bind("blur", function (){
		if (!IsEmail($("#emailadres").val())) {
			$("#emailadres").css("background-color", "#FFBBBB");
			errors = errors | 0x0020;
			}
			else errors = errors & ~0x0020;
		if (errors === 0x0000) 
				$("#knop").prop( "disabled", false );
				else $("#knop").prop( "disabled", true );
		});

// 	if ($('#orgcb').is(':checked')) {
		$("#orgnaam").bind("blur", function (){
			if ($("#orgnaam").val().length < 5) {
				$("#orgnaam").css("background-color", "#FFBBBB");
				errors = errors | 0x0200;
				}
				else errors = errors & ~0x0200;
			if (errors === 0x0000) 
				$("#knop").prop( "disabled", false );
				else $("#knop").prop( "disabled", true );				
			});
// 		}


    $('#fileToUpload1').change(function() {
        var file = $("#fileToUpload1")[0].files[0];
		if (file !== '' && !IsOkFile(file)) {        
			$("#fileToUpload1").css("background-color", "#FFBBBB");
			errors = errors | 0x0040;
			}
			else {
			$("#fileToUpload1").css("background-color", "#FFFFFF");
			errors = errors & ~0x0040;
			}
		if (errors === 0x0000) 
				$("#knop").prop( "disabled", false );
				else $("#knop").prop( "disabled", true );
		});
    $('#fileToUpload2').change(function() {
        var file = $('#fileToUpload2')[0].files[0];
		if (file !== '' && !IsOkFile(file)) {        
			$("#fileToUpload2").css("background-color", "#FFBBBB");
			errors = errors | 0x0080;
			}
			else {
			$("#fileToUpload2").css("background-color", "#FFFFFF");
			errors = errors & ~0x0080;
			}
		if (errors === 0x0000) 
				$("#knop").prop( "disabled", false );
				else $("#knop").prop( "disabled", true );
		});
    $('#fileToUpload3').change(function() {
        var file = $('#fileToUpload3')[0].files[0];
		if (file !== '' && !IsOkFile(file)) {       
			$("#fileToUpload3").css("background-color", "#FFBBBB");
			errors = errors | 0x0100;
			}
			else {
			$("#fileToUpload3").css("background-color", "#FFFFFF");
			errors = errors & ~0x0100;
			}
		if (errors === 0x0000) 
				$("#knop").prop( "disabled", false );
				else $("#knop").prop( "disabled", true );
		});
			

});
