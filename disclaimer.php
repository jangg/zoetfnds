<?php
session_start();
/*
if (isset($_SESSION['av_data']))
{
	error_log ( $_SESSION['av_data'] );
	$av_data = array();
	$av_data = $_SESSION['av_data'];
}
else
{
	error_log ( 'geen gegevens' );
}
*/
?>

<!DOCTYPE html>
<html lang="NL-nl">

<head>

	<?php include("includes/head.inc"); ?>
    

</head>

<body id="page-top" class="index">


	<?php include("includes/navigation.inc"); ?>
	<?php include("includes/header.inc"); ?>
 
     
<!------            A A N V R A A G ------------->    
    <!-- aanvraagformulier Section -->
    <section id="disclaimer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Disclaimer</h2>
					<p>De informatie die door het Zoetermeerfonds op haar website wordt aangeboden is met grote zorg samengesteld.</p>
	                <p>Het Zoetermeerfonds controleert alle publicaties zeer zorgvuldig, zodat aangeboden informatie zo actueel en nauwkeurig mogelijk is. 
	                 Ondanks de voortdurende aandacht voor de kwaliteit van haar berichtgeving kan het Zoetermeerfonds niet garanderen dat de informatie op haar website altijd juist, actueel of volledig is.</p>
	                <p>Aan de op de website aangeboden informatie en/of diensten kunnen op geen enkele manier rechten worden ontleend.
	                Het Zoetermeerfonds aanvaardt geen enkele aansprakelijkheid voor eventuele onjuistheden, noch voor informatie op websites waarnaar verwezen wordt.</p>
	                <p>Het Zoetermeerfonds behoudt zich het recht voor om de informatie op haar website te allen tijde te verbeteren of anderszins te wijzigen.
		                Mocht u in de berichtgeving op de website van het Zoetermeerfonds onjuistheden signaleren, dan stellen wij het zeer op prijs dat u deze meldt bij de webredactie.</p>
                </div>
            </div>
        </div>
    </section>
<!------      einde A A N V R A A G ------------->    

<!------            F O O T E R ------------->    
<?php include("includes/footer.inc"); ?>

<?php include("includes/scripts.inc"); ?>


</body>

</html>
