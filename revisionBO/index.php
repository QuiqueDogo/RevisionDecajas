<?php include 'assets/php/conexiones.php';
$empleado=$_SESSION['idEmpleado'];
if ($empleado == '') {
    header ("Location: http://172.30.27.40:8080/sialcom/index.php");
}
$consultasCuestionarios = "SELECT nombre, base from audios_listado.kantar_estudios_app";
$queryCuestionarios = mysql_query($consultasCuestionarios, $conexion40);

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Revision BO</title>

    <script src="assets/js/masterin.js" async defer></script>
</head>

<body>
    <table>
        <?php 
    while ($cosaspendas = mysql_fetch_assoc($queryCuestionarios)) {
        echo $cosaspendas['nombre'];
        echo $cosaspendas['base'];
    }
    ?>

    </table>

</body>

</html>