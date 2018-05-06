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
  <title>Swan Launay - Accueil</title>
  <link rel="stylesheet" type="text/css" href="index.css" />
  <link rel="stylesheet" type="text/css" href="doc.css" />
  <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
  <script src="jquery-min.js"></script>
  <meta charset="UTF-8">
</head>
<body>
  <?php include 'navDoc.html'; ?>
  <div id="center">
    <?php include 'headerDoc.html'; ?>
    <article class="doc" id="bonjour">
      <section class="postDoc">
        <div class="topPostDoc">
          <h3 class="white">Récupération des archives</h3>
        </div>
        <p class="paraf">
          Nous mettons à disposition nos archives météorologiques. Ces archives sont gratuites mais soumises à la licence [insérer le nom de la licence].
          Vous avez deux possibilités pour télécharger ces archives :
        </p>
        <ul>
          <li>
            <h2>Par formulaire (recommandé) :</h2>
            <br />
            <ul>
              <li>
                <h3>Sur la <a href="index.php#archivesRub">page d'accueil</a> est disponible un formulaire vous permettant de :</h3>
                <ul>
                  <li>
                    Télécharger les archives au format .csv (fichier texte facilement exploitable avec un tableur)
                  </li>
                  <li>
                    Choisir la compostion de votre fichier (vent, humidité, pression, température...)<br />
                  </li>
                </ul>
              </li>
              <br />
              <li>
                <h3>Remarque :</h3> sur certains navigateurs le choix de la date doit se faire manuellement suivant le format suivant :
                <ul>
                  <li>
                    aaaa-mm-jj (année-mois-jour)
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <br />
          <li>
            <h2>Avec la méthode GET :</h2>
            <ul>
              <li>
                <h3>Il s'agit ici d'une utilisation plutôt orientée développeurs qui passe par la composition d'une URL.</h3>
              </li>
              <br />
              <li>
                <h3>La composition suit le schéma suivant :</h3><br /><br /> http://lenomdusite/archives.php?start=<strong>{dateDeDépart}</strong>&stop=<strong>{dateDeFin}</strong>&<strong>{vVent}</strong>&<strong>{dVent}</strong>&<strong>{pres}</strong>&<strong>{temp}</strong>&<strong>{hum}</strong>&<strong>{date}</strong><br />
                <ul>
                  <li>
                    Voici quelques exemples :
                    <table>
                      <tr>
                        <th>
                          URL à taper :
                        </th>
                        <th>
                          Réponse :
                        </th>
                      </tr>
                      <tr>
                        <td>
                          http://lenomdusite/archives.php?start=12-09-2016&stop=15-09-2016&vVent&dVent&pres&temp&hum
                        </td>
                        <td>
                          Un fichier en .csv qui contient la vitesse et la direction du vent, la pression, la température et l'humidité du 12 septembre 2016 jusqu'au 15 septembre 2016.
                        </td>
                      </tr>
                      <tr>
                        <td>
                          http://lenomdusite/archives.php?start=30-12-2017&stop=12-02-2018&date&vent
                        </td>
                        <td>
                          Un fichier en .csv qui contient la date des relévés et la vitesse du vent du 30 decembre 2017 jusqu'au 12 févriver 2018.
                        </td>
                      </tr>
                    </table>
                  </li>
                  <br />
                  <li>
                    Ainsi que les formats compatibles :
                    <table>
                      <tr>
                        <th>
                          {start}
                        </th>
                        <td>
                          jj/mm/aaaa
                        </td>
                      </tr>
                      <tr>
                        <th>
                          {stop}
                        </th>
                        <td>
                          jj/mm/aaaa
                        </td>
                      </tr>
                      <tr>
                        <th>
                          {vVent}
                        </th>
                        <td>
                          La vitesse du vent*
                        </td>
                      </tr>
                      <tr>
                        <th>
                          {dVent}
                        </th>
                        <td>
                          La direction du vent*
                        </td>
                      </tr>
                      <tr>
                        <th>
                          {pres}
                        </th>
                        <td>
                          La pression*
                        </td>
                      </tr>
                      <tr>
                        <th>
                          {temp}
                        </th>
                        <td>
                          La température*
                        </td>
                      </tr>
                      <tr>
                        <th>
                          {hum}
                        </th>
                        <td>
                          L'humidité*
                        </td>
                      </tr>
                      <tr>
                        <th>
                          {date}
                        </th>
                        <td>
                          La date*
                        </td>
                      </tr>
                    </table>
                    <ul>
                      <li>
                        *Pour ajouter un de ces paramètres au fichier il est juste nécessaire d'écrire le nom de la variable sans lui donner de valeur
                        (Exemple : http://lenomdusite/archives.php?start=30-12-2017&stop=12-02-2018&<strong>vVent&dVent&pres</strong>).<br />
                        La simple présence de la variable ajoute le paramètre au fichier.
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </section>
      <section class="postDoc">
        <div class="topPostDoc">
          <h3 class="white">Code source du projet</h3>
        </div>
        <p class="paraf">
          Ce projet est un projet libre qui suit la licence GNU GPL v3, il vous est donc possible de télécharger et de modifier le code source de ce dernier.
          <br />Pour cela deux moyens :
          <ul>
            <li>
              Cliquez ici pour télécharger la totalité des sources du site, du paterne de la base donnée et du programme de dialogue avec la station :
              <a href="LIEN A AJOUTER !!!!">
                <div class="button sources">
                  <h3 class="white">Télécharger</h3>
                </div>
              </a>
            </li>
            <li>
              Pour accéder à notre page GitHub c'est ici :
              <a href="https://github.com/Akashita/ISN">
                <div class="button github">
                  <h3 class="white">Site web</h3>
                </div>
              </a>
              <a href="https://github.com/camilcll/ISN">
                <div class="button github">
                  <h3 class="white">Station</h3>
                </div>
              </a>
            </li>
          </ul>
        </p>
      </section>
      <section class="postDoc">
        <div class="topPostDoc">
          <h3 class="white">La station</h3>
        </div>
        <p class="paraf">
          La station utilisé par ce projet est un conception du lycée saint exupéry dont les sources sont disponibles à cette adresse : <a href="http://varrel.fr/station/presentation.php">varrel.fr</a>
        </p>
        <ul>
          <li>
            Vous pourrez trouver sur cette page un explication complète du fonctionnement de la station ainsi les sources (logicielles/matérielles) pour pouvoir construire la votre !
          </li>
        </ul>
      </section>
      <section class="postDoc">
        <div class="topPostDoc">
          <h3 class="white">Nos sources</h3>
        </div>
        <p class="paraf">
          Voici un petit récapitulatif des sources que nous avons utilisé pour la réalisation de ce projet (image, documentation ...etc)
        </p>
        <ul>
          <li>
            Les fonds de pages et d'en-têtes : <a href="https://www.toptal.com/designers/subtlepatterns/">toptal.com</a>
          </li>
          <li>
            La documentation concernant les prévisions météo : <a href="http://leguidemeteo.com/prevoir-le-temps-a-partir-de-son-barometre/">leguidemeteo.com</a>
          </li>
          <li>
            La bilbliotèque JavaScript "ChartJs" : <a href="http://www.chartjs.org/">chartjs.org</a>
          </li>
        </ul>

      </section>
    </article>
    <?php include 'footerDoc.html'; ?>
  </div>

  <script>
  $('.scrollTo').click(function() {
    var getElem = $(this).attr('href');
    var targetDistance = 20;
    if ($(getElem).length) {
      var getOffset = $(getElem).offset().top;
      $('html,body').animate({
        scrollTop: getOffset - targetDistance
      }, 500);
    }
    return false;
  });
  </script>


</body>
</html>
