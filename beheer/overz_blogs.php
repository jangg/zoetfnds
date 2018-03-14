<?php
include_once('../config.php');
include_once('../classes/c_user.php');
include_once('../classes/c_blog.php');
include_once('../classes/c_blog_coll.php');


function getStartAndEndDate($week, $year) {
  $dto = new DateTime();
  $dto->setISODate($year, $week);
  $ret['week_start'] = $dto->format('d-m-Y');
  $dto->modify('+6 days');
  $ret['week_end'] = $dto->format('d-m-Y');
  return $ret;
}

if (!isset($_SESSION['username']))
	header('location: index.php');

if (isset($_SESSION['userid']))
{
	$curr_user = new User ('id', $_SESSION['userid']);
} else
{
	$curr_user = new User ();
}

$arr1 = array (	array (0 => 'jaarweek', 1 => 'DESC'));
				
$blogCollObj = new Blog_coll ($arr1);

global $connection;
openDB();


$html = '';
foreach ($blogCollObj->blogColl as $blog) {
//  	echo $blog;

// 	$status = getStatusDesc(blog->procstatus);

	$gebruiker = new User('id', $blog->id_user);
	if ($blog->visind == 'j')
	{
		$html .= '
		<div class="bloginfo">
			<table>
				<tr>
					<td>Jan Geerdes</td>
					<td>' . strftime('%A %e %B %Y', strtotime($blog->created)) . '</td>
				</tr>
				<tr>
					<td colspan="1">Overzicht activiteiten week ' . $blog->jaarweek . '</td>
					<td>' . getStartAndEndDate(substr($blog->jaarweek,4,2), substr($blog->jaarweek,0,4))['week_start'] . ' t/m ' . getStartAndEndDate(substr($blog->jaarweek,4,2), substr($blog->jaarweek,0,4))['week_end'] . '</td>
				</tr>
			</table>
		</div>
		<div class="blogtext">
					<div>' . $blog->text . 
					'</div>
		</div>';
		unset($gebruiker);
	}
}
// echo $html;
/*
			<table>
				<tr>
					<td>Jan Geerdes</td>
					<td>' . strftime('%A %e %B %Y', strtotime($blog->created)) . '</td>
				</tr>
				<tr>
					<td colspan="1">Overzicht activiteiten week ' . $blog->jaarweek . '</td>
					<td>' . getStartAndEndDate(substr($blog->jaarweek,4,2), substr($blog->jaarweek,0,4))['week_start'] . ' t/m ' . getStartAndEndDate(substr($blog->jaarweek,4,2), substr($blog->jaarweek,0,4))['week_end'] . '</td>
				</tr>
			</table>
*/
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
	.blogtext {
		margin: 0px 0px 40px 0px;
		padding: 30px;
		background-color: #cccccc;
		
	}
	.blogtext h1, .blogtext h2, .blogtext h3 {
		font-size: medium;
	}
	.blogtext h4, .blogtext h5 {
		font-size: normal;
	}
	.bloginfo {
		margin: 0px 0px 0px 0px;
		padding: 0px 0px;
/* 		padding: 5px 15px; */
		border: 0px solid black;
		background-color: #ffd573;
		font-size: medium;
	}
	.bloginfo table {
		margin: 0px;
		border: 0px solid black;
		width: 100%;
	}
	.bloginfo td {
		border: 1px solid black;
		width: 50%;
	}
	
	.citaat {
		font-family: courier, serif;
		margin: 0px 60px;
		font-size: small;
	}
	@media(max-width: 768px) {
		.blogtext {
			padding: 30px 5px;			
		}
		.citaat {
			margin: 0px 10px;
		}	
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
			<div class="col-sm-12">
            <div class="text-center"><br/><br/><h2>Blogs</h2></div>
			</div>
        </div>
		<div class="row">
			<div class="col-sm-12">
				
			<?php echo $html; ?>

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
/*
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
*/
</script>
</html>

