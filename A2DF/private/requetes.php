<?php

include('conf.php');

define('USER', $mysql_user);
define('MDP', $mysql_pass);
define('DSN', $mysql_host);
try {
    $connexion = new PDO(DSN, USER, MDP);
    $connexion->query("SET CHARACTER SET utf8");
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "<br />";
    $connexion = null;
}

function listeAppel(){
        global $requetes;
        $resultat = $requetes->query("  SELECT * 
                                        FROM appel
                                        ORDER BY appel.idAppel ASC;");
        return $resultat;
    }
?>
