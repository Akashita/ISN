<?php

//sources : leguidemeteo.com/prevoir-le-temps-a-partir-de-son-barometre/


$pres = array('961','961','962','963','963','963','964','964','964','964','964','964','964','964','964','964','965','964','974','974','974','974','974');
$hum = array('30','35','40','45','45','45','50','50','55','55','60','65','65','65','65','70','60','60','70','80','80','85','85');

//Altitude St Exupéry : 429m
$presREL=1013-(429/8.3); //Pression moyenne du lycée par rapport à la pression moyenne du niveau de la mer
$presMoy = array_sum($pres)/count($pres); //On fait la moyenne du tableau

$dir = array('e','no','n','so','s','e','se','o','no','o','so','so','ne');

$n=0;$no=0;$o=0;$so=0;$s=0;$se=0;$e=0;$ne=0;

foreach ($dir as $value) { //Tri des directions du vent
  if ($value == "n") {
    $n+=1;
  } elseif ($value == "no") {
    $no+=1;
  } elseif ($value == "o") {
    $o+=1;
  } elseif ($value == "so") {
    $so+=1;
  } elseif ($value == "s") {
    $s+=1;
  } elseif ($value == "se") {
    $se+=1;
  } elseif ($value == "e") {
    $e+=1;
  } elseif ($value == "ne") {
    $ne+=1;
  }
}

$n=round(($n*100)/count($dir),2); //on trouve le pourcentage pour chaque direction de vent (par exemple : 15% de so ; 25% de n ...etc)
$no=round(($no*100)/count($dir),2);
$o=round(($o*100)/count($dir),2);
$so=round(($so*100)/count($dir),2);
$s=round(($s*100)/count($dir),2);
$se=round(($se*100)/count($dir),2);
$e=round(($e*100)/count($dir),2);
$ne=round(($ne*100)/count($dir),2);

$dirPour = array( //on met toutes ces valeurs dans un tableau
  'n' => $n,
  'no' => $no,
  'o' => $o,
  'so' => $so,
  's' => $s,
  'se' => $se,
  'e' => $e,
  'ne' => $ne,
);

$dirsF = "'".$dirPour['n']."', '".$dirPour['ne']."', '".$dirPour['e']."', '".$dirPour['se']."', '".$dirPour['s']."', '".$dirPour['so']."', '".$dirPour['o']."', '".$dirPour['no']."'";

$maxDir = array_keys($dirPour, max($dirPour)); //On trouve la direction de vent pour laquelle le pourcentage est le plus élevé
$dirMaj = $maxDir[0];


$previ = array();

if (saison() == 'hiver') {
  $previ = hiver($presMoy, $dirMaj);
} elseif (saison() == 'automne') {
  $previ = automne($presMoy, $dirMaj);
} elseif (saison() == 'ete') {
  $previ = ete($presMoy, $dirMaj);
} else {
  $previ = printemps($presMoy, $dirMaj);
}


function saison() { //renvoie la saison actuelle
  $date = date('md');
  if ($date >= '1222') {
    $saison = 'hiver';
  }
  elseif ($date >= '0923') {
    $saison = 'automne';
  }
  elseif ($date >= '0621') {
    $saison = 'ete';
  }
  else {
    $saison = 'printemps';
  }
  return $saison;
}


function ete($presMoy, $dir){
  if ($presMoy>968) {
    $temps = array('chaud','faible','soleil');
  } elseif ($presMoy>961 AND $presMoy<968) {
    $temps = array('chaud','faible','soleil');
  } elseif ($presMoy>954 AND $presMoy<961) {
    if ($dir != "o" OR $dir != "no") {
      $temps = array('chaud','fort','orages');
    } else {
      $temps = array('doux','modere','nuage');
    }
  } elseif ($presMoy<954) {
    if ($dir == "n") {
      $temps = array('doux','fort','pluie');
    } else {
      $temps = array('chaud','faible','orage');
    }
  }
  return $temps;
}

function printemps($presMoy, $dir){
  if ($presMoy>968) {
    $temps = array('chaud','faible','soleil');
  } elseif ($presMoy>961 AND $presMoy<968) {
    if ($dir == "e" OR $dir == "ne" OR $dir == "n") {
      $temps = array('frais','faible','pluie');
    } elseif ($dir == "s" OR $dir == "se") {
      $temps = array('chaud','faible','soleil');
    } elseif ($dir == "so") {
      $temps = array('doux','faible','pluie');
    } elseif ($dir == "o" OR $dir == "no") {
      $temps = array('frais','faible','nuage');
    }
  } elseif ($presMoy>954 AND $presMoy<961) {
    if ($dir == "n") {
      $temps = array('frais','faible','nuage');
    } elseif ($dir == "e" OR $dir == "ne" OR $dir == "s" OR $dir == "se" OR $dir == "so") {
      $temps = array('doux','fort','pluie');
    } elseif ($dir == "o" OR $dir == "no") {
      $temps = array('frais','faible','nuage');
    }
  } elseif ($presMoy<954) {
    if ($dir == "n") {
      $temps = array('froid','fort','neige');
    } elseif ($dir == "e" OR $dir == "ne") {
      $temps = array('froid','faible','pluie');
    } elseif ($dir == "s" OR $dir == "se" OR $dir == "so") {
      $temps = array('doux','fort','pluie');
    } elseif ($dir == "o" OR $dir == "no") {
      $temps = array('frais','faible','pluie');
    }
  }
  return $temps;
}

function automne($presMoy, $dir){
  if ($presMoy>968) {
    $temps = array('chaud','faible','soleil');
  } elseif ($presMoy>961 AND $presMoy<968) {
    if ($dir == "n") {
      $temps = array('frais','faible','nuage');
    } elseif ($dir == "e" OR $dir == "ne") {
      $temps = array('frais','faible','soleil');
    } elseif ($dir == "s" OR $dir == "se") {
      $temps = array('chaud','faible','nuage');
    } elseif ($dir == "so") {
      $temps = array('doux','faible','soleil');
    } elseif ($dir == "o" OR $dir == "no") {
      $temps = array('doux','faible','soleil');
    }
  } elseif ($presMoy>954 AND $presMoy<961) {
    if ($dir == "n") {
      $temps = array('frais','faible','pluie');
    } elseif ($dir == "e" OR $dir == "ne") {
      $temps = array('frais','faible','nuage');
    } elseif ($dir == "s" OR $dir == "se") {
      $temps = array('doux','modere','pluie');
    } elseif ($dir == "so") {
      $temps = array('doux','modere','nuage');
    } elseif ($dir == "o" OR $dir == "no") {
      $temps = array('frais','faible','nuage');
    }
  } elseif ($presMoy<954) {
    if ($dir == "n") {
      $temps = array('froid','faible','neige');
    } elseif ($dir == "e" OR $dir == "ne") {
      $temps = array('frais','odere','orage');
    } elseif ($dir == "s" OR $dir == "se") {
      $temps = array('doux','fort','pluie');
    } elseif ($dir == "so") {
      $temps = array('doux','fort','pluie');
    } elseif ($dir == "o" OR $dir == "no") {
      $temps = array('frais','fort','pluie');
    }
  }
  return $temps;
}

function hiver($presMoy, $dir){
  if ($presMoy>968) {
    $temps = array('frais','faible','soleil');
  } elseif ($presMoy>961 AND $presMoy<968) {
    if ($dir == "n") {
      $temps = array('froid','faible','soleil');
    } elseif ($dir == "e" OR $dir == "ne") {
      $temps = array('froid','faible','nuage');
    } elseif ($dir == "s" OR $dir == "se") {
      $temps = array('doux','faible','nuage');
    } elseif ($dir == "so") {
      $temps = array('frais','faible','nuage');
    } elseif ($dir == "o" OR $dir == "no") {
      $temps = array('froid','faible','nuage');
    }
  } elseif ($presMoy>954 AND $presMoy<961) {
    if ($dir == "n") {
      $temps = array('froid','faible','neige');
    } elseif ($dir == "e" OR $dir == "ne") {
      $temps = array('froid','faible','neige');
    } elseif ($dir == "s" OR $dir == "se") {
      $temps = array('doux','fort','pluie');
    } elseif ($dir == "so") {
      $temps = array('froid','modere','neige');
    } elseif ($dir == "o" OR $dir == "no") {
      $temps = array('froid','faible','neige');
    }
  } elseif ($presMoy<954) {
    if ($dir == "n") {
      $temps = array('froid','fort','neige');
    } elseif ($dir == "e" OR $dir == "ne") {
      $temps = array('froid','fort','neige');
    } elseif ($dir == "s" OR $dir == "se") {
      $temps = array('froid','fort','pluie');
    } elseif ($dir == "so") {
      $temps = array('doux','fort','pluie');
    } elseif ($dir == "o" OR $dir == "no") {
      $temps = array('froid','modere','neige');
    }
  }
  return $temps;
}

?>
