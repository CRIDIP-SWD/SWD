<?php

/**
 * Created by PhpStorm.
 * User: Maxime
 * Date: 10/11/2015
 * Time: 00:09
 */
class license
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