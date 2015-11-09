<?php
$nom_sector = "";
$nom_page = "GESTION";
include "inc/header.php";
?>
<body class="leftMenu nav-collapse">
<div id="wrapper">
	<?php include "inc/headerbar.php"; ?>
		<div id="main">
			<?php if(!isset($_GET['sub'])){ ?>
				<?php
				$nom_sector = "GESTION";
				$nom_page = "Accueil";
				?>
				<ol class="breadcrumb">
					<li><a href="#"><?= NOM_LOGICIEL; ?></a></li>
					<?php if(!empty($nom_sector)){echo "<li><a href='#'>".$nom_sector."</a></li>";} ?>
					<?php if(!empty($nom_page)){echo "<li><a href='#'>".$nom_page."</a></li>";} ?>
				</ol>
				<!-- //breadcrumb-->

				<div id="content">
					<div class="row">
						<div class="col-md-3">
							<div class="well bg-info-gradient">
								<div class="widget-tile">
									<section>
										<h5><strong>Nombre</strong> de Client </h5>
										<h2><?= $gen_cls->data_count_client(); ?></h2>
									</section>
									<div class="hold-icon"><i class="fa fa-users"></i></div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="well bg-success-gradient">
								<div class="widget-tile">
									<section>
										<h5><strong>Nombre</strong> de Devis </h5>
										<h2><?= $gen_cls->data_count_devis(); ?></h2>
									</section>
									<div class="hold-icon"><i class="fa fa-file"></i></div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="well bg-warning-gradient">
								<div class="widget-tile">
									<section>
										<h5><strong>Nombre</strong> de Commande </h5>
										<h2>0</h2>
									</section>
									<div class="hold-icon"><i class="fa fa-cubes"></i></div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="well bg-danger-gradient">
								<div class="widget-tile">
									<section>
										<h5><strong>Nombre</strong> de Facture </h5>
										<h2><?= $gen_cls->data_count_facture(); ?></h2>
									</section>
									<div class="hold-icon"><i class="fa fa-euro"></i></div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<section class="panel corner-flip">
							<div class="widget-chart bg-lightseagreen bg-gradient-green">
								<h2>Chiffre d'affaire</h2>
								<table class="flot-chart" data-type="lines" data-tick-color="rgba(255,255,255,0.2)" data-width="100%" data-height="220px">
									<thead>
									<tr>
										<th></th>
										<th style="color : #FFF;">Test</th>
									</tr>
									</thead>
									<tbody>
									<tr>
										<th>JAN</th>
										<td><?= $gen_cls->data_chart_general("01-01-2015", "31-01-2015"); ?></td>
									</tr>
									<tr>
										<th>FEB</th>
										<td><?= $gen_cls->data_chart_general("01-02-2015", "28-02-2015"); ?></td>
									</tr>
									<tr>
										<th>MAR</th>
										<td><?= $gen_cls->data_chart_general("01-03-2015", "31-03-2015"); ?></td>
									</tr>
									<tr>
										<th>APR</th>
										<td><?= $gen_cls->data_chart_general("01-04-2015", "30-04-2015"); ?></td>
									</tr>
									<tr>
										<th>MAY</th>
										<td><?= $gen_cls->data_chart_general("01-05-2015", "31-05-2015"); ?></td>
									</tr>
									<tr>
										<th>JUN</th>
										<td><?= $gen_cls->data_chart_general("01-06-2015", "30-06-2015"); ?></td>
									</tr>
									<tr>
										<th>JUL</th>
										<td><?= $gen_cls->data_chart_general("01-07-2015", "31-07-2015"); ?></td>
									</tr>
									<tr>
										<th>AUG</th>
										<td><?= $gen_cls->data_chart_general("01-08-2015", "31-08-2015"); ?></td>
									</tr>
									<tr>
										<th>SEP</th>
										<td><?= $gen_cls->data_chart_general("01-09-2015", "30-09-2015"); ?></td>
									</tr>
									<tr>
										<th>OCT</th>
										<td><?= $gen_cls->data_chart_general("01-10-2015", "31-10-2015"); ?></td>
									</tr>
									<tr>
										<th>NOV</th>
										<td><?= $gen_cls->data_chart_general("01-11-2015", "30-11-2015"); ?></td>
									</tr>
									<tr>
										<th>DEC</th>
										<td><?= $gen_cls->data_chart_general("01-12-2015", "31-12-2015"); ?></td>
									</tr>
									</tbody>
								</table>
							</div>
						</section>
					</div>
				</div>
				<!-- //content-->
			<?php } ?>
			<?php if(isset($_GET['sub']) && $_GET['sub'] == 'client'){ ?>
				<?php if(!isset($_GET['data'])){ ?>
					<?php
					$nom_sector = "GESTION";
					$nom_page = "CLIENT";
					?>
					<ol class="breadcrumb">
						<li><a href="#"><?= NOM_LOGICIEL; ?></a></li>
						<?php if(!empty($nom_sector)){echo "<li><a href='#'>".$nom_sector."</a></li>";} ?>
						<?php if(!empty($nom_page)){echo "<li><a href='#'>".$nom_page."</a></li>";} ?>
					</ol>
					<!-- //breadcrumb-->

					<div id="content">
						<div class="row">
							<div class="col-md-12">
								<section class="panel">
									<header class="panel-heading bg-warning-gradient">
										<h2>Liste des <strong>Clients</strong> </h2>
									</header>
									<div class="panel-body">
										<div class="pull-right">
											<button type="button" class="btn btn-rounded btn-success" data-toggle="modal" data-target="#add-client"><i class="fa fa-plus"></i> Ajouter un Client</button>
										</div>
										<table class="table table-striped" id="listing-client">
											<thead>
											<tr>
												<th  class="text-center">#</th>
												<th class="text-center">Identité</th>
												<th class="text-center">Adresse</th>
												<th class="text-center">Coordonnée</th>
											</tr>
											</thead>
											<tbody align="center">
											<?php
											$sql_client = mysql_query("SELECT * FROM client ORDER BY nom_client ASC")or die(mysql_error());
											while($client = mysql_fetch_array($sql_client))
											{
												?>
												<tr onclick="window.location.href='index.php?view=gestion&sub=client&data=view_client&num_client=<?= $client['num_client']; ?>'">
													<td><?= $client['num_client']; ?></td>
													<td>
														<?php if(!empty($client['nom_societe'])){echo "<strong>".$client['nom_client']."</strong><br>";} ?>
														<?= $client['nom_client']; ?>
													</td>
													<td>
														<?= html_entity_decode($client['adresse']); ?><br>
														<?= $client['code_postal']; ?> <?= html_entity_decode($client['ville']); ?>
													</td>
													<td>
														<i class="fa fa-phone"></i>: <?= $client['telephone']; ?><br>
														<i class="fa fa-envelope"></i>: <?= $client['email']; ?>
													</td>
												</tr>
											<?php } ?>
											</tbody>
										</table>
									</div>
								</section>
							</div>
						</div>
					</div>
				<?php } ?>
				<?php if(isset($_GET['data']) && $_GET['data'] == 'view_client'){ ?>
					<?php
						$num_client = $_GET['num_client'];
						$sql_client = mysql_query("SELECT * FROM client WHERE num_client = '$num_client'")or die(mysql_error());
						$client = mysql_fetch_array($sql_client);
					?>
					<?php
					$nom_sector = "GESTION";
					$nom_page = "CLIENT";
					?>
					<!-- //breadcrumb-->

					<div id="main">
						<div id="overview">
							<div class="row">
								<div class="col-sm-9">
									<section class="profile-cover">
										<div class="profile-avatar">
											<div>
												<img alt="" src="assets/img/avatar6.png" class="circle">
												<?php if(!empty($client['nom_societe'])){ ?>
													<span><strong><?= $client['nom_societe']; ?></strong><br><i><?= $client['nom_client']; ?></i></span>
												<?php } ?>
											</div>
											<a class="btn btn-theme" title="Add friends"><i class="fa fa-plus"></i> friends</a>
											<a class="btn btn-theme-inverse" ><i class="fa fa-comments"></i> messages</a>
										</div>
										<div class="profile-status">
											<a class="btn"> 14,548 <small>Sales</small></a>
											<a class="btn"> 254 <small> Follower</small></a>
										</div>
									</section>
								</div>
								<!-- //content > row > col-sm-9 -->

								<div class="col-sm-3">
									<section class="profile-about">
										<h3>About</h3>
										<hr>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque non leo convallis nibh tristique commodo.</p>
									</section>
								</div>
								<!-- //content > row > col-lg-3 -->
							</div>
							<!-- //row-->
						</div>
					</div>

				<?php } ?>
				<div id="add-client" data-width="700" class="modal fade">
					<div class="modal-header bg-success-gradient">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Ajouter un client</h4>
					</div>
					<!-- //modal-header-->
					<div class="modal-body">
						<p>One fine body&hellip;</p>
					</div>
					<!-- //modal-body-->
					<div class="modal-footer bg-success-gradient">
						<button type="submit" class="btn btn-default pull-right"><i class="fa fa-check"></i> Valider</button>
					</div>
				</div>
			<?php } ?>
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
