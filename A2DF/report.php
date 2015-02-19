<?php
include ('html/head.php');

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $message = filter_input(INPUT_POST, 'message');

    $to = 'hugo.jerome44@gmail.com';
    $email_subject = "Bug dans l'application A2DF";
    $email_body = $message;
    $headers = "";
    mail($to, $email_subject, $email_body, $headers);

    header('Location: index.php');
}
?>

<html>
    <link href="css/formulaires.css" rel="stylesheet" type="text/css">
    <link href="css/chosen.css" rel="stylesheet" type='text/css' >
    <link href="css/pikaday.css" rel="stylesheet" type="text/css">
    <body>
        <div class="contenu">
            <div class="ribbon-wrapper">
                <div class="ribbon-front"><div class="titre">Signaler un bug</div></div>
                <div class="ribbon-edge-topleft"></div>
                <div class="ribbon-edge-topright"></div>
                <div class="ribbon-edge-bottomleft"></div>
                <div class="ribbon-edge-bottomright"></div>
                <div class="ribbon-back-left"></div>
                <div class="ribbon-back-right"></div>
            </div>

            <form action='report.php' method='POST' name='formReport'>

                <div class="boxBas">
                    <fieldset>
                        <legend>Message</legend>
                        <table border="0">
                            <tr>
                                <td colspan="3"><textarea name="motif" rows="5" maxlength='300'><?php echo $message ?></textarea></td>
                            </tr>
                        </table>
                    </fieldset>
                </div>

                <div class="boutons">
                    <input type='submit' value='Valider'>
                </div>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
                <script src="lib/chosen.jquery.js" type="text/javascript"></script>

            </form>

        </div>
    </body>
</html>
