<?php

/**
 * Created by PhpStorm.
 * User: CRIDIP-SWD
 * Date: 10/11/2015
 * Time: 14:41
 */
class user
{
    public function info_user($login)
    {
        $sql = mysql_query("SELECT * FROM utilisateur WHERE login = '$login'")or die(mysql_error());
        $data = mysql_fetch_array($sql);
        return $data;
    }
}