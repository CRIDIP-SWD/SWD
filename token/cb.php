<?php
$nom_sector = "";
$nom_page = "Bienvenue";
include "../inc/header.php";

?>
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
