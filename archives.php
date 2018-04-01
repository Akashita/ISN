<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="archives.css" />
  <title>Swan Launay - archives</title>
</head>
<body>
  <?php
  // ATTENTION, PB AVEC LES BALISE HTML A RETIRER DU FICHIER FINAL !

  //src svg https://www.virendrachandak.com/techtalk/creating-csv-file-using-php-and-mysql/

  /*$file = fopen('test.txt', 'w+');

Il t'ouvre le fichier en lecture et écriture.
Le "w+" créer le fichier si il n'existe pas.*/

  if (isset($_GET['start']) AND isset($_GET['stop']) AND isset($_GET['format'])){ //isset() écarte les valeurs nulles
    $start = $_GET['start'];
    $stop = $_GET['stop'];
    $format = $_GET['format'];
    if (strlen($start) == 10 AND strlen($stop) == 10 AND DateTime::createFromFormat('d/m/Y', $start)){ //Vérification du format de la date (à expliquer)
      if ($format == "csv"){



        // A aller chercher en sql !
        $data = array(
          array('Data 11', 'Data 12', 'Data 13', 'Data 14', 'Data 15'),
          array('Data 21', 'Data 22', 'Data 23', 'Data 24', 'Data 25'),
          array('Data 31', 'Data 32', 'Data 33', 'Data 34', 'Data 35'),
          array('Data 41', 'Data 42', 'Data 43', 'Data 44', 'Data 45'),
          array('Data 51', 'Data 52', 'Data 53', 'Data 54', 'Data 55')
        );

        // output each row of the data
        foreach ($data as $row)
        {
          fputcsv($file, $row);
        }
        exit();
      } elseif ($format == "txt") {
        echo '<div class="error"">Ce format n\'est pas encore disponible pour le moment,<br />veuillez plutôt vous diriger vers le format csv ... ';
      } else {
        echo '<div class="error"> Erreur : Mauvaise rédaction du format (+conseil de rédaction)</div>';
      }
    } else {
      echo '<div class="error""> Erreur : format de la date non comforme</div>';
    }
  } elseif (isset($_POST['start']) AND isset($_POST['stop']) AND isset($_POST['format'])) {
    if ($_POST['start'] == "" OR $_POST['stop'] == "" OR $_POST['format'] == "") {
      echo '<div class="error"> Erreur : Il y a des valeurs manquantes dans le formulaire.</div>';
    } else {
      if ($_POST['format'] == "csv"){
        $fileName = "yolo.csv";
        $file = fopen($fileName, 'w+');

        $data = array(
          array('Data 256', 'Data 12', 'Data 13', 'Data 14', 'Data 15'),
          array('Data 21', 'Data 22', 'Data 23', 'Data 24', 'Data 25'),
          array('Data 31', 'Data 32', 'Data 33', 'Data 34', 'Data 35'),
          array('Data 41', 'Data 42', 'Data 43', 'Data 44', 'Data 45'),
          array('Data 51', 'Data 52', 'Data 53', 'Data 54', 'Data 55')
        );

        // output each row of the data
        foreach ($data as $row)
        {
          fputcsv($file, $row);
        }
        echo '<div class="box"><form method="get" action="' .$fileName. '">Votre fichier est prêt ! Cliquez ici pour le télécharger : <input type="submit" name="dlButton" value="Télécharger"></form></div>';
      } elseif ($_POST['format'] == "txt") {
        echo '<div class="error">Ce format n\'est pas encore disponible pour le moment,<br />veuillez plutôt vous diriger vers le format csv</div>';
      }
    }
  } else{
    echo '<div class="error"> Erreur : Il manque des arguments dans l\'URL</div>';
  }

  ?>
  <div class="box">
    <form action="index.php#archivesRub">
      Vous voulez retourner sur la page d'accueil ? Cliquez ici :
     <input type="submit" name="retourAccueil" value="Retour">
    </form>
  </div>


</body>
</html>
