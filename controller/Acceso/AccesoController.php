<?php

include_once '../model/Acceso/AccesoModel.php';
class AccesoController
{
    public function postCreation()
    {

        $obj = new AccesoModel();
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $sql =  "SELECT * FROM usuarios WHERE usu_correo = '$user'";
        $usuario = $obj->consult($sql);

        if (!empty($usuario)) {
            //Si se encuenta algun usuario
            foreach ($usuario as $usu) {
                // password_verify es para comprobar si la contraseña proporcionada coincide con la contraseña almacenada en la base de datos 
                if (password_verify($pass, $usu['usu_password'])) {
                    //Si la contraseña es correcta estabelezco las variables de session del nombre y el apellido
                    $_SESSION['Nombre'] =  $usu['usu_nombre'];
                    $_SESSION['Apellido'] =  $usu['usu_apellido'];
                    $_SESSION['Correo'] = $usu['usu_correo'];
                    $_SESSION['id'] = $usu['usu_id'];
                    $_SESSION['auth'] =  "Ok";
                    redirect("index.php");
                } else {
                    //Aqui lo mando otra vez al login y le digo que la contraseña no coincide
                    $_SESSION['errores']['iniciarsesion']['usu_incorrect'] = "Usuario y/o contraseña incorrectos";
                    redirect("index.php");
                }
            }
            //Este es para cuando no hay usuarios
        } else {
            $_SESSION['errores']['iniciarsesion']['usu_incorrect'] = "Usuario y/o contraseña incorrectos";
            redirect("index.php");
        }
    }
    //Este metodo es para destruir la session que este y pues lo mando al index
    public function logout()
    {
        session_destroy();
        redirect("index.php");
    }
}
