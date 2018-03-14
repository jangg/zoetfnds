<?php
session_start();

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

$response = $_POST['g-recaptcha-response'];
if (checkBot($response) == TRUE) {
//  	echo 'Het is een robot!!!!!!';
	
	$_SESSION['result_contactme'] = 'failure';	
	header ('location: contact.php#contact');
	exit();
} else {
//  	echo 'Het is GEEN robot!!!!!!';
	$_SESSION['result_contactme'] = 'success';	
}

// Check for empty fields
$data = array();
$name = $_POST['naam'];
$email_address = $_POST['emailadres'];
$phone = $_POST['telnr'];
$message = $_POST['tekst'];
	
// Create the email and send the message
$to = 'info@zoetermeerfonds.nl'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Website contactformulier:  $name";
$email_body = "Je hebt een nieuwe email van Het Zoetermeerfonds.nl ontvangen.\n\n"."Hier zijn de details:\n\nNaam: $name\n\nEmail: $email_address\n\nTelefoon: $phone\n\nBericht:\n$message";

$headers = "From: info@zoetermeerfonds.nl\n"; 
$headers .= "Reply-To: $email_address";	
mail($to,$email_subject,$email_body,$headers);
$email_body = "Je hebt een email naar Het Zoetermeerfonds verstuurd.\n\n"."Hier zijn de details:\n\nNaam: $name\n\nEmail: $email_address\n\nTelefoon: $phone\n\nBericht:\n$message";
mail($email_address,$email_subject,$email_body,$headers);
	$data['message'] = "Je contactgegevens zijn naar het Zoetermeerfonds verzonden.";
$data['success'] = TRUE;	   
// echo json_encode($data);			
$_SESSION['result_contactme'] = 'success';
header ('location: contact.php#contact');
?>