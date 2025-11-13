
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
                                <button class="btn btn-success waves-effect waves-light" onclick="generarNuevoToken()">
                                    <i class="fa fa-sync"></i> Generar Nuevo
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
                    <button class="btn btn-primary ml-2" onclick="generarNuevoToken()">
                        <i class="fa fa-plus"></i> Generar Token
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
            <input type="text" id="swal-input-token" class="swal2-input" value="${tokenActual}" placeholder="Ingrese el nuevo token">
        `,
        showCancelButton: true,
        confirmButtonText: 'Actualizar',
        cancelButtonText: 'Cancelar',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-light',
        preConfirm: () => {
            const nuevoToken = document.getElementById('swal-input-token').value;
            if (!nuevoToken) {
                Swal.showValidationMessage('El token no puede estar vacío');
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
                text: json.mensaje,
                confirmButtonClass: 'btn btn-confirm mt-2'
            });
            listarTokens();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: json.mensaje,
                confirmButtonClass: 'btn btn-confirm mt-2'
            });
        }
    } catch (e) {
        console.log("Error al actualizar token: " + e);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error al actualizar el token',
            confirmButtonClass: 'btn btn-confirm mt-2'
        });
    }
}

// Función para generar un nuevo token
async function generarNuevoToken() {
    Swal.fire({
        title: '¿Está seguro?',
        text: "Se generará un nuevo token y reemplazará al actual",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, generar',
        cancelButtonText: 'Cancelar'
    }).then(async (result) => {
        if (result.isConfirmed) {
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
                        icon: 'success',
                        title: 'Token Generado',
                        html: `<strong>Nuevo token:</strong><br><code>${json.token}</code>`,
                        confirmButtonClass: 'btn btn-confirm mt-2'
                    });
                    listarTokens();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: json.mensaje || 'Error al generar el token',
                        confirmButtonClass: 'btn btn-confirm mt-2'
                    });
                }
            } catch (e) {
                console.log("Error al generar token: " + e);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al generar el token',
                    confirmButtonClass: 'btn btn-confirm mt-2'
                });
            }
        }
    });
}
