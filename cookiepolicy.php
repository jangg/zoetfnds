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
 
     
<!------            C O O K I E S------------->    
    <!-- aanvraagformulier Section -->
    <section id="cookies">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Alles over onze cookies</h2>
<h4>Wat is een cookie?</h4>
<p>Wij maken op deze website gebruik van cookies. Een cookie is een eenvoudig klein bestandje dat met pagina’s van deze website wordt meegestuurd en door uw browser op uw harde schrijf van uw computer wordt opgeslagen. De daarin opgeslagen informatie kan bij een volgend bezoek weer naar onze servers teruggestuurd worden.</p>

<!--
“Gebruik van permanente cookies
Met behulp van een permanente cookie kunnen wij jou herkennen bij een nieuw bezoek op onze website. De website kan daardoor speciaal op jouw voorkeuren worden ingesteld. Ook wanneer je toestemming hebt gegeven voor het plaatsen van cookies kunnen wij dit door middel van een cookie onthouden. Hierdoor hoef je niet steeds jouw voorkeuren te herhalen waardoor je dus tijd bespaart en een prettiger gebruik van onze website kunt maken. Permanente cookies kan je verwijderen via de instellingen van jouw browser.”
-->

<h4>Gebruik van sessie cookies</h4>
<p>Met behulp van een sessie cookie kunnen wij zien welke onderdelen van de website je met dit bezoek hebt bekeken. Wij kunnen onze dienst daardoor zoveel mogelijk aanpassen op het surfgedrag van onze bezoekers. Deze cookies worden automatisch verwijderd zodra je jouw webbrowser afsluit.</p>

<!--
[Indien van toepassing verplicht] Voorbeeldtekst wanneer u zelf tracking cookies plaatst:
“Tracking cookies van onszelf
Met jouw toestemming plaatsen wij een cookie op jouw apparatuur, welke kan worden opgevraagd zodra je een website uit ons netwerk bezoekt. Hierdoor kunnen wij te weten komen dat je naast onze website ook op de betreffende andere website(s) uit ons netwerk bent geweest. Het daardoor opgebouwde profiel is niet gekoppeld aan jouw naam, adres, e-mailadres en dergelijke, maar dient alleen om advertenties af te stemmen op jouw profiel, zodat deze zo veel mogelijk relevant voor je zijn.“
-->

<!--
[Indien van toepassing verplicht] Voorbeeldtekst wanneer derden via uw website tracking cookies plaatsen:
“Tracking cookies van onze adverteerders
Met jouw toestemming plaatsen onze adverteerders “tracking cookies” op jouw apparatuur. Deze cookies gebruiken zij om bij te houden welke pagina’s je bezoekt uit hun netwerk, om zo een profiel op te bouwen van jouw online surfgedrag. Dit profiel wordt mede opgebouwd op basis van vergelijkbare informatie die zij van jouw bezoek aan andere websites uit hun netwerk krijgen. Dit profiel wordt niet gekoppeld aan jouw naam, adres, e-mailadres en dergelijke zoals bij ons bekend, maar dient alleen om advertenties af te stemmen op jouw profiel zodat deze zo veel mogelijk relevant voor je zijn.”
-->

<h4>Google Analytics</h4>
<p>Via onze website wordt een cookie geplaatst van het Amerikaanse bedrijf Google, als deel van de “Analytics”-dienst. Wij gebruiken deze dienst om bij te houden en rapportages te krijgen over hoe bezoekers de website gebruiken. Google kan deze informatie aan derden verschaffen indien Google hiertoe wettelijk wordt verplicht, of voor zover derden de informatie namens Google verwerken. Wij hebben hier geen invloed op. Wij hebben Google toegestaan de verkregen analytics informatie te gebruiken voor andere Google diensten.</p>

<p>De informatie die Google verzamelt wordt zo veel mogelijk geanonimiseerd. Wij hebben Google niet verzocht om uw IP-adres te maskeren en wij hebben een bewerkersovereenkomst met Google gesloten.</p>

<h4>Facebook en Twitter</h4>
<p>Op onze website zijn buttons opgenomen om webpagina’s te kunnen promoten (“liken”) of delen (“tweeten”) op sociale netwerken als Facebook en Twitter. Deze buttons werken door middel van stukjes code die van Facebook respectievelijk Twitter zelf afkomstig zijn. Door middel van deze code worden cookies geplaatst. Wij hebben daar geen invloed op. Leest u de privacyverklaring van Facebook respectievelijk van Twitter (welke regelmatig kunnen wijzigen) om te lezen wat zij met uw (persoons)gegevens doen die zij via deze cookies verwerken.</p>

<p>De informatie die ze verzamelen wordt zo veel mogelijk geanonimiseerd. De informatie wordt overgebracht naar en door Twitter, Facebook, Google + en LinkedIn opgeslagen op servers in de Verenigde Staten.”</p>

<h4>Recht op inzage en correctie of verwijdering van jouw gegevens</h4>
<p>Je hebt het recht om te vragen om inzage in en correctie of verwijdering van jouw gegevens. Zie hiervoor onze contactpagina. Om misbruik te voorkomen kunnen wij je daarbij vragen om je adequaat te identificeren. Wanneer het gaat om inzage in persoonsgegevens gekoppeld aan een cookie, dien je een kopie van het cookie in kwestie mee te sturen. Je kunt deze terug vinden in de instellingen van je browser.</p>

<h4>In- en uitschakelen van cookies en verwijdering daarvan</h4>
<p>Meer informatie omtrent het in- en uitschakelen en het verwijderen van cookies kan je vinden in de instructies en/of met behulp van de Help-functie van jouw browser.</p>

<!--
[Indien van toepassing verplicht] Voorbeeldtekst om uw gebruiker te informeren over verwijdering van tracking cookies geplaatst door derden:
“Verwijderen van tracking cookies geplaatst door derden
Sommige tracking cookies worden geplaatst door derden die onder meer via onze website advertenties aan je vertonen. Deze cookies kan je centraal verwijderen via Your Online Choices zodat ze niet bij een website van een derde teruggeplaatst worden.”
-->
                </div>
            </div>
        </div>
    </section>
<!------      einde C O O K I E S ------------->    

<!------            F O O T E R ------------->    
<?php include("includes/footer.inc"); ?>
<?php include("includes/scripts.inc"); ?>


</body>

</html>
