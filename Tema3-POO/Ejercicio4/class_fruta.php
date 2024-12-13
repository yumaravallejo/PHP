<?php

class Fruta{
    private $color, $tamanio;

    private static $n_frutas = 0;

    public function __construct($colorNuevo, $tamanioNuevo){
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

    public function imprimir(){
        echo "<p>Información de mi fruta</p>";
        echo "<p><strong>Color: </strong>".$this->color."</p>";
        echo "<p><strong>Tamaño: </strong>".$this->tamanio."</p>";
    } 

}



?>