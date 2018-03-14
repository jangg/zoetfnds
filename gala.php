<?php

include_once ('config.php');
include_once ('includes/gala.inc');

global $error;
global $naam;
global $email;
global $organisatie;

if (isset($_POST['submit']) && $_POST['submit'] == 'verstuur')
{
	if (isset($_POST['g-recaptcha-response']))
		$response = $_POST['g-recaptcha-response'];
	if (checkBot($response) == FALSE) {
		//  	echo 'Het is geen robot!!!!!!';
		/* 	
		Controle van alle inputvelden
		 */
			 
		 $error = 0x0000;
		 $naam = $_POST['naam'];
		 $email = $_POST['emailadres'];
		 $organisatie = $_POST['organisatie'];
		 
		 if (!checkNaam ($naam))
		 	$error = $error | 0x0001;
		 if (!checkEmail ($email))
		 	$error = $error | 0x0002;
		 if ($organisatie != '')
		 {
			 if (!checkOrganisatie ($organisatie))
			 	$error = $error | 0x0004;
		 }
	
		 if ($error == 0x0000)
		 {
	//	 	error_log('Hier gaan we updaten!');
		 	
		 	setDeelnemer($naam, $email, $organisatie);
	 	 	sendEmail($naam, $email, $organisatie);
		 	$naam = '';
		 	$email = '';
		 	$organisatie = '';
		 	$show_result = TRUE;
		 } 
		 unset($_POST);
		 header('Location: gala.php?s=y');
		 exit();
		if (isset($_GET['s']) && $_GET['s'] == 'y') 
			$show_result = TRUE; else $show_result = FALSE;
	}
}


?>
<!DOCTYPE html>
<html>
<html lang="NL-nl">
<head>
	<?php include("includes/head.inc"); ?>
<style>
	#tabel table{
		width: 100%;
		margin: 30px auto;
		-webkit-column-break-inside: avoid;
		page-break-inside: avoid;
		break-inside: avoid;
	}
	#tabel td {
		border: solid 2px grey;
		background-color: white;
		color: black;
		vertical-align: top;
		padding: 10px;
	}
	header {
	    background-image: url(../img/broodrozen2.jpg);
	}
	.intro-heading {
		text-shadow: 4px 4px 10px black;
	}
	.navbar-default .nav li a {
	    color: #fff;
	}
	@media(min-width: 992px) {
		.twoColumns{
	    -webkit-column-gap: 40px;
	       -moz-column-gap: 40px;
	            column-gap: 40px;
	    -webkit-column-count: 2;
	       -moz-column-count: 2;
	            column-count: 2;
	    }
		.navbar-default .nav li a {
		    color: #000;
		}
	    .navbar-default.navbar-shrink {
	        padding: 10px 0;
	        background-color: #999;
	    }
	}
.dropdown-menu {
	background-color: rgba(127, 112, 210, 0.87);
}



</style>
</head>
<body id="page-top" class="index">
	<?php include("includes/navigation.inc"); ?>
   <!-- Header -->
    <header>
        <div class="container doverlay">
            <div class="intro-text">
                <div class="intro-lead-in">
	                <img src="../img/logos/zflogo_100.png" alt="zflogo_100" width="347" class="img-responsive img-centered" />
	            </div>
                <div class="intro-heading">Het Initiatieven Gala</div>

                <a href="#" class="btn btn-xl">Inschrijven is niet meer mogelijk</a>
            </div>
        </div>
    </header>
     
<!------      A A N M E L D I N G ------------->    
    <!-- Aanmelding Section -->
    <section id="aanmelding" class="invoer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12"><br/<br/>
                    <h2 class="section-heading">Vrijdagavond 6 oktober</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 twoColumns"><br/<br/>
					<h4>Burgerinitiatieven in Zoetermeer</h4>
					<p>Het Zoetermeerfonds is opgericht om ondernemende inwoners van Zoetermeer met goede ideeën voor de stad te helpen met het uitvoeren van hun plannen.</p>
					<p> Eénmaal per jaar organiseert het fonds een bijeenkomst waarbij de initiatiefnemers zijn uitgenodigd om de stand van zaken te horen en elkaar te ontmoeten.</p>
					<h4>Agenda voor de avond</h4>
					<div id="tabel">
					<table>
			    		<tr><th>Tijd</th><th>Onderwerp</th></tr>
			    		<tr><td>18:00h&nbsp-&nbsp18:45h</td><td>Inloop, hapje, drankje</td></tr>
			        	<tr><td>18:45h&nbsp-&nbsp19:00h</td><td>Introductie, over het Zoetermeerfonds, door Tim de Jong, bestuurslid Zoetermeerfonds</td></tr>
						<tr><td>19:00h&nbsp-&nbsp19:10h</td><td>De Initiatievenmakelaar, door Jan Geerdes</td></tr>
						<tr><td>19:10h&nbsp-&nbsp19:30h</td><td>Hapje, drankje																									   </td></tr>
						<tr><td>19:30h&nbsp-&nbsp20:00h</td><td>“Help een maatschappelijk Initiatief”, uitkomsten, conclusies en aanbevelingen, door Marije van den Berg, Whiteboxing</td></tr>
						<tr><td>20:00h&nbsp-&nbsp20:30h</td><td>Hapje, drankje																									   </td></tr>
						<tr><td>20:30h&nbsp-&nbsp21:00h</td><td>Vragen en discussie, initiatiefnemers, Whiteboxing, gemeente, Zoetermeerfonds										</td></tr>
						<tr><td>21:00h&nbsp-&nbsp21:10h</td><td>Afsluiting, door Aafke Halma, bestuurslid Zoetermeerfonds									   </td></tr>

					</table>
					</div>
					<h4>Whiteboxing deed onderzoek</h4>
					<p>
					Het onderzoeksbureau Whiteboxing heeft in het voorjaar van 2017 in opdracht van de gemeente Zoetermeer onderzoek gedaan 
					naar de status van Maatschappelijke Initiatieven in Zoetermeer. 
					Dit zijn initiatieven die tot doel hebben de lokale samenleving te verbeteren en die door inwoners worden bedacht, gepland en uitgevoerd. Tenminste, als alles goed gaat. 
					</p>
					<div class="pull-left">
						<a href="http://www.whiteboxing.nl" target="_new">
							<img src="img/wblogo.png" alt="wblogo" class="img-responsive img-centered" style="margin-right: 20px;">
						</a>
					</div>
					
					<p>Bij veel initiatieven speelt  de gemeentelijke overheid een belangrijk rol. 
						Zonder ondersteuning van de mensen in het gemeentehuis komt een initiatief vaak niet of heel moeizaam van de grond.
					</p>
					<p>In september levert Whiteboxing haar eindrapport op met daarin conclusies en aanbevelingen. 
						Op het Initiatieven Gala van 6 oktober a.s. zullen de onderzoekers hun bevindingen presenteren. 
						Daarna moeten initiatieven en gemeente gezamenlijk de uitdaging oppakken om Zoetermeer nog mooier en beter te maken.
					</p>
					<h4>Aanmelden</h4>
					<p>Het Initiatieven Gala is een initiatief van Het Zoetermeerfonds. Deelname is kosteloos maar als je de avond wil bijwonen willen we graag wel dat je je <a href="#inschrijfform">inschrijft</a>.
						Op deze manier kunnen wij inschatten wat we moeten inkopen.
					</p>
					<div id="tabel">
					<table>
			    		<tr>
			        		<td>Plaats : </td>
			        		<td>Brood & Rozen<br/>Industrieweg 8<br/>2722 BN Zoetermeer<br/>(Achter de bakkerij van Jongerius)</td>
			    		</tr>
			    		<tr>
			        		<td>Datum :</td>
			        		<td>Vrijdag 6 oktober 2017</td>
			    		</tr>
			    		<tr>
			        		<td>Tijd :</td>
			        		<td>18:45 uur tot 21:30 uur<br/>Inloop vanaf 18:00 uur</td>
			    		</tr>
			    		<tr>
			        		<td>Kosten :</td>
			        		<td>Voor deelnemers zijn er geen kosten aan verbonden.</td>
			    		</tr>
					</table>
					</div>
					<p>
					Inschrijven kan met behulp van onderstaand formulier.
					</p>
					<p>
					Deelname op volgorde van binnenkomst.
					Er kunnen maximaal 100 personen deelnemen. Dus vol = vol.
					</p>
					
					<h4>Waar is Brood & Rozen?</h4>
<!-- 					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2453.7507715776774!2d4.5053763164522245!3d52.047851979727625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c5cecedea63837%3A0x28e613581505e3c0!2sIndustrieweg+8%2C+2712+LB+Zoetermeer!5e0!3m2!1snl!2snl!4v1505203145780" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe> -->
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2453.7507715776774!2d4.5053763164522245!3d52.047851979727625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c5cecedea63837%3A0x28e613581505e3c0!2sIndustrieweg+8%2C+2712+LB+Zoetermeer!5e0!3m2!1snl!2snl!4v1505203145780" width="550" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
										
                </div>           
            </div>
<!--
			<div id="inschrijfform" class="row">
                <div class="col-lg-12">
	                <h2>Inschrijfformulier</h2>
                    <form  method="POST" action="gala.php" id="mijnGala" novalidate>

						<!-- SHOW ERROR/SUCCESS MESSAGES --
						<div id="messages" class="well"  <?php if ($show_result) echo 'style="display: block;"'; else echo 'style="display: none;"'; ?>><h1><span class="glyphicon glyphicon-thumbs-up"></span></h1><p>Je email met een bevestiging is onderweg.</p></div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input id="naam" name="naam" type="text" class="form-control" placeholder="Je naam *" required 
                                    <?php if (($error & 0x0001) == TRUE) echo 'STYLE="background-color: #FFABAB;"';
	                                    if ($error != 0x0000) echo 'value="' . $naam . '"';?>>
                                </div>
                                <div class="form-group">
                                    <input id="emailadres" name="emailadres" type="email" class="form-control" placeholder="Je emailadres *" required 
                                    <?php if (($error & 0x0002) == TRUE) echo 'STYLE="background-color: #FFABAB;"';
	                                     if ($error != 0x0000) echo 'value="' . $email . '"';?>>
                                </div>
                                <div class="form-group">
                                    <input id="org" name="organisatie"  type="text" class="form-control" placeholder="Namens initiatief/organisatie" 
                                    <?php if (($error & 0x0004) == TRUE) echo 'STYLE="background-color: #FFABAB;"';
	                                    if ($error != 0x0000) echo ' value="' . $organisatie . '"';?>
                                </div>
	                                     <br/><p>Je ontvangt een bericht op je emailadres als bevestiging van je aanmelding.</p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="recap">
	                                Vergeet niet dit hokje aan te vinken. 
	                                Hiermee weten we zeker dat je de gegevens hebt ingetypt.
	                                <div class="g-recaptcha" data-sitekey="6LfFvy0UAAAAABgxnthkp4nMnWwWeL6EMskneGfS"></div>
                                </div>
                                <div id="success"></div>
                                <button id="knop" name="submit" value="verstuur" type="submit" class="btn btn-xl">
                                Verstuur
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
-->
        </div>
    </section>






<!------            F O O T E R ------------->    
<?php include("includes/footer.inc"); ?>
<?php include("includes/scripts.inc"); ?>
<script>
	$("#naam").click(function() {
		$(this).css({backgroundColor: 'white'})
		$("#messages").css({display: 'none'})
	});	
	$("#emailadres").click(function() {
		$(this).css({backgroundColor: 'white'})
		$("#messages").css({display: 'none'})
	});	
	$("#organisatie").click(function() {
		$(this).css({backgroundColor: 'white'})
		$("#messages").css({display: 'none'})
	});	
</script>
</body>
</html>