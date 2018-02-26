var ctx = document.getElementById("first").getContext('2d');

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        datasets: [{
              label: 'Pression',
              data: [14, 6, 7, 6, 5, 13, 5, 6, 7, 6, 5, 13],
              borderWidth: 2,
              lineTension: 0.3,
        }, {
              label: 'Vitesse vent',
              data: [6, 7, 12, 30, 26, 2, 7, 3, 6, 4, 9, 5],
              backgroundColor: [
                'rgba(114,130,117, 0.2)'
              ],
              borderColor: [
                '#1f2d3d'
              ],
              borderWidth: 2,
              lineTension: 0.3,
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
              type:"line"
        }],
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange", "Redg", "Blueg", "Yellowg", "Greeng", "Purpleg", "Orangeg"]

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
