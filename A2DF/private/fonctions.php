<?php

function controleNom(&$champ_temp, &$champErr, &$champ, &$erreurs){
        if (trim($champ_temp) === "") {
            $champErr = "Veuillez saisir le nom de l'évenement";
            $erreurs++;
            $champ = $champ_temp;
        } else if (strlen($champ_temp) < 3){
            $champErr = "Le nom doit contenir 3 caractères minimum";
            $erreurs++;
            $champ = $champ_temp;
        } else {
            $champ = $champ_temp;
        }
    }