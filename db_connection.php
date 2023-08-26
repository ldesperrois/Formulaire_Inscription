<?php
// Desperrois Lucas
// Fichier de connexion à la base de données

// Veuillez changer le nom par celui que vous souhaitez
$nom_site = "Desperrois/>";

// Définition des variables de connexion
define('HOST', ''); // A DEFINIR
define('DB_NAME', ''); // à définir
define('USER', ''); //à définir
define('PASS', '');// à définir

// Connexion à la base de données
try {
    $db = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, USER, PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    die(); // Arrêter le script en cas d'erreur de connexion
}
?>