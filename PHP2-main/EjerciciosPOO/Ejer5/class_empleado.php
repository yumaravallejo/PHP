<?php
class Empleado {

    // Atributos
    private $nombre, $sueldo;

    // Constructor
    public function __construct(string $nombre_nuevo, string $sueldo_nuevo) {
        $this->nombre = $nombre_nuevo;
        $this->sueldo = $sueldo_nuevo;
    }

    // Getters
    public function getNombre() {
        return $this->nombre;
    }

    public function getSueldo() {
        return $this->sueldo;
    }

    // Setters
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setSueldo($sueldo) {
        $this->sueldo = $sueldo;
    }

    // Métodos
    public function impuestos() {
        if ($this->sueldo > 3000)
            echo "<p>El empleado llamado <strong>".$this->nombre."</strong> tiene un sueldo de <strong>"
                .$this->sueldo."€</strong>, por lo tanto, <strong>paga impuestos</strong>.</p>";
        else
        echo "<p>El empleado llamado <strong>".$this->nombre."</strong> tiene un sueldo de <strong>"
        .$this->sueldo."€</strong>, por lo tanto, <strong>NO paga impuestos</strong>.</p>";
    }
}
?>