<?php

/**
 * Created by PhpStorm.
 * User: Maxime
 * Date: 09/11/2015
 * Time: 23:37
 */
class projet
{
    public function verif_echeance($date_jour, $date_echeance)
    {
        if($date_echeance > $date_jour)
        {
            return 1;
        }else{
            return 0;
        }
    }

    public function count_etape($idprojet)
    {
        $sql = mysql_query("SELECT COUNT(*) FROM swd_projet_etape WHERE idprojet = '$idprojet'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function count_tache($idprojet)
    {
        $sql = mysql_query("SELECT COUNT(*) FROM swd_projet_tache WHERE idprojet = '$idprojet'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function info_projet($idprojet)
    {
        $sql = mysql_query("SELECT * FROM swd_projet WHERE idprojet = '$idprojet'")or die(mysql_error());
        $data = mysql_fetch_array($sql);
        return $data;
    }

    public function sum_percent_tache($idprojet)
    {
        $count_tache = $this->count_tache($idprojet);
        $sql = mysql_query("SELECT SUM(progress) FROM swd_projet_tache WHERE idprojet = '$idprojet'")or die(mysql_error());
        $data = mysql_result($sql, 0);

        $calc_percent = $data/$count_tache;
        return $calc_percent;
    }
}