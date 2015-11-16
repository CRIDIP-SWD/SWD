<?php
include "../../inc/config.php";
include "../../inc/classe.php";

// RECUPERATION DOMAINE
$domaine1 = $ovh1->get("/domain");
$domaine2 = $ovh2->get("/domain");
$domaine3 = $ovh3->get("/domain");

foreach ($domaine1 as $k => $domaine) {
    echo $domaine."<br>";
}