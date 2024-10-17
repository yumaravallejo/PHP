<h1>Esta es mi super página</h1>

    <form action="index.php" method="post"> 
    <!-- En este caso podríamos poner el que quisieramos get o post pero asegurate de poner $_POST o $_GET segun lo que escribas -->
     
        <p>
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre" value="<?php if(isset($_POST["nombre"])) echo $_POST["nombre"];?>"/>
            <?php
            if(isset($_POST["btnEnviar"]) && $error_nombre)
               echo "<span class='error'> * Campo obligatorio *</span>";
            ?>
         </p>

         <p>
            <label for="nacido">Nacido en: </label>
            <select name="nacido" id="nacido">
               <option <?php if(isset($_POST["nacido"]) && $_POST["nacido"]=="Málaga") echo "selected";?> value="Málaga">Málaga</option>
               <option <?php if(isset($_POST["nacido"]) && $_POST["nacido"]=="Almería") echo "selected";?> value="Almería">Almería</option>
               <option <?php if(isset($_POST["nacido"]) && $_POST["nacido"]=="Granada") echo "selected";?> value="Granada">Granada</option>
            </select>
         </p>

         <p>
            Sexo: 
            <label for="hombre">Hombre</label><input type="radio" name="sexo" id="hombre" <?php if(isset($_POST["sexo"]) && $_POST["sexo"]=="hombre") echo "checked";?> value="hombre"/>
            <label for="mujer">Mujer</label><input type="radio" name="sexo" id="mujer" <?php if(isset($_POST["sexo"]) && $_POST["sexo"]=="mujer") echo "checked";?> value="mujer"/>
            <?php
            if(isset($_POST["btnEnviar"])&& $error_sexo)
               echo "<span class='error'> * Campo obligatorio *</span>";
            ?>
         </p>

         <p>
            Aficiones:
            <label for="deportes">Deportes</label><input type="checkbox" name="aficiones[]" id="deportes" value="Deportes" <?php if(isset($_POST["aficiones"]) && contiene("Deportes", $_POST["aficiones"])=="true") echo "checked";?>/>
            <label for="lectura">Lectura</label><input type="checkbox" name="aficiones[]" id="lectura" value="Lectura" <?php if(isset($_POST["aficiones"]) && contiene("Lectura", $_POST["aficiones"])=="true") echo "checked";?>/>
            <label for="otros">Otros</label><input type="checkbox" name="aficiones[]" id="otros" value="Otros" <?php if(isset($_POST["aficiones"]) && contiene("Otros", $_POST["aficiones"])=="true") echo "checked";?>/>
        </p>

        <p>
            <label for="comentarios">Comentarios: </label>
            <textarea name="comentarios" id="comentarios" cols="40" rows="4"><?php if(isset($_POST["comentarios"])) echo $_POST["comentarios"];?></textarea>
            
            <!-- if(isset($_POST["btnEnviar"])&& $error_comentarios)
                    echo "<span class='error'> * Campo Vacío *</span>"; -->
        </p>

        <p>
            <input type="submit" value="Enviar" name="btnEnviar"/>  
         </p>

        
    </form>