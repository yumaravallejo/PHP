<?php
class Menu {

    // Atributos
    private array $opciones = [];

    // Getters
    public function getOpciones() {
        return $this->opciones;
    }

    // Setters
    public function setOpciones($opciones) {
        $this->opciones = $opciones;
    }

    // Métodos
    public function cargar($url, $nombre) {
        $this->opciones["$url"]=$nombre;
    }

    public function mostrarVertical() {
        $text = "<p>";
        foreach ($this->opciones as $url => $nombre) {
            $text.="<a href='".$url."' >".$nombre."</a><br>";
        }
        $text.="</p>";
        echo $text;
    }

    public function mostrarHorizontal() {
        $text = "<p>";
        foreach ($this->opciones as $url => $nombre) {
            $text.="<a href='".$url."' >".$nombre."</a> - ";
        }
        $text = substr($text, 0, -2);
        $text.="</p>";
        echo $text;
    }
}
?>