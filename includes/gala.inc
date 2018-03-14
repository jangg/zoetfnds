<?php
include_once ('config.php');
include_once('classes/c_person.php');
include_once('classes/c_gala.php');
include_once('classes/c_person_gala.php');
/***************************************************************************/

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

function checkNaam ($a)
{
	$result = FALSE;
	if (strlen($a) > 2)
	{
		$result = TRUE;
	}
	return $result;
}

function checkEmail ($a)
{
	$result = FALSE;
	if (filter_var($a, FILTER_VALIDATE_EMAIL))
	{
		$result = TRUE;
	}
	return $result;
}

function checkOrganisatie ($a)
{
	$result = FALSE;
	if (strlen($a) > 3)
	{
		$result = TRUE;
	}
	return $result;
}

function setDeelnemer ($naam, $email, $organisatie)
{
	$person = new Person ('emailadres', $email);
	$deelnemer = new Gala (NULL);
	$deelnemer->naam = $naam;
	$deelnemer->email = $email;
	$deelnemer->id_person = $person->id;
	$deelnemer->organisatie = $organisatie;
	$deelnemer->saveToDB();		

	$person_gala = new Person_gala ('emailadres', $email);
	if ($person_gala->id != NULL)
	{
		$person_gala->reaction = 'j';
		$person_gala->updateToDB();		
	}	

}

function sendEmail ($naam, $email, $organisatie)
{
	global $verstuurd;
	
	$mail_body  = 'Beste ' . $naam . ' (' . $email . ') van ' . $organisatie . ',
	
Hartelijk dank voor je aanmelding voor deelname aan het Initiatieven Gala!
De bijeenkomst wordt gehouden op vrijdag 6 oktober 2017 en vindt plaats in

Brood & Rozen
Industrieweg 8
Zoetermeer
(Gelegen achter de bakkerij van Jongerius)

Aanvang van de avond is 18:45 uur, vanaf 18:00 uur kun je alvast terecht
voor soep en een broodje.

Wij verheugen ons op je deelname!


Namens Het Zoetermeerfonds

Met vriendelijke groeten,

Edith Snoeij, voorzitter
en
Jan Geerdes, initiatievenmakelaar

PS: Als je je aanmelding onverhoopt wilt intrekken, stuur dan een email naar 
info@zoetermeerfonds.nl met je naam en de melding "Ik kom toch niet.". Doe dit
uiterlijk vóór 3 oktober 2017. Je begrijpt dat we graag willen weten met hoeveel 
deelnemers we rekening moeten houden!

';

	$Name = "Zoetermeerfonds"; //senders name
	$subject = 'Aanmelding Zoetermeerfonds Initiatieven Gala'; //subject
	$header = "From: ". $Name . " <" . 'info@zoetermeerfonds.nl' . ">\r\n"; //optional headerfields
	
	$result = mail($email, $subject, $mail_body, $header);
//	if($result) echo '1e mail goedverzonden!<br/>';
	$result = mail('jan@zoetermeerfonds.nl', $subject, $mail_body, $header); 
//	if($result) echo '2e mail goedverzonden!<br/>';
	$verstuurd = TRUE;
}
?>