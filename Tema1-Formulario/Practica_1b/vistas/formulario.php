<body>
<h1>Rellena tu CV</h1>
        
        <form id="formulario" action="index.php" method="post" enctype="multipart/form-data">
            <p>
                <label for="nombre">Nombre</label> <br>
                <input type="text" name="nombre" id="nombre" value="<?php if(isset($_POST["nombre"])) echo $_POST["nombre"];?>">
            
            <?php
                if(isset($_POST["guardar"]) && $error_nombre) {
                    echo "<span class='error'>* Campo Vacío *</span>";
                }
            ?>
            </p>


            <p>
                <label for="apellidos">Apellidos</label><br>
                <input type="text" id="apellidos" name="apellidos" size="50px" value="<?php if(isset($_POST["apellidos"])) echo $_POST["apellidos"];?>">
            
            <?php
                if(isset($_POST["guardar"]) && $error_apellido) {
                    echo "<span class='error'>* Campo Vacío *</span>";
                }
            ?>
            </p>

            <p>
                <label for="contrasena">Contraseña</label><br>
                <input type="password" name="contrasena" id="contrasena" value="<?php if(isset($_POST["contrasena"])) echo $_POST["contrasena"];?>">
            
            <?php
                if(isset($_POST["guardar"]) && $error_clave) {
                    echo "<span class='error'>* Campo Vacío *</span>";
                }
            ?>
            </p>

            <p>
                <label for="dni">DNI</label><br>
                <input type="text" name="dni" id="dni" size="9" maxlength="9" value="<?php if(isset($_POST["dni"])) echo $_POST["dni"];?>">
            
            <?php
                if(isset($_POST["guardar"]) && $error_dni) {
                    echo "<span class='error'>* Campo Vacío *</span>";
                }
            ?>
            </p>

            <p>
                Sexo <br>
                <input type="radio" id="hombre" name="sexo" value="hombre"><label for="hombre">Hombre</label><br>
                <input type="radio" id="mujer" name="sexo" value="mujer"><label for="mujer">Mujer</label>
            
                <?php
                if(isset($_POST["guardar"]) && $error_sexo) {
                    echo "<span class='error'>* Debes elegir un sexo *</span>";
                }
            ?>
            </p>

            <p>
                <label for="foto">Incluir mi foto:</label>
                <input id="foto" type="file" name="foto" accept="image/png, image/jpeg, image/jpg"> <!-- accept="tipo que quiere que acepte" -->
            </p>

            <p>
                <label for="nacimiento">Nacido en:</label>
                <select name="nacimiento" id="nacimiento">
                    <option value="malaga">Málaga</option>
                    <option value="madrid">Madrid</option>
                    <option value="sevilla">Sevilla</option>
                    <option value="barcelona">Barcelona</option>
                    <option value="ojen">Ojén</option>
                </select>
            </p>

            <p>
                <label for="comentarios">Comentarios:</label>
                <textarea name="comentarios" id="comentarios" cols="50" rows="10"></textarea>
            </p>

            <p>
                <input type="checkbox" name="suscripcion" id="suscripcion" value="1">
                <label for="suscripcion">Subscribirse al boletín de Novedades</label>
            </p>

         <input type="submit" name="guardar" value="Guardar Cambios">
         <input type="reset" name="borrar" value="Borrar los datos introducidos">
        </form>
</body>