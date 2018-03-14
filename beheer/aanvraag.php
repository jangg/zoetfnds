<?php
include_once('../config.php');
include_once('../classes/c_aanvr_coll.php');
include_once('../classes/c_user.php');
include_once('../classes/c_person.php');
include_once('../classes/c_organisatie.php');
include_once('../classes/c_aanvraag.php');
include_once('../classes/c_comment.php');
include_once('../classes/c_comment_coll.php');
include_once('../classes/c_status.php');
include_once('../classes/c_status_coll.php');
include_once('../classes/c_categorie.php');
include_once('../classes/c_categorie_coll.php');

function getStatusList () 
{
	$arr1 = array (array (0 => 'status.code', 1 => 'ASC'));
	return new Status_coll (NULL, $arr1);
}

function getHtmlStatusList ($statusList, $statcode) 
{
	$html_status_lijst = '';
	foreach ($statusList->statusColl as $status)
	{
		$html_status_lijst .= '<option value="' . $status->code . '" ';
		if ($status->code == $statcode)
			$html_status_lijst .= 'selected';
		$html_status_lijst .= '>' . $status->code . '  ' . $status->omschrijving . '</option>';
	}
	return $html_status_lijst;
}

function getCatList () 
{
	$arr1 = array (array (0 => 'categorie.code', 1 => 'ASC'));
	return new Categorie_coll (NULL, $arr1);
}

function getHtmlCatList ($catList, $codecat) 
{
	$html_cat_lijst = '';
	foreach ($catList->categorieColl as $categorie)
	{
		$html_cat_lijst .= '<option value="' . $categorie->code . '" ';
		if ($categorie->code == $codecat)
			$html_cat_lijst .= 'selected';
		$html_cat_lijst .= '>' . $categorie->code . '  ' . $categorie->omschrijving . '</option>';
	}
	return $html_cat_lijst;
}


if (!isset($_SESSION['username']))
	header('location: index.php');

if (!isset($_SESSION['allAanvragen']))
	header('location:../index.php');

if (isset($_GET['ai']))
{
	$_SESSION['aanvraagid'] = $_GET['ai'];
}
if (isset($_SESSION['aanvraagid']))
{
	$aanvraagid = $_SESSION['aanvraagid'];
}

/* haal aanvraag record op */
$aanvraag = new Aanvraag('id', $aanvraagid);

if (isset($_POST['okbutton']))
{
// 	echo $_POST['okbutton'];

	$commAddedInd = 'n';
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
		unset($_POST['okbutton']);
		$aanvraag->datum_comm = $comment->created;
		$aanvraag->updateToDB();
	}
}

$status_lijst = getStatusList ();
$html_status_lijst = getHtmlStatusList ($status_lijst, $aanvraag->procstatus);
$categorie_lijst = getCatList ();
$html_cat_lijst1 = getHtmlCatList ($categorie_lijst, $aanvraag->codecat1);
$html_cat_lijst2 = getHtmlCatList ($categorie_lijst, $aanvraag->codecat2);
	
if (isset($_POST['okmod']) && $_POST['okmod'] == 'Wijzig')
{
	if ($aanvraag->procstatus != $_POST['status'])
	{
		$aanvraag->procstatus = $_POST['status'];
		$date = new DateTime();
		$aanvraag->datumstatus = $date->format('Y-m-d H:i:s');
	}
	$aanvraag->omskort = $_POST['omskort'];
	$aanvraag->id_aanvrager = $_POST['id_aanvrager'];
	$aanvraag->id_organisatie = $_POST['id_organisatie'];
	$aanvraag->bedragbijdrage = $_POST['bijdrage'];
	$aanvraag->bedraggereserv = $_POST['gereserveerd'];
	$aanvraag->bedragtoegekend = $_POST['toegekend'];
	$aanvraag->bedraguitgekeerd = $_POST['uitgekeerd'];
	$aanvraag->codecat1 = $_POST['codecat1'];
	$aanvraag->codecat2 = $_POST['codecat2'];
	$aanvraag->afgerond_ind = $_POST['afgerond_ind'];
	$aanvraag->file1 = $_POST['file1'];
	$aanvraag->file1_dblink = $_POST['file1_dblink'];
	$aanvraag->file2 = $_POST['file2'];
	$aanvraag->file2_dblink = $_POST['file2_dblink'];
	$aanvraag->file3 = $_POST['file3'];
	$aanvraag->file3_dblink = $_POST['file3_dblink'];
	$aanvraag->updateToDB();
	unset($_POST['okmod']);
}

$allAanvragen = $_SESSION['allAanvragen'];

$current_index = array_search($aanvraagid, $allAanvragen);

$status = new Status ('code', $aanvraag->procstatus);
$bg_color = $status->getColorCode();


// echo $aanvraagid . '/' . $current_index;


/*
Hier wordt de commentaar lijst opgebouwd.	
		
*/
$comm_html = '';

$curr_user = new User('id', $_SESSION['userid']);

/* zet datum laatst_gezien voor de gebruiker die de aanvraag ziet */
$aanvraag->setDatumGezien ($curr_user->id);

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
$person = new Person ('id', $aanvraag->id_aanvrager);
if ($aanvraag->id_organisatie != '') {
	$organisatie = new Organisatie ('id', $aanvraag->id_organisatie);
} else {
	$organisatie = new Organisatie ();	
}


$status = new Status ('code', $aanvraag->procstatus);
$categorie1 = new Categorie ('code', $aanvraag->codecat1);
$categorie2 = new Categorie ('code', $aanvraag->codecat2);

$llist = $aanvraag->getStatusList ();

$html_statushistory = '';
$html_statushistory .= '<tr><th>code</th><th>omschrijving</th><th>user</th><th>wijzigingsdatum</th></tr>';

foreach ($llist as $statusLine)
{
	$status_oms = 'omschrijving onbekend';
	foreach ($status_lijst->statusColl as $statusregel)
	{
		if ($statusregel->code == $statusLine['statuscode'])
		{
			$status_oms = $statusregel->omschrijving;
			break;
		}
	}
	$html_statushistory .= '<tr><td>';
	$html_statushistory .= $statusLine['statuscode'];
	$html_statushistory .= '</td><td>';
	$html_statushistory .= $status_oms;
	$html_statushistory .= '</td><td>';
	$html_statushistory .= $statusLine['id_user'];
	$html_statushistory .= '</td><td>';
	$html_statushistory .= strftime('%A %e %B %Y %H:%M:%S', strtotime($statusLine['ts_status']));
	$html_statushistory .= '</td><tr>';
	
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<link href="css/beheer_style.css" rel="stylesheet" type="text/css" /> 
	<script>
	$(document).ready(function(){
	
	   $(".view").show();
	   $(".modify").hide();
	   $("#view_aanvr, #cancelmod").click(function(){
		    $(this).parent("li").siblings("li").removeClass("active");
	        $(".view").show();
			$(".modify").hide();
			$(this).parent("li").addClass("active");
			
		});
	   $("#mod_aanvr").click(function(){
		    $(this).parent("li").siblings("li").removeClass("active");
	        $(".view").hide();
			$(".modify").show();
			$(this).parent("li").addClass("active");
			
		});
	   $("#okmod").click(function(){
		    /* bijwerken aanvraag */
		    
		    
		    $(this).parent("li").siblings("li").removeClass("active");
	        $(".view").show();
			$(".modify").hide();
			$(this).parent("li").addClass("active");
		});
		
	   
	});	
	</script>	
</head>

<body>
	<div class="container">
		<div class="row header">
			<h1>Zoetermeerfonds beheer</h1>
		</div>
        <div class="row">
            <div class="text-center"><h2>Aanvraag <?php echo $aanvraag->codeaanvraag; ?></h2>
            </div>
        </div>
		<div class="row">
			<div class="col-sm-12">
				<ul id="myTab" class="nav nav-pills">
				   	<li class="active">
				      	<a id="view_aanvr" href="#"  data-toggle="tab">
				         Inzien
						</a> 
					</li>
					<?php
						if ($curr_user->isBeheerder())
						{
							echo '<li><a id="mod_aanvr" href="#" data-toggle="tab">Wijzigen</a></li>';
						}					
					?>
					<li>
				      	<a href="overz_aanvr.php">
				         Terug naar overzicht
						</a> 
					</li>
					<li>
						<?php
							if ($current_index - 1 < 0) {
								echo 'Volgende aanvraag';
							} else {
								echo '<a href="aanvraag.php?ai=' . $allAanvragen[$current_index - 1] . '">Volgende aanvraag</a>';
							}
						?>
					</li>
					<li>
						<?php
							if ($current_index + 1 >= count($allAanvragen)) {
								echo 'Vorige aanvraag';
							} else {
								echo '<a href="aanvraag.php?ai=' . $allAanvragen[$current_index + 1] . '">Vorige aanvraag</a>';
							}
						?>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="box">
					<form method="POST" action="aanvraag.php" id="aanvraag" novalidate>
					<table style="width: 100%;">
						<tr>
							<td style="width: 50%;">
								<h4>Gegevens aanvrager</h4>
								<table class="ta">
									<tr>
										<td>ID aanvrager: </td><td class="view"><?php echo $person->id; ?></td><td class="modify"><input name="id_aanvrager" type="text" class="form-control" id="persoon" value="<?php echo $person->id; ?>"></td>								
									</tr>
									<tr>
										<td>Naam: </td><td><?php echo $person->volnaam; ?></td>								
									</tr>
									<tr>
										<td>Adres: </td><td><?php echo $person->adres; ?></td>								
									</tr>
									<tr>
										<td>Postcode: </td><td><?php echo $person->postcode; ?></td>								
									</tr>
									<tr>
										<td>Woonplaats: </td><td><?php echo $person->woonplaats; ?></td>								
									</tr>
									<tr>
										<td>Telefoon: </td><td><?php echo $person->telnr; ?></td>								
									</tr>
									<tr>
										<td>Emailadres: </td><td><a href="mailto:<?php echo $person->emailadres; ?>"><?php echo $person->emailadres; ?></a></td>								
									</tr>
									<tr>
										<td>IBAN reknr: </td><td><?php echo $person->reknr; ?></td>								
									</tr>
								</table>
							</td>
							<td style="width: 50%;">
								<h4>Admie info</h4>
								<table class="ta">
									<tr>
										<td>Bedrag gevraagd: </td><td class="view tg-mb3i"><?php echo number_format($aanvraag->bedragbijdrage, 2, ',', '.'); ?></td><td class="modify"><input name="bijdrage" type="text" class="form-control" id="bijdrage" value="<?php echo $aanvraag->bedragbijdrage; ?>"></td>								
									</tr>
									<tr>
										<td>Bedrag gereserveerd: </td><td class="view tg-mb3i"><?php echo number_format($aanvraag->bedraggereserv, 2, ',', '.'); ?></td><td class="modify"><input name="gereserveerd" type="text" class="form-control" id="gereserveerd" value="<?php echo $aanvraag->bedraggereserv; ?>"></td>								
									</tr>
									<tr>
										<td>Bedrag toegekend: </td><td class="view tg-mb3i"><?php echo number_format($aanvraag->bedragtoegekend, 2, ',', '.'); ?></td><td class="modify"><input name="toegekend" type="text" class="form-control" id="toegekend" value="<?php echo $aanvraag->bedragtoegekend; ?>"></td>								
									</tr>
									<tr>
										<td>Bedrag uitgekeerd: </td><td class="view tg-mb3i"><?php echo number_format($aanvraag->bedraguitgekeerd, 2, ',', '.'); ?></td><td class="modify"><input name="uitgekeerd" type="text" class="form-control" id="uitgekeerd" value="<?php echo $aanvraag->bedraguitgekeerd; ?>"></td>								
									</tr>
<!--
									<tr>
										<td>Boekingsnr: </td><td class="view"><?php echo $aanvraag->boekingsnr; ?></td><td class="modify"><input name="boekingsnr" type="text" class="form-control" id="boekingsnr" value="<?php echo $aanvraag->boekingsnr; ?>"></td>
									</tr>
-->
								</table>
								<br/>
								<table class="ta">
									<tr>
										<td>ID organisatie: </td><td class="view"><?php echo $organisatie->id; ?></td><td class="modify"><input name="id_organisatie" type="text" class="form-control" id="id_organisatie" value="<?php echo $organisatie->id; ?>"></td>								
									</tr>
									<tr>
										<td>Naam: </td><td><?php echo $organisatie->naam; ?></td>								
									</tr>
									<tr>
										<td>Adres: </td><td><?php echo $organisatie->adres; ?></td>								
									</tr>
									<tr>
										<td>Postcode: </td><td><?php echo $organisatie->postcode; ?></td>								
									</tr>
									<tr>
										<td>Plaats: </td><td><?php echo $organisatie->plaats; ?></td>								
									</tr>
									<tr>
										<td>Emailadres: </td><td><a href="mailto:<?php echo $organisatie->emailadres; ?>"><?php echo $organisatie->emailadres; ?></a></td>								
									</tr>
									<tr>
										<td>IBAN reknr: </td><td><?php echo $organisatie->reknr; ?></td>								
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="width: 100%;" colspan="2">
								<h4>Statuswijzigingen</h4>
								<table class="ta">
									<?php echo $html_statushistory; ?>
								</table>
							</td>

						</tr>
					</table>
				</div>
				<div class="box">
					<h4>Gegevens aanvraag</h4>
					<table class="ta">
						<tr>
							<td>ID aanvraag: </td><td><?php echo $aanvraag->id; ?></td>								
						</tr>
						<tr>
							<td>Projectnummer: </td><td><?php echo $aanvraag->codeaanvraag; ?></td>								
						</tr>
						<tr>
							<td>Afgerond: </td><td class="view"><?php echo $aanvraag->afgerond_ind; ?></td>
							<td class="modify">
								<select name="afgerond_ind">
								<option value="n" <?php if ($aanvraag->afgerond_ind == 'n') echo 'selected'; ?>>n</option>
								<option value="j" <?php if ($aanvraag->afgerond_ind == 'j') echo 'selected'; ?>>j</option>
								</select>
								<br/><br/>
							</td>
						</tr>
						<tr>
							<td>Categorie 1: </td><td class="view"><?php echo $categorie1->omschrijving; ?></td>
							<td class="modify">
								<select name="codecat1">
								<option value="">--</option>
								<?php echo $html_cat_lijst1; ?>
								</select>
								<br/><br/>
							</td>
						</tr>
						<tr>
							<td>Categorie 2: </td><td class="view"><?php echo $categorie2->omschrijving; ?></td>
							<td class="modify">
								<select name="codecat2">
								<option value="">--</option>
								<?php echo $html_cat_lijst2; ?>
								</select>
								<br/><br/>
							</td>
						</tr>
						<tr>
							<td>Datum ingediend: </td><td><?php echo strftime('%A %e %B %Y %H:%M:%S', strtotime($aanvraag->datumnw)); ?></td>								
						</tr>
						<tr>
							<td>Status: </td><td class="view" style="background-color: <?php echo $status->color; ?>"><?php echo $aanvraag->procstatus .'   ' . $status->omschrijving; ?></td>
							<td class="modify">
								<select name="status">
								<option value="">--</option>
								<?php echo $html_status_lijst; ?>
								</select>
								<br/><br/>
							</td>
						</tr>
						<tr>
							<td>Datum status gewijzigd: </td><td><?php if ($aanvraag->datumstatus != NULL) echo strftime('%A %e %B %Y %H:%M:%S', strtotime($aanvraag->datumstatus)); ?></td>								
						</tr>
						<tr>
							<td>Korte omschrijving: </td><td class="view"><?php echo nl2br($aanvraag->omskort); ?></td>
							<td class="modify"><input name="omskort" type="text" class="form-control" id="omskort" value="<?php echo nl2br($aanvraag->omskort); ?>"></td>							
						</tr>
						<tr>
							<td>Wat ga je doen: </td><td><?php echo nl2br($aanvraag->wat); ?></td>								
						</tr>
						<tr>
							<td>Voor wie ga je het doen: </td><td><?php echo nl2br($aanvraag->voorwie); ?></td>								
						</tr>
						<tr>
							<td>Waarom wil je het doen: </td><td><?php echo nl2br($aanvraag->waarom); ?></td>								
						</tr>
						<tr>
							<td>Met wie werk je samen: </td><td><?php echo nl2br($aanvraag->metwie); ?></td>								
						</tr>
						<tr>
							<td>Wanneer vindt het plaats: </td><td><?php echo nl2br($aanvraag->wanneer); ?></td>								
						</tr>
						<tr>
							<td>Hoe betrek je anderen erbij: </td><td><?php echo nl2br($aanvraag->hoe); ?></td>								
						</tr>
						<tr>
							<td>Totale kosten: </td><td><?php echo nl2br($aanvraag->kosten); ?></td>								
						</tr>
						<tr>
							<td>Gevraagde bijdrage: </td><td><?php echo nl2br($aanvraag->bijdrage); ?></td>								
						</tr>
						<tr>
							<td>Meegeleverde documenten: </td>
							<td class="view">
								<?php if ($curr_user->comm_mod == 'j' && $aanvraag->file1_dblink != "") { echo '<a href="' . $aanvraag->file1_dblink . '">' . $aanvraag->file1 . '</a>'; } else { echo $aanvraag->file1; } ?>
							<br/>
								<?php if ($curr_user->comm_mod == 'j' && $aanvraag->file2_dblink != "") { echo '<a href="' . $aanvraag->file2_dblink . '">' . $aanvraag->file2 . '</a>'; } else { echo $aanvraag->file2; } ?>
							<br/>
								<?php if ($curr_user->comm_mod == 'j' && $aanvraag->file3_dblink != "") { echo '<a href="' . $aanvraag->file3_dblink . '">' . $aanvraag->file3 . '</a>'; } else { echo $aanvraag->file3; } ?>
							</td>								
							<td class="modify">
								<input name="file1" type="text" class="form-control" id="file1" value="<?php echo $aanvraag->file1; ?>">
								<input name="file1_dblink" type="text" class="form-control" id="file1_dblink" value="<?php echo $aanvraag->file1_dblink; ?>">
								<br/>	
								<input name="file2" type="text" class="form-control" id="file2" value="<?php echo $aanvraag->file2; ?>">
								<input name="file2_dblink" type="text" class="form-control" id="file2_dblink" value="<?php echo $aanvraag->file2_dblink; ?>">
								<br/>								
								<input name="file3" type="text" class="form-control" id="file3" value="<?php echo $aanvraag->file3; ?>">
								<input name="file3_dblink" type="text" class="form-control" id="file3_dblink" value="<?php echo $aanvraag->file3_dblink; ?>">
							</td>
						</tr>

					</table>
					

				</div>
				<div class="box modify">
					<input name="okmod" value="Wijzig" type="submit" class="btn btn-sm">
					<input name="cancelmod" value="Cancel" type="submit" class="btn btn-sm">
				</div>
				</form>
			</div>
			<div class="col-md-4">
			<?php
				$comm_entry = '';
				if ($curr_user->comm_mod == 'j')
				{
					$comm_entry = 
					'<div class="box">
						<form method="POST" action="aanvraag.php" id="aanvraag" novalidate>
						<label for="comment">Commentaar</label>
						<textarea name="commenttext" type="text" width="100%" class="form-control" rows="10"></textarea>
						<input name="okbutton" value="OK" type="submit" class="btn btn-sm">
						<input name="cancelbutton" value="Cancel" type="submit" class="btn btn-sm">
						</form>
					</div>';
				}
				echo $comm_entry;
				echo $comm_html; 
			?>
			</div>
		</div>
	</div>
</body>
</html>

