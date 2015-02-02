<?php
session_start();
if ((isset($_SESSION['user'])) && (isset($_SESSION['pass']))) {
    session_destroy();
}

$user_valide = "admin";
$pass_valide = "admin";
$user = "";
$pass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user = filter_input(INPUT_POST, 'user');
    $pass = filter_input(INPUT_POST, 'pass');

    if (($user_valide == $user) && ($pass_valide == $pass)) {
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        header('location: index.php');
        exit;
    }
}
?>

<html>
    <head>
        <title></title>
        <meta charset='utf-8'>
        <link href='css/login.css' rel='stylesheet' type='text/css' />
        <meta name='viewport' content='width=device-width, initial-scale=1'>
    </head>
    <body>
        <div class='login-form'>
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