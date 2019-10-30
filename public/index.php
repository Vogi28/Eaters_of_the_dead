<?php

require_once __DIR__ ."/../vendor/autoload.php";

use App\Battlefield;
use App\Deck;
use App\Land;

$battlefied = new Battlefield();
$deck = new Deck();
$land = new Land();

$battlefield->run();

// rooting twig
$loader = new Twig\Loader\FilesystemLoader('/src/view/index.html.twig');
$twig = new Twig\Environment($loader);

// render
echo $twig->render('../src/view/index.hmtl.twig', ['lands'=>$land, 'deckPlayerOne'=>$deckPlayerOne, 'deckPlayerTwo'=>$deckPlayerTwo, 'cimeteryPlayerOne'=>$cimeteryPlayerOne, 'cimeteryPlayerTwoe'=>$cimeteryPlayerTwo]);