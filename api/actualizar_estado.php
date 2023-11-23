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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $data = json_decode(file_get_contents("php://input"));

        $id = $data->id ?? null;
        $nuevoEstado = $data->estado ?? null;

        if ($id !== null && $nuevoEstado !== null) {
            $obj_funciones = new funciones();
            $resultado = $obj_funciones->actualizar_estado($id, $nuevoEstado);

            if ($resultado) {
                http_response_code(200);
                echo json_encode(array("success" => true, "message" => "Estado actualizado con éxito"));
            } else {
                http_response_code(500);
                echo json_encode(array("success" => false, "message" => "No se pudo actualizar el estado"));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("success" => false, "message" => "Falta el parámetro 'id' o 'estado' en la solicitud"));
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(array("success" => false, "message" => "Error en el servidor: " . $e->getMessage()));
        error_log($e->getMessage());
    }
} else {
    http_response_code(405); 
    echo json_encode(array("success" => false, "message" => "Método no permitido"));
}

?>
