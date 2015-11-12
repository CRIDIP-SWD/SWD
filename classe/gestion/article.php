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
}