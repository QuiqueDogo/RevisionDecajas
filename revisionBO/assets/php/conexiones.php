<?php 
$conexion40 = mysql_connect('172.30.27.40','root','4LC0M');
mysql_set_charset('utf8', $conexion40);
session_start();
$empleado=$_SESSION['idEmpleado'];
if ($idEmpleado == '') {
    header ("Location: http://172.30.27.40:8080/sialcom/index.php");
}
if (mysql_errno()) { 
    die("No se puede conectar a la base de datos:" . mysql_error());
    }
    
//Consultas 40 
$consultasCuestionarios = "SELECT nombre, base from audios_listado.kantar_estudios_app";
$queryCuestionarios = mysql_query($consultasCuestionarios, $conexion40);


$conexion_69 = mysql_connect('127.0.0.1:3308','root','4lc0mAdm');
	mysql_set_charset('utf8', $conexion_69);
	if (mysql_errno()) { 
		die("No se puede conectar a la base de datos:" . mysql_error());
		}
?>
