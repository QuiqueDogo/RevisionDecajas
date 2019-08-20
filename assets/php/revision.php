<?php
//falta agregar las perras condiciones de las perras preguntas, don pendejo se le olvido, las condiciones de los funciones  no lo traemos en la funciones
include 'conexiones.php';
include 'funciones.php';

$todo = array();
//cabeceras de lo que voy a traer
$pregunta = array("ID","FECHA", "TELEFONO", "AGENTE");
$bdKantar = $_REQUEST['base'];
$nombreKantar = $_REQUEST['estudio'];
$estudioKantar = array($_REQUEST['estudio'],$_REQUEST['base']);

//preguntas
$consultaPreguntas = "SELECT concat(idpregunta, '_', idreactivo) as pregunta from {$bdKantar}.preguntas where modo in ('AREA')";
$queryPreguntas = mysql_query($consultaPreguntas, $conexion_69);

//dbv -- Aqui armamos la consulta y hacemos cabeceras de las preguntas
$consultaBDV = "SELECT B.id, B.fecha, B.telefono, B.agente, ";
while($preguntas = mysql_fetch_assoc($queryPreguntas)){
    $consultaBDV .= $preguntas['pregunta'].","; 
    array_push($pregunta,$preguntas['pregunta']);
}

//quitamos la ultima coma
$consultaBDV = substr($consultaBDV, 0 ,-1);

//agremamos lo que falta y hacemos el inner join con base cliente 
$consultaBDV .= " from {$bdKantar}.bdv B inner join {$bdKantar}.basecliente A on B.telefono = A.TELEPHONENUMBER where ";

//traemos los parametros definidos para cada estudio para tomar como completadas
$consultaBDV .= traerCondicion($nombreKantar);
//nada mas agregamos las ultima condicion para poder manejar por los status que querian
$consultaBDV .= " and statusRevision is null order by rand() limit 20";

//agregamos las ultimas cabeceras
array_push($pregunta,'STATUS','','Audios .8','Audios .5');

$sql = mysql_query($consultaBDV, $conexion_69);
$arreglin = array();

//Metemos el estudio a imprimir, y las cabeceras
array_push($arreglin,$estudioKantar,$pregunta);

// ejecutamos la consulta en un whilw y que esto meta todo al arreglin principal
while($DataKantar = mysql_fetch_row($sql)) {
       $arreglin[] = $DataKantar;
    }
    
echo json_encode($arreglin,JSON_UNESCAPED_UNICODE);

    ?>