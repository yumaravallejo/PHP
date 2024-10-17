<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mi primera web</title>
        <!-- HOJA DE ESTILO -->
        <link rel="stylesheet" href="">
        <!-- FAVICON -->
        <link rel="shortcut-icon" href=""> 
    </head>
<header>
<!-- Este hueco lo dejaremos guardado para la cabecera de la página -->
</header>
<body>

<!-- Este hueco lo dejaremos guardado para el cuerpo de la página -->

    <!-- <h1>Mi primera Web</h1> -->

    <?php //Estas etiquetas formalizarán que aquí se ejecute el código PHP

        //Para escribir por pantalla usaremos echo "";
        //Dentro de las comillas podemos escribir código HTML que este interpretará de manera automática como HTML
        echo "<h1>Mi primera web PHP</h1>";

        //Variables y su uso --> creación con $
        $titulo1 ="Comenzamos el";

        //Concatenación de varibales o texto --> usaremos .
        $ttulo2 = "curso";
        echo "<h2>".$titulo1." ".$ttulo2."</h2>";

        //Operaciones con variables
        $a=1;
        $b=3;
        //$c = $a + $b

        echo "El resultado de sumar $a y $b es ".($a+$b)."";

        //isset($p); comprueba si existe y devuelve true o false
        // para el if podemos ponerle $$, ||
        // un = solo asigna para comparar usaremos el ==
        //Los paréntesis son muy importantes
        if(isset($p) && (5==5 || 7>=8)){
            $c=$p+$a;
        } else {
            $c=$a;
        }

        //Con condiciones y bucles las que solo tienen una sentencia
        // no necesitan llaves de apertura y cierre

        echo "<p>El valor de c es ".$c."</p>";

        //Con bucle for
        for ($i=0;$i<5;$i++) {
            echo "<p>".$i."</p>";
        }

        echo "<p>EL valor de i puede seguir fuera del bucle ".$i."</p>";

        //Con bucle while
        $i=0; //reasignamos el valor de 0, para este tipo de bucle hay que asignar la variable fuera del bucle

        while ($i<5) {
            echo "<p>".$i."</p>";
            $i++;
        }

    //Etiqueta de cierre
    ?> 

</body>
<footer>
    <!-- Este hueco lo dejaremos guardado para el pie de la página -->
</footer>
</html>