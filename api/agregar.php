<?php
require_once('../class/functions.php');
header('Content-Type: application/json');

header('Access-Control-Allow-Origin: http://localhost');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    http_response_code(405);
    echo json_encode(array("message" => "Método no permitido."));
    exit;
}

$obj_funciones = new funciones();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha_compromiso = $_POST['fecha_compromiso'];
    $responsable = $_POST['responsable'];
    $tipo_tarea = $_POST['tipo_tarea'];
    $editado = 'no'; 
    $estado = 'pendiente'; 

    if ($obj_funciones->agregar_tarea($titulo, $descripcion, $fecha_compromiso, $editado, $responsable, $tipo_tarea, $estado)) {
        http_response_code(201); 
        echo json_encode(array("message" => "Tarea agregada con éxito."));
    } else {
        http_response_code(500); 
        echo json_encode(array("message" => "Error al agregar la tarea."));
    }
} else {
    http_response_code(405); 
    echo json_encode(array("success" => false, "message" => "Método no permitido."));
}
?>
