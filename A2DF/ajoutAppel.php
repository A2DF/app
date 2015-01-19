<html>

    <?php
    include ('html/head.html');
    include ('private/requetes.php');

    //Insertion des données dans la table "Appel"

    $date = "";
    $idClient = "";
    $idPersonnel = "";
    $motif = "";
    $idPriorite = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $date = filter_input(INPUT_POST, "date");
        $idClient = filter_input(INPUT_POST, "client");
        $idPersonnel = filter_input(INPUT_POST, "personnel");
        $motif = filter_input(INPUT_POST, "motif");
        $idPriorite = filter_input(INPUT_POST, "priorite");

        ajoutAppel($date, $idClient, $idPersonnel, $motif, $idPriorite);
    }
    ?>

    <link href="css/formulaires.css" rel="stylesheet" type="text/css">
    <link href="css/chosen.css" rel="stylesheet" type='text/css' >
    <body>
        <div class="contenu">
            <div class="ribbon-wrapper">
                <a  href="listeAppel.php"><img class="img_liste" onmouseout="this.src = 'img/arrow_undo.png'" onmouseover="this.src = 'img/arrow_undo1.png'" src="img/arrow_undo.png" /></a>
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
                                <td><select data-placeholder="Choose a Country..." class="chosen-select" style="width:350px;" tabindex="2">
                                        <option value=""></option>
                                        <option value="United States">United States</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Aland Islands">Aland Islands</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                    </select></td>

                                <!--
                                <td><input list='datalist' type='text' name='client' maxlength='50' value='<?php echo $idClient ?>'>
                                <datalist id="datalist">
                                <?php
                                /*
                                  $comboboxClient = comboboxClient();
                                  foreach ($comboboxClient as $client){
                                  $nom = $client['nom'];
                                  echo "<option value=" . $nom . "></option>";
                                  }
                                 */
                                ?>
                                </datalist></td>
                                -->
                            </tr>
                            <tr>
                                <td>Numero :</td>
                                <td><input type='text' name='numero' maxlength='50' value=''></td>
                            </tr>
                            <tr>
                                <td>Personnel concerne :</td>
                                <td><select name="personnel">
                                        <?php
                                        $comboboxPersonnel = comboboxPersonnel();
                                        foreach ($comboboxPersonnel as $personnel) {
                                            $idPers = $personnel['idPersonnel'];
                                            $prenom = $personnel['prenom'];
                                            echo "<option value=" . $idPers . ">" . $prenom . "</option>";
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
                                <td colspan="2"><textarea name="motif" rows="5" value='<?php echo $motif ?>'></textarea></td>
                            </tr>
                            <tr>
                                <td>Priorite :</td>
                                <td><select name="priorite">
                                        <?php
                                        $comboboxPriorite = comboboxPriorite();
                                        foreach ($comboboxPriorite as $priorite) {
                                            $idPrio = $priorite['idPriorite'];
                                            $libelle = $priorite['libelle'];
                                            echo "<option value=" . $idPrio . ">" . $libelle . "</option>";
                                        }
                                        ?>
                                    </select></td>
                            </tr>
                        </table>
                    </fieldset>
                </div>

                <div class="boutons">
                    <input type='reset' value='Annuler'>
                    <input type='submit' value='Valider'>
                </div>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
                <script src="js/chosen.jquery.js" type="text/javascript"></script>
                <script type="text/javascript">
                    var config = {
                        '.chosen-select': {},
                        '.chosen-select-deselect': {allow_single_deselect: true},
                        '.chosen-select-no-single': {disable_search_threshold: 10},
                        '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
                        '.chosen-select-width': {width: "95%"}
                    }
                    for (var selector in config) {
                        $(selector).chosen(config[selector]);
                    }
                </script>
            </form>
        </div>
    </body>
</html>
