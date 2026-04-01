<?php

//les informations de connexion a la BDD
$host = "localhost";
$dbname = "Store";
$username = "root";
$password=""; // mot de passe vide par défaut sur XAMP


try {
//connexion avec PDO
$pdo = new PDO ("mysql:host = $host, dbname = $dbname, charset=uft-8",
$username,
$password
);


//on demande a PDO de nous signaler toutes les erreurs SQl en mode exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//on demande a PDO de nous retourner les resultats des requetes sous forme de tablreaux associatifs 
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
}

catch(PDOEXCEPTION $e){
    die("Erreur de connexion a la base de donnees : ". $e->getMessage());
}
?>