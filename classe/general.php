<?php

/**
 * Created by PhpStorm.
 * User: CRIDIP-SWD
 * Date: 10/11/2015
 * Time: 14:38
 */
class general
{
    public function data_chart_general($date_debut, $date_fin)
    {
        $date_debut = strtotime($date_debut);
        $date_fin = strtotime($date_fin);
        $sql = mysql_query("SELECT SUM(total_ht) FROM swd_facture WHERE date_facture >= '$date_debut' AND date_facture <= '$date_fin'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return round($data, 2);
    }

    public function data_count_client()
    {
        $sql = mysql_query("SELECT COUNT(*) FROM client")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function data_count_devis()
    {
        $sql = mysql_query("SELECT COUNT(*) FROM swd_devis")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function data_count_facture()
    {
        $sql = mysql_query("SELECT COUNT(*) FROM swd_facture")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }
}