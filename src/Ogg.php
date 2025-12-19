<?php

class Ogg extends Tracks{
    private $electrica;

    function __construct($id, $nombre, $formato){
        parent::__construct($id, $nombre, $formato);
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