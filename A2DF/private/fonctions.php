<?php

function controleDate(&$champ_temp, &$champErr, &$champ, &$erreurs) {
    if (trim($champ_temp) === "") {
        $champErr = "Veuillez choisir une date";
        $erreurs++;
        $champ = "";
    } else {
        $champ = $champ_temp;
    }
}

function controleClient(&$champ_temp, &$champErr, &$champ, &$erreurs) {
    if (trim($champ_temp) === "") {
        $champErr = "Veuillez choisir un client";
        $erreurs++;
        $champ = $champ_temp;
    } else {
        $champ = $champ_temp;
    }
}

function controlePersonnel(&$champ_temp, &$champErr, &$champ, &$erreurs) {
    if (trim($champ_temp) === "") {
        $champErr = "Veuillez choisir un personnel";
        $erreurs++;
        $champ = $champ_temp;
    } else {
        $champ = $champ_temp;
    }
}

function controleMotif(&$champ_temp, &$champErr, &$champ, &$erreurs) {
    if (trim($champ_temp) === "") {
        $champErr = "Veuillez saisir le motif de l'appel";
        $erreurs++;
        $champ = $champ_temp;
    } else {
        $champ = $champ_temp;
    }
}

function controlePriorite(&$champ_temp, &$champErr, &$champ, &$erreurs) {
    if (trim($champ_temp) === "") {
        $champErr = "Veuillez choisir la priorité de l'appel";
        $erreurs++;
        $champ = $champ_temp;
    } else {
        $champ = $champ_temp;
    }
}

function controleNom(&$champ_temp, &$champErr, &$champ, &$erreurs) {
    if (trim($champ_temp) === "") {
        $champErr = "Veuillez entrer le nom du client";
        $erreurs++;
        $champ = $champ_temp;
    } else {
        $champ = strtoupper($champ_temp);
    }
}

function controlePrenom(&$champ_temp, &$champ, &$lower) {
    $lower = strtolower($champ_temp);
    $champ = ucfirst($lower);
}

function controleTel(&$champ_temp, &$champErr, &$champ, &$erreurs) {
    if (trim($champ_temp) === "") {
        $champErr = "Veuillez entrer un numero de téléphone";
        $erreurs++;
        $champ = $champ_temp;
    } else {
        $champErr = "";
        $champ = $champ_temp;
    }
}

?>