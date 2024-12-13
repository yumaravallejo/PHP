<?php

class Fruta{
    private $color, $tamanio;

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
}



?>