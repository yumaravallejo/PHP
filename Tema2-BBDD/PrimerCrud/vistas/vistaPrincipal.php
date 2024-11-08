<?php
    echo '<table>';
    echo '<tr>';
    echo '<th>Nombre</th><th>Borrar</th><th>Editar</th>';
    echo '</tr>';
    while ($tupla = mysqli_fetch_assoc($datos_usuarios)) {
        echo '<tr><td>
                <form action="index.php" method="post">
                    <button class="enlace" title="Ver Detalles" type="submit" name="btnDetalles" value="' . $tupla["cod_user"] . '">' . $tupla['nombre'] . '</button>
                </form>
            </td>
            <td>
                <form action="index.php" method="post">
                    <button class="enlace" type="submit" name="btnBorrar" value="' . $tupla["cod_user"] . '">
                    <img width="30px" src="images/borrar.jpg" title="Borrar usuario" alt="Borrar" width="50px">
                    </button>
                </form>
            </td>
            <td>
                <form action="index.php" method="post">
                    <button class="enlace" type="submit" name="btnEditar" value="' . $tupla["cod_user"] . '">
                    <img width="30px" src="images/editar2.png" title="Editar usuario" alt="Borrar" width="50px">
                    </button>
                </form>
        </td></tr>
        ';
    }
    echo '<tr>
            <td colspan="3">
            <form action="index.php" method="post">
                <button class="enlace" type="submit" name="btnAgregar">Agregar Usuario</button>
            </form>
            </td>
            
        </tr>';
    echo '</table>';

    mysqli_free_result($datos_usuarios);
?>