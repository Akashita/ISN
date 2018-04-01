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
  <?php include 'nav.html'; ?>
  <div id="center">
    <?php include 'headerDoc.html'; ?>
    <article class="doc" id="bonjour">
      <section class="postDoc">
        <div class="topPostDoc">
          <h3 class="white">Récupération des archives</h3>
        </div>
        <p class="paraf">
          Nous mettons à disposition nos archives météorologiques. Ces archives dont gratuites mais sont soumisent à la licence [insérer le nom de la licence].
          Vous avez deux possibilités pour télécharger ces archives :
        </p>
        <ul>
          <li>
            <h2>Par formulaire (recommandé) :</h2>
            <br />
            <ul>
              <li>
                <h3>Sur la <a href="index.php#archivesRub">page d'accueil</a> est disponible un formulaire vous permettant de soit :</h3>
                <ul>
                  <li>
                    Télecharger les archives au format .csv (fichier texte facilement exploitable avec un tableur)
                  </li>
                  <li>
                    Télécharger les archives au format .txt, fichier texte qui suit la disposition suivante :<br />
                    + [img/explication]
                  </li>
                </ul>
              </li>
              <br />
              <li>
                <h3>Remarque :</h3> sur certains navigateurs le choix de la date doit se faire manuellement suivant les formats suivants :
                <ul>
                  <li>
                    jj/mm/yyyy
                  </li>
                  <li>
                    jj-mm-yyyy
                  </li>
                  <li>
                    jj;mm;yyyy
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
                <h3>Il s'agit ici d'un utilisation plutôt orientée développeurs qui passe par la composition d'une URL.</h3>
              </li>
              <br />
              <li>
                <h3>La composition suit le schéma suivant :</h3> http://lenomdusite/archives.php?start={dateDeDépart}&stop={dateDeFin}&format={csv/txt}<br />
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
                          http://lenomdusite/archives.php?start=12-09-2016&stop=15-09-2016&format=csv
                        </td>
                        <td>
                          Un fichier en .csv qui contient toutes nos données du 12 septembre 2016 jusqu'au 15 septembre 2016.
                        </td>
                      </tr>
                      <tr>
                        <td>
                          http://lenomdusite/archives.php?start=30-12-2017&stop=12-02-2018&format=txt
                        </td>
                        <td>
                          Un fichier en .txt qui contient toutes nos données du 30 decembre 2017 jusqu'au 12 févriver 2018.
                        </td>
                      </tr>
                    </table>
                  </li>
                  <br />
                  <li>
                    Ainsi que les formats de date compatibles :
                    <table>
                      <tr>
                        <th>
                          {start}
                        </th>
                        <td>
                          dernier-mois
                        </td>
                        <td>
                          derniere-semaine
                        </td>
                        <td>
                          dernier-jour
                        </td>
                        <td>
                          jj/mm/yyyy
                        </td>
                      </tr>
                      <tr>
                        <th>
                          {stop}
                        </th>
                        <td>
                          now
                        </td>
                        <td>
                          jj/mm/yyyy
                        </td>
                      </tr>
                      <tr>
                        <th>
                          {format}
                        </th>
                        <td>
                          csv
                        </td>
                        <td>
                          txt
                        </td>
                      </tr>
                    </table>
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
          Ce projet est un projet libre qui suit la licence [GPL ??], il vous est donc possible de télécharger et de modifier le code source de ce dernier.
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
                  <h3 class="white">GitHub</h3>
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
          La station utilisé par ce projet est un conception du lycée saint exupéry dont les sources sont disponibles à cette adresse : http://varrel.fr/station/presentation.php
        </p>

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
