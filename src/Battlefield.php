<?php
    require_once __DIR__ ."/../vendor/autoload.php";
    session_start();
use App\Deck;
use App\Land;
use App\Monster;



if(!isset($_SESSION["land"]))
{
    $deckPlayerOne= new Monster();
    $deckPlayerTwo = new Monster();
    $deckOrigin=new Monster();
    $landOrigin=new Land();
    $land = new Land();

}
else{
    $deckPlayerOne= $_SESSION["deckPlayerOne"];
    $deckPlayerTwo = $_SESSION["deckPlayerTwo"];
    $deckOrigin=$_SESSION["deckOrigin"];
    $landOrigin =$_SESSION["landOrigin"];
    $land =$_SESSION["land"];
}

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
            echo $twig->render('index.html.twig',['twoLose'=>$towLose]);
        }
        echo $twig->render('index.html.twig',['hallo'=>"Continuer"]);
    }

    function getRandomLands($twig, $land)
    {

        // Préselection des 3 terrains
        $land->setCard_Land();
        $lands = $land->getCard_Land();
        $land->setThreeLands($lands);
        $_SESSION["afficheland"]=$lands;
        echo $twig->render('index.html.twig',['lands'=>$lands]);
    }

    function getRandomMonsters($twig, $deckPlayerOne, $deckPlayerTwo)
    {
        // Main des joueurs
        // Si monstre vivants ne pioche pas
        // Sinon il pioche 3 cartes
        $deckPlayerOne->setCard_Monster();
        $deckPlayerTwo->setCard_Monster();
        $playerOneThree=$deckPlayerOne->getCard_Monster();
        $playerTwoThree=$deckPlayerTwo->getCard_Monster();
        $deckPlayerOne->setThreeCards($playerOneThree);
        $deckPlayerTwo->setThreeCards($playerTwoThree);
        $_SESSION["playerOneThreee"]=$playerOneThree;
        $_SESSION["playerTwoThree"]=$playerTwoThree;
        echo $twig->render("index.html.twig",
        ["playerOneThree"=>$playerOneThree,
        "playerTwoThree"=>$playerTwoThree,
        "lands"=>$_SESSION['afficheland']]);
    }
    function isChoiceMonster($twig, $deckPlayerOne,$deckPlayerTwo)
    {       
        $playerOneThree=$deckPlayerOne->getThreeCards();
        $playerTwoThree=$deckPlayerTwo->getThreeCards();
        
        foreach($playerOneThree as $card1)
        {

            if($card1["id"]==$_GET["id1"])
            {  

                $deckPlayerOne->setMonster($card1);
            }
        }
        foreach($playerTwoThree as $card2)
        {
            if($card2["id"]==$card2["id"])
            {

                $deckPlayerTwo->setMonster($card2);
            }
        }

        echo $twig->render('index.html.twig',['id'=>5,
        'cardOne'=>$deckPlayerOne->getMonster(),
        'cardTwo'=>$deckPlayerTwo->getMonster(),
        'playerOneThree'=>$_SESSION['playerOneThree'],
        'playerTwoThree'=>$_SESSION['playerTwoThree'],
        'lands'=>$_SESSION["afficheland"]]);
    }

    function setRandomLand($twig,$land)
    {
        // Séléction du terrain
        $lands=$land->getThreeLands();
        foreach($lands as $land)
        {
            $oneLand=$land;
        }
        echo $twig->render('index.html.twig',['id'=>6,'oneLand'=>$oneLand]);
    }

    function isLandMonster($twig,$land,$deckPlayerOne,$deckPlayerTwo,$deckOrigin)
    {
        // Si terrain du monstre joueur 1 alors boost
        // Si terrain du monstre joueur 2 alors boost
        // Sinon rien
        $terrain=$land->getLand();
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



        echo $twig->render('index.html.twig',['id'=>8]);
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


    $_SESSION["deckPlayerOne"]=$deckPlayerOne;
    $_SESSION["deckPlayerTwo"]=$deckPlayerTwo;
    $_SESSION["deckOrigin"]=$deckOrigin;
    $_SESSION["landOrigin"]=$landOrigin;
    $_SESSION["land"]=$land;