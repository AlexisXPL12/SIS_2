<?php
session_start();
// ===============================================
// CONTROLADOR: TokenController.php
// ===============================================
require_once "../model/admin-sesionModel.php";
require_once "../model/admin-usuarioModel.php";
require_once "../model/adminModel.php";
require_once "../model/admin-tokensModel.php";

$tipo = $_GET['tipo'];

// ===============================================
// INSTANCIAR MODELO
// ===============================================
$objSesion = new SessionModel();
$objAdmin = new AdminModel();
$objUsuario = new UsuarioModel();
$objToken = new TokenModel();

// Variables de sesión - CORRECCIÓN: usar $_POST en lugar de $_REQUEST
$id_sesion = $_POST['sesion'] ?? $_REQUEST['sesion'] ?? '';
$token = $_POST['token'] ?? $_REQUEST['token'] ?? '';

// ===============================================
// CONTROLADOR TOKEN API
// ===============================================
if ($tipo == 'obtener_token') {
    $token_api = $objToken->obtenerTokenAPI();
    echo json_encode(['status' => true, 'token' => $token_api]);
    exit;
}

if ($tipo == "listar_tokens") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    
    // Agregar logs para depuración
    error_log("Verificando sesión - ID: $id_sesion, Token: $token");
    
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        $arr_Tokens = $objToken->listarTodosLosTokens();
        $arr_Respuesta['status'] = true;
        $arr_Respuesta['contenido'] = $arr_Tokens;
    } else {
        error_log("Sesión NO válida");
    }
    
    echo json_encode($arr_Respuesta);
    exit;
}

if ($tipo == "actualizar_token") {
    $arr_Respuesta = array('status' => false, 'mensaje' => 'Sesión inválida o expirada');

    // Log para depuración
    error_log("=== ACTUALIZAR TOKEN ===");
    error_log("Sesión: $id_sesion");
    error_log("Token sesión: $token");
    error_log("POST data: " . print_r($_POST, true));

    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        // Obtener y limpiar el nuevo token
        $nuevoToken = trim($_POST['nuevo_token'] ?? '');

        error_log("Nuevo token recibido: $nuevoToken");

        // Validaciones
        if (empty($nuevoToken)) {
            $arr_Respuesta['mensaje'] = 'El token no puede estar vacío';
            error_log("Error: Token vacío");
        } elseif (strlen($nuevoToken) < 10) {
            $arr_Respuesta['mensaje'] = 'El token debe tener al menos 10 caracteres';
            error_log("Error: Token muy corto");
        } else {
            try {
                // Intentar actualizar
                $actualizado = $objToken->actualizarToken($nuevoToken);

                error_log("Resultado actualización: " . ($actualizado ? 'ÉXITO' : 'FRACASO'));

                if ($actualizado) {
                    $arr_Respuesta['status'] = true;
                    $arr_Respuesta['mensaje'] = 'Token actualizado correctamente';
                } else {
                    $arr_Respuesta['mensaje'] = 'Error al actualizar el token en la base de datos';
                }
            } catch (Exception $e) {
                $arr_Respuesta['mensaje'] = 'Error: ' . $e->getMessage();
                error_log("Excepción: " . $e->getMessage());
            }
        }
    } else {
        error_log("Sesión no válida para actualizar");
    }

    error_log("=== FIN ACTUALIZAR TOKEN ===");
    echo json_encode($arr_Respuesta);
    exit;
}

if ($tipo == "insertar_token") {
    error_log("=== INICIO INSERCIÓN TOKEN ===");
    error_log("POST data: " . print_r($_POST, true));

    $arr_Respuesta = array('status' => false, 'mensaje' => 'Sesión inválida o expirada');

    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        $nuevoToken = trim($_POST['nuevo_token'] ?? '');
        error_log("Token a insertar: $nuevoToken");

        if (empty($nuevoToken)) {
            $arr_Respuesta['mensaje'] = 'El token no puede estar vacío';
        } elseif (strlen($nuevoToken) < 10) {
            $arr_Respuesta['mensaje'] = 'El token debe tener al menos 10 caracteres';
        } else {
            try {
                $insertado = $objToken->insertarToken($nuevoToken);
                error_log("Resultado de inserción: " . ($insertado ? 'ÉXITO' : 'FRACASO'));

                if ($insertado) {
                    $arr_Respuesta['status'] = true;
                    $arr_Respuesta['mensaje'] = 'Token creado correctamente';
                } else {
                    $arr_Respuesta['mensaje'] = 'Error al crear el token en la base de datos';
                }
            } catch (Exception $e) {
                $arr_Respuesta['mensaje'] = 'Error: ' . $e->getMessage();
                error_log("Error en inserción: " . $e->getMessage());
            }
        }
    } else {
        error_log("Sesión NO válida para insertar");
    }

    error_log("=== FIN INSERCIÓN TOKEN ===");
    echo json_encode($arr_Respuesta);
    exit;
}
?>