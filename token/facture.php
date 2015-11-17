<?php
$nom_sector = "";
$nom_page = "Bienvenue";
include "../inc/config.php";
include "../inc/classe.php";
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
<?php
$reference = $_GET['reference'];
$sql_facture = mysql_query("SELECT * FROM swd_facture, client WHERE swd_facture.idclient = client.idclient AND reference = '$reference'")or die(mysql_error());
$facture = mysql_fetch_array($sql_facture);
$idfacture = $facture['idfacture'];
?>
<body class="leftMenu nav-collapse">
<div id="wrapper">
		<div id="main">
				<!-- //breadcrumb-->

				<div id="content">
					<div class="row">
						<section class="panel corner-flip">
							<div class="panel-body">
								<div class="invoice">
									<div class="row">
										<div class="col-md-12">
											<div class="pull-right">
												<button type="button" class="btn" onclick="window.location.href='<?= ROOT,TOKEN; ?>pdf/facture.php?reference=<?= $reference; ?>'"><i class="fa fa-file-pdf-o"></i> Imprimer le devis (pdf)</button>
												<?php if($facture_cls->total_reglement($idfacture) != $facture['total_ht']){?>
													<button type="button" class="btn bg-danger" data-toggle="modal" data-target="#add-paiement"><i class="fa fa-credit-card"></i> Payer la facture</button>
												<?php } ?>
											</div>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-sm-6">
											<a href="#"> <img alt="" src="../assets/img/logo_invice.png"> </a><br>
											<img src="../assets/img/dot-bar.png" />
											<?php
											if($facture['etat_facture'] == 1){echo "<button type=\"button\" class=\"btn disabled bg-danger-gradient\" style=\"font-size: 25px\"><i class=\"fa fa-spinner fa-spin\"></i> IMPAYE</button>";}
											if($facture['etat_facture'] == 2){echo "<button type=\"button\" class=\"btn disabled bg-warning-gradient\" style=\"font-size: 25px\"><i class=\"fa fa-warning\"></i> PARTIELLEMENT PAYE</button>";}
											if($facture['etat_facture'] == 3){echo "<button type=\"button\" class=\"btn disabled bg-success-gradient\" style=\"font-size: 25px\"><i class=\"fa fa-check\"></i> PAYE</button>";}
											?>
										</div>
										<div class="col-sm-6 align-lg-right">
											<h3>FACTURE NO. <?= $reference; ?></h3>
											<span><?= date("d",$facture['date_facture']); ?> <?= $date_class->mois(date('n', $facture['date_facture'])); ?> <?= date("Y",$facture['date_facture']); ?></span><br>
												<span>
													&Eacute;chéance:
													<?php if($facture_cls->verif_echeance($date_jour_strt, $facture['date_echeance']) == 1){ ?>
														<span class="label label-danger"><i class="fa fa-warning text-warning" data-toggle="tooltip" data-original-title="Arriver à Echéance"></i> <?= date("d-m-Y", $facture['date_echeance']); ?></span>
													<?php }else{ ?>
														<span class="label label-success"><?= date("d-m-Y", $facture['date_echeance']); ?></span>
													<?php } ?>
												</span><br>

										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-sm-3">
											<h4>Adresser à :</h4>
											<?php if(!empty($facture['nom_societe'])){echo "<strong>".$facture['nom_societe']."</strong><br><i>".$facture['nom_client']."</i>";}else{echo "<strong>".$facture['nom_client']."</strong>";} ?><br>
											<?= html_entity_decode($facture['adresse']); ?><br>
											<?= $facture['code_postal']; ?> <?= html_entity_decode($facture['ville']); ?>
										</div>
										<div class="col-md-9 align-lg-right">
											<h4>Détail des Informations :</h4>
											<strong>Téléphone:</strong> 0<?= substr($facture['telephone'], 4, 12); ?>  <br>
											<strong>Numéro de compte:</strong> <?= $facture['num_client']; ?> <br>
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
										<?php if($facture_cls->verif_count_fam_ndd($idfacture) != 0){ ?>
											<tr>
												<td colspan="5" style="background-color: #00a1f3; color: white; font-weight: 700;">NOM DE DOMAINE</td>
											</tr>
											<?php
											$sql_ligne = mysql_query("SELECT * FROM swd_facture_ligne, swd_article WHERE swd_facture_ligne.idarticle = swd_article.idarticle AND swd_article.famille='4' AND swd_facture_ligne.idfacture = '$idfacture'")or die(mysql_error());
											while($ligne = mysql_fetch_array($sql_ligne))
											{
												?>
												<tr>
													<td class="text-center"><?= $ligne['code_article']; ?></td>
													<td><?= html_entity_decode($ligne['nom_article']); ?><br><i><?= html_entity_decode($ligne['commentaire']); ?></i></td>
													<td class="text-center"><?= $ligne['qte']; ?></td>
													<td class="text-right"><?= number_format($ligne['total_ligne'], 2, ',',' ')." €"; ?></td>
													<td>
														<button type="button" class="btn" data-toggle="modal" data-target="#edit-article-facture"><i class="fa fa-edit text-info"></i></button>
														<button type="button" class="btn" onclick="window.location.href='<?= ROOT,CONTROL; ?>gestion/facture.php?action=supp-article-facture&idfactureligne=<?= $ligne['idfactureligne']; ?>'"><i class="fa fa-remove text-danger"></i></button>
													</td>
												</tr>
												<div id="edit-article-facture" data-width="1400" class="modal fade">
													<div class="modal-header bg-info-gradient">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
														<h4 class="modal-title"><i class="fa fa-edit"></i> Editer un article de la facture</h4>
													</div>
													<!-- //modal-header-->
													<form class="form-horizontal" action="<?= ROOT,CONTROL; ?>gestion/facture.php" method="post">
														<input type="hidden" name="idfactureligne" value="<?= $ligne['idfactureligne']; ?>" />
														<div class="modal-body">

															<div class="form-group">
																<label class="control-label col-md-3">Article</label>
																<div class="col-md-9">
																	<select  class="selectpicker form-control rounded" name="echeance" data-size="10" data-live-search="true">
																		<?php
																		$sql_article_ligne = mysql_query("SELECT * FROM swd_article WHERE idarticle = ".$ligne['idarticle']);
																		$article_ligne = mysql_fetch_array($sql_article_ligne);
																		?>
																		<option value="<?= $article_ligne['idarticle']; ?>"><?= $article_ligne['nom_article']; ?></option>
																		<?php
																		$sql_famille = mysql_query("SELECT * FROM swd_famille_article")or die(mysql_error());
																		while($famille = mysql_fetch_array($sql_famille))
																		{
																			?>
																			<optgroup label="<?= $famille['designation_famille']; ?>">
																				<?php
																				$sql_article = mysql_query("SELECT * FROM swd_article WHERE famille =".$famille['idfamillearticle'])or die(mysql_error());
																				while($article = mysql_fetch_array($sql_article))
																				{
																					?>
																					<option value="<?= $article['idarticle']; ?>"><?= $article['nom_article']; ?></option>
																				<?php } ?>
																			</optgroup>
																		<?php } ?>
																	</select>
																</div>
															</div>


															<div class="form-group">
																<label class="control-label col-md-3">Commentaire</label>
																<div class="col-md-9">
																	<textarea class="form-control" rows="5" maxlength="255" data-always-show="true"  data-position="bottom-left" name="commentaire"><?= html_entity_decode($ligne['commentaire']); ?></textarea>
																</div>
															</div>


														</div>
														<!-- //modal-body-->
														<div class="modal-footer bg-success-gradient">
															<button type="submit" class="btn btn-default pull-right" name="action" value="edit-article-facture"><i class="fa fa-check"></i> Valider</button>
														</div>
													</form>
												</div>
											<?php } ?>
										<?php } ?>
										<?php if($facture_cls->verif_count_fam_heber($idfacture) != 0){ ?>
											<tr>
												<td colspan="5" style="background-color: #00a1f3; color: white; font-weight: 700;">HEBERGEMENT</td>
											</tr>
											<?php
											$sql_ligne = mysql_query("SELECT * FROM swd_facture_ligne, swd_article WHERE swd_facture_ligne.idarticle = swd_article.idarticle AND swd_article.famille='5' AND swd_facture_ligne.idfacture = '$idfacture'")or die(mysql_error());
											while($ligne = mysql_fetch_array($sql_ligne))
											{
												?>
												<tr>
													<td class="text-center"><?= $ligne['code_article']; ?></td>
													<td><?= html_entity_decode($ligne['nom_article']); ?><br><i><?= html_entity_decode($ligne['commentaire']); ?></i></td>
													<td class="text-center"><?= $ligne['qte']; ?></td>
													<td class="text-right"><?= number_format($ligne['total_ligne'], 2, ',',' ')." €"; ?></td>
													<td>
														<button type="button" class="btn" data-toggle="modal" data-target="#edit-article-facture"><i class="fa fa-edit text-info"></i></button>
														<button type="button" class="btn" onclick="window.location.href='<?= ROOT,CONTROL; ?>gestion/facture.php?action=supp-article-facture&idfactureligne=<?= $ligne['idfactureligne']; ?>'"><i class="fa fa-remove text-danger"></i></button>
													</td>
												</tr>
												<div id="edit-article-facture" data-width="1400" class="modal fade">
													<div class="modal-header bg-info-gradient">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
														<h4 class="modal-title"><i class="fa fa-edit"></i> Editer un article de la facture</h4>
													</div>
													<!-- //modal-header-->
													<form class="form-horizontal" action="<?= ROOT,CONTROL; ?>gestion/facture.php" method="post">
														<input type="hidden" name="idfactureligne" value="<?= $ligne['idfactureligne']; ?>" />
														<div class="modal-body">

															<div class="form-group">
																<label class="control-label col-md-3">Article</label>
																<div class="col-md-9">
																	<select  class="selectpicker form-control rounded" name="echeance" data-size="10" data-live-search="true">
																		<?php
																		$sql_article_ligne = mysql_query("SELECT * FROM swd_article WHERE idarticle = ".$ligne['idarticle']);
																		$article_ligne = mysql_fetch_array($sql_article_ligne);
																		?>
																		<option value="<?= $article_ligne['idarticle']; ?>"><?= $article_ligne['nom_article']; ?></option>
																		<?php
																		$sql_famille = mysql_query("SELECT * FROM swd_famille_article")or die(mysql_error());
																		while($famille = mysql_fetch_array($sql_famille))
																		{
																			?>
																			<optgroup label="<?= $famille['designation_famille']; ?>">
																				<?php
																				$sql_article = mysql_query("SELECT * FROM swd_article WHERE famille =".$famille['idfamillearticle'])or die(mysql_error());
																				while($article = mysql_fetch_array($sql_article))
																				{
																					?>
																					<option value="<?= $article['idarticle']; ?>"><?= $article['nom_article']; ?></option>
																				<?php } ?>
																			</optgroup>
																		<?php } ?>
																	</select>
																</div>
															</div>


															<div class="form-group">
																<label class="control-label col-md-3">Commentaire</label>
																<div class="col-md-9">
																	<textarea class="form-control" rows="5" maxlength="255" data-always-show="true"  data-position="bottom-left" name="commentaire"><?= html_entity_decode($ligne['commentaire']); ?></textarea>
																</div>
															</div>


														</div>
														<!-- //modal-body-->
														<div class="modal-footer bg-success-gradient">
															<button type="submit" class="btn btn-default pull-right" name="action" value="edit-article-facture"><i class="fa fa-check"></i> Valider</button>
														</div>
													</form>
												</div>
											<?php } ?>
										<?php } ?>
										<?php if($facture_cls->verif_count_fam_em($idfacture) != 0){ ?>
											<tr>
												<td colspan="5" style="background-color: #00a1f3; color: white; font-weight: 700;">EMAIL</td>
											</tr>
											<?php
											$sql_ligne = mysql_query("SELECT * FROM swd_facture_ligne, swd_article WHERE swd_facture_ligne.idarticle = swd_article.idarticle AND swd_article.famille='6' AND swd_facture_ligne.idfacture = '$idfacture'")or die(mysql_error());
											while($ligne = mysql_fetch_array($sql_ligne))
											{
												?>
												<tr>
													<td class="text-center"><?= $ligne['code_article']; ?></td>
													<td><?= html_entity_decode($ligne['nom_article']); ?><br><i><?= html_entity_decode($ligne['commentaire']); ?></i></td>
													<td class="text-center"><?= $ligne['qte']; ?></td>
													<td class="text-right"><?= number_format($ligne['total_ligne'], 2, ',',' ')." €"; ?></td>
													<td>
														<button type="button" class="btn" data-toggle="modal" data-target="#edit-article-facture"><i class="fa fa-edit text-info"></i></button>
														<button type="button" class="btn" onclick="window.location.href='<?= ROOT,CONTROL; ?>gestion/facture.php?action=supp-article-facture&idfactureligne=<?= $ligne['idfactureligne']; ?>'"><i class="fa fa-remove text-danger"></i></button>
													</td>
												</tr>
												<div id="edit-article-facture" data-width="1400" class="modal fade">
													<div class="modal-header bg-info-gradient">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
														<h4 class="modal-title"><i class="fa fa-edit"></i> Editer un article de la facture</h4>
													</div>
													<!-- //modal-header-->
													<form class="form-horizontal" action="<?= ROOT,CONTROL; ?>gestion/facture.php" method="post">
														<input type="hidden" name="idfactureligne" value="<?= $ligne['idfactureligne']; ?>" />
														<div class="modal-body">

															<div class="form-group">
																<label class="control-label col-md-3">Article</label>
																<div class="col-md-9">
																	<select  class="selectpicker form-control rounded" name="echeance" data-size="10" data-live-search="true">
																		<?php
																		$sql_article_ligne = mysql_query("SELECT * FROM swd_article WHERE idarticle = ".$ligne['idarticle']);
																		$article_ligne = mysql_fetch_array($sql_article_ligne);
																		?>
																		<option value="<?= $article_ligne['idarticle']; ?>"><?= $article_ligne['nom_article']; ?></option>
																		<?php
																		$sql_famille = mysql_query("SELECT * FROM swd_famille_article")or die(mysql_error());
																		while($famille = mysql_fetch_array($sql_famille))
																		{
																			?>
																			<optgroup label="<?= $famille['designation_famille']; ?>">
																				<?php
																				$sql_article = mysql_query("SELECT * FROM swd_article WHERE famille =".$famille['idfamillearticle'])or die(mysql_error());
																				while($article = mysql_fetch_array($sql_article))
																				{
																					?>
																					<option value="<?= $article['idarticle']; ?>"><?= $article['nom_article']; ?></option>
																				<?php } ?>
																			</optgroup>
																		<?php } ?>
																	</select>
																</div>
															</div>


															<div class="form-group">
																<label class="control-label col-md-3">Commentaire</label>
																<div class="col-md-9">
																	<textarea class="form-control" rows="5" maxlength="255" data-always-show="true"  data-position="bottom-left" name="commentaire"><?= html_entity_decode($ligne['commentaire']); ?></textarea>
																</div>
															</div>


														</div>
														<!-- //modal-body-->
														<div class="modal-footer bg-success-gradient">
															<button type="submit" class="btn btn-default pull-right" name="action" value="edit-article-facture"><i class="fa fa-check"></i> Valider</button>
														</div>
													</form>
												</div>
											<?php } ?>
										<?php } ?>
										<?php if($facture_cls->verif_count_fam_sd($idfacture) != 0){ ?>
											<tr>
												<td colspan="5" style="background-color: #00a1f3; color: white; font-weight: 700;">SERVEUR DEDIE</td>
											</tr>
											<?php
											$sql_ligne = mysql_query("SELECT * FROM swd_facture_ligne, swd_article WHERE swd_facture_ligne.idarticle = swd_article.idarticle AND swd_article.famille='7' AND swd_facture_ligne.idfacture = '$idfacture'")or die(mysql_error());
											while($ligne = mysql_fetch_array($sql_ligne))
											{
												?>
												<tr>
													<td class="text-center"><?= $ligne['code_article']; ?></td>
													<td><?= html_entity_decode($ligne['nom_article']); ?><br><i><?= html_entity_decode($ligne['commentaire']); ?></i></td>
													<td class="text-center"><?= $ligne['qte']; ?></td>
													<td class="text-right"><?= number_format($ligne['total_ligne'], 2, ',',' ')." €"; ?></td>
													<td>
														<button type="button" class="btn" data-toggle="modal" data-target="#edit-article-facture"><i class="fa fa-edit text-info"></i></button>
														<button type="button" class="btn" onclick="window.location.href='<?= ROOT,CONTROL; ?>gestion/facture.php?action=supp-article-facture&idfactureligne=<?= $ligne['idfactureligne']; ?>'"><i class="fa fa-remove text-danger"></i></button>
													</td>
												</tr>
												<div id="edit-article-facture" data-width="1400" class="modal fade">
													<div class="modal-header bg-info-gradient">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
														<h4 class="modal-title"><i class="fa fa-edit"></i> Editer un article de la facture</h4>
													</div>
													<!-- //modal-header-->
													<form class="form-horizontal" action="<?= ROOT,CONTROL; ?>gestion/facture.php" method="post">
														<input type="hidden" name="idfactureligne" value="<?= $ligne['idfactureligne']; ?>" />
														<div class="modal-body">

															<div class="form-group">
																<label class="control-label col-md-3">Article</label>
																<div class="col-md-9">
																	<select  class="selectpicker form-control rounded" name="echeance" data-size="10" data-live-search="true">
																		<?php
																		$sql_article_ligne = mysql_query("SELECT * FROM swd_article WHERE idarticle = ".$ligne['idarticle']);
																		$article_ligne = mysql_fetch_array($sql_article_ligne);
																		?>
																		<option value="<?= $article_ligne['idarticle']; ?>"><?= $article_ligne['nom_article']; ?></option>
																		<?php
																		$sql_famille = mysql_query("SELECT * FROM swd_famille_article")or die(mysql_error());
																		while($famille = mysql_fetch_array($sql_famille))
																		{
																			?>
																			<optgroup label="<?= $famille['designation_famille']; ?>">
																				<?php
																				$sql_article = mysql_query("SELECT * FROM swd_article WHERE famille =".$famille['idfamillearticle'])or die(mysql_error());
																				while($article = mysql_fetch_array($sql_article))
																				{
																					?>
																					<option value="<?= $article['idarticle']; ?>"><?= $article['nom_article']; ?></option>
																				<?php } ?>
																			</optgroup>
																		<?php } ?>
																	</select>
																</div>
															</div>


															<div class="form-group">
																<label class="control-label col-md-3">Commentaire</label>
																<div class="col-md-9">
																	<textarea class="form-control" rows="5" maxlength="255" data-always-show="true"  data-position="bottom-left" name="commentaire"><?= html_entity_decode($ligne['commentaire']); ?></textarea>
																</div>
															</div>


														</div>
														<!-- //modal-body-->
														<div class="modal-footer bg-success-gradient">
															<button type="submit" class="btn btn-default pull-right" name="action" value="edit-article-facture"><i class="fa fa-check"></i> Valider</button>
														</div>
													</form>
												</div>
											<?php } ?>
										<?php } ?>
										<?php if($facture_cls->verif_count_fam_vps($idfacture) != 0){ ?>
											<tr>
												<td colspan="5" style="background-color: #00a1f3; color: white; font-weight: 700;">VPS</td>
											</tr>
											<?php
											$sql_ligne = mysql_query("SELECT * FROM swd_facture_ligne, swd_article WHERE swd_facture_ligne.idarticle = swd_article.idarticle AND swd_article.famille='8' AND swd_facture_ligne.idfacture = '$idfacture'")or die(mysql_error());
											while($ligne = mysql_fetch_array($sql_ligne))
											{
												?>
												<tr>
													<td class="text-center"><?= $ligne['code_article']; ?></td>
													<td><?= html_entity_decode($ligne['nom_article']); ?><br><i><?= html_entity_decode($ligne['commentaire']); ?></i></td>
													<td class="text-center"><?= $ligne['qte']; ?></td>
													<td class="text-right"><?= number_format($ligne['total_ligne'], 2, ',',' ')." €"; ?></td>
													<td>
														<button type="button" class="btn" data-toggle="modal" data-target="#edit-article-facture"><i class="fa fa-edit text-info"></i></button>
														<button type="button" class="btn" onclick="window.location.href='<?= ROOT,CONTROL; ?>gestion/facture.php?action=supp-article-facture&idfactureligne=<?= $ligne['idfactureligne']; ?>'"><i class="fa fa-remove text-danger"></i></button>
													</td>
												</tr>
												<div id="edit-article-facture" data-width="1400" class="modal fade">
													<div class="modal-header bg-info-gradient">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
														<h4 class="modal-title"><i class="fa fa-edit"></i> Editer un article de la facture</h4>
													</div>
													<!-- //modal-header-->
													<form class="form-horizontal" action="<?= ROOT,CONTROL; ?>gestion/facture.php" method="post">
														<input type="hidden" name="idfactureligne" value="<?= $ligne['idfactureligne']; ?>" />
														<div class="modal-body">

															<div class="form-group">
																<label class="control-label col-md-3">Article</label>
																<div class="col-md-9">
																	<select  class="selectpicker form-control rounded" name="echeance" data-size="10" data-live-search="true">
																		<?php
																		$sql_article_ligne = mysql_query("SELECT * FROM swd_article WHERE idarticle = ".$ligne['idarticle']);
																		$article_ligne = mysql_fetch_array($sql_article_ligne);
																		?>
																		<option value="<?= $article_ligne['idarticle']; ?>"><?= $article_ligne['nom_article']; ?></option>
																		<?php
																		$sql_famille = mysql_query("SELECT * FROM swd_famille_article")or die(mysql_error());
																		while($famille = mysql_fetch_array($sql_famille))
																		{
																			?>
																			<optgroup label="<?= $famille['designation_famille']; ?>">
																				<?php
																				$sql_article = mysql_query("SELECT * FROM swd_article WHERE famille =".$famille['idfamillearticle'])or die(mysql_error());
																				while($article = mysql_fetch_array($sql_article))
																				{
																					?>
																					<option value="<?= $article['idarticle']; ?>"><?= $article['nom_article']; ?></option>
																				<?php } ?>
																			</optgroup>
																		<?php } ?>
																	</select>
																</div>
															</div>


															<div class="form-group">
																<label class="control-label col-md-3">Commentaire</label>
																<div class="col-md-9">
																	<textarea class="form-control" rows="5" maxlength="255" data-always-show="true"  data-position="bottom-left" name="commentaire"><?= html_entity_decode($ligne['commentaire']); ?></textarea>
																</div>
															</div>


														</div>
														<!-- //modal-body-->
														<div class="modal-footer bg-success-gradient">
															<button type="submit" class="btn btn-default pull-right" name="action" value="edit-article-facture"><i class="fa fa-check"></i> Valider</button>
														</div>
													</form>
												</div>
											<?php } ?>
										<?php } ?>
										<?php if($facture_cls->verif_count_fam_ri($idfacture) != 0){ ?>
											<tr>
												<td colspan="5" style="background-color: #00a1f3; color: white; font-weight: 700;">RESEAU & INFRASTRUCTURE</td>
											</tr>
											<?php
											$sql_ligne = mysql_query("SELECT * FROM swd_facture_ligne, swd_article WHERE swd_facture_ligne.idarticle = swd_article.idarticle AND swd_article.famille='9' AND swd_facture_ligne.idfacture = '$idfacture'")or die(mysql_error());
											while($ligne = mysql_fetch_array($sql_ligne))
											{
												?>
												<tr>
													<td class="text-center"><?= $ligne['code_article']; ?></td>
													<td><?= html_entity_decode($ligne['nom_article']); ?><br><i><?= html_entity_decode($ligne['commentaire']); ?></i></td>
													<td class="text-center"><?= $ligne['qte']; ?></td>
													<td class="text-right"><?= number_format($ligne['total_ligne'], 2, ',',' ')." €"; ?></td>
													<td>
														<button type="button" class="btn" data-toggle="modal" data-target="#edit-article-facture"><i class="fa fa-edit text-info"></i></button>
														<button type="button" class="btn" onclick="window.location.href='<?= ROOT,CONTROL; ?>gestion/facture.php?action=supp-article-facture&idfactureligne=<?= $ligne['idfactureligne']; ?>'"><i class="fa fa-remove text-danger"></i></button>
													</td>
												</tr>
												<div id="edit-article-facture" data-width="1400" class="modal fade">
													<div class="modal-header bg-info-gradient">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
														<h4 class="modal-title"><i class="fa fa-edit"></i> Editer un article de la facture</h4>
													</div>
													<!-- //modal-header-->
													<form class="form-horizontal" action="<?= ROOT,CONTROL; ?>gestion/facture.php" method="post">
														<input type="hidden" name="idfactureligne" value="<?= $ligne['idfactureligne']; ?>" />
														<div class="modal-body">

															<div class="form-group">
																<label class="control-label col-md-3">Article</label>
																<div class="col-md-9">
																	<select  class="selectpicker form-control rounded" name="echeance" data-size="10" data-live-search="true">
																		<?php
																		$sql_article_ligne = mysql_query("SELECT * FROM swd_article WHERE idarticle = ".$ligne['idarticle']);
																		$article_ligne = mysql_fetch_array($sql_article_ligne);
																		?>
																		<option value="<?= $article_ligne['idarticle']; ?>"><?= $article_ligne['nom_article']; ?></option>
																		<?php
																		$sql_famille = mysql_query("SELECT * FROM swd_famille_article")or die(mysql_error());
																		while($famille = mysql_fetch_array($sql_famille))
																		{
																			?>
																			<optgroup label="<?= $famille['designation_famille']; ?>">
																				<?php
																				$sql_article = mysql_query("SELECT * FROM swd_article WHERE famille =".$famille['idfamillearticle'])or die(mysql_error());
																				while($article = mysql_fetch_array($sql_article))
																				{
																					?>
																					<option value="<?= $article['idarticle']; ?>"><?= $article['nom_article']; ?></option>
																				<?php } ?>
																			</optgroup>
																		<?php } ?>
																	</select>
																</div>
															</div>


															<div class="form-group">
																<label class="control-label col-md-3">Commentaire</label>
																<div class="col-md-9">
																	<textarea class="form-control" rows="5" maxlength="255" data-always-show="true"  data-position="bottom-left" name="commentaire"><?= html_entity_decode($ligne['commentaire']); ?></textarea>
																</div>
															</div>


														</div>
														<!-- //modal-body-->
														<div class="modal-footer bg-success-gradient">
															<button type="submit" class="btn btn-default pull-right" name="action" value="edit-article-facture"><i class="fa fa-check"></i> Valider</button>
														</div>
													</form>
												</div>
											<?php } ?>
										<?php } ?>
										<?php if($facture_cls->verif_count_fam_oi($idfacture) != 0){ ?>
											<tr>
												<td colspan="5" style="background-color: #00a1f3; color: white; font-weight: 700;">OFFRE INTERNET</td>
											</tr>
											<?php
											$sql_ligne = mysql_query("SELECT * FROM swd_facture_ligne, swd_article WHERE swd_facture_ligne.idarticle = swd_article.idarticle AND swd_article.famille='10' AND swd_facture_ligne.idfacture = '$idfacture'")or die(mysql_error());
											while($ligne = mysql_fetch_array($sql_ligne))
											{
												?>
												<tr>
													<td class="text-center"><?= $ligne['code_article']; ?></td>
													<td><?= html_entity_decode($ligne['nom_article']); ?><br><i><?= html_entity_decode($ligne['commentaire']); ?></i></td>
													<td class="text-center"><?= $ligne['qte']; ?></td>
													<td class="text-right"><?= number_format($ligne['total_ligne'], 2, ',',' ')." €"; ?></td>
													<td>
														<button type="button" class="btn" data-toggle="modal" data-target="#edit-article-facture"><i class="fa fa-edit text-info"></i></button>
														<button type="button" class="btn" onclick="window.location.href='<?= ROOT,CONTROL; ?>gestion/facture.php?action=supp-article-facture&idfactureligne=<?= $ligne['idfactureligne']; ?>'"><i class="fa fa-remove text-danger"></i></button>
													</td>
												</tr>
												<div id="edit-article-facture" data-width="1400" class="modal fade">
													<div class="modal-header bg-info-gradient">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
														<h4 class="modal-title"><i class="fa fa-edit"></i> Editer un article de la facture</h4>
													</div>
													<!-- //modal-header-->
													<form class="form-horizontal" action="<?= ROOT,CONTROL; ?>gestion/facture.php" method="post">
														<input type="hidden" name="idfactureligne" value="<?= $ligne['idfactureligne']; ?>" />
														<div class="modal-body">

															<div class="form-group">
																<label class="control-label col-md-3">Article</label>
																<div class="col-md-9">
																	<select  class="selectpicker form-control rounded" name="echeance" data-size="10" data-live-search="true">
																		<?php
																		$sql_article_ligne = mysql_query("SELECT * FROM swd_article WHERE idarticle = ".$ligne['idarticle']);
																		$article_ligne = mysql_fetch_array($sql_article_ligne);
																		?>
																		<option value="<?= $article_ligne['idarticle']; ?>"><?= $article_ligne['nom_article']; ?></option>
																		<?php
																		$sql_famille = mysql_query("SELECT * FROM swd_famille_article")or die(mysql_error());
																		while($famille = mysql_fetch_array($sql_famille))
																		{
																			?>
																			<optgroup label="<?= $famille['designation_famille']; ?>">
																				<?php
																				$sql_article = mysql_query("SELECT * FROM swd_article WHERE famille =".$famille['idfamillearticle'])or die(mysql_error());
																				while($article = mysql_fetch_array($sql_article))
																				{
																					?>
																					<option value="<?= $article['idarticle']; ?>"><?= $article['nom_article']; ?></option>
																				<?php } ?>
																			</optgroup>
																		<?php } ?>
																	</select>
																</div>
															</div>


															<div class="form-group">
																<label class="control-label col-md-3">Commentaire</label>
																<div class="col-md-9">
																	<textarea class="form-control" rows="5" maxlength="255" data-always-show="true"  data-position="bottom-left" name="commentaire"><?= html_entity_decode($ligne['commentaire']); ?></textarea>
																</div>
															</div>


														</div>
														<!-- //modal-body-->
														<div class="modal-footer bg-success-gradient">
															<button type="submit" class="btn btn-default pull-right" name="action" value="edit-article-facture"><i class="fa fa-check"></i> Valider</button>
														</div>
													</form>
												</div>
											<?php } ?>
										<?php } ?>
										<?php if($facture_cls->verif_count_fam_voip($idfacture) != 0){ ?>
											<tr>
												<td colspan="5" style="background-color: #00a1f3; color: white; font-weight: 700;">VOIP</td>
											</tr>
											<?php
											$sql_ligne = mysql_query("SELECT * FROM swd_facture_ligne, swd_article WHERE swd_facture_ligne.idarticle = swd_article.idarticle AND swd_article.famille='11' AND swd_facture_ligne.idfacture = '$idfacture'")or die(mysql_error());
											while($ligne = mysql_fetch_array($sql_ligne))
											{
												?>
												<tr>
													<td class="text-center"><?= $ligne['code_article']; ?></td>
													<td><?= html_entity_decode($ligne['nom_article']); ?><br><i><?= html_entity_decode($ligne['commentaire']); ?></i></td>
													<td class="text-center"><?= $ligne['qte']; ?></td>
													<td class="text-right"><?= number_format($ligne['total_ligne'], 2, ',',' ')." €"; ?></td>
													<td>
														<button type="button" class="btn" data-toggle="modal" data-target="#edit-article-facture"><i class="fa fa-edit text-info"></i></button>
														<button type="button" class="btn" onclick="window.location.href='<?= ROOT,CONTROL; ?>gestion/facture.php?action=supp-article-facture&idfactureligne=<?= $ligne['idfactureligne']; ?>'"><i class="fa fa-remove text-danger"></i></button>
													</td>
												</tr>
												<div id="edit-article-facture" data-width="1400" class="modal fade">
													<div class="modal-header bg-info-gradient">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
														<h4 class="modal-title"><i class="fa fa-edit"></i> Editer un article de la facture</h4>
													</div>
													<!-- //modal-header-->
													<form class="form-horizontal" action="<?= ROOT,CONTROL; ?>gestion/facture.php" method="post">
														<input type="hidden" name="idfactureligne" value="<?= $ligne['idfactureligne']; ?>" />
														<div class="modal-body">

															<div class="form-group">
																<label class="control-label col-md-3">Article</label>
																<div class="col-md-9">
																	<select  class="selectpicker form-control rounded" name="echeance" data-size="10" data-live-search="true">
																		<?php
																		$sql_article_ligne = mysql_query("SELECT * FROM swd_article WHERE idarticle = ".$ligne['idarticle']);
																		$article_ligne = mysql_fetch_array($sql_article_ligne);
																		?>
																		<option value="<?= $article_ligne['idarticle']; ?>"><?= $article_ligne['nom_article']; ?></option>
																		<?php
																		$sql_famille = mysql_query("SELECT * FROM swd_famille_article")or die(mysql_error());
																		while($famille = mysql_fetch_array($sql_famille))
																		{
																			?>
																			<optgroup label="<?= $famille['designation_famille']; ?>">
																				<?php
																				$sql_article = mysql_query("SELECT * FROM swd_article WHERE famille =".$famille['idfamillearticle'])or die(mysql_error());
																				while($article = mysql_fetch_array($sql_article))
																				{
																					?>
																					<option value="<?= $article['idarticle']; ?>"><?= $article['nom_article']; ?></option>
																				<?php } ?>
																			</optgroup>
																		<?php } ?>
																	</select>
																</div>
															</div>


															<div class="form-group">
																<label class="control-label col-md-3">Commentaire</label>
																<div class="col-md-9">
																	<textarea class="form-control" rows="5" maxlength="255" data-always-show="true"  data-position="bottom-left" name="commentaire"><?= html_entity_decode($ligne['commentaire']); ?></textarea>
																</div>
															</div>


														</div>
														<!-- //modal-body-->
														<div class="modal-footer bg-success-gradient">
															<button type="submit" class="btn btn-default pull-right" name="action" value="edit-article-facture"><i class="fa fa-check"></i> Valider</button>
														</div>
													</form>
												</div>
											<?php } ?>
										<?php } ?>
										<?php if($facture_cls->verif_count_fam_sms($idfacture) != 0){ ?>
											<tr>
												<td colspan="5" style="background-color: #00a1f3; color: white; font-weight: 700;">SMS & FAX</td>
											</tr>
											<?php
											$sql_ligne = mysql_query("SELECT * FROM swd_facture_ligne, swd_article WHERE swd_facture_ligne.idarticle = swd_article.idarticle AND swd_article.famille='12' AND swd_facture_ligne.idfacture = '$idfacture'")or die(mysql_error());
											while($ligne = mysql_fetch_array($sql_ligne))
											{
												?>
												<tr>
													<td class="text-center"><?= $ligne['code_article']; ?></td>
													<td><?= html_entity_decode($ligne['nom_article']); ?><br><i><?= html_entity_decode($ligne['commentaire']); ?></i></td>
													<td class="text-center"><?= $ligne['qte']; ?></td>
													<td class="text-right"><?= number_format($ligne['total_ligne'], 2, ',',' ')." €"; ?></td>
													<td>
														<button type="button" class="btn" data-toggle="modal" data-target="#edit-article-facture"><i class="fa fa-edit text-info"></i></button>
														<button type="button" class="btn" onclick="window.location.href='<?= ROOT,CONTROL; ?>gestion/facture.php?action=supp-article-facture&idfactureligne=<?= $ligne['idfactureligne']; ?>'"><i class="fa fa-remove text-danger"></i></button>
													</td>
												</tr>
												<div id="edit-article-facture" data-width="1400" class="modal fade">
													<div class="modal-header bg-info-gradient">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
														<h4 class="modal-title"><i class="fa fa-edit"></i> Editer un article de la facture</h4>
													</div>
													<!-- //modal-header-->
													<form class="form-horizontal" action="<?= ROOT,CONTROL; ?>gestion/facture.php" method="post">
														<input type="hidden" name="idfactureligne" value="<?= $ligne['idfactureligne']; ?>" />
														<div class="modal-body">

															<div class="form-group">
																<label class="control-label col-md-3">Article</label>
																<div class="col-md-9">
																	<select  class="selectpicker form-control rounded" name="echeance" data-size="10" data-live-search="true">
																		<?php
																		$sql_article_ligne = mysql_query("SELECT * FROM swd_article WHERE idarticle = ".$ligne['idarticle']);
																		$article_ligne = mysql_fetch_array($sql_article_ligne);
																		?>
																		<option value="<?= $article_ligne['idarticle']; ?>"><?= $article_ligne['nom_article']; ?></option>
																		<?php
																		$sql_famille = mysql_query("SELECT * FROM swd_famille_article")or die(mysql_error());
																		while($famille = mysql_fetch_array($sql_famille))
																		{
																			?>
																			<optgroup label="<?= $famille['designation_famille']; ?>">
																				<?php
																				$sql_article = mysql_query("SELECT * FROM swd_article WHERE famille =".$famille['idfamillearticle'])or die(mysql_error());
																				while($article = mysql_fetch_array($sql_article))
																				{
																					?>
																					<option value="<?= $article['idarticle']; ?>"><?= $article['nom_article']; ?></option>
																				<?php } ?>
																			</optgroup>
																		<?php } ?>
																	</select>
																</div>
															</div>


															<div class="form-group">
																<label class="control-label col-md-3">Commentaire</label>
																<div class="col-md-9">
																	<textarea class="form-control" rows="5" maxlength="255" data-always-show="true"  data-position="bottom-left" name="commentaire"><?= html_entity_decode($ligne['commentaire']); ?></textarea>
																</div>
															</div>


														</div>
														<!-- //modal-body-->
														<div class="modal-footer bg-success-gradient">
															<button type="submit" class="btn btn-default pull-right" name="action" value="edit-article-facture"><i class="fa fa-check"></i> Valider</button>
														</div>
													</form>
												</div>
											<?php } ?>
										<?php } ?>
										<?php if($facture_cls->verif_count_fam_service($idfacture) != 0){ ?>
											<tr>
												<td colspan="5" style="background-color: #00a1f3; color: white; font-weight: 700;">SERVICES</td>
											</tr>
											<?php
											$sql_ligne = mysql_query("SELECT * FROM swd_facture_ligne, swd_article WHERE swd_facture_ligne.idarticle = swd_article.idarticle AND swd_article.famille='14' AND swd_facture_ligne.idfacture = '$idfacture'")or die(mysql_error());
											while($ligne = mysql_fetch_array($sql_ligne))
											{
												?>
												<tr>
													<td class="text-center"><?= $ligne['code_article']; ?></td>
													<td><?= html_entity_decode($ligne['nom_article']); ?><br><i><?= html_entity_decode($ligne['commentaire']); ?></i></td>
													<td class="text-center"><?= $ligne['qte']; ?></td>
													<td class="text-right"><?= number_format($ligne['total_ligne'], 2, ',',' ')." €"; ?></td>
													<td>
														<button type="button" class="btn" data-toggle="modal" data-target="#edit-article-facture"><i class="fa fa-edit text-info"></i></button>
														<button type="button" class="btn" onclick="window.location.href='<?= ROOT,CONTROL; ?>gestion/facture.php?action=supp-article-facture&idfactureligne=<?= $ligne['idfactureligne']; ?>'"><i class="fa fa-remove text-danger"></i></button>
													</td>
												</tr>
												<div id="edit-article-facture" data-width="1400" class="modal fade">
													<div class="modal-header bg-info-gradient">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
														<h4 class="modal-title"><i class="fa fa-edit"></i> Editer un article de la facture</h4>
													</div>
													<!-- //modal-header-->
													<form class="form-horizontal" action="<?= ROOT,CONTROL; ?>gestion/facture.php" method="post">
														<input type="hidden" name="idfactureligne" value="<?= $ligne['idfactureligne']; ?>" />
														<div class="modal-body">

															<div class="form-group">
																<label class="control-label col-md-3">Article</label>
																<div class="col-md-9">
																	<select  class="selectpicker form-control rounded" name="echeance" data-size="10" data-live-search="true">
																		<?php
																		$sql_article_ligne = mysql_query("SELECT * FROM swd_article WHERE idarticle = ".$ligne['idarticle']);
																		$article_ligne = mysql_fetch_array($sql_article_ligne);
																		?>
																		<option value="<?= $article_ligne['idarticle']; ?>"><?= $article_ligne['nom_article']; ?></option>
																		<?php
																		$sql_famille = mysql_query("SELECT * FROM swd_famille_article")or die(mysql_error());
																		while($famille = mysql_fetch_array($sql_famille))
																		{
																			?>
																			<optgroup label="<?= $famille['designation_famille']; ?>">
																				<?php
																				$sql_article = mysql_query("SELECT * FROM swd_article WHERE famille =".$famille['idfamillearticle'])or die(mysql_error());
																				while($article = mysql_fetch_array($sql_article))
																				{
																					?>
																					<option value="<?= $article['idarticle']; ?>"><?= $article['nom_article']; ?></option>
																				<?php } ?>
																			</optgroup>
																		<?php } ?>
																	</select>
																</div>
															</div>


															<div class="form-group">
																<label class="control-label col-md-3">Commentaire</label>
																<div class="col-md-9">
																	<textarea class="form-control" rows="5" maxlength="255" data-always-show="true"  data-position="bottom-left" name="commentaire"><?= html_entity_decode($ligne['commentaire']); ?></textarea>
																</div>
															</div>


														</div>
														<!-- //modal-body-->
														<div class="modal-footer bg-success-gradient">
															<button type="submit" class="btn btn-default pull-right" name="action" value="edit-article-facture"><i class="fa fa-check"></i> Valider</button>
														</div>
													</form>
												</div>
											<?php } ?>
										<?php } ?>
										<?php if($facture_cls->verif_count_fam_license($idfacture) != 0){ ?>
											<tr>
												<td colspan="5" style="background-color: #00a1f3; color: white; font-weight: 700;">LICENSE</td>
											</tr>
											<?php
											$sql_ligne = mysql_query("SELECT * FROM swd_facture_ligne, swd_article WHERE swd_facture_ligne.idarticle = swd_article.idarticle AND swd_article.famille='15' AND swd_facture_ligne.idfacture = '$idfacture'")or die(mysql_error());
											while($ligne = mysql_fetch_array($sql_ligne))
											{
												?>
												<tr>
													<td class="text-center"><?= $ligne['code_article']; ?></td>
													<td><?= html_entity_decode($ligne['nom_article']); ?><br><i><?= html_entity_decode($ligne['commentaire']); ?></i></td>
													<td class="text-center"><?= $ligne['qte']; ?></td>
													<td class="text-right"><?= number_format($ligne['total_ligne'], 2, ',',' ')." €"; ?></td>
													<td>
														<button type="button" class="btn" data-toggle="modal" data-target="#edit-article-facture"><i class="fa fa-edit text-info"></i></button>
														<button type="button" class="btn" onclick="window.location.href='<?= ROOT,CONTROL; ?>gestion/facture.php?action=supp-article-facture&idfactureligne=<?= $ligne['idfactureligne']; ?>'"><i class="fa fa-remove text-danger"></i></button>
													</td>
												</tr>
												<div id="edit-article-facture" data-width="1400" class="modal fade">
													<div class="modal-header bg-info-gradient">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
														<h4 class="modal-title"><i class="fa fa-edit"></i> Editer un article de la facture</h4>
													</div>
													<!-- //modal-header-->
													<form class="form-horizontal" action="<?= ROOT,CONTROL; ?>gestion/facture.php" method="post">
														<input type="hidden" name="idfactureligne" value="<?= $ligne['idfactureligne']; ?>" />
														<div class="modal-body">

															<div class="form-group">
																<label class="control-label col-md-3">Article</label>
																<div class="col-md-9">
																	<select  class="selectpicker form-control rounded" name="echeance" data-size="10" data-live-search="true">
																		<?php
																		$sql_article_ligne = mysql_query("SELECT * FROM swd_article WHERE idarticle = ".$ligne['idarticle']);
																		$article_ligne = mysql_fetch_array($sql_article_ligne);
																		?>
																		<option value="<?= $article_ligne['idarticle']; ?>"><?= $article_ligne['nom_article']; ?></option>
																		<?php
																		$sql_famille = mysql_query("SELECT * FROM swd_famille_article")or die(mysql_error());
																		while($famille = mysql_fetch_array($sql_famille))
																		{
																			?>
																			<optgroup label="<?= $famille['designation_famille']; ?>">
																				<?php
																				$sql_article = mysql_query("SELECT * FROM swd_article WHERE famille =".$famille['idfamillearticle'])or die(mysql_error());
																				while($article = mysql_fetch_array($sql_article))
																				{
																					?>
																					<option value="<?= $article['idarticle']; ?>"><?= $article['nom_article']; ?></option>
																				<?php } ?>
																			</optgroup>
																		<?php } ?>
																	</select>
																</div>
															</div>


															<div class="form-group">
																<label class="control-label col-md-3">Commentaire</label>
																<div class="col-md-9">
																	<textarea class="form-control" rows="5" maxlength="255" data-always-show="true"  data-position="bottom-left" name="commentaire"><?= html_entity_decode($ligne['commentaire']); ?></textarea>
																</div>
															</div>


														</div>
														<!-- //modal-body-->
														<div class="modal-footer bg-success-gradient">
															<button type="submit" class="btn btn-default pull-right" name="action" value="edit-article-facture"><i class="fa fa-check"></i> Valider</button>
														</div>
													</form>
												</div>
											<?php } ?>
										<?php } ?>
										<?php if($facture_cls->verif_count_fam_materiel($idfacture) != 0){ ?>
											<tr>
												<td colspan="5" style="background-color: #00a1f3; color: white; font-weight: 700;">MATERIEL</td>
											</tr>
											<?php
											$sql_ligne = mysql_query("SELECT * FROM swd_facture_ligne, swd_article WHERE swd_facture_ligne.idarticle = swd_article.idarticle AND swd_article.famille='16' AND swd_facture_ligne.idfacture = '$idfacture'")or die(mysql_error());
											while($ligne = mysql_fetch_array($sql_ligne))
											{
												?>
												<tr>
													<td class="text-center"><?= $ligne['code_article']; ?></td>
													<td><?= html_entity_decode($ligne['nom_article']); ?><br><i><?= html_entity_decode($ligne['commentaire']); ?></i></td>
													<td class="text-center"><?= $ligne['qte']; ?></td>
													<td class="text-right"><?= number_format($ligne['total_ligne'], 2, ',',' ')." €"; ?></td>
													<td>
														<button type="button" class="btn" data-toggle="modal" data-target="#edit-article-facture"><i class="fa fa-edit text-info"></i></button>
														<button type="button" class="btn" onclick="window.location.href='<?= ROOT,CONTROL; ?>gestion/facture.php?action=supp-article-facture&idfactureligne=<?= $ligne['idfactureligne']; ?>'"><i class="fa fa-remove text-danger"></i></button>
													</td>
												</tr>
												<div id="edit-article-facture" data-width="1400" class="modal fade">
													<div class="modal-header bg-info-gradient">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
														<h4 class="modal-title"><i class="fa fa-edit"></i> Editer un article de la facture</h4>
													</div>
													<!-- //modal-header-->
													<form class="form-horizontal" action="<?= ROOT,CONTROL; ?>gestion/facture.php" method="post">
														<input type="hidden" name="idfactureligne" value="<?= $ligne['idfactureligne']; ?>" />
														<div class="modal-body">

															<div class="form-group">
																<label class="control-label col-md-3">Article</label>
																<div class="col-md-9">
																	<select  class="selectpicker form-control rounded" name="echeance" data-size="10" data-live-search="true">
																		<?php
																		$sql_article_ligne = mysql_query("SELECT * FROM swd_article WHERE idarticle = ".$ligne['idarticle']);
																		$article_ligne = mysql_fetch_array($sql_article_ligne);
																		?>
																		<option value="<?= $article_ligne['idarticle']; ?>"><?= $article_ligne['nom_article']; ?></option>
																		<?php
																		$sql_famille = mysql_query("SELECT * FROM swd_famille_article")or die(mysql_error());
																		while($famille = mysql_fetch_array($sql_famille))
																		{
																			?>
																			<optgroup label="<?= $famille['designation_famille']; ?>">
																				<?php
																				$sql_article = mysql_query("SELECT * FROM swd_article WHERE famille =".$famille['idfamillearticle'])or die(mysql_error());
																				while($article = mysql_fetch_array($sql_article))
																				{
																					?>
																					<option value="<?= $article['idarticle']; ?>"><?= $article['nom_article']; ?></option>
																				<?php } ?>
																			</optgroup>
																		<?php } ?>
																	</select>
																</div>
															</div>


															<div class="form-group">
																<label class="control-label col-md-3">Commentaire</label>
																<div class="col-md-9">
																	<textarea class="form-control" rows="5" maxlength="255" data-always-show="true"  data-position="bottom-left" name="commentaire"><?= html_entity_decode($ligne['commentaire']); ?></textarea>
																</div>
															</div>


														</div>
														<!-- //modal-body-->
														<div class="modal-footer bg-success-gradient">
															<button type="submit" class="btn btn-default pull-right" name="action" value="edit-article-facture"><i class="fa fa-check"></i> Valider</button>
														</div>
													</form>
												</div>
											<?php } ?>
										<?php } ?>
										</tbody>
										<tfoot>
										<tr>
											<td colspan="3" class="text-right" style="font-weight: 700;">Total de la facture</td>
											<td class="text-right"><?= number_format($facture['total_ht'], 2, ',', ' ')." €"; ?></td>
										</tr>
										</tfoot>
									</table>
									<button type="button" class="btn btn-success" data-toggle="modal" data-target="#add-article-facture"><i class="fa fa-plus"></i> Ajouter un article</button>
									<br><br>
									<table class="table table-bordered">
										<thead>
										<tr>
											<th class="text-center">Numéro de Transaction</th>
											<th class="text-center">Date de Réglement</th>
											<th class="text-center">Nom du Réglement</th>
											<th class="text-center">Banque</th>
											<th class="text-right">Montant du Réglement</th>
											<th class="text-center">Action</th>
										</tr>
										</thead>
										<tbody>
										<?php
										$sql_reglement = mysql_query("SELECT * FROM swd_reglement WHERE idfacture = '$idfacture'")or die(mysql_error());
										while($reglement = mysql_fetch_array($sql_reglement))
										{
											?>
											<tr>
												<td class="text-center"><?= $reglement['num_reglement']; ?></td>
												<td class="text-center"><?= date("d/m/Y", $reglement['date_reglement']); ?></td>
												<td class="text-center"><?= $reglement['nom_reglement']; ?></td>
												<td class="text-center"><img src="<?= SYNCHRONUS; ?>bank/<?= $gen_cls->data_banque($reglement['banque_reglement']); ?>.jpg" /> <?= $reglement['banque_reglement']; ?></td>
												<td class="text-right"><?= number_format(round($reglement['montant_reglement'], 2), 2, ',', ' ')." €"; ?></td>
												<td></td>
											</tr>
										<?php } ?>
										</tbody>
										<tfoot>
										<tr>
											<td colspan="3" class="text-right" style="font-weight: 700;">Total des réglements</td>
											<td class="text-right"><?= number_format(round($facture_cls->total_reglement($idfacture), 2), 2, ',', ' ')." €"; ?></td>
										</tr>
										</tfoot>
									</table>

								</div>
								<!-- //invoice -->
							</div>
							<div id="add-paiement" data-width="700" class="modal fade">
								<div class="modal-header bg-success-gradient">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
									<h4 class="modal-title"><i class="fa fa-plus"></i> Ajouter un réglement</h4>
								</div>
								<!-- //modal-header-->
								<form class="form-horizontal" action="<?= ROOT,CONTROL; ?>gestion/facture.php" method="post">
									<input type="hidden" name="idfacture" value="<?= $idfacture; ?>" />
									<input type="hidden" name="date_reglement" value="<?= $date_jour; ?>" />
									<input type="hidden" name="nom_reglement" value="<?= $facture['nom_client']; ?>" />
									<div class="modal-body">

										<div class="form-group">
											<label class="control-label col-md-3">Mode de réglement</label>
											<div class="col-md-9">
												<select  class="selectpicker form-control rounded" name="mode_reglement" data-size="10" data-live-search="true">
													<option Value="2">CB</option>
													<option value="3">Paypal</option>
												</select>
											</div>
										</div>


										<div class="form-group">
											<label class="control-label col-md-3">Banque du réglement</label>
											<div class="col-md-9">
												<select  class="selectpicker form-control rounded" name="banque_reglement" data-size="10" data-live-search="true">
													<option value="">NEANT</option>
													<?php
													$sql_banque = mysql_query("SELECT * FROM swift")or die(mysql_error());
													while($banque = mysql_fetch_array($sql_banque))
													{
														?>
														<option value="<?= $banque['bank']; ?>" data-content="<img src='<?= SYNCHRONUS; ?>bank/<?= $banque['swift']; ?>.jpg' width='20' height='20' /> <?= $banque['bank']; ?>"></option>
													<?php } ?>
												</select>
											</div>
										</div>

										<div class="form-group">
											<label class="control-label col-md-3">Montant du réglement</label>
											<div class="col-md-9">
												<input type="text" class="form-control" name="montant_reglement" />
											</div>
										</div>


									</div>
									<!-- //modal-body-->
									<div class="modal-footer bg-success-gradient">
										<button type="submit" class="btn btn-default pull-right" name="action" value="add-paiement-client"><i class="fa fa-check"></i> Valider</button>
									</div>
								</form>
							</div>
						</section>
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
<script type="text/javascript" src="<?= ROOTS,ASSETS,JS; ?>jquery.min.js"></script>
<script type="text/javascript" src="<?= ROOTS,ASSETS,JS; ?>jquery.ui.min.js"></script>
<script type="text/javascript" src="<?= ROOTS,ASSETS,PLUGINS; ?>bootstrap/bootstrap.min.js"></script>
<!-- Modernizr Library For HTML5 And CSS3 -->
<script type="text/javascript" src="<?= ROOTS,ASSETS,JS; ?>modernizr/modernizr.js"></script>
<script type="text/javascript" src="<?= ROOTS,ASSETS,PLUGINS; ?>mmenu/jquery.mmenu.js"></script>
<script type="text/javascript" src="<?= ROOTS,ASSETS,JS; ?>styleswitch.js"></script>
<!-- Library 10+ Form plugins-->
<script type="text/javascript" src="<?= ROOTS,ASSETS,PLUGINS; ?>form/form.js"></script>
<script type="text/javascript" src="<?= ROOTS,ASSETS,PLUGINS; ?>ckeditor/ckeditor.js"></script>
<!-- Datetime plugins -->
<script type="text/javascript" src="<?= ROOTS,ASSETS,PLUGINS; ?>datetime/datetime.js"></script>
<!-- Library Chart-->
<script type="text/javascript" src="<?= ROOTS,ASSETS,PLUGINS; ?>chart/chart.js"></script>
<!-- Library  5+ plugins for bootstrap -->
<script type="text/javascript" src="<?= ROOTS,ASSETS,PLUGINS; ?>pluginsForBS/pluginsForBS.js"></script>
<!-- Library 10+ miscellaneous plugins -->
<script type="text/javascript" src="<?= ROOTS,ASSETS,PLUGINS; ?>miscellaneous/miscellaneous.js"></script>
<!-- Library Themes Customize-->
<script type="text/javascript" src="<?= ROOTS,ASSETS,JS; ?>caplet.custom.js"></script>

<script type="text/javascript" src="<?= ROOTS,ASSETS,PLUGINS; ?>datable/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?= ROOTS,ASSETS,PLUGINS; ?>datable/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="<?= ROOTS,ASSETS,PLUGINS; ?>toastr/toastr.js"></script>
<script type="text/javascript" src="<?= ROOTS,ASSETS,PLUGINS; ?>inputmask/inputmask.js"></script>
<script type="text/javascript" src="<?= ROOTS,ASSETS,PLUGINS; ?>inputmask/inputmask.extensions.js"></script>
<script type="text/javascript" src="<?= ROOTS,ASSETS,PLUGINS; ?>inputmask/inputmask.date.extensions.js"></script>
<script type="text/javascript" src="<?= ROOTS,ASSETS,PLUGINS; ?>inputmask/inputmask.numeric.extensions.js"></script>
<script type="text/javascript" src="<?= ROOTS,ASSETS,PLUGINS; ?>inputmask/inputmask.phone.extensions.js"></script>
<script type="text/javascript" src="<?= ROOTS,ASSETS,PLUGINS; ?>inputmask/inputmask.regex.extensions.js"></script>
<script type="text/javascript" src="<?= ROOTS,ASSETS,PLUGINS; ?>inputmask/jquery.inputmask.js"></script>

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
	});
</script>
<script type="text/javascript">
	// Call CkEditor
	//CKEDITOR.replace( 'short_description', {startupFocus : false, uiColor: '#FFFFFF'});
</script>

</body>
</html>
