<?php
    const SEGUNDOS_DIA=60*60*24;
    const DIAS_SEMANA=array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");

    if(isset($_POST['fecha']) && $_POST['fecha'] != "") {
        $fecha=$_POST['fecha'];
    } else {
        $fecha=date("Y-m-d");
    }

    $segundos_fecha = strtotime($fecha);

    //strtotime --> pasa lo que le des a fecha, incluso suma dias etc...
    $dia_semana = date("w", strtotime($fecha));
    $dias_pasados = $dia_semana-1;

    if ($dias_pasados<0){
        $dias_pasados=6;
    }

    $primer_dia = strtotime($fecha)-$dias_pasados*SEGUNDOS_DIA;
    $ultimo_dia = $primer_dia+(6*SEGUNDOS_DIA);
    
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
            background-color: lightblue;
        }

        .centrado {
            text-align:center;
        }

        table, th, td {
            border: 1px solid black;
        }

        table {width: 80%; margin:0 auto; border-collapse:collapse}

        th {background-color: #CCC}

        .verde {background-color:lightgreen}
        .blanco {background-color:white;}

    </style>
</head>
<body>
    <div class="formulario">
        <h1 class="centrado">Reserva de aulas</h1>

        <form action="pract_fechas_MA.php" method="post" id="form-fecha">
            <p class="centrado">
                <label for="fecha-hoy"><?php echo DIAS_SEMANA[$dia_semana]; ?></label>
                <input type="date" name="fecha" id="fecha-hoy" onchange="document.getElementById('form-fecha').submit()" value="<?php echo $fecha; ?>">
                
            </p>
            <p class="centrado">
                Semana del <?php echo date("d/m/Y", $primer_dia);?> al <?php echo date("d/m/Y", $ultimo_dia)?>
            </p>
        </form>

        <?php
            $horas[1]="8:15 - 9:15";
            $horas[]="9:15 - 10:15";
            $horas[]="10:15 - 11:15";
            $horas[]="11:15 - 11:45";
            $horas[]="11:45 - 12:45";
            $horas[]="12:45 - 13:45";
            $horas[]="13:45 - 14:45";


            echo "<table>";
                echo "<tr>";
                    echo "<th></th>";
                    for ($i = 1; $i<=5; $i++){
                        echo "<th>".DIAS_SEMANA[$i]."</th>";
                    }
                echo "</tr>";
                
                for ($fila=1; $fila<=7 ; $fila++) {
                    echo "<tr>";
                        if ($fila==4) {
                            echo "<th class='verde'>".$horas[$fila]."</th>";                 
                            echo "<td colspan='5' class='verde centrado'>RECREO</td>";
                        } else {
                            echo "<th>".$horas[$fila]."</th>";
                            for ($columna=1; $columna<=5; $columna++){
                                echo "<td class='blanco'>";
                                echo "</td>";
                            }
                        }
                    echo "</tr>";
                }

            echo "</table>";
        ?>

    </div>
</body>
</html>
        