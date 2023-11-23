function actualizarEstado(boton) {
    const id = boton.getAttribute('data-id');
    const estado = boton.getAttribute('data-estado');
    let nuevoEstado;

    if (estado === 'pendiente') {
        nuevoEstado = 'en_proceso';
    } else if (estado === 'en_proceso') {
        nuevoEstado = 'completa';
    } else if (estado === 'completa') {
        nuevoEstado = 'pendiente';
    }
    console.log('ID:', id);
    console.log('Estado actual:', estado);
    console.log('Nuevo estado:', nuevoEstado);

    fetch('https://flyers-esports.com/api/actualizar_estado.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id: id, estado: nuevoEstado }),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Error en la solicitud: ${response.statusText}`);
        }
        return response.json();
    })
    .then(data => {
        console.log(data);
        // Actualizar la interfaz de usuario según sea necesario
        if (data.success) {
            if (nuevoEstado === 'pendiente') {
                boton.classList.remove('btn-warning', 'btn-success', 'btn-danger');
                boton.classList.add('btn-danger');
            } else if (nuevoEstado === 'en_proceso') {
                boton.classList.remove('btn-warning', 'btn-success', 'btn-danger');
                boton.classList.add('btn-warning');
            } else if (nuevoEstado === 'completa') {
                boton.classList.remove('btn-warning', 'btn-success', 'btn-danger');
                boton.classList.add('btn-success');
            }
            boton.setAttribute('data-estado', nuevoEstado);
            boton.textContent = nuevoEstado;
        } else {
            console.error('Error en la respuesta:', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function eliminarTarea(boton) {
    const id = boton.getAttribute('data-id');
    console.log('ID:', id);

    fetch('https://flyers-esports.com/api/eliminar_tarea.php', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id: id }),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Error en la solicitud: ${response.statusText}`);
        }
        return response.json();
    })
    .then(data => {
        console.log(data.message);
        if (data.success) {
            boton.parentElement.parentElement.remove();
        } else {
            console.error('Error en la respuesta:', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function obtenerTareas() {
    fetch('https://flyers-esports.com/api/obtener_tareas.php', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Error en la solicitud: ${response.statusText}`);
        }
        return response.json();
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
//modal de editar
document.addEventListener("DOMContentLoaded", function () {
    const editarForm = document.getElementById("modalEditarForm");
    const agregarForm = document.getElementById("agregar-form");
    const actualizarEstado = document.getElementById("actualizar-estado");



    if (editarForm) {
        editarForm.addEventListener("submit", function (event) {
            event.preventDefault();

            const formData = new FormData(editarForm);
            console.log('Datos a enviar (Editar):', formData);

            fetch("https://flyers-esports.com/api/procesar_edicion.php", {
                method: "POST",
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Error en la solicitud: ${response.statusText}`);
                }
                return response.json();
            })
            .then(data => {
                console.log(data);

                if (data.success) {
                    const responseMessage = document.getElementById("response-message");
                    responseMessage.textContent = data.message;
                    window.location.reload();
                }

            })
            .catch(error => {
                console.error("Error:", error);
            });
        });
    }

    if (agregarForm) {
        agregarForm.addEventListener("submit", function (event) {
            event.preventDefault();

            const formData = new FormData(agregarForm);
            console.log('Datos a enviar (Agregar):', formData);

            fetch("https://flyers-esports.com/api/agregar.php", {
                method: "POST",
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Error en la solicitud: ${response.statusText}`);
                }
                return response.json();
            })
            .then(data => {
                console.log(data);

                const responseMessage = document.getElementById("response-message");

                if (data.success) {
                    responseMessage.textContent = data.message;
                    window.location.href = "/index";
                } else {
                    responseMessage.textContent = data.message;
                }
            })
            .catch(error => {
                console.error("Error:", error);
            });
        });
    }

});
