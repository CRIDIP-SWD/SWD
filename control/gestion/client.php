<?php
/**
 * Created by PhpStorm.
 * User: CRIDIP-SWD
 * Date: 09/11/2015
 * Time: 14:31
 */

namespace Ovh\Api;
use Ovh\Api;
class client
{

}
if(isset($_GET['action']) && $_GET['action'] == 'calling')
{
    $apk1 = "vXjHPaL84Jct1zaB";
    $endpoint = "ovh-eu";
    $ask1 = "WwSivyMF8kcmKMlsjd6SRCQsmox8XKnO";
    $csk1 = "k1ung5OPmvb26KtO97wy6R85SyL2ZIVU";
    $ovh1 = new Api($apk1,$ask1,$endpoint,$csk1);

    $num_client = $_GET['num_client'];
    $num_appeler = $_GET['num_appeler'];
    $num_appelant = $_GET['num_appelant'];

    $call = $ovh1->post("/telephony/ovhtel-32816764-1/line/".$num_appelant."/click2Call", array(
        "calledNumber" => $num_appeler
    ));

    if($call === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=client&data=view_client&num_client=$num_client&success=calling");
    }else{
        header("Location: ../../index.php?view=gestion&sub=client&data=view_client&num_client=$num_client&error=calling");
    }

}