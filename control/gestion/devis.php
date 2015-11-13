<?php
if(isset($_POST['action']) && $_POST['action'] == 'add-devis')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";
    
    $idclient = $_POST['idclient'];
    $reference = "DEVSWD2015".date('n').rand(1,9999);
    $date_devis = strtotime($_POST['date_devis']);
    $date_echeance = $date_devis + $_POST['echeance'];
    
    $sql_add_devis = mysql_query("INSERT INTO swd_devis(`iddevis`, `reference`, `etat_devis`, `date_devis`, `date_echeance`, `idclient`, `total_ht`) VALUES (NULL, '$reference', '1', '$date_devis', '$date_echeance', '$idclient', '0')")or die(mysql_error());

    if($sql_add_devis === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=devis&data=view_devis&reference=$reference&success=add-devis");
    }else{
        header("Location: ../../index.php?view=gestion&sub=devis&error=add-devis");
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'edit-devis')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";
    
    $iddevis = $_POST['iddevis'];
    $idclient = $_POST['idclient'];
    $date_devis = strtotime($_POST['date_devis']);
    $date_echeance = $date_devis + $_POST['echeance'];
    
    $sql_update_devis = mysql_query("UPDATE swd_devis SET idclient = '$idclient', date_devis = '$date_devis', date_echeance = '$date_echeance' WHERE iddevis = '$iddevis'")or die(mysql_error());

    if($sql_update_devis === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=devis&data=view_devis&reference=$reference&success=edit-devis");
    }else{
        header("Location: ../../index.php?view=gestion&sub=devis&data=view_devis&reference=$reference&error=edit-devis");
    }
}
if(isset($_GET['action']) && $_GET['action'] == 'supp-devis')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";

    $iddevis = $_GET['iddevis'];

    $sql_delete_ligne = mysql_query("DELETE FROM swd_devis_ligne WHERE iddevis = '$iddevis'")or die(mysql_error());
    $sql_delete_devis = mysql_query("DELETE FROM swd_devis WHERE iddevis = '$iddevis'")or die(mysql_error());

    if($sql_delete_ligne === TRUE AND $sql_delete_devis === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=devis&success=supp-devis");
    }else{
        header("Location: ../../index.php?view=gestion&sub=devis&error=supp-devis");
    }
}

if(isset($_POST['action']) && $_POST['action'] == 'envoie-devis')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";

    $iddevis = $_POST['iddevis'];
    $sql_devis = mysql_query("SELECT * FROM swd_devis WHERE iddevis = '$iddevis'")or die(mysql_error());
    $devis = mysql_fetch_array($sql_devis);
    $reference = $devis['reference'];

    $email = $_POST['email'];
    $sujet = $_POST['sujet'];

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
            <p>Votre devis N°<strong><?= $reference; ?></strong> d'un montant total de <strong><?= number_format($devis['total_ht'], 2, ',', ' ')." €"; ?></strong> à été édité.</p>
            <p>Ce devis doit être valider par vos soins.<br>Pour ce faire veuillez suivre le lien ci dessous:</p>
            <p>
                <a href="<?= ROOT,TOKEN; ?>devis.php?reference=<?= $reference; ?>"><?= ROOT,TOKEN; ?>devis.php?reference=<?= $reference; ?></a>
            </p>
            <p>Notez que la validation éléctronique par oui de ce devis vaut facturation de la prestation associée suivant les termes de nos conditions générales d'accès au services, à savoir:</p>
            <?php
                if($devis['total_ht'] >= 300){
                    $calc_50 = $devis['total_ht']/2;
            ?>
                <ul>
                    <li>50% à la commande, soit: <strong><?php number_format($calc_50, 2, ',', ' ')." €"; ?></strong></li>
                    <li>50% à la livraison, soit: <strong><?php number_format($calc_50, 2, ',', ' ')." €"; ?></strong></li>
                </ul>
            <?php }else{ ?>
                <ul>
                    <li>100% à la livraison, soit: <strong><?php number_format($devis['total_ht'], 2, ',', ' ')." €"; ?></strong></li>
                </ul>
            <?php } ?>
            <p>Si vous avez des questions relatives à ce devis n'hésitez pas à nous contacter par téléphone au: 0 899 492 648 ou par mail: contact@cridip.com</p>
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
        header("Location: ../../index.php?view=gestion&sub=devis&data=view_devis&reference=$reference&success=envoie-devis");
    }else{
        header("Location: ../../index.php?view=gestion&sub=devis&data=view_devis&reference=$reference&error=envoie-devis");
    }
}
if(isset($_GET['action']) && $_GET['action'] == 'devis-refuser')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";

    $reference = $_GET['reference'];

    $sql_update_devis = mysql_query("UPDATE swd_devis SET etat_devis = '3' WHERE reference = '$reference'")or die(mysql_error());
    mail("mmockelyn@cridip.com", "SWD - DEVIS CLIENT REFUSER", "Le devis référence $reference à été refuser par le client");

    if($sql_update_devis === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=devis&data=view_devis&reference=$reference&success=devis-refuser");
    }else{
        header("Location: ../../index.php?view=gestion&sub=devis&data=view_devis&reference=$reference&error=devis-refuser");
    }
}
if(isset($_GET['action']) && $_GET['action'] == 'devis-accepter')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";

    $reference = $_GET['reference'];

    $sql_update_devis = mysql_query("UPDATE swd_devis SET etat_devis = '2' WHERE reference = '$reference'")or die(mysql_error());
    mail("mmockelyn@cridip.com", "SWD - DEVIS CLIENT ACCEPTER", "Le devis référence $reference à été accepter par le client");

    if($sql_update_devis === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=devis&data=view_devis&reference=$reference&success=devis-accepter");
    }else{
        header("Location: ../../index.php?view=gestion&sub=devis&data=view_devis&reference=$reference&error=devis-accepter");
    }
}
if(isset($_GET['action']) && $_GET['action'] == 'transf-facture')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";

    $reference = $_GET['reference'];

    $sql_devis = mysql_query("SELECT * FROM swd_devis WHERE reference = '$reference'")or die(mysql_error());
    $devis = mysql_fetch_array($sql_devis);
    $iddevis = $devis['iddevis'];

    $num_facture = "FCTSWD2015".date("n").rand(1,9999);
    $idclient = $devis['idclient'];
    $date_facture = $date_jour_strt;
    $total_ht = $devis['total_ht'];
    $etat = 1;

    $sql_add_facture = mysql_query("INSERT INTO swd_facture(idfacture, ref_devis, reference, idclient, etat_facture, date_facture, date_echeance, idprojet, total_ht) VALUES (NULL, '$reference', '$num_facture', '$idclient', '$etat', '$date_facture', '$date_facture', '0', '$total_ht')")or die(mysql_error());
    $sql_facture = mysql_query("SELECT * FROM swd_facture WHERE reference = '$num_facture'")or die(mysql_error());
    $facture = mysql_fetch_array($sql_facture);
    $idfacture = $facture['idfacture'];
    
    $sql_ligne_devis = mysql_query("SELECT * FROM swd_devis_ligne WHERE iddevis = '$iddevis'")or die(mysql_error());
    while($ligne = mysql_fetch_array($sql_ligne_devis))
    {
        $idarticle = $ligne['idarticle'];
        $qte = $ligne['qte'];
        $commentaire = $ligne['commentaire'];
        $total_ligne = $ligne['total_ligne'];
        $sql_add_ligne_facture = mysql_query("INSERT INTO swd_facture_ligne(idfactureligne, idfacture, idarticle, qte, commentaire, total_ligne) VALUES (NULL, '$idfacture', '$idarticle', '$qte', '$commentaire', '$total_ligne')")or die(mysql_error());
    }

    if($sql_add_facture === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=facture&data=view_facture&reference=$num_facture&success=transf-facture");
    }else{
        header("Location: ../../index.php?view=gestion&sub=devis&data=view_devis&reference=$reference&error=transf-facture");
    }
}

if(isset($_POST['action']) && $_POST['action'] == 'add-article-devis')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";
    $iddevis = $_POST['iddevis'];
    $idarticle = $_POST['idarticle'];
    $qte = $_POST['qte'];
    $commentaire = htmlentities(addslashes($_POST['commentaire']));
    
    $sql_devis = mysql_query("SELECT * FROM swd_devis WHERE iddevis = '$iddevis'")or die(mysql_error());
    $devis = mysql_fetch_array($sql_devis);
    $total_ht = $devis['total_ht'];
    $reference = $devis['reference'];
    
    $sql_article = mysql_query("SELECT * FROM swd_article WHERE idarticle = '$idarticle'")or die(mysql_error());
    $article = mysql_fetch_array($sql_article);
    $prix_vente_ht = $article['prix_vente_ht'];
    
    $total_ligne = $prix_vente_ht + $qte;
    $total_ht = $total_ht + $total_ligne;
    
    $sql_update_devis = mysql_query("UPDATE swd_devis SET total_ht = '$total_ht' WHERE iddevis = '$iddevis'")or die(mysql_error());
    $sql_add_ligne_devis = mysql_query("INSERT INTO swd_devis_ligne(iddevisligne, iddevis, idarticle, qte, commentaire, total_ligne) VALUES (NULL, '$iddevis', '$idarticle', '$qte', '$commentaire', '$total_ligne')")or die(mysql_error());

    if($sql_update_devis === TRUE AND $sql_add_ligne_devis === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=devis&data=view_devis&reference=$reference&success=add-article-devis");
    }else{
        header("Location: ../../index.php?view=gestion&sub=devis&data=view_devis&reference=$reference&error=add-article-devis");
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'edit-article-devis')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";

    $iddevisligne = $_POST['iddevisligne'];
    $commentaire = htmlentities(addslashes($_POST['commentaire']));

    $sql_ligne = mysql_query("SELECT * FROM swd_devis_ligne WHERE iddevisligne = '$iddevisligne'")or die(mysql_error());
    $ligne = mysql_fetch_array($sql_ligne);
    $iddevis = $ligne['iddevis'];

    $sql_devis = mysql_query("SELECT * FROM swd_devis WHERE iddevis = '$iddevis'")or die(mysql_error());
    $devis = mysql_fetch_array($sql_devis);
    $total_ht = $devis['total_ht'];
    $reference = $devis['reference'];



    $sql_update_ligne_devis = mysql_query("UPDATE swd_devis_ligne SET commentaire = '$commentaire' WHERE iddevisligne = '$iddevisligne'")or die(mysql_error());

    if($sql_update_ligne_devis === TRUE )
    {
        header("Location: ../../index.php?view=gestion&sub=devis&data=view_devis&reference=$reference&success=edit-article-devis");
    }else{
        header("Location: ../../index.php?view=gestion&sub=devis&data=view_devis&reference=$reference&error=edit-article-devis");
    }
}
if(isset($_GET['action']) && $_GET['action'] == 'supp-article-devis')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";

    $iddevisligne = $_POST['iddevisligne'];

    $sql_ligne = mysql_query("SELECT * FROM swd_devis_ligne WHERE iddevisligne = '$iddevisligne'")or die(mysql_error());
    $ligne = mysql_fetch_array($sql_ligne);
    $iddevis = $ligne['iddevis'];
    $total_ligne = $ligne['total_ligne'];

    $sql_devis = mysql_query("SELECT * FROM swd_devis WHERE iddevis = '$iddevis'")or die(mysql_error());
    $devis = mysql_fetch_array($sql_devis);
    $total_ht = $devis['total_ht'];
    $reference = $devis['reference'];


    $total_ht = $total_ht - $total_ligne;


    $sql_update_devis = mysql_query("UPDATE swd_devis SET total_ht = '$total_ht' WHERE iddevis = '$iddevis'")or die(mysql_error());
    $sql_delete_ligne = mysql_query("DELETE FROM swd_devis_ligne WHERE iddevisligne = '$iddevisligne'")or die(mysql_error());

    if($sql_delete_ligne === TRUE AND $sql_update_devis === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=devis&data=view_devis&reference=$reference&success=supp-article-devis");
    }else{
        header("Location: ../../index.php?view=gestion&sub=devis&data=view_devis&reference=$reference&error=supp-article-devis");
    }
}
