<html>
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
    $imageErr = "";
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

        $image_ = filter_input(INPUT_POST, "image");
        $etat_ = filter_input(INPUT_POST, "etat");
        $info1_ = filter_input(INPUT_POST, "info1");
        $info2_ = filter_input(INPUT_POST, "info2");
        $info3_ = filter_input(INPUT_POST, "info3");
        $info4_ = filter_input(INPUT_POST, "info4");
        $info5_ = filter_input(INPUT_POST, "info5");
        $info6_ = filter_input(INPUT_POST, "info6");
        $info7_ = filter_input(INPUT_POST, "info7");
        $info8_ = filter_input(INPUT_POST, "info8");

        $dossier = 'produits/';
        $fichier = basename($_FILES['image']['name']);
        $taille_maxi = 1000000;
        $taille = filesize($_FILES['image']['tmp_name']);
        $extensions = array('.png', '.PNG', '.jpg', '.JPG', '.jpeg', '.JPEG');
        $extension = strrchr($_FILES['image']['name'], '.');

        //Début des vérifications de sécurité...
        if (!in_array($extension, $extensions)) { //Si l'extension n'est pas dans le tableau
            $erreurExt = 'L\'image doit être de type png, jpg ou jpeg';
            $erreurs++;
        }

        if ($taille > $taille_maxi) {
            $erreurPoids = 'L\'image ne doit pas dépasser 1 Mo';
            $erreurs++;
        }

        if ($erreurs === 0) {

            $fichier = iconv('UTF-8', 'ISO-8859-15', $fichier);
            $fichier = strtr($fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
            $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
            //Insertion de l'image dans le dossier "produits"
            move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier);

            //Insertion des données dans la table "produit"
            modificationProduit($libelle_, $type_, $marque_, $prix_, $etat_, $fichier, $info1_, $info2_, $info3_, $info4_, $info5_, $info6_, $info7_, $info8_);

            //Redirection vers la liste des employés
            header('Location: listeProduit.php');
        }
        ?>

        <?php
    } else {

        //Initialisation des valeurs de champs

        $unProduit = unProduit($idProduit);
        foreach ($unProduit as $produit) {
            if (isset($produit['libelle'])) {
                $libelle_ = $produit['libelle'];
            } else {
                $libelle_ = "";
            }

            if (isset($produit['type'])) {
                $type_ = $produit['type'];
            } else {
                $type_ = "";
            }

            if (isset($produit['marque'])) {
                $marque_ = ($produit['marque']);
            } else {
                $marque_ = "";
            }

            if (isset($produit['prix'])) {
                $prix_ = $produit['prix'];
            } else {
                $prix_ = "";
            }

            if (isset($produit['etat'])) {
                $etat_ = $produit['etat'];
            } else {
                $etat_ = "";
            }

            if (isset($produit['fichier'])) {
                $fichier_ = $produit['fichier'];
            } else {
                $fichier_ = "";
            }

            if (isset($produit['info1'])) {
                $info1_ = $produit['info1'];
            } else {
                $info1_ = "";
            }

            if (isset($produit['info2'])) {
                $info2_ = $produit['info2'];
            } else {
                $info2_ = "";
            }

            if (isset($produit['info3'])) {
                $info3_ = $produit['info3'];
            } else {
                $info3_ = "";
            }

            if (isset($produit['info4'])) {
                $info4_ = $produit['info4'];
            } else {
                $info4_ = "";
            }

            if (isset($produit['info5'])) {
                $info5_ = $produit['info5'];
            } else {
                $info5_ = "";
            }

            if (isset($produit['info6'])) {
                $info6_ = $produit['info6'];
            } else {
                $info6_ = "";
            }

            if (isset($produit['info7'])) {
                $info7_ = $produit['info7'];
            } else {
                $info7_ = "";
            }

            if (isset($produit['info8'])) {
                $info8_ = $produit['info8'];
            } else {
                $info8_ = "";
            }
            
            $erreurExt = "";
            $erreurPoids = "";
        }
        
    }
    ?>

    <body>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,initial-scale=1.0,user-scalable=no" />
        <link href="css/formulaires.css" rel="stylesheet" type="text/css">
        <form method="post" action="infoProduit.php?id=<?php echo $idProduit ?>" autocomplete="off">
            <div class="boxHaut">
                <fieldset>
                    <legend>Informations</legend>
                    <table border="0">
                        <tr>
                            <td class="label">Type :</td>
                            <td class="images"></td>
                            <td>
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
                            </td>
                        </tr>
                        <tr>
                            <td class="label">Marque :</td>
                            <td class="images"></td>
                            <td>
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
                            </td>
                        </tr>
                        <tr>
                            <td class="label">Libelle* :</td>
                            <td class="images"></td>
                            <td><input type='text' name='libelle' value='<?php echo $libelle_ ?>'></td>
                        </tr>
                        <tr>
                            <td class="label">Prix* :</td>
                            <td class="images"></td>
                            <td><input type='text' name='prix' value='<?php echo $prix_ ?>'></td>
                        </tr>
                        <tr>
                            <td class="label">Etat :</td>
                            <td class="images"></td>
                            <td class="checkbox">
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
                </fieldset>
            </div>

            <div class="boxMilieu">
                <fieldset>
                    <legend>Compléments</legend>
                    <table border="0">
                        <tr>
                            <td class="label">Ligne 1 :</td>
                            <td class="images"></td>
                            <td><input type='text' name='info1' value='<?= $info1_ ?>'></td>
                        </tr>
                        <tr>
                            <td class="label">Ligne 2 :</td>
                            <td class="images"></td>
                            <td><input type='text' name='info2' value='<?= $info2_ ?>'></td>
                        </tr>
                        <tr>
                            <td class="label">Ligne 3 :</td>
                            <td class="images"></td>
                            <td><input type='text' name='info3' value='<?= $info3_ ?>'></td>
                        </tr>
                        <tr>
                            <td class="label">Ligne 4 :</td>
                            <td class="images"></td>
                            <td><input type='text' name='info4' value='<?= $info4_ ?>'></td>
                        </tr>
                        <tr>
                            <td class="label">Ligne 5 :</td>
                            <td class="images"></td>
                            <td><input type='text' name='info5' value='<?= $info5_ ?>'></td>
                        </tr>
                        <tr>
                            <td class="label">Ligne 6 :</td>
                            <td class="images"></td>
                            <td><input type='text' name='info6' value='<?= $info6_ ?>'></td>
                        </tr>
                        <tr>
                            <td class="label">Ligne 7 :</td>
                            <td class="images"></td>
                            <td><input type='text' name='info7' value='<?= $info7_ ?>'></td>
                        </tr>
                        <tr>
                            <td class="label">Ligne 8 :</td>
                            <td class="images"></td>
                            <td><input type='text' name='info8' value='<?= $info8_ ?>'></td>
                        </tr>
                    </table>
                </fieldset>
            </div>

            <div class="boxBas">
                <fieldset>
                    <legend>Image</legend>
                    <table border="0">
                        <tr>
                            <td><input type="hidden" name="MAX_FILE_SIZE" value="1000000"><input type='file' name='image' value=''></td>
                        </tr>
                    </table>
                </fieldset>
            </div>
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

    if ($prixErr <> "") {
        echo "<img src='img/exclamation.png'/>  " . $prixErr . "<br />";
    }

    if ($erreurExt <> "") {
        echo "<img src='img/exclamation.png'/>  " . $erreurExt . "<br />";
    }

    if ($erreurPoids <> "") {
        echo "<img src='img/exclamation.png'/>  " . $erreurPoids . "<br />";
    }
    ?>
</body>
</html>
