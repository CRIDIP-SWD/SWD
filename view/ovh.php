<?php
$nom_sector = "";
$nom_page = "Bienvenue";
include "inc/header.php";
?>
<body class="leftMenu nav-collapse">
<div id="wrapper">
	<?php include "inc/headerbar.php"; ?>
		<div id="main">

				<ol class="breadcrumb">
						<li><a href="#"><?= NOM_LOGICIEL; ?></a></li>
						<?php if(!empty($nom_sector)){echo "<li><a href='#'>".$nom_sector."</a></li>";} ?>
						<?php if(!empty($nom_page)){echo "<li><a href='#'>".$nom_page."</a></li>";} ?>
				</ol>
				<!-- //breadcrumb-->

				<div id="content">
					<?php if(!isset($_GET['sub'])){ ?>
						<div class="row">
							<div class="col-md-2">
								<div class="well bg-info">
									<div class="widget-tile">
										<section>
											<h5><strong>REGISTERED</strong> USERS </h5>
											<h2>8,590</h2>
											<div class="progress progress-xs progress-white progress-over-tile">
												<div class="progress-bar  progress-bar-white" aria-valuetransitiongoal="8590" aria-valuemax="10000"></div>
											</div>
											<label class="progress-label label-white"> Just 1410 member to limit , <a href="#">Upgrade Now</a> </label>
										</section>
										<div class="hold-icon"><i class="fa fa-bar-chart-o"></i></div>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
				<!-- //content-->
								
		</div>
		<!-- //main-->
		
		<?php include "inc/sidebar.php"; ?>
		
		
		<?php include "inc/rightbar.php"; ?>
		
		
</div>
<!-- //wrapper-->


<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
		
	<?php include "inc/script.php"; ?>

</body>
</html>
