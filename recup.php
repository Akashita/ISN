<?php


/* // Projet sécurité, afin qu'il n'y ait que Camil qui puisse envoyer des données

if (isset($_POST['mdp']) AND $_POST['mdp'] ==  "isn2018$") // Si le mot de passe est correct
{
// On récupère les données

*/

try
{
$bdd = new PDO('mysql:host="http://phpmyadmin.free.fr/phpMyAdmin/";dbname=isnstex;charset=utf8', 'isnstex', 'isn2018$');

}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

// Si on a la température, la pression, la vitesse du vent, l'humidité, la poisition de la girouette
if (isset($_GET['T']) AND isset($_GET['P']) AND isset($_GET['A']) AND isset($_GET['H']) AND isset($_GET['G']))

{
  // Cela sert à définir le fuseau horaire, ici : Paris/Europe.
  date_default_timezone_set('Europe/Paris');
  $dtoday = date("Y-m-d H:i:s"); // Voici la date d'aujourd'hui, format AAAA-MM-JJ


  // On récupère les données transmises grâce à la méthode GET à la date et l'heure d'aujourd'hui
	$recup = $bdd->prepare('INSERT INTO meteo_actu(datetime_actu,temp,pres,Vmoy,hum,dVent) VALUES(:dt,:temp,:pres,:Vmoy,:hum,:dVent)');
  $recup->execute(array(
    'dt' => $dtoday,
    'temp' => $_GET['T'],
    'pres' => $_GET['P'],
    'Vmoy' => $_GET['A'],
    'hum' => $_GET['H'],
    'dVent' => $_GET['G']));
}

else // Ou il manque des paramètres, on avertit Camil grâce à un message
{
	echo 'Il manque des variables !';
}
?>
