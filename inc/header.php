<?php
include "config.php";
if(!isset($_SESSION['auth']))
{
    header("Location: ../index.php?view=login");
}
include "classe.php";

?>
<!DOCTYPE html>
<html lang="fr">
<head>

    <!-- Meta information -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

    <!-- Title-->
    <title><?= NOM_LOGICIEL; ?> - <?= $nom_page; ?></title>

    <!-- Favicons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= ROOT,ASSETS,ICO; ?>apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= ROOT,ASSETS,ICO; ?>apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= ROOT,ASSETS,ICO; ?>apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?= ROOT,ASSETS,ICO; ?>apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="<?= ROOT,ASSETS,ICO; ?>favicon.ico">

    <!-- CSS Stylesheet-->
    <link type="text/css" rel="stylesheet" href="<?= ROOT,ASSETS,CSS; ?>bootstrap/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="<?= ROOT,ASSETS,CSS; ?>bootstrap/bootstrap-themes.css" />
    <link type="text/css" rel="stylesheet" href="<?= ROOT,ASSETS,CSS; ?>style.css" />

    <!-- Styleswitch if  you don't chang theme , you can delete -->
    <link type="text/css" rel="alternate stylesheet" media="screen" title="style4" href="<?= ROOT,ASSETS,CSS; ?>styleTheme4.css" />

</head>