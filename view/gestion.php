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
											<button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit-client"><i class="fa fa-edit"></i> Editer le client</button>
											<button type="button" class="btn btn-danger" onclick="window.location.href='<?= ROOT,CONTROL; ?>gestion/client.php?action=supp-client&idclient=<?= $idclient; ?>'"><i class="fa fa-remove"></i> Supprimer le client</button>
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
							<div class="col-md-12">
								<section class="panel corner-flip">
									<div class="widget-chart bg-lightseagreen bg-gradient-green">
										<h2>Chiffre d'affaire (<?php if(!empty($client['nom_societe'])){echo $client['nom_societe'];}else{echo $client['nom_client'];} ?>)</h2>
										<table class="flot-chart" data-type="lines" data-tick-color="rgba(255,255,255,0.2)" data-width="100%" data-height="220px">
											<thead>
											<tr>
												<th></th>
												<th style="color : #FFF;">CA</th>
											</tr>
											</thead>
											<tbody>
											<tr>
												<th>JAN</th>
												<td><?= $facture_cls->chart_fct_client("01-01-2015", "31-01-2015", $idclient); ?></td>
											</tr>
											<tr>
												<th>FEB</th>
												<td><?= $facture_cls->chart_fct_client("01-02-2015", "28-02-2015", $idclient); ?></td>
											</tr>
											<tr>
												<th>MAR</th>
												<td><?= $facture_cls->chart_fct_client("01-03-2015", "31-03-2015", $idclient); ?></td>
											</tr>
											<tr>
												<th>APR</th>
												<td><?= $facture_cls->chart_fct_client("01-04-2015", "30-04-2015", $idclient); ?></td>
											</tr>
											<tr>
												<th>MAY</th>
												<td><?= $facture_cls->chart_fct_client("01-05-2015", "31-05-2015", $idclient); ?></td>
											</tr>
											<tr>
												<th>JUN</th>
												<td><?= $facture_cls->chart_fct_client("01-06-2015", "30-06-2015", $idclient); ?></td>
											</tr>
											<tr>
												<th>JUL</th>
												<td><?= $facture_cls->chart_fct_client("01-07-2015", "31-07-2015", $idclient); ?></td>
											</tr>
											<tr>
												<th>AUG</th>
												<td><?= $facture_cls->chart_fct_client("01-08-2015", "31-08-2015", $idclient); ?></td>
											</tr>
											<tr>
												<th>SEP</th>
												<td><?= $facture_cls->chart_fct_client("01-09-2015", "30-09-2015", $idclient); ?></td>
											</tr>
											<tr>
												<th>OCT</th>
												<td><?= $facture_cls->chart_fct_client("01-10-2015", "31-10-2015", $idclient); ?></td>
											</tr>
											<tr>
												<th>NOV</th>
												<td><?= $facture_cls->chart_fct_client("01-11-2015", "30-11-2015", $idclient); ?></td>
											</tr>
											<tr>
												<th>DEC</th>
												<td><?= $facture_cls->chart_fct_client("01-12-2015", "31-12-2015", $idclient); ?></td>
											</tr>
											</tbody>
										</table>
									</div>
								</section>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<section class="panel">
									<header class="panel-heading bg-warning-gradient">
										<h2>Liste des <strong>Devis</strong> </h2>
									</header>
									<div class="panel-body">
										<table class="table table-striped" id="listing-devis">
											<thead>
											<tr>
												<th class="text-center">#</th>
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
													<td>
														<?php
														if($devis['etat_devis'] == 1){echo "<span class='label label-info'><i class='fa fa-spinner fa-spin'></i> En cours...</span>";}
														if($devis['etat_devis'] == 2){echo "<span class='label label-success'><i class='fa fa-check'></i> Accepté</span>";}
														if($devis['etat_devis'] == 3){echo "<span class='label label-danger'><i class='fa fa-times'></i> Refusé</span>";}
														?>
													</td>
													<td class="text-right">
														<?= number_format($devis['total_ht'], 2, ',', ' ')." €"; ?>
													</td>
												</tr>
											<?php } ?>
											</tbody>
										</table>
									</div>
								</section>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<section class="panel">
									<header class="panel-heading bg-danger-gradient">
										<h2>Liste des <strong>Factures</strong> </h2>
									</header>
									<div class="panel-body">
										<table class="table table-striped" id="listing-facture">
											<thead>
											<tr>
												<th  class="text-center">#</th>
												<th class="text-center">Date de la facture</th>
												<th class="text-center">Date d'écheance</th>
												<th class="text-center">Etat</th>
												<th class="text-right">Montant</th>
											</tr>
											</thead>
											<tbody align="center">
											<?php
											$sql_facture = mysql_query("SELECT * FROM swd_facture WHERE idclient = '$idclient'")or die(mysql_error());
											while($facture = mysql_fetch_array($sql_facture))
											{
												?>
												<tr onclick="window.location.href='index.php?view=gestion&sub=facture&data=view_facture&num_facture=<?= $facture['reference']; ?>'">
													<td><?= $facture['reference']; ?></td>
													<td><?= date("d/m/Y", $facture['date_facture']); ?></td>
													<td>
														<?php if($facture_cls->verif_echeance($date_jour_strt, $facture['date_echeance']) == 1){ ?>
															<span class="label label-danger"><i class="fa fa-warning text-warning" data-toggle="tooltip" data-original-title="Arriver à Echéance"></i> <?= date("d-m-Y", $facture['date_echeance']); ?></span>
														<?php }else{ ?>
															<span class="label label-success"><?= date("d-m-Y", $facture['date_echeance']); ?></span>
														<?php } ?>
													</td>
													<td>
														<?php
														if($facture['etat_facture'] == 1){echo "<span class='label label-danger'><i class='fa fa-spinner fa-spin'></i> Impayé</span>";}
														if($facture['etat_facture'] == 2){echo "<span class='label label-warning'><i class='fa fa-check'></i> Partiellement Payé</span>";}
														if($facture['etat_facture'] == 3){echo "<span class='label label-success'><i class='fa fa-times'></i> Payé</span>";}
														?>
													</td>
													<td class="text-right">
														<?= number_format($facture['total_ht'], 2, ',', ' ')." €"; ?>
													</td>
												</tr>
											<?php } ?>
											</tbody>
										</table>
									</div>
								</section>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<section class="panel">
									<header class="panel-heading bg-info-gradient">
										<h2>Liste des <strong>Projet</strong> </h2>
									</header>
									<div class="panel-body">
										<table class="table table-striped" id="listing-projet">
											<thead>
											<tr>
												<th  class="text-center">Nom du Projet</th>
												<th class="text-center">Etat</th>
												<th class="text-center">Date de Début</th>
												<th class="text-center">Date d'échéance</th>
												<th class="text-right">Montant Global du Projet</th>
											</tr>
											</thead>
											<tbody align="center">
											<?php
											$sql_projet = mysql_query("SELECT * FROM swd_projet WHERE idclient = '$idclient'")or die(mysql_error());
											while($projet = mysql_fetch_array($sql_projet))
											{
												?>
												<tr onclick="window.location.href='index.php?view=projet&sub=projet&data=view_projet&num_projet=<?= $projet['num_projet']; ?>'">
													<td>
														<?= $projet['nom_projet']; ?>
														<div class="progress progress-shine progress-sm">
															<div class="progress-bar bg-primary" aria-valuetransitiongoal="<?= $projet_cls->sum_percent_tache($projet['idprojet']); ?>"></div>
														</div>
														<label class="progress-label">Completer à <?= $projet_cls->sum_percent_tache($projet['idprojet']); ?> %</label>
													</td>
													<td>
														<?php
														if($projet_cls->sum_percent_tache($projet['idprojet']) != 100){echo "<span class='label label-warning'>En cours...</span>";}else{echo "<span class='label label-success'>Terminé</span>";}
														?>
													</td>
													<td>
														<?= date("d/m/Y", $projet['date_debut']); ?>
													</td>
													<td>
														<?php if($projet_cls->verif_echeance($date_jour_strt, $projet['date_echeance']) == 1){ ?>
															<span class="label label-danger"><i class="fa fa-warning text-warning" data-toggle="tooltip" data-original-title="Arriver à Echéance"></i> <?= date("d-m-Y", $projet['date_echeance']); ?></span>
														<?php }else{ ?>
															<span class="label label-success"><?= date("d-m-Y", $projet['date_echeance']); ?></span>
														<?php } ?>
													</td>
													<td class="text-right">
														<?= number_format($projet['total_projet'], 2, ',', ' ')." €"; ?>
													</td>
												</tr>
											<?php } ?>
											</tbody>
										</table>
									</div>
								</section>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<section class="panel">
									<header class="panel-heading bg-palevioletred-gradient">
										<h2>Liste des <strong>Licenses</strong> </h2>
									</header>
									<div class="panel-body">
										<table class="table table-striped" id="listing-license">
											<thead>
											<tr>
												<th  class="text-center">Nom du Produit</th>
												<th class="text-center">Numéro de license</th>
												<th class="text-center">Date de création</th>
												<th class="text-center">Date d'expiration</th>
												<th class="text-right">Status</th>
											</tr>
											</thead>
											<tbody align="center">
											<?php
											$sql_license = mysql_query("SELECT * FROM swd_license, swd_license_product WHERE swd_license.idproductlicense = swd_license_product.idproductlicense AND swd_license.idclient = '$idclient'")or die(mysql_error());
											while($license = mysql_fetch_array($sql_license))
											{
												?>
												<tr onclick="window.location.href='index.php?view=projet&sub=license&data=view_license&license_key=<?= $license['license_key']; ?>'">
													<td>
														<?= $license['nom_product']; ?>
													</td>
													<td>
														<?= $license['license_key']; ?>
													</td>
													<td>
														<?= date("d/m/Y", $license['date_created']); ?>
													</td>
													<td>
														<?php if($license_cls->verif_echeance($date_jour_strt, $license['date_expire']) == 1){ ?>
															<span class="label label-danger" data-toggle="tooltip" data-original-title="Expiré"><i class="fa fa-warning text-warning"></i> <?= date("d-m-Y", $license['date_expire']); ?></span>
														<?php }else{ ?>
															<span class="label label-success"><?= date("d-m-Y", $license['date_expire']); ?></span>
														<?php } ?>
													</td>
													<td>
														<?php
														if($license['status'] == 0){echo "<span class='label label-danger'>Inactive</span>";}
														if($license['status'] == 1){echo "<span class='label label-success'>Active</span>";}
														?>
													</td>
												</tr>
											<?php } ?>
											</tbody>
										</table>
									</div>
								</section>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<section class="panel">
									<header class="panel-heading bg-darkorange-gradient">
										<h2>Liste des <strong>Ticket</strong> </h2>
									</header>
									<div class="panel-body">
										<table class="table table-striped" id="listing-ticket">
											<thead>
											<tr>
												<th  class="text-center">Code</th>
												<th class="text-center">Département</th>
												<th class="text-center">Date de création</th>
												<th class="text-center">Sujet</th>
												<th class="text-right">Status</th>
											</tr>
											</thead>
											<tbody align="center">
											<?php
											$sql_ticket = mysql_query("SELECT * FROM swd_ticket WHERE idclient = '$idclient'")or die(mysql_error());
											while($ticket = mysql_fetch_array($sql_ticket))
											{
												?>
												<tr onclick="window.location.href='index.php?view=outil&sub=ticket&data=view_ticket&code_ticket=<?= $ticket['code_ticket']; ?>'">
													<td>
														<?= $ticket['code_ticket']; ?>
														<?php if(!empty($ticket['num_fact'])){echo "<i><strong>Numéro de la facture:</strong> ".$ticket['num_fact']."</i>";} ?>
													</td>
													<td>
														<?php
														if($ticket['departement'] == 1){echo "CRIDIP";}
														if($ticket['departement'] == 2){echo "Solution Web Developpement";}
														if($ticket['departement'] == 3){echo "SCPVS";}
														?>
													</td>
													<td>
														<?= date("d/m/Y", $ticket['date_created']); ?>
													</td>
													<td>
														<?= html_entity_decode($ticket['sujet']); ?>
													</td>
													<td>
														<?php
														if($ticket['status'] == 0){echo "<span class='label label-default'>Créer</span>";}
														if($ticket['status'] == 1){echo "<span class='label label-warning'><i class='fa fa-spinner fa-spin'></i> En cours...</span>";}
														if($ticket['status'] == 2){echo "<span class='label label-success'><i class='fa fa-check'></i> Résolue</span>";}
														?>
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
					<div id="edit-client" data-width="700" class="modal fade">
						<div class="modal-header bg-info-gradient">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
							<h4 class="modal-title"><i class="fa fa-edit"></i> Editer un client</h4>
						</div>
						<!-- //modal-header-->
						<form class="form-horizontal" action="<?= ROOT,CONTROL; ?>gestion/client.php" method="post">
							<input type="hidden" name="idclient" value="<?= $idclient; ?>" />
							<div class="modal-body">

								<div class="form-group">
									<label class="control-label col-md-3" style="text-align: left;">Nom de la société</label>
									<div class="col-md-9">
										<input type="text" class="form-control rounded" name="nom_societe" value="<?= $client['nom_societe']; ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3" style="text-align: left;">Nom du client</label>
									<div class="col-md-9">
										<input type="text" class="form-control rounded" name="nom_client" value="<?= $client['nom_client']; ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3" style="text-align: left;">Email</label>
									<div class="col-md-9">
										<input type="text" class="form-control rounded" name="email" value="<?= $client['email']; ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3" style="text-align: left;">Téléphone</label>
									<div class="col-md-9">
										<input id="masked_phone" type="text" class="form-control rounded" name="telephone" value="<?= substr($client['telephone'], 4, 12); ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3" style="text-align: left;">Adresse Postal</label>
									<div class="col-md-9">
										<textarea rows="3" class="form-control" name="adresse"><?= html_entity_decode($client['adresse']); ?></textarea>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3" style="text-align: left;">Code Postal</label>
									<div class="col-md-2">
										<input id="masked_cp" type="text" class="form-control rounded" name="code_postal" value="<?= $client['code_postal']; ?>">
									</div>
									<label class="control-label col-md-3" style="text-align: left;">Ville</label>
									<div class="col-md-4">
										<input type="text" class="form-control rounded" name="ville" value="<?= html_entity_decode($client['ville']); ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3" style="text-align: left;">Région</label>
									<div class="col-md-9">
										<input type="text" class="form-control rounded" name="region" value="<?= html_entity_decode($client['region']); ?>">
									</div>
								</div>

							</div>
							<!-- //modal-body-->
							<div class="modal-footer bg-success-gradient">
								<button type="submit" class="btn btn-default pull-right" name="action" value="edit-client"><i class="fa fa-check"></i> Valider</button>
							</div>
						</form>
					</div>
				<?php } ?>
				<div id="add-client" data-width="700" class="modal fade">
					<div class="modal-header bg-success-gradient">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Ajouter un client</h4>
					</div>
					<!-- //modal-header-->
                    <form class="form-horizontal" action="<?= ROOT,CONTROL; ?>gestion/client.php" method="post">
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-md-3" style="text-align: left;">Nom de la société</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control rounded" name="nom_societe">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" style="text-align: left;">Nom du client</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control rounded" name="nom_client">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" style="text-align: left;">Email</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control rounded" name="email">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" style="text-align: left;">Téléphone</label>
                                <div class="col-md-9">
                                    <input id="masked_phone" type="text" class="form-control rounded" name="telephone">
                                </div>
                            </div>

							<div class="form-group">
								<label class="control-label col-md-3" style="text-align: left;">Adresse Postal</label>
								<div class="col-md-9">
									<textarea rows="3" class="form-control" name="adresse"></textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3" style="text-align: left;">Code Postal</label>
								<div class="col-md-2">
									<input id="masked_cp" type="text" class="form-control rounded" name="code_postal">
								</div>
								<label class="control-label col-md-3" style="text-align: left;">Ville</label>
								<div class="col-md-4">
									<input type="text" class="form-control rounded" name="ville">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3" style="text-align: left;">Région</label>
								<div class="col-md-9">
									<input type="text" class="form-control rounded" name="region">
								</div>
							</div>

                        </div>
                        <!-- //modal-body-->
                        <div class="modal-footer bg-success-gradient">
                            <button type="submit" class="btn btn-default pull-right" name="action" value="add-client"><i class="fa fa-check"></i> Valider</button>
                        </div>
                    </form>
				</div>
			<?php } ?>
			<?php if(isset($_GET['sub']) && $_GET['sub'] == 'article'){ ?>
				<?php if(!isset($_GET['data'])){ ?>
					<?php
					$nom_sector = "GESTION";
					$nom_page = "ARTICLE";
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
										<h2>Liste des <strong>Familles d'articles</strong> </h2>
									</header>
									<div class="panel-body">
										<div class="pull-right">
											<button type="button" class="btn btn-rounded btn-success" data-toggle="modal" data-target="#add-famille"><i class="fa fa-plus"></i> Ajouter une famille</button>
										</div>
										<table class="table table-striped" id="listing-famille">
											<thead>
											<tr>
												<th  class="text-center">#</th>
												<th class="text-center">Désignation</th>
												<th>Action</th>
											</tr>
											</thead>
											<tbody align="center">
											<?php
											$sql_famille = mysql_query("SELECT * FROM swd_famille_article")or die(mysql_error());
											while($famille = mysql_fetch_array($sql_famille))
											{
											?>
												<tr>
													<td><?= $famille['idfamillearticle']; ?></td>
													<td><?= $famille['designation_famille']; ?></td>
													<td>
														<button type="button" class="btn" onclick="window.location.href='<?= ROOT,CONTROL; ?>gestion/article.php?action=supp-famille&idfamillearticle=<?= $famille['idfamillearticle']; ?>'" data-toggle="tooltip" data-original-title="Supprimer la famille"><i class="fa fa-trash text-danger"></i></button>
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
					<div id="content">
						<div class="row">
							<div class="col-md-12">
								<section class="panel">
									<header class="panel-heading bg-info-gradient">
										<h2>Liste des <strong>articles</strong> </h2>
									</header>
									<div class="panel-body">
										<div class="pull-right">
											<button type="button" class="btn btn-rounded btn-success" data-toggle="modal" data-target="#add-article"><i class="fa fa-plus"></i> Ajouter un article</button>
										</div>
										<table class="table table-striped" id="listing-article">
											<thead>
											<tr>
												<th  class="text-center">#</th>
												<th class="text-center">Désignation</th>
												<th class="text-center">Famille</th>
												<th class="text-center">Prix de Vente</th>
											</tr>
											</thead>
											<tbody align="center">
											<?php
											$sql_article = mysql_query("SELECT * FROM swd_article, swd_famille_article WHERE swd_article.famille = swd_famille_article.idfamillearticle")or die(mysql_error());
											while($article = mysql_fetch_array($sql_article))
											{
											?>
												<tr onclick="window.location.href='index.php?view=gestion&sub=article&data=view_article&code_article=<?= $article['code_article']; ?>'" style="cursor: hand;">
													<td><?= $article['code_article']; ?></td>
													<td><?= html_entity_decode($article['nom_article']); ?></td>
													<td><?= $article['designation_famille']; ?></td>
													<td class="text-right"><?= number_format($article['prix_vente_ht'], 2, ',', ' ')." €"; ?></td>
												</tr>
											<?php } ?>
											</tbody>
										</table>
									</div>
								</section>
							</div>
						</div>
					</div>
					<div id="add-famille" data-width="700" class="modal fade">
						<div class="modal-header bg-success-gradient">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
							<h4 class="modal-title"><i class="fa fa-plus"></i> Ajouter une Famille</h4>
						</div>
						<!-- //modal-header-->
						<form class="form-horizontal" action="<?= ROOT,CONTROL; ?>gestion/article.php" method="post">
							<div class="modal-body">

								<div class="form-group">
									<label class="control-label col-md-3" style="text-align: left;">Désignation</label>
									<div class="col-md-9">
										<input type="text" class="form-control rounded" name="designation_famille">
									</div>
								</div>


							</div>
							<!-- //modal-body-->
							<div class="modal-footer bg-success-gradient">
								<button type="submit" class="btn btn-default pull-right" name="action" value="add-famille"><i class="fa fa-check"></i> Valider</button>
							</div>
						</form>
					</div>
					<div id="add-article" data-width="1400" class="modal fade">
						<div class="modal-header bg-success-gradient">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
							<h4 class="modal-title"><i class="fa fa-plus"></i> Ajouter un article</h4>
						</div>
						<!-- //modal-header-->
						<form class="form-horizontal" action="<?= ROOT,CONTROL; ?>gestion/article.php" method="post">
							<div class="modal-body">

								<div class="form-group">
									<label class="control-label"> Type de Produit</label>
									<div>
										<div class="row">
											<div class="col-sm-12">
												<ul class="iCheck" data-color="red">
													<li>
														<input type="radio" name="type_article" value="1">
														<label><i class="fa fa-globe"></i> Web</label>
													</li>
													<li>
														<input  type="radio" name="type_article" value="2" checked="checked">
														<label ><i class="fa fa-server"></i> Serveur</label>
													</li>
													<li>
														<input  type="radio" name="type_article" value="3">
														<label ><i class="fa fa-phone-square"></i> Télécom</label>
													</li>
												</ul>
											</div><!-- //col-sm-6 -->
										</div><!-- //row-->
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3">Famille</label>
									<div class="col-md-9">
										<select  class="selectpicker form-control rounded" name="famille" data-size="10" data-live-search="true">
											<?php
												$sql_famille = mysql_query("SELECT * FROM swd_famille_article")or die(mysql_error());
												while($famille = mysql_fetch_array($sql_famille))
												{
												?>
												<option value="<?= $famille['idfamillearticle']; ?>"><?= $famille['designation_famille']; ?></option>
												<?php } ?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3">Nom de l'article</label>
									<div class="col-md-9">
										<input type="text" class="form-control rounded" name="nom_article">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3">Courte description</label>
									<div class="col-md-9">
										<textarea class="form-control" data-provide="markdown" rows="3" maxlength="255"  data-always-show="true" placeholder="Tapez un courte description de l'article" data-pre-text='Il vous reste ' data-post-text=' caractère' name="short_description"></textarea>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3">Description</label>
									<div class="col-md-9">
										<textarea class="form-control" data-provide="markdown" rows="3" name="long_description"></textarea>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3">Prix</label>
									<div class="col-md-9">
										<div class="input-group rounded"> <span class="input-group-addon">€</span>
											<input type="text" name="prix_vente_ht" class="form-control rounded">
										</div>
									</div>
								</div>


							</div>
							<!-- //modal-body-->
							<div class="modal-footer bg-success-gradient">
								<button type="submit" class="btn btn-default pull-right" name="action" value="add-article"><i class="fa fa-check"></i> Valider</button>
							</div>
						</form>
					</div>
				<?php } ?>
				<?php if(isset($_GET['data']) && $_GET['data'] == 'view_article'){ ?>
					<?php
					$nom_sector = "GESTION";
					$nom_page = "ARTICLE";

					$code_article = $_GET['code_article'];
					$sql_article = mysql_query("SELECT * FROM swd_article WHERE code_article = '$code_article'")or die(mysql_error());
					$article = mysql_fetch_array($sql_article);
					$idarticle = $article['idarticle'];
					?>
					<ol class="breadcrumb">
						<li><a href="#"><?= NOM_LOGICIEL; ?></a></li>
						<?php if(!empty($nom_sector)){echo "<li><a href='#'>".$nom_sector."</a></li>";} ?>
						<?php if(!empty($nom_page)){echo "<li><a href='#'>".$nom_page."</a></li>";} ?>
						<li class="pull-right">
							<button type="button" class="btn btn-xs btn-info" onclick="history.back();"><i class="fa fa-chevron-circle-left"></i> Retour</button>
						</li>
					</ol>
					<!-- //breadcrumb-->

					<div id="content">
						<div class="row">
							<div class="col-sm-9">
								<section class="profile-cover">
									<div class="profile-avatar">
										<div>
											<img alt="" src="assets/img/avatar6.png" class="circle">
											<span><?= $article['nom_article']; ?></span>
										</div>
										<a class="btn btn-theme" title="Add friends" data-toggle="modal" data-target="#edit-article"><i class="fa fa-edit"></i> Editer l'article</a>
										<a class="btn btn-theme-inverse" href="<?= ROOT,CONTROL; ?>gestion/article.php?action=supp-article"><i class="fa fa-remove"></i> Supprimer l'article</a>
									</div>

								</section>
							</div>
							<!-- //content > row > col-sm-9 -->

							<div class="col-sm-3">
								<section class="profile-about">
									<h3>Courte description</h3>
									<hr>
									<?= html_entity_decode($article['short_description']); ?>
								</section>
							</div>
							<!-- //content > row > col-lg-3 -->
						</div>
						<div class="row">
							<div class="col-md-6">
								<section class="panel">
									<header class="panel-heading">
										<h3>DESCRIPTION </h3>
									</header>
									<div class="panel-body">
										<?= html_entity_decode($article['long_description']); ?>
									</div>
								</section>
							</div>
							<div class="col-md-6">
								<section class="panel">
									<header class="panel-heading">
										<h3>CARACTERISTIQUE </h3>
									</header>
									<div class="panel-body">
										<div class="pull-right">
											<button type="button" class="btn btn-rounded btn-success" data-toggle="modal" data-target="#add-caracteristique"><i class="fa fa-plus"></i> Ajouter une caractéristique</button>
										</div>
										<table class="table table-striped" id="listing-famille">
											<thead>
											<tr>
												<th class="text-center">Caractéristique</th>
												<th>Valeur</th>
												<th>Action</th>
											</tr>
											</thead>
											<tbody align="center">
											<?php
											$sql_cara = mysql_query("SELECT * FROM swd_article_caracteristique WHERE idarticle = '$idarticle'")or die(mysql_error());
											while($caracteristique = mysql_fetch_array($sql_cara))
											{
											?>
												<tr>
													<td><?= html_entity_decode($caracteristique['caracteristique']); ?></td>
													<td><?= html_entity_decode($caracteristique['value']); ?></td>
													<td>
														<button type="button" class="btn" onclick="window.location.href='<?= ROOT,CONTROL; ?>gestion/article.php?action=supp-caracteristique&$idarticlecaracteristique=<?= $caracteristique['idarticlecaracteristique']; ?>'"><i class="fa fa-remove text-danger"></i></button>
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
					<div id="add-caracteristique" data-width="700" class="modal fade">
						<div class="modal-header bg-success-gradient">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
							<h4 class="modal-title"><i class="fa fa-plus"></i> Ajouter une caractéristique</h4>
						</div>
						<!-- //modal-header-->
						<form class="form-horizontal" action="<?= ROOT,CONTROL; ?>gestion/article.php" method="post">
							<input type="hidden" name="idarticle" value="<?= $idarticle; ?>" />
							<div class="modal-body">

								<div class="form-group">
									<label class="control-label col-md-3" style="text-align: left;">Caractéristique</label>
									<div class="col-md-9">
										<input type="text" class="form-control rounded" name="caracteristique">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3" style="text-align: left;">Valeur</label>
									<div class="col-md-9">
										<input type="text" class="form-control rounded" name="value">
									</div>
								</div>


							</div>
							<!-- //modal-body-->
							<div class="modal-footer bg-success-gradient">
								<button type="submit" class="btn btn-default pull-right" name="action" value="add-caracteristique"><i class="fa fa-check"></i> Valider</button>
							</div>
						</form>
					</div>
					<div id="edit-article" data-width="1400" class="modal fade">
						<div class="modal-header bg-info-gradient">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
							<h4 class="modal-title"><i class="fa fa-edit"></i> Editer un article</h4>
						</div>
						<!-- //modal-header-->
						<form class="form-horizontal" action="<?= ROOT,CONTROL; ?>gestion/article.php" method="post">
							<div class="modal-body">

								<div class="form-group">
									<label class="control-label"> Type de Produit</label>
									<div>
										<div class="row">
											<div class="col-sm-12">
												<ul class="iCheck" data-color="red">
													<li>
														<input type="radio" name="type_article" value="1" <?php if($article['type_article'] == 1){echo "checked='checked'";} ?>>
														<label><i class="fa fa-globe"></i> Web</label>
													</li>
													<li>
														<input  type="radio" name="type_article" value="2" <?php if($article['type_article'] == 2){echo "checked='checked'";} ?>>
														<label ><i class="fa fa-server"></i> Serveur</label>
													</li>
													<li>
														<input  type="radio" name="type_article" value="3" <?php if($article['type_article'] == 3){echo "checked='checked'";} ?>>
														<label ><i class="fa fa-phone-square"></i> Télécom</label>
													</li>
												</ul>
											</div><!-- //col-sm-6 -->
										</div><!-- //row-->
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3">Famille</label>
									<div class="col-md-9">
										<select  class="selectpicker form-control rounded" name="famille" data-size="10" data-live-search="true">
											<?php
											$sql_default = mysql_query("SELECT * FROM swd_famille_article WHERE idfamillearticle = ".$article['famille'])or die(mysql_error());
											$default = mysql_fetch_array($sql_default);
											?>
											<option value="<?= $default['idfamillearticle']; ?>"><?= $default['designation_famille']; ?></option>
											<?php
											$sql_famille = mysql_query("SELECT * FROM swd_famille_article")or die(mysql_error());
											while($famille = mysql_fetch_array($sql_famille))
											{
												?>
												<option value="<?= $famille['idfamillearticle']; ?>"><?= $famille['designation_famille']; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3">Nom de l'article</label>
									<div class="col-md-9">
										<input type="text" class="form-control rounded" name="nom_article" value="<?= html_entity_decode($article['nom_article']); ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3">Courte description</label>
									<div class="col-md-9">
										<textarea class="form-control" data-provide="markdown" rows="3" maxlength="255"  data-always-show="true" placeholder="Tapez un courte description de l'article" data-pre-text='Il vous reste ' data-post-text=' caractère' name="short_description"><?= html_entity_decode($article['short_description']); ?></textarea>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3">Description</label>
									<div class="col-md-9">
										<textarea class="form-control" data-provide="markdown" rows="3" name="long_description"><?= html_entity_decode($article['long_description']); ?></textarea>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3">Prix</label>
									<div class="col-md-9">
										<div class="input-group rounded"> <span class="input-group-addon">€</span>
											<input type="text" name="prix_vente_ht" class="form-control rounded" value="<?= $article['prix_vente_ht']; ?>">
										</div>
									</div>
								</div>


							</div>
							<!-- //modal-body-->
							<div class="modal-footer bg-success-gradient">
								<button type="submit" class="btn btn-default pull-right" name="action" value="edit-article"><i class="fa fa-check"></i> Valider</button>
							</div>
						</form>
					</div>
				<?php } ?>
			<?php } ?>
			<?php if(isset($_GET['sub']) && $_GET['sub'] == 'devis'){ ?>
				<?php if(!isset($_GET['data'])){ ?>
					<?php
					$nom_sector = "GESTION";
					$nom_page = "DEVIS";
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
										<h2>Liste des <strong>devis clients</strong> </h2>
									</header>
									<div class="panel-body">
										<div class="pull-right">
											<button type="button" class="btn btn-rounded btn-success" data-toggle="modal" data-target="#add-devis"><i class="fa fa-plus"></i> Ajouter un devis</button>
										</div>
										<table class="table table-striped" id="listing-famille">
											<thead>
											<tr>
												<th class="text-center">#</th>
												<th class="text-center">Client</th>
												<th class="text-center">Date du Devis</th>
												<th class="text-center">Date d'échéance</th>
												<th class="text-center">Etat du Devis</th>
												<th class="text-center">Montant</th>
												<th>Action</th>
											</tr>
											</thead>
											<tbody align="center">
											<?php
											$sql_devis = mysql_query("SELECT * FROM swd_devis, client WHERE swd_devis.idclient = client.idclient")or die(mysql_error());
											while($devis = mysql_fetch_array($sql_devis))
											{
											?>
												<tr>
													<td class="text-center"><?= $devis['reference']; ?></td>
													<td>
														<?php if(!empty($devis['nom_societe'])){echo "<strong>".$devis['nom_societe']."</strong><br><i>".$devis['nom_client']."</i>";}else{echo $devis['nom_client'];} ?>
													</td>
													<td class="text-center"><?= date("d/m/Y", $devis['date_devis']); ?></td>
													<td class="text-center">
														<?php if($devis_cls->verif_echeance($date_jour_strt, $devis['date_echeance']) == 1){ ?>
															<span class="label label-danger"><i class="fa fa-warning text-warning" data-toggle="tooltip" data-original-title="Arriver à Echéance"></i> <?= date("d-m-Y", $devis['date_echeance']); ?></span>
														<?php }else{ ?>
															<span class="label label-success"><?= date("d-m-Y", $devis['date_echeance']); ?></span>
														<?php } ?>
													</td>
													<td class="text-center">
														<?php
														if($devis['etat_devis'] == 1){echo "<span class='label label-info'><i class='fa fa-spinner fa-spin'></i> En cours...</span>";}
														if($devis['etat_devis'] == 2){echo "<span class='label label-success'><i class='fa fa-check'></i> Accepté</span>";}
														if($devis['etat_devis'] == 3){echo "<span class='label label-danger'><i class='fa fa-times'></i> Refusé</span>";}
														?>
													</td>
													<td class="text-right">
														<?= number_format($devis['total_ht'], 2, ',', ' ')." €"; ?>
													</td>
													<td>
														<button type="button" class="btn" onclick="window.location.href='index.php?view=gestion&sub=devis&data=view_devis&reference=<?= $devis['reference']; ?>'"><i class="fa fa-eye text-primary"></i></button>
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
					<div id="add-devis" data-width="1400" class="modal fade">
						<div class="modal-header bg-success-gradient">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
							<h4 class="modal-title"><i class="fa fa-plus"></i> Ajouter un devis</h4>
						</div>
						<!-- //modal-header-->
						<form class="form-horizontal" action="<?= ROOT,CONTROL; ?>gestion/devis.php" method="post">
							<div class="modal-body">

								<div class="form-group">
									<label class="control-label col-md-3">Client</label>
									<div class="col-md-9">
										<select  class="selectpicker form-control rounded" name="idclient" data-size="10" data-live-search="true">
											<?php
											$sql_client = mysql_query("SELECT * FROM client")or die(mysql_error());
											while($client = mysql_fetch_array($sql_client))
											{
												?>
												<option value="<?= $client['idclient']; ?>"><?php if(!empty($client['nom_societe'])){echo "<strong>".$client['nom_societe']."</strong> - <i>".$client['nom_client']."</i>";}else{echo $client['nom_client'];} ?></option>
											<?php } ?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3">Date du Devis</label>
									<div class="col-md-9">
										<input type="text" id="date_devis" class="form-control" name="date_devis" />
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3">Echéance</label>
									<div class="col-md-9">
										<select  class="selectpicker form-control rounded" name="echeance" data-size="10" data-live-search="true">
											<option value="0">Immédiat</option>
											<option value="604800">7 Jours</option>
											<option value="1296000">15 Jours</option>
											<option value="2592000">30 Jours</option>
											<option value="5184000">60 Jours</option>
											<option value="7776000">90 Jours</option>
										</select>
									</div>
								</div>


							</div>
							<!-- //modal-body-->
							<div class="modal-footer bg-success-gradient">
								<button type="submit" class="btn btn-default pull-right" name="action" value="add-devis"><i class="fa fa-check"></i> Valider</button>
							</div>
						</form>
					</div>
				<?php } ?>
				<?php if(isset($_GET['data']) && $_GET['data'] == 'view_devis'){ ?>
					<?php
					$nom_sector = "GESTION";
					$nom_page = "DEVIS";
					$reference = $_GET['reference'];
					$sql_devis = mysql_query("SELECT * FROM swd_devis, client WHERE swd_devis.idclient = client.idclient AND reference = '$reference'")or die(mysql_error());
					$devis = mysql_fetch_array($sql_devis);
					$iddevis = $devis['iddevis'];
					?>
					<ol class="breadcrumb">
						<li><a href="#"><?= NOM_LOGICIEL; ?></a></li>
						<?php if(!empty($nom_sector)){echo "<li><a href='#'>".$nom_sector."</a></li>";} ?>
						<?php if(!empty($nom_page)){echo "<li><a href='#'>".$nom_page."</a></li>";} ?>
					</ol>
					<!-- //breadcrumb-->

					<div id="content">

						<div class="row">
							<section class="panel corner-flip">
								<div class="panel-body">
									<div class="invoice">
										<div class="row">
											<div class="col-md-12">
												<div class="pull-right">
													<button type="button" class="btn btn-default" onclick="window.location.href='<?= ROOT,TOKEN; ?>pdf/devis.php?reference=<?= $devis['reference']; ?>'"><i class="fa fa-print"></i></button>
													<div class="btn-group pull-right">
														<button type="button" class="btn btn-info">Plus...</button>
														<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button>
														<ul class="dropdown-menu align-xs-left " role="menu">
															<li><a data-toggle="modal" data-target="#edit-devis">Modifier le devis</a></li>
															<li><a data-toggle="modal" data-target="#envoie-devis">Envoyer par email</a></li>
															<li><a href="<?= ROOT,CONTROL; ?>gestion/devis.php?action=devis-refuser&reference=<?= $reference; ?>">Marqué comme Refusé</a></li>
															<li><a href="<?= ROOT,CONTROL; ?>gestion/devis.php?action=devis-accepter&reference=<?= $reference; ?>">Marqué comme Accepté</a></li>
															<li><a href="<?= ROOT,CONTROL; ?>gestion/devis.php?action=transf-facture&reference=<?= $reference; ?>">Transformer en facture</a></li>
															<li class="divider"></li>
															<li><a href="<?= ROOT,CONTROL; ?>gestion/devis.php?action=supp-devis&reference=<?= $reference; ?>">Supprimer le devis</a></li>
														</ul>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
												<a href="#"> <img alt="" src="assets/img/logo_invice.png"> </a>
											</div>
											<div class="col-sm-6 align-lg-right">
												<h3>DEVIS NO. <?= $reference; ?></h3>
												<span><?= date("d",$devis['date_devis']); ?> <?= $date_class->mois(date('n', $devis['date_devis'])); ?> <?= date("Y",$devis['date_devis']); ?></span><br>
												<span>
													&Eacute;chéance:
													<?php if($devis_cls->verif_echeance($date_jour_strt, $devis['date_echeance']) == 1){ ?>
														<span class="label label-danger"><i class="fa fa-warning text-warning" data-toggle="tooltip" data-original-title="Arriver à Echéance"></i> <?= date("d-m-Y", $devis['date_echeance']); ?></span>
													<?php }else{ ?>
														<span class="label label-success"><?= date("d-m-Y", $devis['date_echeance']); ?></span>
													<?php } ?>
												</span>
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-sm-3">
												<h4>Adresser à :</h4>
												<?php if(!empty($devis['nom_societe'])){echo "<strong>".$devis['nom_societe']."</strong><br><i>".$devis['nom_client']."</i>";}else{echo "<strong>".$devis['nom_client']."</strong>";} ?><br>
												<?= html_entity_decode($devis['adresse']); ?><br>
												<?= $devis['code_postal']; ?> <?= html_entity_decode($devis['ville']); ?>
											</div>
											<div class="col-md-9 align-lg-right">
												<h4>Détail des Informations :</h4>
												<strong>Téléphone:</strong> 0<?= substr($devis['telephone'], 4, 12); ?>  <br>
												<strong>Numéro de compte:</strong> <?= $devis['num_client']; ?> <br>
											</div>
										</div>
										<br>
										<br>
										<table class="table table-bordered">
											<thead>
											<tr>
												<th>#</th>
												<th width="60%" class="text-left">Désignation</th>
												<th>Quantité/Heure</th>
												<th class="text-right">Prix</th>
												<th class="text-center">Action</th>
											</tr>
											</thead>
											<tbody>
											<?php if($devis_cls->verif_count_fam_ndd($iddevis) != 0){ ?>
												<tr>
													<td colspan="5" style="background-color: #00a1f3; color: white; font-weight: 700;">NOM DE DOMAINE</td>
												</tr>
												<?php
												$sql_ligne = mysql_query("SELECT * FROM swd_devis_ligne, swd_article WHERE swd_devis_ligne.idarticle = swd_article.idarticle AND swd_article.famille='4' AND swd_devis_ligne.iddevis = '$iddevis'")or die(mysql_error());
												while($ligne = mysql_fetch_array($sql_ligne))
												{
												?>
												<tr>
													<td class="text-center"><?= $ligne['code_article']; ?></td>
													<td><?= html_entity_decode($ligne['nom_article']); ?><br><i><?= html_entity_decode($ligne['commentaire']); ?></i></td>
													<td class="text-center"><?= $ligne['qte']; ?></td>
													<td class="text-right"><?= number_format($ligne['total_ligne'], 2, ',',' ')." €"; ?></td>
													<td>
														<button type="button" class="btn"><i class="fa fa-edit text-info"></i></button>
														<button type="button" class="btn"><i class="fa fa-remove text-danger"></i></button>
													</td>
												</tr>
												<?php } ?>
											<?php } ?>
											</tbody>
											<tfoot>
											<tr>
												<td colspan="3" class="text-right" style="font-weight: 700;">Total du devis</td>
												<td class="text-right"><?= number_format($devis['total_ht'], 2, ',', ' ')." €"; ?></td>
											</tr>
											</tfoot>
										</table>
										<button type="button" class="btn btn-success"><i class="fa fa-plus"></i> Ajouter un article</button>
										<br><br>

									</div>
									<!-- //invoice -->
								</div>
							</section>
						</div>
						<!-- //content > row-->

					</div>
					<div id="add-devis" data-width="1400" class="modal fade">
						<div class="modal-header bg-success-gradient">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
							<h4 class="modal-title"><i class="fa fa-plus"></i> Ajouter un devis</h4>
						</div>
						<!-- //modal-header-->
						<form class="form-horizontal" action="<?= ROOT,CONTROL; ?>gestion/article.php" method="post">
							<div class="modal-body">

								<div class="form-group">
									<label class="control-label col-md-3">Client</label>
									<div class="col-md-9">
										<select  class="selectpicker form-control rounded" name="idclient" data-size="10" data-live-search="true">
											<?php
											$sql_client = mysql_query("SELECT * FROM client")or die(mysql_error());
											while($client = mysql_fetch_array($sql_client))
											{
												?>
												<option value="<?= $client['idclient']; ?>"><?php if(!empty($client['nom_societe'])){echo "<strong>".$client['nom_societe']."</strong> - <i>".$client['nom_client']."</i>";}else{echo $client['nom_client'];} ?></option>
											<?php } ?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3">Date du Devis</label>
									<div class="col-md-9">
										<input type="text" id="date_devis" class="form-control" name="date_devis" />
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3">Echéance</label>
									<div class="col-md-9">
										<select  class="selectpicker form-control rounded" name="echeance" data-size="10" data-live-search="true">
											<option value="0">Immédiat</option>
											<option value="604800">7 Jours</option>
											<option value="1296000">15 Jours</option>
											<option value="2592000">30 Jours</option>
											<option value="5184000">60 Jours</option>
											<option value="7776000">90 Jours</option>
										</select>
									</div>
								</div>


							</div>
							<!-- //modal-body-->
							<div class="modal-footer bg-success-gradient">
								<button type="submit" class="btn btn-default pull-right" name="action" value="add-devis"><i class="fa fa-check"></i> Valider</button>
							</div>
						</form>
					</div>
				<?php } ?>
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
<?php if(isset($_GET['success']) && $_GET['success'] == 'add-client'){ ?>
	<script type="text/javascript">
		$(function(){
			toastr.success("Le client à bien été Créé", "CLIENT",{
				progressBar: true,
				positionClass: "toast-bottom-right"
			})
		})
	</script>
<?php } ?>
<?php if(isset($_GET['success']) && $_GET['success'] == 'edit-client'){ ?>
	<script type="text/javascript">
		$(function(){
			toastr.success("Le client à bien été Modifié", "CLIENT",{
				progressBar: true,
				positionClass: "toast-bottom-right"
			})
		})
	</script>
<?php } ?>
<?php if(isset($_GET['success']) && $_GET['success'] == 'supp-client'){ ?>
	<script type="text/javascript">
		$(function(){
			toastr.success("Le client à bien été Supprimé", "CLIENT",{
				progressBar: true,
				positionClass: "toast-bottom-right"
			})
		})
	</script>
<?php } ?>
<?php if(isset($_GET['success']) && $_GET['success'] == 'add-famille'){ ?>
	<script type="text/javascript">
		$(function(){
			toastr.success("La famille d'article à été créé", "FAMILLE ARTICLE",{
				progressBar: true,
				positionClass: "toast-bottom-right"
			})
		})
	</script>
<?php } ?>
<?php if(isset($_GET['success']) && $_GET['success'] == 'supp-famille'){ ?>
	<script type="text/javascript">
		$(function(){
			toastr.success("La famille d'article à été supprimé", "FAMILLE ARTICLE",{
				progressBar: true,
				positionClass: "toast-bottom-right"
			})
		})
	</script>
<?php } ?>
<?php if(isset($_GET['success']) && $_GET['success'] == 'add-article'){ ?>
	<script type="text/javascript">
		$(function(){
			toastr.success("L'article <strong><?= $_GET['code_article']; ?></strong> à été créé", "ARTICLE",{
				progressBar: true,
				positionClass: "toast-bottom-right"
			})
		})
	</script>
<?php } ?>
<?php if(isset($_GET['success']) && $_GET['success'] == 'edit-article'){ ?>
	<script type="text/javascript">
		$(function(){
			toastr.success("L'article <strong><?= $_GET['code_article']; ?></strong> à été modifié", "ARTICLE",{
				progressBar: true,
				positionClass: "toast-bottom-right"
			})
		})
	</script>
<?php } ?>
<?php if(isset($_GET['success']) && $_GET['success'] == 'supp-article'){ ?>
	<script type="text/javascript">
		$(function(){
			toastr.success("L'article à été supprimé", "ARTICLE",{
				progressBar: true,
				positionClass: "toast-bottom-right"
			})
		})
	</script>
<?php } ?>
<?php if(isset($_GET['success']) && $_GET['success'] == 'add-caracteristique'){ ?>
	<script type="text/javascript">
		$(function(){
			toastr.success("La caractéristique à été créé", "CARACTERISTIQUE ARTICLE",{
				progressBar: true,
				positionClass: "toast-bottom-right"
			})
		})
	</script>
<?php } ?>
<?php if(isset($_GET['success']) && $_GET['success'] == 'supp-caracteristique'){ ?>
	<script type="text/javascript">
		$(function(){
			toastr.success("La caractéristique à été supprimé", "CARACTERISTIQUE ARTICLE",{
				progressBar: true,
				positionClass: "toast-bottom-right"
			})
		})
	</script>
<?php } ?>
<?php if(isset($_GET['success']) && $_GET['success'] == 'add-devis'){ ?>
	<script type="text/javascript">
		$(function(){
			toastr.success("Le devis <strong><?= $_GET['reference']; ?></strong> à été créé", "DEVIS",{
				progressBar: true,
				positionClass: "toast-bottom-right"
			})
		})
	</script>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////-->

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
<?php if(isset($_GET['error']) && $_GET['error'] == 'add-client'){ ?>
	<script type="text/javascript">
		$(function(){
			toastr.error("Une erreur à eu lieu lors de la création du client", "CLIENT",{
				progressBar: true,
				positionClass: "toast-bottom-right"
			})
		})
	</script>
<?php } ?>
<?php if(isset($_GET['error']) && $_GET['error'] == 'edit-client'){ ?>
	<script type="text/javascript">
		$(function(){
			toastr.error("Une erreur à eu lieu lors de la modification du client", "CLIENT",{
				progressBar: true,
				positionClass: "toast-bottom-right"
			})
		})
	</script>
<?php } ?>
<?php if(isset($_GET['error']) && $_GET['error'] == 'supp-client'){ ?>
	<script type="text/javascript">
		$(function(){
			toastr.error("Une erreur à eu lieu lors de la suppression du client", "CLIENT",{
				progressBar: true,
				positionClass: "toast-bottom-right"
			})
		})
	</script>
<?php } ?>
<?php if(isset($_GET['error']) && $_GET['error'] == 'add-famille'){ ?>
	<script type="text/javascript">
		$(function(){
			toastr.error("Une erreur à eu lieu lors de la création de la famille d'article", "FAMILLE ARTICLE",{
				progressBar: true,
				positionClass: "toast-bottom-right"
			})
		})
	</script>
<?php } ?>
<?php if(isset($_GET['error']) && $_GET['error'] == 'supp-famille'){ ?>
	<script type="text/javascript">
		$(function(){
			toastr.error("Une erreur à eu lieu lors de la suppression de la famille d'article", "FAMILLE ARTICLE",{
				progressBar: true,
				positionClass: "toast-bottom-right"
			})
		})
	</script>
<?php } ?>
<?php if(isset($_GET['error']) && $_GET['error'] == 'add-article'){ ?>
	<script type="text/javascript">
		$(function(){
			toastr.error("Une erreur à eu lieu lors de la création de l'article", "ARTICLE",{
				progressBar: true,
				positionClass: "toast-bottom-right"
			})
		})
	</script>
<?php } ?>
<?php if(isset($_GET['error']) && $_GET['error'] == 'edit-article'){ ?>
	<script type="text/javascript">
		$(function(){
			toastr.error("Une erreur à eu lieu lors de l'édition de l'article", "ARTICLE",{
				progressBar: true,
				positionClass: "toast-bottom-right"
			})
		})
	</script>
<?php } ?>
<?php if(isset($_GET['error']) && $_GET['error'] == 'supp-article'){ ?>
	<script type="text/javascript">
		$(function(){
			toastr.error("Une erreur à eu lieu lors de la suppression de l'article", "ARTICLE",{
				progressBar: true,
				positionClass: "toast-bottom-right"
			})
		})
	</script>
<?php } ?>
<?php if(isset($_GET['error']) && $_GET['error'] == 'add-caracteristique'){ ?>
	<script type="text/javascript">
		$(function(){
			toastr.error("Une erreur à eu lieu lors de la création de la caractéristique", "CARACTERISTIQUE ARTICLE",{
				progressBar: true,
				positionClass: "toast-bottom-right"
			})
		})
	</script>
<?php } ?>
<?php if(isset($_GET['error']) && $_GET['error'] == 'supp-caracteristique'){ ?>
	<script type="text/javascript">
		$(function(){
			toastr.error("Une erreur à eu lieu lors de la suppression de la caractéristique", "CARACTERISTIQUE ARTICLE",{
				progressBar: true,
				positionClass: "toast-bottom-right"
			})
		})
	</script>
<?php } ?>
<?php if(isset($_GET['error']) && $_GET['error'] == 'add-devis'){ ?>
	<script type="text/javascript">
		$(function(){
			toastr.error("Une erreur à eu lieu lors de la création du devis", "DEVIS",{
				progressBar: true,
				positionClass: "toast-bottom-right"
			})
		})
	</script>
<?php } ?>

<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<?php if(isset($_GET['warning']) && $_GET['warning'] == 'existing-product'){ ?>
	<script type="text/javascript">
		$(function(){
			toastr.warning("La famille d'article ne peut pas être supprimer car des articles lui son affilié", "FAMILLE ARTICLE",{
				progressBar: true,
				positionClass: "toast-bottom-right"
			})
		})
	</script>
<?php } ?>
<?php if(isset($_GET['warning']) && $_GET['warning'] == 'existing-facture'){ ?>
	<script type="text/javascript">
		$(function(){
			toastr.warning("L'article ne peut pas être supprimer car cette article existe dans des factures émise au client", "ARTICLE",{
				progressBar: true,
				positionClass: "toast-bottom-right"
			})
		})
	</script>
<?php } ?>

</body>
</html>
