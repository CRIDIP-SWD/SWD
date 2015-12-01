<?php

if(isset($_POST['action']) && $_POST['action'] == 'connexion')
{
    require "../inc/config.php";
    if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['password']) && !empty($_POST['password']))) {
        $login = $_POST['login'];
        $pass = $_POST['password'];
        $sha_pass = sha1($login."_".$pass);

        // on teste si une entrée de la base contient ce couple login / pass
        $sql_verif_login = mysql_query("SELECT count(*) FROM user WHERE email = '$login' AND password = '$sha_pass'")or die(mysql_error());
        $data = mysql_result($sql_verif_login, 0);


        // si on obtient une réponse, alors l'utilisateur est un membre
        if ($data[0] == 1) {
            session_start();
            $_SESSION['login'] = $_POST['login'];
            $login = $_POST['login'];

            $sql_user = mysql_query("SELECT * FROM user WHERE email = '$login'")or die(mysql_error());
            $user = mysql_fetch_array($sql_user);
            $sql_up_user = mysql_query("UPDATE user SET connect = '2', last_connect = '$date_jour_heure_strt' WHERE email = '$login'")or die(mysql_error());
            if($user['active_totp'] == 1)
            {
                header('Location: ../index.php?view=login&sub=auth-o&login=$login');
            }else{
                header("Location: ../index.php?view=index");
            }
            exit();
        }
        // si on ne trouve aucune réponse, le visiteur s'est trompé soit dans son login, soit dans son mot de passe
        elseif ($data[0] == 0) {
            header("Location: ../index.php?view=login&error=user");
        }
        // sinon, alors la, il y a un gros problème :)
        else {
            header("Location: ../index.php?view=login&error=multi-user");
        }
    }
    else {
        header("Location: ../index.php?view=login&error=champs");
    }
}