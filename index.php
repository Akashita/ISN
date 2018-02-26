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
    $orientB = array('e','o','n','o','s','e','s','o','n','o','s','e');
    $vent = array(12,9,4,4,12,8,24,29,11,15,30,25);
    $heure = array('15h00','15h15','15h30','15h45','16h00','16h15','16h30','16h45','17h00','17h15','17h30','17h45');
    $orient = array();
    $ventColor = array();
    $ventString = " ";
    $heureString = " ";
    $red=0;
    $green=0;
    $blue=0;
    for ($i=0; $i < count($orientB); $i++) {
      if ($orientB[$i] == 'n') {
        $orient[] = '-90deg';
      } elseif ($orientB[$i] == 'e') {
        $orient[] = '-0deg';
      } elseif ($orientB[$i] == 's') {
        $orient[] = '90deg';
      } elseif ($orientB[$i] == 'o') {
        $orient[] = '180deg';
      }
    }

    for ($i=0; $i < count($vent); $i++) {
      if ($vent[$i]<=50) {
        $indiceR = $vent[$i] * 1.48;
        $indiceV = $vent[$i] * 2.94;
        $indiceB = $vent[$i] * 1.26;
        $red = 11 + $indiceR;
        $green = 135 - $indiceV;
        $blue = 147 - $indiceB;
        $ventColor[] = "rgb($red, $green, $blue)";
      } else {
        $ventColor[] = "rgb(100, 0, 100)";
      }
    }

    for ($i=0; $i < count($vent); $i++) {
      $ventString = "$ventString $vent[$i],";
      $heureString = "$heureString \"$heure[$i]\",";
    }
   ?>

  <div id="navFactice">
    <nav>
      <div id="logoNav">
        <div id="flechelogoNav">Choisir votre rubrique</div>
        <div id="rubrique">
          <div class="boxRubrique">
            <a href="#nowRub" class="scrollTo"><div class="flecheRubriqueNav" style="width:125px;">En ce moment</div></a>
          </div>
          <div class="boxRubrique">
            <a href="#histRub" class="scrollTo"><div class="flecheRubriqueNav" style="width:100px;">Historique</div></a>
          </div>
          <div class="boxRubrique">
            <a href="#previRub" class="scrollTo"><div class="flecheRubriqueNav" style="width:125px;">Nos prévisions</div></a>
          </div>
          <div class="boxRubrique">
            <a href="#openhardware" class="scrollTo"><div class="flecheRubriqueNav" style="width:150px;">L'open hardware</div></a>
          </div>
          <div class="boxRubrique">
            <a href="#tms" class="scrollTo"><div class="flecheRubriqueNav" style="width:200px;">Think it, make it, share it</div></a>
          </div>
          <div class="boxRubrique">
            <a href="#motFin" class="scrollTo"><div class="flecheRubriqueNav" style="width:130px;">Le mot de la fin</div></a>
          </div>
        </div>
      </div>
    </nav>
  </div>
  <div id="center">
    <header>
      <div class="headerTitle">
        <img src="logo.png" alr="logo vent" style="width: 20%; margin-right: 50px;"/>
        <h1 class="white">
          Bienvenue sur la station météorologique du lycée sainttrhtyjytty-exupéry.
        </h1>
      </div>
      <div class="clueScroll">
        <h3 class="white">
          Veuillez scroller vers le bas ou alors cliquer sur le flèche ci dessous.
        </h3>
      </div>
      <a class="scrollTo" href="#nowRub"><img src="downArrow.gif" alt="arrow" style="width: 100px; margin-bottom: 50px;"/></a>
    </header>
    <article id="article">
      <section class="post" id="nowRub">
        <div class="topPost">
          <h3 class="white">En ce moment</h3>
        </div>
        <div class="nowContent">
          <div class="nowOrient">
            <svg style="transform:rotate(<?php echo $orient[0]?>);" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" version="1.1" id="svg2" width="150" height="150" viewBox="0 0 733.33 733.33">
              <metadata id="metadata8"/>
              <defs id="defs6"/>
              <path d="M185.67 184.58 586.66 366.95 182.92 550.41 293.33 366.95Z" id="path817" style="fill:<?php echo($ventColor[11]);?>;stroke:#00000d;"/>
            </svg>
          </div>
          <div class="nowVent">
            <h3 class="black">Vent min : <?php echo $vent[11];?>km/h</h3>
            <h2 class="black"><?php echo $vent[11];?>km/h</h2>
            <h3 class="black">Vent max : <?php echo $vent[11];?>km/h</h3>
          </div>
        </div>
      </section>
      <section class="post" id="histRub">
        <div class="topPost">
          <h3 class="white">Historique</h3>
        </div>
        <div class="chartFormat" style="width:80%;">
          <canvas id="hist"></canvas>
          <div class="dirWind">
            <svg style="transform:rotate(<?php echo $orient[0]?>);" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" version="1.1" id="svg2" width="40" height="40" viewBox="0 0 733.33 733.33">
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
        </div>
      </section>
      <section class="post" id="previRub">
        <div class="topPost">
          <h3 class="white">Nos prévision</h3>
        </div>
        <div class="chartFormat" style="width:80%;">
          <canvas id="previ"></canvas>
        </div>
      </section>
      <section class="post">
        Prévision avec la pression ? --> <a href="http://leguidemeteo.com/prevoir-le-temps-a-partir-de-son-barometre/"> ICI </a>
        <br />
        Baisse d'1 hpa en 1 heure = arrivé de la pluie.
        <br /><br />
        Attention, changer à la fin la valeur de "document.documentElement.scrollTop" pour actualiser la position de changement de couleur du "haut de page"
      </section>

    </article>
    <footer>
      <h4 class="white" style="text-align:center;">Copyright © 2017 Swan Launay<br />This work is licensed under the <a href="http://www.gnu.org/licenses/gpl-3.0.html">GNU GPL License (v3)</a></h4>
      <div class="separator"></div>
      <div class="boxFooter">
        <div class="footerTitle">
          <h3 class="white">Vous souhaitez télécharger la base de donnée ?</h3>
        </div>
        <div class="footerContent">
          <form>
            <input type="radio" name="type" value="sql"> <h4 class="white">Version sql</h4><br>
            <input type="radio" name="type" value="txt"> <h4 class="white">Version txt</h4><br>
            <input type="radio" name="type" value="tab"> <h4 class="white">Version tableur</h4>
          </form>
          <form>
            <input type="button" value="Télécharger"/>
          </form>
        </div>
      </div>
    </footer>
  </div>
  <button onclick="topFunction()" id="retourTop" title="Retour en haut de page">Haut de page</button>
  <script type="text/javascript">
  var hist = document.getElementById("hist").getContext('2d');
  var histChart = new Chart(hist, {
      type: 'bar',
      data: {
          datasets: [{
                label: 'Pression',
                data: [14, 6, 7, 6, 5, 13, 5, 6, 7, 6, 5, 13],
                borderWidth: 2,
                lineTension: 0.3,
          }, {
                label: 'Vitesse vent (km/h)',
                data: [<?php echo $ventString?>],
                backgroundColor: [
                  'rgba(0,0,0,0)'
                ],
                borderColor: [
                  '#344a63'
                ],
                borderWidth: 2,
                lineTension: 0.2,
                pointBorderColor: [
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
                type:"line",
                radius: 5,
                pointStyle: 'rectRounded',
                borderDash: [10],
                borderCapStyle: 'round',
                pointHoverBackgroundColor: '#2D3143',
                pointHoverBorderColor: '#2D3143'
          }, {
                label: 'Vitesse vent min (km/h)',
                data: [5,3,0,0,6,2,12,15,6,11,22,15],
                backgroundColor: [
                  'rgba(32,44,99,0.1)'
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
                label: 'Vitesse vent max (km/h)',
                data: [20,15,9,12,20,10,30,35,17,25,40,35],
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
                type:"line",
                fill: '1',
                pointStyle: "dash",
              }],
          labels: [<?php echo $heureString;?>]

      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero:false,
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

var previ = document.getElementById("previ").getContext('2d');

  var previChart = new Chart(previ, {
      type: 'bar',
      data: {
          datasets: [{
                label: 'Pression',
                data: [14, 6, 7, 6, 5, 13, 5, 6, 7, 6, 5, 13],
                borderWidth: 2,
                lineTension: 0.3,
          }, {
                label: 'Vitesse vent (km/h)',
                data: [<?php echo $ventString?>],
                backgroundColor: [
                  'rgba(0,0,0,0)'
                ],
                borderColor: [
                  '#344a63'
                ],
                borderWidth: 2,
                lineTension: 0.2,
                pointBorderColor: [
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
                type:"line",
                radius: 5,
                pointStyle: 'rectRounded',
                borderDash: [10],
                borderCapStyle: 'round',
                pointHoverBackgroundColor: '#2D3143',
                pointHoverBorderColor: '#2D3143'
          }, {
                label: 'Vitesse vent min (km/h)',
                data: [5,3,0,0,6,2,12,15,6,11,22,15],
                backgroundColor: [
                  'rgba(32,44,99,0.1)'
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
                label: 'Vitesse vent max (km/h)',
                data: [20,15,9,12,20,10,30,35,17,25,40,35],
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
                type:"line",
                fill: '1',
                pointStyle: "dash",
              }],
          labels: [<?php echo $heureString;?>]

      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero:false,
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


  window.onscroll = function() {scrollFunction()};

  function scrollFunction() {
    var docStyle = document.getElementById("retourTop").style;
      if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        if (document.body.scrollTop > 1561 || document.documentElement.scrollTop > 1561) {
          docStyle.display = "block";
          docStyle.backgroundColor = "white";
          docStyle.color = "#0e0f0f";
        } else {
          docStyle.display = "block";
          docStyle.backgroundColor = "#0e0f0f";
          docStyle.color = "white";
        }
      } else {
          docStyle.display = "none";
      }
  }

  function topFunction() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
  }
  </script>

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
