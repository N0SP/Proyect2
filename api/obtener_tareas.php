<?php
header('Content-Type: application/json');

require_once('../class/functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $obj_funciones = new funciones();
        $tareas = $obj_funciones->obtener_tareas();

        if ($tareas) {
            http_response_code(200);
            echo json_encode($tareas);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "No se encontraron tareas"));
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(array("message" => "Error en el servidor: " . $e->getMessage()));
    }
} else {
    http_response_code(405);
    echo json_encode(array("message" => "Método no permitido"));
}
?>
