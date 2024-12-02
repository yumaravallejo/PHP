<?php

// Controlamos errores
if (isset($_POST['quitar'])) {
    $texto = trim($_POST["texto"]);
    $error_form = $texto == "";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
    <style>
        .form {
            border: solid;
            padding: 5px;
        }

        .celeste {
            background-color: lightblue;
        }

        .centro {
            text-align: center;
        }

        .error {
            color: red;
        }

        .verde {
            background-color: lightgreen;
        }
    </style>
</head>

<body>
    <div class="form celeste">
        <form action="ejercicio6.php" method="post">
            <h2 class="centro">Quita acentos - Formulario</h2>
            <p>Escribe un texto y le quitaré los acentos.</p>
            <p>
                <label for="texto">Texto: </label>
                <textarea name="texto" id="texto"><?php if (isset($_POST["texto"])) echo $texto ?></textarea>
                <?php
                if (isset($_POST["quitar"]) && $error_form) {
                        echo "<span class = 'error'> Campo vacío </span>";
                }
                ?>
            </p>
            <p>
                <input type="submit" value="Quitar acentos" name="quitar">
            </p>
        </form>
    </div>
    <?php
    if (isset($_POST["quitar"]) && !$error_form) {
        $respuesta = str_replace(array('á', 'é', 'í','ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú'), 
        array('a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'), $texto);
        
        
    ?>
        <br /><br />
        <div class="form verde">
            <h2 class="centro">Quita acentos - Resultado</h2>
            <p>Texto original</p>
            <p><?php echo $texto ?></p>
            <p>Texto sin acentos</p>
            <p><?php echo $respuesta ?></p>
        </div>
    <?php

    }
    ?>

</body>

</html>