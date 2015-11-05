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
                <span><i class="icon  fa fa-globe"></i> WEB</span>
                <ul>
                    <li><a href="index.php?view=ovh&sub=web_domaine"><i class="icon  fa fa-globe"></i> Domaine </a></li>
                    <li><a href="index.php?view=ovh&sub=web_hebergement"><i class="icon  fa fa-database"></i> Hebergement </a></li>
                    <li><a href="index.php?view=ovh&sub=web_exchange"><i class="icon  fa fa-envelope-square"></i> Exchange </a></li>
                    <li><a href="index.php?view=ovh&sub=web_office"><i class="icon  fa fa-windows"></i> Office </a></li>
                    <li><a href="index.php?view=ovh&sub=web_vps"><i class="icon  fa fa-server"></i> VPS </a></li>
                    <li><a href="index.php?view=ovh&sub=web_license"><i class="icon  fa fa-key"></i> License </a></li>
                </ul>
            </li>
            <li>
                <span><i class="icon  fa fa-server"></i> DEDIE</span>
                <ul>
                    <li><a href="index.php?view=ovh&sub=dedie_ip"><i class="icon  fa fa-adn"></i> IP </a></li>
                    <li><a href="index.php?view=ovh&sub=dedie_server"><i class="icon  fa fa-server"></i> Serveur dédiés </a></li>
                    <li><a href="index.php?view=ovh&sub=dedie_cloud"><i class="icon  fa fa-cloud"></i> Dedicated Cloud </a></li>
                </ul>
            </li>
            <li>
                <span><i class="icon  fa fa-phone-square"></i> TELECOM</span>
                <ul>
                    <li><a href="index.php?view=ovh&sub=tel_xdsl"> xDSL </a></li>
                    <li><a href="index.php?view=ovh&sub=tel_telephonie"> Téléphonie </a></li>
                </ul>
            </li>
            <li>
                <span><i class="icon  fa fa-user-md"></i> Gestion de Compte</span>
                <ul>
                    <li><a href="index.php?view=ovh&sub=cpt_cpt"> Mon compte </a></li>
                    <li><a href="index.php?view=ovh&sub=cpt_abo"> Mes Abonnements </a></li>
                </ul>
            </li>
            <li>
                <span><i class="icon  fa fa-euro"></i> Facturation</span>
                <ul>
                    <li><a href="index.php?view=ovh&sub=fct_historique"> Historique Facture </a></li>
                    <li><a href="index.php?view=ovh&sub=cpt_abo"> Mes Abonnements </a></li>
                    <li><a href="index.php?view=ovh&sub=cpt_abo"> Catalogue des Offres </a></li>
                </ul>
            </li>
        </ul>
    <?php } ?>
</nav>
<!-- //nav left menu-->