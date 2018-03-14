<?php
include_once('../config.php');
include_once('../classes/c_user.php');
/*
include_once('../classes/c_blog.php');
include_once('../classes/c_blog_coll.php');
*/


if (!isset($_SESSION['username']))
	header('location: index.php');

if (isset($_SESSION['userid']))
{
	$curr_user = new User ('id', $_SESSION['userid']);
} else
{
	$curr_user = new User ();
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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<link href="css/beheer_style.css" rel="stylesheet" type="text/css" /> 
	
<style>
	.blogblock {
		margin: 0px;
		font-size: large;
/* 		border: 1px solid black; */
		
	}
	.bloginfo {
		margin: 0px 0px 20px 0px;
/* 		padding: 20px; */
		border: 0px solid black;
		box-shadow: 4px 4px 20px black;
		background-color: #ececec;
	}
	.bloginfo table {
		margin: 10px 10px 10px 10px;
		border: 0px solid black;
		width: 100%;
	}
	.bloginfo td {
		border: 0px solid black;
		width: 50%;
	}
	
	.blogtext {
		margin: 0px;
		padding: 30px;
		border: 0px solid black;
		box-shadow: 4px 4px 20px black;
		background-color: #f7f7f7;
	}
	.bloglist {
		margin: 10px 0px 0px;
/* 		border: 1px solid black; */
		
	}
	.blogbutton {
		margin: 0px 0px 20px 0px;
/* 		border: 1px solid black; */
		padding: 10px;
		box-shadow: 4px 4px 20px black;
/* 		background-color: #CD853F; */
		cursor: hand;
		cursor: pointer;
	}
	.butcolor {
		background-color: #b6c8ff;
	}
	.citaat {
		font-family: courier, serif;
		margin: 0px 60px;
		font-size: small;
	}
</style>	
</head>

<body>
	<div class="container">
			<div class="headerline">Ingelogd als: <?php echo $_SESSION['username']; ?>
			</div>
		<div class="row header">
			<h1>Zoetermeerfonds beheer</h1>
		</div>
			<div class="row">
				<div class="col-sm-12">
					<ul id="myTab" class="nav nav-pills">
					   	<li>
					      	<a href="overz_aanvr.php">
					         Aanvragen
							</a> 
						</li>
					   	<li>
					      	<a href="overz_aanvragers.php">
					         Aanvragers
							</a> 
						</li>
						<li>
							<a href="overz_persons.php">
							 Personen
							</a>
						</li>
						<li>
							<a href="overz_organisaties.php">
							 Organisaties
							</a>
						</li>
						<li>
							<a href="overz_news.php">
							 Nieuwsitems
							</a>
						</li>
						<li class="active">
							<a href="blogs.php">
							 Blogs
							</a>
						</li>
						<li>
					      	<a href="index.php">
					         Uitloggen
							</a> 
						</li>
					</ul>
				</div>
			</div>
        <div class="row">
            <div class="text-center"><h2>Blogs</h2>
            </div>
        </div>
		<div class="row">
			<div class="col-sm-3">
				<div class="bloglist">
					<div class="blogbutton butcolor" id="but13">
						Zaterdag 21 oktober 2017<br/>
						Jan Geerdes
					</div>
					<div class="blogbutton" id="but12">
						Zaterdag 14 oktober 2017<br/>
						Jan Geerdes
					</div>
					<div class="blogbutton" id="but11">
						Zaterdag 7 oktober 2017<br/>
						Jan Geerdes
					</div>
					<div class="blogbutton" id="but10">
						Zaterdag 30 september 2017<br/>
						Jan Geerdes
					</div>
					<div class="blogbutton" id="but09">
						Zaterdag 23 september 2017<br/>
						Jan Geerdes
					</div>
					<div class="blogbutton" id="but08">
						Zaterdag 16 september 2017<br/>
						Jan Geerdes
					</div>
					<div class="blogbutton" id="but07">
						Zaterdag 9 september 2017<br/>
						Jan Geerdes
					</div>
					<div class="blogbutton" id="but06">
						Zaterdag 2 september 2017<br/>
						Jan Geerdes
					</div>
					<div class="blogbutton" id="but05">
						Zaterdag 26 augustus 2017<br/>
						Jan Geerdes
					</div>
					<div class="blogbutton" id="but04">
						Zaterdag 5 augustus 2017<br/>
						Jan Geerdes
					</div>
					<div class="blogbutton" id="but03">
						Zaterdag 29 juli 2017<br/>
						Jan Geerdes
					</div>
					<div class="blogbutton" id="but02">
						Zaterdag 22 juli 2017<br/>
						Jan Geerdes
					</div>
					<div class="blogbutton" id="but01">
						Zaterdag 15 juli 2017<br/>
						Jan Geerdes
					</div>
				</div>
			</div>
			<div class="col-sm-9">
				
<!-- nieuw blog block -->

				<div class="blogblock" id="txt170715">
					<div class="bloginfo">
						<table>
							<tr>
								<td>Jan Geerdes</td>
								<td>Zaterdag 15 juli 2017</td>
							</tr>
							<tr>
								<td colspan="2">Overzicht activiteiten week 26, 27 en 28 (25-6 t/m 15-7)</td>
							</tr>
						</table>
					</div>
					<div class="blogtext">
						<h3>Aanvragen</h3>
						<h4>Nieuwe aanvragen</h4>
<p>Sinds de laatste bestuursvergadering (15 juni jl.) zijn er 4 nieuwe aanvragen binnengekomen voor een totaal gevraagd bedrag van € 10.776,00.  Alle informatie erover staat op de ZF-beheerpagina. Belangrijk is dat 1718 en 1719 vóór 28 juli een eerste reactie moet zijn gegeven.
Mijn opmerkingen staan bij de aanvragen.</p>

<h4>Lopende aanvragen</h4>
<h5>BeterDeBus</h5>
<p>BeterDeBus heeft een plan opgesteld om de crowdfundactie succesvol te laten verlopen. De actie loopt van eind augustus tot eind september bij VoorJeBuurt.nl. <a href="https://www.dropbox.com/s/wvj6jmz1s5yo0xo/Projectplan%20crowdfunding%20restauratie%204352%20versie%20jul17-2.pdf?dl=0">Het plan</a> staat in de dropbox onder project 1629.</p>
<p>Binnenkort tekenen ze het contract zodat het eerste deel van de bijdrage kan worden overgemaakt.</p>
<h5>Koor Mozaiek</h5>
<p>Een gesprek met Leo Odijk en Han... de beoogd penningmeester , gaf duidelijkheid over de visie en de stand van zaken rond het koor. Doel is om zelfstandig te kunnen opereren en alleen voor eenmalige uitgaven een donatie aan te vragen. Het gesprek geeft een positieve indruk over het initiatief.</p>
<h5>Egelopvang</h5>
<p>Carla en ik zijn rondgeleid bij Egelopvang Zoetermeer. Met onze bijdrage is de onderwijstafel flink vernieuwd en weer klaar om gebruikt te worden bij de voorlichting over de egel en haar omgeving. Op diverse manieren is kenbaar gemaakt dat het Zoetermeerfonds heeft bijgedragen aan de onderwijstafel.</p>
<h3>Onderzoek 213a</h3>
<p>Het onderzoek is afgerond en de laatste stuurgroepbijeenkomst vond plaats op 7-7. De conclusie van de onderzoekers is niet bemoedigend. Hoewel er bij enkele afdelingen van de gemeente wel fors wordt ingezet op burgerparticipatie en samenspraak, blijken toch andere belangrijke afdelingen veel minder enthousiast (“Samenspraak is niet mijn core target, ik doe het er gewoon naast”). De stuurgroep, olv van Hennie Koek, was van mening dat er toch meer aandacht moet worden gegeven aan de resultaten en heeft daarom nog een vergadering gepland in september zodat het onderzoek formeel nog niet hoeft te worden opgeleverd en er nog ruimte is om het belang van de burgerpraticipatie en samenspraak onder de aandacht te brengen van B&W, de raad en de ambtenaren.</p>
<h3>Het LIB/forum</h3>
<p>Inmiddels heb ik van het LIB/forum een deelnamevoorstel ontvangen om mee te doen met het publieksplein. Het voorstel staat in de dropbox onder deze <a href="https://www.dropbox.com/s/ijxc450c89v179j/BASIS%20-%20Zoetermeerfonds%20concept%20overeenkomst%2020170711.docx?dl=0">link</a>. Mijn voorstel is om hier positief op te beslissen. Het geeft het Zoetermeerfonds de kans opgenomen te worden tussen de gevestigde instanties in Zoetermeer en zo mee te denken en kunnen praten over zaken die ons allemaal aangaan. De kosten van € 500,= per jaar zijn dat mijns inziens zeker waard.</p>
<h3>Organisatie avond van het maatschappelijk initiatief</h3>
<p>Ik ben gestart met het regelen van een bijeenkomst van de organisaties in Zoetermeer die zich bezighouden met inwonersinitiatieven, zoals BizKwadraat en de Stadsambassade. Helaas krijg ik weinig respons waarschijnlijk omdat het vakantietijd is. Mijn voorstel is om de avond eind september te houden. We moeten een thema bedenken die de gewenste doelgroep aanspreekt. D.w.z. als we nieuwe initiatiefnemers zoeken dan moeten we praten over de mogelijkheden en bijdragen die we kunnen leveren. Als we bestaande initiatieven zoeken dan gaat het vooral om uitwisseling van contacten en ervaringen. En evt. mogelijkheden tot aanvullende bijdragen.
Als we ook de gemeente willen betrekken bij de avond is het laatstgenoemde idee waarschijnlijk beter omdat er dan ook meer wisselwerking zal zijn tussen inwoners en gemeentepersoneel.</p>
<h3>Website</h3>
<p>Het aanvraagformulier is uitgebreid zodat nu duidelijk kan worden aangegeven of de aanvraag namens een organisatie wordt ingediend of op persoonlijke titel.
Nog in ontwikkeling is de blogpagina waarop deze informatie 2 wekelijks zal verschijnen.</p>
<h3>Todo lijst</h3>
<p>Op de todo lijst staat:</p>
<ul>
<li>Nieuwsbrief (in week ...)</li>
<li>Facebook acties</li>
<li>De avond van het initiatief: Je Eigen Broek Ophouden (EBO), waarom en hoe?</li>
</ul>
					</div>
				</div>
				
<!-- nieuw blog block -->

				<div class="blogblock" id="txt170722">
					<div class="bloginfo">
						<table>
							<tr>
								<td>Jan Geerdes</td>
								<td>Zaterdag 22 juli 2017</td>
							</tr>
							<tr>
								<td colspan="2">Overzicht activiteiten week 29 (16-7 t/m 22-7)</td>
							</tr>
						</table>
					</div>
					<div class="blogtext">
<h3>Stadsambassade</h3>
<p>Deze week werd bekend dat de Stadsambassade Zoetermeer zichzelf heeft opgeheven. D.w.z. alle activiteiten worden gestaakt.</p>
<p>Jakobien, voorzitter van de stadsambassade, stuurde de volgende email:</p>
<div class="citaat"><p>Beste relatie,</p>

<p>Het bestuur van de Stadsambassade Zoetermeer heeft besloten op dit moment te stoppen met haar activiteiten. De stichting Stadsambassade Zoetermeer gaat daarmee in „slaapstand” (wordt niet juridisch opgeheven).</p>

<p>Op dit moment voelen wij helaas te weinig energie en ruimte, zowel binnen als buiten de gemeente, om verder te gaan. Dat heeft zeker niet alleen met geld/subsidie te maken, maar ook met het gevoel om iets waardevols bij te kunnen dragen aan de stad. Alsmede met het verkrijgen van een goede ondersteuning door en samenwerking met de gemeente en positionering in het "participatie-landschap" in Zoetermeer. Dat gevoel ontbreekt helaas op dit moment, waardoor wij hebben besloten onze activiteiten te staken voor dit moment.</p>

<p>We danken u hartelijk voor de getoonde belangstelling en/of samenwerking.</p>

<p>Voor vragen kunt u bellen met Jakobien Groeneveld (voorzitter Stadsambassade Zoetermeer): 06-48957741</p>

<p>Met vriendelijke groet,</p>

<p>Jakobien Groeneveld</p>
</div>
<p>Ik heb Jakobien direct gebeld en een voicemail ingesproken maar ik heb nog geen reactie gehad.</p>
<p>Persoonlijk denk ik dat de Stadsambassade zich vooral richtte op activiteiten rond de Dorpsstraat en de wijktuinen. Die eerste neigen al snel naar een wat meer commerciële richting, de laatste liggen nogal voor de hand en hebben feitelijk nauwelijks hulp van buiten nodig (behalve wat geld zo nu en dan ;-)</p>
<p>Het wegvallen van de Stadsambassade is voor het Zoetermeerfonds zowel een verlies (want minder medestanders op het gebied van burgerparticipatie) als een kans om ons te profileren als de enige, echte burgerorganisatie op het gebied van maatschappelijke initiatieven en burgerparticipatie in Zoetermeer. In de gesprekken naar de gemeente kunnen we hier gebruik van maken, denk ik</p>

<h3>BeterDeBus</h3>
<p>Vrijdag 21-7 heb ik een ontmoeting gehad met Nick Roestenburg en Bas de Bruijn van stichting BeterDeBus. Zij hebben <a href="https://www.dropbox.com/s/wvj6jmz1s5yo0xo/Projectplan%20crowdfunding%20restauratie%204352%20versie%20jul17-2.pdf?dl=0">een plan</a> opgesteld om de crowdfundactie zo succesvol mogelijk te laten verlopen. Dit plan staat inmiddels in de dropbox. Zij hebben ook een Facebook pagina en krijgen enthousiaste reacties op hun initiatief van o.a. oud-buschauffeurs die ooit met de bus hebben gereden en nu graag bereid zijn zich in te zetten voor BeterDeBus.</p>
<p>Wij moeten nog kijken hoe we met de juiste acties en geldstortingen hun crowdfundactie kunnen ondersteunen.</p>

<h3>Todo lijst</h3>
<p>Op de todo lijst staat:</p>
<ul>
<li>Nieuwsbrief (in week ...)</li>
<li>De avond van het initiatief: Je Eigen Broek Ophouden (EBO), waarom en hoe? Hiervoor staat inmiddels een afspraak gepland met BizKwadraat en Rens Schipper.</li>
</ul>
					</div>
				</div>
				
<!-- nieuw blog block -->

				<div class="blogblock" id="txt170729">
					<div class="bloginfo">
						<table>
							<tr>
								<td>Jan Geerdes</td>
								<td>Zaterdag 29 juli 2017</td>
							</tr>
							<tr>
								<td colspan="2">Overzicht activiteiten week 30 (23-7 t/m 29-7)</td>
							</tr>
						</table>
					</div>
					<div class="blogtext">
						<h3>Stadsambassade</h3>
						<p>Dinsdag telefonisch gesproken met Jakobien Groeneveld, voorzitter van de Stadsambassade. Haar verhaal: de Stadsambassade bestaat nu ongeveer een jaar en nog geen enkele doelstelling is gehaald. In februari had het bestuur een goed gesprek met 
							Robin Paalvast en Thierry Limonet waarbij toezeggingen werden gedaan mbt subsidies etc. Zij hebben een plan ingediend en vervolgens bleek de gemeente, na maanden radiostilte, het plan nauwelijks serieus te nemen en was er van een duidelijke financiële ondersteuning geen
							sprake meer.</p>
						<p>Inmiddels hebben andere activiteiten een hogere prioriteit gekregen, zoals de naderende gemeenteraadsverkiezingen en is besloten de Stadsambassade op non-actief te zetten. Mogelijk dat ze later opnieuw actief worden.</p>
						<h3>Initiatieven gala</h3>
						<p>Donderdag overleg gehad met Rens Schipper, betrokken bij DEZO, de Stadsambassade en de Dag van de Duurzaamheid, en met Flip Bakker van BizKwadraat. Gesproken over de stand van zaken rond burgerparticipatie en de gemeente. 
							Rens bevestigde het verhaal rond de Stadsambassade. Het schijnt dat uiteindelijk Aptroot zelf heeft ingegrepen bij de subsidieverstrekking. Ook Thierry Limonet speelt hierin een rol.</p>
						<p>Met Rens en Flip besproken wat de mogelijkheden zijn gezamenlijk op te trekken als het gaat om initiatiefnemers en aspirant-initiatiefnemers in Zoetermeer. Rens is betrokken bij de organisatie van de Dag van de Duurzaamheid. 
							Die wordt gehouden op zaterdag 8 oktober (want 10 oktober is de eigenlijke Dag van de Duurzaamheid). De voorbereiding is al in volle gang en daarbij worden ook vele initiatieven uit Zoetermeer bij betrokken, vooral die uit de groene en duurzame hoek natuurlijk. 
							Op diverse plekken in de stad worden dan bijeenkomsten georganiseerd, o.a. de Archonstraar en bij de Nicolaaskerk.</p>
						<p>Mijn voorstel is daar bij aan te sluiten. Als onderdeel van de Dag van de Duurzaamheid (waarbij deze naam natuurlijk de lading niet meer dekt) kunnen wij in Brood & Rozen het Initiatieven Gala organiseren. Een agenda kan er als volgt uit zien:</p>
						<ul>
							<li>Welkomswoord door de voorzitter van het fonds</li>
							<li>10 minuten introductie en toelichting door een stakeholder (wethouder oid)</li>
							<li>Voorgerecht</li>
							<li>20 minuten motivational speech door een 'deskundige' (initiatievenmakelaar?)</li>
							<li>Hoofdgerecht</li>
							<li>30 minuten Discussieronde/vragenronde/discussiepanel o.i.d.</li>
							<li>Nagerecht + koffie</li>
							<li>Nabespreking etc.</li>
						</ul>
						<p>Duur bij elkaar zo'n 2 uur, van 17:00h tot 19:00h met uitloop van een half uur.
						Eten laten verzorgen door Piëzo.</p>
						<p> Aan de Dag van de Duurzaamheid wordt voldoende ruchtbaarheid gegeven, o.a. door PR-bureau Talk of the Town. Ook daarbij kunnen wij helpen.</p>
						<p>Ik heb Rens gevraagd bij het fonds een aanvraag in te dienen zodat wij ook als sponsor kunnen worden genoemd voor de dag.</p>
						<p>Wellicht lastig: de Dag van de Duurzaamheid gaat ook echt om duurzaamheid, dus het milieu staat centraal. Een belangrijk onderwerp maar toch ook voor een beperkte doelgroep. Veel mensen vinden het belangrijk maar niet genoeg om er zelf voor in actie te komen. 
							Van alle aanvragen die het Zoetermeerfonds tot nu toe 
							heeft binnengekregen kan er slechts 1 (één!) enigszins worden toegewezen aan de categorie Duurzaam in brede zin, nl. de Egelopvang. Alle andere, toegekend of afgewezen, hebben niets met Duurzaam van doen.</p>
						</p>
					</div>
				</div>

<!-- nieuw blog block -->

				<div class="blogblock" id="txt170805">
					<div class="bloginfo">
						<table>
							<tr>
								<td>Jan Geerdes</td>
								<td>Zaterdag 5 augustus 2017</td>
							</tr>
							<tr>
								<td colspan="2">Overzicht activiteiten week 31 (30-7 t/m 5-8)</td>
							</tr>
						</table>
					</div>
					<div class="blogtext">
						<h3>Aanvragen</h3>
						<p>Opmerkingen staan bij de aanvragen.</p>
						<h3>Gesprek Coen Helderman</h3>
						<p>Dinsdagochtend gesproken met Coen Helderman, net terug van vakantie. Volgens Coen liggen alle opties nog open. Het feit dat wij met een aantal hoofdrolspelers afspraken hebben en krijgen, kan alleen in ons voordeel werken volgens hem. Paalvast wil nog steeds doorgaan maar ondervindt wel
							meer weerstand binnen B&W. Coen gaat weer proberen te masseren.</p>
						<p>Ik wil hem ook graag betrekken bij het Initiatievengala. De bedoeling is dat het gala door zoveel mogelijk belanghebbende partijen wordt ondersteund maar dat wij de regie houden. Ik denk dat dat goed gaat lukken. Als jullie ideeën hebben voor de avond hoor ik dat graag natuurlijk.</p>
						</p>
					</div>
				</div>

<!-- nieuw blog block -->

				<div class="blogblock" id="txt170826">
					<div class="bloginfo">
						<table>
							<tr>
								<td>Jan Geerdes</td>
								<td>Zaterdag 26 augustus 2017</td>
							</tr>
							<tr>
								<td colspan="2">Overzicht activiteiten week 34 (19-7 t/m 26-8)</td>
							</tr>
						</table>
					</div>
					<div class="blogtext">
						<h3>Aanvragen</h3>
						<p>Gedurende mijn vakantie zijn er een drietal aanvragen binnengekomen. Ik heb ze direct vluchtig bekeken en klaar gezet ter inzage zodat iedereen direct commentaar kan leveren. Weliswaar is daar geen gebruik gemaakt maar dat mag de pret niet deren ;-)</p>
						<p>Opmerkingen staan bij de aanvragen.</p>
						<h3>Organisatie Initiatievengala</h3>
						<p>
							Woensdag overleg gehad met Rens Schipper en met Flip Bakker. Flip haakt af vanwege drukke werkzaamheden elders. Rens en ik gaan het gala organiseren.
							Voorlopig ziet het evenement er als volgt uit:</p>
							<ul>
							<li>Het 'gala' wordt gehouden op vrijdagavond 6 oktober van 18:30h tot 21:30h. </li>
							<li>Het vindt plaats in Brood & Rozen (maar er is een alternatieve ruimte)</li>
							<li>Belangrijkste onderwerp: de uitkomsten van het 213a onderzoek door de gemeente</li>
							<li>Presentaties door het ZF, Whiteboxing, de gemeente.</li>
							<li>Tijdens de avond wordt gegeten (iemand een idee om dat goed te regelen?)</li>
							<li>Initiatiefnemers worden uitgenodigd</li>
							<li>De wethouder wordt uitgenodigd</li>
							<li>Gemeenteraadsleden worden uitgenodigd</li>
							<li>Er dient ruimte voor discussie te zijn met mogelijk een discussietafel.</li>
							<li>We zoeken een goede discussieleider (inhuren?)</li>
							</ul>
						<p>Graag commentaar via email.</p>
						<h3>Gesprek met Coen (25-8)</h3>
						<p>Met Coen bijgepraat over de laatste stand van zaken bij de gemeente. Hij vertelde dat de wethouder die ochtend telefonisch had gesproken met Edith en dat om die reden het embargo over de uitkomsten van het college-overleg
							zijn komen te vervallen. Hij mocht dus uitleggen wat er uit het overleg is voortgekomen. Aangezien ik van het bestuur nog geen nadere info heb gekregen, wacht ik vooralsnog even af hoe het verder gaat.</p>
						<p>We hebben uitgebreid gesproken over het te houden Initiatievengala en ik heb hem gevraagd namens de gemeente mee te helpen aan de voorbereiding. Het eindrapport van de het 213a onderzoek is eigendom van de gemeente. Echter, 
							in september wordt het definitieve rapport opgeleverd en naar de raad gestuurd. Hiermee krijgt het een openbaar karakter en mogen wij er dus over praten en behandelen in een bijeenkomst.</p>
						</p>
						<h3>Bijeenkomst wijktuin Hof van Segwaert</h3>
						<p>Afgelopen vrijmiddag ben ik aanwezig geweest van de opening van een gebouw voor de wijktuin Hof van Segwaert, de perenboomgaard. Daarbij werd ook een 10-jarige gebruiksovereenkomst getekend door wethouder Vugs. Ik heb daar diverse 
							mensen gesproken waaronder de directeur van Fonds1818, Boudewijn de Blij en wijkmanager Peter Collignon. 
						</p>
					</div>
				</div>

<!-- nieuw blog block -->

				<div class="blogblock" id="txt170902">
					<div class="bloginfo">
						<table>
							<tr>
								<td>Jan Geerdes</td>
								<td>Zaterdag 2 september 2017</td>
							</tr>
							<tr>
								<td colspan="2">Overzicht activiteiten week 35 (27-8 t/m 2-9)</td>
							</tr>
						</table>
					</div>
					<div class="blogtext">
						<h3>Aanvragen</h3>
						<p>Er is één nieuwe aanvraaag binnengekomen deze week.</p>
						<p>Opmerkingen staan bij de aanvragen.</p>
<!--
						<h3>Organisatie Initiatievengala</h3>
						<p>
							Woensdag overleg gehad met Rens Schipper en met Flip Bakker. Flip haakt af vanwege drukke werkzaamheden elders. Rens en ik gaan het gala organiseren.
							Voorlopig ziet het evenement er als volgt uit:</p>
							<ul>
							<li>Het 'gala' wordt gehouden op vrijdagavond 6 oktober van 18:30h tot 21:30h. </li>
							<li>Het vindt plaats in Brood & Rozen (maar er is een alternatieve ruimte)</li>
							<li>Belangrijkste onderwerp: de uitkomsten van het 213a onderzoek door de gemeente</li>
							<li>Presentaties door het ZF, Whiteboxing, de gemeente.</li>
							<li>Tijdens de avond wordt gegeten (iemand een idee om dat goed te regelen?)</li>
							<li>Initiatiefnemers worden uitgenodigd</li>
							<li>De wethouder wordt uitgenodigd</li>
							<li>Gemeenteraadsleden worden uitgenodigd</li>
							<li>Er dient ruimte voor discussie te zijn met mogelijk een discussietafel.</li>
							<li>We zoeken een goede discussieleider (inhuren?)</li>
							</ul>
						<p>Graag commentaar via email.</p>
-->
						<h3>Gesprek met Peter van Oppen, voorzitter van DEZo (28-8)</h3>
						<p>Uitgebreid gesprek met Peter over diverse onderwerpen, waaronder het verloop van contacten bij de gemeente en over de MVOZ.</p>
						<h3>Gesprek Marijke van der Meer (Zo!Zoetermeer, 29-8)</h3>
						<p>Doel van het gesprek was (politieke)steun te krijgen voor het ZF. Dat is maar gedeeltelijk gelukt. Marijke probeerde vooral mij te ronselen voor haar partij. Verder een aangenaam gesprek</p> 
						<h3>Gesprek Mark Neijssel (Zoetermeer Actief, 29-8)</h3>
						<p>Gesproken over de rol die ZA kan spelen bij PR voor het ZF en de wens van ZA snel op de hoogte te worden gebracht van initiatieven.</p>
						<h3>Overige punten van aandacht</h3>
						<p>Afgelopen donderdagavond heeft de maandelijkse bestuursvergadering plaatsgevonden. Behalve het behandelen van 6 nieuwe aanvragen was de subsidie over 2017 van de gemeente het belangrijkste onderwerp. Hierover is meer te vinden in de 
							email.</p>
						<p>Vrijdagmiddag gesproken met Coen Helderman en Rens Schipper over het Initiatievengala op 6 oktober a.s.</p>
						<?php include ('includes/projecten20170902.htm'); ?>
					</div>
				</div>

<!-- nieuw blog block -->

				<div class="blogblock" id="txt170909">
					<div class="bloginfo">
						<table>
							<tr>
								<td>Jan Geerdes</td>
								<td>Zaterdag 9 september 2017</td>
							</tr>
							<tr>
								<td colspan="2">Overzicht activiteiten week 36 (3-9 t/m 9-9)</td>
							</tr>
						</table>
					</div>
					<div class="blogtext">
						<h3>Aanvragen</h3>
						<p>Er zijn nog geen nieuwe aanvragen binnengekomen deze week.</p>
						<h3>Voorbereiding Initiatieven Gala</h3>
						<p>Deze week behoorlijk wat tijd besteed aan het bekendmaken van het Gala via FB en de website. Ook de aanmeldprocedure opzetten kostte een paar dagen tijd.</p>
						<p>Vanaf deze week kunnen mensen zich aanmelden voor het gala.</p>
					</div>
				</div>

<!-- nieuw blog block -->

				<div class="blogblock" id="txt170916">
					<div class="bloginfo">
						<table>
							<tr>
								<td>Jan Geerdes</td>
								<td>Zaterdag 16 september 2017</td>
							</tr>
							<tr>
								<td colspan="2">Overzicht activiteiten week 37 (10-9 t/m 16-9)</td>
							</tr>
						</table>
					</div>
					<div class="blogtext">
						<h3>Aanvragen</h3>
						<p>Er zijn nog geen nieuwe aanvragen binnengekomen deze week.</p>
						<h3>Voorbereiding Initiatieven Gala</h3>
						<p>Ook deze week stond in het teken van de voorbereidingen. Het opstellen van een uitnodiging voor de bij ons bekende aanvragers.</p>
						<p>Op dit moment werk ik aan een nieuwsbriefachtige uitnodiging. Ook moet een persbericht komen met de aankondiging. Het uitnodigen van de mensen
							van de gemeente vraagt bijzondere aandacht.
						</p>
					</div>
				</div>
				
<!-- nieuw blog block -->

				<div class="blogblock" id="txt170923">
					<div class="bloginfo">
						<table>
							<tr>
								<td>Jan Geerdes</td>
								<td>Zaterdag 23 september 2017</td>
							</tr>
							<tr>
								<td colspan="2">Overzicht activiteiten week 38 (17-9 t/m 23-9)</td>
							</tr>
						</table>
					</div>
					<div class="blogtext">
						<h3>Aanvragen</h3>
						<p>Er is deze week één aanvraag binnengekomen.</p>
						<h3>Voorbereiding Initiatieven Gala</h3>
						<p>De Facebook advertentie geeft (te) weinig response. Nog onduidelijk waaraan dat ligt. Misschien is de tekst niet wervend genoeg. 
							Het kan verstandig zijn om in de laatste week voor de avond nog een nieuwe advertentie te maken en deze flink in te zetten.
						</p>
						<p>Het loopt niet storm met aanmeldingen. In ieder geval valt het mij wat tegen. Maar ik ben er dan ook druk mee en kijk bijna ieder uur of er nog iets 
							gebeurd is ;-).
						</p>
						<h3>Gesprek met wethouder Kuiper</h3>
						<p>Afgelopen donderdag (21-9) een gesprek gehad met Taco Kuiper. Om deze afspraak had ik gevraagd toen nog niet bekend was dat Paalvast zijn voorstel rond de subsidie
							niet in het college zou indienen. M.a.w. ik wist dat Taco niet erg op de hoogte zou zijn van alles rond het Zoetermeerfonds. Ik heb de afspraak toch door laten gaan.</p>
						<p>Bij het gesprek waren nog twee mensen aanwezig, op verzoek van de wethouder, Coen en nog een dame, wier naam ik even kwijt ben.</p>
						<p>Het gesprek verliep enigszins moeizaam. Taco is een nogal formele man en aangezien ik wat op de vlakte wilde blijven om Paalvast wat te ontzien bleef het voor hem wat onduidelijk
							waarvoor ik eigenlijk kwam. Hij was echt in de veronderstelling dat ik meer geld wilde en toen ik zei dat dat niet het geval was, was hij een beetje van z'n apropos.</p>
						<p>Wat mij wel wat irriteerde is dat ik mij lijk te moeten verdedigen voor het feit dat ik nu betaald werk verricht. Je motivatie om dat werk te doen wordt daarmee direct in twijfel getrokken lijkt het.
							Maar het kan natuurlijk ook zijn dat ik dat verkeerd zie ;-).</p>
					</div>
				</div>
				
<!-- nieuw blog block -->

				<div class="blogblock" id="txt170930">
					<div class="bloginfo">
						<table>
							<tr>
								<td>Jan Geerdes</td>
								<td>Zaterdag 30 september 2017</td>
							</tr>
							<tr>
								<td colspan="2">Overzicht activiteiten week 39 (24-9 t/m 30-9)</td>
							</tr>
						</table>
					</div>
					<div class="blogtext">
						<h3>Aanvragen</h3>
						<p>Er kwamen op 26-9 10 nieuwe aanvragen binnen. Allemaal betreffende hetzelfde evenement: de Winterfair in het Stadshart. Zie verder bij de aanvragen zelf.</p>
						<h3>Voorbereiding Initiatieven Gala</h3>
						<p>De aanmeldingen druppelen binnen. Inmiddels hebben alle mensen die zich ooit hebben ingeschreven voor de nieuwsbrief een uitnodiging ontvangen.</p>
						<p>Op maandag is een persbericht uitgegaan naar het Streekblad en naar de Postiljon. Van beide heb ik nog geen reactie ontvangen. Geen idee of dat goed gaat dus.</p>
						<p>Op de website doemee.zoetermeer.nl staat inmiddels dat de avond wordt georganiseerd. Thierry gaat er achteraan om meer gepubliceerd te krijgen.</p>
						<h3>Bijeenkomst Forum-organisaties (in de nieuwe bibliotheek)</h3>
						<p>Op maandagavond was er een voorlichtingsavond over hoe het Publieksplein (het Forum) in de nieuwe bibliotheek wordt georganiseerd. Het Zoetermeerfonds is ingedeeld bij het thema Educatie
							& Ontwikkeling. De avond werd druk bezocht en bij de kennismakingen werd enthousiast gereageerd op mijn toelichtingen. Ik heb een aantal
							visitekaartjes uitgedeeld.</p>
						</p>
					</div>
				</div>
<!-- einde blog block -->				
				
<!-- nieuw blog block -->

				<div class="blogblock" id="txt171007">
					<div class="bloginfo">
						<table>
							<tr>
								<td>Jan Geerdes</td>
								<td>Zaterdag 7 oktober 2017</td>
							</tr>
							<tr>
								<td colspan="2">Overzicht activiteiten week 40 (1-10 t/m 7-10)</td>
							</tr>
						</table>
					</div>
					<div class="blogtext">
						<h3>Aanvragen</h3>
						<p>Er kwamen deze week geen nieuwe aanvragen binnen.</p>
						<h3>Voorbereiding Initiatieven Gala</h3>
						<p>De laatste week voor het Gala. Diverse keren verdere afstemming met Rens. Maar vooral ook met Brenda over de catering.</p>
						<p>Voorbereiding van mijn (korte) presentatie. Lastig, want als initiatievenmakelaar heb ik genoeg ideeën om uit te werken maar afstemming met zowel het bestuur
							als met de gemeente laat op zich wachten. Om die reden wil ik presentatie enigszins op de vlakte houden.
						</p>
						<p>Aan het eind van de week blijkt dat de persberichten de lokale kranten niet gehaald hebben. Ik heb geen idee waarom dat is. Het blijft verstandig om op zoek te blijven gaan naar een vrijwilliger
							die meer verstand heeft van Public Relations.</p>
						</p>
						<h3>Voorbespreking met Marije</h3>
						<p>Donderdagochtend heb ik een voorbespreking gehad met Marije van den Berg over haar presentatie voor het Gala. Inmiddels is met haar afgestemd dat zij haar rekening voor de avond rechtstreeks naar de gemeente zal sturen.</p>
						<p>Marije geeft aan dat ze kritisch is naar zowel de gemeente (wel goede wil, te weinig echte daden) als naar de burgerinitiatieven (ook zonder de gemeente is veel mogelijk).</p>
						<h3>6 oktober: het Initiatieven Gala!</h3>
						<p>De avond kent een prima verloop. De opkomst is hoog, Brood & Rozen is gevuld met meer dan 60 mensen, zo'n beetje het maximum wat er met goed fatsoen in kan. De presentaties worden goed ontvangen, evenals het eten. Ik heb
							van meerdere kanten complimenten gekregen over de avond.
						</p>
					</div>
				</div>
<!-- einde blog block -->				
<!-- nieuw blog block -->

				<div class="blogblock" id="txt171014">
					<div class="bloginfo">
						<table>
							<tr>
								<td>Jan Geerdes</td>
								<td>Zaterdag 14 oktober 2017</td>
							</tr>
							<tr>
								<td colspan="2">Overzicht activiteiten week 41 (8-10 t/m 14-10)</td>
							</tr>
						</table>
					</div>
					<div class="blogtext">
						<h3>Aanvragen</h3>
						<p>Er kwam 1 nieuwe aanvraag binnen.</p>
						<h3>Aftermath</h3>
						<p>Deze week blijven de goede recenties mbt het Gala binnendruppelen. Op disndagavond bezoek ik een vergadering van de commissie Samenleving dat discussieert over het Cultuurfonds. Aanwezig zijn o.a. Marijke van der Meer en Robin Paalvast. 
							Die laatste komt naar me toe en vertelt dat hij goede berichten over het Gala heeft gehoord en verontschuldigt zich nogmaals dat hij niet aanwezig kon zijn.
						</p>
						<p>De discussie over het Cultuurfonds, dat het Zoetermeerfonds indirect ook raakt, eindigt met de vaststelling dat de wethouder zich niet aan de regels heeft gehouden. Het Cultuurfonds zelf valt in deze niets te verwijten.</p>
						<h3>Contacten</h3>
						<p>Deze week met diverse initiatiefnemers gesproken. O.a. Bas Ter Burg en Astrid Amendola.</p>
						</p>
						<h3>Initiatievenmakelaar en de gemeente</h3>
						<p>Op 12-10 had ik de eerste bespreking als Initiatievenmakelaar met de wijkregisseurs en de aanjagers van de gemeente. Duidelijk is dat deze mensen enigszins afwachtend zijn vwb mijn rol als IM. Ga ik onder hun duiven schieten?</p>
						<p>Uiteraard zijn ze wel nieuwsgierig naar wat het ZF tot nu toe heeft gedaan en om die reden stel ik voor dat ze, als het bestuur daarmee instemt, toegang krijgen tot het bestand met aanvragen. Ook zullen we op basis van initiatieven verder met elkaar in overleg trreden.
						</p>
						<h3>Laatste stuurgroepvergadering mbt 213a-onderzoek op 12-10</h3>
						<p>In de laatste stuurgroepvergadering (aanwezig o.a. Coen en Hennie Koek) bespreken we kort de resultaten van het onderzoek. Hennie geeft aan dat het rapport ook al besproken is in het college en dat daar erg positief op gereageerd werd.
							Zij is hoopvol over de conclusies die worden getrokken uit de het rapport mbt tot samenspraak en burgerparticipatie. Wat dat dan concreet in zou kunnen houden blijft volkomen onduidelijk. Dat dan weer wel.</p>

						<h3>Voorbereiding Initiatieven spreekuur</h3>
						<p>Samen met Fonds1818, het Cultuurfonds en het Oranje fonds organiseren we een Initiatievenspreekuur op dinsdagavond 7 november a.s. in het Woonhart, in het eetcafé van Iedereen Een Maaltijd.</p>
						<p>Deze week starten we het overleg en bekijken we hoe we daar ruchtbaarheid aan kunnen geven.</p>
					</div>
				</div>
<!-- einde blog block -->				
<!-- nieuw blog block -->

				<div class="blogblock" id="txt171021">
					<div class="bloginfo">
						<table>
							<tr>
								<td>Jan Geerdes</td>
								<td>Zaterdag 21 oktober 2017</td>
							</tr>
							<tr>
								<td colspan="2">Overzicht activiteiten week 42 (15-10 t/m 21-10)</td>
							</tr>
						</table>
					</div>
					<div class="blogtext">
						<h3>Aanvragen</h3>
						<p>Er kwam 1 nieuwe aanvraag binnen.</p>
						<h3>Korte week</h3>
						<p>Deze week heb ik een korte vakantie. </p>
						<h3>Voorbereiding Initiatieven spreekuur</h3>
						<p>In samenwerking met de anderen stellen we een korte nieuwsbrief op en die verstuur ik naar de pakweg 150 adressen die we inmiddels hebben. Aanmeldingen vinden plaats via de Cultuurmakelaar dus
							ik verwacht geen directe respons op de brief.
						</p>
					</div>
				</div>
<!-- einde blog block -->				

			</div>
		</div>
	</div>
    <div class="container">
			<div class="row footer">
			<br/>
			&copy 2018 Zoetermeerfonds
		</div>
	</div>
</body>
<script>
$("document").ready(function() {
	$('.blogblock').hide();
	$('#txt171021').show();

	$("#but01").click(function (){
			$('.blogbutton').removeClass('butcolor');	
			$('.blogblock').hide();
			$('#txt170715').show();
			$(this).addClass('butcolor');
			});
	$("#but02").click(function (){
			$('.blogbutton').removeClass('butcolor');	
			$('.blogblock').hide();
			$('#txt170722').show();
			$(this).addClass('butcolor');
			});
	$("#but03").click(function (){
			$('.blogbutton').removeClass('butcolor');	
			$('.blogblock').hide();
			$('#txt170729').show();
			$(this).addClass('butcolor');
			});
	$("#but04").click(function (){
			$('.blogbutton').removeClass('butcolor');	
			$('.blogblock').hide();
			$('#txt170805').show();
			$(this).addClass('butcolor');
			});
	$("#but05").click(function (){
			$('.blogbutton').removeClass('butcolor');	
			$('.blogblock').hide();
			$('#txt170826').show();
			$(this).addClass('butcolor');
			});
	$("#but06").click(function (){
			$('.blogbutton').removeClass('butcolor');	
			$('.blogblock').hide();
			$('#txt170902').show();
			$(this).addClass('butcolor');
			});
	$("#but07").click(function (){
			$('.blogbutton').removeClass('butcolor');	
			$('.blogblock').hide();
			$('#txt170909').show();
			$(this).addClass('butcolor');
			});
	$("#but08").click(function (){
			$('.blogbutton').removeClass('butcolor');	
			$('.blogblock').hide();
			$('#txt170916').show();
			$(this).addClass('butcolor');
			});
	$("#but09").click(function (){
			$('.blogbutton').removeClass('butcolor');	
			$('.blogblock').hide();
			$('#txt170923').show();
			$(this).addClass('butcolor');
			});
	$("#but10").click(function (){
			$('.blogbutton').removeClass('butcolor');	
			$('.blogblock').hide();
			$('#txt170930').show();
			$(this).addClass('butcolor');
			});
	$("#but11").click(function (){
			$('.blogbutton').removeClass('butcolor');	
			$('.blogblock').hide();
			$('#txt171007').show();
			$(this).addClass('butcolor');
			});
	$("#but12").click(function (){
			$('.blogbutton').removeClass('butcolor');	
			$('.blogblock').hide();
			$('#txt171014').show();
			$(this).addClass('butcolor');
			});
	$("#but13").click(function (){
			$('.blogbutton').removeClass('butcolor');	
			$('.blogblock').hide();
			$('#txt171021').show();
			$(this).addClass('butcolor');
			});
	});
</script>
</html>

