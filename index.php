<?php
if(isset($_GET['view']))
{
    switch($_GET['view'])
    {
        case "index":
            include "view/index.php";
            break;
    }
}else{
    include "view/error404.php";
}