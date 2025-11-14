// Función para listar el token
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

        const textoRespuesta = await respuesta.text();
        let json;
        
        try {
            json = JSON.parse(textoRespuesta);
        } catch (e) {
            throw new Error('Respuesta inválida del servidor');
        }

        if (json.status && json.contenido.length > 0) {
            let item = json.contenido[0];
            let tabla = `
                <table class="table dt-responsive" width="100%">
                    <thead>
                        <tr>
                            <th>Token API</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="contenido_tabla">
                        <tr class="filas_tabla">
                            <td>${item.token}</td>
                            <td>
                                <button class="btn btn-warning waves-effect waves-light" onclick="abrirModalEditar('${item.token}')">
                                    <i class="fa fa-edit"></i> Editar
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            `;
            document.getElementById('tablas').innerHTML = tabla;
        } else {
            document.getElementById('tablas').innerHTML = `
                <div class="alert alert-info">
                    No hay token configurado.
                    <button class="btn btn-primary ml-2" onclick="crearPrimerToken()">
                        <i class="fa fa-plus"></i> Crear Token
                    </button>
                </div>
            `;
        }
    } catch (e) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error al cargar el token: ' + e.message,
            customClass: {
                confirmButton: 'btn btn-danger mt-2'
            }
        });
    }
}

// Función para abrir modal de edición
function abrirModalEditar(tokenActual) {
    Swal.fire({
        title: 'Actualizar Token API',
        html: `
            <div class="form-group text-left">
                <label for="swal-input-token">Nuevo Token API:</label>
                <input type="text" id="swal-input-token" class="form-control" value="${tokenActual}" placeholder="Ingrese el nuevo token">
                <small class="form-text text-muted">El token debe tener al menos 10 caracteres</small>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Actualizar',
        cancelButtonText: 'Cancelar',
        customClass: {
            confirmButton: 'btn btn-success mt-2',
            cancelButton: 'btn btn-secondary mt-2'
        },
        buttonsStyling: false,
        focusConfirm: false,
        preConfirm: () => {
            const nuevoToken = document.getElementById('swal-input-token').value.trim();
            
            if (!nuevoToken) {
                Swal.showValidationMessage('El token no puede estar vacío');
                return false;
            }
            if (nuevoToken.length < 10) {
                Swal.showValidationMessage('El token debe tener al menos 10 caracteres');
                return false;
            }
            return nuevoToken;
        }
    }).then((result) => {
        // Para versiones antiguas de SweetAlert2, si tiene 'value' significa que se confirmó
        if (result.value !== undefined && result.value !== null) {
            actualizarToken(result.value);
        } else if (result.isConfirmed) {
            actualizarToken(result.value);
        }
    });
}

// Función para actualizar el token
async function actualizarToken(nuevoToken) {
    if (!nuevoToken) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El token no puede estar vacío',
            customClass: {
                confirmButton: 'btn btn-danger mt-2'
            }
        });
        return;
    }

    // Mostrar loading (compatible con versiones antiguas)
    Swal.fire({
        title: 'Actualizando...',
        text: 'Por favor espere',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        onOpen: () => {
            Swal.showLoading();
        }
    });

    const formData = new FormData();
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

        const textoRespuesta = await respuesta.text();
        let json;
        
        try {
            json = JSON.parse(textoRespuesta);
        } catch (e) {
            Swal.fire({
                icon: 'error',
                title: 'Error del Servidor',
                text: 'La respuesta del servidor no es válida',
                customClass: {
                    confirmButton: 'btn btn-danger mt-2'
                }
            });
            return;
        }

        if (json.status) {
            Swal.fire({
                icon: 'success',
                title: '¡Actualizado!',
                text: json.mensaje || 'Token actualizado correctamente',
                customClass: {
                    confirmButton: 'btn btn-success mt-2'
                }
            }).then(() => {
                listarTokens();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: json.mensaje || 'Error al actualizar el token',
                customClass: {
                    confirmButton: 'btn btn-danger mt-2'
                }
            });
        }
    } catch (e) {
        Swal.fire({
            icon: 'error',
            title: 'Error de Conexión',
            text: 'No se pudo conectar con el servidor',
            customClass: {
                confirmButton: 'btn btn-danger mt-2'
            }
        });
    }
}

// Función para crear primer token
function crearPrimerToken() {
    Swal.fire({
        title: 'Crear Token API',
        html: `
            <div class="form-group text-left">
                <label for="swal-input-token">Token API:</label>
                <input type="text" id="swal-input-token" class="form-control" placeholder="Ingrese el token">
                <small class="form-text text-muted">El token debe ser único y seguro (mínimo 10 caracteres)</small>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Crear',
        cancelButtonText: 'Cancelar',
        customClass: {
            confirmButton: 'btn btn-primary mt-2',
            cancelButton: 'btn btn-secondary mt-2'
        },
        buttonsStyling: false,
        preConfirm: () => {
            const token = document.getElementById('swal-input-token').value.trim();
            if (!token) {
                Swal.showValidationMessage('El token no puede estar vacío');
                return false;
            }
            if (token.length < 10) {
                Swal.showValidationMessage('El token debe tener al menos 10 caracteres');
                return false;
            }
            return token;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            insertarNuevoToken(result.value);
        } else if (result.value !== undefined && result.value !== null) {
            // Para versiones antiguas de SweetAlert2
            insertarNuevoToken(result.value);
        }
    });
}

// Función para insertar un nuevo token
async function insertarNuevoToken(nuevoToken) {
    if (!nuevoToken) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El token no puede estar vacío',
            customClass: {
                confirmButton: 'btn btn-danger mt-2'
            }
        });
        return;
    }

    // Mostrar loading (compatible con versiones antiguas)
    Swal.fire({
        title: 'Creando token...',
        text: 'Por favor espere',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        onOpen: () => {
            Swal.showLoading();
        }
    });

    const formData = new FormData();
    formData.append('nuevo_token', nuevoToken);
    formData.append('sesion', session_session);
    formData.append('token', token_token);

    try {
        let respuesta = await fetch(base_url_server + 'src/control/Tokens.php?tipo=insertar_token', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });

        const textoRespuesta = await respuesta.text();
        let json;
        
        try {
            json = JSON.parse(textoRespuesta);
        } catch (e) {
            Swal.fire({
                icon: 'error',
                title: 'Error del Servidor',
                text: 'Respuesta inválida del servidor',
                customClass: {
                    confirmButton: 'btn btn-danger mt-2'
                }
            });
            return;
        }

        if (json.status) {
            Swal.fire({
                icon: 'success',
                title: '¡Token Creado!',
                text: json.mensaje || 'Token creado correctamente',
                customClass: {
                    confirmButton: 'btn btn-success mt-2'
                }
            }).then(() => {
                listarTokens();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: json.mensaje || 'Error al crear el token',
                customClass: {
                    confirmButton: 'btn btn-danger mt-2'
                }
            });
        }
    } catch (e) {
        Swal.fire({
            icon: 'error',
            title: 'Error de Conexión',
            text: 'No se pudo conectar con el servidor',
            customClass: {
                confirmButton: 'btn btn-danger mt-2'
            }
        });
    }
}

// Inicializar al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    listarTokens();
});