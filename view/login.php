<?php
include "inc/config.php";
if(isset($_SESSION['auth']))
{
    header("Location: ../index.php?view=index");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta information -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <!-- Title-->
    <title><?= NOM_LOGICIEL; ?> - Connexion</title>
    <!-- Favicons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <!-- CSS Stylesheet-->
    <link type="text/css" rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="assets/css/bootstrap/bootstrap-themes.css" />
    <link type="text/css" rel="stylesheet" href="assets/css/style.css" />

    <!-- Styleswitch if  you don't chang theme , you can delete -->
    <link type="text/css" rel="alternate stylesheet" media="screen" title="style1" href="assets/css/styleTheme1.css" />
    <link type="text/css" rel="alternate stylesheet" media="screen" title="style2" href="assets/css/styleTheme2.css" />
    <link type="text/css" rel="alternate stylesheet" media="screen" title="style3" href="assets/css/styleTheme3.css" />
    <link type="text/css" rel="alternate stylesheet" media="screen" title="style4" href="assets/css/styleTheme4.css" />

</head>
<body class="full-lg">
<div id="wrapper">

    <div id="main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="account-wall">
                        <section class="align-lg-center">
                            <div class="site-logo"></div>
                            <h1 class="login-title"><span>Bien</span>venue <small> <?= NOM_LOGICIEL; ?><br><?= VERSION_LOGICIEL; ?></small></h1>
                        </section>
                        <form class="form-signin" action="<?= ROOT,CONTROL; ?>user.php" method="post">
                            <section>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                    <input  type="text" class="form-control" name="login" placeholder="Username">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-key"></i></div>
                                    <input type="password" class="form-control"  name="password" placeholder="Password">
                                </div>
                                <button class="btn btn-lg btn-theme-inverse btn-block" type="submit" name="action" value="connexion">Connexion</button>
                            </section>
                        </form>
                        <a href="#" class="footer-link">&copy; 2015 SAS CRIDIP &trade; </a>
                    </div>
                    <!-- //account-wall-->

                </div>
                <!-- //col-sm-6 col-md-4 col-md-offset-4-->
            </div>
            <!-- //row-->
        </div>
        <!-- //container-->

    </div>
    <!-- //main-->


</div>
<!-- //wrapper-->


<?php include "inc/script.php"; ?>
</body>
</html>