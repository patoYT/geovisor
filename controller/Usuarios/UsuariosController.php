<?php
include_once '../model/Usuarios/UsuariosModel.php';

class UsuariosController
{
    public function getCreate()
    {
        $obj = new UsuariosModel();

        $sql = "SELECT * FROM tipodedocumento";
        $tipodedocumentos = $obj->consult($sql);

        $sql = "SELECT * FROM barrios";
        $barrios = $obj->consult($sql); 
        
        $sql = "SELECT * FROM tipo_via";
        $tipo_vias = $obj->consult($sql); 

        include_once 'login.php';
    }

    public function postCreate()
    {
        $obj = new UsuariosModel();

        $usu_nombre = $_POST['nombre'];
        $usu_apellido = $_POST['apellido'];
        $tipodedocumento = $_POST['td'];
        $numerodocumento = $_POST['numerodocumento'];
        $telefono = $_POST['telefono'];
        $usu_correo = $_POST['email'];
        $usu_clave = $_POST['password'];
        if(isset($_POST['rol'])){
            $rol = $_POST['rol'];
        }else{
            $rol = 1;
        }
        $clave = password_hash($usu_clave, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (usu_td,usu_numerodocumento,usu_nombre,usu_apellido,usu_password,usu_correo,usu_telefono, usu_rol) VALUES($tipodedocumento,'$numerodocumento','$usu_nombre','$usu_apellido','$clave','$usu_correo','$telefono','$rol');";
        $ejecutar = $obj->insert($sql);
        if ($ejecutar) {
            redirect("index.php");
        } else {
            echo "No se pudo realizar el registro";
        }
    }
    public function getUsuarios()
    {
        $obj = new UsuariosModel();
        $sql = "SELECT u.*, r.rol_nombre, e.nombre FROM usuarios u, rol r, estado e WHERE u.USU_ROL_ID  = r.rol_id AND u.USU_ESTADO_ID = e.id";

        $usuarios = $obj->consult($sql);


        include_once '../view/Usuarios/consult.php';
    }
    public function getUpdate()
    {
        $obj = new UsuariosModel();
        $usu_id = $_GET['usu_id'];
        $sql = "SELECT * FROM usuarios WHERE ID_USUARIO = $usu_id";

        $usuarios = $obj->consult($sql);
        $sql = "SELECT * FROM rol";
        $roles = $obj->consult($sql);

        include_once '../view/Usuarios/update.php';
    }
    public function postUpdate()
    {
        $obj = new UsuariosModel();
        $usu_id = $_POST['usu_id'];
        $usu_nombre = $_POST['usu_nombre'];
        $usu_apellido = $_POST['usu_apellido'];
        $usu_correo = $_POST['usu_correo'];
        $usu_clave = $_POST['usu_clave'];
        $usu_rol = $_POST['usu_rol'];

        $sql = "UPDATE usuarios SET NOMBRE_USUARIO = '$usu_nombre', APELLIDO_USUARIO = '$usu_apellido', CORREO_USUARIO = '$usu_correo',
            CLAVE_USUARIO = '$usu_clave', USU_ROL_ID = $usu_rol WHERE ID_USUARIO = $usu_id";

        $ejecutar = $obj->uptade($sql);
        if ($ejecutar) {
            redirect(getUrl("Usuarios", "Usuarios", "getUsuarios"));
        } else {
            echo "No se pudo realizar la actualizacion";
        }
    }
    public function getDelete()
    {
        $obj = new UsuariosModel();
        $usu_id = $_GET['usu_id'];
        $sql = "SELECT u.*, r.rol_nombre FROM usuarios AS u INNER JOIN rol AS r ON 
            r.rol_id = u.USU_ROL_ID WHERE u.ID_USUARIO = $usu_id";

        $usuarios = $obj->consult($sql);

        include_once '../view/Usuarios/delete.php';
    }
    public function postDelete()
    {
        $obj = new UsuariosModel();
        $usu_id = $_POST['usu_id'];
        $sql = "DELETE FROM usuarios WHERE ID_USUARIO=$usu_id";
        $ejecutar = $obj->delete($sql);
        if ($ejecutar) {
            redirect(getUrl("Usuarios", "Usuarios", "getUsuarios"));
        } else {
            echo "No se pudo realizar la eliminacion";
        }
    }

    public function buscar()
    {
        $obj = new UsuariosModel();
        $buscar = $_POST['buscar'];
        $sql = "SELECT u.*, r.rol_nombre, e.nombre FROM usuarios u, rol r, estado e WHERE u.USU_ESTADO_ID = r.rol_id AND u.USU_ESTADO_ID = e.id AND (NOMBRE_USUARIO LIKE '%$buscar%' OR u.APELLIDO_USUARIO LIKE '%$buscar%' OR u.CORREO_USUARIO LIKE '%$buscar%' OR u.CORREO_USUARIO)";
        $usuarios = $obj->consult($sql);

        include_once '../view/Usuarios/buscar.php';
    }

    public function postUpdateStatus(){

        $obj = new UsuariosModel();


        $usu_estado = $_POST['id'];
        $usu_id = $_POST['user'];

        if ($usu_estado == 1) {
            $statusToModify = 2;
        } else if ($usu_estado == 2) {
            $statusToModify = 1;
        }
        $sql = "UPDATE usuarios SET USU_ESTADO_ID = $statusToModify WHERE ID_USUARIO = $usu_id";

        $ejecutar = $obj->uptade($sql);
        
        if ($ejecutar) {
            $sql ="SELECT u.*, r.rol_nombre, e.nombre FROM usuarios u, rol r, estado e WHERE u.USU_ROL_ID = r.rol_id AND u.USU_ESTADO_ID = e.id ORDER BY u.ID_USUARIO ASC";
            $usuarios = $obj->consult($sql);
            include_once '../view/Usuarios/buscar.php';
        } else {
            echo "No funciono esta vaina";
            
        }
    }
}