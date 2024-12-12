<?php

use PHPMailer\PHPMailer\PHPMailer;

include_once '../model/restablecer_contra/restablecer_contraModel.php';
include_once '../lib/constant/errores.php';
include_once 'assets/PHPMailer/PHPMailer.php';
include_once 'assets/PHPMailer/Exception.php';

class restablecer_contraController
{
    private $obj;

    public function __construct()
    {
        $this->obj = new restablecer_contraModel();
    }

    private function generarToken()
    {
        return bin2hex(random_bytes(16));
    }

    private function EnviarCorreo($email, $token)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'miguelangelcuellar245@gmail.com';
            $mail->Password   = 'dpaeizuxnqoldajo';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('miguelangelcuellar245@gmail.com', 'AcciVial');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Restablecimiento de contraseña';
            $mail->Body    = "Tu código de restablecimiento es: <b>$token</b>";

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Error al enviar email: {$mail->ErrorInfo}");
            return false;
        }
    }

    public function EnviarToken()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        if (!$email) {
            return ['success' => false, 'message' => 'Correo electrónico no proporcionado.'];
        }

        $usuario = $this->obj->EncontrarUsuario($email);
        if (!empty($usuario)) {
            $token = $this->generarToken();
            $fechadeexpiracion = date('Y-m-d H:i:s', strtotime('+1 hour'));

            if ($this->obj->GuardarToken($usuario[0]['usu_id'], $token, $fechadeexpiracion)) {
                if ($this->EnviarCorreo($email, $token)) {
                    return ['success' => true, 'message' => 'Se ha enviado un código de verificación a tu correo electrónico.'];
                } else {
                    return ['success' => false, 'message' => ERROR_VERIFICACION_EMAIL];
                }
            } else {
                return ['success' => false, 'message' => ERROR_GENERAL];
            }
        } else {
            return ['success' => false, 'message' => 'No se encontró ninguna cuenta con ese correo electrónico.'];
        }
    }

    public function verificarToken()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $code = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);

        if (!$email || !$code) {
            return ['success' => false, 'message' => 'Correo electrónico o código no proporcionado.'];
        }

        if ($this->obj->verificarToken($email, $code)) {
            $this->obj->EliminarToken($code);
            return ['success' => true, 'message' => 'Código verificado correctamente.'];
        } else {
            return ['success' => false, 'message' => ERROR_CODIGO_VERIFICACION];
        }
    }

    public function restablecer_contrasena()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $pass = $_POST['password'] ?? '';
        $confirmPass = $_POST['confirmPassword'] ?? '';

        if (!$email || !$pass || !$confirmPass) {
            return ['success' => false, 'message' => 'Faltan datos necesarios.'];
        }

        if ($pass !== $confirmPass) {
            return ['success' => false, 'message' => 'Las contraseñas no coinciden.'];
        }

        $password = password_hash($pass, PASSWORD_DEFAULT);
        if ($this->obj->Acualizarcontraseña($email, $password)) {
            return ['success' => true, 'message' => 'Tu contraseña ha sido actualizada correctamente.'];
        } else {
            return ['success' => false, 'message' => ERROR_GENERAL];
        }
    }
}