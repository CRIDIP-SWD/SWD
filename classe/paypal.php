<?php

/**
 * Created by PhpStorm.
 * User: CRIDIP-SWD
 * Date: 13/11/2015
 * Time: 16:40
 */
class paypal
{
    private $password = "LV5RDCWQBYN2PB52";
    private $username = "seller_api3.cridip.com";
    private $signature = "AFcWxV21C7fd0v3bYYYRCpSSRl31Avd9BqPFkOQDkPo3jMtK9SKuG.v2";
    private $endpoint = "https://api-3t.sandbox.paypal.com/nvp";
    private $version = "202";
    private $devise = "EUR";
    private $error = array();


    private function params($method, $returnurl, $cancelurl, $total_ht)
    {
        $params = array(
            "METHOD"                => $method,
            "VERSION"               => $this->version,
            "USER"                  => $this->username,
            "SIGNATURE"             => $this->signature,
            "PWD"                   => $this->password,
            "RETURNURL"             => $returnurl,
            "CANCELURL"             => $cancelurl,
            "PAYMENTREQUEST_0_AMT"  => $total_ht
        );

        return $params;
    }

    public function setExpressCheckout($method, $returnurl, $cancelurl, $total_ht, $idfacture)
    {
        $params = $this->params($method, $returnurl, $cancelurl, $total_ht);

        //Initialisation de cURL
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->endpoint,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $params,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_SSL_VERIFYHOST => FALSE,
            CURLOPT_VERBOSE => 1
        ));
        $response = curl_exec($curl);
        $responseArray = array();
        parse_str($response, $responseArray);
        if(curl_errno($curl)){
            $this->errors = curl_error($curl);
            curl_close($curl);
            return false;
        }else{
            if($responseArray['ACK'] == 'Success'){
                $TOKEN = $responseArray['TOKEN'];
                header("Location: https://www.sandbox.paypal.com=webscr?cmd=_express-checkout&useraction=commit&token=$TOKEN");
            }else{
                $this->errors = $responseArray;
                curl_close($curl);
                return false;
            }
        }
    }
}