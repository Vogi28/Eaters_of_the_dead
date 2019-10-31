<?php

namespace App;

use Symfony\Component\HttpClient\HttpClient;

class Land extends Deck
{
    private $lands_show;

    public function __construc()
    {
        parent::__construct;
    }
    
    public function setCard_Lands()
    {
        # code...
        shuffle($this->deck_lands);
                return $this->card_lands = $this->deck_lands;
    }

    public function getCard_Lands()
    {
        return $this->card_lands;
    }
}


