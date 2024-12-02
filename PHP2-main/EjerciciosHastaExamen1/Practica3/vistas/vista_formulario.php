<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rellena tu CV</title>
    <style>
        .error{color: red}
    </style>
</head>
<body>
    <h1>Rellena tu CV</h1>
    <form name="f1" action="index.php" enctype="multipart/form-data" method="post">
        <p>
            <label for="nombre">Nombre</label> <br/>
            <input type="text" id="nombre" name="nombre" 
            value="<?php if(isset($_POST["nombre"])) { echo $_POST["nombre"];}?>"/> 
            <?php
                if (isset($_POST["enviar"]) && $error_nombre) {
                    echo "<span class='error'> Campo vacío</span>";
                } 
            ?>
        </p>

        <p>
            <label for="apellidos">Apellidos</label> <br/>
            <input type="text" id="apellidos" name="apellidos"
            value="<?php if(isset($_POST["apellidos"])) { echo $_POST["apellidos"];}?>"/> 
            <?php
                if (isset($_POST["enviar"]) && $error_apellidos) {
                    echo "<span class='error'> Campo vacío</span>";
                }
            ?>
        </p>

        <p>
        <label for="clave">Contraseña</label><br/>
        <input type="password" id="clave" name="clave"/> 
        <?php
            if (isset($_POST["enviar"]) && $error_clave) {
                echo "<span class='error'> Campo vacío</span>";
            }
            ?>
        </p>
        
        <p>
            <label>Sexo</label> 
            <?php
                if (isset($_POST["enviar"]) && $error_sexo) {
                    echo "<span class='error'> Debes seleccionar un sexo</span>";
                }
            ?>
            <br/>
            <input type="radio" id="hombre" name="sexo" value="hombre"
            <?php if(isset($_POST["sexo"]) && $_POST["sexo"] == "hombre") { echo " checked";} ?>/>
            <label for="hombre"> Hombre</label> <br/>

            <input type="radio" id="mujer" name="sexo" value="mujer"
            <?php if(isset($_POST["sexo"]) && $_POST["sexo"] == "mujer") { echo " checked"; } ?>/>
            <label for="mujer"> Mujer</label> 
        </p>
        
        <p>
            <label for="foto">Incluir mi foto: </label>
            <input type="file" name="foto" id="foto" accept="image/*"/>
        </p>        

        <p>
        <label for="nacido">Nacido en: </label>
        <select id="nacido" name="lugarNac">
            <option value="Málaga" 
            <?php if(isset($_POST["lugarNac"]) && $_POST["lugarNac"] == "Málaga") { echo " selected"; } ?>> Málaga </option>
            <option value="Sevilla" 
            <?php if(isset($_POST["lugarNac"]) && $_POST["lugarNac"] == "Sevilla") { echo " checked"; } ?>> Sevilla </option>
            <option value="Jaén"
            <?php if((isset($_POST["lugarNac"]) && $_POST["lugarNac"] == "Jaén") || !isset($_POST["lugarNac"])) 
                { echo " selected"; } ?>
            > Jaén </option>
        </select>
        </p>

        <p>
        <label for="comentario">Comentarios: </label>
        <textarea rows="5" colums="7" name="comentario" id="comentario"><?php if(isset($_POST["comentario"])) {echo $_POST["comentario"];} ?></textarea>
        <?php
                if (isset($_POST["enviar"]) && $error_comentarios) {
                    echo "<span class='error'> Campo vacío</span>";
                }
            ?>
        </p>

        <p>
            <input type="checkbox" id="novedades" value="novedades" name="novedades"/>
            <label for="novedades">Suscribirse al boletín de Novedades</label>
        </p>

        <p>
        <input type="submit" name="enviar" value="Guardar Cambios"/>
        <input type="submit" name="borrar" value="Borrar los datos introducidos"/>
        </p>
        

    </form>
    
</body>
</html>