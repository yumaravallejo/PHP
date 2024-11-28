<?php
if ($n_tuplas > 0 )
{
    echo "<h3>Horario de profesor: <i>". $nombre_profesor . "</i></h3>";
    echo "<table>";
    for ($dia = 0; count($DIAS_SEMANA); $dia++){
        echo "<tr>";
        echo "<th>".$dia < $DIAS_SEMANA[$dia]."</th>";

        for ($hora = 0; $hora < count($HORAS_SEMANA) ; $hora++){
            if ($hora == 0){
                echo "<td>". $HORAS_SEMANA[$fila]."</td>";
            }  else if ($hora==1 && $dia==3) {
                    echo "<td colspan='5'>Recreo</td>";
            } else if($dia!=3) {
                echo "<td>";
                if (isset($horario[$dia][$hora]))
                
                echo "<form action='index.php' method='post'><input type='hidden' value='".$nombre_profesor."' name='nomProfesor'><input type='hidden' value='".$fila."' name='hora'><input type='hidden' value='".$col."' name='dia'><button class='enlace' type='submit' name='btnEditar'>Editar</button></form>";
                echo "</td>";

            } 
        }            
        echo "</tr>";
    }
   
    echo "<table>";

} else {
    echo "<p>Este usuario ya no está registrado en la BD</p>";
}
?>
