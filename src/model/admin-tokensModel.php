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

    // Listar todos los tokens
    public function listarTodosLosTokens()
    {
        $arrRespuesta = array();
        $query = "SELECT * FROM tokens_api ORDER BY id ASC";
        $respuesta = $this->conexion->query($query);
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }

    // Obtener un token por ID
    public function obtenerTokenPorId($id)
    {
        $query = "SELECT * FROM tokens_api WHERE id = '$id'";
        $respuesta = $this->conexion->query($query);
        return $respuesta->fetch_object();
    }

    // Actualizar un token
    public function actualizarToken($id, $nuevoToken)
    {
        $query = "UPDATE tokens_api SET token = '$nuevoToken' WHERE id = '$id'";
        $respuesta = $this->conexion->query($query);
        return $respuesta;
    }

    // Generar un nuevo token (opcional)
    public function generarNuevoToken()
    {
        $nuevoToken = bin2hex(random_bytes(16)); // Genera un token aleatorio de 32 caracteres
        $query = "INSERT INTO tokens_api (token) VALUES ('$nuevoToken')";
        $this->conexion->query($query);
        return $nuevoToken;
    }
}
?>
