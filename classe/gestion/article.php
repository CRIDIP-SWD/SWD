<?php

/**
 * Created by PhpStorm.
 * User: CRIDIP-SWD
 * Date: 10/11/2015
 * Time: 20:44
 */
class article
{
    public function count_product_as_famille($idfamillearticle)
    {
        $sql = mysql_query("SELECT COUNT(idarticle) FROM swd_article WHERE famille = '$idfamillearticle'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function count_product_as_facture($idarticle)
    {
        $sql = mysql_query("SELECT COUNT(idarticle) FROM swd_facture_ligne WHERE idarticle = '$idarticle'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function gen_num_article()
    {
        $chaine = "AZERTYUIOPQSDFGHJKLMWXCVBN";
        $num = "1234567890";
        $code_article = "";
        $mel_caractere = str_shuffle($chaine);
        $gen_caractere = substr($mel_caractere, 0, 2);
        $gen_num = str_shuffle(substr($num, 0, 6));
        $code_article .= $gen_caractere.$gen_num;
        return $code_article;
    }
}