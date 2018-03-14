<?php
include_once ('config.php');
include_once('classes/c_organisatie.php');
include_once('classes/c_person.php');
include_once('classes/c_aanvraag.php');

function checkBot ($response) {
	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$data = array(
		'secret' => '6LfFvy0UAAAAADBwDHFGqGdDIVFc6TxFXJopBc1K',
		'response' => $_POST["g-recaptcha-response"]
	);
	$options = array(
		'http' => array (
			'method' => 'POST',
			'content' => http_build_query($data)
		)
	);
	$context  = stream_context_create($options);
	$verify = file_get_contents($url, false, $context);
	$captcha_success=json_decode($verify);
	if ($captcha_success->success==false) {
		return TRUE;
// 		echo "<p>You are a bot! Go away!</p>";
	} else if ($captcha_success->success==true) {
		return FALSE;
// 		echo "<p>You are not not a bot!</p>";
	}
}


function existEmailadres ($email)
{
	global $av_errors;
	$result = FALSE;
	$person = new Person ('emailadres', $email);
	if ($person->id != NULL)
		{
			$result = TRUE;
			$av_errors['emailadres'] = 'Emailadres is al bekend.';
		}
	return $result;
}

function addPerson ($naam, $email, $adres, $postcode, $woonplaats, $telnr, $reknr, $nieuwsbrief)
{
	$person = new Person ('emailadres', $email);
	$person->emailadres = $email;
	$person->volnaam = $naam;
	$person->adres = $adres;
	$person->postcode = $postcode;
	$person->woonplaats = $woonplaats;
	if ($telnr != '')
		$person->telnr = $telnr;
	if ($reknr != '')
		$person->reknr = $reknr;
	$person->aanvraag = 'j';
	if ($nieuwsbrief == 'j')
		$person->nieuwsbrief = 'j';
	if ($person->id == NULL)
	{
		$person->saveToDB();		
	} 
	else
	{
		$person->updateToDB();
	}
	return $person;
	
}

function addOrganisatie ($naam, $adres, $postcode, $plaats, $telnr, $email, $rechtsvorm, $kvknummer, $urlwebsite, $reknr)
{
	$organisatie = new Organisatie ();
	$organisatie->emailadres = $email;
	$organisatie->naam = $naam;
	$organisatie->adres = $adres;
	$organisatie->postcode = $postcode;
	$organisatie->plaats = $plaats;
	$organisatie->rechtsvorm = $rechtsvorm;
	$organisatie->kvknummer = $kvknummer;
	$organisatie->urlwebsite = $urlwebsite;
	$organisatie->telnr = $telnr;
	$organisatie->reknr = $reknr;
	if ($organisatie->id == NULL)
	{
		$organisatie->saveToDB();		
	} 
	else
	{
		$organisatie->updateToDB();
	}
	return $organisatie;
	
}

function addAanvraag ($personid, $organisatieid, $wat, $voorwie, $waarom, $metwie, $wanneer, $hoe, $kosten, $bijdrage, $file1, $file2, $file3)
{
	$aanvraag = new Aanvraag();
	$aanvraag->id_aanvrager 	= $personid;
	$aanvraag->id_organisatie 	= $organisatieid;
	$aanvraag->wat				= $wat;
	$aanvraag->voorwie		 	= $voorwie;
	$aanvraag->waarom		  	= $waarom;
	$aanvraag->metwie		  	= $metwie;
	$aanvraag->wanneer		 	= $wanneer;
	$aanvraag->hoe			 	= $hoe;
	$aanvraag->kosten		  	= $kosten;
	$aanvraag->bijdrage	  		= $bijdrage;
	$aanvraag->bedragbijdrage 	= 0;
	$aanvraag->file1 			= $file1;
	$aanvraag->file2 			= $file2;
	$aanvraag->file3 			= $file3;
	
	$aanvraag->saveToDB();
	return $aanvraag;
}

function sendEmail ($person, $aanvraag)
{
	global $av_data;
		
		$mail_body  = 'Beste ' . $person->volnaam . ' (' . $person->emailadres . '),
		
Je aanvraag voor een bijdrage van het Zoetermeerfonds voor je initiatief is ingediend.

De volgende stap is dat het bestuur van de stichting Zoetermeerfonds je ingediende verzoek
gaat beoordelen, inclusief de bijgevoegde documenten.

Mochten daarbij vragen rijzen dan zullen wij deze binnenkort aan je stellen. Ook een uitnodiging tot een persoonlijk gesprek
voor nadere toelichting behoort tot de mogelijkheden.

In de regel krijg je uiterlijk binnen 5 weken na indiening een eerste reactie van het bestuur op je aanvraag.

 	
Namens Het Zoetermeerfonds

Met vriendelijke groeten,

Aafke Halma
Secretaris
------------------------------------------------------------------------------------------------------------------------------------
	
	
Je hebt de volgende aanvraag ingediend:
	
WAT
' . $aanvraag->wat . '  
	
------------------------------------------------------------------------------------------------------------------------------------
VOOR WIE
' . $aanvraag->voorwie . '
	
------------------------------------------------------------------------------------------------------------------------------------
WAAROM
' . $aanvraag->waarom . '

------------------------------------------------------------------------------------------------------------------------------------
MET WIE
' . $aanvraag->metwie . '
	
------------------------------------------------------------------------------------------------------------------------------------
WANNEER
' . $aanvraag->wanneer . '

------------------------------------------------------------------------------------------------------------------------------------
HOE
' . $aanvraag->hoe . '

------------------------------------------------------------------------------------------------------------------------------------
KOSTEN
' . $aanvraag->kosten . '

------------------------------------------------------------------------------------------------------------------------------------
BIJDRAGE
' . $aanvraag->bijdrage . '
	
------------------------------------------------------------------------------------------------------------------------------------
De volgende bestanden werden meegestuurd:
	
	' . $aanvraag->file1 . '
	' . $aanvraag->file2 . '
	' . $aanvraag->file3;
	
		$Name = "Het Zoetermeerfonds"; //senders name
		$subject = 'Aanvraag bijdrage Zoetermeerfonds'; //subject
		$header = "From: ". $Name . " <" . 'secretaris@zoetermeerfonds.nl' . ">\r\n"; //optional headerfields
		
		$result = mail($person->emailadres, $subject, $mail_body, $header);
// 		$av_data['message1'] = '1e mail goedverzonden!<br/>';
		$result = mail('aanvraag@zoetermeerfonds.nl', $subject, $mail_body, $header); 
// 		$av_data['message2'] = '2e mail goedverzonden!<br/>';
		$verstuurd = TRUE;
}

$response = $_POST['g-recaptcha-response'];
if (checkBot($response) == TRUE) {
//  	echo 'Het is een robot!!!!!!';
	
	$_SESSION['result_aanvraag'] = 'failure';	
	header ('location: aanvform.php#successmessage');
	exit();
}
//  	echo 'Het is GEEN robot!!!!!!';

$av_result = FALSE;
$av_errors = array();


$naam								= $_POST['naam'];
$emailadres							= strtolower($_POST['emailadres']);
$adres 								= $_POST['adres'];
$postcode							= $_POST['postcode'];
$woonplaats							= $_POST['woonplaats'];
$telnr								= $_POST['telnr'];
$reknr								= $_POST['reknr'];
$wat		   						= $_POST['wat'];
$voorwie	   						= $_POST['voorwie'];
$waarom		   						= $_POST['waarom'];
$metwie		   						= $_POST['metwie'];
$wanneer	   						= $_POST['wanneer'];
$hoe		   						= $_POST['hoe'];
$kosten		   						= $_POST['kosten'];
$bijdrage	   						= $_POST['bijdrage'];
$bedragbijdrage						= 0;
$file1								= '';
$file2								= '';
$file3								= '';
if (isset($_POST['nbcb']))
	$nieuwsbrief					= 'j';
	else
	$nieuwsbrief					= 'n';
	

if (isset($_FILES['file1']['name'])) {
	$file1 = $_FILES['file1']['name'];
	if (!is_dir("uploads/" . $emailadres)) 
	{
		mkdir("uploads/" . $emailadres);
	}
	move_uploaded_file($_FILES['file1']['tmp_name'], "uploads/" . $emailadres . "/" . $file1);
}	

if (isset($_FILES['file2']['name'])) {
	$file2 = $_FILES['file2']['name'];
	if (!is_dir("uploads/" . $emailadres)) 
	{
		mkdir("uploads/" . $emailadres);
	}
	move_uploaded_file($_FILES['file2']['tmp_name'], "uploads/" . $emailadres . "/" . $file2);
}

if (isset($_FILES['file3']['name'])) {
	$file3 = $_FILES['file3']['name'];
	if (!is_dir("uploads/" . $emailadres)) 
	{
		mkdir("uploads/" . $emailadres);
	}
	move_uploaded_file($_FILES['file3']['tmp_name'], "uploads/" . $emailadres . "/" . $file3);
}

$orgnaam				= $_POST['orgnaam'];
$orgadres				= $_POST['orgadres'];
$orgpostcode			= $_POST['orgpostcode'];
$orgwoonplaats			= $_POST['orgwoonplaats'];
$orgrechtsvorm			= $_POST['orgrechtsvorm'];
$orgemailadres			= strtolower($_POST['orgemailadres']);
$orgkvknummer			= $_POST['orgkvknummer'];
$orgurlwebsite			= $_POST['orgurlwebsite'];
$orgtelnr				= $_POST['orgtelnr'];
$orgreknr				= $_POST['orgreknr'];

/*** person, aanvraag en evt. organisatie toevoegen ***/
$person = addPerson ($naam, $emailadres, $adres, $postcode, $woonplaats, $telnr, $reknr, $nieuwsbrief);
if ($orgnaam != '') 
{
	$organisatie = addOrganisatie ($orgnaam, $orgadres, $orgpostcode, $orgwoonplaats, $orgtelnr, $orgemailadres, $orgrechtsvorm, $orgkvknummer, $orgurlwebsite, $orgreknr);
	$orgid = $organisatie->id;
}
else
{
	$orgid = NULL;
}
$aanvraag = addAanvraag ($person->id, $orgid, $wat, $voorwie, $waarom, $metwie, $wanneer, $hoe, $kosten, $bijdrage, $file1, $file2, $file3);

sendEmail ($person, $aanvraag);
$_SESSION['result_aanvraag'] = 'success';

header ('location: aanvform.php#successmessage');
?>