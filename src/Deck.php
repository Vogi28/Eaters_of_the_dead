<?php

namespace App;
use Symfony\Component\HttpClient\HttpClient;


abstract class Deck 
{
    public $deck_monsters;
    public $card_lands;
    public $card_monsters;


    public function __construct()
    {
        # chercher les cartes du deck correspondant sur l'API
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://hackathon-wild-hackoween.herokuapp.com/monsters');
        
        $statusCode = $response->getStatusCode();
        
        if($statusCode === 200)
        {
            $this->deck_monsters = $response->toArray();
        }
    }

    public function mixedDeck() #optionnal
    {
        # code...
    }

    public function setCard_Monster()
    {
        # melanger le deck et sortir 3 cartes monstre du deck 
        foreach($this->deck_monsters as $monsters)
        {
            shuffle($monsters);
            $this->card_monsters = $monsters;
        }
    }

    public function setCard_Land()
    {
        # melanger le deck et sortir 3 cartes terrain du deck         
    }

    public function getCard_Monster()
    {
        # afficher les 3 cartes du joueur correspondant de facon aleatoire
        return $this->card_monsters;
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