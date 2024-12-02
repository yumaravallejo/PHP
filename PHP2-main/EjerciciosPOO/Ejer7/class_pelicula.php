<?php
class Pelicula {

    // Atributos
    private $nombre, $año, $director, $precio, $alquilada, $fecha_prev_devolucion, $recargo;

    // Constructor
    public function __construct($nombre, $año, $director, $precio, $alquilada, $fecha_prev_devolucion) {
        $this->nombre = $nombre;
        $this->año = $año;
        $this->director = $director;
        $this->precio = $precio;
        $this->alquilada = $alquilada;
        $this->fecha_prev_devolucion = new DateTime($fecha_prev_devolucion);
    }


    // Getters
    public function getNombre()
    {
        return $this->nombre;
    }

    public function getAño()
    {
        return $this->año;
    }

    public function getDirector()
    {
        return $this->director;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getAlquilada()
    {
        return $this->alquilada;
    }

    public function getFecha_prev_devolucion()
    {
        return $this->fecha_prev_devolucion->format("d/m/Y");
    }

    // Setters
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function setAño($año)
    {
        $this->año = $año;

        return $this;
    }

    public function setDirector($director)
    {
        $this->director = $director;

        return $this;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    public function setAlquilada($alquilada)
    {
        $this->alquilada = $alquilada;

        return $this;
    }

    public function setFecha_prev_devolucion($fecha_prev_devolucion)
    {
        $this->fecha_prev_devolucion = new DateTime($fecha_prev_devolucion);

        return $this;
    }

    // Métodos
    function calcularRecargo() {
        $fecha_actual = new DateTime("now");
        if ($fecha_actual > $this->fecha_prev_devolucion) {
            $dif_days = $fecha_actual->diff($this->fecha_prev_devolucion);
            $this->recargo = 1.2 * $dif_days->days;
        } else
            $this->recargo = 0;

        return $this->recargo;
    }
}
?>