<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
				<link rel="stylesheet" href="comment.css"/>
        <title>Voici les commentaires :</title>
    </head>
    <body>

        <?php
    if (isset($_POST['mdp']) AND $_POST['mdp'] ==  "isn2018$") // Si le mot de passe est correct
    {
    // On affiche les commentaire

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
// S'il n'y a pas d'erreur, on s'identifie :


// On récupère tout le contenu de la table comment
$reponse = $bdd->query('SELECT * FROM comment ORDER BY date_com');

// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
?>
    <div class="box">
    <strong>Date</strong> : <?php echo $donnees['date_com']; ?><br />
    <strong>Commentaire</strong> : <?php echo $donnees['com']; ?> <br />
		<br />
		</div>
<?php
}

$reponse->closeCursor(); // On termine le traitement de la requête


}
else // Sinon, on affiche un message d'erreur
{
	echo '<p>Mot de passe invalide</p>';
}

?>

	</body>
</html>
