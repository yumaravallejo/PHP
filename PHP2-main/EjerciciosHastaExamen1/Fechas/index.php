<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría fechas</title>
</head>

<body>
    <h1>Teoría de fechas</h1>
    <p><?php echo time(); ?></p>
    <p><?php echo date('d/m/Y h:i:s'); ?></p>
    <?php
    if (checkdate(2, 29, 2023)) {
        echo "<p>Fecha buena</p>";
    } else {
        echo "<p>Fecha mala</p>";
    }
    ?>
    <!-- mktime(hora, minutosm segundos, mes, dia, año) -->
    <p><?php echo mktime(0, 0, 0, 9, 23, 1976); ?></p>
    <p><?php echo date('d/m/Y', mktime(0, 0, 0, 9, 23, 1976)); ?></p>
    <p><?php echo strtotime('09/23/1976'); ?></p>
    <p><?php echo date('d/m/Y', strtotime('09/23/1976')); ?></p>

    <!-- Trunca -->
    <p><?php echo floor(6.5); ?></p>
    <!-- Redondea hacia arriba -->
    <p><?php echo ceil(6.5); ?></p>
    <!-- Valor absoluto -->
    <p><?php echo abs(-8); ?></p>

    <?php
    // Redondea a 2 decimales
    printf("%2f", 5.6666 * 7.8888);

    echo sprintf("%2f", 5.6666 * 7.8888);

    for ($i = 1; $i <= 20; $i++) {
        if ($i < 10) {
            echo "<p>0" . $i . "</p>";
        } else {
            echo "<p>" . $i . "</p>";
        }
    }

    for ($i = 1; $i <= 20; $i++) {
        echo "<p>" . sprintf('%02d', $i) . "</p>";
    }

    ?>
</body>

</html>