<?php

// Controlamos errores
if (isset($_POST['convertir'])) {
    $texto = trim($_POST["texto"]);
    $error_form = $texto == "";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7</title>
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
        <form action="ejercicio7.php" method="post">
            <h2 class="centro">Unifica separador decimal - Formulario</h2>
            <p>Escribe varios números separados por espacios y unificaré el separador decimal a puntos.</p>
            <p>
                <label for="texto">Números: </label>
                <textarea name="texto" id="texto"><?php if (isset($_POST["texto"])) echo $texto ?></textarea>
                <?php
                if (isset($_POST["convertir"]) && $error_form) {
                        echo "<span class = 'error'> Campo vacío </span>";
                }
                ?>
            </p>
            <p>
                <input type="submit" value="Convertir" name="convertir">
            </p>
        </form>
    </div>
    <?php
    if (isset($_POST["convertir"]) && !$error_form) {
        $respuesta = str_replace(',','.', $texto);
        
        
    ?>
        <br /><br />
        <div class="form verde">
            <h2 class="centro">Unifica separador decimal - Resultado</h2>
            <p>Números originales</p>
            <p><?php echo $texto ?></p>
            <p>Números corregidos</p>
            <p><?php echo $respuesta ?></p>
        </div>
    <?php

    }
    ?>

</body>

</html>