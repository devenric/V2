<?php

class Mp3 extends Tracks{
    private $electrica;

    function __construct($id, $nombre, $formato){
        parent::__construct($id, $nombre, $formato);
        $this->formato=$formato;
    }

    public function getElectrica()
    {
        if ($this->formato==0){
            return "Mp3";
        }else{
            return "Ogg";
        }
        
    }
}