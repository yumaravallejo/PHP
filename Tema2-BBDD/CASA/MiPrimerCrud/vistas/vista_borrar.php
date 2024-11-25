<?php
if ($n_tupla > 0) {

echo "<p>Se dispone usted a borrar al usuario <strong>".$tupla['nombre']."</strong></p>

<form method='post' action='index.php'>
<p>
    <button type='submit' name='btnContBorrar' value=''>Continuar</button>
    <button type='submit'>Atrás</button> 
</p>";

echo "</form>";

}
?>