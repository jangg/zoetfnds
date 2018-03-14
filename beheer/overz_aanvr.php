<?php
include_once('../config.php');
include_once('../classes/c_aanvr_coll.php');
include_once('../classes/c_person.php');
include_once('../classes/c_user.php');
include_once('../classes/c_aanvraag.php');
include_once('../classes/c_comment_coll.php');
include_once('../classes/c_status.php');


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


if (!isset($_SESSION['username']))
	{
		header('location: index.php');
		exit();
	}
if (isset($_SESSION['userid']))
{
	$curr_user = new User ('id', $_SESSION['userid']);
} else
{
	$curr_user = new User ();
}

$jr = '';
$lopend = '';
if (isset($_GET['jr']))
{
	$arr1 = array (	array (0 => 'LEFT(aanvraag.datumnw, 4)', 1 => $_GET['jr']));
	$jr = $_GET['jr'];
}
else
{
	if (isset($_GET['st']))
	{
		$arr1 = array (	array (0 => 'aanvraag.afgerond_ind', 1 => 'n'));
		$lopend = $_GET['st'];
	}
	else
		$arr1 = NULL;	
}
$arr2 = array (	array (0 => 'aanvraag.codeaanvraag', 1 => 'DESC'));
				
$aanvragenColl = new Aanvraag_coll ($arr1, $arr2);

global $connection;
openDB();

// #a0522d#2e8b57#0000ff#ffff00

$html = '';
$totgevraagd = 0;
$totgereserv = 0;
$totgereserv_def = 0;
$tottoegekend = 0;
$totuitgekeerd = 0;
$allAanvragen = array ();

foreach ($aanvragenColl->aanvraagColl as $aanvraag) {
//	echo $aanvraag;
	$allAanvragen[] = $aanvraag->id;
	$totgevraagd += $aanvraag->bedragbijdrage;
	$totgereserv += $aanvraag->bedraggereserv;
	if ($aanvraag->procstatus > 70)
	{
		$totgereserv_def += $aanvraag->bedraggereserv;
	}
	$tottoegekend += $aanvraag->bedragtoegekend;
	$totuitgekeerd += $aanvraag->bedraguitgekeerd;

	$status = new Status ('code', $aanvraag->procstatus);
	$bg_color = $status->getColorCode();

	$gebruiker = new Person('id', $aanvraag->id_aanvrager);
	if ($aanvraag->datumstatus != '0000-00-00 00:00:00' && $aanvraag->datumstatus != '')
		$datstat = strftime('%e-%m-%Y', strtotime($aanvraag->datumstatus));
		else
		$datstat = '';
/*	Als de datum_comm uit de aanvraag later (groter) is dan datum van de laatste login van de user, laat dat dan zien op het scherm */
/*
	if($aanvraag->datum_comm > $curr_user->activity)
		$laatzien = 'style="background-color: #ff8787;"'; # /* oc-red-4 (open color) 
		else
		$laatzien = '';
*/
	if($aanvraag->newComms ($curr_user->id))
	{
		$laatzien = 'style="background-color: #ff8787;"'; # /* oc-red-4 (open color) */
	} else
	{
		$laatzien = '';
	}
			
	$html .= '<tr>
			<td class="tg-baqh" style="background-color: ' . $bg_color  . ';"><a href="aanvraag.php?ai=' . $aanvraag->id . '"><bold>' . $aanvraag->codeaanvraag . '</bold></a></td>
		    <td class="tg-baqh">' . strftime('%e-%m-%Y', strtotime($aanvraag->datumnw)) . '</td>
		    <td class="tg-baqh">' . $aanvraag->procstatus . '</td>
		    <td class="tg-baqh">' . $datstat . '</td>
		    <td class="tg-yw4l">' . $gebruiker->achternaam . '</td>
		    <td class="tg-yw4l">' . html_entity_decode(shorten_string($aanvraag->omskort, 12)) . '</td>
 		    <td class="tg-lqy6">' . number_format($aanvraag->bedragbijdrage, 2, ',', '.') . '</td>
		    <td class="tg-lqy6">' . number_format($aanvraag->bedraggereserv, 2, ',', '.') . '</td>
		    <td class="tg-lqy6">' . number_format($aanvraag->bedragtoegekend, 2, ',', '.') . '</td>
		    <td class="tg-lqy6">' . number_format($aanvraag->bedraguitgekeerd, 2, ',', '.') . '</td>';
		    if ($curr_user->isIntern())
		    {
		    	$html .= '<td class="tg-baqh" ' . $laatzien . '>' . Comment_coll::getNbrComms($aanvraag->id) . '</td>';
		    }	
			$html .= '</tr>';

	unset($gebruiker);
}
unset($_SESSION['allAanvragen']);
$_SESSION['allAanvragen'] = $allAanvragen;

$html .= '
		<tr>
		<td class="tg-lqy6" colspan="6">Totaal gereserveerd definitief</td>
		<td class="tg-lqy6"></td>
		<td class="tg-lqy6">' . number_format($totgereserv_def, 2, ',', '.') . '</td>
		<td class="tg-lqy6"></td>
		<td class="tg-lqy6"></td>';
	    if ($curr_user->isIntern())
	    {
	    	$html .= '<td class="tg-lqy6"></td>';
	    }	
		$html .= '</tr>';
		$html .= '<tr>
		<td class="tg-lqy6" colspan="6">Totaal gereserveerd voorlopig</td>
		<td class="tg-lqy6"></td>
		<td class="tg-lqy6">' . number_format($totgereserv - $totgereserv_def, 2, ',', '.') . '</td>
		<td class="tg-lqy6"></td>
		<td class="tg-lqy6"></td>';
	    if ($curr_user->isIntern())
	    {
	    	$html .= '<td class="tg-lqy6"></td>';
	    }	
		$html .= '</tr>';
		$html .= '<tr>
		<td class="tg-lqy6" colspan="6">Totaal</td>
		<td class="tg-lqy6">' . number_format($totgevraagd, 2, ',', '.') . '</td>
		<td class="tg-lqy6">' . number_format($totgereserv, 2, ',', '.') . '</td>
		<td class="tg-lqy6">' . number_format($tottoegekend, 2, ',', '.') . '</td>
		<td class="tg-lqy6">' . number_format($totuitgekeerd, 2, ',', '.') . '</td>';
	    if ($curr_user->isIntern())
	    {
	    	$html .= '<td class="tg-lqy6"></td>';
	    }	
		$html .= '</tr>';
?>

<!DOCTYPE html>
<html lang="NL-nl">
<html>
	<head>
		<title>Zoetermeerfonds | beheer</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link href='http://fonts.googleapis.com/css?family=Cousine' rel='stylesheet' type='text/css'>		
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">	
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<link href="css/beheer_style.css" rel="stylesheet" type="text/css" /> 
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
					   	<li class="active">
					      	<a href="overz_aanvr.php"  data-toggle="tab">
					         Aanvragen
							</a> 
						</li>
						
						<?php
						if ($curr_user->isIntern())
						{
						echo 	
						'<li>
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
						<li>
							<a href="overz_blogs.php">
							 Blogs
							</a>
						</li>';
						}
						?>
						<li>
					      	<a href="index.php">
					         Uitloggen
							</a> 
						</li>
					</ul>
				</div>
			</div>
		</div>
        <div class="container">
            <div class="row">
	            <div class="col-md-12 text-center"><h2>overzicht aanvragen</h2>
	            </div>
            </div>
			<div class="row">
				<div class="col-sm-12">
					<ul id="myTab2" class="nav nav-pills">
					   	<li class="tab2 <?php if($jr == '' && $lopend != 'lop') echo 'active'; ?>">
					      	<a href="overz_aanvr.php">
					         Alles
							</a> 
						</li>
					   	<li class="tab2 <?php if($jr == '2018') echo 'active'; ?>">
					      	<a href="overz_aanvr.php?jr=2018">
					         2018
							</a> 
						</li>
					   	<li class="tab2 <?php if($jr == '2017') echo 'active'; ?>">
					      	<a href="overz_aanvr.php?jr=2017">
					         2017
							</a> 
						</li>
					   	<li class="tab2 <?php if($jr == '2016') echo 'active'; ?>">
					      	<a href="overz_aanvr.php?jr=2016">
					         2016
							</a> 
						</li>
					   	<li class="tab2 <?php if($lopend == 'lop') echo 'active'; ?>">
					      	<a href="overz_aanvr.php?st=lop">
					         Lopende aanvragen
							</a> 
						</li>
					</ul>
				</div>
			</div>
			<br/>
			<table class="tg">
<!--
			  <tr>
			    <th class="tg-tdrq" colspan="12">Aanvragen</th>
			  </tr>
-->
			  <tr style="font-weight: bold;">
			    <td class="tg-j0tj">Project</td>
			    <td class="tg-j0tj-d">Ingediend</td>
			    <td class="tg-j0tj">Status</td>
			    <td class="tg-j0tj-d">Gewijzigd</td>
			    <td class="tg-6k2t">Naam aanvrager</td>
			    <td class="tg-6k2t">Omschrijving</td>
			    <td class="tg-mb3i">Gevraagd</td>
			    <td class="tg-mb3i">Gereserveerd</td>
			    <td class="tg-mb3i">Toegekend</td>
			    <td class="tg-mb3i">Uitgekeerd</td>
			    <?php
					if ($curr_user->isIntern())
					{
						echo '<td class="tg-j0tj">NrComm</td>';
					}
				?>
	<!--
			    <td class="tg-6k2t">r1</td>
			    <td class="tg-6k2t">r2</td>
			    <td class="tg-6k2t">r3</td>
	-->
			  </tr>
				
				
				<?php echo $html; ?>  
				
			</table>
			
			          
        </div>
        <div class="container">
 			<div class="row footer">
				<br/>
				&copy 2018 Zoetermeerfonds
			</div>
		</div>
	</body>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</html>
