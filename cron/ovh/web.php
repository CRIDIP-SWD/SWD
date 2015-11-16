<?php
include "../../inc/config.php";
include "../../inc/classe.php";

// RECUPERATION DOMAINE
$domaine1 = $ovh1->get("/domain");
$domaine2 = $ovh2->get("/domain");
$domaine3 = $ovh3->get("/domain");

var_dump($domaine1);
var_dump($domaine2);
var_dump($domaine3);