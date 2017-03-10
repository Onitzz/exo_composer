<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

function getData($file = 'popschool.yml'){
  return Yaml::parse(file_get_contents($file));
}
$tab = getData();
echo $tab['users'][random_int(0,count($tab['users'])-1)]."\n";
