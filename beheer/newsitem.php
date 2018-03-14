<?php
include_once('../config.php');
include_once('../classes/c_newsitem_coll.php');
include_once('../classes/c_user.php');
include_once('../classes/c_person.php');
include_once('../classes/c_newsitem.php');


if (!isset($_SESSION['username']))
	header('location: index.php');

if (isset($_SESSION['userid']))
{
	$curr_user = new User ('id', $_SESSION['userid']);
} else
{
	$curr_user = new User ();
}

if (isset($_POST['newsitemid']))
{
	$_SESSION['newsitemid'] = $_POST['newsitemid'];
}
if (isset($_SESSION['newsitemid']))
{
	$newsitemid = $_SESSION['newsitemid'];
} else
{
	$newsitemid = 0;
}


$newsitem = new Newsitem('id', $newsitemid);
// echo $newsitemid;
$person = new Person ('id', $newsitem->id_author);

if (isset($_POST['okmod']) && $_POST['okmod'] == 'Wijzig')
{
//  	echo $_POST['okmod'];
	$newsitem->id = $newsitemid;
	$newsitem->title = $_POST['titel'];	
	$newsitem->subtitle = $_POST['subtitel'];	
	$newsitem->text = $_POST['text'];	
	$newsitem->tw_text = $_POST['tw_text'];	
	$newsitem->tw_url = $_POST['tw_url'];	
	$newsitem->fb_title = $_POST['fb_title'];	
	$newsitem->fb_pict = $_POST['fb_pict'];	
	$newsitem->fb_description = $_POST['fb_description'];	
	$newsitem->fb_caption = $_POST['fb_caption'];	
	if (isset($_POST['visind']) && $_POST['visind'] == 'j')
	{ $newsitem->visind = 'j'; } 
	else
	{ $newsitem->visind = 'n'; }
	$newsitem->updateToDB();
	unset($_POST['okmod']);
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
	
	h1 {
		text-align: center;
		font-size: 4em;
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
<script>
$(document).ready(function(){

   $(".view").show();
   $(".modify").hide();
   $("#view_news").click(function(){
	    $(this).parent("li").siblings("li").removeClass("active");
        $(".view").show();
		$(".modify").hide();
		$(this).parent("li").addClass("active");
		
	});
   $("#nw_news").click(function(){
	    $(this).parent("li").siblings("li").removeClass("active");
        $(".view").hide();
		$(".modify").show();
		$(this).parent("li").addClass("active");
		
	});
   $("#mod_news").click(function(){
	    $(this).parent("li").siblings("li").removeClass("active");
        $(".view").hide();
		$(".modify").show();
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
            <div class="text-center"><h2>Nieuwsitem <?php echo $newsitem->id; ?></h2>
            </div>
        </div>
		<div class="row">
			<div class="col-sm-12">
				<ul id="myTab" class="nav nav-pills">
				   	<li class="active">
				      	<a id="view_news" href="#"  data-toggle="tab">
				         Inzien
						</a> 
					</li>
					<?php
						if ($curr_user->isBeheerder())
						{
							echo '<li><a id="mod_news" href="#" data-toggle="tab">Wijzigen</a></li>';
						}					
					?>
					<li>
				      	<a href="overz_news.php">
				         Terug naar overzicht
						</a> 
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<form method="POST" action="newsitem.php" id="newsitem" novalidate>
					<div class="view">
						<div class='titel'>Titel: </div><div class='text'><?php echo htmlspecialchars($newsitem->title); ?></div>
					</div>
					<div class="modify">
						<label for="naam">Titel:</label>
						<input name="titel" type="text" class="form-control" id="titel" value="<?php echo htmlspecialchars($newsitem->title); ?>">
					</div>
					<div class="view">
						<div class='titel'>Subtitel: </div><div class='text'><?php echo htmlspecialchars($newsitem->subtitle); ?></div>
					</div>
					<div class="modify">
						<label for="naam">Subtitel:</label>
						<input name="subtitel" type="text" class="form-control" id="subtitel" value="<?php echo htmlspecialchars($newsitem->subtitle); ?>">
					</div>
					<div class="view">
						<div class='titel'>Zichtbaar: </div>
						<div class='text'>
						<?php 
						if ($newsitem->visind == 'j')
						{
							echo 'Ja';
						} else
						{
							echo 'Nee';
						}
						?>
						</div>
					</div>
					<div class="checkbox modify">
						<label>
						<input type="checkbox" name="visind" value="j"
						<?php 
						if ($newsitem->visind == 'j')
						{
							echo ' checked';
						}
						?>
						>
						Zichtbaar
						 </label>
					</div>
					<div class="view">
						<div class='titel'>Tekst: </div><div class='text'><?php echo htmlspecialchars($newsitem->text); ?></div>
					</div>
					<div class="modify">
						<label for="adres">Tekst</label>
						<textarea name="text" type="text" class="form-control" id="tekst" rows="15"><?php echo htmlspecialchars($newsitem->text); ?></textarea>
					</div>
					<div class="view">
						<div class='titel'>Twitter tekst: </div><div class='text'><?php echo htmlspecialchars($newsitem->tw_text); ?></div>
					</div>
					<div class="modify">
						<label for="naam">Twitter tekst:</label>
						<input name="tw_text" type="text" class="form-control" id="tw_text" value="<?php echo htmlspecialchars($newsitem->tw_text); ?>">
					</div>
					<div class="view">
						<div class='titel'>Twitter URL: </div><div class='text'><?php echo htmlspecialchars($newsitem->tw_url); ?></div>
					</div>
					<div class="modify">
						<label for="naam">Twitter URL:</label>
						<input name="tw_url" type="text" class="form-control" id="tw_url" value="<?php echo htmlspecialchars($newsitem->tw_url); ?>">
					</div>
					<div class="view">
						<div class='titel'>Facebook titel:</div><div class='text'><?php echo htmlspecialchars($newsitem->fb_title); ?></div>
					</div>
					<div class="modify">
						<label for="naam">Facebook titel:</label>
						<input name="fb_title" type="text" class="form-control" id="fb_title" value="<?php echo htmlspecialchars($newsitem->fb_title); ?>">
					</div>
					<div class="view">
						<div class='titel'>Facebook picture:</div><div class='text'><?php echo htmlspecialchars($newsitem->fb_pict); ?></div>
					</div>
					<div class="modify">
						<label for="naam">Facebook picture:</label>
						<input name="fb_pict" type="text" class="form-control" id="fb_pict" value="<?php echo htmlspecialchars($newsitem->fb_pict); ?>">
					</div>
					<div class="view">
						<div class='titel'>Facebook caption:</div><div class='text'><?php echo htmlspecialchars($newsitem->fb_caption); ?></div>
					</div>
					<div class="modify">
						<label for="naam">Facebook caption:</label>
						<input name="fb_caption" type="text" class="form-control" id="fb_caption" value="<?php echo htmlspecialchars($newsitem->fb_caption); ?>">
					</div>
					<div class="view">
						<div class='titel'>Facebook tekst:</div><div class='text'><?php echo htmlspecialchars($newsitem->fb_description); ?></div>
					</div>
					<div class="modify">
						<label for="naam">Facebook tekst:</label>
						<textarea name="fb_description" type="text" class="form-control" id="fb_description" rows="15"><?php echo htmlspecialchars($newsitem->fb_description); ?></textarea>
					</div>
				</div>
				<div class="box modify">
					<input name="okmod" value="Wijzig" type="submit" class="btn btn-sm">
					<input name="cancelmod" value="Cancel" type="submit" class="btn btn-sm">
				</div>
				</form>
			</div>
		</div>
	</div>

</body>
</html>

