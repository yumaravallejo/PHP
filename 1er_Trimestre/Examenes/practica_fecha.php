<?php
    function getFecha() {
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

    function titulo($index) {

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

        <form action="practica_fecha.php" method="post">
        <p>
            <?php
            if (isset($_POST['fecha'])) {
                $fecha_arr = explode("-", $_POST['fecha']);
                   
                $tiempo=mktime(0,0,0,$fecha_arr[1], $fecha_arr[2], $fecha_arr[0]);
                        
                $dia_sem = date("w", $tiempo);
                echo diaSemana($dia_sem);
            } else {
                $fecha_arr = explode("-",getFecha());
                   
                $tiempo=mktime(0,0,0,$fecha_arr[1], $fecha_arr[2], $fecha_arr[0]);
                        
                $dia_sem = date("w", $tiempo);
                echo diaSemana($dia_sem);
            }
                    
            ?>
          

            <input type="date" name="fecha" id="fecha-hoy" value="<?php if(isset($_POST['cambiar'])) { echo $_POST['fecha'];} else {echo getFecha();} ?>">
            <input type="submit" value="Cambiar" name="cambiar">
        
            <!-- // if (isset($_POST['cambiar'])) {
                //      Resultado-> yyyy-mm-dd
                //     echo $_POST['fecha'];
                // }
             -->
            <table class="tabla">
                <?php
                    const FILAS = 8;
                    const COLUMNAS = 6;
                    for ($i = 0; $i < FILAS ; $i++) {
                        echo "<tr>";
                        for ($j = 0; $j < COLUMNAS ; $j++) {
                            if ($i == 0 && $j == 0) {
                                echo "<th class='azul celda'></th>";
                            } else if ($i == 0 && $j != 0 ) {
                                echo "<th class='azul celda'>".diaSemana($j)."</th>";
                            }  else if ($j == 0 && $i != 4) {
                                echo "<td class='azul celda'>".horas($i)."</td>";
                            } else if ($i == 4 && $j == 0) {
                                echo "<td class='verde celda'>".horas($i)."</td>";
                            } else if ($i == 4 && $j != 0){
                                echo "<td class='verde centrado' colspan='7'>RECREO</td>";
                                break;
                            } else {
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