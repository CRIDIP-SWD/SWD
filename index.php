<?php
if(isset($_GET['view']))
{
    switch($_GET['view'])
    {
        case "index":
            include "view/index.php";
            break;
        case "login":
            include "view/login.php";
            break;
        case "ovh":
            include "view/ovh.php";
            break;
        case "gestion":
            include "view/gestion.php";
            break;
        case "project":
            include "view/projet.php";
            break;
        case "outil":
            include "view/outil.php";
            break;
    }
}else{
    include "view/index.php";
}