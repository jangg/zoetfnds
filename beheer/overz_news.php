<?php
include_once('../config.php');
include_once('../classes/c_newsitem_coll.php');
include_once('../classes/c_person.php');
include_once('../classes/c_user.php');
include_once('../classes/c_newsitem.php');

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
	header('location: index.php');


$arr1 = array (	array (0 => 'newsitem.date_created', 1 => 'DESC'));
				
$newsitemsColl = new Newsitem_coll ($arr1);

global $connection;
openDB();


$html = '';
foreach ($newsitemsColl->newsitemColl as $newsitem) {
//	echo $newsitem;

// 	$status = getStatusDesc($newsitem->procstatus);

	$gebruiker = new User('id', $newsitem->id_author);
	if ($newsitem->visind == 'j')
		$visind = 'ja'; else $visind = 'nee';
	$html .= '
	<div class="row style_row">
		<div class="col-md-2 style_col1"><bold>Nieuws item ' . $newsitem->id .
// 		$newsitem->codeaanvraag . 
		
		'</bold><br/>' . 
		strftime('%e %B %Y', strtotime($newsitem->date_created)) . 
// 		strftime('%A %e %B %Y', strtotime($newsitem->datumnw)) . 
		
/*
		'<br/>' . 
		strftime('%H:%M uur', strtotime($newsitem->datumnw)) . 
*/
		
// 		'<br/>Aanvrager: ' . 
		'<br/>door: ' . $gebruiker->username . 
		
		'<br/><form action="newsitem.php" method="post"><button type="submit" class="btn btn-primary" name="newsitemid" value="' . $newsitem->id . '">TOON</button></form>' . 
		
		'</div>
		<div class="col-md-9 style_col2">' .
		 htmlspecialchars($newsitem->title) . 
		 '<br/><br/>' .
		 htmlspecialchars(shorten_string($newsitem->text, 70)) . 
		 
		
		'</div>
		<div class="col-md-1 style_col3">' . 
		$visind . 		
		'</div>
		
	</div>';

	unset($gebruiker);
}


/*
	<form action="berichten.php" method="post">
	<div class="cm_berichtbuttons">
		<input type="text" name="onderwerp" value="' . $bericht->onderwerp . '" style="display: none;"/>
		<input type="text" name="berichtid" value="' . $bericht->id . '" style="display: none;"/>
		<input class="commentbutton" type="submit" name="reageren" value="Reageer"/>
		<input class="commentbutton" type="submit" name="reacties" value="Lees reacties"/>
	</div>
	</form>
*/


?>

<!DOCTYPE html>
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
		<style>
			h1,
			h2,
			h3,
			h4,
			h5,
			h6 {
			    text-transform: uppercase;
			    font-family: Montserrat,"Helvetica Neue",Helvetica,Arial,sans-serif;
			    font-weight: 700;
			}
			
			h1 {
				text-align: center;
				font-size: 4em;
			}
			
			h2, h3, h4, h5 {
				margin-top: 0;
			}
			
			bold {
				font-weight: 700;
			}
			button {
				margin-top: 8px;
			}
			.style_row {
				margin: 5px 0px;
				padding: 3px;
				background-color: #e6faff;
				border: 1px solid black;
			}
			
			.style_col1 {
				padding: 15px;
				
			}
			
			.style_col2 {
				padding: 15px;
				
			}
			
			.style_col3 {
				padding: 15px;
				
			}
			
			.style_col4 {
				padding: 15px;
				
			}

		</style>
	</head>
	<body>
		<div class="container">
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
						<li class="active">
							<a href="overz_news.php" data-toggle="tab">
							 Nieuwsitems
							</a>
						</li>
						<li>
							<a href="overz_blogs.php">
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
		</div>
        <div class="container">
            <div class="row">
	            <div class="col-md-12 text-center"><h2>overzicht nieuwsitems</h2>
	            </div>
            </div>
            <div class="row hidden-sm">
	            <div class="col-md-2"><h5 class="text-left">nieuwsitem</h5></div>
 	            <div class="col-md-9"><h5 class="text-left">tekst</h5></div>
	            <div class="col-md-1"><h5 class="text-left">zichtbaar</h5></div>
           </div>
			<?php echo $html; ?>            
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
