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

    $sql_add_article = mysql_query("INSERT INTO swd_article(`idarticle`, `type_article`, `nom_article`, `code_article`, `short_description`, `long_description`, `prix_vente_ht`, `famille`, `quantite`)
                                  VALUES (NULL, '$type_article', '$nom_article', '$code_article', '$short_description', '$long_description', '$prix_vente_ht', '$famille', '0')")or die(mysql_error());

    if($sql_add_article === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=article&data=view_article&code_article=$code_article&success=add-article");
    }else{
        header("Location: ../../index.php?view=gestion&sub=article&error=add-article");
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'edit-article')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";

    $idarticle = $_POST['idarticle'];
    $type_article = $_POST['type_article'];
    $famille = $_POST['famille'];
    $nom_article = htmlentities(addslashes($_POST['nom_article']));
    $short_description = htmlentities(addslashes($_POST['short_description']));
    $long_description = htmlentities(addslashes($_POST['long_description']));
    $prix_vente_ht = $_POST['prix_vente_ht'];



    $sql_update_article = mysql_query("UPDATE swd_article SET type_article = '$type_article', famille = '$famille', nom_article = '$nom_article', short_description = '$short_description', long_description = '$long_description', prix_vente_ht = '$prix_vente_ht' WHERE idarticle = '$idarticle'")or die(mysql_error());

    $sql_article = mysql_query("SELECT * FROM swd_article WHERE idarticle = '$idarticle'")or die(mysql_error());
    $article = mysql_fetch_array($sql_article);
    $code_article = $article['code_article'];

    if($sql_update_article === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=article&data=view_article&code_article=$code_article&success=edit-article");
    }else{
        header("Location: ../../index.php?view=gestion&sub=article&data=view_article&code_article=$code_article&error=edit-article");
    }
}
if(isset($_GET['action']) && $_GET['action'] == 'supp-article')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";

    $idarticle = $_GET['idarticle'];
    $sql_article = mysql_query("SELECT * FROM swd_article WHERE idarticle = '$idarticle'")or die(mysql_error());
    $article = mysql_fetch_array($sql_article);
    $code_article = $article['code_article'];

    if($article_cls->count_product_as_facture($idarticle) != 0)
    {
        header("Location: ../../index.php?view=gestion&sub=article&data=view_article&code_article=$code_article&warning=existing-facture");
    }

    $sql_delete_article = mysql_query("DELETE FROM swd_article WHERE idarticle = '$idarticle'")or die(mysql_error());

    if($sql_delete_article === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=article&success=supp-article");
    }else{
        header("Location: ../../index.php?view=gestion&sub=article&data=view_article&code_article=$code_article&error=supp-article");
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'add-caracteristique')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";
    
    $idarticle = $_POST['idarticle'];
    $caracteristique = htmlentities(addslashes($_POST['caracteristique']));
    $value = htmlentities(addslashes($_POST['value']));
    
    $sql_article = mysql_query("SELECT * FROM swd_article WHERE idarticle = '$idarticle'")or die(mysql_error());
    $article = mysql_fetch_array($sql_article);
    $code_article = $article['code_article'];
    
    $sql_add_caracteristique = mysql_query("INSERT INTO swd_article_caracteristique(`idarticlecaracteristique`, `idarticle`, `caracteristique`, `value`) VALUES (NULL, '$idarticle', '$caracteristique', '$value')")or die(mysql_error());

    if($sql_add_caracteristique === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=article&data=view_article&code_article=$code_article&success=add-caracteristique");
    }else{
        header("Location: ../../index.php?view=gestion&sub=article&data=view_article&code_article=$code_article&error=add-caracteristique");
    }
}
if(isset($_GET['action']) && $_GET['action'] == 'supp-caracteristique')
{
    include "../../inc/config.php";
    include "../../inc/classe.php";

    $idarticlecaracteristique = $_GET['idarticlecaracteristique'];

    $sql_article = mysql_query("SELECT * FROM swd_article_caracteristique, swd_article WHERE swd_article_caracteristique.idarticle = swd_article.idarticle AND idarticlecaracteristique = '$idarticlecaracteristique'")or die(mysql_error());
    $article = mysql_fetch_array($sql_article);
    $code_article = $article['code_article'];

    $sql_delete_cara = mysql_query("DELETE FROM swd_article_caracteristique WHERE idarticlecaracteristique = '$idarticlecaracteristique'")or die(mysql_error());

    if($sql_delete_cara === TRUE)
    {
        header("Location: ../../index.php?view=gestion&sub=article&data=view_article&code_article=$code_article&success=supp-caracteristique");
    }else{
        header("Location: ../../index.php?view=gestion&sub=article&data=view_article&code_article=$code_article&error=supp-caracteristique");
    }
}