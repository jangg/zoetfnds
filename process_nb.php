<?php
include_once ('config.php');
include_once('classes/c_person.php');
// process.php

global $nb_errors;  
global $nb_data;        
$nb_errors = array();  // array to hold validation errors
$nb_data = array();        // array to pass back data


function isOkNaam ($naam)
{
	global $nb_errors;
	$result = FALSE;
	if (empty($naam))
		{
			$nb_errors['naam'] = 'Naam is verplicht.';
		}
	  else
	  {
	// 	  	error_log($_POST['naam']);
			if (strlen($naam) < 4)
				$nb_errors['naam'] = 'Naam moet minimaal 4 letters bevatten.';
			else 
				$result = TRUE;
	  }	
	return $result;	
}

function isOkEmail ($email)
{
	global $nb_errors;
	$result = FALSE;
	if (empty($email))
		$nb_errors['emailadres'] = 'Emailadres is verplicht.';
	else
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL))
			$result = TRUE;
		else
			$nb_errors['emailadres'] = 'Emailadres is ongeldig.';

	}
	return $result;
}

function existEmailadres ($email)
{
	global $nb_errors;
	$result = TRUE;
	$person = new Person ('emailadres', $email);
	if ($person->id == NULL)
			$result = FALSE;
	return $result;
}

function addPerson ($naam, $email)
{
	$person = new Person ('emailadres', $email);
	$person->emailadres = $email;
	$person->volnaam = $naam;
	$person->nieuwsbrief = 'j';
	if ($person->id == NULL)
	{
		$person->saveToDB();		
	} else
	{
		$person->updateToDB();
	}

	
}

function sendEmail ($volnaam, $email)
{
	global $nb_data;
		
		$mail_body  = 'Beste ' . $volnaam . ' (' . $email . '),
		
	Hartelijk dank voor je aanmelding!
	
	Je hebt je aangemeld voor het ontvangen van de nieuwsbrief van Het Zoetermeerfonds.
	De nieuwsbrief verschijnt 1x per 3 maanden of, indien er aanleiding toe is, vaker.
	
	Indien je je wilt afmelden dan kun je een email sturen aan:
	
		nieuwsbrief@zoetermeerfonds.nl
		
	Met in het onderwerp:
	
		Afmelden nieuwsbrief
		
	Wij melden je dan af. Indien je dat wilt kun je je te allen tijde opnieuw abonneren.
	
	Namens Het Zoetermeerfonds
	
	Met vriendelijke groeten,
	
	Aafke Halma
	Secretaris
	
	';
	
		$Name = "Het Zoetermeerfonds"; //senders name
		$subject = 'Aanvraag Zoetermeerfonds nieuwsbrief'; //subject
		$header = "From: ". $Name . " <" . 'nieuwsbrief@zoetermeerfonds.nl' . ">\r\n"; //optional headerfields
		
		$result = mail($email, $subject, $mail_body, $header);
// 		$nb_data['message1'] = '1e mail goedverzonden!<br/>';
		$result = mail('nieuwsbrief@zoetermeerfonds.nl', $subject, $mail_body, $header); 
// 		$nb_data['message2'] = '2e mail goedverzonden!<br/>';
		$verstuurd = TRUE;
}

// return a response ==============

// response if there are errors

/*** 
	1. Test naam
	2. Test email
	--> Fout: Als fout gevonden dan terug
	3. Test of email bestaat of niet
	--> Fout: Als bestaat dan terug
	4. Voeg person toe
	--> Goed: terug met bevestiging
***/

// error_log($_POST['naam'] . '  ' . $_POST['emailadres']);

$nb_data['success'] = TRUE;

if (isOkNaam ($_POST['naam']) && isOkEmail ($_POST['emailadres']))
{
// 	error_log("Alles is ok!");
	
	if (!existEmailadres($_POST['emailadres']))
	{
// 		error_log("Emailadres bestaat niet dus toevoegen");

		/*** person toevoegen ***/
		addPerson ($_POST['naam'], $_POST['emailadres']);
		sendEmail ($_POST['naam'], $_POST['emailadres']);	
	}
	
// 	else error_log("Emailadres bestaat dus NIET toevoegen");
}
else
	$nb_data['success'] = FALSE;

// return all our data to an AJAX call
// error_log(json_encode($nb_data));
echo json_encode($nb_data);
?>