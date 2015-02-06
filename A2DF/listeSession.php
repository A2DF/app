<?php
if ($_SESSION['user'] <> "direction") {
    header('Location: login.php');
}

include ('html/head.php');

$okDirection = "";
$okAccueil = "";
$okAtelier = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $RequeteMdpDirection = mdpDirection();
    foreach ($RequeteMdpDirection as $mdpDirection) {
        $hashedBaseMdpDirection = $mdpDirection['mdp'];
    }

    $ancienMdpDirection = filter_input(INPUT_POST, "ancienMdpDirection");
    $hashedAncienMdpDirection = sha1($ancienMdpDirection);

    $nouveauMdpDirection = filter_input(INPUT_POST, "nouveauMdpDirection");
    $confirmMdpDirection = filter_input(INPUT_POST, "confirmMdpDirection");
    $nouveauMdpAccueil = filter_input(INPUT_POST, "nouveauMdpAccueil");
    $confirmMdpAccueil = filter_input(INPUT_POST, "confirmMdpAccueil");
    $nouveauMdpAtelier = filter_input(INPUT_POST, "nouveauMdpAtelier");
    $confirmMdpAtelier = filter_input(INPUT_POST, "confirmMdpAtelier");

    if ((($ancienMdpDirection <> "") && ($nouveauMdpDirection <> "") && ($confirmMdpDirection <> "")) && ($hashedAncienMdpDirection == $hashedBaseMdpDirection) && ($nouveauMdpDirection == $confirmMdpDirection)) {
        $hashedMdpDirection = sha1($nouveauMdpDirection);
        modifierMdpDirection($hashedMdpDirection);
        $okDirection = "<p style='color:green'>Modification effectuée</p>";
    } else {
        $okDirection = "<p style='color:red'>Aucune modification</p>";
    }

    if ((($nouveauMdpAccueil <> "") && ($confirmMdpAccueil <> "")) && ($nouveauMdpAccueil == $confirmMdpAccueil)) {
        $hashedMdpAccueil = sha1($nouveauMdpAccueil);
        modifierMdpAccueil($hashedMdpAccueil);
        $okAccueil = "<p style='color:green'>Modification effectuée</p>";
    } else {
        $okAccueil = "<p style='color:red'>Aucune modification</p>";
    }

    if ((($nouveauMdpAtelier <> "") && ($confirmMdpAtelier <> "")) && ($nouveauMdpAtelier == $confirmMdpAtelier)) {
        $hashedMdpAtelier = sha1($nouveauMdpAtelier);
        modifierMdpAtelier($hashedMdpAtelier);
        $okAtelier = "<p style='color:green'>Modification effectuée</p>";
    } else {
        $okAtelier = "<p style='color:red'>Aucune modification</p>";
    }
}
?>
<link href="css/formulaires.css" rel="stylesheet" type="text/css">

<body>
    <div class="contenu">
        <div class="ribbon-wrapper">
            <a  href="listeAppel.php"><img class="img_liste" onmouseout="this.src = 'img/arrow_undo.png'" onmouseover="this.src = 'img/arrow_undo1.png'" src="img/arrow_undo.png" /></a>
            <div class="ribbon-front"><div class="titre">Gestion des sessions</div></div>
            <div class="ribbon-edge-topleft"></div>
            <div class="ribbon-edge-topright"></div>
            <div class="ribbon-edge-bottomleft"></div>
            <div class="ribbon-edge-bottomright"></div>
            <div class="ribbon-back-left"></div>
            <div class="ribbon-back-right"></div>
        </div>
        <form method="post" action="listeSession.php" autocomplete="off">
            <div class="boxHaut">
                <fieldset>
                    <legend>Direction</legend>
                    <table border="0">
                        <tr>
                            <td class='label'>Ancien mot de passe :</td>
                            <td class='images'></td>
                            <td><input type='password' name='ancienMdpDirection' value=''></td>
                        </tr>
                        <tr>
                            <td class='label'>Nouveau mot de passe :</td>
                            <td class='images'></td>
                            <td><input type='password' name='nouveauMdpDirection' value=''></td>
                        </tr>
                        <tr>
                            <td class='label'>Confirmation :</td>
                            <td class='images'></td>
                            <td><input type='password' name='confirmMdpDirection' value=''></td>
                        </tr>
                        <tr>
                            <td colspan="3"><center><?= $okDirection ?></center></td>
                        </tr>
                    </table>
                </fieldset>
            </div>
            <div class="boxMilieu">
                <fieldset>
                    <legend>Accueil</legend>
                    <table border="0">
                        <tr>
                            <td class='label'>Nouveau mot de passe :</td>
                            <td class='images'></td>
                            <td><input type='password' name='nouveauMdpAccueil' value=''></td>
                        </tr>
                        <tr>
                            <td class='label'>Confirmation :</td>
                            <td class='images'></td>
                            <td><input type='password' name='confirmMdpAccueil' value=''></td>
                        </tr>
                        <tr>
                            <td colspan="3"><center><?= $okAccueil ?></center></td>
                        </tr>
                    </table>
                </fieldset>
            </div>
            <div class="boxBas">
                <fieldset>
                    <legend>Atelier</legend>
                    <table border="0">
                        <tr>
                            <td class='label'>Nouveau mot de passe :</td>
                            <td class='images'></td>
                            <td><input type='password' name='nouveauMdpAtelier' value=''></td>
                        </tr>
                        <tr>
                            <td class='label'>Confirmation :</td>
                            <td class='images'></td>
                            <td><input type='password' name='confirmMdpAtelier' value=''></td>
                        </tr>
                        <tr>
                            <td colspan="3"><center><?= $okAtelier ?></center></td>
                        </tr>
                    </table>
                </fieldset>
                <div class="boutons">
                    <input type='submit' value='Valider'>
                </div>
            </div>
        </form>
    </div>
</body>