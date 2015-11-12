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
    public function verif_count_famille($iddevis)
    {
        $sql = mysql_query("SELECT COUNT(swd_devis_ligne.idarticle) FROM swd_devis_ligne, swd_article, swd_famille_article WHERE swd_devis_ligne.idarticle = swd_article.idarticle
                            AND swd_article.famille = swd_famille_article.idfamillearticle
                            AND swd_devis_ligne.iddevis = '$iddevis'")or die(mysql_error());
        $data = mysql_result($sql, 0);
        return $data;
    }
}