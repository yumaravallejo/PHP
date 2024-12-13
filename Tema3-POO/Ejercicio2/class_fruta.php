<?php

class Fruta{
    private $nombre, $color, $tamanio;

    public function __construct($nombreNuevo, $colorNuevo, $tamanioNuevo){
        $this->nombre=$nombreNuevo;
        $this->color=$colorNuevo;
        $this->tamanio=$tamanioNuevo;
        $this->imprimir();
    }

    //La variable que le pasamos puede tener el mismo nombre
    public function setColor($colorNuevo) {
        $this->color=$colorNuevo;
    }

    public function setTamanio($tamanioNuevo) {
        $this->tamanio=$tamanioNuevo;
    }

    public function getColor() {
        return $this->color;
    }

    public function getTamanio() {
        return $this->tamanio;
    }

    private function imprimir(){
        echo "<h2>Información de mi fruta ".$this->nombre."</h2>";
        echo "<p><strong>Color: </strong>".$this->color."</p>";
        echo "<p><strong>Tamaño: </strong>".$this->tamanio."</p>";
    } 

}



?>