<?php
header('Content-Type: application/json');

require_once('../class/functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['termino'])) {
    try {
        $obj_funciones = new funciones();
        $termino = $_POST['termino'];
        $tareas = $obj_funciones->buscar_tareas($termino);

        if ($tareas !== false) {
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
    http_response_code(400); 
    echo json_encode(array("message" => "Parámetros de búsqueda incorrectos"));
}
?>

