<?php
include "../../inc/config.php";
include "../../inc/classe.php";

// RECUPERATION DOMAINE
$domaine = $ovh1->get("/domain");
$domaine .= $ovh2->get("/domain");
$domaine .= $ovh3->get("/domain");

var_dump($domaine);
