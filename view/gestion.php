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
						$idclient = $client['idclient'];
					?>
					<?php
					$nom_sector = "GESTION";
					$nom_page = "CLIENT";
					?>
					<!-- //breadcrumb-->

					<div id="main">
						<div id="overview">
							<div class="row">
								<div class="col-sm-8">
									<section class="profile-cover">
										<div class="profile-avatar">
											<div>
												<img alt="" src="assets/img/avatar6.png" class="circle">
												<?php if(!empty($client['nom_societe'])){ ?>
													<span><strong><?= $client['nom_societe']; ?></strong></span>
												<?php }else{ ?>
													<strong><?= $client['nom']; ?></strong>
												<?php } ?>
											</div>
											<button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit-client-modal"><i class="fa fa-edit"></i> Editer le client</button>
											<button type="button" class="btn btn-danger"><i class="fa fa-remove"></i> Supprimer le client</button>
											<button type="button" class="btn btn-success" onclick="window.location.href='<?= ROOT,CONTROL; ?>gestion/client.php?num_client=<?= $num_client; ?>&num_appeler=<?= $client['telephone']; ?>&num_appelant=<?= $user['interne']; ?>&action=calling'"><i class="fa fa-phone"></i></button>
										</div>
										<div class="profile-status">
											<a class="btn"> <?= $client_cls->count_devis($idclient); ?> <small>Devis</small></a>
											<a class="btn"> <?= $client_cls->count_facture($idclient); ?> <small> Factures</small></a>
											<a class="btn"> <?= $client_cls->count_projet($idclient); ?> <small> Projets</small></a>
											<a class="btn"> <?= $client_cls->count_license($idclient); ?> <small> Licenses</small></a>
											<a class="btn"> <?= $client_cls->count_ticket($idclient); ?> <small> Tickets</small></a>
										</div>
									</section>
								</div>
								<!-- //content > row > col-sm-9 -->

								<div class="col-sm-4">
									<section class="profile-about">
										<h3>BALANCE</h3>
										<hr>
										<table style="width: 100%;">
											<tr>
												<td style="width: 50%;">Total Facturer:</td>
												<td style="width: 50%; text-align: right; padding-right: 5px;"><?= number_format($client_cls->balance_facture($idclient), 2, ',', ' ')." €"; ?></td>
											</tr>
											<tr>
												<td style="width: 50%;">Total Payer:</td>
												<td style="width: 50%; text-align: right; padding-right: 5px;"><?= number_format($client_cls->balance_reglement($idclient), 2, ',', ' ')." €"; ?></td>
											</tr>
											<tr>
												<td colspan="2"><hr></td>
											</tr>
											<tr>
												<td style="width: 50%;">BALANCE:</td>
												<td style="width: 50%; text-align: right; padding-right: 5px;">
													<?php
													if($client_cls->balance($idclient) < '0.00'){echo "<strong class='text-danger'>".number_format($client_cls->balance($idclient), 2, ',', ' ')." €</strong>";}
													if($client_cls->balance($idclient) >= '0.00'){echo "<strong class='text-success'>".number_format($client_cls->balance($idclient), 2, ',', ' ')." €</strong>";}
													?>
												</td>
											</tr>
										</table>
									</section>
								</div>
								<!-- //content > row > col-lg-3 -->
							</div>
							<!-- //row-->
						</div>
						<div class="row">
							<div class="col-md-6">
								<section class="panel">
									<header class="panel-heading bg-warning-gradient">
										<h2>Liste des <strong>Devis</strong> </h2>
									</header>
									<div class="panel-body">
										<table class="table table-striped" id="listing-devis">
											<thead>
											<tr>
												<th  class="text-center">#</th>
												<th class="text-center">Date du Devis</th>
												<th class="text-center">Date d'écheance</th>
												<th class="text-center">Etat</th>
												<th class="text-right">Montant</th>
											</tr>
											</thead>
											<tbody align="center">
											<?php
											$sql_devis = mysql_query("SELECT * FROM swd_devis WHERE idclient = '$idclient'")or die(mysql_error());
											while($devis = mysql_fetch_array($sql_devis))
											{
												?>
												<tr onclick="window.location.href='index.php?view=gestion&sub=devis&data=view_devis&num_devis=<?= $devis['reference']; ?>'">
													<td><?= $devis['reference']; ?></td>
													<td><?= date("d/m/Y", $devis['date_devis']); ?></td>
													<td>
														<?php if($devis_cls->verif_echeance($date_jour_strt, $devis['date_echeance']) == 1){ ?>
															<span class="label label-danger"><i class="fa fa-warning text-warning" data-toggle="tooltip" data-original-title="Arriver à Echéance"></i> <?= date("d-m-Y", $devis['date_echeance']); ?></span>
														<?php }else{ ?>
															<span class="label label-success"><?= date("d-m-Y", $devis['date_echeance']); ?></span>
														<?php } ?>
													</td>
												</tr>
											<?php } ?>
											</tbody>
										</table>
									</div>
								</section>
							</div>
							<div class="col-md-6">

							</div>
						</div>
					</div>
					<div id="edit-client-modal" data-width="700" class="modal fade">
						<div class="modal-header bg-success-gradient">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
							<h4 class="modal-title"><i class="fa fa-edit"></i> Editer un client</h4>
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
<?php if(isset($_GET['success']) && $_GET['success'] == 'calling'){ ?>
<script type="text/javascript">
	$(function(){
		toastr.success("Appel Enregistrer dans la base", "APPEL",{
			progressBar: true,
			positionClass: "toast-bottom-right"
		})
	})
</script>
<?php } ?>

<?php if(isset($_GET['error']) && $_GET['error'] == 'calling'){ ?>
	<script type="text/javascript">
		$(function(){
			toastr.error("Appel non Enregistrer dans la base", "APPEL",{
				progressBar: true,
				positionClass: "toast-bottom-right"
			})
		})
	</script>
<?php } ?>

</body>
</html>
