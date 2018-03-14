<?php
include_once('../config.php');
include_once('../classes/c_person_coll.php');
include_once('../classes/c_user.php');
include_once('../classes/c_person.php');


if (!isset($_SESSION['username']))
	header('location: index.php');

$personid = NULL;

if (isset($_SESSION['userid']))
{
	$curr_user = new User ('id', $_SESSION['userid']);
} else
{
	$curr_user = new User ();
}

if (isset($_POST['personid']))
{
	$_SESSION['personid'] = $_POST['personid'];
}
if (isset($_SESSION['personid']))
{
	$personid = $_SESSION['personid'];
}

$person = new Person('id', $personid);

if (isset($_POST['okmod']) && $_POST['okmod'] == 'Wijzig')
{
	$person->volnaam = $_POST['volnaam'];
	$person->voornaam = $_POST['voornaam'];
	$person->tussenvoegsel = $_POST['tussenvoegsel'];
	$person->achternaam = $_POST['achternaam'];
	$person->geslacht = $_POST['geslacht'];
	$person->emailadres = $_POST['emailadres'];
	$person->adres = $_POST['adres'];
	$person->postcode = $_POST['postcode'];
	$person->woonplaats = $_POST['woonplaats'];
	$person->telnr = $_POST['telnr'];
	$person->reknr = $_POST['reknr'];

// 	echo $_POST['nieuwsbrief'];
	if (isset($_POST['nieuwsbrief']) && $_POST['nieuwsbrief'] == 'j')
	{ $person->nieuwsbrief = 'j'; } 
	else
	{ $person->nieuwsbrief = 'n'; }
	
	if (isset($_POST['aanvraag']) && $_POST['aanvraag'] == 'j')
	{ $person->aanvraag = 'j'; } 
	else
	{ $person->aanvraag = 'n'; }
	$person->updateToDB();
	unset($_POST['okmod']);
}

?>
<!DOCTYPE html>
<html lang="NL-nl">

<head>
	<title>Zoetermeerfonds | beheer</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href='http://fonts.googleapis.com/css?family=Cousine' rel='stylesheet' type='text/css'>		
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">		
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<link href="css/beheer_style.css" rel="stylesheet" type="text/css" /> 
<style>
	
	body {
		max-width: 1280px;
		margin: 0 auto;
		padding: 10px 50px;
	}
	h1,
	h2,
	h3,
	h4,
	h5,
	h6 {
	    text-transform: uppercase;
	    font-family: Montserrat,"Helvetica Neue",Helvetica,Arial,sans-serif;
	    font-weight: 500;
	}
	
	h1 {
		text-align: center;
		font-size: 4em;
	}
			
	h2, h3, h4, h5 {
		margin-top: 0;
	}
	.titel {
		clear: both;
		margin: 5px 0px 5px 0px;
		color: grey;
	}
	.text {
		margin-left: 70px;
	}
	
	.box {
		border: 1px solid black;
		margin: 5px 0px;
		padding: 15px;
		background-color: #e6faff;
	}
	
	.comment {
		font-size: 0.9em;
	}
	
	.comment > h5 {
		color: #4169E1;
	}
	
</style>
<script>
$(document).ready(function(){

   $(".view").show();
   $(".modify").hide();
   $("#view_person, #cancelmod").click(function(){
	    $(this).parent("li").siblings("li").removeClass("active");
        $(".view").show();
		$(".modify").hide();
		$(this).parent("li").addClass("active");
		
	});
   $("#mod_person").click(function(){
	    $(this).parent("li").siblings("li").removeClass("active");
        $(".view").hide();
		$(".modify").show();
		$(this).parent("li").addClass("active");
		
	});
   $("#okmod").click(function(){
	    /* bijwerken aanvraag */
	    
	    
	    $(this).parent("li").siblings("li").removeClass("active");
        $(".view").show();
		$(".modify").hide();
		$(this).parent("li").addClass("active");

	});
	
   
});	
</script>	
</head>

<body>
	<div class="container">
		<div class="row header">
			<h1>Zoetermeerfonds beheer</h1>
		</div>
        <div class="row">
            <div class="text-center"><h2>Persoon <?php echo $person->id; ?></h2>
            </div>
        </div>
		<div class="row">
			<div class="col-sm-12">
				<ul id="myTab" class="nav nav-pills">
				   	<li class="active">
				      	<a id="view_person" href="#"  data-toggle="tab">
				         Inzien
						</a> 
					</li>
					<?php
						if ($curr_user->isBeheerder())
						{
							echo '<li><a id="mod_person" href="#" data-toggle="tab">Wijzigen</a></li>';
						}					
					?>
					<li>
				      	<a href="overz_persons.php">
				         Terug naar overzicht
						</a> 
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="box">
					<form method="POST" action="person.php" id="person" novalidate>
					<h2>Gegevens</h2>
					<div>
						<div class='titel'>ID persoon: </div><div class='text'><?php echo $person->id; ?></div>
					</div>
					<div class="view">
						<div class='titel'>Volledige naam: </div><div class='text'><?php echo $person->volnaam; ?></div>
					</div>
					<div class="modify">
						<label for="naam">Volledige naam: </label>
						<input type="text" class="form-control" name="volnaam" value="<?php echo $person->volnaam; ?>">
					</div>
					<div class="view">
						<div class='titel'>Voornaam: </div><div class='text'><?php echo $person->voornaam; ?></div>
					</div>
					<div class="modify">
						<label for="naam">Voornaam: </label>
						<input type="text" class="form-control" name="voornaam" value="<?php echo $person->voornaam; ?>">
					</div>
					<div class="view">
						<div class='titel'>Tussenvoegsel: </div><div class='text'><?php echo $person->tussenvoegsel; ?></div>
					</div>
					<div class="modify">
						<label for="naam">Tussenvoegsel: </label>
						<input type="text" class="form-control" name="tussenvoegsel" value="<?php echo $person->tussenvoegsel; ?>">
					</div>
					<div class="view">
						<div class='titel'>Achternaam: </div><div class='text'><?php echo $person->achternaam; ?></div>
					</div>
					<div class="modify">
						<label for="naam">Achternaam: </label>
						<input type="text" class="form-control" name="achternaam" value="<?php echo $person->achternaam; ?>">
					</div>

					<div class="view">
						<div class='titel'>Geslacht: </div><div class='text'>
						<?php 
						if ($person->geslacht == 'v')
						{
							echo 'Vrouw';
						} else
						{							
							echo 'Man';
						}
						?>
						</div>
					</div>
					<div class="checkbox modify">
						<label>Geslacht:&nbsp</label>
						<input type="radio" name="geslacht" value="m"
						<?php 
						if ($person->geslacht == 'm')
						{
							echo ' checked';
						}
						?>
						>&nbspMan
						<input type="radio" name="geslacht" value="v"
						<?php 
						if ($person->geslacht == 'v')
						{
							echo ' checked';
						}
						?>
						>&nbspVrouw
						</label>
					</div>

					<div class="view">
						<div class='titel'>Adres: </div><div class='text'><?php echo $person->adres; ?></div>
					</div>
					<div class="modify">
						<label for="adres">Adres</label>
						<input type="text" class="form-control" name="adres" value="<?php echo $person->adres; ?>">
					</div>
					<div class="view">
						<div class='titel'>Postcode: </div><div class='text'><?php echo $person->postcode; ?></div>
					</div>
					<div class="modify">
						<label for="postcode">Postcode</label>
						<input type="text" class="form-control" name="postcode" value="<?php echo $person->postcode; ?>">
					</div>
					<div class="view">
						<div class='titel'>Woonplaats: </div><div class='text'><?php echo $person->woonplaats; ?></div>
					</div>
					<div class="modify">
						<label for="woonplaats">Woonplaats</label>
						<input type="text" class="form-control" name="woonplaats" value="<?php echo $person->woonplaats; ?>">
					</div>
					<div class="view">
						<div class='titel'>Telefoon: </div><div class='text'><?php echo $person->telnr; ?></div>
					</div>
					<div class="modify">
						<label for="telefoon">Telefoon</label>
						<input type="text" class="form-control" name="telnr" value="<?php echo $person->telnr; ?>">
					</div>
					<div class="view">
						<div class='titel'>Emailadres: </div><div class='text'><?php echo $person->emailadres; ?></div>
					</div>
					<div class="modify">
						<label for="emailadres">Emailadres</label>
						<input type="text" class="form-control" name="emailadres" value="<?php echo $person->emailadres; ?>">
					</div>
					<div class="view">
						<div class='titel'>IBAN reknr: </div><div class='text'><?php echo $person->reknr; ?></div>
					</div>
					<div class="modify">
						<label for="reknr">IBAN reknr</label>
						<input type="text" class="form-control" name="reknr" value="<?php echo $person->reknr; ?>">
					</div>
					<div class="view">
						<div class='titel'>Nieuwsbrief: </div><div class='text'>
						<?php 
						if ($person->nieuwsbrief == 'j')
						{
							echo 'Ja';
						} else
						{
							
							echo 'Nee';
						}
						?>
						</div>
					</div>
					<div class="checkbox modify">
						<label>
						<input type="checkbox" name="nieuwsbrief" value="j"
						<?php 
						if ($person->nieuwsbrief == 'j')
						{
							echo ' checked';
						}
						?>
						>Nieuwsbrief
						</label>
					</div>
					<div class="view">
						<div class='titel'>Aanvraag: </div><div class='text'>
						<?php 
						if ($person->aanvraag == 'j')
						{
							echo 'Ja';
						} else
						{
							
							echo 'Nee';
						}
						?>
						</div>
					</div>
					<div class="checkbox modify">
						<label>
						<input type="checkbox" name="aanvraag" value="j"
						<?php 
						if ($person->aanvraag == 'j')
						{
							echo ' checked';
						}
						?>
						>Aanvraag
						</label>
					</div>
					
				</div>
				<div class="box modify">
					<input id="okmod" name="okmod" value="Wijzig" type="submit" class="btn btn-sm">
					<input id="cancelmod" name="cancelmod" value="Cancel" type="submit" class="btn btn-sm">
				</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>

