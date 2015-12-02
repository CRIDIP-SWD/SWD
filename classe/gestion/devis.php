<?php

/**
 * Created by PhpStorm.
 * User: CRIDIP-SWD
 * Date: 10/11/2015
 * Time: 14:39
 */
class devis
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

    public function verif_count_fam_ndd($iddevis)
    {
        $sql = mysql_query("SELECT COUNT(swd_devis_ligne.idarticle) FROM swd_devis_ligne, swd_article WHERE swd_devis_ligne.idarticle = swd_article.idarticle AND swd_article.famille = '1' AND swd_devis_ligne.iddevis = '$iddevis'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function verif_count_fam_heber($iddevis)
    {
        $sql = mysql_query("SELECT COUNT(swd_devis_ligne.idarticle) FROM swd_devis_ligne, swd_article WHERE swd_devis_ligne.idarticle = swd_article.idarticle AND swd_article.famille = '2' AND swd_devis_ligne.iddevis = '$iddevis'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function verif_count_fam_em($iddevis)
    {
        $sql = mysql_query("SELECT COUNT(swd_devis_ligne.idarticle) FROM swd_devis_ligne, swd_article WHERE swd_devis_ligne.idarticle = swd_article.idarticle AND swd_article.famille = '3' AND swd_devis_ligne.iddevis = '$iddevis'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function verif_count_fam_sd($iddevis)
    {
        $sql = mysql_query("SELECT COUNT(swd_devis_ligne.idarticle) FROM swd_devis_ligne, swd_article WHERE swd_devis_ligne.idarticle = swd_article.idarticle AND swd_article.famille = '4' AND swd_devis_ligne.iddevis = '$iddevis'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function verif_count_fam_vps($iddevis)
    {
        $sql = mysql_query("SELECT COUNT(swd_devis_ligne.idarticle) FROM swd_devis_ligne, swd_article WHERE swd_devis_ligne.idarticle = swd_article.idarticle AND swd_article.famille = '5' AND swd_devis_ligne.iddevis = '$iddevis'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function verif_count_fam_ri($iddevis)
    {
        $sql = mysql_query("SELECT COUNT(swd_devis_ligne.idarticle) FROM swd_devis_ligne, swd_article WHERE swd_devis_ligne.idarticle = swd_article.idarticle AND swd_article.famille = '6' AND swd_devis_ligne.iddevis = '$iddevis'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function verif_count_fam_oi($iddevis)
    {
        $sql = mysql_query("SELECT COUNT(swd_devis_ligne.idarticle) FROM swd_devis_ligne, swd_article WHERE swd_devis_ligne.idarticle = swd_article.idarticle AND swd_article.famille = '7' AND swd_devis_ligne.iddevis = '$iddevis'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function verif_count_fam_voip($iddevis)
    {
        $sql = mysql_query("SELECT COUNT(swd_devis_ligne.idarticle) FROM swd_devis_ligne, swd_article WHERE swd_devis_ligne.idarticle = swd_article.idarticle AND swd_article.famille = '8' AND swd_devis_ligne.iddevis = '$iddevis'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function verif_count_fam_sms($iddevis)
    {
        $sql = mysql_query("SELECT COUNT(swd_devis_ligne.idarticle) FROM swd_devis_ligne, swd_article WHERE swd_devis_ligne.idarticle = swd_article.idarticle AND swd_article.famille = '9' AND swd_devis_ligne.iddevis = '$iddevis'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function verif_count_fam_service($iddevis)
    {
        $sql = mysql_query("SELECT COUNT(swd_devis_ligne.idarticle) FROM swd_devis_ligne, swd_article WHERE swd_devis_ligne.idarticle = swd_article.idarticle AND swd_article.famille = '10' AND swd_devis_ligne.iddevis = '$iddevis'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function verif_count_fam_license($iddevis)
    {
        $sql = mysql_query("SELECT COUNT(swd_devis_ligne.idarticle) FROM swd_devis_ligne, swd_article WHERE swd_devis_ligne.idarticle = swd_article.idarticle AND swd_article.famille = '11' AND swd_devis_ligne.iddevis = '$iddevis'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function verif_count_fam_materiel($iddevis)
    {
        $sql = mysql_query("SELECT COUNT(swd_devis_ligne.idarticle) FROM swd_devis_ligne, swd_article WHERE swd_devis_ligne.idarticle = swd_article.idarticle AND swd_article.famille = '12' AND swd_devis_ligne.iddevis = '$iddevis'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }
}