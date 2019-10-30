<?php

namespace App;

class Battlefield
{
    private $deckPlayerOne;
    private $deckPlayerTwo;
    private $land;

    public function __construct()
    {
    }

    public function run()
    {
        //Toutes les fonctions
        while ($this->winCondition())
        {
            $this->getRandomLands();
            $this->getRandomMonsters();
            $this->setChoiceMonster();
            $this->setRandomLand();
            $this->isLandMonster();
            $this->fight();
        }
    }

    public function winCondition()
    {
        // Si deck = 0 et cimetière = 20
        $isTrue = True;
        return $isTrue;
    }

    public function getRandomLands()
    {
        // Préselection des 3 terrains
    }

    public function getRandomMonsters()
    {
        // Main des joueurs
        // Si monstre vivants ne pioche pas
        // Sinon il pioche 3 cartes
    }

    public function setChoiceMonster()
    {
        // Si monstre vivant ne choisi pas
        // Sinon en choisi 1
    }

    public function setRandomLand()
    {
        // Séléction du terrain
    }

    public function isLandMonster()
    {
        // Si terrain du monstre joueur 1 alors boost
        // Si terrain du monstre joueur 2 alors boost
        // Sinon rien
    }

    public function fight()
    {
        // Résolution des dégats
        // Si les 2 créatures meurt cimetière + 1
        // Sinon (juste 1 créature est morte) créature joueur x, cimetière joueur x + 1
    }
}
