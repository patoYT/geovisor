<?php

include_once '../model/Acceso/AccesoModel.php';
class AccesoController
{
    
    public function getCreate()
    {
        $obj = new AccesoModel();

        $sql = "SELECT * FROM tipodedocumento";
        $tipodedocumentos = $obj->consult($sql);

        $sql = "SELECT * FROM barrios";
        $barrios = $obj->consult($sql); 
        
        $sql = "SELECT * FROM tipo_via";
        $tipo_via = $obj->consult($sql); 

        include_once 'login.php';
    }


    public function postCreation()
    {

        $obj = new AccesoModel();
        $prueba = false;
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        //Aqui obtengo los datos del formulario en este caso El nombre y la contraseña

        //Nota tengo que corregir el sql :C
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
                    $_SESSION['auth'] =  "Ok";
                    redirect("index.php");
                } else {
                    //Aqui lo mando otra vez al login y le digo que la contraseña no coincide
                    $_SESSION['errores']['inicio_secion'] = "Usuario y/o contraseña incorrectos";
                    redirect("index.php");
                }
            }
            //Este es para cuando no hay usuarios
            //pero igual le digo lo mismo para no darle informacion
        } else {
            $_SESSION['errores']['inicio_secion'] = "Usuario y/o contraseña incorrectos";
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
