<!--
Personal website
Copyright (C) 2018 Swan Launay

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
-->

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="archives.css" />
  <title>Swan Launay - archives</title>
</head>
<body>
  <?php
  //src svg https://www.virendrachandak.com/techtalk/creating-csv-file-using-php-and-mysql/

  /*$file = fopen('test.txt', 'w+');

  Il ouvre le fichier en lecture et écriture.
  Le "w+" créer le fichier si il n'existe pas.*/

  $format = array();
  if (isset($_GET['start']) AND isset($_GET['stop'])){ //isset() écarte les valeurs nulles
    $start = $_GET['start'];
    $stop = $_GET['stop'];
    if (isset($_GET['vVent'])){  //On regarde quelles informations l'utilisateur veut
      array_push($format, '$$VVENT');
    } if (isset($_GET['dVent'])) {
      array_push($format, '$$DVENT');
    } if (isset($_GET['pres'])) {
      array_push($format, '$$PRES');
    } if (isset($_GET['hum'])) {
      array_push($format, '$$HUM');
    } if (isset($_GET['date'])) {
      array_push($format, '$$DATE');
    } if (isset($_POST['temp'])) {
      array_push($format, '$$TEMP');
    }
    if (strlen($start) == 10 AND strlen($stop) == 10 AND DateTime::createFromFormat('d-m-Y', $start) AND DateTime::createFromFormat('d-m-Y', $stop)){ //Vérification du format de la date d=jj m=mm Y=aaaa
      list($jourStart, $moisStart, $anneeStart) = explode('-', $start); //On découpe la variable start en trois (jour,mois,année)
      list($jourStop, $moisStop, $anneeStop) = explode('-', $stop);//idem pour stop
      if (checkdate($moisStart,$jourStart,$anneeStart) AND checkdate($moisStop,$jourStop,$anneeStop)) {//On test si la date est valide grâce à la fonction checkdate()
        if (isset($format[0]) != ""){ //On regarde qu'au moins une informations est demandée
          $fileName = "archives/archives.csv";
          $file = fopen($fileName, 'w+'); //On ouvre le fichier 'archives.csv' dans le dossier 'archives'

          $data = array( //Création du futur contenu du fichier avec un tableau
            array('Method : GET'), //Chaque ligne correspond à une une ligne dans un tableur
            array('Date', 'Vitesse vent (m/s)', 'Direction vent', 'Température', 'Pression', 'Humidité'),// on écrit l'en-tête du fichier csv
              // C'est ici que judith doit remplir le fichier avec les données de la base de données.
          );

          foreach ($data as $row)
          {
            fputcsv($file, $row); //on rempli le fichier avec le tableau ci dessus
          }


          //-----------------------------------------------------------  Gestion du fichier ZIP
          $zip = new ZipArchive(); //instanciation de la classe ZipArchive
          if($zip->open('archives/archives.zip', ZipArchive::OVERWRITE) == true){ //On test que le fichier est bien la
            $zip->deleteName('archives.csv'); //Supression de l'ancien fichier
            $zip->deleteName('README.txt');
            $zip->addFile('archives/archives.csv'); //Ajout du nouveau
            $zip->addFile('archives/README.txt');
            $zip->close(); //Fermeture de l'instance
          }
          else{
            echo '<div class="error"> Erreur : Impossible d&#039;ouvrir le fichier zip, veuillez contacter un administrateur en cliquant ici : <a href="index.php#comment">Signalement</a></div>';
          }
          //-----------------------------------------------------------

          echo '<div class="box"><form method="get" action="archives/archives.zip">Votre fichier est prêt ! Cliquez ici pour le télécharger : <input type="submit" name="dlButton" value="Télécharger"></form></div>';
          //Création du bouton de téléchargement
        } else {
          echo '<div class="error"> Erreur : Mauvaise rédaction du format, veuillez vous référer à la <a href="doc.php">documentation</a></div>';
        }
      } else {
        echo '<div class="error""> Erreur : la date n\'est pas valide, veuillez vous référer à la <a href="doc.php">documentation</a></div>';
      }
    } else {
      echo '<div class="error""> Erreur : format de la date non conforme, veuillez vous référer à la <a href="doc.php">documentation</a></div>';
    }
  } elseif (isset($_POST['start']) AND isset($_POST['stop'])) {
    $start = $_POST['start'];
    $stop = $_POST['stop'];
    if (strlen($start) == 10 AND strlen($stop) == 10 AND DateTime::createFromFormat('Y-m-d', $start) AND DateTime::createFromFormat('Y-m-d', $stop)) {
      list($anneeStart, $moisStart, $jourStart) = explode('-', $start); //On découpe la variable start en trois (jour,mois,année)
      list($anneeStop, $moisStop, $jourStop) = explode('-', $stop);//idem pour stop
      if (checkdate($moisStart,$jourStart,$anneeStart) AND checkdate($moisStop,$jourStop,$anneeStop)) {
        if (isset($_POST['vVent'])){
          array_push($format, '$$VVENT');
        } if (isset($_POST['dVent'])) {
          array_push($format, '$$DVENT');
        } if (isset($_POST['pres'])) {
          array_push($format, '$$PRES');
        } if (isset($_POST['hum'])) {
          array_push($format, '$$HUM');
        } if (isset($_POST['date'])) {
          array_push($format, '$$DATE');
        } if (isset($_POST['temp'])) {
          array_push($format, '$$TEMP');
        }
        if (isset($format[0]) != ""){
          $fileName = "archives/archives.csv";
          $file = fopen($fileName, 'w+');

          $data = array(
            array('Method : POST'),
            array('Date', 'Vitesse vent (m/s)', 'Direction vent', 'Température', 'Pression', 'Humidité'),// on écrit l'en-tête du fichier csv
              // C'est ici que judith doit remplir le fichier avec les données de la base de données.
          );
          foreach ($data as $row)
          {
            fputcsv($file, $row);
          }

          //-----------------------------------------------------------
          $zip = new ZipArchive();
          if($zip->open('archives/archives.zip', ZipArchive::OVERWRITE) === true){
            $zip->deleteName('archives.csv');
            $zip->deleteName('README.txt');
            $zip->addFile('archives/archives.csv'); //Ajout du nouveau
            $zip->addFile('archives/README.txt');
            $zip->close();
          }
          else{
            echo '<div class="error"> Erreur : Impossible d&#039;ouvrir le fichier zip.</div>';
          }
          //-----------------------------------------------------------


          echo '<div class="box"><form method="get" action="archives/archives.zip">Votre fichier est prêt ! Cliquez ici pour le télécharger : <input type="submit" name="dlButton" value="Télécharger"></form></div>';
        } else{
          echo '<div class="error"> Erreur : Vous n\'avez pas séléctionné d\'informations à exploiter. </div>';
        }
      } else {
        echo '<div class="error""> Erreur : la date n\'est pas valide, veuillez vous référer à la <a href="doc.php">documentation</a></div>';
      }
    } else {
      echo '<div class="error"> Erreur : format de la date non conforme/non saisi</div>';
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
