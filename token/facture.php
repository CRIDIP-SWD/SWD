<?php
$nom_sector = "";
$nom_page = "Bienvenue";
include "inc/header.php";
?>
<body class="leftMenu nav-collapse">
<div id="wrapper">
		<div id="main">

				<ol class="breadcrumb">
						<li><a href="#"><?= NOM_LOGICIEL; ?></a></li>
						<?php if(!empty($nom_sector)){echo "<li><a href='#'>".$nom_sector."</a></li>";} ?>
						<?php if(!empty($nom_page)){echo "<li><a href='#'>".$nom_page."</a></li>";} ?>
				</ol>
				<!-- //breadcrumb-->

				<div id="content">
						
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
		
	<?php include "inc/script.php"; ?>

</body>
</html>
