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
}