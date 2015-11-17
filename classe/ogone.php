<?php

/**
 * Created by PhpStorm.
 * User: CRIDIP-SWD
 * Date: 16/11/2015
 * Time: 16:36
 */
class ogone
{
    private $endpoint       = "https://secure.ogone.com/ncol/test/orderdirect.asp";
    private $pspid          = "cridipswd";
    private $userid         = "mockelyn";
    private $pswd           = "1992_Maxime";
    private $currency       = "EUR";
    private $shasign        = "20_Avenue_Jean_Jaures";
    private $operation      = "SAL";

    public function paiement_shell($reference, $montant_reglement, $num_carte, $date_expire, $cvc)
    {
        $sql_facture = mysql_query("SELECT * FROM swd_facture, client WHERE swd_facture.idclient = client.idclient AND reference = '$reference'")or die(mysql_error());
        $facture = mysql_fetch_array($sql_facture);

        if($facture['projet'] != 0)
        {
            $description = "Facture dur Projet";
        }else{
            $description = "";
        }

        $params = array(
            "PSPID"                     => $this->pspid,
            "ORDERID"                   => $reference,
            "USERID"                    => $this->userid,
            "PSWD"                      => $this->pswd,
            "AMOUNT"                    => $montant_reglement,
            "CURRENCY"                  => $this->currency,
            "CARDNO"                    => $num_carte,
            "ED"                        => $date_expire,
            "CVC"                       => $cvc,

            "COM"                       => $description,
            "CN"                        => $facture['nom_client'],
            "EMAIL"                     => $facture['email'],
            "SHASIGN"                   => $this->shasign,
            "OWNERADDRESS"              => html_entity_decode($facture['adresse']),
            "OWNERZIP"                  => $facture['code_postal'],
            "OWNERTOWN"                 => html_entity_decode($facture['ville']),
            "OWNERTELNO"                => "0".substr($facture['telephone'], 4, 12),
            "OPERATION"                 => $this->operation
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
        if(curl_errno($curl))
        {
            var_dump(curl_error($curl));
            curl_close($curl);
            die();
        }else{
            if($responseArray['STATUS'] == 5)
            {
                echo "OK";
            }else{
                var_dump($responseArray);
                die();
            }
            curl_close($curl);
        }
    }

}