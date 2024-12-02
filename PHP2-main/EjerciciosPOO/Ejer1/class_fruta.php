<?php
class Fruta {
    // Atributos
    private $color, $size;

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
}
?>