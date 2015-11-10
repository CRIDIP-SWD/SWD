<?php

/**
 * Created by PhpStorm.
 * User: CRIDIP-SWD
 * Date: 10/11/2015
 * Time: 14:39
 */
class facture
{
    public function verif_echeance($date_jour, $date_echeance)
    {
        if($date_echeance < $date_jour)
        {
            return 1;
        }else{
            return 0;
        }
    }

    public function chart_fct_client($date_debut, $date_fin, $idclient)
    {
        $date_debut = strtotime($date_debut);
        $date_fin = strtotime($date_fin);
        $sql = mysql_query("SELECT SUM(total_ht) FROM swd_facture WHERE date_facture >= '$date_debut' AND date_facture <= '$date_fin' AND swd_facture.idclient = '$idclient'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return round($data, 2);
    }
}