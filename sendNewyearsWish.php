<?php

include_once ('config.php');
include_once ('classes/c_person.php');
/***************************************************************************/
function getNbHtml ()
{
	$html = file_get_contents('emails/nieuwjaarswens.html', TRUE);
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
	$sql = "SELECT * FROM keytabel WHERE sleutel = 'nieuwsbrief';";
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
	
	echo '<br/>Start verzenden Nieuwjaarswensen<br/><br/>sleutel "nieuwsbrief": waarde "' . $prodswitch . '"<br/><br/>';
}

function close ()
{
	echo '<br/>Einde verzenden Nieuwjaarswensen<br/><br/>';

}

function sendNieuwsbrief ()
{
	global $con;
	try
	{
		$sql = "SELECT id, emailadres, nieuwsbrief, nieuwsbriefSent FROM person;";
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
			$nieuwsbrief = getNbHtml();
			sendEmail('jangg@mac.com', $nieuwsbrief, '0');
			foreach ($rows as $row)
			{
/* 				echo $row['emailadres'] . ' - ' . $row['nieuwsbrief'] . '<br/>'; */				
				if (checkEmail($row['emailadres']))
				{
					if ($row['nieuwsbrief'] == 'j')
					{
						if ($row['nieuwsbriefSent'] == 'j')
						{
							echo $row['emailadres'] . ' heeft Nieuwjaarswens AL ONTVANGEN.!' . '<br/>';
						}
						else
						{
							sendEmail($row['emailadres'], $nieuwsbrief, $row['id']);							
						}
					}
					else
					{
						echo $row['emailadres'] . ' krijgt GEEN Nieuwjaarswens.!' . '<br/>';	
					}
					
				}
				else 
				{
					echo $row['emailadres'] . ' is een foutief emailadres!' . '<br/>';	
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

function sendEmail ($email, $nieuwsbrief, $personid)
{
	global $prodswitch;
	$Name = "Zoetermeerfonds"; //senders name
	$subject = 'Zoetermeerfonds Nieuwjaarswens'; //subject
	$headers = "From: ". $Name . " <" . 'info@zoetermeerfonds.nl' . ">\r\n"; //optional headerfields
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$mail_body = $nieuwsbrief;
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

		if($result) echo 'PRODUCTIE --- ' . $email . ' heeft een Nieuwjaarswens ontvangen!' . '<br/>';
			else
			echo 'PRODUCTIE --- ' . $email . ' heeft GEEN Nieuwjaarswens ontvangen! Fout bij verzenden.' . '<br/>';
//******************************************************************************************
		/* En nu persoon bijwerken: nieuwsbriefSent wordt 'j' */
		$persoon = new Person ('id', $personid);
		if ($persoon->id != NULL)
		{
			$persoon->nieuwsbriefSent = 'j';
			$persoon->updateToDB();			
		}
	}
	else
	{
		if ($email != 'jangg@mac.com')
		{
			echo 'TEST --- ' . $email . ' heeft een Nieuwjaarswens ontvangen! (Maar niet echt!)' . '<br/>';
		}
		else 
		{
			$result = mail($email, $subject, $mail_body, $headers);
			$result = TRUE;	
			if($result) echo 'TEST --- ' . $email . ' heeft een Nieuwjaarswens ontvangen!' . '<br/>';
			else
			echo 'TEST --- ' . $email . ' heeft GEEN Nieuwjaarswens ontvangen! Fout bij verzenden.' . '<br/>';

		}
	}
//******************************************************************************************
	
}

//******************************************************************************************
// 1. Init
// 1.1 Haal emailtekst op
// 2. Lees tabel persoon, check of e-mail geldig is en nwbrf ind op 'j' staat.
// 3. Stuur nieuwsbrief naar email
// 4. Afsluiting
//******************************************************************************************

if (isset($_POST['switch']) && $_POST['switch'] == 'j')
{
	init ();
	
	sendNieuwsbrief ();
	
	close ();
	
	unset($_POST['switch']);
	header('Location: sendNewyearsWish.php');
}

?>
<!DOCTYPE html>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Nieuwjaarswens versturen</title>
<meta name="description" content="" />
</head>
<body>
	
    <form  method="POST" action="sendNewyearsWish.php" novalidate>
	<p>Nieuwjaarswensen worden verstuurd naar adressen in de database.</p>
    <button id="knop" type="submit" name="switch" value="j">
   Verstuur
    </button>						
</body>
</html>