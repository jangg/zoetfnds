<?php
include_once ('config.php');
include_once ('classes/c_stelling.php');
include_once ('classes/c_optie.php');

$stellingenArray = array();
$optieArray = array();

// --------
$stelling = new Stelling ();
$stelling->id = 1;
$stelling->tekst = 'Waar woon je?';
$stelling->gewicht = 100;
// $stelling->opties = array();

$optie = new Optie ();
$optie->id = 1;
$optie->id_stelling = $stelling->id;
$optie->volgnr = 1;
$optie->antw_tekst = 'Je woont in de omgeving van Zoetermeer.';
$optie->toelicht_tekst = 'Als je geen inwoner bent van de gemeente Zoetermeer mag je helaas geen aanvraag indienen bij het Zoetermeerfonds. Als je toch iets wil betekenen voor Zoetermeer kun je er bv. voor
zorgen dat je samenwerkt met aanvragers die wel in Zoetermeer wonen.';
$optie->score = 0;
$optieArray[] = $optie;
// echo $optieArray[0];

$optie = new Optie ();
$optie->id = 2;
$optie->id_stelling = $stelling->id;
$optie->volgnr = 2;
$optie->antw_tekst = 'Je woont in de gemeente Zoetermeer.';
$optie->toelicht_tekst = 'Uitstekend, je voldoet aan deze voorwaarde.';
$optie->score = 1;
$optieArray[] = $optie;
// echo $optieArray[1];

$optie = new Optie ();
$optie->id = 3;
$optie->id_stelling = $stelling->id;
$optie->volgnr = 3;
$optie->antw_tekst = 'Je woont niet in Zoetermeer maar je hebt wel een binding met deze gemeente (bijv. omdat je er werkt).';
$optie->toelicht_tekst = 'Helaas, dat is niet voldoende. Het Zoetermeerfonds is er specifiek voor inwoners van Zoetermeer. Als je toch iets wil betekenen voor Zoetermeer kun je er bv. voor
zorgen dat je samenwerkt met aanvragers die wel in Zoetermeer wonen.';
$optie->score = 0;
$optieArray[] = $optie;
// echo $optieArray[2];

$optie = new Optie ();
$optie->id = 23;
$optie->id_stelling = $stelling->id;
$optie->volgnr = 4;
$optie->antw_tekst = 'Anders';
$optie->toelicht_tekst = 'Helaas, je kunt geen aanvraag indienen bij het Zoetermeerfonds.';
$optie->score = 0;
$optieArray[] = $optie;
// echo $optieArray[2];

$stelling->opties = $optieArray;
$stellingenArray[] = $stelling;
// echo $stellingenArray[0];
// --------

// --------
$stelling = new Stelling ();
$stelling->id = 2;
$stelling->tekst = 'Vraag je een bijdrage aan als individu of maak je deel uit van een groep of organisatie?';
$stelling->gewicht = 200;
unset($optieArray);
$optieArray = array();

$optie = new Optie ();
$optie->id = 4;
$optie->id_stelling = $stelling->id;
$optie->volgnr = 1;
$optie->antw_tekst = 'Ik dien op persoonlijke titel een plan in en ga dat zelf uitvoeren. Daarvoor heb ik financiële steun nodig';
$optie->toelicht_tekst = 'Dat kan maar het verdient onze voorkeur dat je samenwerkt met één of meerdere mensen om het plan te realiseren. ';
$optie->score = 1;
$optieArray[] = $optie;
// echo $optieArray[0];

$optie = new Optie ();
$optie->id = 5;
$optie->id_stelling = $stelling->id;
$optie->volgnr = 2;
$optie->antw_tekst = 'Met enkele andere inwoners van Zoetermeer hebben we plannen gemaakt. Het is onze bedoeling om ons verder te organiseren in bv. een stichting of een coöperatie.';
$optie->toelicht_tekst = 'Goed plan! Laat deze ontwikkelingen en voornemens goed naar voren komen in de documenten die je opstuurt.';
$optie->score = 1;
$optieArray[] = $optie;
// echo $optieArray[1];

$optie = new Optie ();
$optie->id = 6;
$optie->id_stelling = $stelling->id;
$optie->volgnr = 3;
$optie->antw_tekst = 'Ik werk bij een bedrijf dat in Zoetermeer gevestigd is en we hebben een plan om inwoners van Zoetermeer te helpen.';
$optie->toelicht_tekst = 'Dat klinkt mooi maar het Zoetermeerfonds ondersteunt alleen mensen als inwoner van Zoetermeer, geen bedrijven of andere organisaties met een winstoogmerk. Natuurlijk hoeft het één het ander niet uit te sluiten
maar de kans is aanzienlijk dat het Zoetermeerfonds je aanvraag afwijst.';
$optie->score = 0;
$optieArray[] = $optie;
// echo $optieArray[2];

$optie = new Optie ();
$optie->id = 6;
$optie->id_stelling = $stelling->id;
$optie->volgnr = 4;
$optie->antw_tekst = 'Ik heb een idee voor Zoetermeer. Ik ben echter niet in staat om het zelf uit te voeren. ';
$optie->toelicht_tekst = 'Ideeën zijn mooi maar het Zoetermeerfonds ondersteunt alleen de uitvoering van goed uitgewerkte plannen. Plannen die bovendien door de Zoetermeerse indieners zelf moeten worden uitgevoerd. Ons advies: zet een goed idee om in een goed plan en zoek er mensen bij die je helpen je idee te realiseren. Als je dat plan bij ons indient maakt dat kans op een positief besluit van het Zoetermeeronds.';
$optie->score = 0;
$optieArray[] = $optie;
// echo $optieArray[0];

$stelling->opties = $optieArray;
$stellingenArray[] = $stelling;
// echo $stellingenArray[1];
// --------

// --------
$stelling = new Stelling ();
$stelling->id = 3;
$stelling->tekst = 'Wie hebben voordeel van de plannen die je wilt indienen?';
$stelling->gewicht = 300;
unset($optieArray);
$optieArray = array();

$optie = new Optie ();
$optie->id = 7;
$optie->id_stelling = $stelling->id;
$optie->volgnr = 1;
$optie->antw_tekst = 'In principe kunnen alle inwoners van Zoetermeer hun voordeel met het initiatief doen.';
$optie->toelicht_tekst = 'Uitstekend.';
$optie->score = 1;
$optieArray[] = $optie;
// echo $optieArray[0];

$optie = new Optie ();
$optie->id = 8;
$optie->id_stelling = $stelling->id;
$optie->volgnr = 2;
$optie->antw_tekst = 'Het initiatief sluit in principe niemand uit maar is wel gericht op een bepaalde wijk of buurt.';
$optie->toelicht_tekst = 'Dat kan. Beschrijf wel goed wie je tot je doelgroep rekent.';
$optie->score = 1;
$optieArray[] = $optie;
// echo $optieArray[1];

$optie = new Optie ();
$optie->id = 28;
$optie->id_stelling = $stelling->id;
$optie->volgnr = 4;
$optie->antw_tekst = 'We willen de leden van een vereniging of andere besloten groep binnen Zoetermeer helpen.';
$optie->toelicht_tekst = 'Helaas, dan voldoe je niet aan de voorwaarden.';
$optie->score = 0;
$optieArray[] = $optie;
// echo $optieArray[1];

$optie = new Optie ();
$optie->id = 9;
$optie->id_stelling = $stelling->id;
$optie->volgnr = 3;
$optie->antw_tekst = 'Anders';
$optie->toelicht_tekst = 'Dat is mogelijk maar beschrijf in je plan goed wie je doelgroep is.';
$optie->score = 20;
$optieArray[] = $optie;
// echo $optieArray[2];

$stelling->opties = $optieArray;
$stellingenArray[] = $stelling;
// echo $stellingenArray[2];

// --------
$stelling = new Stelling ();
$stelling->id = 5;
$stelling->tekst = 'Hoeveel bedragen de kosten van het initiatief?';
$stelling->gewicht = 300;
unset($optieArray);
$optieArray = array();

$optie = new Optie ();
$optie->id = 7;
$optie->id_stelling = $stelling->id;
$optie->volgnr = 1;
$optie->antw_tekst = 'Daar hebben we nog geen inzicht in. Gedurende de uitvoering komen we daar wel achter.';
$optie->toelicht_tekst = 'Het indienen van een goed onderbouwde begroting van de kosten is een vereiste voor een positieve beslissing van het Zoetermeerfonds.';
$optie->score = 0;
$optieArray[] = $optie;
// echo $optieArray[0];

$optie = new Optie ();
$optie->id = 8;
$optie->id_stelling = $stelling->id;
$optie->volgnr = 2;
$optie->antw_tekst = 'Naast de andere kosten willen wij de inspanning van alle betrokkenen bij het initiatief belonen met een financiële vergoeding';
$optie->toelicht_tekst = 'Het Zoetermeerfonds wijst aanvragen af die een beloningscomponent bevatten voor betrokken initiatiefnemers en/of vrijwilligers.';
$optie->score = 0;
$optieArray[] = $optie;
// echo $optieArray[1];

$optie = new Optie ();
$optie->id = 28;
$optie->id_stelling = $stelling->id;
$optie->volgnr = 4;
$optie->antw_tekst = 'We voorzien in de aanschafkosten van de verschillende spullen die we nodig hebben. Deze staan vermeld in een lijstje die we u hebben toegestuurd.';
$optie->toelicht_tekst = 'Dit is onvoldoende als begroting. Wij willen graag de kosten en baten van het hele initiatief weten zodat we inzicht krijgen in de haalbaarheid ervan.';
$optie->score = 0;
$optieArray[] = $optie;
// echo $optieArray[1];

$optie = new Optie ();
$optie->id = 9;
$optie->id_stelling = $stelling->id;
$optie->volgnr = 3;
$optie->antw_tekst = 'Wij hebben een duidelijke inkomsten- en uitgaven overzicht bij onze plannen ingediend, rekening houdend met de voorwaarden van het Zoetermeerfonds.';
$optie->toelicht_tekst = 'Wij bekijken de plannen inclusief de begroting op realiseerbaarheid. Prima!';
$optie->score = 1;
$optieArray[] = $optie;
// echo $optieArray[2];

$stelling->opties = $optieArray;
$stellingenArray[] = $stelling;
// echo $stellingenArray[2];

// --------
$stelling = new Stelling ();
$stelling->id = 4;
$stelling->tekst = 'Wanneer start je initiatief?';
$stelling->gewicht = 100;
unset($optieArray);
$optieArray = array();
// $stelling->opties = array();

$optie = new Optie ();
$optie->id = 10;
$optie->id_stelling = $stelling->id;
$optie->volgnr = 0;
$optie->antw_tekst = 'Binnen 6 weken.';
$optie->toelicht_tekst = 'Dat is erg kort dag. We hebben tijd nodig om je aanvraag goed te kunnen beoordelen. Het initiatief mag niet gestart voordat wij een definitieve uitspraak hebben gedaan.';
$optie->score = 10;
$optieArray[] = $optie;
// echo $optieArray[0];

$optie = new Optie ();
$optie->id = 11;
$optie->id_stelling = $stelling->id;
$optie->volgnr = 2;
$optie->antw_tekst = 'Het initiatief afhankelijk van de bijdrage van het Zoetermeerfonds en start daarom pas na een positieve uitspraak van het fonds.';
$optie->toelicht_tekst = 'Uitstekend.';
$optie->score = 1;
$optieArray[] = $optie;
// echo $optieArray[1];

$optie = new Optie ();
$optie->id = 12;
$optie->id_stelling = $stelling->id;
$optie->volgnr = 3;
$optie->antw_tekst = 'Het initiatief is al gestart. Maar we kunnen het extra geld goed gebruiken.';
$optie->toelicht_tekst = 'Dat betekent dat jouw initiatief niet afhankelijk is van de bijdrage van het Zoetermeerfonds. De kans is aanzienlijk dat we de aanvraag afwijzen.';
$optie->score = 0;
$optieArray[] = $optie;
// echo $optieArray[2];
$stelling->opties = $optieArray;
$stellingenArray[] = $stelling;
// echo $stellingenArray[0];
// --------
// --------
/*
$stelling = new Stelling ();
$stelling->id = 5;
$stelling->tekst = 'Waar woon je?';
$stelling->gewicht = 100;
unset($optieArray);
$optieArray = array();
// $stelling->opties = array();

$optie = new Optie ();
$optie->id = 21;
$optie->id_stelling = $stelling->id;
$optie->volgnr = 1;
$optie->antw_tekst = 'Je woont in de omgeving van Zoetermeer.';
$optie->toelicht_tekst = 'Als je geen inwoner bent van de gemeente Zoetermeer mag je helaas geen aanvraag indienen bij Het Zoetermeeronds. Als je toch iets wil betekenen voor Zoetermeer kun je er bv. wel voor
zorgen dat je samenwerkt met aanvragers die wel in Zoetermeer wonen.';
$optie->score = 1;
$optieArray[] = $optie;
// echo $optieArray[0];

$optie = new Optie ();
$optie->id = 32;
$optie->id_stelling = $stelling->id;
$optie->volgnr = 2;
$optie->antw_tekst = 'Je woont in de gemeente Zoetermeer.';
$optie->toelicht_tekst = 'Uitstekend, je voldoet aan deze voorwaarde.';
$optie->score = 5;
$optieArray[] = $optie;
// echo $optieArray[1];

$optie = new Optie ();
$optie->id = 33;
$optie->id_stelling = $stelling->id;
$optie->volgnr = 3;
$optie->antw_tekst = 'Je woont niet in Zoetermeer maar je hebt wel een binding met deze gemeente (bijv. omdat je er werkt).';
$optie->toelicht_tekst = 'Helaas, dat is niet voldoende. Het Zoetermeerfonds is er specifiek voor inwoners van Zoetermeer.';
$optie->score = 0;
$optieArray[] = $optie;
// echo $optieArray[2];
$stelling->opties = $optieArray;
$stellingenArray[] = $stelling;
*/


// --------
// --------
// --------

$questions = '<div class="questionnaire">';

for ($i = 0; $i < count($stellingenArray); $i++)
{
	$qstnr = $i + 1;
	$questions .= '
	        <div class="row">
	            <div class="col-md-12 question">
		            <div id="qst_balk' . $i . '" class="qst_balk">
			            <h1>V R A A G&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp' . $qstnr . '</h1>
		            </div>
		            <div class="qst" id="qst' . $i . '">
			            <div class="st_tekst">' . $stellingenArray[$i]->tekst . '</div>';
						for ($j = 0; $j < count($stellingenArray[$i]->opties); $j++)
						{
			            	$questions .= '
							<div class="radio"><label><input type="radio" class="qstn" name="question" value="' . $j . '" score="' . $stellingenArray[$i]->opties[$j]->score . '">' . $stellingenArray[$i]->opties[$j]->antw_tekst . '</label></div>';
						}
						$questions .= '
			            <button class="btn btn-primary klaar" value="' . $i . '">Klaar</button>
		            </div>
		            <div class="answer" id="answer' . $i . '">
			            <div class="st_tekst">Toelichting</div>';
			            
						for ($j = 0; $j < count($stellingenArray[$i]->opties); $j++)
						{
/*
							if ($stellingenArray[$i]->opties[$j]->score != '0')
								$sc_class = 'score';
							else
								$sc_class = '';
*/
			            	$questions .= '
							<div class="toelichting" name="tl' . $j . '">' . $stellingenArray[$i]->opties[$j]->toelicht_tekst . '</div>';
						}
					$questions .= '
		            </div>
				</div>
			</div>
		';		
}
// ' . $i . '" value="' . $i . '
$questions .= '</div>';

?>

<!DOCTYPE html>
<html lang="NL-nl">

<head>

	<?php include("includes/head.inc"); ?>

	<!-- Custom CSS -->
    <link href="css/questionnaire.css" rel="stylesheet">


</head>

<body id="page-top" class="index">


	<?php include("includes/navigation.inc"); ?>
	<?php include("includes/header.inc"); ?>
 
     
<!------            Q U E S T I O N N A I R E ----------                                                                           --->    
    <!-- questionnaire Section -->
    <section id="questionnaire">
        <div class="container">
	        <div class="row">
		        <div class="col-md-12">
			        <div class="scan-inleiding">
						<img src="img/schrijven1024x349.jpg" alt="schrijven" class="img-responsive"> 
				        <h1 class="text-center">Een quick-scan</h1>
					    <p>Niet alle aanvragen voldoen aan de voorwaarden die het Zoetermeerfonds verbindt aan een bijdrage. De voorwaarden kun je <a href="aanvform.php#criteria">hier</a> lezen.
						    Een een uitgebreide, meer formele opsomming van de condities staan <a href="voorwaarden.php#algemenevoorwaarden">hier</a>.</p>
						<p>Als je snel een indruk wilt krijgen of je mogelijk in aanmerking komt, kun je onderstaande scan uitvoeren. Door een aantal vragen te beantwoorden kun je er snel 
							achter komen of je een goede kans maakt of dat je je heil beter ergens anders kunt gaan zoeken.</p>
						<p>Ons uitgangspunt is dat wij zoveel mogelijk inwoners van Zoetermeer willen helpen hun ideeën en plannen werkelijkheid te laten worden. Deze scan geeft slechts een indicatie
							en is vooral bedoeld om je plannen nog eens goed tegen het licht te houden als dat nodig is.</p>
						<p>Belangrijk: de uitslag van deze scan is zuiver informatief en op basis van de uitslag kan geen enkele aanspraak worden gemaakt op de uitkomst van de donatieaanvraag.</p>
						<p>Als alle vragen <span class="gr">groen</span> zijn voldoe je aan een aantal belangrijke voorwaarden. Als één of meer vragen <span class="rd">rood</span> blijven kun je nog steeds een aanvraag indienen. Maar houd rekening met een eventuele afwijzing.</p>
					</div>
		        </div>
	        </div>
			<?php echo $questions;


			?>
       </div>
    </section>
<!------      einde  Q U E S T I O N N A I R E ------------->    

<!------            F O O T E R ------------->    
<?php include("includes/footer.inc"); ?>

<?php include("includes/scripts.inc"); ?>

<script>
	
	var questionnaire = $('.questionnaire'); /* de hele questionnaire */
	var question = $('.question'); /* alle (iedere) questions */
	var quest; /* pointer naar de .... */
	
// 	question.find('.qst_balk').hide();

	question.find('.qst').hide(); /* vind alle vragen en hide ze */
	question.find('.answer').hide(); /* vind alle antwoorden en hide ze */
	
	/* verbind aan alle vraagbalken de clickfunctie en voer dan de rest uit */
	question.find('.qst_balk').click( function() {
		questionnaire.find('.qst:visible').slideUp(); /* slideUp de zichtbare vragen */
		questionnaire.find('.answer:visible').slideUp(); /* slideUp de zichtbare antwoorden */
		if ($(this).next('.qst').is(":visible")) {
			$(this).next('.qst').slideUp();
			quest = 0;	
		} 
		else {
			$(this).next('.qst').slideDown();
			quest = $(this).parent();
			quest.find('.klaar').click( function() {
				var qst = $(this).parent();
				var answer = qst.next('.answer');
				var val = qst.find('input:radio[name=question]:checked').val();
				var score = qst.find('input:radio[name=question]:checked').attr('score');
				if (val) {
					answer.find('.toelichting').hide();
					answer.slideDown();
					var val2 = ".toelichting[name=tl"+val+"]";
					var chosen_answer = answer.find(val2);
					chosen_answer.slideDown();
					/* Als het antwoord niet voldoet aan de voorwaarden moet de kleur van de vraag veranderen */

					if (score !== '0') {
						quest.find('.qst_balk').removeClass('qst_balk').addClass('qst_balk_out');
					} else {
						quest.find('.qst_balk_out').removeClass('qst_balk_out').addClass('qst_balk');
					}
					
				} else {
					alert ('Je hebt nog geen keuze gemaakt!');
				}
			});		
		}
	});
	
</script>    



</body>

</html>
