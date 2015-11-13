<?php
require (dirname(__DIR__)."/vendor/autoload.php");

use \Ovh\Api;
$apk1 = "RZKbAlowUCBgoPds";
$endpoint = "ovh-eu";
$ask1 = "mAcXugeOcn2gZBvyb76bKvN1y2gACqmz";
$csk1 = "VTYF8K727bsg42Qn5so76iYb3994jbjp";
$ovh1 = new Ovh\Api($apk1,$ask1,$endpoint,$csk1);
$me1 = $ovh1->get("/me");

$apk2 = "nP9Ij0PFvlZw0wV6";
$endpoint = "ovh-eu";
$ask2 = "GpwkoBOZijNgqYFygxyEg2zMSGg4X3pX";
$csk2 = "tGEmEglYpqu2xkdOTM563FAQ3Y9sPJys";
$ovh2 = new Api($apk2,$ask2,$endpoint,$csk2);
$me2 = $ovh2->get("/me");

$apk3 = "YDrgCr1VvT3LtVf8";
$endpoint = "ovh-eu";
$ask3 = "eKekzBFbKfWeh3gKB1Fb4n9zXa16D6D2";
$csk3 = "5tQNjCGSfYHdxetHfWORhOvGufGXlFBg";
$ovh3 = new Api($apk3,$ask3,$endpoint,$csk3);
$me3 = $ovh3->get("/me");




require_once dirname(__DIR__)."/classe/user.php";
$user_cls = new user();
$login = $_SESSION['login'];
$user = $user_cls->info_user($login);

require_once dirname(__DIR__)."/classe/general.php";
$gen_cls = new general();

require_once dirname(__DIR__)."/classe/gestion/client.php";
$client_cls = new client();

require_once dirname(__DIR__)."/classe/gestion/devis.php";
$devis_cls = new devis();

require_once dirname(__DIR__)."/classe/gestion/facture.php";
$facture_cls = new facture();

require_once dirname(__DIR__)."/classe/gestion/article.php";
$article_cls = new article();




require_once dirname(__DIR__)."/classe/projet/projet.php";
$projet_cls = new projet();

require_once dirname(__DIR__)."/classe/projet/license.php";
$license_cls = new license();