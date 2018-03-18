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
  $orientB = array('e','no','n','so','s','e','se','o','no','o','so','so');
  $vent = array(12,9,4,4,12,8,24,29,11,15,30,25);
  $heure = array('15h00','15h15','15h30','15h45','16h00','16h15','16h30','16h45','17h00','17h15','17h30','17h45');
  $temp = array('1','-3','2','-1','2','-2','-1','1','-4','-5','2','1');
  $tempRes = array();
  $orient = array();
  $ventColor = array();
  $ventString = " ";
  $heureString = " ";
  $tempString = " ";
  $tempResString = " ";
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

  for ($i=0; $i < count($vent); $i++) {
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
  //Application de la formule de la température ressentie : https://fr.wikipedia.org/wiki/Temp%C3%A9rature_ressentie
  for ($i=0; $i < count($vent); $i++) {
    $tempRes[] = round(13.12+(0.6215*$temp[$i])-(11.37*pow($vent[$i],0.16))+(0.3965*$temp[$i]*pow($vent[$i], 0.16)),1);
  }

  for ($i=0; $i < count($vent); $i++) {
    $ventString = "$ventString $vent[$i],";
    $heureString = "$heureString \"$heure[$i]\",";
    $tempString = "$tempString $temp[$i],";
    $tempResString = "$tempResString $tempRes[$i],";
  }
  ?>
  <?php include 'nav.html'; ?>
  <div id="center">
    <?php include 'header.html'; ?>
    <article class="first">
      <div class="linkProjectTitle">
        <h3 class="black">Pour consulter le dossier du projet, veuillez suivre le lien ci-contre :</h3>
      </div>
      <a target="_blank" href="dossier.html" class="linkProject"> <!-- Le target permet d'ouvrir la page dans un nouvel onglet-->
        Dossier
      </a>
    </article>
    <article id="article" class="sec">
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
              <h3 class="black">Vent min : <?php echo $vent[11];?>km/h</h3>
              <h2 class="black"><?php echo $vent[11];?>km/h</h2>
              <h3 class="black">Vent max : <?php echo $vent[11];?>km/h</h3>
            </div>
            <div class="center">
              <h3 class="black">Température instantanée : </h3>
              <h2 class="black"><?php echo $temp[11];?>°</h2>
              <h3 class="black">Température ressentie : </h3>
              <h2 class="black"><?php echo $tempRes[11];?>°</h2>
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
        <section class="post" id="tempRub">
          <div class="topPost">
            <h3 class="white">Au niveau de la température !</h3>
          </div>
          <div class="chartFormat" style="width:80%;">
            <canvas id="temp"></canvas>
          </div>
        </section>
        <!--
        <section class="post">
        Prévision avec la pression ? <a href="http://leguidemeteo.com/prevoir-le-temps-a-partir-de-son-barometre/"> ICI </a>
        <br />
        Baisse d'1 hpa en 1 heure = arrivé de la pluie.
        <br /><br />
        Attention, changer à la fin la valeur de "document.documentElement.scrollTop" pour actualiser la position de changement de couleur du "haut de page"
      </section>
    -->
    
  </article>
  <?php include 'footer.html'; ?>
</div>
<button onclick="topFunction()" id="retourTop" title="Retour en haut de page">Haut de page</button>
<script type="text/javascript">
var hist = document.getElementById("hist").getContext('2d');
var histChart = new Chart(hist, {
  type: 'bar',
  data: {
    datasets: [{
      label: 'Pression',
      yAxisID: 'B',
      data: [1095, 1050, 1040, 1030, 1020, 1010, 1000, 980, 970, 950, 940, 910],
      borderWidth: 2,
      lineTension: 0.3,
      backgroundColor: 'rgba(0,0,0,0.15)',
    }, {
      label: 'Vitesse vent (km/h)',
      yAxisID: 'A',
      data: [<?php echo $ventString?>],
      backgroundColor: [
        'rgba(0,0,0,0)'
      ],
      borderColor: [
        '#344a63'
      ],
      borderWidth: 2,
      lineTension: 0.2,
      pointBorderColor:"rgb(255,255,255)",
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
      label: 'Vitesse vent min (km/h)',
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
      label: 'Vitesse vent max (km/h)',
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
          labelString: 'Vent (km/h)'
        },
        type: 'linear',
        position: 'left',
      },{
        gridLines: {
          display: false,
        },
        scaleLabel: {
          display: true,
          labelString: 'Pression (hPa)'
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
      type:"line",
      radius: 5,
      pointStyle: 'rectRounded',
      borderDash: [10],
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
