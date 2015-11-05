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
        <!--<ul class="nav navbar-nav nav-top-xs hidden-xs tooltip-area">
            <li class="h-seperate"></li>
            <li><a href="#"> Online Store </a></li>
        </ul>-->
        <ul class="nav navbar-nav navbar-right tooltip-area">
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


<!--
/////////////////////////////////////////////////////////////////////////
//////////     TOP SEARCH CONTENT     ///////
//////////////////////////////////////////////////////////////////////
-->
<div class="widget-top-search">
    <span class="icon"><a href="#" class="close-header-search"><i class="fa fa-times"></i></a></span>
    <form id="top-search">
        <h2><strong>Quick</strong> Search</h2>
        <div class="input-group">
            <input  type="text" name="q" placeholder="Find something..." class="form-control" />
							<span class="input-group-btn">
							<button class="btn" type="button" title="With Sound"><i class="fa fa-microphone"></i></button>
							<button class="btn" type="button" title="Visual Keyboard"><i class="fa fa-keyboard-o"></i></button>
							<button class="btn" type="button" title="Advance Search"><i class="fa fa-th"></i></button>
							</span>
        </div>
    </form>
</div>
<!-- //widget-top-search-->


<!--
/////////////////////////////////////////////////////////////////////////
//////////     MAIN SHOW CONTENT     //////////
//////////////////////////////////////////////////////////////////////
-->