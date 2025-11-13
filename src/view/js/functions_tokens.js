
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
        let json = await respuesta.json();

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
        console.log("Error al cargar tokens: " + e);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error al cargar el token',
            confirmButtonClass: 'btn btn-confirm mt-2'
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
        confirmButtonClass: 'btn btn-success mt-2',
        cancelButtonClass: 'btn btn-secondary mt-2',
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-secondary'
        },
        buttonsStyling: false,
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
        if (result.isConfirmed) {
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
            confirmButtonClass: 'btn btn-confirm mt-2'
        });
        return;
    }

    // Mostrar loading
    Swal.fire({
        title: 'Actualizando...',
        text: 'Por favor espere',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        willOpen: () => {
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
        let json = await respuesta.json();

        if (json.status) {
            Swal.fire({
                icon: 'success',
                title: 'Actualizado',
                text: json.mensaje || 'Token actualizado correctamente',
                confirmButtonClass: 'btn btn-success mt-2'
            }).then(() => {
                listarTokens(); // Recargar la tabla
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: json.mensaje || 'Error al actualizar el token',
                confirmButtonClass: 'btn btn-danger mt-2'
            });
        }
    } catch (e) {
        console.log("Error al actualizar token: " + e);
        Swal.fire({
            icon: 'error',
            title: 'Error de Conexión',
            text: 'No se pudo conectar con el servidor. Intente nuevamente.',
            confirmButtonClass: 'btn btn-danger mt-2'
        });
    }
}

// Función para crear el primer token (solo cuando no existe ninguno)
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
        confirmButtonClass: 'btn btn-primary mt-2',
        cancelButtonClass: 'btn btn-secondary mt-2',
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-secondary'
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
            actualizarToken(result.value);
        }
    });
}

// Inicializar al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    listarTokens();
});