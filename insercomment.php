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


$inser = $bdd->prepare('INSERT INTO comment(date_com, com) VALUES(?, ?)'); // Insertion d'un nouveau commentaire
$inser->execute(array(CURRENT_DATE, $_POST['comment'])); // Date d'aujourd'hui et le commentaire
echo $inser['com'];
?>
