<?php
    function getFecha() {
        //getdate() da la fecha de hoy (time y date) --> mirar en internet
        // Genera un array asociativo con muchisima informacion
        $hoy = getdate();
        $anyo = $hoy["year"];
        $mes = $hoy["mon"];
        $day = $hoy["mday"];
        if (strlen($day) == 1) {
            $day = "0".$day;
        } 

        if (strlen($mes) == 1) {
            $mes = "0".$mes;
        }

        $fecha_str = $anyo."-".$mes."-".$day;

        return $fecha_str;
    }

    function diaSemana($dia) {
        //Método para obtener los días de la semana pasándole el día numérico
        switch($dia) {
            case 1: 
                return "Lunes";
                break;
            case 2: 
                return "Martes";
                break;
            case 3: 
                return "Miércoles";
                break;
            case 4: 
                return "Jueves";
                break;
            case 5: 
                return "Viernes";
                break;
            case 6: 
                return "Sábado";
                break;
            case 0: 
                return "Domingo";
                break;
    
        }
    } 

    function horas($hora) {
        //Método para la tabla que contiene las horas
        switch($hora) {
            case 0: 
                return "";
            case 1: 
                return "8:15 - 9:15";
                break;
            case 2: 
                return "9:15 - 10:15";
                break;
            case 3: 
                return "10:15 - 11:15";
                break;
            case 4: 
                return "11:15 - 11:45";
                break;
            case 5: 
                return "11:45 - 12:45";
                break;
            case 6: 
                return "12:45 - 13:45";
                break;
            case 7: 
                return "13:45 - 14:45";
                break;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica de fechas</title>
    <style>
        .formulario {
            padding: 10px;
            border: 1px solid black;
        }

        .centrado {
            text-align:center;
        }

        .tabla {
            border: 1px solid black;
            border-collapse:collapse;
        }

        tr {
            border: 1px solid black;
            
        }

        .celda {
            border-right: 1px solid black;
            padding: 4px
        }

        .celda_verde {
            padding: 4px
        }

        .azul {
            background-color: lightblue;
        }

        .verde {
            background-color: lightgreen;
        }

    </style>
</head>
<body>
<div class="formulario">
    <h1 class="centrado">Reserva de aulas</h1>

        <form action="practica_fecha[1].php" method="post">
        <p>
            <?php
            if (isset($_POST['fecha'])) {
                //Si se ha insertado una fecha se hará todo usando esa fecha
                //Unir toda la fecha
                $fecha_arr = explode("-", $_POST['fecha']);
                   
                //Saber el tiempo que ha pasado desde (fecha determinada de mktime) hasta la fecha que le des
                // te devuelve en segundos (creo)
                $tiempo=mktime(0,0,0,$fecha_arr[1], $fecha_arr[2], $fecha_arr[0]);
            
                //Esto nos dará el dia de la semana a la q corresponde ese tiempo (dia seleccionado numérico)
                $dia_sem = date("w", $tiempo);

                //Con el metodo lo que haremos será obtener el nombre
                echo diaSemana($dia_sem);
            } else {
                //Si aún no se ha seleccionado nada se pondrá el día de hoy
                //Poner todo el array sin separaciones
                $fecha_arr = explode("-",getFecha());
                   
                //Mktime --> (time(),, Mes, Día, Año)
                $tiempo=mktime(0,0,0,$fecha_arr[1], $fecha_arr[2], $fecha_arr[0]);
                        
                $dia_sem = date("w", $tiempo); //Da el día de la semana en número (lo paso con metodo)
                echo diaSemana($dia_sem);
            }
                    
            ?>
          

            <input type="date" name="fecha" id="fecha-hoy" value="<?php /*Si se ha pulsado el botón cambiar aparecerá el valor insertado si no el predeterminado (hoy)*/ if(isset($_POST['cambiar'])) { echo $_POST['fecha'];} else {echo getFecha();} ?>">
            <!-- Este botón debe ser submit para que la página reinicie (poniendo en el method que se mande a la misma) -->
            <input type="submit" value="Cambiar" name="cambiar">
        
            <!-- Probando qué devuelve y el modo -->
            <!-- // if (isset($_POST['cambiar'])) {
                //      Resultado-> yyyy-mm-dd
                //     echo $_POST['fecha'];
                // }
             -->
            <!-- Creamos la etiqueta tabla antes de entrar al bucle -->
            <table class="tabla">
                <?php

                    const FILAS = 8;
                    const COLUMNAS = 6;
                    for ($i = 0; $i < FILAS ; $i++) {
                        //Creamos el tr fuera del bucle de las columnas ya que se crearan cada vez que se vaya a crear otra fila
                        echo "<tr>";
                        for ($j = 0; $j < COLUMNAS ; $j++) {
                            if ($i == 0 && $j == 0) {
                                //Primera casilla sin nada
                                echo "<th class='azul celda'></th>";
                            } else if ($i == 0 && $j != 0 ) {
                                //Casillas de la fila de arriba con los días
                                //De J porque contamos que i es 0 entonces empezariamos por domingo en vez de por lunes y todos serian domingo
                                echo "<th class='azul celda'>".diaSemana($j)."</th>";
                            }  else if ($j == 0 && $i != 4) {
                                //Columna primera de azules con las horas, SIN LA DEL RECREO
                                echo "<td class='azul celda'>".horas($i)."</td>";
                            } else if ($i == 4 && $j == 0) {
                                //Columna de las horas de recreo
                                echo "<td class='verde celda'>".horas($i)."</td>";
                            } else if ($i == 4 && $j != 0){
                                //fila del recreo
                                echo "<td class='verde centrado' colspan='7'>RECREO</td>";
                                break;
                            } else {
                                //Resto sin nada
                                echo "<td class='celda'></td>";
                            }
                        }
                        echo "</tr>";
                    }
                        
              
                ?>
            </table>
        </p>
        
        </form>
    </div>
</body>
</html>