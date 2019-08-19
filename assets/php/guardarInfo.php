<?php
include 'conexiones.php';
session_start();
$valores =array();
//valores que necesito
$base=$_REQUEST['base'];
$id=$_REQUEST['id'];
$statusConsulta = $_REQUEST['status'];
unset($_REQUEST['id'], $_REQUEST['base'], $_REQUEST['status']);
$consulta= "UPDATE {$base}.bdv SET statusRevision = '{$statusConsulta}', ";

//Poner todas las variables de las preguntas en la consulta con el valor del textarea 
foreach ($_REQUEST as $key => $value) {
    $consulta .= "{$key} = '{$value}',";
}
//eliminamos la coma al final y agregamos el id y las columnas que nos pidieron 
$consulta .= " hora_revision = CURRENT_TIMESTAMP(), quien_reviso = '{$_SESSION['idEmpleado']}' where id = '{$id}'";

mysql_query($consulta,$conexion_69);
if (mysql_errno()) { 
        echo json_encode("no se pudo ejecutar");
	}else{
        echo json_encode($consulta);
    }


