<?php

/**
 * Created by PhpStorm.
 * User: CRIDIP-SWD
 * Date: 13/11/2015
 * Time: 16:40
 */
class paypal
{
    private $username      = "mmockelyn-facilitator_api1.cridip.com";
    private $password       = "FGJ2MA5BNCGALE6L";
    private $signature = "AlIzC5MUHzAatg55o.bcr2tROd51Au5uflSRutvRku6OKlD71-cBRMQ4";
    private $endpoint = "https://api-3t.sandbox.paypal.com/nvp";
    private $version_api = "124.0";


    public function __construct($method, $returnUrl, $cancelUrl, $total_ttc, $num_facture, $token, $PayerID)
    {
        switch($method)
        {
            case 'SetExpressCheckout':
                $this->setExpressCheckout($method, $this->endpoint, ROOT.$returnUrl, ROOT.$cancelUrl, $total_ttc, $num_facture);
                break;

            case 'GetExpressCheckoutDetails':
                $this->GetExpressCheckoutDetails($method, $token);
                break;

            case 'DoExpressCheckoutPayment':
                $this->DoExpressCheckoutPayment($method, $token, $total_ttc, $PayerID, $num_facture);
                break;
        }

    }
    private function setExpressCheckout($method ,$endpoint , $returnUrl, $cancelUrl, $total_ttc, $num_facture)
    {
        $sql_fct = mysql_query("SELECT * FROM swd_facture, client WHERE swd_facture.idclient = client.idclient AND reference = '$num_facture'")or die(mysql_error());
        $fct = mysql_fetch_array($sql_fct);
        $nom_client = $fct['nom_client'];
        $adresse = html_entity_decode($fct['adresse']);
        $code_postal = $fct['code_postal'];
        $ville = html_entity_decode($fct['ville']);
        $tel = $fct['telephone'];
        $params = array(
            'METHOD'    => $method,
            'VERSION'   => $this->version_api,
            'USER'      => $this->username,
            'SIGNATURE' => $this->signature,
            'PWD'       => $this->password,
            'RETURNURL' => $returnUrl,
            'CANCELURL' => $cancelUrl,

            'PAYMENTREQUEST_0_AMT'              => $total_ttc,
            'PAYMENTREQUEST_0_CURRENCYCODE'     => "EUR",
            'LOGOIMG'                           => ROOT.ASSETS.IMG."logo_invice.png",
            'CUSTOMERSERVICENUMBER'             => "0033251232424",
            'PAYMENTREQUEST_0_DESC'             => $num_facture,

            'PAYMENTREQUEST_0_SHIPTONAME'       => $nom_client,
            'PAYMENTREQUEST_0_SHIPTOSTREET'     => $adresse,
            'PAYMENTREQUEST_0_SHIPTOCITY'       => $ville,
            'PAYMENTREQUEST_0_SHIPTOZIP'        => $code_postal,
            'PAYMENTREQUEST_0_SHIPTOPHONENUM'   => $tel,


        );
        $params = http_build_query($params);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL             => $endpoint,
            CURLOPT_POST            => 1,
            CURLOPT_POSTFIELDS      => $params,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_SSL_VERIFYPEER  => false,
            CURLOPT_SSL_VERIFYHOST  => false,
            CURLOPT_VERBOSE         => true
        ));
        $response = curl_exec($curl);
        $responseArray = array();
        parse_str($response, $responseArray);
        if(curl_errno($curl)){
            var_dump(curl_error($curl));
            curl_close($curl);
            die();
        }else{
            if($responseArray['ACK'] == 'Success'){
                header("Location: https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&useraction=commit&token=".$responseArray['TOKEN']);
            }else{
                var_dump($responseArray);
                die();
            }
            curl_close($curl);
        }

    }

    private function GetExpressCheckoutDetails($method, $token)
    {
        $params = array(
            'METHOD'    => $method,
            'TOKEN'     => $token,
            'VERSION'   => $this->version_api,
            'USER'      => $this->username,
            'SIGNATURE' => $this->signature,
            'PWD'       => $this->password,



        );
        $params = http_build_query($params);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL             => $this->endpoint,
            CURLOPT_POST            => 1,
            CURLOPT_POSTFIELDS      => $params,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_SSL_VERIFYPEER  => false,
            CURLOPT_SSL_VERIFYHOST  => false,
            CURLOPT_VERBOSE         => true
        ));
        $response = curl_exec($curl);
        $responseArray = array();
        parse_str($response, $responseArray);
        if(curl_errno($curl)){
            var_dump(curl_error($curl));
            curl_close($curl);
            die();
        }else{
            if($responseArray['ACK'] == 'Success'){
                $total = $responseArray['AMT'];
                $token = $responseArray['TOKEN'];
                $PayerID = $responseArray['PAYERID'];
                $num_facture = $responseArray['PAYMENTREQUEST_0_DESC'];
                header("Location: ../gestion/facture.php?action=payment&total=$total&token=$token&PayerID=$PayerID&num_facture=$num_facture");
            }else{
                var_dump($responseArray);
                die();
            }
            curl_close($curl);
        }
    }

    private function DoExpressCheckoutPayment($method, $token, $total_ttc, $PayerID, $num_facture)
    {
        $params = array(
            'METHOD'                            => $method,
            'TOKEN'                             => $token,
            'PAYERID'                           => $PayerID,
            'PAYMENTACTION'                     => 'Sale',
            'PAYMENTREQUEST_0_AMT'              => $total_ttc,
            'PAYMENTREQUEST_0_CURRENCYCODE'     => "EUR",
            'VERSION'                           => $this->version_api,
            'USER'                              => $this->username,
            'SIGNATURE'                         => $this->signature,
            'PWD'                               => $this->password,



        );
        $params = http_build_query($params);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL             => $this->endpoint,
            CURLOPT_POST            => 1,
            CURLOPT_POSTFIELDS      => $params,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_SSL_VERIFYPEER  => false,
            CURLOPT_SSL_VERIFYHOST  => false,
            CURLOPT_VERBOSE         => true
        ));
        $response = curl_exec($curl);
        $responseArray = array();
        parse_str($response, $responseArray);
        if(curl_errno($curl)){
            var_dump(curl_error($curl));
            curl_close($curl);
            die();
        }else{
            if($responseArray['ACK'] == 'Success'){
                $sql_facture = mysql_query("SELECT * FROM swd_facture WHERE reference = '$num_facture'")or die(mysql_error());
                $facture = mysql_fetch_array($sql_facture);
                $idfacture = $facture['idfacture'];
                $date_reglement = strtotime(date("d-m-Y 00:00:00"));
                $num_reglement = $responseArray['PAYMENTINFO_0_TRANSACTIONID'];
                $sql_add_reglement = mysql_query("INSERT INTO `swd_reglement`(`idreglement`, `idfacture`, `date_reglement`, `mode_reglement`, `nom_reglement`, `num_reglement`, `montant_reglement`)
                VALUES (NULL,'$idfacture','$date_reglement','2','PAYPAL CHECKOUT CB AUTH','$num_reglement','$total_ttc')")or die(mysql_error());

                $sql_up_fct = mysql_query("UPDATE swd_facture SET etat_facture = '2' WHERE idfacture = '$idfacture'")or die(mysql_error());
                if($sql_add_reglement === TRUE AND $sql_up_fct === TRUE)
                {
                    header("Location: ../../index.php?view=gestion&sub=facture&data=view_facture&reference=$num_facture&add-paiement=true");
                }else{
                    header("Location: ../../index.php?view=gestion&sub=facture&data=view_facture&reference=$num_facture&add-paiement=false");
                }
            }else{
                var_dump($responseArray);
                die();
            }
            curl_close($curl);
        }
    }
}