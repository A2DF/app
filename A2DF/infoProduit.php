<html>
    <meta charset="UTF-8">
    <?php
    include ('private/fonctions.php');

    $idProduit = filter_input(INPUT_GET, "id");

    //Initialisation du compteur d'erreurs pour le contrôle du formulaire
    $erreurs = 0;

    //Initialisation des messages d'erreur
    $libelleErr = "";
    $typeErr = "";
    $marqueErr = "";
    $prixErr = "";
    $etatErr = "";
    $info1Err = "";
    $info2Err = "";
    $info3Err = "";
    $info4Err = "";
    $info5Err = "";
    $info6Err = "";
    $info7Err = "";
    $info8Err = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $libelle_temp = filter_input(INPUT_POST, "libelle");
        controleLibelle($libelle_temp, $libelleErr, $libelle_, $erreurs);

        $type_ = filter_input(INPUT_POST, "type");
        $marque_ = filter_input(INPUT_POST, "marque");

        $prix_temp = filter_input(INPUT_POST, "prix");
        controlePrix($prix_temp, $prixErr, $prix_, $erreurs);

        $etat_ = filter_input(INPUT_POST, "etat");
        $info1_ = filter_input(INPUT_POST, "info1");
        $info2_ = filter_input(INPUT_POST, "info2");
        $info3_ = filter_input(INPUT_POST, "info3");
        $info4_ = filter_input(INPUT_POST, "info4");
        $info5_ = filter_input(INPUT_POST, "info5");
        $info6_ = filter_input(INPUT_POST, "info6");
        $info7_ = filter_input(INPUT_POST, "info7");
        $info8_ = filter_input(INPUT_POST, "info8");

        if ($erreurs === 0) {
            //Modification des données dans la table "Produit"
            modificationProduit($idProduit, $libelle_, $type_, $marque_, $prix_, $etat_, $info1_, $info2_, $info3_, $info4_, $info5_, $info6_, $info7_, $info8_);
            ?>

            <script language="javascript">
                window.opener.location = window.opener.location + "";
                window.self.close();
            </script>

            <?php
        }
    } else {

        //Initialisation des valeurs de champs

        $unProduit = unProduit($idProduit);
        foreach ($unProduit as $produit) {
            $libelle_ = $produit['libelle'];
            $type_ = $produit['idType'];
            $marque_ = $produit['idMarque'];

            if (isset($produit['prix'])) {
                $prix_ = $produit['prix'];
            } else {
                $prix_ = "";
            }

            if (isset($produit['etat'])) {
                $etat_ = ($produit['etat']);
            } else {
                $etat_ = "";
            }

            if (isset($produit['info1'])) {
                $info1_ = ($produit['info1']);
            } else {
                $info1_ = "";
            }

            if (isset($produit['info2'])) {
                $info2_ = ($produit['info2']);
            } else {
                $info2_ = "";
            }

            if (isset($produit['info3'])) {
                $info3_ = ($produit['info3']);
            } else {
                $info3_ = "";
            }

            if (isset($produit['info4'])) {
                $info4_ = ($produit['info4']);
            } else {
                $info4_ = "";
            }

            if (isset($produit['info5'])) {
                $info5_ = ($produit['info5']);
            } else {
                $info5_ = "";
            }

            if (isset($produit['info6'])) {
                $info6_ = ($produit['info6']);
            } else {
                $info6_ = "";
            }

            if (isset($produit['info7'])) {
                $info7_ = ($produit['info7']);
            } else {
                $info7_ = "";
            }

            if (isset($produit['info8'])) {
                $info8_ = ($produit['info8']);
            } else {
                $info8_ = "";
            }
        }
    }
    ?>

    <body>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,initial-scale=1.0,user-scalable=no" />
        <link href="css/formulaires.css" rel="stylesheet" type="text/css">
        <link href="css/chosen.css" rel="stylesheet" type='text/css' >
        <form method="post" action="infoProduit.php?id=<?php echo $idProduit ?>" autocomplete="off">
            <fieldset>
                <legend>Informations</legend>
                <p>
                    <label for="nom">Type :</label>
                    <select class="chosen-select" tabindex="2" name="type" value='<?php echo $type_ ?>'>
                        <?php
                        $comboboxType = comboboxType();
                        foreach ($comboboxType as $type) {
                            $idType = $type['idType'];
                            $libelleType = $type['libelle'];
                            if ($idType == $type_) {
                                echo "<option value=" . $idType . " selected>" . $libelleType . "</option>";
                            } else {
                                echo "<option value=" . $idType . ">" . $libelleType . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <br />
                    <label for="prenom">Marque :</label>
                    <select class="chosen-select" tabindex="2" name="marque" value='<?php echo $marque_ ?>'>
                        <option selected value='443'>Inconnue</option>
                        <?php
                        $comboboxMarque = comboboxMarque();
                        foreach ($comboboxMarque as $marque) {
                            $idMarq = $marque['idMarque'];
                            $libelleMarque = $marque['libelle'];
                            if ($idMarq == $marque_) {
                                echo "<option value=" . $idMarq . " selected>" . $libelleMarque . "</option>";
                            } else {
                                echo "<option value=" . $idMarq . ">" . $libelleMarque . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <br />
                    <label for="adresse">Libelle :</label>
                    <input type="text" name="libelle" value='<?php echo $libelle_ ?>'/>
                    <br />
                    <label for="cp">Prix :</label>
                    <input type="text" name="prix" value='<?php echo $prix_ ?>'/>
                    <br />
                    <label for="cp">Etat :</label>
                <table border="0">
                    <tr>
                        <td>
                            <?php
                            if ($etat_ == 0) {
                                echo "<label><input type='radio' name='etat' value='0' checked/>Neuf</label>";
                                echo "<label><input type='radio' name='etat' value='1'/>Occasion</label>";
                                echo "<label><input type='radio' name='etat' value='2'/>Destockage</label>";
                            } else if ($etat_ == 1) {
                                echo "<label><input type='radio' name='etat' value='0'/>Neuf</label>";
                                echo "<label><input type='radio' name='etat' value='1' checked/>Occasion</label>";
                                echo "<label><input type='radio' name='etat' value='2'/>Destockage</label>";
                            } else if ($etat_ == 2) {
                                echo "<label><input type='radio' name='etat' value='0'/>Neuf</label>";
                                echo "<label><input type='radio' name='etat' value='1'/>Occasion</label>";
                                echo "<label><input type='radio' name='etat' value='2' checked/>Destockage</label>";
                            }
                            ?>
                        </td>
                    </tr>
                </table>
                </p>
            </fieldset>
            <br />
            <fieldset>
                <legend>Compléments</legend>
                <p>
                    <label for="cp">Ligne 1 :</label>
                    <input type="text" name="info1" value='<?php echo $info1_ ?>'/>
                    <br />
                    <label for="cp">Ligne 2 :</label>
                    <input type="text" name="info2" value='<?php echo $info2_ ?>'/>
                    <br />
                    <label for="cp">Ligne 3 :</label>
                    <input type="text" name="info3" value='<?php echo $info3_ ?>'/>
                    <br />
                    <label for="cp">Ligne 4 :</label>
                    <input type="text" name="info4" value='<?php echo $info4_ ?>'/>
                    <br />
                    <label for="cp">Ligne 5 :</label>
                    <input type="text" name="info5" value='<?php echo $info5_ ?>'/>
                    <br />
                    <label for="cp">Ligne 6 :</label>
                    <input type="text" name="info6" value='<?php echo $info6_ ?>'/>
                    <br />
                    <label for="cp">Ligne 7 :</label>
                    <input type="text" name="info7" value='<?php echo $info7_ ?>'/>
                    <br />
                    <label for="cp">Ligne 8 :</label>
                    <input type="text" name="info8" value='<?php echo $info8_ ?>'/>
                    <br />
                </p>
            </fieldset>
            <br />
            <input type="submit" value="Enregistrer">
            <input type='reset' value='Réinitialiser'>
            <img id="exit" src='img/cross.png' title='Fermer la fenêtre' onclick="window.self.close();"/>
        </p>
    </form>
    <?php
    if ($libelleErr <> "") {
        echo "<img src='img/exclamation.png'/>  " . $libelleErr . "<br />";
    }
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
    <script src="lib/chosen.jquery.js" type="text/javascript"></script>
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
</body>
</html>