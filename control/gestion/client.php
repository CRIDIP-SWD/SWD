<?php
/**
 * Created by PhpStorm.
 * User: CRIDIP-SWD
 * Date: 09/11/2015
 * Time: 14:31
 */


class client
{

}
if(isset($_GET['action']) && $_GET['action'] == 'calling')
{

    $num_client = $_GET['num_client'];
    $num_appeler = $_GET['num_appeler'];
    $num_appelant = $_GET['num_appelant'];

    $soap = new SoapClient("https://www.ovh.com/soapi/soapi-re-1.63.wsdl");
    $responder = $soap->telephonyClick2CallDo("mmockelyn", "1992maxime", $num_appelant, $num_appeler, $num_appelant);

    if($call === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=client&data=view_client&num_client=$num_client&success=calling");
    }else{
        header("Location: ../../index.php?view=gestion&sub=client&data=view_client&num_client=$num_client&error=calling");
    }

}