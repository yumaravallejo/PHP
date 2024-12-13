<?php
//Creamos la clase empleado
class Empleado {
    //Le ponemos sus atributos
    private $nombre, $sueldo;

    public function __construct($nombre, $sueldo)
    {
        $this->nombre = $nombre;
        $this->sueldo = $sueldo;
    }

    public function setNombre ($nombre){
        $this->nombre = $nombre;
    }

    public function setSueldo ($sueldo){
        $this->sueldo = $sueldo;
    }

    public function getNombre () {
        return $this->nombre;
    }

    public function getSueldo () {
        return $this->sueldo;
    }

    //En los static no se puede usar this
    public function imprimir() {
        if ($this->sueldo > 3000) {
            //Paga impuestos
            echo "<p><strong>Nombre: </strong>".$this->nombre."</p>";
            echo "<p><strong>Sueldo: </strong>".$this->sueldo."</p>";
            echo "<p>".$this->nombre." debe pagar impuestos</p>";
        } else {
            //No paga impuestos
             //Paga impuestos
             echo "<p><strong>Nombre: </strong>".$this->nombre."</p>";
             echo "<p><strong>Sueldo: </strong>".$this->sueldo."</p>";
             echo "<p>".$this->nombre." no debe pagar impuestos</p>";
        }
    }
}
