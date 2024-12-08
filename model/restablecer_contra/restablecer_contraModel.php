<?php
    include_once '../model/MasterModel.php';

    class restablecer_contraModel extends MasterModel{

        public function EncontrarUsuario($email) {
            $sql = "SELECT usu_id FROM usuarios WHERE usu_correo = '$email'";
            $result = pg_query($this->getConnect(), $sql);
            if ($result) {
                // Convierte el recurso en un arreglo asociativo
                return pg_fetch_all($result) ?: []; // Si no hay resultados, devuelve un arreglo vacío
            } else {
                // Maeja errores de consulta
                throw new Exception("Error en la consulta: " . pg_last_error($this->getConnect()));
            }
        }

        public function GuardarToken($userId, $token, $expiryTime) {
            $sql = "INSERT INTO tokens_restablecimiento_contrasena (usu_id, token, fecha_expiracion) VALUES ('$userId', '$token', '$expiryTime')";
            return $result = pg_query($this->getConnect(), $sql);
        }
    
        public function verificarToken($token) {
            $sql = "SELECT usu_id FROM tokens_restablecimiento_contrasena WHERE token = '$token' AND fecha_expiracion > NOW()";
            $result = pg_query($this->getConnect(), $sql);
            if ($result) {
                // Convierte el recurso en un arreglo asociativo
                return pg_fetch_all($result) ?: []; // Si no hay resultados, devuelve un arreglo vacío
            } else {
                // Maeja errores de consulta
                throw new Exception("Error en la consulta: " . pg_last_error($this->getConnect()));
            }
            return $result;
        }
    
        public function Acualizarcontraseña($userId, $nuevacontraseña) {
            $sql = "UPDATE usuarios SET usu_password = '$nuevacontraseña' WHERE usu_id = '$userId'";
            return $result = pg_query($this->getConnect(), $sql);
        }
    
        public function EliminarToken($token) {
            $sql = "UPDATE tokens_restablecimiento_contrasena SET fecha_expiracion = NOW() WHERE token = '$token'";
            return $result = pg_query($this->getConnect(), $sql);
        }

    }q
?>