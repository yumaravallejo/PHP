<?php
    require_once('class_fruta.php');

    class Uva extends Fruta {
        private $tieneSemilla;

        public function __construct($colorNuevo, $tamanioNuevo, $tiene)
        {
            $this->tieneSemilla=$tiene;
            //Llamar al constructor del padre
            parent::__construct($colorNuevo, $tamanioNuevo);
        }

        public function tieneSemilla() {
            return $this->tieneSemilla;
        }

        public function imprimir(){
            echo "<p>Información de mi uva</p>";
            echo "<p><strong>Color: </strong>".parent::getColor()."</p>";
            echo "<p><strong>Tamaño: </strong>".parent::getTamanio()."</p>";
        } 

    }
?>