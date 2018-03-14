<?php
require_once ('config.php');
include_once('classes/c_newsitem_coll.php');
include_once('classes/c_newsitem.php');


$arr1 = array (	array (0 => 'newsitem.visind', 1 => 'j'));
$arr2 = array (	array (0 => 'newsitem.date_created', 1 => 'DESC'));

/* geef de 12 meest recente berichten weer */
				
$newsitemColl = new Newsitem_coll ($arr1, $arr2, 12);

global $connection;
openDB();

/* Eerst worden alle nieuwsberichten op een rijtje gezet. Die komen in de linkerkolom. */

/* 	Dan wordt het gewenste nieuwsitem in z'n geheel opgemaakt voor de rechterkolom.
	Als er geen nieuwsitem is opgegeven dan wordt het meest recente item gebruikt. Anders het opgegeven item.
	Om deze voor Facebook en Twitter ook beschikbaar te maken moeten de juiste gegevens inde og:items en velden worden gezet.
*/
if (isset($_GET[ni]))
{
	/* item nummer is bekend. Als het bestaat, zet het in de hoofdtekst.*/
	$itemnr = $_GET[ni];
	
}
else 
{
	/* item nummer is niet bekend. Neem de meest recente nieuwsitem en plaats deze op de pagina.*/
	$itemnr = 0;
	
}
$html_newslines = '';
$html_newsitem = '';
foreach ($newsitemColl->newsitemColl as $newsitem) 
{
	if ($itemnr == $newsitem->id)
	{
		$item_selected = $newsitem;
		$html_newsitem =
		'<div class="kopregel"><h1>' . html_entity_decode($newsitem->title) .
		'</h1><h4>' . strftime ('%A', strtotime($newsitem->date_created)) . 
		' ' . strftime('%e %B %Y', strtotime($newsitem->date_created)) .
		'</h4><h4>Door ' . 'Jan Geerdes' .
		'</h4></div>' . html_entity_decode($newsitem->text);
		$style_item = "#b4dcc1";
		
		/* plaats hieronder de FB-button en de Twitter button <i class="fa fa-2x fa-facebook"></i>*/
		
/*
		$sm_balk = '<div class="sm_balk">Deel op ' .
		'<div class="fb-share-button btn btn-social clearfix" style=""></div> en op ' . 
		'<a class="twitter-share-button btn btn-social clearfix" href="https://twitter.com/intent/tweet?text=' . 
		html_entity_decode($newsitem->tw_text) .
		'&url=' . html_entity_decode($newsitem->tw_url) .
		'" data-size="large"><i class="fa fa-2x fa-twitter"></i></a>' .
		'</div>';
		'<a class="twitter-share-button btn btn-social clearfix" href="https://twitter.com/intent/tweet?text=' . 
*/
		 
		$sm_balk = '<div class="sm_balk">Deel op ' .
		'<a class="fb-share-button btn btn-social clearfix" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.zoetermeerfonds.nl%2Fnieuws.php?ni=' . $newsitem->id . '&amp;src=sdkpreparse"><i class="fa fa-2x fa-facebook"></i></a> en op ' . 
		'<a class="twitter-share-button btn btn-social clearfix" href="https://twitter.com/intent/tweet?u=https://www.zoetermeerfonds.nl/nieuws.php?ni=' . $newsitem->id . 
		'&text=' . html_entity_decode($newsitem->title) .
		'" data-size="large"><i class="fa fa-2x fa-twitter"></i></a>' .
		'</div>';

		$html_newsitem .= $sm_balk;
		/************/
	}
	else
		$style_item = "#ffffff";

// 		'<div class="row newsline" style="background-color: ' . $style_item . '" id="item' . $newsitem->id . 
				
	$html_newslines .=
		'<a class="" href="nieuws.php?ni=' . $newsitem->id . '#overzicht">' .
		'<div class="row newsline" style="background-color: ' . $style_item . '" id="item' . $newsitem->id . 
		'"><div>' . strftime ('%A', strtotime($newsitem->date_created)) . 
		' ' . strftime('%e %B %Y', strtotime($newsitem->date_created)) . 
		'</div><div><div class="title">' . html_entity_decode($newsitem->title) . 
		'</div><div class="subtitle">' . html_entity_decode($newsitem->subtitle) . 
		'</div></div><hr/></div>' .
		'</a>';
		
}


?>

<!DOCTYPE html>
<html lang="NL-nl">

<head>
	<meta name="twitter:card" 			content="summary_large_image" />
	<meta name="twitter:site" 			content="@zoetermeerfonds" />
	<meta name="twitter:creator" 		content="@zoetermeerfonds" />
<!--
	<meta name="twitter:title" content="<?php echo html_entity_decode($item_selected->title); ?>">
	<meta name="twitter:description" content="<?php echo html_entity_decode($item_selected->subtitle); ?>">
	<meta name="twitter:image" content="<?php echo $item_selected->fb_pict; ?>">
	<meta name="twitter:domain" content="zoetermeerfonds.nl">	  
-->

	<meta property="og:url"             content="https://www.zoetermeerfonds.nl/nieuws.php?ni=<?php echo $itemnr; ?>" />
	<meta property="og:type"            content="website" />
	<meta property="og:title"           content="<?php echo html_entity_decode($item_selected->title); ?>" />
	<meta property="og:description"     content="<?php echo html_entity_decode($item_selected->subtitle); ?>" />
	<meta property="og:image"           content="<?php echo $item_selected->fb_pict; ?>" />
	<meta property="og:locale"			content="nl_NL"/>

 
	<?php include("includes/head.inc"); ?>
</head>

<body id="page-top" class="index">


	<?php include("includes/facebook.inc"); ?>
	<?php include("includes/navigation.inc"); ?>
    <header>
        <div class="container doverlay">
            <div class="intro-text">
                <div class="intro-lead-in">Welkom bij het <img src="../img/logos/zflogo_100.png" alt="zflogo_100" width="347" class="img-responsive img-centered" /></div>
            </div>
        </div>
    </header>
 
     
<!------            N I E U W S  O V E R Z I C H T ------------->    
    <!-- newsitemoverzicht Section -->
    <section id="overzicht">
        <div class="container">
            <div class="row">
	            <div class="col-sm-3 newslines">
		            <h3>BERICHTEN</h3>
					<?php echo $html_newslines; ?>            
	            </div>
	            <div class="col-sm-9">
		            <div id="newsitem">
			            <?php echo $html_newsitem; ?> 
		            </div>
	            </div>
            </div>
        </div>
    </section>
<!------      einde N I E U W S  O V E R Z I C H T  ------------->    

<!------            F O O T E R ------------->    
<?php include("includes/footer.inc"); ?>

<?php include("includes/scripts.inc"); ?>
</body>

</html>
