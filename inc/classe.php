<?php
require_once('vendor/autoload.php');

use Ovh\Api;
$apk1 = "vXjHPaL84Jct1zaB";
$endpoint = "ovh-eu";
$ask1 = "WwSivyMF8kcmKMlsjd6SRCQsmox8XKnO";
$csk1 = "k1ung5OPmvb26KtO97wy6R85SyL2ZIVU";
$ovh1 = new Api($apk1,$ask1,$endpoint,$csk1);
$me1 = $ovh1->get("/me");

$apk2 = "vXjHPaL84Jct1zaB";
$endpoint = "ovh-eu";
$ask2 = "WwSivyMF8kcmKMlsjd6SRCQsmox8XKnO";
$csk2 = "k1ung5OPmvb26KtO97wy6R85SyL2ZIVU";
$ovh2 = new Api($apk2,$ask2,$endpoint,$csk2);
$me2 = $ovh2->get("/me");

$apk3 = "vXjHPaL84Jct1zaB";
$endpoint = "ovh-eu";
$ask3 = "WwSivyMF8kcmKMlsjd6SRCQsmox8XKnO";
$csk3 = "k1ung5OPmvb26KtO97wy6R85SyL2ZIVU";
$ovh3 = new Api($apk3,$ask3,$endpoint,$csk3);
$me3 = $ovh3->get("/me");


require_once "control/user.php";
$user_cls = new user();
$user = $user_cls->info_user($login);
