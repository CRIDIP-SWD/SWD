<?php
/**
 * Created by PhpStorm.
 * User: CRIDIP-SWD
 * Date: 09/11/2015
 * Time: 14:31
 */


class client
{
    public function balance_facture($idclient)
    {
        $sql_facture = mysql_query("SELECT SUM(total_ht) FROM swd_facture WHERE idclient = '$idclient'")or die(mysql_error());
        $facture = mysql_result($sql_facture, 0);
        return $facture;

    }

    public function balance_reglement($idclient)
    {
        $sql_reglement = mysql_query("SELECT SUM(montant_reglement) FROM swd_reglement, swd_facture WHERE swd_reglement.idfacture = swd_facture.idfacture AND swd_facture.idclient = '$idclient'")or die(mysql_error());
        $reglement = mysql_result($sql_reglement, 0);
        return $reglement;
    }

    public function balance($idclient)
    {
        $facture = $this->balance_facture($idclient);
        $rglt = $this->balance_reglement($idclient);

        $calc = $facture - $rglt;
        return $calc;
    }

    public function count_devis($idclient)
    {
        $sql = mysql_query("SELECT COUNT(*) FROM swd_devis WHERE idclient = '$idclient'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function count_facture($idclient)
    {
        $sql = mysql_query("SELECT COUNT(*) FROM swd_facture WHERE idclient = '$idclient'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }


}
if(isset($_GET['action']) && $_GET['action'] == 'calling')
{
    include('../../inc/config.php');
    $num_client = $_GET['num_client'];
    $num_appeler = $_GET['num_appeler'];
    $num_appelant = $_GET['num_appelant'];

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