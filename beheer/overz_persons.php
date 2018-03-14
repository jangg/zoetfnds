<?php
include_once('../config.php');
include_once('../classes/c_person_coll.php');
include_once('../classes/c_person.php');


if (!isset($_SESSION['username']))
	header('location: index.php');


$arr1 = array (	array (0 => 'person.achternaam', 1 => 'ASC'));
				
$personsColl = new Person_coll ($arr1);

global $connection;
openDB();


$html = '<table class="ta"><tr><th>ID</th><th>Naam</th><th>Email</th><th>Nieuwsbrief</th><th>Aanvraag</th></tr>';

foreach ($personsColl->personColl as $person) {
//   	echo $person;
		if ($person->nieuwsbrief == 'j')
		{ $nb = 'ja';
		} else 
		{ $nb = 'nee'; }
		if ($person->aanvraag == 'j')
		{ $av = 'ja';
		} else 
		{ $av = 'nee'; }
		$html .= '<tr><td><form action="person.php" method="post"><input type="submit" name="personid" value="' . $person->id . '"></form></td>
		<td>' . html_entity_decode($person->volnaam) . '</td><td><a href="mailto:' . html_entity_decode($person->emailadres) . '">' . html_entity_decode($person->emailadres) . '</a></td>
		<td>' . $nb . '</td>
		<td>' . $av . '</td>
		</tr>';
	}
$html .= '</table>';	
	
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
			tr, td {
				margin: 0px;
				padding: 0px 5px;
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
						<li class="active">
							<a href="overz_personen.php"  data-toggle="tab">
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
	            <div class="col-md-12 text-center"><h2>overzicht personen</h2>
	            </div>
            </div>
             <div class="row">
	            <div class="col-md-12 text-left"><?php echo $html; ?>
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
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</html>
