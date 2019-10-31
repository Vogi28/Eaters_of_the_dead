<?php
    require_once __DIR__ ."/../vendor/autoload.php";
    session_start();
use App\Deck;
use App\Land;
use App\Monster;

if(!isset($_SESSION))
{
    $deckPlayerOne = new Monster();
    $deckPlayerTwo = new Monster();
    $deckOrigin=new Monster();
    $landOrigin=new Land();
    $land = new Land();
}

    $_SESSION["deckPlayerOne"]=$deckPlayerOne;
    $_SESSION["deckPlayerTwo"]=$deckPlayerTwo;
    $_SESSION["deckOrigin"]=$deckOrigin;
    $_SESSION["landOrigin"]=$landOrigin;
    $_SESSION["land"]=$land;

    $loader = new Twig\Loader\FilesystemLoader(__DIR__.'/../src/view/');
    $twig = new Twig\Environment($loader);

    if($_GET["page"]=="1")
    {
        call_user_func("winCondition",$twig,$deckPlayerOne,$deckPlayerTwo,$land);
    }
    if($_GET["page"]=="2")
    {
        call_user_func("getRandomLands",$twig, $land, $deckPlayerOne);
    }
    if($_GET["page"]=="3")
    {
        call_user_func("getRandomMonsters",$twig, $deckPlayerOne,$deckPlayerTwo);
    }
    if($_GET["page"]=="4")
    {
        call_user_func("isChoiceMonster",$twig, $deckPlayerOne,$deckPlayerTwo);
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



    function winCondition($twig, $deckPlayerOne,$deckPlayerTwo,$land)
    {
        echo $deckPlayerOne->cimetery;
        $deckPlayerOne->cimetery=12;

        // cimetière = 20
        if($deckPlayerOne->getCimetery() == 20)
        {
            $terrain=$land->getCard_Land();
            $oneLose="lose";
            echo $twig->render('index.html.twig',['oneLose'=>$oneLose]);
        }
        if($deckPlayerTwo->getCimetery() == 20)
        {
            $towLose="lose";
            echo $twig->render('index.html.twig',['oneLose'=>$towLose]);
        }

    }

    function getRandomLands($twig, $land, $deckPlayerOne)
    {
        echo $deckPlayerOne->cimetery;
        $deckPlayerOne->cimetery=12;
        // Préselection des 3 terrains
        $land->setCard_Land();
        $lands = $land->getCard_Land();
        echo $twig->render('index.html.twig');
    }

    function getRandomMonsters($twig, $deckPlayerOne, $deckPlayerTwo)
    {
        // Main des joueurs
        // Si monstre vivants ne pioche pas
        // Sinon il pioche 3 cartes
        $playerOneThree=$deckPlayerOne->getThreeCards();
        $playerTwoThree=$deckPlayerTwo->getThreeCards();

        echo $twig->render('index.html.twig',
        ['playerOneThree'=>$playerOneThree,
        'playerTwoThree'=>$playerTwoThree]);
    }
    function isChoiceMonster($twig, $deckPlayerOne,$deckPlayerTwo)
    {
        $playerOneThree=$deckPlayerOne->getCard_Monster();
        $playerTwoThree=$deckPlayerTwo->getCard_Monster();
        foreach($playerOneThree as $card)
        {
            if($card["id"]==$_GET["id"])
            {
                $deckPlayerOne->setCard($card);
            }
        }
        foreach($playerTwoThree as $card)
        {
            if($card["id"]==$_GET["id"])
            {
                $deckPlayerTwo->setCard($card);
            }
        }
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
        $cardPlayerOne=$deckPlayerOne->getMonster();
        $cardPlayerTwo=$deckPlayerTwo->getMonster();

        if($terrain["id"]==$cardPlayerOne["id"])
        {
            foreach($deckOrigin as $deck)
            {
                if($deck["id"]==$cardPlayerOne["id"])
                {
                    $defense=$deck["defense"];
                }
            }
            if($defense!=$cardPlayerOne["defense"])
            {
                $cardPlayerOne["defense"]=$defense;
            }
            else
            {
                $cardPlayerOne["attack"]*=2;
            }
        }        
        if($terrain["id"]==$cardPlayerTwo["id"])
        {
            foreach($deckOrigin as $deck)
            {
                if($deck["id"]==$cardPlayerTwo["id"])
                {
                    $defense=$deck["defense"];
                }
            }
            if($defense!=$cardPlayerTwo["defense"])
            {
                $cardPlayerTwo["defense"]=$defense;
            }
            else
            {
                $cardPlayerTwo["attack"]*=2;
            }
        }



        echo $twig->render('index.html.twig');
    }

    function fight($twig, $deckPlayerOne,$deckPlayerTwo)
    {
        // Résolution des dégats
        // Si les 2 créatures meurt cimetière + 1
        // Sinon (juste 1 créature est morte) créature joueur x, cimetière joueur x + 1
        $cardPlayerOne=$deckPlayerOne->getMonster();
        $cardPlayerTwo=$deckPlayerTwo->getMonster();

        $cardPlayerOne["defense"]-=$cardPlayerTwo["attack"];
        $cardPlayerTwo["defense"]-=$cardPlayerOne["attack"];
        echo $twig->render('index.html.twig');
    }


