<?php

require_once __DIR__ ."/../vendor/autoload.php";

use App\Deck;
use App\Land;
use App\Monster;
use App\Battlefield;
use Symfony\Component\HttpClient\HttpClient;

$battlefied = new Battlefield();
$monster = new Monster();
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


$battlefield->run();

// rooting twig
$loader = new Twig\Loader\FilesystemLoader('/src/view/index.html.twig');
$twig = new Twig\Environment($loader);

// render
echo $twig->render('../src/view/index.hmtl.twig', ['lands'=>$land, 'deckPlayerOne'=>$deckPlayerOne, 'deckPlayerTwo'=>$deckPlayerTwo, 'cimeteryPlayerOne'=>$cimeteryPlayerOne, 'cimeteryPlayerTwoe'=>$cimeteryPlayerTwo]);
