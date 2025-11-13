async function obtenerToken() {
    const datos = new FormData();
    datos.append('sesion', session_session);
    datos.append('token', token_token);
    
    try {
        const respuesta = await fetch(base_url_server + 'src/control/Tokens.php?tipo=obtener_token', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        const json = await respuesta.json();

        if (json.status && json.token) {
            document.getElementById('token').value = json.token;
        } else {
            console.error('Error: No se pudo obtener el token.');
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al cargar el token de la API. Contacte al administrador.',
                confirmButtonColor: '#1e88e5'
            });
        }
    } catch (error) {
        console.error('Error al obtener el token:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error al cargar el token de la API. Contacte al administrador.',
            confirmButtonColor: '#1e88e5'
        });
    }
}

// ===============================================
// API.JS - Sistema Integral de Bienes Institucionales
// ===============================================

/**
 * Función principal para llamar a la API y buscar bienes
 */
async function llamar_api() {
    const formulario = document.getElementById('frmApi');
    const datos = new FormData(formulario);
    const ruta_api = document.getElementById('ruta_api').value;
    const contenidoDiv = document.getElementById('contenido');
    const resultsSection = document.getElementById('results-section');
    const resultsCount = document.getElementById('results-count');
    const statsContainer = document.getElementById('stats-container');
    const ultimaBusqueda = document.getElementById('ultima-busqueda');
    const dataInput = document.getElementById('data');

    // Validar que hay texto para buscar
    if (!dataInput.value.trim()) {
        Swal.fire({
            icon: 'warning',
            title: 'Atención',
            text: 'Por favor, ingrese un término de búsqueda',
            confirmButtonColor: '#1e88e5'
        });
        return;
    }

    // Mostrar loading
    mostrarLoading(contenidoDiv);
    resultsSection.classList.add('active');

    try {
        const respuesta = await fetch(ruta_api + '/src/control/Api-Request.php?tipo=verBienApiByNombre', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });

        const json = await respuesta.json();
        console.log('Respuesta de la API:', json);

        if (json.status) {
            if (json.contenido && json.contenido.length > 0) {
                mostrarResultados(json.contenido, contenidoDiv);
                const total = json.contenido.length;
                resultsCount.textContent = `${total} ${total === 1 ? 'resultado' : 'resultados'}`;
                actualizarEstadisticas(json.contenido, statsContainer, ultimaBusqueda, dataInput.value);
            } else {
                mostrarSinResultados(contenidoDiv, dataInput.value);
                resultsCount.textContent = '0 resultados';
            }
        } else {
            // Mostrar el mensaje de error específico del servidor
            Swal.fire({
                icon: 'error',
                title: 'Error de Autenticación',
                text: json.msg || 'Error al realizar la búsqueda',
                confirmButtonColor: '#1e88e5'
            });
            
            contenidoDiv.innerHTML = `
                <div style="grid-column: 1/-1;">
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        <div>
                            <strong>Error</strong><br>
                            ${json.msg || 'Error al realizar la búsqueda'}
                        </div>
                    </div>
                </div>
            `;
        }

    } catch (error) {
        console.error('Error completo:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error de Conexión',
            text: 'No se pudo conectar con el servidor. Verifique su conexión a internet.',
            confirmButtonColor: '#1e88e5'
        });
        mostrarError(contenidoDiv, 'No se pudo conectar con el servidor');
    }
}

/**
 * Muestra el spinner de carga
 */
function mostrarLoading(contenedor) {
    contenedor.innerHTML = `
        <div style="grid-column: 1/-1;">
            <div class="loading-spinner">
                <div class="spinner"></div>
                <p style="color: var(--text-secondary); margin: 0;">Buscando bienes...</p>
            </div>
        </div>
    `;
}

/**
 * Muestra los resultados en formato de cards
 */
function mostrarResultados(bienes, contenedor) {
    let html = '';

    bienes.forEach((bien, index) => {
        const numero = index + 1;
        const icono = getIconoBien(bien.nombre_bien);

        html += `
            <div class="bien-card fade-in" style="animation-delay: ${index * 0.05}s;">
                <div class="bien-header">
                    <div class="bien-numero">${numero}</div>
                    <div class="bien-codigo">
                        <i class="fas fa-barcode"></i> ${bien.codigo_patrimonial || 'N/A'}
                    </div>
                </div>
                
                <div class="bien-info">
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="${icono}"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Denominación</div>
                            <div class="info-value">${bien.nombre_bien || 'N/A'}</div>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Ambiente</div>
                            <div class="info-value">${bien.nombre_ambiente || 'Sin asignar'}</div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    });

    contenedor.innerHTML = html;
}

/**
 * Muestra mensaje cuando no hay resultados
 */
function mostrarSinResultados(contenedor, termino) {
    contenedor.innerHTML = `
        <div style="grid-column: 1/-1;">
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i>
                <div>
                    <strong>No se encontraron resultados</strong><br>
                    No hay bienes que coincidan con el término de búsqueda "${termino}".
                </div>
            </div>
        </div>
    `;
}

/**
 * Muestra mensaje de error
 */
function mostrarError(contenedor, mensaje) {
    contenedor.innerHTML = `
        <div style="grid-column: 1/-1;">
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
                    <strong>Error al realizar la búsqueda</strong><br>
                    ${mensaje}
                </div>
            </div>
        </div>
    `;
}

/**
 * Actualiza las estadísticas en el panel superior
 */
function actualizarEstadisticas(bienes, statsContainer, ultimaBusquedaEl, termino) {
    statsContainer.style.display = 'grid';
    const totalBienes = bienes.length;
    document.getElementById('total-bienes').textContent = totalBienes;
    ultimaBusquedaEl.textContent = termino;
}

/**
 * Obtiene el icono apropiado según el tipo de bien
 */
function getIconoBien(nombreBien) {
    const nombre = (nombreBien || '').toLowerCase();

    if (nombre.includes('computadora') || nombre.includes('laptop') || nombre.includes('pc')) {
        return 'fas fa-laptop';
    } else if (nombre.includes('impresora')) {
        return 'fas fa-print';
    } else if (nombre.includes('escritorio') || nombre.includes('mesa')) {
        return 'fas fa-table';
    } else if (nombre.includes('silla')) {
        return 'fas fa-chair';
    } else if (nombre.includes('telefono') || nombre.includes('celular')) {
        return 'fas fa-mobile-alt';
    } else if (nombre.includes('monitor') || nombre.includes('pantalla')) {
        return 'fas fa-desktop';
    } else if (nombre.includes('proyector')) {
        return 'fas fa-video';
    } else if (nombre.includes('archivador') || nombre.includes('estante')) {
        return 'fas fa-archive';
    } else if (nombre.includes('aire') || nombre.includes('ventilador')) {
        return 'fas fa-fan';
    } else if (nombre.includes('vehiculo') || nombre.includes('auto')) {
        return 'fas fa-car';
    }

    return 'fas fa-box';
}

/**
 * Función para verificar el token con el servidor
 */
async function verificarToken(token) {
    try {
        const base_url_server = document.getElementById('ruta_api').value;
        const response = await fetch(base_url_server + '/src/control/Apibien.php?tipo=verificarToken', {
            method: 'POST',
            headers: {
                'Authorization': token,
                'Content-Type': 'application/x-www-form-urlencoded',
            }
        });

        const result = await response.json();

        if (!result.status) {
            localStorage.removeItem('apiToken');
            if (typeof base_url !== 'undefined') {
                window.location.href = base_url + 'autenticacion-api.php';
            }
            return false;
        }

        return true;
    } catch (error) {
        console.error('Error al verificar el token:', error);
        return false;
    }
}

/**
 * Obtiene la clase CSS según el estado del bien
 */
function getEstadoClass(estado) {
    const estadoLower = (estado || '').toLowerCase();

    if (estadoLower.includes('bueno') || estadoLower.includes('operativo') || estadoLower.includes('excelente')) {
        return 'estado-bueno';
    } else if (estadoLower.includes('regular') || estadoLower.includes('mantenimiento')) {
        return 'estado-regular';
    } else if (estadoLower.includes('malo') || estadoLower.includes('inoperativo') || estadoLower.includes('deteriorado')) {
        return 'estado-malo';
    }

    return 'estado-regular';
}

// ===============================================
// EVENT LISTENERS
// ===============================================

document.addEventListener('DOMContentLoaded', function () {
    const btnBuscar = document.getElementById('btn_buscar');
    if (btnBuscar) {
        btnBuscar.addEventListener('click', llamar_api);
    }

    const dataInput = document.getElementById('data');
    if (dataInput) {
        dataInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                llamar_api();
            }
        });
    }
});
