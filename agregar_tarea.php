<?php require_once('class/navbar.php'); ?>
<div class="container mt-5">
    <div id="response-message" style="color: green;"></div>
    <h1>Agregar Tarea</h1>
    <form id="agregar-form" method="POST">
        <div class="form-group">
            <input type="text" class="form-control" name="titulo" placeholder="Título" required> <br>
        </div>
        <div class="form-group">
            <textarea class="form-control" name="descripcion" placeholder="Descripción" required></textarea> <br>
        </div>
        <div class="form-group">
            <input type="date" class="form-control" name="fecha_compromiso" required> <br>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="responsable" placeholder="Responsable" required> <br>
        </div>
        <div class="form-group">
            <select class="form-control" name="tipo_tarea">
                <option value="hogar">Hogar</option>
                <option value="trabajo">Trabajo</option>
                <option value="escuela">Escuela</option>
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
