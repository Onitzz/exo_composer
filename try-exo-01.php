<?php

$dividende = 1;
$diviseur = random_int(0, 1);
if($diviseur == 0){
  throw new Exception('Le diviseur est egal a 0');
}
$quotien = $dividende / $diviseur;
