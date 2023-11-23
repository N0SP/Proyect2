

<?php
require_once('../class/functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        
        $tarea_id = $_POST['tarea_id'];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $fecha_compromiso = $_POST['fecha_compromiso'];
        $responsable = $_POST['responsable'];
        $tipo_tarea = $_POST['tipo_tarea'];
        $estado_id = $_POST['estado_id'];

        $obj_funciones = new funciones();
        $resultado = $obj_funciones->editar_tarea($tarea_id, $titulo, $descripcion, $fecha_compromiso, 'si', $responsable, $tipo_tarea, $estado_id);

        if ($resultado) {
            echo json_encode(array("success" => true, "message" => "Tarea actualizada con éxito"));
            exit();
        } else {
            throw new Exception("Error al actualizar la tarea");
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

