<?php
include_once ('config.php');

$show_result = FALSE;
if (isset($_SESSION['result_aanvraag']))
{
	if ($_SESSION['result_aanvraag'] == 'success')
			$show_result = TRUE;
			else
			$show_result = FALSE;
			
	unset($_SESSION['result_aanvraag']);			
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
 
    <section id="criteria">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="section-heading">De voorwaarden voor een aanvraag</h2>
                    <h3 class="section-subheading text-muted">Het gaat om geld voor ons allemaal dus we willen er zorgvuldig mee omgaan</h3>

							<h5>Termijnen</h5>
							<p>Belangrijk om rekening mee te houden:</p>
							<p>Het bestuur van het Zoetermeerfonds komt 1 x per maand bijeen en bespreekt dan de aanvragen die tot 5 werkdagen ervoor zijn binnengekomen. Dan wordt óf een besluit genomen over de aanvraag (toekennen of afwijzen) 
								óf de aanvraag wordt aangehouden omdat het bestuur van mening is dat voor een besluit meer informatie nodig is.</p>
							<p>In ieder geval ontvang je snel daarna een eerste reactie op je aanvraag.
							<p>Zorg er daarom voor dat een aanvraag ruim voor de start van je initiatief is ingediend. Als een initiatief al gestart is wanneer het besluit nog niet is genomen, kan dat een reden voor afwijzing zijn.</p>
							<h5>Voorwaarden</h5>
							<p>Hierbij de voorwaarden voor een aanvraag. 
								Als de aanvraag niet volledig is zullen wij -indien van toepassing- extra vragen stellen. Je kunt ons dus al in een vrij vroeg stadium van uw initiatief benaderen. 
								Vervolgens kunnen we samen de aanvraag samenstellen.</p>

							<ul>
							<li>Het initiatief komt ten goede aan Zoetermeer en/of zijn inwoners.</li>
							<li>In principe  moeten alle inwoners van Zoetermeer in de gelegenheid worden gesteld van het initiatief te profiteren.</li>
							<li>Initiatiefnemers en inwoners van Zoetermeer dienen te participeren in de uitvoering van het project. Zij werken op vrijwillige basis mee of stellen middelen ter beschikking zonder daarvoor betaald te krijgen.</li>
<!-- 							<li>Het initiatief mag geen gemeentelijk beleid doorkruisen.</li> -->
							<li>Arbeid wordt niet vergoed, tenzij aannemelijk kan worden gemaakt dat het niet door vrijwilligers verricht kan worden.</li>
							<li>De bijdrage van het Zoetermeerfonds dient significant (belangrijk) te zijn voor het slagen van het initiatief.</li>
							<li>Discriminerende activiteiten zijn niet toegestaan.</li>
							<li>Aanvragen worden ingediend voordat het initiatief is gestart. Aanvragen voor al gestarte initiatieven worden afgewezen.</li>
							<li>Co-financiering is in principe vereist, zeker bij grotere initiatieven (als de gevraagde bijdrage 2000 euro of meer bedraagt).</li>
							<li>Indiener van de aanvraag moet een inwoner van Zoetermeer zijn of een Zoetermeerse organisatie zonder winstoogmerk.</li>
							<li>Initiatief dient geen politiek of religieus doel.</li>
							<li>Omvang van de aanvraag begint bij 100 euro.</li>
							<li>De maximale bijdrage die het Zoetermeerfonds uitkeert bedraagt <strong>5000 euro</strong>.
							<li>Voorafgaande aan een uitkering boven de 1000 euro, wordt identiteitscontrole verlangd.</li>
							<li>Na afloop ontvangt het bestuur een verslag incl. financiële verantwoording van de initiatiefnemer.</li>
							<li>Initiatiefnemers geven volledige openheid van zaken omtrent financiën, indien van gevraagd door het Zoetermeerfonds.</li>
							</ul>
							<p><a href="voorwaarden.php#algemenevoorwaarden">Hier</a> vind je de formele Algemene Voorwaarden die het Zoetermeerfonds stelt wanneer een initiatiefnemer een financiële bijdrage van het fonds ontvangt.<p>
							<p>Het Zoetermeerfonds helpt je graag om een zo goed mogelijke aanvraag in te dienen.</p>
 

	            </div>
            </div>
        </div>
    </section>

     
   <section id="spelregels">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="section-heading">De spelregels die gelden bij een toegewezen aanvraag</h2>
                    <h3 class="section-subheading text-muted">De bijdrage is toegezegd. Dan houden we ons aan de afgesproken spelregels</h3>

							<p>Dit zijn de spelregels.
 
							<ul>
								<li>Aanvrager gaat ermee akkoord dat de aanvraag, of een samenvatting hiervan, en de uiteindelijke beoordeling, openbaar worden gepubliceerd op de website (zie hieronder)
								</li>
								<li>De uiteindelijke beoordeling is definitief, hier kan niet over worden gecorrespondeerd.
								</li>
								<li>Bij alle communicatie over de activiteit dient u de naam of het logo van het Zoetermeerfonds te vermelden.
								</li>
								<li>Initiatiefnemers blijven zelf verantwoordelijk voor de organisatie van het initiatief.
								</li>
								<li>Het Zoetermeerfonds doet haar best om bij de initiatieven te helpen, maar kan nooit garanties geven voor het slagen hiervan.
								</li>
								<li>Door een aanvraag te doen, verklaart u zich akkoord met deze spelregels.
								</li>
							</ul>
							<p>Het Zoetermeerfonds helpt je graag om een zo goed mogelijke aanvraag in te dienen.</p>

	            </div>
            </div>
        </div>
    </section>


    <section id="aanvragen">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="section-heading">Het aanvragen van een bijdrage van het Zoetermeerfonds</h2>
                    <h3 class="section-subheading text-muted">Wij maken het zo makkelijk als mogelijk, en liefst nog leuker ook</h3>
                    <p>Ok, je weet wat je wil, je hebt de voorwaarden en de spelregels gelezen, je staat te popelen om aan de slag te gaan.
	                    Maar je hebt wel wat middelen nodig om een aantal zaken te regelen. Dus je gaat het Zoetermeerfonds om een bijdrage vragen. Goed plan!</p>
	                <p>Het aanvragen is niet moeilijk. Je kunt een aanvraag op een aantal manieren indiende:</p>
	                <ol>
		                <li>Hieronder kun je gebruik maken van een online formulier. Dit is de snelste manier omdat alle informatie direct bij ons binnenkomt.
		                Onder normale omstandigheden weet je binnen twee werkdagen of alles correct is aangekomen.</li>
		                <li>Je kunt het aanvraagformulier in PDF-formaat downloaden. Het is hetzelfde als het online formulier maar dit formulier kun je uitprinten
		                en op je gemak met een pen invullen als je dat liever doet. Als dat gebeurd is, doe je het in een envelop en je doet het op de post.
		                Je begrijpt dat het wat langer duurt voordat je weet of alles goed is aangekomen. Belangrijk is om goed aan te geven hoe je het best bereikbaar bent. Een adres en/of telefoonnummer
		                zijn daarbij zeer behulpzaam.</li>
		                <p><form method="get" action="downloads/aanvraagformulier.pdf"><button class="btn btn-md" type="submit">Download hier het aanvraagformulier</button></form></p>
		                
		                <li>Een aanvraag mag ook op een vrij door jou te kiezen manier worden ingediend. Maar het moet wel door de brievenbus passen. Hierbij geldt wel: onze reactietijd is erg afhankelijk van 
		                de structuur van de aanvraag. Let bij het indienen goed op de voorwaarden en de regels. Probeer zo compleet mogelijk te zijn.
	                </ol>
                </div>
            </div>
        </div>
    </section>

<!------            A A N V R A A G ------------->    
    <!-- aanvraagformulier Section -->
    <section id="aanvform" class="invoer">
        <div class="container">
            <div class="row">
	            <div class="col-md-2"></div>
	            <div class="col-md-8 reqbox">
		            <h4>Over het online formulier</h4>
		            <p>Het invullen van het formulier is zo eenvoudig mogelijk gehouden. <strong>Alleen de persoonlijke gegevens van de aanvrager zijn verplicht</strong>. De overige velden hoeven niet ingevuld te worden maar 
			            uiteraard willen we het liefst zoveel mogelijk weten over je initiatief. Hoe meer informatie, des te krachtiger de aanvraag.
		            </p>
		            <p>Het emailadres en de postcode moeten aan de normale eisen voldoen.</p>
		            <p>Je kunt maximaal drie bestanden meesturen. Dat kunnen PDF, Word, Excel of gewone tekstbestanden zijn (dus met de extensies PDF, DOC, TXT, XLS of RTF). De maximale grootte per document bedraagt 5Mb.</p>
		            <p>Als je ongeldige waarden hebt ingegeven, kleurt het betreffende veld rood. Als alle velden een geldige waarde hebben kun je op de VERSTUUR-button klikken.</p>
		           
	            </div>
	            <div class="col-lg-2"></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form  method="POST" action="process_aanv.php" id="mijnAanvraag" enctype="multipart/form-data" novalidate>

						<h2>Persoonlijke gegevens aanvrager</h2>
						<h5 class="text-center">Vul hier de gegevens in van jezelf, de aanvrager.</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">Je naam (verplicht)
                                    <input id="naam" type="text" class="form-control" required name="naam">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">Je adres (verplicht)
                                    <input id="adres" type="text" class="form-control" required name="adres">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">Je postcode (verplicht)
                                    <input id="postcode" stype="text" class="form-control" required name="postcode">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">Je woonplaats (verplicht)
                                    <input id="woonplaats" type="text" class="form-control" required name="woonplaats">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">Je telefoonnummer
                                    <input id="telnr" type="tel" class="form-control" name="telnr">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">Je emailadres (verplicht)
                                    <input id="emailadres" type="email" class="form-control" required name="emailadres">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">Je IBAN rekeningnummer
                                    <input id="reknr" type="text" class="form-control" name="reknr">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">   
	                        <h3>Aanvraag namens een organisatie</h3>                     
                            <div class="col-md-12">
	                            <div class="checkbox">
							    <label><input type="checkbox" name="orgcb" id="orgcb">Als je de aanvraag namens een organisatie indient, klik dan het keuzevakje aan.</label>
	                            </div>
                            </div>
                        </div>
                        <div id="orginfo" hidden="true">
							<h2>Gegevens aanvragende organisatie</h2>
							<h5 class="text-center">Vul hier de gegevens in van de organisatie namens welke je een aanvraag indient.</h5>
	                        <div class="row">
	                            <div class="col-md-6">
	                                <div class="form-group">Naam (verplicht)
	                                    <input id="orgnaam" type="text" class="form-control" name="orgnaam">
	                                    <p class="help-block text-danger"></p>
	                                </div>
	                                <div class="form-group">Adres
	                                    <input id="orgadres" type="text" class="form-control" name="orgadres">
	                                    <p class="help-block text-danger"></p>
	                                </div>
	                                <div class="form-group">Postcode
	                                    <input id="orgpostcode" stype="text" class="form-control" name="orgpostcode">
	                                    <p class="help-block text-danger"></p>
	                                </div>
	                                <div class="form-group">Plaats
	                                    <input id="orgwoonplaats" type="text" class="form-control" name="orgwoonplaats">
	                                    <p class="help-block text-danger"></p>
	                                </div>
	                                <div class="form-group">Telefoonnummer
	                                    <input id="orgtelnr" type="tel" class="form-control" name="orgtelnr">
	                                    <p class="help-block text-danger"></p>
	                                </div>
	                            </div>
								<div class="col-md-6">
									<div class="form-group">Rechtsvorm
	<!-- 								  <label for="orgrechtsvorm">Rechtsvorm</label> -->
									  <select  id="orgrechtsvorm" class="form-control" name="orgrechtsvorm">
									    <option>Onbekend of nvt</option>
									    <option>Stichting</option>
									    <option>Vereniging</option>
									    <option>Besloten vennootschap (BV)</option>
									    <option>Vennootschap onder firma (VOF)</option>
									  </select>
									</div>                            
	                                 <div class="form-group">KvK nummer
	                                    <input id="orgkvknummer" type="text" class="form-control" name="orgkvknummer">
	                                    <p class="help-block text-danger"></p>
	                                </div>
	                               <div class="form-group">Emailadres
	                                    <input id="orgemailadres" type="email" class="form-control" name="orgemailadres">
	                                    <p class="help-block text-danger"></p>
	                                </div>
	                                <div class="form-group">URL website
	                                    <input id="orgurlwebsite" type="text" class="form-control" name="orgurlwebsite">
	                                    <p class="help-block text-danger"></p>
	                                </div>
	                                <div class="form-group">IBAN rekeningnummer van de organisatie
	                                    <input id="orgreknr" type="text" class="form-control" name="orgreknr">
	                                    <p class="help-block text-danger"></p>
	                                </div>
	                            </div>
	                        </div>
                        </div>

						<h2>Gegevens aanvraag</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">Wat wil je gaan doen?
                                    <textarea id="tekst01" class="form-control" name="wat"></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">Voor wie ga je het doen, wie is je doelgroep?
                                    <textarea id="tekst02" class="form-control" name="voorwie"></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">Waarom wil je het doen?
                                    <textarea id="tekst03" class="form-control" name="waarom"></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">Met welke mensen of organisaties werk je samen?
                                    <textarea id="tekst04" class="form-control" name="metwie"></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">Wanneer vindt het project plaats?
                                    <textarea id="tekst05" class="form-control" name="wanneer"></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">Hoe betrek je andere inwoners of vrijwilligers bij het project?
                                    <textarea id="tekst06" class="form-control" name="hoe"></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">Wat gaat het project kosten?
                                    <textarea id="tekst07" class="form-control" name="kosten"></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">Welk bijdrage vraag je van bij het Zoetermeerfonds?
                                    <textarea id="tekst08" class="form-control" name="bijdrage"></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">   
	                        <h3>Stuur documenten mee (optioneel)</h3>                     
                            <div class="col-md-4">
	                            <div>
								    Selecteer een document voor upload:<br/>(bijvoorbeeld een begroting)
	                            </div>
	                            <div>
								    <input type="file" class="form-control fileUpload" name="file1" id="fileToUpload1">
									<a href="#" id="clear1"><span class="glyphicon glyphicon-remove fileremove"></span></a>
	                            </div>
							</div>
                            <div class="col-md-4">
	                            <div>
								    Selecteer nog een document voor upload:<br/>(bijvoorbeeld een projectplan)
	                            </div>
	                            <div>
								    <input type="file" class="form-control fileUpload" name="file2" id="fileToUpload2">
									<a href="#" id="clear2"><span class="glyphicon glyphicon-remove fileremove"></span></a>
	                            </div>
							</div>
                            <div class="col-md-4">
	                            <div>
								    En selecteer nog een document voor upload:<br/>(bijvoorbeeld je visie op je plannen)
	                            </div>
	                            <div>
								    <input type="file" class="form-control fileUpload" name="file3" id="fileToUpload3">
									<a href="#" id="clear3"><span class="glyphicon glyphicon-remove fileremove"></span></a>
	                            </div>
							</div>
                        </div>
                        <div class="row">   
	                        <h3><br/>Zoetermeer&shy;fonds nieuwsbrief</h3>                     
                            <div class="col-md-12">
	                            <div class="checkbox">
							    <label><input type="checkbox" name="nbcb" id="nbcb" checked>Als je regelmatig de Zoetermeer&shy;fonds nieuwsbrief wilt ontvangen, klik dan het keuzevakje aan.</label>
	                            </div>
                            </div>
                        </div>
                       <div class="row">
                            <div class="col-lg-12 text-center">
								<div id="successmessage" class="well" 
									<?php 
										if ($show_result) 
											echo 'style="display: block;"'; else echo 'style="display: none;"'; 
									?>>		
										<h1><span class="glyphicon glyphicon-thumbs-up"></span></h1>Je aanvraag is met succes verzonden!</div>
									
									
                                <div id="success"></div><br/>
                                <div id="recap">
	                                Vergeet niet dit hokje aan te vinken. 
	                                Hiermee weten we zeker dat je de gegevens hebt ingetypt.
	                                <div class="g-recaptcha" data-sitekey="6LfFvy0UAAAAABgxnthkp4nMnWwWeL6EMskneGfS"></div>
                                </div>
                                <button id="knop" type="submit" class="btn btn-xl" name="submitbutton" disabled>
                               Verstuur
                                </button>						
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<!------      einde A A N V R A A G ------------->    

<!------            F O O T E R ------------->    
<?php include("includes/footer.inc"); ?>


 <?php include("includes/scripts.inc"); ?>
    
    <!-- Mijn eigen scripts -->
    <script src="js/chk_aanvraag.js"></script>
 </body>

</html>
