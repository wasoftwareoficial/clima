<?php
header('Content-Type:text/plain');

/*----------------------/
\     CONFIGURAÇÕES     \
/----------------------*/

$api_key = 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX';
$cache_time = 2; // EM HORAS

/*----------------------/
\     CÓDIGO-FONTE      \
/----------------------*/

$cachefile = 'cache.json';
$cache_time = $cache_time * 3600;
if (file_exists($cachefile) && time() - $cache_time < filemtime($cachefile)) { } else {
  $api = file_get_contents('https://api.apixu.com/v1/forecast.json?key='.$api_key.'&q=Pedro%20Leopoldo&days=7');
  file_put_contents($cachefile, $api);
}
$jsondata = file_get_contents($cachefile);
$obj = json_decode($jsondata, true);
if ($_GET['info'] == 'text') {
  $texto = $obj['forecast']['forecastday'][$_GET['dia']]['date_epoch'];
  $texto = date('N', $texto);
  if ($_GET['dia'] == 0 || $_GET['dia'] == 1) {
    switch ($_GET['dia']) {
      case 0: echo 'Hoje'; break;
      case 1: echo 'Amanhã'; break;
    }
  } else {
    switch ($texto) {
      case 7: echo 'Segunda-feira'; break;
      case 1: echo 'Terça-feira'; break;
      case 2: echo 'Quarta-feira'; break;
      case 3: echo 'Quinta-feira'; break;
      case 4: echo 'Sexta-feira'; break;
      case 5: echo 'Sábado'; break;
      case 6: echo 'Domingo'; break;
    }
  }
} else if ($_GET['info'] == 'icone') {
  echo $obj['forecast']['forecastday'][$_GET['dia']]['day']['condition']['icon'];
} else {
  if ($_GET['info'] == 'min') { $atributo = 'mintemp_c'; } else
  if ($_GET['info'] == 'max') { $atributo = 'maxtemp_c'; } else
  if ($_GET['info'] == 'chuva') { $atributo = 'totalprecip_mm'; }
  echo $obj['forecast']['forecastday'][$_GET['dia']]['day'][$atributo];
}
?>