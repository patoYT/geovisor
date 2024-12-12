<?php
include_once '../model/MasterModel.php';

class restablecer_contraModel extends MasterModel
{

    public function EncontrarUsuario($email)
    {
        $sql = "SELECT usu_id FROM usuarios WHERE usu_correo = '$email'";
        $result = pg_query($this->getConnect(), $sql);
        if ($result) {
            return pg_fetch_all($result) ?: [];
        } else {
            throw new Exception("Error en la consulta: " . pg_last_error($this->getConnect()));
        }
    }
    public function GuardarToken($userId, $token, $expiryTime)
    {
        $sql = "INSERT INTO tokens_restablecimiento_contrasena (usu_id, token, fecha_expiracion) VALUES ('$userId', '$token', '$expiryTime')";
        return pg_query($this->getConnect(), $sql);
    }
    public function verificarToken($email, $token)
    {
        $sql = "SELECT usu_id FROM tokens_restablecimiento_contrasena WHERE token = '$token' AND fecha_expiracion > NOW()";
        $result = pg_query($this->getConnect(), $sql);
        if ($result) {
            return pg_fetch_all($result) ?: [];
        } else {
            throw new Exception("Error en la consulta: " . pg_last_error($this->getConnect()));
        }
    }
    public function Acualizarcontraseña($userId, $nuevacontraseña)
    {
        $sql = "UPDATE usuarios SET usu_password = '$nuevacontraseña' WHERE usu_id = '$userId'";
        return pg_query($this->getConnect(), $sql);
    }
    public function EliminarToken($token)
    {
        $sql = "UPDATE tokens_restablecimiento_contrasena SET estado = 4 WHERE token = '$token'";
        return pg_query($this->getConnect(), $sql);
    }
}
