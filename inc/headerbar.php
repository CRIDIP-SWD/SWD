<!--
		/////////////////////////////////////////////////////////////////////////
		//////////     HEADER  CONTENT     ///////////////
		//////////////////////////////////////////////////////////////////////
		-->
<div id="header">

    <div class="logo-area clearfix">
        <a href="#" class="logo"></a>
    </div>
    <!-- //logo-area-->

    <div class="tools-bar">
        <ul class="nav navbar-nav nav-main-xs">
            <li><a href="#" class="icon-toolsbar nav-mini"><i class="fa fa-bars"></i></a></li>
        </ul>
        <ul class="nav navbar-nav nav-top-xs hidden-xs tooltip-area">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"  data-hover="dropdown"><i class="fa fa-th-large"></i></a>
                <ul class="dropdown-menu arrow animated fadeInDown fast">
                    <li><a href="index.php?view=gestion"> Gestion Commercial</a></li>
                    <li><a href="index.php?view=ovh">OVH</a></li>
                    <li><a href="index.php?view=project">Projet</a></li>
                    <li><a href="index.php?view=outil">Outils</a></li>
                </ul>
                <!-- //dropdown-menu-->
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right tooltip-area">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                    <em>Etat des Services</em>
                </a>
                <ul class="dropdown-menu pull-right icon-right arrow">
                    <li>
                        <table style="width: 100%;">
                            <tr>
                                <td style="width: 50%; padding-left: 3px;"><?= $me1['nichandle']; ?></td>
                                <td style="width: 50%; text-align: right; padding-right: 3px;"><i class="fa fa-circle <?php if($me1){echo 'text-success';}else{echo 'text-danger';} ?>"></i></td>
                            </tr>
                            <tr>
                                <td style="width: 50%; padding-left: 3px;"><?= $me2['nichandle']; ?></td>
                                <td style="width: 50%; text-align: right; padding-right: 3px;"><i class="fa fa-circle <?php if($me2){echo 'text-success';}else{echo 'text-danger';} ?>"></i></td>
                            </tr>
                            <tr>
                                <td style="width: 50%; padding-left: 3px;"><?= $me3['nichandle']; ?></td>
                                <td style="width: 50%; text-align: right; padding-right: 3px;"><i class="fa fa-circle <?php if($me3){echo 'text-success';}else{echo 'text-danger';} ?>"></i></td>
                            </tr>
                        </table>
                    </li>
                </ul>
            </li>
            <li><a href="#" class="nav-collapse avatar-header" data-toggle="tooltip" title="Show / hide  menu" data-container="body" data-placement="bottom">
                    <img alt="" src="<?= SYNCHRONUS; ?>avatar/<?= $user['nom_user']; ?>.png"  class="circle">
                    <span class="badge">3</span>
                </a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                    <em><strong>Bonjour</strong>, <?= $user['nom_user']; ?> <?= $user['prenom_user']; ?> </em> <i class="dropdown-icon fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu pull-right icon-right arrow">
                    <li><a href="<?= ROOT,CONTROL; ?>user.php?action=logout&iduser=<?= $user['iduser']; ?>"><i class="fa fa-sign-out"></i> Déconnexion </a></li>
                </ul>
                <!-- //dropdown-menu-->
            </li>
        </ul>
    </div>
    <!-- //tools-bar-->

</div>
<!-- //header-->


<!--
/////////////////////////////////////////////////////////////////////////
//////////     SLIDE LEFT CONTENT     //////////
//////////////////////////////////////////////////////////////////////
-->
<div id="nav">
    <div id="nav-title">
        <h3><strong>Bonjour</strong>, <?= $user['nom_user']; ?> <?= $user['prenom_user']; ?></h3>
        <h5><?= $user['poste']; ?></h5>
    </div>
    <!-- //nav-title-->
    <div id="nav-scroll">
        <div class="avatar-slide">

								<span class="easy-chart avatar-chart" data-color="theme-inverse" data-percent="100" data-track-color="rgba(255,255,255,0.1)" data-line-width="5" data-size="118">
										<span class="percent"></span>
										<img alt="" src="<?= SYNCHRONUS; ?>avatar/<?= $user['nom_user']; ?>.png" class="circle">
								</span>
            <!-- //avatar-chart-->
        </div>
        <!-- //avatar-slide-->

    </div>
    <!-- //nav-scroller-->
</div>
<!-- //nav-->
