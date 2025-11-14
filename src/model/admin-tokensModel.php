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

    // Insertar token (con prepared statements para seguridad)
    public function insertarToken($nuevoToken)
    {
        try {
            // Usar prepared statements
            $stmt = $this->conexion->prepare("INSERT INTO tokens_api (token) VALUES (?)");
            
            if (!$stmt) {
                error_log("Error preparando statement: " . $this->conexion->error);
                return false;
            }
            
            $stmt->bind_param("s", $nuevoToken);
            $resultado = $stmt->execute();
            
            if (!$resultado) {
                error_log("Error ejecutando insert: " . $stmt->error);
            }
            
            $stmt->close();
            return $resultado;
            
        } catch (Exception $e) {
            error_log("Excepción en insertarToken: " . $e->getMessage());
            return false;
        }
    }

    // Listar todos los tokens (solo hay uno)
    public function listarTodosLosTokens()
    {
        $arrRespuesta = array();
        $query = "SELECT id, token FROM tokens_api LIMIT 1";
        $respuesta = $this->conexion->query($query);
        
        if ($respuesta && $objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        
        return $arrRespuesta;
    }

    // Actualizar el token (con prepared statements)
    public function actualizarToken($nuevoToken)
    {
        try {
            // Verificar si existe un token
            $sql = $this->conexion->query("SELECT id FROM tokens_api LIMIT 1");
            
            if ($sql && $sql->num_rows > 0) {
                // Token existe - actualizar
                $row = $sql->fetch_object();
                $id = $row->id;
                
                error_log("Actualizando token con ID: $id");
                
                $stmt = $this->conexion->prepare("UPDATE tokens_api SET token = ? WHERE id = ?");
                
                if (!$stmt) {
                    error_log("Error preparando UPDATE: " . $this->conexion->error);
                    return false;
                }
                
                $stmt->bind_param("si", $nuevoToken, $id);
                $resultado = $stmt->execute();
                
                if (!$resultado) {
                    error_log("Error ejecutando UPDATE: " . $stmt->error);
                } else {
                    error_log("Token actualizado exitosamente");
                }
                
                $stmt->close();
                return $resultado;
                
            } else {
                // No existe token - insertar
                error_log("No existe token, insertando nuevo");
                return $this->insertarToken($nuevoToken);
            }
            
        } catch (Exception $e) {
            error_log("Excepción en actualizarToken: " . $e->getMessage());
            return false;
        }
    }

    // Generar un nuevo token aleatorio
    public function generarNuevoToken()
    {
        $nuevoToken = bin2hex(random_bytes(16)) . '-' . date('Ymd') . '-1';

        // Verificar si existe un token
        $verificar = $this->conexion->query("SELECT id FROM tokens_api LIMIT 1");
        
        if ($verificar && $verificar->num_rows > 0) {
            // Actualizar token existente
            return $this->actualizarToken($nuevoToken) ? $nuevoToken : false;
        } else {
            // Insertar nuevo token
            return $this->insertarToken($nuevoToken) ? $nuevoToken : false;
        }
    }
}
?>