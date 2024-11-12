<?php

    include_once '../model/Acceso/AccesoModel.php';
    class AccesoController{

        public function postCreation(){
            //Creo una instancia del modelo en este caso AccesoModel para realizar las consultas
            $obj = new AccesoModel();

            $user = $_POST['user'];
            $pass = $_POST['pass'];
            //Aqui obtengo los datos del formulario en este caso El nombre y la contraseña
            
            //Nota tengo que corregir el sql :C
            $sql =  "SELECT * FROM usuarios WHERE CORREO_USUARIO = '$user'";
            $usuario = $obj ->consult($sql);

            if(mysqli_num_rows($usuario) > 0){
                //Si se encuenta algun usuario
                foreach($usuario as $usu){
                    // password_verify es para comprobar si la contraseña proporcionada coincide con la contraseña almacenada en la base de datos 
                    if (password_verify($pass, $usu['CLAVE_USUARIO'])){
                        //Si la contraseña es correcta estabelezco las variables de session del nombre y el apellido
                        $_SESSION['Nombre'] =  $usu['NOMBRE_USUARIO'];
                        $_SESSION['Apellido'] =  $usu['APELLIDO_USUARIO'];
                        $_SESSION['auth'] =  "Ok";
                        //Aqui lo mando al index
                        redirect("index.php");

                    } else {
                        //Aqui lo mando otra vez al login y le digo que la contraseña no coincide
                        $_SESSION['errores'][] = "Usuario y/o contraseña incorrectos";
                        redirect("login.php");
                    }

                }
                //Este es para cuando no hay usuarios
                //pero igual le digo lo mismo para no darle informacion
            } else {
                $_SESSION['errores'][] = "Usuario y/o contraseña incorrectos";
                redirect("login.php");
            }
        }
        //Este metodo es para destruir la session que este y pues lo mando al index
        public function logout(){
            session_destroy();
            redirect("index.php");
        }
    }
?>