<?php
if(isset($_POST['action']) && $_POST['action'] == 'add-facture')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";

    $idclient = $_POST['idclient'];
    $reference = "FCTSWD2015".date('n').rand(1,9999);
    $date_facture = strtotime($_POST['date_facture']);
    $date_echeance = $date_facture + $_POST['echeance'];
    $projet = $_POST['projet'];

    $sql_add_facture = mysql_query("INSERT INTO swd_facture(idfacture, ref_devis, reference, idclient, etat_facture, date_facture, date_echeance, idprojet, total_ht) VALUES (NULL, '', '$reference', '$idclient', '1', '$date_facture', '$date_echeance', '$projet', '0')")or die(mysql_error());

    if($sql_add_facture === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=facture&data=view_facture&reference=$reference&success=add-facture");
    }else{
        header("Location: ../../index.php?view=gestion&sub=facture&error=add-facture");
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'edit-facture')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";

    $idfacture = $_POST['idfacture'];
    $idclient = $_POST['idclient'];
    $date_facture = strtotime($_POST['date_facture']);
    $date_echeance = $date_facture + $_POST['echeance'];
    $projet = $_POST['projet'];

    $sql_facture = mysql_query("SELECT * FROM swd_facture WHERE idfacture = '$idfacture'")or die(mysql_error());
    $facture = mysql_fetch_array($sql_facture);
    $reference = $facture['reference'];

    $sql_up_facture = mysql_query("UPDATE swd_facture SET idclient = '$idclient', date_facture = '$date_facture', date_echeance = '$date_echeance', idprojet = '$projet' WHERE idfacture = '$idfacture'")or die(mysql_error());

    if($sql_up_facture === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=facture&data=view_facture&reference=$reference&success=edit-facture");
    }else{
        header("Location: ../../index.php?view=gestion&sub=facture&data=view_facture&reference=$reference&error=edit-facture");
    }
}
if(isset($_GET['action']) && $_GET['action'] == 'supp-facture')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";

    $idfacture = $_GET['idfacture'];

    $sql_delete_rglt = mysql_query("DELETE FROM swd_reglement WHERE idfacture = '$idfacture'")or die(mysql_error());
    $sql_delete_ligne = mysql_query("DELETE FROM swd_facture_ligne WHERE idfacture = '$idfacture'")or die(mysql_error());
    $sql_delete_facture = mysql_query("DELETE FROM swd_facture WHERE idfacture = '$idfacture'")or die(mysql_error());

    if($sql_delete_ligne === TRUE AND $sql_delete_facture === TRUE AND $sql_delete_rglt === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=facture&success=supp-facture");
    }else{
        header("Location: ../../index.php?view=gestion&sub=facture&error=supp-facture");
    }
}

if(isset($_POST['action']) && $_POST['action'] == 'envoie-facture')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";

    $idfacture = $_POST['idfacture'];
    $sql_facture = mysql_query("SELECT * FROM swd_facture WHERE idfacture = '$idfacture'")or die(mysql_error());
    $facture = mysql_fetch_array($sql_facture);
    $reference = $facture['reference'];

    $email = $_POST['email'];
    $sujet = $_POST['sujet'];

    $info_bq = $client_cls->info_bancaire($facture['idclient']);

    //Email
    $to = $email;
    $headers = 'Mime-Version: 1.0'."\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8'."\r\n";
    $headers .= "\r\n";

    ob_start();
    ?>
    <html>
    <head>
        <link rel="stylesheet" href="http://gestcom.cridip.com/assets/css/modif.css">
    </head>
    <body>
    <div id="email">
        <div class="header">
            <div class="logo"><img src="<?= ROOT,ASSETS,IMG; ?>logo_white_icon.png" /></div>
            <div class="dot-bar"><img src="<?= ROOT,ASSETS,IMG; ?>dot-bar.png" /></div>
            <div class="adresse">
                <strong>CRIDIP SWD</strong><br>
                8 Rue Octave Voyer<br>
                85100 Les Sables d'Olonne
            </div>
            <div class="sujet"><?= $sujet; ?></div>
        </div>
        <div class="corps">
            <p>Bonjour,</p>
            <p>Votre facture N°<strong><?= $reference; ?></strong> d'un montant de <strong><?= number_format($facture['total_ht'], 2, ',', ' ')." €"; ?></strong> vient d'être édité.</p>
            <p>Vous pouvez prendre connaissance de cette facture à l'adresse ci-dessous:</p>
            <p><a href="<?= ROOT,TOKEN; ?>facture.php?reference=<?= $reference; ?>"><?= ROOT,TOKEN; ?>facture.php?reference=<?= $reference; ?></a></p>
            <?php if($client_cls->count_bq($facture['idclient']) != 0){ ?>
                <p>Le montant de <strong><?= number_format($facture['total_ht'], 2, ',', ' ')." €"; ?></strong> sera prélevé le <strong><?= date("d",$facture['date_echeance']); ?> <?= $date_class->mois(date("n", $facture['date_echeance'])); ?> <?= date("Y",$facture['date_echeance']); ?></strong> sur le compte <strong>BIC: <?= $info_bq['bic']; ?> | IBAN: <?= $info_bq['iban']; ?></strong>.</p>
            <?php }else{ ?>
                <p>Comme aucun moyen de paiement par default n'est retenue sur votre compte client, nous vous invitons à en définir un ou nous vous proposons le paiement par carte bancaire.<br>Ceci dit si vous voulez utiliser le paiement par carte bancaire, le paiement doit survenir au plus tard la veille de la date d'échéance sous risque de coupure de service et de surfacturation.</p>
            <?php } ?>
            <p>Si vous avez des questions relatives à cette facture n'hésitez pas à nous contacter par téléphone au: 0 899 492 648 ou par mail: contact@cridip.com</p>
            <p>Cordialement,</p>
            <p>Le Service Commercial</p>
        </div>
        <div class="footer">
            <hr />
            SAS au capital de 100€ - RCS La Roche sur Yon 811 772 235 - Siège social: 8 rue Octave Voyer, 85100 Les Sables d'Olonne - FRANCE
        </div>

    </div>
    </body>
    </html>
    <?php
    $msg = ob_get_contents();
    $mail_envoie = mail($to, $sujet, $msg, $headers);

    if($mail_envoie === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=facture&data=view_facture&reference=$reference&success=envoie-facture");
    }else{
        header("Location: ../../index.php?view=gestion&sub=facture&data=view_facture&reference=$reference&error=envoie-facture");
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'envoie-rappel')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";

    $idfacture = $_POST['idfacture'];
    $sql_facture = mysql_query("SELECT * FROM swd_facture WHERE idfacture = '$idfacture'")or die(mysql_error());
    $facture = mysql_fetch_array($sql_facture);
    $reference = $facture['reference'];

    $email = $_POST['email'];
    $sujet = $_POST['sujet'];

    $info_bq = $client_cls->info_bancaire($facture['idclient']);

    //Email
    $to = $email;
    $headers = 'Mime-Version: 1.0'."\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8'."\r\n";
    $headers .= "\r\n";

    ob_start();
    ?>
    <html>
    <head>
        <link rel="stylesheet" href="http://gestcom.cridip.com/assets/css/modif.css">
    </head>
    <body>
    <div id="email">
        <div class="header">
            <div class="logo"><img src="<?= ROOT,ASSETS,IMG; ?>logo_white_icon.png" /></div>
            <div class="dot-bar"><img src="<?= ROOT,ASSETS,IMG; ?>dot-bar.png" /></div>
            <div class="adresse">
                <strong>CRIDIP SWD</strong><br>
                8 Rue Octave Voyer<br>
                85100 Les Sables d'Olonne
            </div>
            <div class="sujet"><?= $sujet; ?></div>
        </div>
        <div class="corps">
            <p>Bonjour,</p>
            <p>Sauf erreur ou omission de notre part, le montant de <strong><?= number_format($facture['total_ht'], 2, ',', ' ')." €"; ?></strong> concernant la facture N°<strong><?= $reference; ?></strong> ne nous est pas parvenue.</p>
            <p>Afin d'éviter des surcout dù en l'abscence de paiement, nous vous inviton à régulariser votre situation en réglant la facture par le lien ci-dessous:</p>
            <p><a href="<?= ROOT,TOKEN; ?>facture.php?reference=<?= $reference; ?>"><?= ROOT,TOKEN; ?>facture.php?reference=<?= $reference; ?></a></p>
            <p>Si votre facture n'est pas régularisée sous 7 jours, nous procéderons à la fermeture des services associés et à la transmission de votre compte débiteur à notre service créancier (Surcout obligatoire suivant les termes de nos conditions générales).</p>
            <p>Nous vous informons également, que vous avez la possibilité de payer par prélèvement automatique par l'intermédiaire de votre espace client.</p>
            <p>Si vous avez des questions ou des difficultés de paiement relatives à cette facture n'hésitez pas à nous contacter par téléphone au: 0 899 492 648 ou par mail: contact@cridip.com</p>
            <p>Cordialement,</p>
            <p>Le Service Commercial</p>
        </div>
        <div class="footer">
            <hr />
            SAS au capital de 100€ - RCS La Roche sur Yon 811 772 235 - Siège social: 8 rue Octave Voyer, 85100 Les Sables d'Olonne - FRANCE
        </div>

    </div>
    </body>
    </html>
    <?php
    $msg = ob_get_contents();
    $mail_envoie = mail($to, $sujet, $msg, $headers);

    if($mail_envoie === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=facture&data=view_facture&reference=$reference&success=envoie-facture");
    }else{
        header("Location: ../../index.php?view=gestion&sub=facture&data=view_facture&reference=$reference&error=envoie-facture");
    }
}


if(isset($_POST['action']) && $_POST['action'] == 'add-article-facture')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";
    $idfacture = $_POST['idfacture'];
    $idarticle = $_POST['idarticle'];
    $qte = $_POST['qte'];
    $commentaire = htmlentities(addslashes($_POST['commentaire']));

    $sql_facture = mysql_query("SELECT * FROM swd_facture WHERE idfacture = '$idfacture'")or die(mysql_error());
    $facture = mysql_fetch_array($sql_facture);
    $total_ht = $facture['total_ht'];
    $reference = $facture['reference'];

    $sql_article = mysql_query("SELECT * FROM swd_article WHERE idarticle = '$idarticle'")or die(mysql_error());
    $article = mysql_fetch_array($sql_article);
    $prix_vente_ht = $article['prix_vente_ht'];

    $total_ligne = $prix_vente_ht * $qte;
    $total_ht = $total_ht + $total_ligne;

    $sql_update_facture = mysql_query("UPDATE swd_facture SET total_ht = '$total_ht' WHERE idfacture = '$idfacture'")or die(mysql_error());
    $sql_add_ligne_facture = mysql_query("INSERT INTO swd_facture_ligne(idfactureligne, idfacture, idarticle, qte, commentaire, total_ligne) VALUES (NULL, '$idfacture', '$idarticle', '$qte', '$commentaire', '$total_ligne')")or die(mysql_error());

    if($sql_update_facture === TRUE AND $sql_add_ligne_facture === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=facture&data=view_facture&reference=$reference&success=add-article-facture");
    }else{
        header("Location: ../../index.php?view=gestion&sub=facture&data=view_facture&reference=$reference&error=add-article-facture");
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'edit-article-facture')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";

    $idfactureligne = $_POST['idfactureligne'];
    $commentaire = htmlentities(addslashes($_POST['commentaire']));

    $sql_ligne = mysql_query("SELECT * FROM swd_facture_ligne WHERE idfactureligne = '$idfactureligne'")or die(mysql_error());
    $ligne = mysql_fetch_array($sql_ligne);
    $idfacture = $ligne['idfacture'];

    $sql_facture = mysql_query("SELECT * FROM swd_facture WHERE idfacture = '$idfacture'")or die(mysql_error());
    $facture = mysql_fetch_array($sql_facture);
    $total_ht = $facture['total_ht'];
    $reference = $facture['reference'];



    $sql_update_ligne_facture = mysql_query("UPDATE swd_facture_ligne SET commentaire = '$commentaire' WHERE idfactureligne = '$idfactureligne'")or die(mysql_error());

    if($sql_update_ligne_facture === TRUE )
    {
        header("Location: ../../index.php?view=gestion&sub=facture&data=view_facture&reference=$reference&success=edit-article-facture");
    }else{
        header("Location: ../../index.php?view=gestion&sub=facture&data=view_facture&reference=$reference&error=edit-article-facture");
    }
}
if(isset($_GET['action']) && $_GET['action'] == 'supp-article-facture')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";

    $idfactureligne = $_GET['idfactureligne'];

    $sql_ligne = mysql_query("SELECT * FROM swd_facture_ligne WHERE idfactureligne = '$idfactureligne'")or die(mysql_error());
    $ligne = mysql_fetch_array($sql_ligne);
    $idfacture = $ligne['idfacture'];
    $total_ligne = $ligne['total_ligne'];

    $sql_facture = mysql_query("SELECT * FROM swd_facture WHERE idfacture = '$idfacture'")or die(mysql_error());
    $facture = mysql_fetch_array($sql_facture);
    $total_ht = $facture['total_ht'];
    $reference = $facture['reference'];


    $total_ht = $total_ht - $total_ligne;


    $sql_update_facture = mysql_query("UPDATE swd_facture SET total_ht = '$total_ht' WHERE idfacture = '$idfacture'")or die(mysql_error());
    $sql_delete_ligne = mysql_query("DELETE FROM swd_facture_ligne WHERE idfactureligne = '$idfactureligne'")or die(mysql_error());

    if($sql_delete_ligne === TRUE AND $sql_update_facture === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=facture&data=view_facture&reference=$reference&success=supp-article-facture");
    }else{
        header("Location: ../../index.php?view=gestion&sub=facture&data=view_facture&reference=$reference&error=supp-article-facture");
    }
}

if(isset($_POST['action']) && $_POST['action'] == 'add-reglement')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";

    $idfacture = $_POST['idfacture'];
    $date_reglement = strtotime($_POST['date_reglement']);
    $mode_reglement = $_POST['mode_reglement'];
    $nom_reglement = $_POST['nom_reglement'];
    $banque_reglement = $_POST['banque_reglement'];
    $montant_reglement = $_POST['montant_reglement'];
    
    $sql_facture = mysql_query("SELECT * FROM swd_facture, client WHERE swd_facture.idclient = client.idclient AND idfacture = '$idfacture'")or die(mysql_error());
    $facture = mysql_fetch_array($sql_facture);
    $reference = $facture['reference'];
    $email = $facture['email'];

    if($mode_reglement == 1){
        $num_reglement = "VIR".rand(1000000,9999999);
        $sql_add_paiement = mysql_query("INSERT INTO `swd_reglement`(`idreglement`, `idfacture`, `date_reglement`, `mode_reglement`, `nom_reglement`, `num_reglement`, `banque_reglement`, `montant_reglement`)
                                    VALUES (NULL,'$idfacture','$date_reglement','$mode_reglement','$nom_reglement','$num_reglement','$banque_reglement','$montant_reglement')")or die(mysql_error());
        if($facture['total_ht'] == $facture_cls->total_reglement($idfacture))
        {
            $sql_update_facture = mysql_query("UPDATE swd_facture SET etat_facture = '3' WHERE idfacture = '$idfacture'")or die(mysql_error());
        }else{
            $sql_update_facture = mysql_query("UPDATE swd_facture SET etat_facture = '2' WHERE idfacture = '$idfacture'")or die(mysql_error());
        }
        if($sql_add_paiement === TRUE && $sql_update_facture === TRUE)
        {
            header("Location: ../../index.php?view=gestion&sub=facture&data=view_facture&reference=$reference&success=add-paiement");
        }else{
            header("Location: ../../index.php?view=gestion&sub=facture&data=view_facture&reference=$reference&error=add-paiement");
        }
    }
    if($mode_reglement == 2){
        $num_reglement = "CBM".rand(1000000,9999999);
        $sql_add_paiement = mysql_query("INSERT INTO `swd_reglement`(`idreglement`, `idfacture`, `date_reglement`, `mode_reglement`, `nom_reglement`, `num_reglement`, `banque_reglement`, `montant_reglement`)
                                    VALUES (NULL,'$idfacture','$date_reglement','$mode_reglement','$nom_reglement','$num_reglement','$banque_reglement','$montant_reglement')")or die(mysql_error());
        if($facture['total_ht'] == $facture_cls->total_reglement($idfacture))
        {
            $sql_update_facture = mysql_query("UPDATE swd_facture SET etat_facture = '3' WHERE idfacture = '$idfacture'")or die(mysql_error());
        }else{
            $sql_update_facture = mysql_query("UPDATE swd_facture SET etat_facture = '2' WHERE idfacture = '$idfacture'")or die(mysql_error());
        }
        if($sql_add_paiement === TRUE && $sql_update_facture === TRUE)
        {
            header("Location: ../../index.php?view=gestion&sub=facture&data=view_facture&reference=$reference&success=add-paiement");
        }else{
            header("Location: ../../index.php?view=gestion&sub=facture&data=view_facture&reference=$reference&error=add-paiement");
        }
    }
    if($mode_reglement == 3){
        $paypal = new paypal('SetExpressCheckout', 'control/gestion/facture.php?action=process', 'index.php?view=cridip-ven-facture&error-cancel=true', $montant_reglement, $reference, '', '');
    }
    if($mode_reglement == 4){
        $num_reglement = "PRLV".rand(1000000,9999999);
        $sql_add_paiement = mysql_query("INSERT INTO `swd_reglement`(`idreglement`, `idfacture`, `date_reglement`, `mode_reglement`, `nom_reglement`, `num_reglement`, `banque_reglement`, `montant_reglement`)
                                    VALUES (NULL,'$idfacture','$date_reglement','$mode_reglement','$nom_reglement','$num_reglement','$banque_reglement','$montant_reglement')")or die(mysql_error());
        if($facture['total_ht'] == $facture_cls->total_reglement($idfacture))
        {
            $sql_update_facture = mysql_query("UPDATE swd_facture SET etat_facture = '3' WHERE idfacture = '$idfacture'")or die(mysql_error());
        }else{
            $sql_update_facture = mysql_query("UPDATE swd_facture SET etat_facture = '2' WHERE idfacture = '$idfacture'")or die(mysql_error());
        }
        if($sql_add_paiement === TRUE && $sql_update_facture === TRUE)
        {
            header("Location: ../../index.php?view=gestion&sub=facture&data=view_facture&reference=$reference&success=add-paiement");
        }else{
            header("Location: ../../index.php?view=gestion&sub=facture&data=view_facture&reference=$reference&error=add-paiement");
        }
    }
    if($mode_reglement == 5){
        $num_reglement = "MDTC".rand(1000000,9999999);
        $sql_add_paiement = mysql_query("INSERT INTO `swd_reglement`(`idreglement`, `idfacture`, `date_reglement`, `mode_reglement`, `nom_reglement`, `num_reglement`, `banque_reglement`, `montant_reglement`)
                                    VALUES (NULL,'$idfacture','$date_reglement','$mode_reglement','$nom_reglement','$num_reglement','$banque_reglement','$montant_reglement')")or die(mysql_error());
        if($facture['total_ht'] == $facture_cls->total_reglement($idfacture))
        {
            $sql_update_facture = mysql_query("UPDATE swd_facture SET etat_facture = '3' WHERE idfacture = '$idfacture'")or die(mysql_error());
        }else{
            $sql_update_facture = mysql_query("UPDATE swd_facture SET etat_facture = '2' WHERE idfacture = '$idfacture'")or die(mysql_error());
        }
        if($sql_add_paiement === TRUE && $sql_update_facture === TRUE)
        {
            header("Location: ../../index.php?view=gestion&sub=facture&data=view_facture&reference=$reference&success=add-paiement");
        }else{
            header("Location: ../../index.php?view=gestion&sub=facture&data=view_facture&reference=$reference&error=add-paiement");
        }
    }



    /*if($facture_cls->balance($facture['idclient']) == 0)
    {
        $sql_up_facture = mysql_query("UPDATE swd_facture SET etat_facture = '3' WHERE idfacture = '$idfacture'")or die(mysql_error());
    }
    if($facture_cls->balance($facture['idclient'] > 0))
    {
        $sql_up_facture = mysql_query("UPDATE swd_facture SET etat_facture = '2' WHERE idfacture = '$idfacture'")or die(mysql_error());
    }else{
        header("Location: ../../index.php?view=gestion&sub=facture&data=view_facture&reference=$reference&error=add-paiement");
    }*/

}
if(isset($_GET['action']) && $_GET['action'] == 'process')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";

    $paypal = new paypal('GetExpressCheckoutDetails', '', '', '', '', $_GET['token'], '');

}
if(isset($_GET['action']) && $_GET['action'] == 'payment')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";

    $paypal = new paypal('DoExpressCheckoutPayment', '', '', $_GET['total'], $_GET['reference'], $_GET['token'], $_GET['PayerID']);

}
if(isset($_GET['action']) && $_GET['action'] == 'supp-paiement')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";

    $idreglement = $_GET['idreglement'];
    $reference = $_GET['reference'];

    $sql_reglement = mysql_query("SELECT * FROM swd_reglement WHERE idreglement = '$idreglement'")or die(mysql_error());
    $reglement = mysql_fetch_array($sql_reglement);
    $idfacture = $reglement['idfacture'];

    $sql_facture = mysql_query("SELECT * FROM swd_facture WHERE idfacture = '$idfacture'")or die(mysql_error());
    $facture = mysql_fetch_array($sql_facture);



    $sql_delete_reglement = mysql_query("DELETE FROM swd_reglement WHERE idreglement = '$idreglement'")or die(mysql_error());

    if($facture['total_ht'] == $facture_cls->total_reglement($idfacture))
    {
        $sql_update_facture = mysql_query("UPDATE swd_facture SET etat_facture = '3' WHERE idfacture = '$idfacture'")or die(mysql_error());
    }else{
        $sql_update_facture = mysql_query("UPDATE swd_facture SET etat_facture = '2' WHERE idfacture = '$idfacture'")or die(mysql_error());
    }

    if($sql_delete_reglement === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=facture&data=view_facture&reference=$reference&success=supp-paiement");
    }else{
        header("Location: ../../index.php?view=gestion&sub=facture&data=view_facture&reference=$reference&error=supp-paiement");
    }
}

if(isset($_POST['action']) && $_POST['action'] == 'add-paiement-client')
{
    $idfacture = $_POST['idfacture'];
    $date_reglement = $_POST['date_reglement'];
    $nom_reglement = $_POST['nom_reglement'];
    $mode_reglement = $_POST['mode_reglement'];
    $banque_reglement = $_POST['banque_reglement'];
    $montant_reglement = $_POST['montant_reglement'];

    $sql_facture = mysql_query("SELECT * FROM swd_facture WHERE idfacture = '$idfacture'")or die(mysql_error());
    $facture = mysql_fetch_array($sql_facture);
    $reference = $facture['reference'];

    if($mode_reglement == 2)
    {
        header("Location: https://".ROOT.TOKEN."cb.php?idfacture=$idfacture&date_reglement=$date_reglement&nom_reglement=$nom_reglement&banque_reglement=$banque_reglement&montant_reglement=$montant_reglement&reference=$reference");
    }

    if($mode_reglement == 3)
    {
        $paypal = new paypal('SetExpressCheckout', 'control/gestion/facture.php?action=process', 'index.php?view=cridip-ven-facture&error-cancel=true', $montant_reglement, $reference, '', '');
    }
}