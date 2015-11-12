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
if(isset($_GET['action']) && $_GET['action'] == 'supp-famille')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";

    $idfamillearticle = $_GET['idfamillearticle'];

    if($article_cls->count_product_as_famille($idfamillearticle) != 0)
    {
        header("Location: ../../index.php?view=gestion&sub=article&warning=existing-product");
    }

    $sql_delete_famille = mysql_query("DELETE FROM swd_famille_article WHERE idfamillearticle = '$idfamillearticle'")or die(mysql_error());

    if($sql_delete_famille === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=article&success=supp-famille");
    }else{
        header("Location: ../../index.php?view=gestion&sub=article&error=supp-famille");
    }

}