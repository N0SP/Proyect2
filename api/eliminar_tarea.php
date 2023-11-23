<?php
require_once('../class/functions.php');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: http://localhost');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Content-Type');
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    try {
        $data = json_decode(file_get_contents("php://input"));

        // Obtener la ID de los datos JSON
        $id = $data->id ?? null;

        if ($id !== null) {
            $obj_funciones = new funciones();
            
            $resultado = $obj_funciones->borrar_tarea($id);

            if ($resultado) {
                http_response_code(200);
                echo json_encode(array("success" => true, "message" => "Tarea eliminada con éxito"));
            } else {
                http_response_code(500);
                echo json_encode(array("success" => false, "message" => "No se pudo eliminar la tarea"));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("success" => false, "message" => "Falta el parámetro 'id' en la solicitud"));
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(array("success" => false, "message" => "Error en el servidor: " . $e->getMessage()));
    }
} else {
    http_response_code(405); 
    echo json_encode(array("success" => false, "message" => "Método no permitido"));
}
?>