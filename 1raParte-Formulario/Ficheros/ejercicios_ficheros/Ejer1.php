<?php
    //Control de errores
    if (isset($_POST['enviar'])){
        $error_vacio = $_POST['numero'] == "";
        $error_num = $_POST['numero'] <1 || $_POST['numero'] >10;
        $errores_form = $error_vacio || $error_num;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
    <style>
    .formulario {
        background-color: lightblue;
        padding: 10px;
        border: 1px solid black;
    }
    
    .respuestas {
        background-color: lightgreen;
        padding: 10px;
        border: 1px solid black;
        margin-top: 10px;
    }

    .centrado {text-align:center;}
    .error {color:red;}

    </style>
</head>
<body>
    <?php
        // Realizar una web con un formulario que pida un número entero entre 1 y 10 y
        // guarde en una carpeta con nombre Tablas en un fichero con el nombre
        // tabla_n.txt la tabla de multiplicar de ese número, donde n es el número
        // introducido

    ?>
        <div class="formulario">
            <h1 class="centrado">Práctica con ficheros</h1>
            <form action="Ejer1.php" method="post">
                <p>
                    <label for="numero">Introduce un número entre el 1 y 10</label>
                    <input type="number" placeholder="Introduce un número" value="" name="numero" id="numero">
                    <?php
                        //Mensajes de errores
                        if (isset($_POST['enviar']) && $errores_form) {
                            if ($error_vacio) {
                                echo "<span class='error'>* Campo Vacío *</span>";
                            } else {
                                echo "<span class='error'>* Número no válido *</span>";
                            }
                        }
                    ?>
                </p>

                <button type="submit" name="enviar">Enviar</button>
            </form>
        

        <?php
        if (isset($_POST['enviar']) && !$errores_form){  
            $num_tabla = $_POST['numero'];
            $nombreCarpeta = 'Tablas';
            if (!file_exists($nombreCarpeta)) { //Verifica si existe primero
                // Crea la carpeta con permisos de lectura y escritura (0777)
                mkdir($nombreCarpeta, 0777, true); 
            }

            $nom_arch = $nombreCarpeta."/tabla_".$num_tabla.".txt";
            //Como ya tiene permisos dados, podremos introducir lo que necesitemos tanto en linux como en windows 
            @$archivo_tabla = fopen($nom_arch, "w") or die("Se produjo un error al crear el archivo");
            
            for ($i = 1; $i < 11; $i++) {
                $multiplicacion = $num_tabla * $i;
                $expresion = $num_tabla." x ".$i." = ".$multiplicacion;
                fwrite($archivo_tabla, PHP_EOL.$expresion);
            }
                move_uploaded_file($nom_arch, $nombreCarpeta);
                fclose($archivo_tabla);
            }
        echo "</div>";
        
        ?>
    
</body>
</html>