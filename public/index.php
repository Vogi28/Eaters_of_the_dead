<?php

require '../vendor/autoload.php';

use App\Land;
use App\Monster;
use App\Battlefield;
use Symfony\Component\HttpClient\HttpClient;

$battlefied = new Battlefield();
$monster = new Monster();
$land = new Land();


$monster->setCard_Monster();
$hand = $monster->getCard_Monster();

for ($i=0; $i < 3; $i++) 
{ 
    echo $hand[$i]['name'].'<br>';
}
// $battlefield->run();
