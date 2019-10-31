<?php

require_once "../src/Deck.php";

use App\Deck;
use App\Land;
use App\Monster;


$monster = new Monster();


$monster->setCard_Monster();

var_dump($monster->getCar_Monster());
