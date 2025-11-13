<?php
require_once "../library/conexion.php";

class TokenModel
{
    private $conexion;

    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    // Obtener el token de la API
    public function obtenerTokenAPI()
    {
        $sql = $this->conexion->query("SELECT token FROM tokens_api LIMIT 1");
        if ($sql && $sql->num_rows > 0) {
            $token = $sql->fetch_object();
            return $token->token ?? '';
        }
        return '';
    }

    // Listar el token (solo hay uno)
    public function listarTodosLosTokens()
    {
        $arrRespuesta = array();
        $query = "SELECT token FROM tokens_api LIMIT 1";
        $respuesta = $this->conexion->query($query);
        if ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }

    // Actualizar el token único
    public function actualizarToken($nuevoToken)
    {
        // Primero verificamos si existe un token
        $verificar = $this->conexion->query("SELECT token FROM tokens_api LIMIT 1");
        
        if ($verificar->num_rows > 0) {
            // Si existe, actualizamos
            $query = "UPDATE tokens_api SET token = '$nuevoToken' LIMIT 1";
        } else {
            // Si no existe, insertamos
            $query = "INSERT INTO tokens_api (token) VALUES ('$nuevoToken')";
        }
        
        $respuesta = $this->conexion->query($query);
        return $respuesta;
    }

    // Generar un nuevo token
    public function generarNuevoToken()
    {
        $nuevoToken = bin2hex(random_bytes(16)) . '-' . date('Ymd') . '-1';
        
        // Verificar si existe un token
        $verificar = $this->conexion->query("SELECT token FROM tokens_api LIMIT 1");
        
        if ($verificar->num_rows > 0) {
            // Actualizar token existente
            $query = "UPDATE tokens_api SET token = '$nuevoToken' LIMIT 1";
        } else {
            // Insertar nuevo token
            $query = "INSERT INTO tokens_api (token) VALUES ('$nuevoToken')";
        }
        
        $this->conexion->query($query);
        return $nuevoToken;
    }
}
