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
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= ROOT,ASSETS,ICO; ?>apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= ROOT,ASSETS,ICO; ?>apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= ROOT,ASSETS,ICO; ?>apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="<?= ROOT,ASSETS,ICO; ?>apple-touch-icon-57-precomposed.png">
	<link rel="shortcut icon" href="<?= ROOT,ASSETS,ICO; ?>favicon.ico">

	<!-- CSS Stylesheet-->
	<link type="text/css" rel="stylesheet" href="<?= ROOT,ASSETS,CSS; ?>bootstrap/bootstrap.min.css" />
	<link type="text/css" rel="stylesheet" href="<?= ROOT,ASSETS,CSS; ?>bootstrap/bootstrap-themes.css" />
	<link type="text/css" rel="stylesheet" href="<?= ROOT,ASSETS,CSS; ?>style.css" />

	<!-- Styleswitch if  you don't chang theme , you can delete -->
	<link type="text/css" rel="alternate stylesheet" media="screen" title="style4" href="<?= ROOT,ASSETS,CSS; ?>styleTheme4.css" />
	<link rel="stylesheet" href="<?= ROOT,ASSETS,PLUGINS; ?>toastr/toastr.css">

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
									<span class="pull-right"><img src="http://www.boutique-aboweb.com/echos-judiciaires/www/images/paiement/ogone.png" class="img-responsive" width="120"/></span>
								</header>
								<div class="panel-body">
									<form class="form-horizontal" action="<?= ROOT,CONTROL; ?>gestion/facture.php" method="post">

										<div class="form-group">
											<label class="control-label">Numéro de Carte Bancaire</label>
											<div>
												<input type="text" id="credit_card" class="form-control rounded" >
											</div>
										</div>

										<div class="form-group">
											<label class="control-label">Date d'expiration</label>
											<div>
												<input type="text" id="expire" class="form-control rounded">
											</div>
										</div>

										<div class="form-group">
											<label class="control-label">CVC</label>
											<div>
												<input type="text" class="form-control rounded">
											</div>
										</div>
									</form>
								</div>
							</section>
						</div>
						<div class="col-md-3">
							<section class="panel">
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

<!-- Jquery Library -->
<script type="text/javascript" src="<?= ROOT,ASSETS,JS; ?>jquery.min.js"></script>
<script type="text/javascript" src="<?= ROOT,ASSETS,JS; ?>jquery.ui.min.js"></script>
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>bootstrap/bootstrap.min.js"></script>
<!-- Modernizr Library For HTML5 And CSS3 -->
<script type="text/javascript" src="<?= ROOT,ASSETS,JS; ?>modernizr/modernizr.js"></script>
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>mmenu/jquery.mmenu.js"></script>
<script type="text/javascript" src="<?= ROOT,ASSETS,JS; ?>styleswitch.js"></script>
<!-- Library 10+ Form plugins-->
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>form/form.js"></script>
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>ckeditor/ckeditor.js"></script>
<!-- Datetime plugins -->
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>datetime/datetime.js"></script>
<!-- Library Chart-->
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>chart/chart.js"></script>
<!-- Library  5+ plugins for bootstrap -->
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>pluginsForBS/pluginsForBS.js"></script>
<!-- Library 10+ miscellaneous plugins -->
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>miscellaneous/miscellaneous.js"></script>
<!-- Library Themes Customize-->
<script type="text/javascript" src="<?= ROOT,ASSETS,JS; ?>caplet.custom.js"></script>

<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>datable/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>datable/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>toastr/toastr.js"></script>
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>inputmask/inputmask.js"></script>
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>inputmask/inputmask.extensions.js"></script>
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>inputmask/inputmask.date.extensions.js"></script>
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>inputmask/inputmask.numeric.extensions.js"></script>
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>inputmask/inputmask.phone.extensions.js"></script>
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>inputmask/inputmask.regex.extensions.js"></script>
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>inputmask/jquery.inputmask.js"></script>

<!-- APPEL DATATABLE -->
<script type="text/javascript">
	$('#listing-client').dataTable();
	$('#listing-devis').dataTable();
	$('#listing-facture').dataTable();
	$('#listing-projet').dataTable();
	$('#listing-license').dataTable();
	$('#listing-ticket').dataTable();
	$('#listing-famille').dataTable();
	$('#listing-article').dataTable();
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#masked_phone').inputmask("mask", {"mask": "0033999999999"});
		$('#masked_cp').inputmask("mask", {"mask": "99999"});
		$('#date_devis').inputmask("mask", {"mask": "99-99-9999"});
		$('#credit_card').inputmask("mask", {"mask": "9999-9999-9999-9999"});
		$('#expire').inputmask("mask", {"mask": "99/99"});

	});
</script>
<script type="text/javascript">
	// Call CkEditor
	//CKEDITOR.replace( 'short_description', {startupFocus : false, uiColor: '#FFFFFF'});
</script>

</body>
</html>
