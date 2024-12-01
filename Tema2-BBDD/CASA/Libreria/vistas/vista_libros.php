<h2>Listado de libros</h2>
<ol>
    <?php
        while ($t_libro = mysqli_fetch_assoc($libros)) {
            echo "<li>";
            echo "<img src='img/".$t_libro['portada']."'>";
            echo "<p>".$t_libro['titulo']." - ".$t_libro['precio']."</p>";
            echo "</li>";
        }
    ?>
</ol>
