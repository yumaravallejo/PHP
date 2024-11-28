<?php
if ($n_tuplas > 0 )
{
    echo "<table class='centrado'>";
            echo "<tr>";
            echo "<th></th>";
            for($i=0; $i<count(DIAS_SEMANA);$i++)
                echo "<th>".DIAS_SEMANA[$i]."</th>";
            echo "</tr>";

            for($hora=0;$hora<count(HORAS_SEMANA);$hora++)
            {
                echo "<tr>";
                echo "<th>".HORAS_SEMANA[$hora]."</th>";
                if($hora==3)
                {
                    echo "<td colspan='5'>RECREO</td>";
                }
                else
                {
                    for($dia=0;$dia<count(DIAS_SEMANA);$dia++)
                    {
                        echo "<td>";
                        if(isset($horario[$dia][$hora]))
                        {
                            echo $horario[$dia][$hora];
                        }
                        echo "<form action='index.php' method='post'>";
                        echo "<input type='hidden' name='dia' value='".$dia."'/>";
                        echo "<input type='hidden' name='hora' value='".$hora."'/>";
                        echo "<button class='enlace' name='btnEditar' type='submit'>Editar</button>";
                        echo "</form>";
                        echo "</td>";
                        
                    }
                }
                
                echo "</tr>";
            }
            echo "</table>";

} else {
    echo "<p>Este usuario ya no está registrado en la BD</p>";
}
?>