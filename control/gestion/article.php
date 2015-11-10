<?php
if(isset($_POST['action']) && $_POST['action'] == 'add-famille')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";

    $designation_famille = $_POST['designation_famille'];

    $sql_add_famille = mysql_query("INSERT INTO swd_famille_article(idfamillearticle, designation_famille) VALUES (NULL, '$designation_famille')")or die(mysql_error());

    if($sql_add_famille === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=article&success=add-famille");
    }else{
        header("Location: ../../index.php?view=gestion&sub=article&error=add-famille");
    }
}