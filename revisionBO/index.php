<?php
include 'assets/php/conexiones.php';
$consultasCuestionarios = "SELECT nombre, base from audios_listado.kantar_estudios_app";
$queryCuestionarios = mysql_query($consultasCuestionarios, $conexion40);
$idEmpleado = $_SESSION['idEmpleado'];
if ($idEmpleado == '') {
    header ("Location: http://172.30.27.40:8080/sialcom/index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/master.css">
    <title>Revisión BO</title>
</head>

<body>
    <div class="container">
        <table class="tablas">
            <thead>
                <th>Cuestionario</th>
                <th></th>
            </thead>
            <tbody>
                <?php
                    while ($basesKantar = mysql_fetch_assoc($queryCuestionarios)) {                        
                    ?>
                <tr>
                    <td><?php echo $basesKantar['nombre']; ?></td>
                    <td> <button class="" onclick="vamonosdeAqui()"> Consultar </button> </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>