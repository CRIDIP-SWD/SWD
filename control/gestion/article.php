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
if(isset($_POST['action']) && $_POST['action'] == 'add-article')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";
    
    $type_article = $_POST['type_article'];
    $famille = $_POST['famille'];
    $nom_article = htmlentities(addslashes($_POST['nom_article']));
    $short_description = htmlentities(addslashes($_POST['short_description']));
    $long_description = htmlentities(addslashes($_POST['long_description']));
    $prix_vente_ht = $_POST['prix_vente_ht'];
    $code_article = $article_cls->gen_num_article();

    $sql_add_article = mysql_query("INSERT INTO swd_article(`idarticle`, `type_article`, `nom_article`, `code_article`, `short_description`, `long_description`, `caracteristique`, `prix_vente_ht`, `famille`, `quantite`)
                                  VALUES (NULL, '$type_article', '$nom_article', '$code_article', '$short_description', '$long_description', '', '$prix_vente_ht', '$famille', '0')")or die(mysql_error());

    if($sql_add_article === TRUE)
    {
        header("../../index.php?view=gestion&sub=article&data=view_article&code_article=$code_article&success=add-article");
    }else{
        header("../../index.php?view=gestion&sub=article&error=add-article");
    }
}