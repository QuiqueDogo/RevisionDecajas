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
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Revisión Cuestionarios</title>
    <script src="assets/js/main.js" async defer></script>
</head>

<body>
    <input type="hidden" value="<?php echo $idEmpleado;?>">
    <a href="./revisionBO">Revision Bo</a>
    <div class="container">
        <div class="form">
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
                        <td> <button class=""
                                onclick="traerData('<?php echo $basesKantar['base']; ?>','<?php echo $basesKantar['nombre']; ?>')">Revisar </button> </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="frame"></div>
    </div>
        <div class="cuestionario"></div>
        <div id="reactivos">
            <table class="tablas">
                <thead id="titulosColum"></thead>
                <tbody id="datosColum"></tbody>
            </table>
    </div>
</body>

</html>

