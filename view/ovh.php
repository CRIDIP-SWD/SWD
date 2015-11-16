<?php
$nom_sector = "";
$nom_page = "Bienvenue";
include "inc/header.php";
?>
<body class="leftMenu nav-collapse">
<div id="wrapper">
	<?php include "inc/headerbar.php"; ?>
		<div id="main">

			<?php if(!isset($_GET['sub'])){ ?>
				<?php
				$nom_sector = "OVH";
				$nom_page = "ACCUEIL";
				?>
				<ol class="breadcrumb">
					<li><a href="#"><?= NOM_LOGICIEL; ?></a></li>
					<?php if(!empty($nom_sector)){echo "<li><a href='#'>".$nom_sector."</a></li>";} ?>
					<?php if(!empty($nom_page)){echo "<li><a href='#'>".$nom_page."</a></li>";} ?>
				</ol>
			<?php } ?>
			<?php if(isset($_GET['sub']) && $_GET['view'] == 'web_domaine'){ ?>
				<?php
				$nom_sector = "OVH";
				$nom_page = "DOMAINE";
				?>
				<ol class="breadcrumb">
					<li><a href="#"><?= NOM_LOGICIEL; ?></a></li>
					<?php if(!empty($nom_sector)){echo "<li><a href='#'>".$nom_sector."</a></li>";} ?>
					<?php if(!empty($nom_page)){echo "<li><a href='#'>".$nom_page."</a></li>";} ?>
				</ol>
			<?php } ?>
			<?php if(isset($_GET['sub']) && $_GET['view'] == 'web_hebergement'){ ?>
				<?php
				$nom_sector = "OVH";
				$nom_page = "HEBERGEMENT";
				?>
				<ol class="breadcrumb">
					<li><a href="#"><?= NOM_LOGICIEL; ?></a></li>
					<?php if(!empty($nom_sector)){echo "<li><a href='#'>".$nom_sector."</a></li>";} ?>
					<?php if(!empty($nom_page)){echo "<li><a href='#'>".$nom_page."</a></li>";} ?>
				</ol>
			<?php } ?>
			<?php if(isset($_GET['sub']) && $_GET['view'] == 'web_exchange'){ ?>
				<?php
				$nom_sector = "OVH";
				$nom_page = "EXCHANGE";
				?>
				<ol class="breadcrumb">
					<li><a href="#"><?= NOM_LOGICIEL; ?></a></li>
					<?php if(!empty($nom_sector)){echo "<li><a href='#'>".$nom_sector."</a></li>";} ?>
					<?php if(!empty($nom_page)){echo "<li><a href='#'>".$nom_page."</a></li>";} ?>
				</ol>
			<?php } ?>
			<?php if(isset($_GET['sub']) && $_GET['view'] == 'web_office'){ ?>
				<?php
				$nom_sector = "OVH";
				$nom_page = "OFFICE";
				?>
				<ol class="breadcrumb">
					<li><a href="#"><?= NOM_LOGICIEL; ?></a></li>
					<?php if(!empty($nom_sector)){echo "<li><a href='#'>".$nom_sector."</a></li>";} ?>
					<?php if(!empty($nom_page)){echo "<li><a href='#'>".$nom_page."</a></li>";} ?>
				</ol>
			<?php } ?>
			<?php if(isset($_GET['sub']) && $_GET['view'] == 'web_vps'){ ?>
				<?php
				$nom_sector = "OVH";
				$nom_page = "VPS";
				?>
				<ol class="breadcrumb">
					<li><a href="#"><?= NOM_LOGICIEL; ?></a></li>
					<?php if(!empty($nom_sector)){echo "<li><a href='#'>".$nom_sector."</a></li>";} ?>
					<?php if(!empty($nom_page)){echo "<li><a href='#'>".$nom_page."</a></li>";} ?>
				</ol>
			<?php } ?>
			<?php if(isset($_GET['sub']) && $_GET['view'] == 'web_license'){ ?>
				<?php
				$nom_sector = "OVH";
				$nom_page = "LICENSE";
				?>
				<ol class="breadcrumb">
					<li><a href="#"><?= NOM_LOGICIEL; ?></a></li>
					<?php if(!empty($nom_sector)){echo "<li><a href='#'>".$nom_sector."</a></li>";} ?>
					<?php if(!empty($nom_page)){echo "<li><a href='#'>".$nom_page."</a></li>";} ?>
				</ol>
			<?php } ?>
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
