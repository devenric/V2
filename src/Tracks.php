<?php

class Tracks {

    protected $id;
    protected $nombre;
    protected $formato;

    public function __construct($id, $nombre, $formato) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->formato = $formato;
    }

    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getFormato() { return $this->formato; }

    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setFormato($formato) { $this->formato = $formato; }
}
