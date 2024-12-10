<?php

use PHPMailer\PHPMailer\PHPMailer;

include_once '../model/restablecer_contra/restablecer_contraModel.php';
include_once '../lib/constant/errores.php';
include_once '../../web/assets/PHPMailer/src/PHPMailer.php';
include_once '../../web/assets/PHPMailer/src/Exception.php';

class restablecer_contra
{
    private $obj;

    public function __construct() {
        $this->obj = new restablecer_contraModel();
    }

    private function generateResetCode()
    {
        return bin2hex(random_bytes(16));
    }

    private function sendResetEmail($email, $resetCode)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // Reemplaza con tu servidor SMTP
            $mail->SMTPAuth   = true;
            $mail->Username   = 'miguelangelcuellar245@gmail.com'; // Reemplaza con tu email
            $mail->Password   = 'dpaeizuxnqoldajo'; // Reemplaza con tu contraseña
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('miguelangelcuellar245@gmail.com', 'AcciVial');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Restablecimiento de contraseña';
            $mail->Body    = "Tu código de restablecimiento es: <b>$resetCode</b>";

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Error al enviar email: {$mail->ErrorInfo}");
            return false;
        }
    }

    public function requestReset()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $usuario = $this->obj->EncontrarUsuario($email);
        if (!empty($usuario)) {
            $resetCode = $this->generateResetCode();
            $expiryTime = date('Y-m-d H:i:s', strtotime('+1 hour'));

            if ($this->model->saveResetCode($email, $resetCode, $expiryTime)) {
                if ($this->sendResetEmail($email, $resetCode)) {
                    return ['success' => true, 'message' => 'Se ha enviado un código de restablecimiento a tu correo.'];
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

    public function verifyCode()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $code = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);

        if ($this->model->verifyResetCode($email, $code)) {
            return ['success' => true, 'message' => 'Código verificado correctamente.'];
        } else {
            return ['success' => false, 'message' => ERROR_CODIGO_VERIFICACION];
        }
    }

    public function resetPassword()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $code = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
        $password = $_POST['password']; // No sanitizamos la contraseña para no alterar caracteres especiales

        if ($this->model->verifyResetCode($email, $code)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            if ($this->model->updatePassword($email, $hashedPassword)) {
                return ['success' => true, 'message' => 'Tu contraseña ha sido actualizada correctamente.'];
            } else {
                return ['success' => false, 'message' => ERROR_GENERAL];
            }
        } else {
            return ['success' => false, 'message' => ERROR_CODIGO_VERIFICACION];
        }
    }
}
?>