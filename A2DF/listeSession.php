<?php
include ('html/head.php');
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
                    </table>
                </fieldset>
                <div class="boutons">
                    <input type='submit' value='Valider'>
                </div>
            </div>
        </form>
    </div>
</body>