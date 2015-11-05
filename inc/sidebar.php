<!--
		//////////////////////////////////////////////////////////////
		//////////     LEFT NAV MENU     //////////
		///////////////////////////////////////////////////////////
		-->
<nav id="menu" data-search="close">
    <?php if(isset($_GET['view']) && $_GET['view'] == 'index'){ ?>
        <ul>
            <li><a href="index.php?view=index"><i class="icon  fa fa-laptop"></i> Accueil </a></li>
        </ul>
    <?php } ?>
    <?php if(isset($_GET['view']) && $_GET['view'] == 'gestion'){ ?>
        <ul>
            <li><a href="index.php?view=gestion"><i class="icon  fa fa-laptop"></i> Accueil </a></li>
            <li><a href="index.php?view=gestion&sub=client"><i class="icon  fa fa-users"></i> Client </a></li>
            <li><a href="index.php?view=gestion&sub=devis"><i class="icon  fa fa-file-o"></i> Devis </a></li>
            <li><a href="index.php?view=gestion&sub=commande"><i class="icon  fa fa-cubes"></i> Commandes </a></li>
            <li><a href="index.php?view=gestion&sub=facture"><i class="icon  fa fa-eur"></i> Factures </a></li>
        </ul>
    <?php } ?>
    <?php if(isset($_GET['view']) && $_GET['view'] == 'ovh'){ ?>
        <ul>
            <li><a href="index.php?view=ovh"><i class="icon  fa fa-laptop"></i> Accueil </a></li>
            <li>
                <span><i class="icon  fa fa-laptop"></i> WEB</span>
                <ul>
                    <li><a href="index.php?view=ovh&sub=web_domaine"><i class="icon  fa fa-globe"></i> Domaine </a></li>
                    <li><a href="index.php?view=ovh&sub=web_hebergement"><i class="icon  fa fa-"></i> Domaine </a></li>
                </ul>
            </li>
        </ul>
    <?php } ?>
</nav>
<!-- //nav left menu-->