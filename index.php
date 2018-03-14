<?php
require_once ('config.php');
include_once('classes/c_newsitem_coll.php');
include_once('classes/c_newsitem.php');

function shorten_string($string, $wordsreturned)
/*  Returns the first $wordsreturned out of $string.  If string
	contains more words than $wordsreturned, the entire string
	is returned.*/
{
	$retval = $string;	//	Just in case of a problem
	$array = explode(" ", $string);
	/*  Already short enough, return the whole thing*/
	if (count($array) <= $wordsreturned)
	{
		$retval = $string;
	}
	/*  Need to chop of some words*/
	else
	{
		array_splice($array, $wordsreturned);
		$retval = implode(" ", $array) . " .....";
	}
	return $retval;
}

$arr1 = array (	array (0 => 'newsitem.visind', 1 => 'j'));
$arr2 = array (	array (0 => 'newsitem.date_created', 1 => 'DESC'));
				
$newsitemColl = new Newsitem_coll ($arr1, $arr2, 4);

global $connection;
openDB();

$html = '';
					

/* Het opmaken van 4 nieuwsitems en niet meer dan 4 */

$i = 0;
foreach ($newsitemColl->newsitemColl as $newsitem) {

	$html .= '<div class="newsitem_fp col-sm-6 col-lg-3"><hr/>
	                <h4>' . strftime('%A %e %B %Y', strtotime($newsitem->date_created)) . '</h4>' .
	                '<h3>' . $newsitem->title . '</h3>' .
					'<h5>' . $newsitem->subtitle . '</h5>' .
					shorten_string($newsitem->text, 80) .
					'<a href="nieuws.php?ni=' . $newsitem->id . '#overzicht"><div class="leesmeer">Lees meer...</div></a>' .
			'</div>';
	if ($i == 1)				
		$html .= '<div class="clearfix visible-sm visible-md"></div>';
					
	$i++;
}

/* Als er zojuist een aanmelding is geweest voor het Initiatieven Gala, laat dan een popup window zien */

?>
<!DOCTYPE html>
<html lang="NL-nl">

<head>

	<?php include("includes/head.inc"); ?>

</head>

<body id="page-top" class="index">
	<?php include("includes/facebook.inc"); ?>
	<?php include("includes/navigation.inc"); ?>
	<?php include("includes/header.inc"); ?>
 
    <!-- Nieuws Section -->
    <section id="nieuws">
	    <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Het laatste nieuws over Het Zoetermeer&shy;fonds</h2>
                </div>
            </div>
			<div class="row nieuwsitems">
				<?php echo $html; ?>

        	</div>
	    </div>    
    </section>

    <!-- Newsletter Section -->
    <section id="watis">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Wat is het Zoetermeer&shy;fonds?</h2>
                    <h3 class="section-subheading text-muted">Nieuw in onze stad</h3>
	                <p>Het Zoetermeer&shy;fonds is een lokaal fonds dat in 2016 is opgericht door een aantal betrokken inwoners van Zoetermeer. Het Zoetermeer&shy;fonds is een stichting en heeft tot doel om burgerinitiatieven in de gemeente Zoetermeer te ondersteunen met geld en, waar mogelijk, ook met raad en daad.</p>
	                <p>Inwoners van Zoetermeer die een maatschappelijk initiatief willen starten, kunnen een beroep doen op het Zoetermeer&shy;fonds en een bijdrage van het fonds aanvragen. De mogelijkheden en voorwaarden hiervoor worden elders op deze website uitgelegd.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section id="newsletter" class="invoer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Laat weten wie je bent. Wij hebben nieuws voor jou.</h2>
                    <h3 class="section-subheading text-muted">Met jouw emailadres kunnen we je op de hoogte houden van alles wat met Het Zoetermeer&shy;fonds
	                    te maken heeft.
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
<!--                     <form  name="mijnForm" action="" novalidate> -->
							<!-- SHOW ERROR/SUCCESS MESSAGES -->
							<div id="messages" class="well"><h1><span class="glyphicon glyphicon-thumbs-up"></span></h1></div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="naam" class="form-control" placeholder="Je naam *" required>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" name="emailadres" class="form-control" placeholder="Je emailadres *" required>
                                    <p></p>
                               </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <button id="nb_button" type="submit" class="btn btn-xl">
                                Verstuur
                                </button>
                            </div>
                        </div>
<!--                     </form> -->
                </div>
            </div>
        </div>
    </section>

    <!-- Doelen Section -->
    <section id="doelen">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Wat wil Het Zoetermeer&shy;fonds bereiken?</h2>
                    <h3 class="section-subheading text-muted">Het Zoetermeer&shy;fonds ondersteunt initiatieven van inwoners van Zoetermeer die zelf of samen met andere inwoners willen bijdragen aan een betere lokale samenleving. Het fonds doet dit door onder voorwaarden gelden ter beschikking te stellen aan initiatieven die hiervoor een aanvraag indienen. Het Zoetermeer&shy;fonds is een particulier initiatief. </h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4 box1">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-sun-o fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Een mooier Zoetermeer</h4>
                    <p class="text-muted">Zoetermeer nog mooier maken dan het nu is. Meer kunst in de openbare ruimte? Of minder afval op straat? Werk je idee uit, maak een plan en voer het uit.</p>
                </div>
                <div class="col-md-4 box1">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-group fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Een socialer Zoetermeer</h4>
                    <p class="text-muted">Beter zorgen voor elkaar. Voor je buren, voor de jongeren of voor de huisdieren. Een goed plan verdient het om uitgevoerd te worden. Schrijf het op en voer het uit!</p>
                </div>
                <div class="col-md-4 box1">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-recycle fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Een duurzamer Zoetermeer</h4>
                    <p class="text-muted">Wereldwijd het milieu verbeteren voor de generaties die na ons komen? Het begint in het hier en nu, in Zoetermeer. Bedenk hoe jij wilt bijdragen en voer je plannen uit!</p>
                </div>
            </div>

            <div class="row text-center">
                <div class="col-md-4 box1">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Een veiliger Zoetermeer</h4>
                    <p class="text-muted">Uitgaan zonder zorgen, in het donker veilig over straat kunnen, inbraakpreventie etc. Het kan altijd beter, ook in Zoetermeer. Heb je een idee en wil je het uitvoeren? Doen!</p>
                </div>
                <div class="col-md-4 box1">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-leaf fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Een groener Zoetermeer</h4>
                    <p class="text-muted">Het groen in de buurt laten groeien en bloeien, de parken beter onderhouden, de bomen in de wijken beheren, zoveel mensen zoveel ideeën. Maar als je ze werkelijkheid wilt laten worden moet je in actie komen. Aan de slag!</p>
                </div>
                <div class="col-md-4 box1">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-glass fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Een bruisender Zoetermeer</h4>
                    <p class="text-muted">Een wijkfestival organiseren, een buurtconcert geven, dansen in de straten of gezellig eten met de buurt. Het kan maar je moet het wel aanpakken. Het gaat niet vanzelf. Maar een plan en een begroting en voer het uit</p>
                </div>
            </div>



        </div>
    </section>


    <!-- Initiators Aside -->
    <section id="founders">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3 class="section-heading">Het Zoetermeer&shy;fonds is een initiatief van ...</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <a href="http://www.bizkwadraat.nl" target="_blank">
                        <img src="img/logos/BizKwadraat%20logo300x104.jpg" width="270" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-4 col-sm-6">
                    <a href="http://www.lokalefondsen.nl" target="_blank">
                        <img src="img/logos/lokale_fondsen.png" width="270"  class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-4 col-sm-6">
                    <a href="http://www.zoetermeer.nl" target="_blank">
                        <img src="img/logos/Gemeente-Zoetermeer.jpg" width="270"  class="img-responsive img-centered" alt="">
                    </a>
                </div>
<!--
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="img/logos/lokale_fondsen.png" class="img-responsive img-centered" alt="">
                    </a>
                </div>
-->
            </div>
        </div>
    </section>

    <!-- initiatiefnemers Grid Section -->
    <section id="initnemers" class="subjects bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Informatie voor initiatief&shy;nemers</h2>
                    <h3 class="section-subheading text-muted">Je bent Zoetermeerder. En je hebt een idee. Sterker nog, je hebt een plan. En medestanders. Veel kun je zelf maar voor een paar zaken heb je wat geld nodig. 
	                    Vertel het ons! Als wij het ook zien zitten en je voldoet aan de voorwaarden dan kunnen wij wellicht een financiële bijdrage leveren.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 subject-item">
                    <a href="#subjectModal1" class="subject-link" data-toggle="modal">
                        <div class="subject-hover">
                            <div class="subject-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/subject/fonds.jpg" class="img-responsive" alt="">
                    </a>
                    <div class="subject-caption">
                        <h4>Wat is een lokaal fonds en voor wie is het bedoeld?</h4>
<!--                         <p class="text-muted">Graphic Design</p> -->
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 subject-item">
                    <a href="#subjectModal2" class="subject-link" data-toggle="modal">
                        <div class="subject-hover">
                            <div class="subject-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/subject/goeddoel.jpg" class="img-responsive" alt="">
                    </a>
                    <div class="subject-caption">
                        <h4>Hoe dien je een aanvraag in?</h4>
<!--                         <p class="text-muted">Website Design</p> -->
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 subject-item">
                    <a href="#subjectModal3" class="subject-link" data-toggle="modal">
                        <div class="subject-hover">
                            <div class="subject-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/subject/aanvraag.jpg" class="img-responsive" alt="">
                    </a>
                    <div class="subject-caption">
                        <h4>Welke voorwaarden worden gesteld?</h4>
<!--                         <p class="text-muted">Website Design</p> -->
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 subject-item">
                    <a href="#subjectModal4" class="subject-link" data-toggle="modal">
                        <div class="subject-hover">
                            <div class="subject-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/subject/voorwaarden.jpg" class="img-responsive" alt="">
                    </a>
                    <div class="subject-caption">
                        <h4>De spelregels</h4>
<!--                         <p class="text-muted">Website Design</p> -->
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 subject-item">
                    <a href="#subjectModal5" class="subject-link" data-toggle="modal">
                        <div class="subject-hover">
                            <div class="subject-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/subject/doelgroep.jpg" class="img-responsive" alt="">
                    </a>
                    <div class="subject-caption">
                        <h4>Bijdrage aangevraagd! Wat nu?</h4>
<!--                         <p class="text-muted">Website Design</p> -->
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 subject-item">
                    <a href="#subjectModal6" class="subject-link" data-toggle="modal">
                        <div class="subject-hover">
                            <div class="subject-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/subject/verder.jpg" class="img-responsive" alt="">
                    </a>
                    <div class="subject-caption">
                        <h4>Wie kunnen nog meer helpen?</h4>
<!--                         <p class="text-muted">Website Design</p> -->
                    </div>
                </div>


            </div>
        </div>
    </section>

   <!-- Donateurs Grid Section -->
    <section id="donateurs" class="subjects">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Informatie voor donateurs</h2>
                    <h3 class="section-subheading text-muted">Zoetermeer is vanouds een stad van pionieren en vernieuwen. Het Zoetermeer&shy;fonds wil ondernemende burgers op weg helpen met hun maatschappelijke initiatieven.
	                  Daarvoor is vaak geld nodig, meestal geen enorme bedragen maar wat steun om zaken goed te kunnen regelen. Het Zoetermeer&shy;fonds kan daarin bijdragen. En jij kunt bijdragen door het fonds te steunen. Jouw donatie wordt zeer gewaardeerd
	                  door de inwoners van Zoetermeer. De stad wordt er mooier van, de samenleving rijker.
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 subject-item">
                    <a href="#subjectModal11" class="subject-link" data-toggle="modal">
                        <div class="subject-hover">
                            <div class="subject-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/subject/achter-de-schermen.jpg" class="img-responsive" alt="">
                    </a>
                    <div class="subject-caption">
                        <h4>Wie zitten er achter het fonds?</h4>
<!--                         <p class="text-muted">Graphic Design</p> -->
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 subject-item">
                    <a href="#subjectModal12" class="subject-link" data-toggle="modal">
                        <div class="subject-hover">
                            <div class="subject-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/subject/geld-uitgeven.jpg" class="img-responsive" alt="">
                    </a>
                    <div class="subject-caption">
                        <h4>Wat gebeurt er met mijn geld?</h4>
<!--                         <p class="text-muted">Website Design</p> -->
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 subject-item">
                    <a href="#subjectModal13" class="subject-link" data-toggle="modal">
                        <div class="subject-hover">
                            <div class="subject-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/subject/doneren.jpg" class="img-responsive" alt="">
                    </a>
                    <div class="subject-caption">
                        <h4>Hoe kan ik een donatie doen?</h4>
<!--                         <p class="text-muted">Website Design</p> -->
                    </div>
                </div>


            </div>
        </div>
    </section>

<!------            F O O T E R ------------->    
<?php include("includes/footer.inc"); ?>

<?php include("includes/subjects.inc"); ?>

<?php include("includes/scripts.inc"); ?>
<script src="js/chk_contact.js"></script>
<script src="js/chk_nb.js"></script>
</body>

</html>
