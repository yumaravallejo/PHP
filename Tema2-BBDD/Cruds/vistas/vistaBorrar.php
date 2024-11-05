<?php
if (mysqli_num_rows($detalle_usuario) > 0) {
            $tupla_detalles = mysqli_fetch_assoc($detalle_usuario);

            echo "<p>";
            echo "¿Está seguro de Borrar al usuario <strong>" . $tupla_detalles['nombre'] . "</strong> de la base de datos?";
            echo "</p>";
            echo "<form action='index.php' method='post'><button type='submit' name='btnBorrarDefinitivamente' value='" . $tupla_detalles['cod_user'] . "'>Aceptar</button>";
            echo "<button type='submit' name='btnCancelar' value='" . $tupla_detalles['nombre'] . "'>Cancelar</button></form>";
        } else {
            echo "<p>El usuario ya no se encuentra registrado en la base de datos</p>";
        }
        mysqli_free_result($detalle_usuario);
?>