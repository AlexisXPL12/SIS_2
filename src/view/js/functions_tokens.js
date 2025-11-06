// Función para listar todos los tokens
async function listarTokens() {
    try {
        const formData = new FormData();
        formData.append('sesion', session_session);
        formData.append('token', token_token);

        let respuesta = await fetch(base_url_server + 'src/control/Tokens.php?tipo=listar_tokens', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        let json = await respuesta.json();

        if (json.status) {
            let datos = json.contenido;
            let tabla = `
                <table class="table dt-responsive" width="100%">
                    <thead>
                        <tr>
                            <th>Token</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="contenido_tabla">
                    </tbody>
                </table>
            `;
            document.getElementById('tablas').innerHTML = tabla;
            document.querySelector('#modals_editar').innerHTML = '';

            datos.forEach(item => {
                generarFilaToken(item);
            });
        } else {
            document.getElementById('tablas').innerHTML = 'No se encontraron tokens';
        }
    } catch (e) {
        console.log("Error al cargar tokens: " + e);
    }
}

// Función para generar una fila en la tabla
function generarFilaToken(item) {
    let nueva_fila = document.createElement("tr");
    nueva_fila.id = "fila" + item.id;
    nueva_fila.className = "filas_tabla";
    nueva_fila.innerHTML = `
        <td>${item.token}</td>
        <td>
            <button class="btn btn-warning waves-effect waves-light" data-toggle="modal" data-target=".modal_editar${item.id}">
                <i class="fa fa-edit"></i>
            </button>
        </td>
    `;
    document.querySelector('#contenido_tabla').appendChild(nueva_fila);
    
    // Modal para editar token
    document.querySelector('#modals_editar').innerHTML += `
        <div class="modal fade modal_editar${item.id}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Actualizar Token</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <form class="form-horizontal" id="frmActualizar${item.id}">
                                <div class="form-group row mb-2">
                                    <label for="token${item.id}" class="col-3 col-form-label">Token</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="token${item.id}" name="token" value="${item.token}">
                                    </div>
                                </div>
                                <div class="form-group mb-0 justify-content-end row text-center">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-light waves-effect waves-light" data-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-success waves-effect waves-light" onclick="actualizarToken(${item.id})">Actualizar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}

// Función para actualizar un token
async function actualizarToken(id) {
    let nuevoToken = document.getElementById('token' + id).value;
    if (!nuevoToken) {
        Swal.fire({
            type: 'error',
            title: 'Error',
            text: 'El token no puede estar vacío',
            confirmButtonClass: 'btn btn-confirm mt-2',
            footer: ''
        });
        return;
    }

    const formData = new FormData();
    formData.append('id', id);
    formData.append('nuevo_token', nuevoToken);
    formData.append('sesion', session_session);
    formData.append('token', token_token);

    try {
        let respuesta = await fetch(base_url_server + 'src/control/Tokens.php?tipo=actualizar_token', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        let json = await respuesta.json();

        if (json.status) {
            Swal.fire({
                type: 'success',
                title: 'Actualizado',
                text: json.mensaje,
                confirmButtonClass: 'btn btn-confirm mt-2',
                footer: ''
            });
            $('.modal_editar' + id).modal('hide');
            listarTokens(); // Refrescar la tabla
        } else {
            Swal.fire({
                type: 'error',
                title: 'Error',
                text: json.mensaje,
                confirmButtonClass: 'btn btn-confirm mt-2',
                footer: ''
            });
        }
    } catch (e) {
        console.log("Error al actualizar token: " + e);
    }
}

// Función para generar un nuevo token
async function generarNuevoToken() {
    const formData = new FormData();
    formData.append('sesion', session_session);
    formData.append('token', token_token);

    try {
        let respuesta = await fetch(base_url_server + 'src/control/Tokens.php?tipo=generar_token', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        let json = await respuesta.json();

        if (json.status) {
            Swal.fire({
                type: 'success',
                title: 'Generado',
                text: 'Nuevo token generado: ' + json.token,
                confirmButtonClass: 'btn btn-confirm mt-2',
                footer: ''
            });
            listarTokens(); // Refrescar la tabla
        }
    } catch (e) {
        console.log("Error al generar token: " + e);
    }
}
