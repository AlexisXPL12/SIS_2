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
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        $id = $_POST['id'] ?? '';
        $nuevoToken = $_POST['nuevo_token'] ?? '';
        if ($id && $nuevoToken) {
            $actualizado = $objToken->actualizarToken($id, $nuevoToken);
            if ($actualizado) {
                $arr_Respuesta['status'] = true;
                $arr_Respuesta['mensaje'] = 'Token actualizado correctamente';
            } else {
                $arr_Respuesta['mensaje'] = 'Error al actualizar el token';
            }
        }
    }
    echo json_encode($arr_Respuesta);
}

if ($tipo == "generar_token") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        $nuevoToken = $objToken->generarNuevoToken();
        $arr_Respuesta['status'] = true;
        $arr_Respuesta['token'] = $nuevoToken;
    }
    echo json_encode($arr_Respuesta);
}
?>