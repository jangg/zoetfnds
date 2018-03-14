<?php
include_once('../config.php');
include_once('../classes/c_aanvr_coll.php');
include_once('../classes/c_user.php');
include_once('../classes/c_person.php');
include_once('../classes/c_aanvraag.php');
include_once('../classes/c_comment.php');
include_once('../classes/c_comment_coll.php');
include_once('includes/getstatus.php');


/*
if (!isset($_SESSION['username']))
	header('location:../index.php');
*/

if (isset($_POST['aanvraagid']))
{
	$_SESSION['aanvraagid'] = $_POST['aanvraagid'];
}
if (isset($_SESSION['aanvraagid']))
{
	$aanvraagid = $_SESSION['aanvraagid'];
}


if (isset($_POST['okbutton']))
{
// 	echo $_POST['okbutton'];
	$commtext = $_POST['commenttext'];
	if ($commtext != '')
	{
		$comment = new Comment();
		$comment->id_aanvraag = $_SESSION['aanvraagid'];
		
		$comment->id_user = $_SESSION['userid'];
	    $datetime = new DateTime();
		$comment->created = $datetime->format('Y\-m\-d\ H:i:s');
		$comment->subject = '';
		$comment->text = $commtext;
		$comment->visind = 'j';
		$comment->insertToDB();
// 		echo $comment;
	}
}

/*
Hier wordt de commentaar lijst opgebouwd.	
		
*/
$comm_html = '';

$curr_user = new User('id', $_SESSION['userid']);
if ($curr_user->comm_vis == 'j')
{
	global $connection;
	openDB();
	$arr1 = array (	array (0 => 'comment.visind', 1 => 'j'), array (0 => 'comment.id_aanvraag', 1 => $aanvraagid));
	$arr2 = array (	array (0 => 'comment.created', 1 => 'DESC'));
	$commentColl = new Comment_coll ($arr1, $arr2);
	
	foreach ($commentColl->commentColl as $comment) 
	{
		$user = new User('id', $comment->id_user);
		$comm_html .= '<div class="box comment"><h5>' . 
		$user->username . ' ' . $comment->created . '</h5><p>' .
		nl2br($comment->text) . '</p></div>';
	}
}

// echo $aanvraagid;
$aanvraag = new Aanvraag('id', $aanvraagid);
$person = new Person ('id', $aanvraag->id_person);

$status = getStatusDesc($aanvraag->procstatus);

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
	
	body {
		max-width: 1280px;
		margin: 0 auto;
		padding: 10px 50px;
	}
	h1,
	h2,
	h3,
	h4,
	h5,
	h6 {
	    text-transform: uppercase;
	    font-family: Montserrat,"Helvetica Neue",Helvetica,Arial,sans-serif;
	    font-weight: 500;
	}
	
	h2, h3, h4, h5 {
		margin-top: 0;
	}
	.titel {
		clear: both;
		margin: 5px 0px 5px 0px;
		color: grey;
	}
	.text {
		margin-left: 70px;
	}
	
	.box {
		border: 1px solid black;
		margin: 5px 0px;
		padding: 15px;
		background-color: #e6faff;
	}
	
	.comment {
		font-size: 0.9em;
	}
	
	.comment > h5 {
		color: #4169E1;
	}
</style>	
</head>

<body>
	<div class="container">
		<div class="row header">
			<h2>Zoetermeerfonds beheer</h2>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<ul id="myTab" class="nav nav-tabs">
				   	<li class="active">
				      	<a href="overz_aanvr.php"  data-toggle="tab">
				         Aanvraag
						</a> 
					</li>
<!--
					<li>
						<a href="#gastenboek" data-toggle="tab">
						 Gastenboek bijhouden
						</a>
					</li>
					<li>
						<a href="beheerd.php">
						 Nieuw gastenboekbericht
						</a>
					</li>
-->
					<li>
				      	<a href="overz_aanvr.php">
				         Terug naar overzicht
						</a> 
					</li>
				</ul>
			</div>
		</div>
	</div>

<!--
	    <form action="overz_aanvr.php" method="post">
	        <button type="submit" class="btn btn-primary" name="aanvraagid" value="' . $aanvraag->id . '">terug naar overzicht</button>
	    </form>
-->
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="box">
					<h2>Aanvraag</h2>
					<div>
						<div class='titel'>Naam: </div><div class='text'><?php echo $person->volnaam; ?></div>
					</div>
					<div>
						<div class='titel'>Adres: </div><div class='text'><?php echo $person->adres; ?></div>
					</div>
					<div>
						<div class='titel'>Postcode: </div><div class='text'><?php echo $person->postcode; ?></div>
					</div>
					<div>
						<div class='titel'>Woonplaats: </div><div class='text'><?php echo $person->woonplaats; ?></div>
					</div>
					<div>
						<div class='titel'>Telefoon: </div><div class='text'><?php echo $person->telnr; ?></div>
					</div>
					<div>
						<div class='titel'>Emailadres: </div><div class='text'><?php echo $person->emailadres; ?></div>
					</div>
					<div>
						<div class='titel'>IBAN reknr: </div><div class='text'><?php echo $person->reknr; ?></div>
					</div>
				</div>
				<div class="box">
					<h2>Gegevens aanvraag</h2>
					<div>
						<div class='titel'>Projectnummer: </div><div class='text'><?php echo $aanvraag->codeaanvraag; ?></div>
					</div>
					<div>
						<div class='titel'>Datum: </div><div class='text'><?php echo strftime('%A %e %B %Y %H:%M:%S', strtotime($aanvraag->datumnw)); ?></div>
					</div>
					<div>
						<div class='titel'>Status: </div><div class='text'><?php echo $status; ?></div>
					</div>
					<div>
						<div class='titel'>Korte omschrijving: </div><div class='text'><?php echo nl2br($aanvraag->omskort); ?></div>
					</div>
					<div>
						<div class='titel'>Wat ga je doen: </div><div class='text'><?php echo nl2br($aanvraag->wat); ?></div>
					</div>
					<div>
						<div class='titel'>Voor wie ga je het doen: </div><div class='text'><?php echo nl2br($aanvraag->voorwie); ?></div>
					</div>
					<div>
						<div class='titel'>Waarom wil je het doen: </div><div class='text'><?php echo nl2br($aanvraag->waarom); ?></div>
					</div>
					<div>
						<div class='titel'>Met wie werk je samen: </div><div class='text'><?php echo nl2br($aanvraag->metwie); ?></div>
					</div>
					<div>
						<div class='titel'>Wanneer vindt het plaats: </div><div class='text'><?php echo nl2br($aanvraag->wanneer); ?></div>
					</div>
					<div>
						<div class='titel'>Hoe betrek je anderen erbij: </div><div class='text'><?php echo nl2br($aanvraag->hoe); ?></div>
					</div>
					<div>
						<div class='titel'>Totale kosten: </div><div class='text'><?php echo nl2br($aanvraag->kosten); ?></div>
					</div>
					<div>
						<div class='titel'>Gevraagde bijdrage: </div><div class='text'><?php echo nl2br($aanvraag->bijdrage); ?></div>
					</div>
					<div>
						<div class='titel'>Meegeleverde documenten: </div><div class='text'><?php echo $aanvraag->file1; ?></div><div class='text'><?php echo $aanvraag->file2; ?></div><div class='text'><?php echo $aanvraag->file3; ?></div>
					</div>			
				</div>
			</div>
			<div class="col-md-4">
			<div class="box">
				<form method="POST" role="form" action="aanvraag.php" id="aanvraag" novalidate>
				<label for="projectnr">Projectnummer</label>
				<input type="text" class="form-control">
				<label for="status">Status</label>
				
					<div class="radio"><label><input type="radio" name="statusopt" id="statusopt10" value="10">10 ingediend, nog niet bekeken</label>								</div>
					<div class="radio"><label><input type="radio" name="statusopt" id="statusopt21" value="21">21 wacht op aanvullende informatie</label>							</div>
					<div class="radio"><label><input type="radio" name="statusopt" id="statusopt31" value="31">31 klaar voor beoordeling bestuur</label>							</div>
					<div class="radio"><label><input type="radio" name="statusopt" id="statusopt50" value="50">50 bevestigd, aanhouden tot nader order</label>						</div>
					<div class="radio"><label><input type="radio" name="statusopt" id="statusopt71" value="71">71 toegekend, wacht op bevestiging aanvrager</label>				</div>
					<div class="radio"><label><input type="radio" name="statusopt" id="statusopt72" value="72">72 toegekend, contractbrief verstuurd</label>						</div>
					<div class="radio"><label><input type="radio" name="statusopt" id="statusopt75" value="75">75 gedeeltelijk toegekend, wacht op bevestiging aanvrager</label>	</div>
					<div class="radio"><label><input type="radio" name="statusopt" id="statusopt76" value="76">76 gedeeltelijk toegekend, contractbrief verstuurd</label>			</div>
					<div class="radio"><label><input type="radio" name="statusopt" id="statusopt80" value="80">80 afgewezen, gereageerd per email</label>							</div>
					<div class="radio"><label><input type="radio" name="statusopt" id="statusopt91" value="91">91 contractbrief getekend, donatie kan worden overgemaakt</label>	</div>
					<div class="radio"><label><input type="radio" name="statusopt" id="statusopt92" value="92">92 contractbrief getekend, donatie is overgemaakt</label>			</div>
					<div class="radio"><label><input type="radio" name="statusopt" id="statusopt93" value="93">93 verslag is binnen, restant donatie kan worden overgemaakt</label></div>
					<div class="radio"><label><input type="radio" name="statusopt" id="statusopt94" value="94">94 verslag is binnen, restant donatie is overgemaak</label>			</div>
					<div class="radio"><label><input type="radio" name="statusopt" id="statusopt95" value="95">95 aanvraag volledig afgerond</label>								</div>
				</div>
				<textarea name="commenttext" type="text" width="100%" class="form-control" rows="10"></textarea>
				<input name="okbutton" value="OK" type="submit" class="btn btn-sm">
				<input name="cancelbutton" value="Cancel" type="submit" class="btn btn-sm">
				</form>
			</div>
			</div>
		</div>
	</div>
</body>
</html>

