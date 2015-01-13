<html>

    <?php
    include ('html/head.html');
    include ('private/requetes.php');
    
    //Insertion des données dans la table "Appel"
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        ajoutAppel($date, $client, $numero, $personnel, $motif, $priorite);
    }
    ?>

    <link href="css/formulaires.css" rel="stylesheet" type="text/css">
    <body>

        <div class="ribbon-wrapper">
            <div class="ribbon-front"><div class="titre">Ajout d'un appel</div></div>
            <div class="ribbon-edge-topleft"></div>
            <div class="ribbon-edge-topright"></div>
            <div class="ribbon-edge-bottomleft"></div>
            <div class="ribbon-edge-bottomright"></div>
            <div class="ribbon-back-left"></div>
            <div class="ribbon-back-right"></div>
        </div>

        <form action='ajoutAppel.php' method='POST' name='formAjoutAppel'>

            <div class="boxGauche">
                <fieldset>
                    <legend>Informations</legend>
                    <table border="0">
                        <tr>
                            <td>Date de l'appel :</td>
                            <td><input type='date' name='date' maxlength='50' value='<?php echo $date ?>'></td>
                        </tr>
                        <tr>
                            <td>Client :</td>
                            <td><input type='text' name='client' maxlength='50' value='<?php echo $client ?>'></td>
                        </tr>
                        <tr>
                            <td>Numero :</td>
                            <td><input type='text' name='numero' maxlength='50' value='<?php echo $numero ?>'></td>
                        </tr>
                        <tr>
                            <td>Personnel concerne :</td>
                            <td><select>
                                    <?php
                                    $comboboxPersonnel = comboboxPersonnel();
                                    foreach ($comboboxPersonnel as $personnel){
                                        echo "<option value=" . $personnel . "> . $personnel . </option>";
                                    }
                                    ?>
                                </select></td>
                        </tr>
                    </table>
                </fieldset>
            </div>

            <div class="boxDroite">
                <fieldset>
                    <legend>Message</legend>
                    <table border="0">
                        <tr>
                            <td colspan="2"><textarea name="message" rows="5" cols="60" value='<?php echo $motif ?>'></textarea></td>
                        </tr>
                        <tr>
                            <td>Priorite :</td>
                            <td><select>
                                    <option value="">Non prioritaire</option>
                                    <option value="">Important (-72h)</option>
                                    <option value="">Urgent (-24h)</option>
                                </select></td>
                        </tr>
                    </table>
                </fieldset>
            </div>

            <div class="boutons">
                <input type='reset' value='Annuler'>
                <input type='submit' value='Valider'>
            </div>
        </form>
    </body>
</html>
