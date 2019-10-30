<?php

namespace App;

abstract class Deck 
{
    protected $card_monsters;
    protected $card_lands;


    public function selectDeck()
    {
        # chercher les cartes du deck correspondant sur l'API
    }

    public function mixedDeck() #optionnal
    {
        # code...
    }

    public function setCard_Monster()
    {
        # melanger le deck et sortir 3 cartes monstre du deck 
    }

    public function setCard_Land()
    {
        # melanger le deck et sortir 3 cartes terrain du deck         
    }

    public function getCard_Monster()
    {
        # afficher les 3 cartes du joueur correspondant de facon aleatoire
    }

    public function getCard_Land()
    {
        # afficher les 3 terrains  de facon aleatoire 
    }

    public function cimetery()
    {
        # si defense carte monstre <= 0, envoyer la catre au cimetiere
    }
}