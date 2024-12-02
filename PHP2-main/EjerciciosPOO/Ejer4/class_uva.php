<?php
require "class_fruta.php";

class Uva extends Fruta {

    // Atributos
    private $tieneSemilla;

    // Constructor
    public function __construct($color_nuevo, $size_nuevo, $tiene){
        parent::__construct($color_nuevo, $size_nuevo);
        $this->tieneSemilla = $tiene;
    }

    // Getter
    public function tieneSemilla(){
        return $this->tieneSemilla;
    }
}
?>