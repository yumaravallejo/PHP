<?php
    class Menu {
        private $array_items = array();

        public function cargar($url, $nombre) {
            $this->array_items[$nombre] = $url;
        }

        public function vertical() {
            echo "<p>";
            foreach($this->array_items as $nombre => $url){
                echo "<a href='".$url."'>".$nombre."</a> <br/>";
                
            }
            echo "</p>";
        }

        public function horizontal() {
            $imprimir = "";
            foreach($this->array_items as $nombre => $url){
                $imprimir .= "<a href='".$url."'>".$nombre."</a> - ";
            }
            echo "<p>".substr($imprimir, 0, -2) ."</p>";;
        }
    }
?>