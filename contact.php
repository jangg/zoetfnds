<?php
include_once ('config.php');

$show_result = FALSE;
if (isset($_SESSION['result_contactme']))
{
	if ($_SESSION['result_contactme'] == 'success')
			$show_result = TRUE;
	unset($_SESSION['result_contactme']);			
}

?>
<!DOCTYPE html>
<html lang="NL-nl">
<head>
	<?php include("includes/head.inc"); ?>
</head>
<body id="page-top" class="index">


<?php include("includes/navigation.inc"); ?>
<?php include("includes/header.inc"); ?>


<!------            H E T   B E S T U U R ------------->    
    <!-- Contact Section -->
    <section id="bestuur">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Het bestuur</h2>
                    <h3 class="section-subheading"></h3>
                </div>
            </div>
            <div class="row">
                 <div class="col-md-6">
	                <div class="profiel profbox">
		                <img src="img/marco400.jpg" alt="jan" width="200" height="200">
		                <h3>Marco Borsboom</h3>
		                <h4>penningmeester</h4>
	                    <div class="fa-stack fa-3x">
	                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
							<a href="mailto:marco@zoetermeerfonds.nl"><i class="fa fa-envelope-o fa-stack-1x fa-inverse"></i></a>
		                </div>
	                </div>
                </div>
<!--
               <div class="col-md-6">
	                <div class="profiel profbox">
		                <img src="img/jan400.jpg" alt="jan" width="200" height="200">
		                <h3>Jan Geerdes</h3>
		                <h4>voorzitter</h4>
	                    <div class="fa-stack fa-3x">
	                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
							<a href="mailto:jan@zoetermeerfonds.nl"><i class="fa fa-envelope-o fa-stack-1x fa-inverse"></i></a>
		                </div>
	                </div>
                </div>
-->
                <div class="col-md-6">	                
	                <div class="profiel profbox">
		                <img src="img/aafke_pp_400.jpg" alt="aafke" width="200" height="200">
		                <h3>Aafke Halma</h3>
		                <h4>secretaris</h4>
	                    <div class="fa-stack fa-3x">
	                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
							<a href="mailto:aafke@zoetermeerfonds.nl"><i class="fa fa-envelope-o fa-stack-1x fa-inverse"></i></a>
		                </div>
	                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">	                
	                <div class="profiel profbox">
		                <img src="img/tim400.jpg" alt="tim" width="200" height="200">
		                <h3>Tim de Jong</h3>
		                <h4>bestuurslid</h4>
	                    <div class="fa-stack fa-3x">
	                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
							<a href="mailto:tim@zoetermeerfonds.nl"><i class="fa fa-envelope-o fa-stack-1x fa-inverse"></i></a>
		                </div>
	                </div>
                </div>
                <div class="col-md-6">	                
	                <div class="profiel profbox">
		                <img src="img/gert400.jpg" alt="edith" width="200" height="200">
		                <h3>Gert Jongerius</h3>
		                <h4>bestuurslid</h4>
	                    <div class="fa-stack fa-3x">
	                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
							<a href="mailto:gert@zoetermeerfonds.nl"><i class="fa fa-envelope-o fa-stack-1x fa-inverse"></i></a>
		                </div>
	                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">	 
                </div>               
                <div class="col-md-6">	                
	                <div class="profiel profbox">
		                <img src="img/edith400.jpg" alt="edith" width="200" height="200">
		                <h3>Edith Snoeij</h3>
		                <h4>voorzitter</h4>
	                    <div class="fa-stack fa-3x">
	                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
							<a href="mailto:edith@zoetermeerfonds.nl"><i class="fa fa-envelope-o fa-stack-1x fa-inverse"></i></a>
		                </div>
	                </div>
                </div>
                <div class="col-md-3">	 
                </div>               
            </div>
            <hr/>
            <br/>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">De fondsmanager voert het beleid uit</h2>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-3">	 
                </div>               
               <div class="col-md-6">
	                <div class="profiel profbox">
		                <img src="img/jan400.jpg" alt="jan" width="200" height="200">
		                <h3>Jan Geerdes</h3>
		                <h4>fondsmanager & initiatievenmakelaar</h4>
	                    <div class="fa-stack fa-3x">
	                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
							<a href="mailto:jan@zoetermeerfonds.nl"><i class="fa fa-envelope-o fa-stack-1x fa-inverse"></i></a>
		                </div>
	                </div>
                </div>
                <div class="col-md-3">	 
                </div>               
            </div>
        </div>
    </section>
<!------      einde B E S T U U R ------------->    
 
     
<!------            C O N T A C T ------------->    
    <!-- Contact Section -->
    <section id="contact" class="invoer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Neem contact met ons op</h2>
                    <h3 class="section-subheading">Wij zijn graag bereid je te woord te staan. Om alle vragen te beantwoorden en om je verdere informatie te verstrekken.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form  method="POST" action="process_contact.php" id="mijnContact" novalidate>

						<!-- SHOW ERROR/SUCCESS MESSAGES -->
						<div id="messages" class="well"  <?php if ($show_result) echo 'style="display: block;"'; else echo 'style="display: none;"'; ?>><h1><span class="glyphicon glyphicon-thumbs-up"></span></div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input id="naam" name="naam" type="text" class="form-control" placeholder="Je naam *" required>
                                </div>
                                <div class="form-group">
                                    <input id="emailadres" name="emailadres" type="email" class="form-control" placeholder="Je emailadres *" required>
                                </div>
                                <div class="form-group">
                                    <input id="telnr" name="telnr"  type="tel" class="form-control" placeholder="Je telefoonnummer *" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea  id="tekst" name="tekst" class="form-control" placeholder="Je vraag of opmerking *" required></textarea>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <div id="recap">
	                                Vergeet niet dit hokje aan te vinken. 
	                                Hiermee weten we zeker dat je de gegevens hebt ingetypt.
	                                <div class="g-recaptcha" data-sitekey="6LfFvy0UAAAAABgxnthkp4nMnWwWeL6EMskneGfS"></div>
                                </div>
                                <button id="knop" type="submit" class="btn btn-xl">
                                Verstuur
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<!------      einde C O N T A C T ------------->    

<!------            F O O T E R ------------->    
<?php include("includes/footer.inc"); ?>

<?php include("includes/scripts.inc"); ?>

<!-- Onderstaand script is voor 'equal heights divs' van de profielen -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.0/jquery.matchHeight-min.js"></script>
<script>
	$(function() {
    $('.profbox').matchHeight();
	});
</script>

</body>

</html>
