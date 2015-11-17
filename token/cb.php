<?php
$nom_sector = "";
$nom_page = "Bienvenue";
include "../inc/config.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>

	<!-- Meta information -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

	<!-- Title-->
	<title><?= NOM_LOGICIEL; ?> - <?= $nom_page; ?></title>

	<!-- Favicons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= ROOTS,ASSETS,ICO; ?>apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= ROOTS,ASSETS,ICO; ?>apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= ROOTS,ASSETS,ICO; ?>apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="<?= ROOTS,ASSETS,ICO; ?>apple-touch-icon-57-precomposed.png">
	<link rel="shortcut icon" href="<?= ROOTS,ASSETS,ICO; ?>favicon.ico">

	<!-- CSS Stylesheet-->
	<link type="text/css" rel="stylesheet" href="<?= ROOTS,ASSETS,CSS; ?>bootstrap/bootstrap.min.css" />
	<link type="text/css" rel="stylesheet" href="<?= ROOTS,ASSETS,CSS; ?>bootstrap/bootstrap-themes.css" />
	<link type="text/css" rel="stylesheet" href="<?= ROOTS,ASSETS,CSS; ?>style.css" />

	<!-- Styleswitch if  you don't chang theme , you can delete -->
	<link type="text/css" rel="alternate stylesheet" media="screen" title="style4" href="<?= ROOTS,ASSETS,CSS; ?>styleTheme4.css" />
	<link rel="stylesheet" href="<?= ROOTS,ASSETS,PLUGINS; ?>toastr/toastr.css">

</head>
<body class="leftMenu nav-collapse">
<div id="wrapper">
		<div id="main">
				<!-- //breadcrumb-->

				<div id="content">
					<div class="row">
						<div class="col-md-9">
							<section class="panel">
								<header class="panel-heading sm">
									<h3>Paiement Par Carte Bancaire</h3>
									<span class="pull-right"><img src="http://www.boutique-aboweb.com/echos-judiciaires/www/images/paiement/ogone.png" /></span>
								</header>
								<div class="panel-body">
									<form class="form-horizontal" action="<?= ROOT,CONTROL; ?>gestion/facture.php" method="post">

									</form>
								</div>
							</section>
						</div>
						<div class="col-md-3">
							<section class="panel">
								<header class="panel-heading sm">
									<h3>Paiement Par Carte Bancaire</h3>
									<span class="pull-right"><img src="http://www.boutique-aboweb.com/echos-judiciaires/www/images/paiement/ogone.png" /></span>
								</header>
								<div class="panel-body">

								</div>
							</section>
						</div>
					</div>
				</div>
				<!-- //content-->
								
		</div>
		<!-- //main-->
		
		
</div>
<!-- //wrapper-->


<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
		
	<?php include "../inc/script.php"; ?>

</body>
</html>
