<h1>Listado de los usuarios</h1>
<table>
    <tr>
        <th>Nombre de Usuario</th>
        <th>Borrar</th>
        <th>Editar</th>
    </tr>
    <?php
    while ($tupla = mysqli_fetch_assoc($usuarios)) {
        echo "<tr>";
        echo "<td><form method='post' action='index.php'><button type='submit' name='btnDetalles' value='" . $tupla['id_usuario'] . "' class='enlace'>" . $tupla['nombre'] . "</button></form></td>";
        echo "<td><form method='post' action='index.php'><button type='submit' name='btnBorrar' value='" . $tupla['id_usuario'] . "' class='enlace'>BORRAR</button></form></td>";
        echo "<td><form method='post' action='index.php'><button type='submit' name='btnEditar' value='" . $tupla['id_usuario'] . "' class='enlace'>EDITAR</button></form></td>";
        echo "</tr>";
    }
    ?>
</table>
<form method="post" action="index.php">
    <p><button type="submit" name="btnInsertar">Insertar nuevo usuario</button></p>
</form>