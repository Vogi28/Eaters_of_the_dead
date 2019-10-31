<?php
    require_once __DIR__ ."/../vendor/autoload.php";

use App\Deck;
use App\Land;
use App\Monster;

$deckPlayerOne = new Monster();
$deckPlayerTwo = new Monster();
$deckOrigin=new Monster();
$landOrigin=new Land();
$land = new Land();



    $loader = new Twig\Loader\FilesystemLoader(__DIR__.'/../src/view/');
    $twig = new Twig\Environment($loader);

    if($_GET["page"]=="1")
    {
        call_user_func("winCondition",$twig,$deckPlayerOne,$deckPlayerTwo);
    }
    if($_GET["page"]=="2")
    {
        call_user_func("getRandomLands",$twig, $land);
    }
    if($_GET["page"]=="3")
    {
        call_user_func("getRandomMonsters",$twig, $deckPLayerOne,$deckPlayerTwo);
    }
    if($_GET["page"]=="4")
    {
        call_user_func("setChoiceMonster",$twig,$deckplayers);
    }
    if($_GET["page"]=="5")
    {
        call_user_func("setRandomLand",$twig,$land);
    }
    if($_GET["page"]=="6")
    {
        call_user_func("isLandChoice",$twig,$landOrigin,$land);
    }
    if($_GET["page"]=="7")
    {
        call_user_func("isLandMonster",$twig,$land,$deckPlayerOne,$deckPlayerTwo,$deckOrigin);
    }
    if($_GET["page"]=="8")
    {
        call_user_func("fight",$twig,$deckPlayerOne,$deckPlayerTwo);
    }



    function winCondition($twig, $deckPlayerOne,$deckPlayerTwo)
    {
        // cimetière = 20
        if($deckPlayerOne->cimetery == 20)
        {();
            $terrain=$land->getCard_Land();
            $cardPlayerOne=$deckPlayerOne->getCard();
            $cardPlayerTwo=$deckPlayerTwo->getCard();
    
            if($terrain["id"]==$deckPlayerOne["id"])
            {
                foreach($deckOrigin as $deck)
                {
                    if($deck["id"]==$deckPlayerOne["id"])
                    {
                        $defense=$deck["defense"];
                    }
                }
                if($defense!=$deckPlayerOne["defense"])
                {
            $oneLose="lose";
            echo $twig->render('index.html.twig',['oneLose'=>$oneLose]);
        }
        if($deckPlayerOne->cimetery == 20)
        {
            $TowLose="lose";
            echo $twig->render('index.html.twig',['oneLose'=>$oneLose]);
        }

    }

    function getRandomLands($twig, $land)
    {
        // Préselection des 3 terrains
        $land->setCard_Land();
        $lands = $land->getCard_Land();
        echo $twig->render('index.html.twig');
        foreach ($lands as $image)
        {
            $lands_set[] = $image['image'];
        }
    }

    function getRandomMonsters($twig, $deckPlayerOne, $deckPlayerTwo)
    {
        // Main des joueurs
        // Si monstre vivants ne pioche pas
        // Sinon il pioche 3 cartes
        $deckPlayerOne->setCard_Monster();
        $deckPlayerTwo->setCard_Monster();
        $deck_players = [$deckPlayerOne->getCard_Monster(), $deckPlayerTwo->getCard_Monster()];

        return $deck_players;
        echo $twig->render('index.html.twig');
    }

    function setChoiceMonster($twig, $deckPlayers)
    {
        // Si monstre vivant ne choisi pas
        // Sinon en choisi 1 
        return $deckPlayers;
        echo $twig->render('index.html.twig');
    }

    function setRandomLand($twig,$land)
    {
        // Séléction du terrain;
        $lands=$land->getThreeLands();


        echo $twig->render('index.html.twig');
    }
    function isLandChoice($twig,$landOrigin,$land)
    {
        $landId=$_GET["id"];
        foreach($landOrigin as $origin)
        {
            if($landId==$origin["id"])
            {
                $land->setLand($origin);
            }
        }
        
        echo $twig->render('index.html.twig');
    }

    function isLandMonster($twig,$land,$deckPlayerOne,$deckPlayerTwo,$deckOrigin)
    {
        // Si terrain du monstre joueur 1 alors boost
        // Si terrain du monstre joueur 2 alors boost
        // Sinon rien
        $land->setCard_Land();
        $terrain=$land->getCard_Land();
        $cardPlayerOne=$deckPlayerOne->getCard();
        $cardPlayerTwo=$deckPlayerTwo->getCard();

        if($terrain["id"]==$deckPlayerOne["id"])
        {
            foreach($deckOrigin as $deck)
            {
                if($deck["id"]==$deckPlayerOne["id"])
                {
                    $defense=$deck["defense"];
                }
            }
            if($defense!=$deckPlayerOne["defense"])
            {
                $deckPlayerOne["defense"]=$defense;
            }
            else
            {
                $deckPlayerOne["attack"]*=2;
            }
        }        
        if($terrain["id"]==$deckPlayerTwo["id"])
        {
            foreach($deckOrigin as $deck)
            {
                if($deck["id"]==$deckPlayerTwo["id"])
                {
                    $defense=$deck["defense"];
                }
            }
            if($defense!=$deckPlayerTwo["defense"])
            {
                $deckPlayerTwo["defense"]=$defense;
            }
            else
            {
                $deckPlayerTwo["attack"]*=2;
            }
        }



        echo $twig->render('index.html.twig');
    }

    function fight($twig, $deckPlayerOne,$deckPlayerTwo)
    {
        // Résolution des dégats
        // Si les 2 créatures meurt cimetière + 1
        // Sinon (juste 1 créature est morte) créature joueur x, cimetière joueur x + 1
        $cardPlayerOne=$deckPlayerOne->getCard();
        $cardPlayerTwo=$deckPlayerTwo->getCard();

        $cardPlayerOne["defense"]-=$cardPlayerTwo["attack"];
        $cardPlayerTwo["defense"]-=$cardPlayerOne["attack"];
        var_dump($cardPlayerOne,$cardPlayerTwo);
        echo $twig->render('index.html.twig');
    }
