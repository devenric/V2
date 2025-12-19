<?php

class Gestor {

    public function __construct(){
        if (!isset($_SESSION['productos'])) {
            $_SESSION['productos'] = [];
        }
    }
    private $playlist; //array de objetos
    
    public function agregar(Tracks $p) {
          $_SESSION['productos'][] = $p;
    }

    public function listar() {
        return   $_SESSION['productos'];
    }

    public function buscar($id) {
        foreach (  $_SESSION['productos'] as $p) {
            if ($p->getId() == $id) return $p;
        }
        return null;
    }

    public function actualizar($id, $nombre, $formato) {
        foreach ($_SESSION['productos'] as $p) {
            if ($p->getId() == $id) {
                $p->setNombre($nombre);
                $p->setFormato($formato);
                return true;
            }
        }
        return false;
    }

    public function eliminar($id) {
        //for ($i=0; $i<count(  $_SESSION['productos']);$i++)
                //if (  $_SESSION['productos'][$i]->getId() == $id)
        //Las dos líneas siguientes sustituyen las anteriores
        foreach (  $_SESSION['productos'] as $i => $p) {
            if ($p->getId() == $id) {
                unset(  $_SESSION['productos'][$i]);
                  $_SESSION['productos'] = array_values(  $_SESSION['productos']);
                return true;
            }
        }
        return false;
    }
}
