<?php
class Fruta {
    // Atributos
    private $color, $size;

    // Constructor
    public function __construct($color_nuevo, $size_nuevo) {
        $this->color = $color_nuevo;
        $this->size = $size_nuevo;
        $this->imprimir();
    }

    // Setters
    public function set_color($color_nuevo){
        $this->color = $color_nuevo;
    }

    public function set_size($size_nuevo){
        $this->size = $size_nuevo;
    }

    // Getters
    public function get_color(){
        return $this->color;
    }

    public function get_size(){
        return $this->size;
    }

    // Métodos
    private function imprimir(){
        echo "<p>Esta es una fruta de <strong>color</strong> ".$this->get_color()." de <strong>tamaño</strong> ".$this->get_size()."</p>";
    }
}
?>