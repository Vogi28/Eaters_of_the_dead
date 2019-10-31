<?php

namespace App;
use Symfony\Component\HttpClient\HttpClient;


abstract class Deck 
{
    protected $deck_monsters;
    protected $card_lands;
    protected $card_monsters;
    protected $deck_lands;
    protected $cardBattlefield;

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

        $this->deck_lands = array
        (
            "1"=>array("nameMovie" => "The Maid", "image" => "images/1.jpg"),
            "2"=>array("nameMovie" => "The Dead Don't Die", "image" => "images/2.jpg"),
            "3"=>array("nameMovie" => "La Nuit déchirée", "image" => "images/3.jpg"),
            "4"=>array("nameMovie" => "Van Helsing", "image" => "images/4.jpg"),
            "5"=>array("nameMovie" => "Diablo", "image" => "images/5.jpg"),
            "6"=>array("nameMovie" => "Harlequin", "image" => "images/6.jpg"),
            "7"=>array("nameMovie" => "Trick'r Treat", "image" => "images/7.jpg"),
            "8"=>array("nameMovie" => "Destination Finale", "image" => "images/8.jpg"),
            "9"=>array("nameMovie" => "Tomb Raider", "image" => "images/9.jpg"),
            "10"=>array("nameMovie" => "Abraham Lincoln, chasseur de vampires", "image" => "images/10.jpg"),
            "11"=>array("nameMovie" => "La Femme Vampire", "image" => "images/11.jpg"),
            "12"=>array("nameMovie" => "Vampire chasseur de nuit", "image" => "images/12.jpg"),
            "13"=>array("nameMovie" => "Noble Dracula", "image" => "images/13.jpg"),
            "14"=>array("nameMovie" => "Ghoul in the House", "image" => "images/14.jpg"),
            "15"=>array("nameMovie" => "Prince of darkness", "image" => "images/15.jpg"),
            "16"=>array("nameMovie" => "Demons Revange", "image" => "images/16.jpg"),
            "17"=>array("nameMovie" => "Hell of Demon", "image" => "images/17.jpg"),
            "18"=>array("nameMovie" => "Illusion of Demon", "image" => "images/18.jpg"),
            "19"=>array("nameMovie" => "Beat the Reper", "image" => "images/19.jpg"),
            "20"=>array("nameMovie" => "Omens Good", "image" => "images/20.jpg"),
        );
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
        
            shuffle($this->deck_lands);
            return $this->card_lands = $this->deck_lands;
            
    }

    public function getCard_Monster()
    {
        # afficher les 3 cartes du joueur correspondant de facon aleatoire
        // for ($i=0; $i < 3; $i++) 
        // { 
        //     echo $$this.[$i]['name'].'<br>';
        // }
        $count=count($this->card_monsters);
        if($count>3)
        {   
            $count=3;
        }
        for($i =0;$i<$count;$i++)
        {
            $cardOfThree[]=$this->card_monsters[$i];
        }
        return $cardOfThree;
    }

    public function getCard_Land()
    {
        $count=count($this->card_lands);
        if($count>3)
        {
            $count=3;
        }
        for($i =0;$i<$count;$i++)
        {
            $landOfThree[]=$this->card_lands[$i];
        }
        return $landOfThree;
    }
    public function cimetery()
    {
        # si defense carte monstre <= 0, envoyer la catre au cimetiere
    }
}