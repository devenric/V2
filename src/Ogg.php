<?php

class Ogg extends Tracks{
    private $electrica;

    function __construct($id, $nombre, $precio, $electrica){
        parent::__construct($id, $nombre, $precio);
        $this->formato=$formato;
    }

    public function getFormato()
    {
        if ($this->formato==0){
            return "Mp3";
        }else{
            return "Ogg";
        }
        
    }
}