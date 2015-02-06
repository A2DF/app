<?php

include ('requetes.php');
session_start();

if ((!isset($_SESSION['user'])) && (!isset($_SESSION['pass']))) {
    header('location: login.php');
}

function controleDate(&$champ_temp, &$champErr, &$champ, &$erreurs) {
    if (trim($champ_temp) === "") {
        $champErr = "Veuillez choisir une date";
        $erreurs++;
        $champ = "";
    } else {
        $champ = $champ_temp;
    }
}

function controleQuantite(&$champ_temp, &$champErr, &$champ, &$erreurs) {
    if (trim($champ_temp) === "") {
        $champErr = "Veuillez choisir une quantité";
        $erreurs++;
        $champ = "";
    } else {
        $champ = $champ_temp;
    }
}

function controlePrix(&$champ_temp, &$champErr, &$champ, &$erreurs) {
    if (trim($champ_temp) === "") {
        $champErr = "Veuillez choisir un prix";
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

function controleFormule(&$champ_temp, &$champErr, &$champ, &$erreurs) {
    if (trim($champ_temp) === "") {
        $champErr = "Veuillez choisir une formule";
        $erreurs++;
        $champ = $champ_temp;
    } else {
        $champ = $champ_temp;
    }
}

function controleMotif(&$champ_temp, &$champErr, &$champ, &$erreurs) {
    if (trim($champ_temp) === "") {
        $champErr = "Veuillez saisir le motif";
        $erreurs++;
        $champ = $champ_temp;
    } else {
        $champ = $champ_temp;
    }
}

function controlePriorite(&$champ_temp, &$champErr, &$champ, &$erreurs) {
    if (trim($champ_temp) === "") {
        $champErr = "Veuillez choisir la priorité";
        $erreurs++;
        $champ = $champ_temp;
    } else {
        $champ = $champ_temp;
    }
}

function controleNom(&$champ_temp, &$champErr, &$champ, &$erreurs) {
    if (trim($champ_temp) === "") {
        $champErr = "Veuillez entrer un nom";
        $erreurs++;
        $champ = $champ_temp;
    } else {
        $champ = strtoupper($champ_temp);
    }
}

function controlePre(&$champ_temp, &$champErr, &$champ, &$erreurs) {
    if (trim($champ_temp) === "") {
        $champErr = "Veuillez saisir le prénom";
        $erreurs++;
        $champ = $champ_temp;
    } else {
        $champ = $champ_temp;
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