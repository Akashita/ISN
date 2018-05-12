<?php

try
{
// On se connecte à MySQL$
$bdd = new PDO('mysql:host="http://phpmyadmin.free.fr/phpMyAdmin/";dbname=isnstex;charset=utf8', 'isnstex', 'isn2018$');
}
catch(Exception $e)
{
// En cas d'erreur, on affiche un message et on arrête tout
die('Erreur : '.$e->getMessage());
}
// S'il n'y a pas d'erreur, on affiche les commentaires

// Cela sert à définir le fuseau horaire, ici : Paris/Europe.
date_default_timezone_set('UTC');
$datetoday = date("Y-m-d"); // Voici la date d'aujourd'hui, format AAAA-MM-JJ

// On ajoute une entrée dans la table comment à la date du jour
$inser = $bdd->prepare('INSERT INTO comment(date_com, com) VALUES(?, ?)');
$inser->execute(array($datetoday, $_POST['comment'])); // Date d'aujourd'hui et le commentaire


header('Location: index.php') //Permet de revenir à la page d'avant
?>
