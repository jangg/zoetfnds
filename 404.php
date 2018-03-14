<?php
session_start();
/*
if (isset($_SESSION['av_data']))
{
	error_log ( $_SESSION['av_data'] );
	$av_data = array();
	$av_data = $_SESSION['av_data'];
}
else
{
	error_log ( 'geen gegevens' );
}
*/
?>

<!DOCTYPE html>
<html lang="NL-nl">

<head>

	<?php include("includes/head.inc"); ?>
    

</head>

<body id="page-top" class="index">


	<?php include("includes/navigation.inc"); ?>
	<?php include("includes/header.inc"); ?>
 
     
<!------            C O O K I E S------------->    
    <!-- aanvraagformulier Section -->
    <section id="404page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="text-center">
                        <h1>404</h1>
                        <h2>Oeps! Daar ging iets fout!</h2>
                        <p>De pagina die je zocht is verhuisd, verwijderd, is van naam veranderd of heeft nooit bestaan.</p>
                        <a href="index.php" class="btn btn-xl">Ga naar Home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!------      einde C O O K I E S ------------->    

<!------            F O O T E R ------------->    
<?php include("includes/footer.inc"); ?>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/agency.js"></script>

    <!-- Mijn eigen scripts -->
    <script src="js/googleanalytics.js"></script>


</body>

</html>
