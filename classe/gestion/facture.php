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

    public function verif_count_fam_ndd($idfacture)
    {
        $sql = mysql_query("SELECT COUNT(swd_facture_ligne.idarticle) FROM swd_facture_ligne, swd_article WHERE swd_facture_ligne.idarticle = swd_article.idarticle AND swd_article.famille = '4' AND swd_facture_ligne.idfacture = '$idfacture'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function verif_count_fam_heber($idfacture)
    {
        $sql = mysql_query("SELECT COUNT(swd_facture_ligne.idarticle) FROM swd_facture_ligne, swd_article WHERE swd_facture_ligne.idarticle = swd_article.idarticle AND swd_article.famille = '5' AND swd_facture_ligne.idfacture = '$idfacture'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function verif_count_fam_em($idfacture)
    {
        $sql = mysql_query("SELECT COUNT(swd_facture_ligne.idarticle) FROM swd_facture_ligne, swd_article WHERE swd_facture_ligne.idarticle = swd_article.idarticle AND swd_article.famille = '6' AND swd_facture_ligne.idfacture = '$idfacture'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function verif_count_fam_sd($idfacture)
    {
        $sql = mysql_query("SELECT COUNT(swd_facture_ligne.idarticle) FROM swd_facture_ligne, swd_article WHERE swd_facture_ligne.idarticle = swd_article.idarticle AND swd_article.famille = '7' AND swd_facture_ligne.idfacture = '$idfacture'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function verif_count_fam_vps($idfacture)
    {
        $sql = mysql_query("SELECT COUNT(swd_facture_ligne.idarticle) FROM swd_facture_ligne, swd_article WHERE swd_facture_ligne.idarticle = swd_article.idarticle AND swd_article.famille = '8' AND swd_facture_ligne.idfacture = '$idfacture'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function verif_count_fam_ri($idfacture)
    {
        $sql = mysql_query("SELECT COUNT(swd_facture_ligne.idarticle) FROM swd_facture_ligne, swd_article WHERE swd_facture_ligne.idarticle = swd_article.idarticle AND swd_article.famille = '9' AND swd_facture_ligne.idfacture = '$idfacture'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function verif_count_fam_oi($idfacture)
    {
        $sql = mysql_query("SELECT COUNT(swd_facture_ligne.idarticle) FROM swd_facture_ligne, swd_article WHERE swd_facture_ligne.idarticle = swd_article.idarticle AND swd_article.famille = '10' AND swd_facture_ligne.idfacture = '$idfacture'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function verif_count_fam_voip($idfacture)
    {
        $sql = mysql_query("SELECT COUNT(swd_facture_ligne.idarticle) FROM swd_facture_ligne, swd_article WHERE swd_facture_ligne.idarticle = swd_article.idarticle AND swd_article.famille = '11' AND swd_facture_ligne.idfacture = '$idfacture'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function verif_count_fam_sms($idfacture)
    {
        $sql = mysql_query("SELECT COUNT(swd_facture_ligne.idarticle) FROM swd_facture_ligne, swd_article WHERE swd_facture_ligne.idarticle = swd_article.idarticle AND swd_article.famille = '12' AND swd_facture_ligne.idfacture = '$idfacture'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function verif_count_fam_service($idfacture)
    {
        $sql = mysql_query("SELECT COUNT(swd_facture_ligne.idarticle) FROM swd_facture_ligne, swd_article WHERE swd_facture_ligne.idarticle = swd_article.idarticle AND swd_article.famille = '14' AND swd_facture_ligne.idfacture = '$idfacture'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function verif_count_fam_license($idfacture)
    {
        $sql = mysql_query("SELECT COUNT(swd_facture_ligne.idarticle) FROM swd_facture_ligne, swd_article WHERE swd_facture_ligne.idarticle = swd_article.idarticle AND swd_article.famille = '15' AND swd_facture_ligne.idfacture = '$idfacture'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function verif_count_fam_materiel($idfacture)
    {
        $sql = mysql_query("SELECT COUNT(swd_facture_ligne.idarticle) FROM swd_facture_ligne, swd_article WHERE swd_facture_ligne.idarticle = swd_article.idarticle AND swd_article.famille = '16' AND swd_facture_ligne.idfacture = '$idfacture'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }

    public function balance_facture($idclient)
    {
        $sql_facture = mysql_query("SELECT SUM(total_ht) FROM swd_facture WHERE idclient = '$idclient'")or die(mysql_error());
        $facture = mysql_result($sql_facture, 0);
        return round($facture, 2);

    }

    public function balance_reglement($idclient)
    {
        $sql_reglement = mysql_query("SELECT SUM(montant_reglement) FROM swd_reglement, swd_facture WHERE swd_reglement.idfacture = swd_facture.idfacture AND swd_facture.idclient = '$idclient'")or die(mysql_error());
        $reglement = mysql_result($sql_reglement, 0);
        return round($reglement, 2);
    }

    public function balance($idclient)
    {
        $facture = $this->balance_facture($idclient);
        $rglt = $this->balance_reglement($idclient);

        $calc = $rglt - $facture;
        return round($calc, 2);
    }
}