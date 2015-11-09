<?php

/**
 * Created by PhpStorm.
 * User: CRIDIP-SWD
 * Date: 09/11/2015
 * Time: 19:36
 */
class devis
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


}