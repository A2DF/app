<?php
include ("private/requetes.php");
session_start();
if ((isset($_SESSION['user'])) && (isset($_SESSION['pass']))) {
    session_destroy();
}

$user = "";
$pass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user = filter_input(INPUT_POST, 'user');
    $pass = filter_input(INPUT_POST, 'pass');
    $hash = sha1($pass);
    
    $login = login($user, $hash);
    foreach ($login as $ok) {
        $user_valide = $ok['login'];
        $pass_valide = $ok['mdp'];
    }
    
    if (($user = $user_valide) && ($hash = $pass_valide)){
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        header('location: index.php');
        exit;
    } else {
        header('location: index.php');
    }
}
?>

<html>
    <head>
        <title>A2DF Informatique</title>
        <meta charset='utf-8'>
        <link href='css/login.css' rel='stylesheet' type='text/css' />
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        
    </head>
    <body>
        <div class='login-form'>
            <div class="head">
                <img class="img" src="img/a2df.png" />
            </div>
            
            <form action='login.php' method='POST' name='formLogin'>
                <li>
                    <input type='text' name='user' value='<?= $user ?>'><a class='icon user'></a>
                </li>
                <li>
                    <input type='password' name='pass' value='<?= $pass ?>'><a class='icon lock'></a>
                </li>
                <input type='submit' value='LOG IN' >
            </form>
        </div>
        <div class='copy-right'>
            <p></p> 
        </div>
    </body>
</html>