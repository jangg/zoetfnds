<?php

include_once ('config.php');
include_once ('classes/c_person.php');
include_once ('classes/c_person_gala.php');
/***************************************************************************/
function getInvitationHtml ()
{
	$html = file_get_contents('emails/invitationGala.html', TRUE);
/* 	$html = str_replace ('###emailadres###', $e, $html); */
//  	echo $html;
	return $html;
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

function init ()
{
	global $con;
	global $prodswitch;
	$prodswitch = 'test';
	$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
	$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$sql = "SELECT * FROM keytabel WHERE sleutel = 'invitation';";
	$stmt = $con->prepare( $sql );
	$stmt->execute();
	$rows = $stmt->fetchAll();
	if(!$rows) 
	{
		$prodswitch = 'test';
	}
	else
	{
		$prodswitch = $rows[0]['waarde'];
	}
	
	set_time_limit(900);
	
	echo '<br/>Start verzenden uitnodigingen<br/><br/>sleutel "invitation": waarde "' . $prodswitch . '"<br/><br/>';
}

function close ()
{
	echo '<br/>Einde verzenden uitnodigingen<br/><br/>';

}

function sendInvitation ()
{
	global $con;
	global $adrescat;
	try
	{
// 		$sql = "SELECT id, id_person, invitation, invitationSent FROM person_gala WHERE invitation = '" . $adrescat . "' AND invitationSent = 'n' AND reaction = 'n';";
		$sql = "SELECT id, id_person, invitation, invitationSent FROM person_gala WHERE invitation != '0' AND invitationSent = 'n' AND reaction = 'n';";
		$stmt = $con->prepare( $sql );
		$stmt->execute();
		$rows = $stmt->fetchAll();
		if(!$rows) 
		{
			error_log ('Hier gaat iets fout! Geen personen gevonden in de DB!');
			exit();
		}
		else
		{
			$invitation = getInvitationHtml();
			sendEmail('jangg@mac.com', $invitation, '169', 'Geachte meneer Geerdes, beste Jan,');
			foreach ($rows as $row)
			{
/* 				echo $row['emailadres'] . ' - ' . $row['invitation'] . '<br/>'; */
				$person = new Person ('id', $row['id_person']);
				if ($person->geslacht != 'v') $titel = 'meneer'; else $titel = 'mevrouw';
				$aanhef = 'Geachte ' . $titel . ' ' . $person->tussenvoegsel . ' ' . $person->achternaam . ', beste ' . $person->voornaam . ',';
								
				if (checkEmail($person->emailadres))
				{
/*
					if ($row['invitation'] == 'j')
					{
*/
						if ($row['invitationSent'] == 'j')
						{
							echo $aanhef . ' (' . $person->emailadres . ') heeft uitnodiging AL ONTVANGEN.!' . '<br/>';
						}
						else
						{
							$invitationp = str_replace ('###aanhef###', $aanhef, $invitation);

							sendEmail($person->emailadres, $invitationp, $row['id'], $aanhef);							
						}
/*
					}
					else
					{
						echo $person->emailadres . ' krijgt GEEN uitnodiging.!' . '<br/>';	
					}
*/
					
				}
				else 
				{
					echo $aanhef . '(' . $person->emailadres . ') is een foutief emailadres!' . '<br/>';	
				}
			}
		}
	}
	catch (PDOException $e) 
	{
		echo 'Connectie met de database mislukt: ' . $e->getMessage();
	}
	$con = null;
}

function sendEmail ($email, $invitation, $person_galaid, $aanhef)
{
	global $prodswitch;
	$Name = "Zoetermeerfonds"; //senders name
	$subject = 'Uitnodiging voor het Zoetermeerfonds Initiatieven Gala'; //subject
	$headers = "From: ". $Name . " <" . 'info@zoetermeerfonds.nl' . ">\r\n"; //optional headerfields
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$mail_body = $invitation;
	$result = FALSE;
//******************************************************************************************
//  
// Hieronder staat de beveiliging voor het testen. Wees voorzichtig met aanpassen.
// Voor je het weet verstuur je ongewild nieuwsbrieven naar de mensen uit de DB.
//  
//  
//******************************************************************************************

	if ($prodswitch == 'productie')
	{
	
//**********Regel hieronder is voor productie********************************************************************************
		$result = mail($email, $subject, $mail_body, $headers);
// 		$result = TRUE;	

		if($result) echo 'PRODUCTIE --- ' . $aanhef . ' (' . $email . ') heeft een uitnodiging ontvangen!' . '<br/>';
			else
			echo 'PRODUCTIE --- ' . $aanhef . ' (' . $email . ') heeft GEEN uitnodiging ontvangen! Fout bij verzenden.' . '<br/>';
//******************************************************************************************
		/* En nu persoon bijwerken: invitationSent wordt 'j' */
		$person_gala = new Person_gala ('id', $person_galaid);
		if ($person_gala->id != NULL)
		{
			$person_gala->invitationSent = 'j';
			$person_gala->updateToDB();			
		}
	}
	else
	{
		if ($email != 'jangg@mac.com')
		{
			echo 'TEST --- ' . $aanhef . ' (' . $email . ') heeft een uitnodiging ontvangen! (Maar niet echt!)' . '<br/>';
		}
		else 
		{
			$result = mail($email, $subject, $mail_body, $headers);
			$result = TRUE;	
			if($result) echo 'TEST --- ' . $aanhef . ' (' . $email . ') heeft een uitnodiging ontvangen!' . '<br/>';
			else
			echo 'TEST --- ' . $aanhef . ' (' . $email . ') heeft GEEN uitnodiging ontvangen! Fout bij verzenden.' . '<br/>';

		}
	}
//******************************************************************************************
	
}

//******************************************************************************************
// 1. Init
// 1.1 Haal emailtekst op
// 2. Lees tabel persoon, check of e-mail geldig is en nwbrf ind op 'j' staat.
// 3. Stuur invitation naar email
// 4. Afsluiting
//******************************************************************************************

if (isset($_POST['switch']) && $_POST['switch'] == 'j')
{
	global $adrescat;
	$adrescat = '4';
	
	init ();
	
	sendInvitation ();
	
	close ();
	
	unset($_POST['switch']);
	header('Location: sendInvitation.php');
}

?>
<!DOCTYPE html>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Uitnodiging versturen</title>
<meta name="description" content="" />
</head>
<body>
	
    <form  method="POST" action="sendInvitation.php" novalidate>
	<p>Uitnodigingen worden verstuurd naar adressen in de database.</p>
    <button id="knop" type="submit" name="switch" value="j">
   Verstuur
    </button>						
</body>
</html>