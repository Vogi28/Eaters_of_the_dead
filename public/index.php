<?php

require_once __DIR__ ."/../vendor/autoload.php";
require_once __DIR__."/../src/Battlefield.php";

use App\Deck;
use App\Land;
use App\Monster;
use Symfony\Component\HttpClient\HttpClient;

$deckPlayerOne = new Monster();
$deckPlayerTwo = new Monster();
$land = new Land();

// $monster->setCard_Monster();
// $hand = $monster->getCard_Monster();

// for ($i=0; $i < 3; $i++) 
// { 
//     echo $hand[$i]['name'].'<br>';
// }

// echo '<br><br>';
// $land->setCard_lands();
// $lands = $land->getCard_Lands();

// for ($i=0; $i < 3; $i++) 
// { 
//     # code...
//     echo $lands[$i]['image'].'<br>';
// }



$battlefield = getRandomMonsters($twig, $deckPlayerOne, $deckPlayerTwo);

var_dump($battlefield);

// rooting twig
// $loader = new Twig\Loader\FilesystemLoader(__DIR__.'/../src/view/');
// $twig = new Twig\Environment($loader);

// render

// echo $twig->render('../src/view/index.hmtl.twig', 
// ['lands'=>$land,
// 'landBackground'=>$landBackground, 
// 'deckPlayerOne'=>$deckPlayerOne, 
// 'deckPlayerTwo'=>$deckPlayerTwo, 
// 'cimeteryPlayerOne'=>$cimeteryPlayerOne, 
// 'cimeteryPlayerTwoe'=>$cimeteryPlayerTwo,
// 'mainPlayerOne'=>$mainPlayerOne,
// 'mainPlayerTwo'=>$mainPlayerTwo]);


echo $twig->render('index.html.twig');


