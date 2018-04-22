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
  <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
  <script src="jquery-min.js"></script>
  <meta charset="UTF-8">
</head>
<body>


  <?php
  /*
  try{
  $bdd = new PDO('mysql:host=localhost;dbname=station;charset=utf8', 'root', '');
}
catch (Exception $e)
{
die('Erreur : ' . $e->getMessage());
}
$reponse = $bdd->query('SELECT * FROM météo');
while ($donnees = $reponse->fetch())
{
echo $donnees['temp'];
echo $donnees['pression'];
echo $donnees['direction'];
}
$reponse->closeCursor();
*/


// A CHErCHER DANS LA BDD
$orientB = array('e','no','n','so','s','e','se','o','no','o','so','so');
$vent = array(12,9,4,4,12,8,24,29,11,15,30,25);
$heure = array('15h00','15h15','15h30','15h45','16h00','16h15','16h30','16h45','17h00','17h15','17h30','17h45');
$temp = array('1','-3','2','-1','2','-2','-1','1','-4','5','2','1');
// ---------------------------------------






//------ Traduction de l'orientation du vent (caractères --> degrés) ------
$orient = array(); //L'orientation du vent en degrée
for ($i=0; $i < count($orientB); $i++) {
  if ($orientB[$i] == 'n') {
    $orient[] = '-90deg';
  } elseif ($orientB[$i] == 'e') {
    $orient[] = '-0deg';
  } elseif ($orientB[$i] == 's') {
    $orient[] = '90deg';
  } elseif ($orientB[$i] == 'o') {
    $orient[] = '180deg';
  } elseif ($orientB[$i] == 'ne') {
    $orient[] = '-45deg';
  } elseif ($orientB[$i] == 'no') {
    $orient[] = '-135deg';
  } elseif ($orientB[$i] == 'se') {
    $orient[] = '45deg';
  } elseif ($orientB[$i] == 'so') {
    $orient[] = '135deg';
  }
}
//------ Détermination des couleurs des flèches directionelles en fonction du vent ------
$ventColor = array();//Couleur du vent (en fonction de la force du vent)
$red=0;//Proportion en rouge
$green=0;//Proportion en vert
$blue=0;//Proportion en bleu
for ($i=0; $i < count($vent); $i++) { //Dégradé de couleur en fonction de la vitesse du vent
  if ($vent[$i]<=50) {
    $indiceR = $vent[$i] * 1.08;
    $indiceV = $vent[$i] * 1.74;
    $indiceB = $vent[$i] * 2.04;
    $red = 82 + $indiceR;
    $green = 125 - $indiceV;
    $blue = 165 - $indiceB;
    $ventColor[] = "rgb($red, $green, $blue)";
  } else {
    $ventColor[] = "rgb(100, 0, 100)";
  }
}

//------ Application de la formule de la température ressentie : https://fr.wikipedia.org/wiki/Temp%C3%A9rature_ressentie -------
$tempRes = array();//Température ressentie
for ($i=0; $i < count($vent); $i++) {
  $tempRes[] = round(13.12+(0.6215*$temp[$i])-(11.37*pow($vent[$i],0.16))+(0.3965*$temp[$i]*pow($vent[$i], 0.16)),1);
}

//------ Assemblage des chaines de caractères des destinées aux graphiques ------
$ventString = " ";//vitesses de vent pour les graphiques
$heureString = " ";//heures pour les graphiques
$tempString = " ";//température pour les graphiques
$tempResString = " ";//température ressentie pour les graphiques
for ($i=0; $i < count($vent); $i++) {
  $ventString = "$ventString $vent[$i],";
  $heureString = "$heureString \"$heure[$i]\",";
  $tempString = "$tempString $temp[$i],";
  $tempResString = "$tempResString $tempRes[$i],";
}
//------ Ajout du programme de prévision du temps sur 24H00 (previ.php) ------
include 'previ.php'; //

?>
<?php include 'nav.html'; //Ajout de la barre de navigation?>
<div id="center">
  <?php include 'header.html'; //Ajout de l'en-tête du site?>
  <article class="first">
    <div class="linkProjectTitle">
      <h3 class="black">Pour télécharger le dossier du projet, veuillez suivre le lien ci-contre :</h3>
    </div>
    <a target="_blank" href="dossier.html" class="linkProject"> <!-- Le target permet d'ouvrir la page dans un nouvel onglet-->
      Dossier
    </a>
  </article>
  <article id="article" class="sec">
    <!--==========================-->
    <!-- Rubrique : En ce moment  -->
    <!--==========================-->
    <section class="post" id="nowRub">
      <div class="topPost">
        <h3 class="white">En ce moment</h3>
      </div>
      <div class="nowContent">
        <div class="nowOrient">
          <svg style="transform:rotate(<?php echo $orient[11]?>);" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" version="1.1" id="svg2" width="150" height="150" viewBox="0 0 733.33 733.33">
            <metadata id="metadata8"/>
            <defs id="defs6"/>
            <path d="M185.67 184.58 586.66 366.95 182.92 550.41 293.33 366.95Z" id="path817" style="fill:<?php echo($ventColor[11]);?>;stroke:#00000d;"/>
            </svg>
          </div>
          <div class="center">
            <h3 class="black margin">Vent min : <?php echo $vent[11];?>km/h</h3>
            <h2 class="black"><strong><?php echo $vent[11];?>km/h</strong></h2>
            <h3 class="black margin">Vent max : <?php echo $vent[11];?>km/h</h3>
          </div>
          <div class="center">
            <h3 class="black margin">Température instantanée : </h3>
            <h2 class="black"><strong><?php echo $temp[11];?>°</strong></h2>
            <h3 class="black margin">Température ressentie : </h3>
            <h2 class="black"><strong><?php echo $tempRes[11];?>°</strong></h2>
          </div>
        </div>
      </section>
      <!--==========================-->
      <!-- Rubrique : Historique    -->
      <!--==========================-->
        <section class="post" id="histRub">
          <div class="topPost">
            <h3 class="white">Historique</h3>
          </div>
          <div class="chartFormat" style="width:80%;">
            <canvas id="hist"></canvas>
            <div class="dirWind">
              <!-- La balise <svg></svg> permet de créer un objet vectoriel (ici les flèches directionelles), et surtout de l'éditer en html/php-->
              <svg style="transform:rotate(<?php echo $orient[0]// C'est ici qu'on génère l'orientation de la flèche tel qu'elle est orientée dans la base de donnée ?>);" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" version="1.1" id="svg2" width="40" height="40" viewBox="0 0 733.33 733.33">
                <metadata id="metadata8"/>
                <defs id="defs6"/>
                <path d="M185.67 184.58 586.66 366.95 182.92 550.41 293.33 366.95Z" id="path817" style="fill:<?php echo($ventColor[0]);?>;stroke:#00000d;"/>
              </svg>
              <svg style="transform:rotate(<?php echo $orient[1]?>);" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" version="1.1" id="svg2" width="40" height="40" viewBox="0 0 733.33 733.33">
                <metadata id="metadata8"/>
                <defs id="defs6"/>
                <path d="M185.67 184.58 586.66 366.95 182.92 550.41 293.33 366.95Z" id="path817" style="fill:<?php echo($ventColor[1]);?>;stroke:#00000d;"/>
              </svg>
              <svg style="transform:rotate(<?php echo $orient[2]?>);" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" version="1.1" id="svg2" width="40" height="40" viewBox="0 0 733.33 733.33">
                <metadata id="metadata8"/>
                <defs id="defs6"/>
                <path d="M185.67 184.58 586.66 366.95 182.92 550.41 293.33 366.95Z" id="path817" style="fill:<?php echo($ventColor[2]);?>;stroke:#00000d;"/>
              </svg>
              <svg style="transform:rotate(<?php echo $orient[3]?>);" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" version="1.1" id="svg2" width="40" height="40" viewBox="0 0 733.33 733.33">
                <metadata id="metadata8"/>
                <defs id="defs6"/>
                <path d="M185.67 184.58 586.66 366.95 182.92 550.41 293.33 366.95Z" id="path817" style="fill:<?php echo($ventColor[3]);?>;stroke:#00000d;"/>
              </svg>
              <svg style="transform:rotate(<?php echo $orient[4]?>);" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" version="1.1" id="svg2" width="40" height="40" viewBox="0 0 733.33 733.33">
                <metadata id="metadata8"/>
                <defs id="defs6"/>
                <path d="M185.67 184.58 586.66 366.95 182.92 550.41 293.33 366.95Z" id="path817" style="fill:<?php echo($ventColor[4]);?>;stroke:#00000d;"/>
              </svg>
              <svg style="transform:rotate(<?php echo $orient[5]?>);" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" version="1.1" id="svg2" width="40" height="40" viewBox="0 0 733.33 733.33">
                <metadata id="metadata8"/>
                <defs id="defs6"/>
                <path d="M185.67 184.58 586.66 366.95 182.92 550.41 293.33 366.95Z" id="path817" style="fill:<?php echo($ventColor[5]);?>;stroke:#00000d;"/>
              </svg>
              <svg style="transform:rotate(<?php echo $orient[6]?>);" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" version="1.1" id="svg2" width="40" height="40" viewBox="0 0 733.33 733.33">
                <metadata id="metadata8"/>
                <defs id="defs6"/>
                <path d="M185.67 184.58 586.66 366.95 182.92 550.41 293.33 366.95Z" id="path817" style="fill:<?php echo($ventColor[6]);?>;stroke:#00000d;"/>
              </svg>
              <svg style="transform:rotate(<?php echo $orient[7]?>);" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" version="1.1" id="svg2" width="40" height="40" viewBox="0 0 733.33 733.33">
                <metadata id="metadata8"/>
                <defs id="defs6"/>
                <path d="M185.67 184.58 586.66 366.95 182.92 550.41 293.33 366.95Z" id="path817" style="fill:<?php echo($ventColor[7]);?>;stroke:#00000d;"/>
              </svg>
              <svg style="transform:rotate(<?php echo $orient[8]?>);" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" version="1.1" id="svg2" width="40" height="40" viewBox="0 0 733.33 733.33">
                <metadata id="metadata8"/>
                <defs id="defs6"/>
                <path d="M185.67 184.58 586.66 366.95 182.92 550.41 293.33 366.95Z" id="path817" style="fill:<?php echo($ventColor[8]);?>;stroke:#00000d;"/>
              </svg>
              <svg style="transform:rotate(<?php echo $orient[9]?>);" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" version="1.1" id="svg2" width="40" height="40" viewBox="0 0 733.33 733.33">
                <metadata id="metadata8"/>
                <defs id="defs6"/>
                <path d="M185.67 184.58 586.66 366.95 182.92 550.41 293.33 366.95Z" id="path817" style="fill:<?php echo($ventColor[9]);?>;stroke:#00000d;"/>
              </svg>
              <svg style="transform:rotate(<?php echo $orient[10]?>);" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" version="1.1" id="svg2" width="40" height="40" viewBox="0 0 733.33 733.33">
                <metadata id="metadata8"/>
                <defs id="defs6"/>
                <path d="M185.67 184.58 586.66 366.95 182.92 550.41 293.33 366.95Z" id="path817" style="fill:<?php echo($ventColor[10]);?>;stroke:#00000d;"/>
              </svg>
              <svg style="transform:rotate(<?php echo $orient[11]?>);" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" version="1.1" id="svg2" width="40" height="40" viewBox="0 0 733.33 733.33">
                <metadata id="metadata8"/>
                <defs id="defs6"/>
                <path d="M185.67 184.58 586.66 366.95 182.92 550.41 293.33 366.95Z" id="path817" style="fill:<?php echo($ventColor[11]);?>;stroke:#00000d;"/>
              </svg>
            </div>
            <div class="infoHisto">
              <div style="width: 50%; min-width: 250px; margin-top: 20px;">
                <canvas id="histOrient"></canvas>
              </div>
              <div class="infoTxt">
                <h3 class="black">Concernant les graphiques :</h3>
                <ul>
                  <li>
                    La courbe :
                    <ul>
                      <li>
                        Le graphique ci-dessus représente la vitesse du vent en fonction de l'heure, ainsi que l'évolution de la pression (en arrière-plan).
                      </li>
                      <li>
                          Concernant la courbe, la zone en pointillés représente la vitesse moyenne du vent alors que les deux zones au-dessus et en-dessous représentent les valeurs maximales et minimales.
                      </li>
                      <li>
                        La couleur du point sur la courbe en pointillé indique la force du vent, plus la couleur tend vers le violet, plus le vent est fort.
                      </li>
                    </ul>
                  </li>
                  <li>
                    Les flèches :
                    <ul>
                      <li>
                        Les flèches en dessous de la courbe représentent la direction du vent en fonction de l'heure.
                      </li>
                      <li>
                        Tout comme les points sur le graphique elles sont colorées en fonction de la force du vent.
                      </li>
                    </ul>
                  </li>
                  <li>
                    Le donut :
                    <ul>
                      <li>
                        Le donut quant à lui représente non pas la force du vent, mais les différentes directions du vent sur une période de [insérer T] (en pourcentage).
                      </li>
                      <li>
                        Vous pouvez passer votre souris dessus pour connaitre la valeur exacte du pourcentage.
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </section>
        <!--==========================-->
        <!-- Rubrique : Température   -->
        <!--==========================-->
        <section class="post" id="tempRub">
          <div class="topPost">
            <h3 class="white">Au niveau de la température !</h3>
          </div>
          <div class="chartFormat" style="width:80%;">
            <canvas id="temp"></canvas>
          </div>
        </section>
        <!--===========================-->
        <!-- Rubrique : Nos prévisions -->
        <!--===========================-->
        <section class="post" id="previRub">
          <div class="topPost">
            <h3 class="white">Nos prévision sur 24h00</h3>
          </div>
          <div>
            <h3>
              <br />
              <?php
                echo $temps;
              ?>
            </h3>
          </div>
          <div>
            <h2 class="black">
              Explication sur la méthode utilisée ???
            </h2>
          </div>
        </section>
        <!--==========================-->
        <!-- Rubrique : Archives  -->
        <!--==========================-->
        <section class="post" id="archivesRub">
          <div class="topPost">
            <h3 class="white">Vous voulez télécharger nos archives ?</h3>
          </div>
          <form action="archives.php" method="post" class="archivesContent">
            <div class="archivesIn">
              <div class="doted">
                <h3 class="black margin">Quel informations voulez vous exploiter ?</h3>
                <input type="checkbox" name="vVent" value="true" checked> <h4>Vitesse vent</h4><br>
                <input type="checkbox" name="dVent" value="true" checked> <h4>Direction vent</h4><br>
                <input type="checkbox" name="pres" value="true" checked> <h4>Pression</h4><br>
                <input type="checkbox" name="temp" value="true" checked> <h4>Température</h4><br>
                <input type="checkbox" name="hum" value="true" checked> <h4>Humdité</h4><br>
                <input type="checkbox" name="date" value="true" checked> <h4>Date</h4><br>
              </div>
            </div>
            <div class="archivesIn">
              <div class="doted">
                <h3 class="black margin">Sur quel plage de temps ?</h3>
                <h4 class="black">Date de début</h4>
                <input id="date" type="date" name="start"><br />
                <h4 class="black">Date de fin</h4>
                <input id="date" type="date" name="stop">
              </div>
            </div>
            <div class="archivesIn">
              <input type="submit" class="black" value="Télécharger"/>
            </div>
          </form>
        </section>


      </article>
      <?php include 'footer.html'; ?>
    </div>
    <button onclick="topFunction()" id="retourTop" title="Retour en haut de page">Haut de page</button>
    <script type="text/javascript">

//=============================================================
//---------Début de la génération des graphiques---------------
//=============================================================
    var hist = document.getElementById("hist").getContext('2d'); //On va chercher le canvas en précisant qu'il sera utilisé en 2D
    var histChart = new Chart(hist, { //Création d'un instance de la classe Chart
      type: 'bar',//Définition du type de graphique (on défini d'abord le type bar, puis le type line)
      data: {
        datasets: [{
          label: 'Pression ',//Nom de cet ensemble de valeurs
          yAxisID: 'B',//On place les valeurs en ordonnée sur l'axe de droite
          data: [1095, 1050, 1040, 1030, 1020, 1010, 1000, 980, 970, 950, 940, 910], //On génère les valeurs via php
          borderWidth: 2,
          lineTension: 0.3,
          backgroundColor: 'rgba(0,0,0,0.15)',
        }, {
          label: 'Vitesse vent (km/h) ', //Deuxième groupe de valeurs
          yAxisID: 'A',//Axe de gauche
          data: [<?php echo $ventString?>],//Idem
          backgroundColor: [
            'rgba(0,0,0,0)'
          ],
          borderColor: [
            '#344a63'
          ],
          borderWidth: 2,
          lineTension: 0.2,
          pointBorderColor:"rgb(255,255,255)",
          pointBackgroundColor: [ //Génération des couleurs des points (dégradé bleu-violet en fonction de la force du vent)
            '<?php echo $ventColor[0];?>',
            '<?php echo $ventColor[1];?>',
            '<?php echo $ventColor[2];?>',
            '<?php echo $ventColor[3];?>',
            '<?php echo $ventColor[4];?>',
            '<?php echo $ventColor[5];?>',
            '<?php echo $ventColor[6];?>',
            '<?php echo $ventColor[7];?>',
            '<?php echo $ventColor[8];?>',
            '<?php echo $ventColor[9];?>',
            '<?php echo $ventColor[10];?>',
            '<?php echo $ventColor[11];?>'
          ],
          type:"line",
          radius: 5,
          pointStyle: 'rectRounded',
          borderDash: [5],
          borderCapStyle: 'round',
          pointHoverBackgroundColor: [
            '<?php echo $ventColor[0];?>',
            '<?php echo $ventColor[1];?>',
            '<?php echo $ventColor[2];?>',
            '<?php echo $ventColor[3];?>',
            '<?php echo $ventColor[4];?>',
            '<?php echo $ventColor[5];?>',
            '<?php echo $ventColor[6];?>',
            '<?php echo $ventColor[7];?>',
            '<?php echo $ventColor[8];?>',
            '<?php echo $ventColor[9];?>',
            '<?php echo $ventColor[10];?>',
            '<?php echo $ventColor[11];?>'
          ],
          pointHoverBorderColor: '#2D3143',
          pointRadius: 10,
          pointHoverRadius: 12,
        }, {
          label: 'Vitesse vent min (km/h) ',
          data: [5,3,0,0,6,2,12,15,6,11,22,15],
          backgroundColor: [
            'rgba(32,44,99,0.2)'
          ],
          borderColor: [
            '#344a63'
          ],
          borderWidth: 0.1,
          lineTension: 0.2,
          pointBorderColor: [

          ],
          pointBackgroundColor: [

          ],
          type:"line",
          fill: '-1',
          pointStyle: "dash"
        }, {
          label: 'Vitesse vent max (km/h) ',
          data: [20,15,9,12,20,10,30,35,17,25,40,35],
          backgroundColor: [
            'rgba(32,44,99,0.3)'
          ],
          borderColor: [
            '#344a63'
          ],
          borderWidth: 0.1,
          lineTension: 0.2,
          pointBorderColor: [
          ],
          type:"line",
          fill: '1',
          pointStyle: "dash",
        }],
        labels: [<?php echo $heureString;?>]

      },
      options: {
        tooltips: {
          backgroundColor: 'rgba(50,50,50,0.8)',
          position: 'average',
        },
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero:false,
            },
            id: 'A',
            scaleLabel: {
              display: true,
              labelString: 'Vent (km/h) '
            },
            type: 'linear',
            position: 'left',
          },{
            gridLines: {
              display: false,
            },
            scaleLabel: {
              display: true,
              labelString: 'Pression (hPa) '
            },
            id: 'B',
            type: 'linear',
            position: 'right',
            ticks: {
              max: 1100,
              min: 900,
            }
          }],
          xAxes: [{
            gridLines: {
              offsetGridLines: true,
            }
          }]
        },
        layout: {
          padding: {
            left: 0,
            right: 0,
            top: 0,
            bottom: 0
          }
        },
      }
    });

    var histOrient = document.getElementById('histOrient').getContext('2d');
    var orientChart = new Chart(histOrient, {
      type: 'doughnut',
      data: {
        labels: ['Nord ', 'Nord-Est ', 'Est ', 'Sud-Est ', 'Sud ', 'Sud-Ouest ', 'Ouest ', 'Nord-Ouest '],
        datasets: [
          {
            backgroundColor: ['#5F2C82','#5B4087','#57558C', '#546990','#517393','#4E8597','#4D8D99','#4B989B'],
            data: [<?php echo $dirsF;?>], //Variable dans previ.phpS
          }
        ]
      },
      options: {
        legend:{
          display: true,
          position: 'left'
        },
      }
    });

    var temp = document.getElementById("temp").getContext('2d');
    var tempChart = new Chart(temp, {
      type: 'line',
      data: {
        datasets: [{
          label: 'Température instantanée (°)',
          data: [<?php echo $tempString?>],
          borderWidth: 2,
          lineTension: 0.3,
          fill: '1',
          backgroundColor: [
            'rgba(32,44,99,0.1)'
          ],
          borderColor: [
            '#344a63'
          ],
          borderWidth: 2,
          lineTension: 0.2,
          pointBorderColor: 'rgb(255,255,255)',
          pointBackgroundColor: [
            '<?php echo $ventColor[0];?>',
            '<?php echo $ventColor[1];?>',
            '<?php echo $ventColor[2];?>',
            '<?php echo $ventColor[3];?>',
            '<?php echo $ventColor[4];?>',
            '<?php echo $ventColor[5];?>',
            '<?php echo $ventColor[6];?>',
            '<?php echo $ventColor[7];?>',
            '<?php echo $ventColor[8];?>',
            '<?php echo $ventColor[9];?>',
            '<?php echo $ventColor[10];?>',
            '<?php echo $ventColor[11];?>'
          ],
          radius: 5,
          pointStyle: 'rectRounded',
          borderCapStyle: 'round',
          pointHoverBackgroundColor: [
            '<?php echo $ventColor[0];?>',
            '<?php echo $ventColor[1];?>',
            '<?php echo $ventColor[2];?>',
            '<?php echo $ventColor[3];?>',
            '<?php echo $ventColor[4];?>',
            '<?php echo $ventColor[5];?>',
            '<?php echo $ventColor[6];?>',
            '<?php echo $ventColor[7];?>',
            '<?php echo $ventColor[8];?>',
            '<?php echo $ventColor[9];?>',
            '<?php echo $ventColor[10];?>',
            '<?php echo $ventColor[11];?>'
          ],
          pointHoverBorderColor: '#2D3143',
          pointStyle: 'rectRounded',
          pointRadius: 10,
          pointHoverRadius: 12,
        }, {
          label: 'Température ressentie (°)',
          data: [<?php echo $tempResString?>],
          fill: 'no-fill',
          borderColor: [
            '#344a63'
          ],
          borderWidth: 2,
          lineTension: 0.2,
          pointBorderColor: 'rgb(255,255,255)',
          pointBackgroundColor: [
            '<?php echo $ventColor[0];?>',
            '<?php echo $ventColor[1];?>',
            '<?php echo $ventColor[2];?>',
            '<?php echo $ventColor[3];?>',
            '<?php echo $ventColor[4];?>',
            '<?php echo $ventColor[5];?>',
            '<?php echo $ventColor[6];?>',
            '<?php echo $ventColor[7];?>',
            '<?php echo $ventColor[8];?>',
            '<?php echo $ventColor[9];?>',
            '<?php echo $ventColor[10];?>',
            '<?php echo $ventColor[11];?>'
          ],
          radius: 5,
          pointStyle: 'rectRounded',
          borderCapStyle: 'round',
          pointHoverBackgroundColor: [
            '<?php echo $ventColor[0];?>',
            '<?php echo $ventColor[1];?>',
            '<?php echo $ventColor[2];?>',
            '<?php echo $ventColor[3];?>',
            '<?php echo $ventColor[4];?>',
            '<?php echo $ventColor[5];?>',
            '<?php echo $ventColor[6];?>',
            '<?php echo $ventColor[7];?>',
            '<?php echo $ventColor[8];?>',
            '<?php echo $ventColor[9];?>',
            '<?php echo $ventColor[10];?>',
            '<?php echo $ventColor[11];?>'
          ],
          pointHoverBorderColor: '#2D3143',
          borderDash: [5],
          pointStyle: 'rectRounded',
          pointRadius: 10,
          pointHoverRadius: 12,
        }],
        labels: [<?php echo $heureString;?>]

      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero:false,
            }
          }]
        },
        layout: {
          padding: {
            left: 0,
            right: 0,
            top: 0,
            bottom: 0
          }
        },
      }
    });

    //=============================================================
    //---------Fin de la génération des graphiques---------------
    //=============================================================


//------ Gestion du bouton "haut de page" ------
    window.onscroll = function(){ //On fait en sorte que quand l'utilisateur scroll sur la page la fonction ScrollFunction() soit executée.
      scrollFunction()
    };

    function scrollFunction() {//Cette fonction permet de faire disparaitre le bouton "haut de page" lorsqu'on est en haut de page.
      var docStyle = document.getElementById("retourTop").style; //On va chercher le bouton de part son ID
      if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) { //Si on est en haut de page
        if (document.body.scrollTop > 1561 || document.documentElement.scrollTop > 1561) {//Si on est en bas de page
          docStyle.display = "block";//On fait apparaitre le bouton
          docStyle.backgroundColor = "white";//de couleur blanche
          docStyle.color = "#0e0f0f";//avec une écriture noire
        } else {
          docStyle.display = "block";//idem
          docStyle.backgroundColor = "#0e0f0f";//de couleur noir
          docStyle.color = "white";//avec une écriture blanche
        }
      } else {
        docStyle.display = "none";//On fait disparaitre le bouton
      }
    }

//------ Retour en haut de page lors du clique sur le bouton "haut de page" ------
    function topFunction() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
    }

//------ Animation pour la navigation sur le page ------
    $('.scrollTo').click(function() { //On utilise jQuery (une bibliotèque de fonctions javascript) de sorte à pouvoir utiliser le .animate (qui n'est pas disponible avace javascript)
      var getElem = $(this).attr('href'); //On séléctionne la valeur de l'attribut Href (donc l'ID de la rubrique voulu)
      var targetDistance = 30; //Distance de marge par rapport à l'élément
      if ($(getElem).length) { //On regarde si l'élément est bien là
        var getOffset = $(getElem).offset().top;
        $('html,body').animate({
          scrollTop: getOffset - targetDistance //On scrool jusqu'a la position voulu avec l'animation
        }, 500);
      }
      return false;
    });
  </script>

</body>
</html>
