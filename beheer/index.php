<?php
require_once ('../config.php');
include_once('../classes/c_user.php');

unset($_SESSION['user']);

if (isset($_POST['vergeten']))
{
	header('location:vergeten.php');
	exit();
}

if (isset($_POST['aanmelden']))
{
	$user = new User('username', $_POST['username']);
// 	echo  $user;
	if ($user->id != NULL)
	{
		if ($user->password == md5($_POST['password']))
		{
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['password'] = $_POST['password'];
			$_SESSION['userid'] = $user->id;
		    $datetime = new DateTime();
			$user->activity = $datetime->format('Y\-m\-d\ H:i:s');
			$user->updateToDB();
			if ($user->mustChangePassword())
				header('location:wijzwacht.php');
			else
				header('location:overz_aanvr.php');
			exit();
		}
	}
}


	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Het Zoetermeerfonds | beheer</title>
		<meta name="viewport" content="width=device-width">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link href='http://fonts.googleapis.com/css?family=Cousine' rel='stylesheet' type='text/css'>		

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">	
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<link href="css/beheer_style.css" rel="stylesheet" type="text/css" /> 
		<style>
			h1,
			h2,
			h3,
			h4,
			h5,
			h6 {
			    text-transform: uppercase;
			    font-family: Montserrat,"Helvetica Neue",Helvetica,Arial,sans-serif;
			    font-weight: 700;
			}
			
			h2, h3, h4, h5 {
				margin-top: 0;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="row header">
				<div class="col-sm-3"></div>
				<div class="col-sm-6" style="margin: 20px auto; text-align: center;">
					<a href="../index.php"><img src="../img/logos/zflogo_50.png" alt="zflogo_50" width="223" height="80"></a>
					<h2>Zoetermeerfonds beheer</h2>
				</div>
				<div class="col-sm-3"></div>
			</div>
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<h3>Inloggen</h3>
				<form role="form" method="POST" action="index.php">
					<div class="form-groups">
						<label for="username">Gebruikersnaam</label>
						<input name="username" type="text" class="form-control" id="username" size="35">
					</div>
					<div class="form-groups">
						<label for="password">Wachtwoord</label>
						<input name="password" type="password" class="form-control" id="password" size="35">
					</div><br/>
					<button name="aanmelden" type="submit" class="btn btn-primary">Login</button>
					<button name="reset" type="submit" class="btn btn-default">Reset</button>
					<button name="vergeten" type="submit" class="btn btn-default">Wachtwoord vergeten?</button>
				</form>
				</div>
				<div class="col-sm-3"></div>
			</div>
			<div class="row footer">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
				&copy 2018 Zoetermeerfonds
				</div>
				<div class="col-sm-3"></div>
			</div>
		</div>
	</body>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</html>