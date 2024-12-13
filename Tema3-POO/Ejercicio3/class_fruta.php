<?php

class Fruta{
    private $nombre, $color, $tamanio;

    private static $n_frutas = 0;

    public function __construct($nombreNuevo, $colorNuevo, $tamanioNuevo){
        $this->nombre=$nombreNuevo;
        $this->color=$colorNuevo;
        $this->tamanio=$tamanioNuevo;
        //Para los static se usa self:: para modificar y poder usarlo
        self::$n_frutas++;
        // $this->imprimir();
    }

    public function __destruct()
    {
        self::$n_frutas--;
    }

    public static function cuantaFruta() {
        return self::$n_frutas;
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

    public function setNombre($nombreNuevo) {
        $this->nombre=$nombreNuevo;
    }

    public function getNombre() {
        return $this->nombre;
    }
    private function imprimir(){
        echo "<h2>Información de mi fruta ".$this->nombre."</h2>";
        echo "<p><strong>Color: </strong>".$this->color."</p>";
        echo "<p><strong>Tamaño: </strong>".$this->tamanio."</p>";
    } 

}



?>