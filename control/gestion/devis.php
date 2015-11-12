<?php
if(isset($_POST['action']) && $_POST['action'] == 'add-devis')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";
    
    $idclient = $_POST['idclient'];
    $reference = "DEVSWD2015".date('n').rand(1,9999);
    $date_devis = strtotime($_POST['date_devis']);
    $date_echeance = $date_devis + $_POST['echeance'];
    
    $sql_add_devis = mysql_query("INSERT INTO swd_devis(`iddevis`, `reference`, `etat_devis`, `date_devis`, `date_echeance`, `idclient`, `total_ht`) VALUES (NULL, '$reference', '1', '$date_devis', '$date_echeance', '$idclient', '0')")or die(mysql_error());

    if($sql_add_devis === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=devis&data=view_devis&reference=$reference&success=add-devis");
    }else{
        header("Location: ../../index.php?view=gestion&sub=devis&error=add-devis");
    }
}