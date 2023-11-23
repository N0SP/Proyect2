<?php
require_once('class/navbar.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<h1 class="mt-5">Lista de Tareas</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Fecha</th>
            <th>Editada</th>
            <th>Responsable</th>
            <th>Clasificación</th>
            <th>Estado</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
$url = 'https://flyers-esports.com/api/obtener_tareas.php';
$tareas = json_decode(file_get_contents($url), true);

        foreach ($tareas as $tarea) {
            $estado = $tarea['estado'];
            $claseBoton = '';
            switch ($estado) {
                case 'pendiente':
                    $claseBoton = 'btn-warning';
                    break;
                case 'completa':
                    $claseBoton = 'btn-success';
                    break;
                case 'en_proceso':
                    $claseBoton = 'btn-danger';
                    break;
            }
        
            echo "<tr>";
            echo "<td>{$tarea['titulo']}</td>";
            echo "<td>{$tarea['descripcion']}</td>";
            echo "<td>{$tarea['fecha_compromiso']}</td>";
            echo "<td>{$tarea['editada']}</td>";
            echo "<td>{$tarea['responsable']}</td>";
            echo "<td>{$tarea['tipo_tarea']}</td>";
            echo "<td>";
            echo '<button class="btn btn-sm estado-btn ' . $claseBoton . '" data-id="' . $tarea['id'] . '" data-estado="' . $tarea['estado'] . '" onclick="actualizarEstado(this)">' . $tarea['estado'] . '</button>';
            echo "</td>";
            echo "<td>";
            echo "<button class='btn btn-danger btn-sm' data-id='{$tarea['id']}' onclick='eliminarTarea(this)'>Eliminar</button>";
            echo "<button class='btn btn-primary btn-sm' data-toggle='modal' data-target='#modalEditar{$tarea['id']}'>Editar</button>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<?php foreach ($tareas as $tarea) : ?>
    <div class="modal fade" id="modalEditar<?php echo $tarea['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarLabel">Editar Tarea</h5>
                    <div id="response-message" style="color: green;"></div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form id="modalEditarForm" method="post">
                    <input type="hidden" name="tarea_id" value="<?php echo $tarea['id']; ?>">
                        <div class="form-group">
                            <input type="text" class="form-control" name="titulo" placeholder="Título" value="<?php echo $tarea['titulo']; ?>" required> <br>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="descripcion" placeholder="Descripción" required><?php echo $tarea['descripcion']; ?></textarea> <br>
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" name="fecha_compromiso" value="<?php echo $tarea['fecha_compromiso']; ?>" required> <br>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="responsable" placeholder="Responsable" value="<?php echo $tarea['responsable']; ?>" required> <br>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="tipo_tarea">
                                <option value="hogar" <?php if($tarea['tipo_tarea'] == 'hogar') echo 'selected'; ?>>Hogar</option>
                                <option value="trabajo" <?php if($tarea['tipo_tarea'] == 'trabajo') echo 'selected'; ?>>Trabajo</option>
                                <option value="escuela" <?php if($tarea['tipo_tarea'] == 'escuela') echo 'selected'; ?>>Escuela</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="estado_id" placeholder="Estado" value="<?php echo $tarea['estado']; ?>" required> <br>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>