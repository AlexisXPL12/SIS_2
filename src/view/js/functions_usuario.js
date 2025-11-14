function numero_pagina(pagina) {
    document.getElementById('pagina').value = pagina;
    listar_usuariosOrdenados();
}
// ============================================
// FUNCIÓN PARA LISTAR USUARIOS
// ============================================
async function listar_usuariosOrdenados() {
    try {
        mostrarPopupCarga();
        
        // Obtener filtros
        let pagina = document.getElementById('pagina').value;
        let cantidad_mostrar = document.getElementById('cantidad_mostrar').value;
        let busqueda_tabla_dni = document.getElementById('busqueda_tabla_dni').value;
        let busqueda_tabla_nomap = document.getElementById('busqueda_tabla_nomap').value;
        let busqueda_tabla_estado = document.getElementById('busqueda_tabla_estado').value;
        
        // Guardar valores de filtro
        document.getElementById('filtro_dni').value = busqueda_tabla_dni;
        document.getElementById('filtro_nomap').value = busqueda_tabla_nomap;
        document.getElementById('filtro_estado').value = busqueda_tabla_estado;

        // Generar FormData
        const formData = new FormData();
        formData.append('pagina', pagina);
        formData.append('cantidad_mostrar', cantidad_mostrar);
        formData.append('busqueda_tabla_dni', busqueda_tabla_dni);
        formData.append('busqueda_tabla_nomap', busqueda_tabla_nomap);
        formData.append('busqueda_tabla_estado', busqueda_tabla_estado);
        formData.append('sesion', session_session);
        formData.append('token', token_token);

        let respuesta = await fetch(base_url_server + 'src/control/Usuario.php?tipo=listar_usuarios_ordenados_tabla', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });

        let json = await respuesta.json();
        
        document.getElementById('tablas').innerHTML = `
            <table id="" class="table dt-responsive" width="100%">
                <thead>
                    <tr>
                        <th>Nro</th>
                        <th>DNI</th>
                        <th>Apellidos y Nombres</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="contenido_tabla">
                </tbody>
            </table>
        `;

        if (json.status) {
            let datos = json.contenido;
            datos.forEach(item => {
                generarfilastabla(item);
            });
        } else if (json.msg == "Error_Sesion") {
            alerta_sesion();
        } else {
            document.getElementById('tablas').innerHTML = `
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> No se encontraron resultados
                </div>
            `;
        }
        
        let paginacion = generar_paginacion(json.total, cantidad_mostrar);
        let texto_paginacion = generar_texto_paginacion(json.total, cantidad_mostrar);
        document.getElementById('texto_paginacion_tabla').innerHTML = texto_paginacion;
        document.getElementById('lista_paginacion_tabla').innerHTML = paginacion;
        
    } catch (e) {
        console.error("Error al cargar usuarios:", e);
    } finally {
        ocultarPopupCarga();
    }
}

// ============================================
// FUNCIÓN PARA GENERAR FILAS
// ============================================
function generarfilastabla(item) {
    let cont = 1;
    $(".filas_tabla").each(function () {
        cont++;
    });

    let estado;
    if (item.estado == 1) {
        estado = '<span class="badge badge-success">ACTIVO</span>';
    } else {
        estado = '<span class="badge badge-secondary">INACTIVO</span>';
    }

    let nueva_fila = document.createElement("tr");
    nueva_fila.id = "fila" + item.id;
    nueva_fila.className = "filas_tabla";
    nueva_fila.innerHTML = `
        <th>${cont}</th>
        <td>${item.dni}</td>
        <td>${item.nombres_apellidos}</td>
        <td>${estado}</td>
        <td>${item.options}</td>
    `;

    document.querySelector('#contenido_tabla').appendChild(nueva_fila);
}

// ============================================
// FUNCIÓN PARA ABRIR MODAL DE EDICIÓN
// ============================================
function abrirModalEditarUsuario(id, dni, nombres, correo, telefono, estado) {
    Swal.fire({
        title: 'Actualizar datos de docente',
        html: `
            <div class="form-group text-left mb-3">
                <label for="swal-dni">DNI:</label>
                <input type="text" id="swal-dni" class="form-control" value="${dni}">
            </div>
            <div class="form-group text-left mb-3">
                <label for="swal-nombres">Apellidos y Nombres:</label>
                <input type="text" id="swal-nombres" class="form-control" value="${nombres}">
            </div>
            <div class="form-group text-left mb-3">
                <label for="swal-correo">Correo Electrónico:</label>
                <input type="email" id="swal-correo" class="form-control" value="${correo}">
            </div>
            <div class="form-group text-left mb-3">
                <label for="swal-telefono">Teléfono:</label>
                <input type="text" id="swal-telefono" class="form-control" value="${telefono}">
            </div>
            <div class="form-group text-left mb-3">
                <label for="swal-estado">Estado:</label>
                <select id="swal-estado" class="form-control">
                    <option value="">Seleccione...</option>
                    <option value="1" ${estado == 1 ? 'selected' : ''}>ACTIVO</option>
                    <option value="0" ${estado == 0 ? 'selected' : ''}>INACTIVO</option>
                </select>
            </div>
        `,
        width: '600px',
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
            const dniVal = document.getElementById('swal-dni').value.trim();
            const nombresVal = document.getElementById('swal-nombres').value.trim();
            const correoVal = document.getElementById('swal-correo').value.trim();
            const telefonoVal = document.getElementById('swal-telefono').value.trim();
            const estadoVal = document.getElementById('swal-estado').value;
            
            if (!dniVal || !nombresVal || !correoVal || !telefonoVal || !estadoVal) {
                Swal.showValidationMessage('Por favor complete todos los campos');
                return false;
            }
            
            return {
                dni: dniVal,
                nombres_apellidos: nombresVal,
                correo: correoVal,
                telefono: telefonoVal,
                estado: estadoVal
            };
        }
    }).then((result) => {
        if (result.value !== undefined && result.value !== null) {
            actualizarUsuario(id, result.value);
        } else if (result.isConfirmed) {
            actualizarUsuario(id, result.value);
        }
    });
}

// ============================================
// FUNCIÓN PARA ACTUALIZAR USUARIO
// ============================================
async function actualizarUsuario(id, datos) {
    if (!datos) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Datos incompletos',
            customClass: {
                confirmButton: 'btn btn-danger mt-2'
            }
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
        onOpen: () => {
            Swal.showLoading();
        }
    });

    const formData = new FormData();
    formData.append('data', id);
    formData.append('dni', datos.dni);
    formData.append('nombres_apellidos', datos.nombres_apellidos);
    formData.append('correo', datos.correo);
    formData.append('telefono', datos.telefono);
    formData.append('estado', datos.estado);
    formData.append('sesion', session_session);
    formData.append('token', token_token);

    try {
        let respuesta = await fetch(base_url_server + 'src/control/Usuario.php?tipo=actualizar', {
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
                text: json.mensaje || 'Usuario actualizado correctamente',
                customClass: {
                    confirmButton: 'btn btn-success mt-2'
                },
                timer: 2000
            }).then(() => {
                listar_usuariosOrdenados();
            });
        } else if (json.msg == "Error_Sesion") {
            alerta_sesion();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: json.mensaje || 'Error al actualizar el usuario',
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

// ============================================
// FUNCIÓN PARA REGISTRAR USUARIO
// ============================================
async function registrar_usuario() {
    let dni = document.getElementById('dni').value.trim();
    let apellidos_nombres = document.querySelector('#apellidos_nombres').value.trim();
    let correo = document.querySelector('#correo').value.trim();
    let telefono = document.querySelector('#telefono').value.trim();
    let password = document.querySelector('#password').value.trim();

    if (dni == "" || apellidos_nombres == "" || correo == "" || telefono == "" || password == "") {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Por favor complete todos los campos',
            customClass: {
                confirmButton: 'btn btn-danger mt-2'
            }
        });
        return;
    }

    // Mostrar loading
    Swal.fire({
        title: 'Registrando...',
        text: 'Por favor espere',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        onOpen: () => {
            Swal.showLoading();
        }
    });

    try {
        const datos = new FormData(frmRegistrar);
        datos.append('sesion', session_session);
        datos.append('token', token_token);

        let respuesta = await fetch(base_url_server + 'src/control/Usuario.php?tipo=registrar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });

        let json = await respuesta.json();

        if (json.status) {
            document.getElementById("frmRegistrar").reset();
            Swal.fire({
                icon: 'success',
                title: '¡Registrado!',
                text: json.mensaje,
                customClass: {
                    confirmButton: 'btn btn-success mt-2'
                },
                timer: 2000
            }).then(() => {
                listar_usuariosOrdenados();
            });
        } else if (json.msg == "Error_Sesion") {
            alerta_sesion();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: json.mensaje,
                customClass: {
                    confirmButton: 'btn btn-danger mt-2'
                }
            });
        }
    } catch (e) {
        console.error("Error al registrar usuario:", e);
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
//-------------------------------------------------------- RESETEAR CONTRASEÑA -------------------------------------------------------------
function reset_password(id) {
    Swal.fire({
        title: "¿Estás seguro de generar nueva contraseña?",
        text: "Se generará un nueva contraseña para este usuario",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: 'Cancelar'
    }).then(function (result) {
        if (result.value) {
            reniciar_password(id);
        }
    });
}
async function reniciar_password(id) {

    // generamos el formulario
    const formData = new FormData();
    formData.append('id', id);
    formData.append('sesion', session_session);
    formData.append('token', token_token);
    try {
        let respuesta = await fetch(base_url_server + 'src/control/Usuario.php?tipo=reiniciar_password', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        json = await respuesta.json();
        if (json.status) {
            Swal.fire({
                type: 'success',
                title: 'Actualizar',
                text: json.mensaje,
                confirmButtonClass: 'btn btn-confirm mt-2',
                footer: '',
                confirmButtonText: "Aceptar"
            });
        } else if (json.msg == "Error_Sesion") {
            alerta_sesion();
        } else {
            Swal.fire({
                type: 'error',
                title: 'Error',
                text: json.mensaje,
                confirmButtonClass: 'btn btn-confirm mt-2',
                footer: '',
                timer: 1000
            })
        }
        //console.log(json);
    } catch (e) {
        console.log("Error al actualizar periodo" + e);
    }


}
