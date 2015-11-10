<?php
/**
 * Created by PhpStorm.
 * User: CRIDIP-SWD
 * Date: 09/11/2015
 * Time: 14:31
 */
if(isset($_GET['action']) && $_GET['action'] == 'calling')
{
    include('../../inc/config.php');
    $num_client = $_GET['num_client'];
    $num_appeler = $_GET['num_appeler'];
    $num_appelant = $_GET['num_appelant'];
    require ('../../inc/classe.php');


    $sql_client = mysql_query("SELECT * FROM client WHERE num_client = '$num_client'")or die(mysql_error());
    $client = mysql_fetch_array($sql_client);
    if(!empty($client['nom_societe']))
    {
        $nom_client = $client['nom_societe']." - ".$client['nom_client'];
    }else{
        $nom_client = $client['nom_client'];
    }

    $soap = new SoapClient("https://www.ovh.com/soapi/soapi-re-1.63.wsdl");
    $responder = $soap->telephonyClick2CallDo("mmockelyn", "1992maxime", $num_appelant, $num_appeler, $num_appelant);

    /*$apk1 = "vXjHPaL84Jct1zaB";
    $endpoint = "ovh-eu";
    $ask1 = "WwSivyMF8kcmKMlsjd6SRCQsmox8XKnO";
    $csk1 = "k1ung5OPmvb26KtO97wy6R85SyL2ZIVU";
    $ovh1 = new \Ovh\Api($apk1,$ask1,$endpoint,$csk1);*/

    /*$content_call = (object) array(
      "calledNumber" => $num_appeler
    );*/

    //$step = $ovh1->post("/telephony/ovhtel-32816764-1/line/0033972527971/click2Call", $content_call);

    if($responder === NULL)
    {
        $sql_called = mysql_query("INSERT INTO `client_called`(`idclientcalled`, `num_user`, `num_client`, `nom_client`, `date_appel`, `status`)
                                VALUES (NULL,'$num_appelant','$num_appeler','$nom_client','$date_jour_heure_strt','1')")or die("ERROR SQL: ".mysql_error());
        header("Location: ../../index.php?view=gestion&sub=client&data=view_client&num_client=$num_client&success=calling");
    }else{
        $sql_called = mysql_query("INSERT INTO `client_called`(`idclientcalled`, `num_user`, `num_client`, `nom_client`, `date_appel`, `status`)
                                VALUES (NULL,'$num_appelant','$num_appeler','$nom_client','$date_jour_heure_strt','0')")or die("ERROR SQL: ".mysql_error());
        header("Location: ../../index.php?view=gestion&sub=client&data=view_client&num_client=$num_client&error=calling");
    }

}
if(isset($_POST['action']) && $_POST['action'] == 'add-client')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";

    //Variable
    $num_client     = $client_cls->gen_num_client();
    $nom_client     = $_POST['nom_client'];
    $nom_societe    = $_POST['nom_societe'];
    $email          = $_POST['email'];
    $password_clear = $client_cls->gen_password(8);
    $password_crypt = sha1($password_clear);
    $telephone      = $_POST['telephone'];
    $adresse        = htmlentities(addslashes($_POST['adresse']));
    $code_postal    = $_POST['code_postal'];
    $ville          = htmlentities(addslashes($_POST['ville']));
    $region         = htmlentities(addslashes($_POST['region']));

    $sql_add_client = mysql_query("INSERT INTO `client`(`idclient`, `num_client`, `nom_client`, `nom_societe`, `email`, `password`, `telephone`, `adresse`, `ville`, `region`, `code_postal`, `etat_client`, `cridip`, `swd`, `scpvs`)
                                  VALUES (NULL,'$num_client','$nom_client','$nom_societe','$email','$password_crypt','$telephone','$adresse','$ville','$region','$code_postal','1','0','0','0')")or die(mysql_error());

    //Email
    $to = $email;
    $sujet = "Création de Votre espace Personnel - CRIDIP";
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
            <p>Vous avez fait appel à nos services et nous vous remercions.</p>
            <p>Voici un récapitulatif de l'inscription à votre Espace Client CRIDIP, où vous pourrez:</p>
            <ul>
                <li>Avoir accès à vos coordonnées et les modifiés</li>
                <li>Avoir accès à tous vos documents contractuel, factures, commandes et devis</li>
            </ul>
            <p>Voici vos identifiants:</p>
            <table class="id">
                <tr>
                    <td>Login:</td>
                    <td><?= $num_client; ?></td>
                </tr>
                <tr>
                    <td>Mot de Passe:</td>
                    <td><?= $password_clear; ?></td>
                </tr>
            </table>
            <a class="button" href="http://portail.cridip.com">ACCEDER A VOTRE ESPACE CLIENT</a>
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

    if($sql_add_client === TRUE AND $mail_envoie === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=client&data=view_client&num_client=$num_client&success=add-client");
    }else{
        header("Location: ../../index.php?view=gestion&sub=client&error=add-client");
    }

}
if(isset($_POST['action']) && $_POST['action'] == 'edit-client')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";

    $idclient       = $_POST['idclient'];
    $nom_client     = $_POST['nom_client'];
    $nom_societe    = $_POST['nom_societe'];
    $email          = $_POST['email'];
    $telephone      = $_POST['telephone'];
    $adresse        = htmlentities(addslashes($_POST['adresse']));
    $code_postal    = $_POST['code_postal'];
    $ville          = htmlentities(addslashes($_POST['ville']));
    $region         = htmlentities(addslashes($_POST['region']));

    $sql_edit_client = mysql_query("UPDATE client SET nom_client = '$nom_client',nom_societe = '$nom_societe',email = '$email',telephone = '$telephone',adresse = '$adresse',code_postal = '$code_postal',ville = '$code_postal',region = '$region'WHERE idclient = '$idclient'")or die(mysql_error());
    $client = $client_cls->info_client($idclient);
    $num_client = $client['num_client'];

//Email
    $to = $email;
    $sujet = "Modification de vos informations - CRIDIP";
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
            <p>Vos Informations ont été modifiées.</p>
            <p>Voici un récapitulatif de la modification apporter:</p>
            <table style="width: 50%; border: solid 2px #C1C1C1; border-radius: 5px;">
                <tr>
                    <td style="width: 50%; font-weight: 700; padding: 5px;">Nom de la société</td>
                    <td style="width: 50%; padding: 5px;"><?= $nom_societe; ?></td>
                </tr>
                <tr>
                    <td style="width: 50%; font-weight: 700; padding: 5px;">Nom du client</td>
                    <td style="width: 50%; padding: 5px;"><?= $nom_client; ?></td>
                </tr>
                <tr>
                    <td style="width: 50%; font-weight: 700; padding: 5px;">Adresse Mail</td>
                    <td style="width: 50%; padding: 5px;"><?= $email; ?></td>
                </tr>
                <tr>
                    <td style="width: 50%; font-weight: 700; padding: 5px;">Numéro de Téléphone</td>
                    <td style="width: 50%; padding: 5px;">0<?= substr($telephone, 4, 12); ?></td>
                </tr>
                <tr>
                    <td style="width: 50%; font-weight: 700; padding: 5px;">Adresse Postal</td>
                    <td style="width: 50%; padding: 5px;">
                        <?= html_entity_decode($adresse); ?><br>
                        <?= $code_postal; ?> <?= html_entity_decode($ville); ?><br>
                        <?= html_entity_decode($region); ?>
                    </td>
                </tr>
            </table>
            <p>Votre identifiant et votre mot de passe reste inchangé.</p>
            <p>Vous pouvez changer ces informations en allant sur <i>Espace client > Vos Informations</i></p>
            <p>Cordialement,</p>
            <p>Le service commercial</p>
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

    if($sql_edit_client === TRUE AND $mail_envoie === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=client&data=view_client&num_client=$num_client&success=edit-client");
    }else{
        header("Location: ../../index.php?view=gestion&sub=client&data=view_client&num_client=$num_client&error=edit-client");
    }
}
if(isset($_GET['action']) && $_GET['action'] == 'supp-client')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";

    $idclient = $_GET['idclient'];
    $client = $client_cls->info_client($idclient);
    $num_client = $client['num_client'];
    if(!empty($client['nom_societe']))
    {
        $nom_client = $client['nom_societe']." - ".$client['nom_client'];
    }else{
        $nom_client = $client['nom_client'];
    }

    $sql_delete_bank          = mysql_query("DELETE FROM client_bancaire WHERE idclient = '$idclient'")or die(mysql_error());
    $sql_delete_call          = mysql_query("DELETE FROM client_called WHERE nom_client = '$nom_client'")or die(mysql_error());
    $sql_delete_devis_c       = mysql_query("DELETE FROM c_devis WHERE idclient = '$idclient'")or die(mysql_error());
    $sql_delete_commande_c    = mysql_query("DELETE FROM c_commande WHERE idclient = '$idclient'")or die(mysql_error());
    $sql_delete_facture_c     = mysql_query("DELETE FROM c_facture WHERE idclient = '$idclient'")or die(mysql_error());
    
    $sql_delete_swd_devis     = mysql_query("DELETE FROM swd_devis WHERE idclient = '$idclient'")or die(mysql_error());
    $sql_delete_swd_facture = mysql_query("DELETE FROM swd_facture WHERE idclient = '$idclient'")or die(mysql_error());
    $sql_delete_swd_license = mysql_query("DELETE FROM swd_license WHERE idclient = '$idclient'")or die(mysql_error());
    $sql_delete_swd_projet = mysql_query("DELETE FROM swd_projet WHERE idclient = '$idclient'")or die(mysql_error());
    $sql_delete_swd_ticket = mysql_query("DELETE FROM swd_ticket WHERE idclient = '$idclient'")or die(mysql_error());

    if($sql_delete_bank === TRUE AND $sql_delete_call === TRUE AND $sql_delete_devis_c === TRUE AND $sql_delete_commande_c === TRUE AND $sql_delete_facture_c === TRUE
    AND $sql_delete_swd_devis === TRUE AND $sql_delete_swd_facture === TRUE AND $sql_delete_swd_license === TRUE AND $sql_delete_swd_projet === TRUE AND $sql_delete_swd_ticket === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=client&success=supp-client");
    }else{
        header("Location: ../../index.php?view=gestion&sub=client&error=supp-client");
    }


}