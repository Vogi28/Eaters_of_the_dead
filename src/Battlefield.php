<?php
    require_once __DIR__ ."/../vendor/autoload.php";

    $loader = new Twig\Loader\FilesystemLoader(__DIR__.'/../src/view/');
    $twig = new Twig\Environment($loader);

    if($_GET["page"]=="1")
    {
        call_user_func("winCondition",$twig);
    }
    if($_GET["page"]=="2")
    {
        call_user_func("getRandomLands",$twig);
    }
    if($_GET["page"]=="3")
    {
        call_user_func("getRandomMonsters",$twig);
    }
    if($_GET["page"]=="4")
    {
        call_user_func("setChoiceMonster",$twig);
    }
    if($_GET["page"]=="5")
    {
        call_user_func("setRandomLand",$twig);
    }
    if($_GET["page"]=="6")
    {
        call_user_func("isLandMonster",$twig);
    }
    if($_GET["page"]=="7")
    {
        call_user_func("fight",$twig);
    }

    $valeur="Bonjour je suis un string";


    function winCondition($twig)
    {
        // Si deck = 0 et cimetière = 20
        echo $twig->render('index.html.twig',['valeur'=>$valeur]);
    }

    function getRandomLands($twig)
    {
        // Préselection des 3 terrains
        echo $twig->render('index.html.twig');
    }

    function getRandomMonsters($twig)
    {
        // Main des joueurs
        // Si monstre vivants ne pioche pas
        // Sinon il pioche 3 cartes
        echo $twig->render('index.html.twig');
    }

    function setChoiceMonster($twig)
    {
        // Si monstre vivant ne choisi pas
        // Sinon en choisi 1
        echo $twig->render('index.html.twig');
    }

    function setRandomLand($twig)
    {
        // Séléction du terrain;
        echo $twig->render('index.html.twig');
    }

    function isLandMonster($twig)
    {
        // Si terrain du monstre joueur 1 alors boost
        // Si terrain du monstre joueur 2 alors boost
        // Sinon rien
        echo $twig->render('index.html.twig');
    }

    function fight($twig)
    {
        // Résolution des dégats
        // Si les 2 créatures meurt cimetière + 1
        // Sinon (juste 1 créature est morte) créature joueur x, cimetière joueur x + 1
        echo $twig->render('index.html.twig');
    }