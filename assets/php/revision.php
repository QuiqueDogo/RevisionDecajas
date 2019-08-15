<?php
include 'conexiones.php';
$todo = array();
//cabeceras de lo que voy a traer
$pregunta = array("ID","FECHA", "TELEFONO", "AGENTE");
$bdKantar = $_REQUEST['base'];
$estudioKantar = array($_REQUEST['estudio'],$_REQUEST['base']);
//preguntas
$consultaPreguntas = "SELECT concat(idpregunta, '_', idreactivo) as pregunta from {$bdKantar}.preguntas where modo in ('AREA')";
$queryPreguntas = mysql_query($consultaPreguntas, $conexion_69);

//dbv -- Aqui armamos la consulta y hacemos cabeceras de las preguntas
$consultaBDV = "SELECT id, fecha, telefono, agente, ";
while($preguntas = mysql_fetch_assoc($queryPreguntas)){
    $consultaBDV .= $preguntas['pregunta'].","; 
    array_push($pregunta,$preguntas['pregunta']);
}
//quitamos la ultima coma
$consultaBDV = substr($consultaBDV, 0 ,-1);
$consultaBDV .= " from {$bdKantar}.bdv where audio = 'si' and hora_revision is null order by rand() limit 10";

//agregamos las ultimas cabeceras
array_push($pregunta,'STATUS','','Audios .8','Audios .5');

$sql = mysql_query($consultaBDV, $conexion_69);
$arreglin = array();

//Metemos el estudio a imprimir, y las cabeceras
array_push($arreglin,$estudioKantar,$pregunta);

//todo
while($DataKantar = mysql_fetch_row($sql)) {
    $arreglin[] = $DataKantar;
}

echo json_encode($arreglin,JSON_UNESCAPED_UNICODE);
?>