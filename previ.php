<?php
//Source : http://leguidemeteo.com/prevoir-le-temps-a-partir-de-son-barometre/
$pres = array('961','961','962','963','963','963','964','964','964','964','964','964','964','964','964','964','965','964','974','974','974','974','974');
//Si non retiré, il s'agit ici d'un tableau qui prend la place de la base de donnée en attendant qu'elle soit fini.

//Altitude St Exupéry : 429m
$presREL=1013-(429/8.3); //Pression moyenne du lycée par rapport à la pression moyenne du niveau de la mer (1013)
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
//On compose un string de sorte à le mettre dans le graphique .histOrient

$maxDir = array_keys($dirPour, max($dirPour)); //On trouve la direction de vent pour laquelle le pourcentage est le plus élevé
$dirMaj = $maxDir[0];

if ($dirMaj == "n") {
  $dirTab = "n";
} elseif ($dirMaj == "ne") {
  $dirTab = "ne-e";
} elseif ($dirMaj == "e") {
  $dirTab = "ne-e";
} elseif ($dirMaj == "se") {
  $dirTab = "s-se";
} elseif ($dirMaj == "s") {
  $dirTab = "s-se";
} elseif ($dirMaj == "so") {
  $dirTab = "so";
} elseif ($dirMaj == "o") {
  $dirTab = "o-no";
} elseif ($dirMaj == "no") {
  $dirTab = "o-no";
}

if ($presMoy>968) {
  $presTab = "1202";
} elseif ($presMoy>961 AND $presMoy<968) {
  $presTab = "961-968";
} elseif ($presMoy>954 AND $presMoy<961) {
  $presTab = "954-961";
} elseif ($presMoy<954) {
  $presTab = "954";
}

$printemps = array( //création d'un tableau qui contient toutes les directions de vent pour la saison
  'n' => array( //création d'un deuxième tableau qui contient le temps qu'il fait en fonction de la pression
    '968' => 'Beau ou assez beau. Journées chaudes, nuits fraîches; gelées matinales.', //(exemple) pour un vent du nord et une pression de 968hPa, il fera "Beau ou assez [...] gelées matinales." pendant les prochaines 24h
    '961-968' => 'Ondées ou giboulées. Températures fraîches',
    '954-961' => 'Ondées ou giboulées. Températures fraîches',
    '954' => 'Pluie ou neige avec vent. Températures basses.'
  ),
  'ne-e' => array(
    '968' => 'Beau ou assez beau. Journées douces ou assez chaudes, nuits fraîches; gelées possibles.',
    '961-968' => 'Giboulées. Journées fraîches, nuits froides; gelées à craindre.',
    '954-961' => 'Ondées ou giboulées avec vent. Temps frais.',
    '954' => 'Ondées, giboulées ou averses orageuses; neige en montagne. Vent faible ou modéré. Températures basses.'
  ),
  's-se' => array(
    '968' => 'Beau ou assez beau. Journées chaudes, nuits fraîches.',
    '961-968' => 'Assez beau ou ondées orageuses. Journées chaudes, nuits un peu fraîches.',
    '954-961' => 'Pluie ou averses avec un peu de vent. Temps doux.',
    '954' => 'Pluie et vent assez fort. Températures douces.'
  ),
  'so' => array(
    '968' => 'Beau ou assez beau.',
    '961-968' => 'Ondées ou averses. Températures douces.',
    '954-961' => 'Pluie et vent assez fort. Temps doux.',
    '954' => 'Pluie et vent assez fort. Températures douces.'
  ),
  'o-no' => array(
    '968' => 'Beau. Assez chaud dans la journée, frais la nuit; gelées possibles au petit matin.',
    '961-968' => 'Nuageux avec ondées possibles; giboulées en montagne. Temps frais.',
    '954-961' => 'Ondées en plaine, giboulées en montagne. Temps frais.',
    '954' => 'Pluie en plaine, neige en montagne. Temps frais.'
  )
);

$ete = array(
  'n' => array(
    '968' => 'Beau ou assez beau. Journées chaudes, nuits fraîches.',
    '961-968' => 'Assez beau, ondées possibles. Assez chaud.',
    '954-961' => 'Ondées ou averses orageuses. Températures douces.',
    '954' => 'Pluie et vent. Températures douces.'
  ),
  'ne-e' => array(
    '968' => 'Beau. Journées chaudes, nuits fraîches.',
    '961-968' => 'Beau ou assez beau avec parfois des averses orageuses. Chaud ou assez chaud le jour, nuits fraîches',
    '954-961' => 'Pluies orageuses. Températures douces.',
    '954' => 'Pluies orageuses avec un peu de vent. Temps lourd et humide.'
  ),
  's-se' => array(
    '968' => 'Beau, mais orages possibles. Très chaud le jour, chaud la nuit.',
    '961-968' => 'Beau, avec possibilité d\'averses orageuses. Assez chaud. ',
    '954-961' => 'Temps lourd et orages avec averses. Chaud.',
    '954' => 'Averses orageuses et vents violents. Chaud et humide.'
  ),
  'so' => array(
    '968' => 'Beau ou très beau. Chaud ou très chaud.',
    '961-968' => 'Beau, ondées orageuses possibles. Assez chaud.',
    '954-961' => 'Temps lourd et orages possibles. Assez chaud.',
    '954' => 'Orages et averses orageuses. Assez chaud.'
  ),
  'o-no' => array(
    '968' => 'Beau. Chaud dans la journée, assez frais la nuit.',
    '961-968' => 'Assez beau, mais ondées possibles en montagne. Températures douces.',
    '954-961' => 'Ondées et averses avec un peu de vent. Températures douces.',
    '954' => 'Pluie à tendance orageuse avec vent. Doux et humide.'
  )
);

$automne = array(
  'n' => array(
    '968' => 'Beau ou assez beau. Chaud le jour. Gelées à craindre la nuit.',
    '961-968' => 'Ondées locales. Températures fraîches',
    '954-961' => 'Averses. Temps frais.',
    '954' => 'Averses de pluie ou de neige. Temps froid et températures en baisses.'
  ),
  'ne-e' => array(
    '968' => 'Beau ou assez beau. Chaleur modérée. Gelées à craindre.',
    '961-968' => 'Assez beau, avec possibilité d\'ondées. Frais le jour et gelées locales.',
    '954-961' => 'Ondées en plaine, giboulées en montagne. Temps frais.',
    '954' => 'Averses orageuses et vent modéré. Temps frais.'
  ),
  's-se' => array(
    '968' => 'Beau ou assez beau. Assez chaud le jour, frais la nuit; gelées possibles.',
    '961-968' => 'Nuages modérés; ondées et éclaircies. Assez chaud.',
    '954-961' => 'Nuageux, avec pluies éparses et vent modéré. Temps doux.',
    '954' => 'Pluie et parfois averses orageuses avec vents forts. Températures douces.'
  ),
  'so' => array(
    '968' => 'Beau. Chaud ou assez chaud le jour, nuits fraîches.',
    '961-968' => 'Ondées locales et vents faibles. Températures douces.',
    '954-961' => 'Pluie possible, vent modéré. Températures douces.',
    '954' => 'Pluie et vent fort. Temps doux et humide.'
  ),
  'o-no' => array(
    '968' => 'Beau ou modérément nuageux. Chaleur modérée le jour, nuits fraîches; gelées à craindre.',
    '961-968' => 'Assez beau, avec ondées locales et giboulées en montagne. Températures douces, parfois un peu fraîches.',
    '954-961' => 'Ondées en plaine, giboulées en montagne; vent faible. Temps frais.',
    '954' => 'Fortes pluies et vent fort, bourrasques de neige en montagne. Temps frais.'
  )
);

$hiver = array(
  'n' => array(
    '968' => 'Beau, avec tendance à la brume et au brouillard. Températures fraîches.',
    '961-968' => 'Assez beau. Giboulées en montagne. Froid.',
    '954-961' => 'Neige ou giboulées. Froid.',
    '954' => 'Neige et vent parfois violent. Froid.'
  ),
  'ne-e' => array(
    '968' => 'Beau ou assez beau, un peu brumeux. Journées froides et gelées nocturnes.',
    '961-968' => 'Temps brumeux; giboulées ou neige. Froid.',
    '954-961' => 'Neige ou giboulées. Froid.',
    '954' => 'Giboulées, neige possible; vent modéré à assez fort. Froid.'
  ),
  's-se' => array(
    '968' => 'Beau ou assez beau, parfois brumeux. Températures modérées le jour, nuits froides; gelées possibles.',
    '961-968' => 'Assez beau à modérément nuageux, avec ondées possibles. Températures douces.',
    '954-961' => 'Pluie possible, avec vent fort. Températures douces.',
    '954' => 'Pluie ou neige fondue, avec vents forts. Temps assez froid, parfois doux. '
  ),
  'so' => array(
    '968' => 'Beau ou assez beau, brumes. Températures douces ou assez douces le jour; gelées nocturnes.',
    '961-968' => 'Quelques nuages, ondées. Températures fraîches.',
    '954-961' => 'Pluie ou neige avec vent. Températures douces.',
    '954' => 'Pluie ou neige fondue, avec vent violent. Températures douces.'
  ),
  'o-no' => array(
    '968' => 'Beau et un peu brumeux. Températures modérées le jour; fortes gelées la nuit.',
    '961-968' => 'Modérément nuageux, giboulées en montagne. Froid.',
    '954-961' => 'Giboulées ou neige. Froid.',
    '954' => 'Pluie et bourrasques, ou neige. Froid.'
  )
);

$date = date('md');//création d'un variable composée de la date actuelle sous le format 'md' (mois jour sans espaces)

if ($date >= '1222') { //le 22 décembre (12/22 ou 1222) on passe en hiver
  $temps = $hiver[$dirTab][$presTab];
}
elseif ($date >= '0923') {//... automne
  $temps = $automne[$dirTab][$presTab];
}
elseif ($date >= '0621') {//..
  $temps = $ete[$dirTab][$presTab];
}
else {
  $temps = $printemps[$dirTab][$presTab]; //on va chercher le temps qu'il fait dans le tableau ci-dessus avec notre direction et notre valeur de pression
}








?>
