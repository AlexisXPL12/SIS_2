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

//variables de sesion
$id_sesion = $_REQUEST['sesion'];
$token = $_REQUEST['token'];

// ===============================================
// CONTROLADOR TOKEN API
// ===============================================

if ($tipo == 'obtener_token') {
    $token = $objToken->obtenerTokenAPI();
    echo json_encode(['status' => true, 'token' => $token]);
    exit;
}


if ($tipo == "listar_tokens") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        $arr_Tokens = $objToken->listarTodosLosTokens();
        $arr_Respuesta['status'] = true;
        $arr_Respuesta['contenido'] = $arr_Tokens;
    }
    echo json_encode($arr_Respuesta);
}

if ($tipo == "actualizar_token") {
    $arr_Respuesta = array('status' => false, 'mensaje' => 'Sesión inválida o expirada');
    
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        // Obtener y limpiar el nuevo token
        $nuevoToken = trim($_POST['nuevo_token'] ?? '');
        
        // Validaciones
        if (empty($nuevoToken)) {
            $arr_Respuesta['mensaje'] = 'El token no puede estar vacío';
        } elseif (strlen($nuevoToken) < 10) {
            $arr_Respuesta['mensaje'] = 'El token debe tener al menos 10 caracteres';
        } else {
            try {
                // Intentar actualizar
                $actualizado = $objToken->actualizarToken($nuevoToken);
                
                if ($actualizado) {
                    $arr_Respuesta['status'] = true;
                    $arr_Respuesta['mensaje'] = 'Token actualizado correctamente';
                } else {
                    $arr_Respuesta['mensaje'] = 'Error al actualizar el token en la base de datos';
                }
            } catch (Exception $e) {
                $arr_Respuesta['mensaje'] = 'Error: ' . $e->getMessage();
            }
        }
    }
    
    echo json_encode($arr_Respuesta);
    exit;
}
?>