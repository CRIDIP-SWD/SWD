<?php

/**
 * Created by PhpStorm.
 * User: CRIDIP-SWD
 * Date: 10/11/2015
 * Time: 14:39
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

        $calc = $rglt - $facture;
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

    public function count_projet($idclient)
    {
        $sql = mysql_query("SELECT COUNT(*) FROM swd_projet WHERE idclient = '$idclient'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function count_license($idclient)
    {
        $sql = mysql_query("SELECT COUNT(*) FROM swd_license WHERE idclient = '$idclient'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function count_ticket($idclient)
    {
        $sql = mysql_query("SELECT COUNT(*) FROM swd_ticket WHERE idclient = '$idclient'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function gen_num_client()
    {
        $chaine = "AZERTYUIOPQSDFGHJKLMWXCVBN";
        $num = "1234567890";
        $num_client = "";
        $gen_caractere = str_shuffle(substr($chaine, 0, 2));
        $gen_num = str_shuffle(substr($num, 0, 6));
        $num_client .= $gen_caractere.$gen_num;
        return $num_client;
    }

    public function gen_password($longueur)
    {
        $mdp = "";
        $chaine = "azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN0123456789";
        $longueur_max = strlen($chaine);
        if($longueur > $longueur_max)
        {
            $longueur = $longueur_max;
        }

        $i = 0;
        while($i < $longueur)
        {
            $caractere = substr($chaine, mt_rand(0, $longueur_max-1), 1);
            if(!strstr($mdp, $caractere))
            {
                $mdp .= $caractere;
                $i++;
            }
        }
        return $mdp;
    }
}