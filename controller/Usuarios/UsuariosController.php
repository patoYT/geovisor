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
            $_SESSION['errores']['registrar']['aceptado'] = "Se hizo el registro con exito";
            redirect("index.php");
        } else {
            $_SESSION['errores']['registrar']['denegado'] = "No se pudo hacer";
            echo "No se pudo realizar el registro";
        }
    }
    public function getUsuarios()
    {
        $obj = new UsuariosModel();
        $sql = "SELECT u.usu_id,tpd.td_nombre,u.usu_numerodocumento,u.usu_numero_via,tv2.tv_nombre AS tipo_via_nombre,u.usu_numero_interseccion,u.usu_complemento,u.usu_nombre,u.usu_correo,u.usu_estado,u.usu_telefono,tv.tv_nombre,u.usu_apellido,r.rol_nombre,b.nombre_barrio,e.nombre_estado AS estado_nombre FROM usuarios u INNER JOIN roles r ON u.usu_rol = r.rol_id INNER JOIN estado e ON u.usu_estado = e.id_estado INNER JOIN barrios b ON u.usu_barrio = b.id_barrio INNER JOIN tipo_via tv ON u.usu_tipo_via = tv.tv_id INNER JOIN tipo_via tv2 ON u.usu_tipo_via_interseccion = tv2.tv_id INNER JOIN tipodedocumento tpd ON u.usu_td = tpd.td_id";

        $usuarios = $obj->consult($sql);


        include_once '../view/Usuarios/consult.php';
    }
    public function getUpdate()
    {
        $obj = new UsuariosModel();
        $usu_id = $_GET['usu_id'];
        $sql = "SELECT * FROM usuarios WHERE usu_id = $usu_id";

        $usuarios = $obj->consult($sql);
        $sqlroles = "SELECT * FROM roles";
        $roles = $obj->consult($sqlroles);

        $sqltipodedocumento = "SELECT * FROM tipodedocumento";
        $tipodedocumento = $obj->consult($sqltipodedocumento);

        $sqltipos_de_via = "SELECT * FROM tipo_via";
        $tipoDeVia = $obj->consult($sqltipos_de_via);

        $sqlBarrios = "SELECT * FROM barrios";
        $barrios = $obj->consult($sqlBarrios);

        include_once '../view/Usuarios/update.php';
    }
    public function postUpdate()
    {
        $obj = new UsuariosModel();
        $usu_id = $_POST['usu_id'];
        $usu_nombre = $_POST['usu_nombre'];
        $usu_apellido = $_POST['usu_apellido'];
        $usu_td = $_POST['usu_td'];
        $usu_numerodocumento = $_POST['usu_numerodocumento'];
        $usu_correo = $_POST['usu_correo'];
        $usu_clave = $_POST['usu_password'];
        $usu_telefono = $_POST['usu_telefono'];
        $usu_tipo_via = $_POST['usu_tipo_via'];
        $usu_numero_via = $_POST['usu_numero_via'];
        $usu_tipo_via_interseccion = $_POST['usu_tipo_via_interseccion'];
        $usu_numero_adicional = $_POST['usu_numero_adicional'];
        $usu_barrio = $_POST['usu_barrio'];
        $usu_complemento = $_POST['usu_complemento'];
        

        $usu_rol = $_POST['usu_rol'];

        $sql = "UPDATE usuarios SET usu_nombre = '$usu_nombre', usu_apellido = '$usu_apellido',usu_td = '$usu_td',usu_numerodocumento = '$usu_numerodocumento', usu_correo = '$usu_correo',usu_password = '$usu_clave',usu_telefono = '$usu_telefono',usu_tipo_via = '$usu_tipo_via',usu_numero_via = '$usu_numero_via',usu_tipo_via_interseccion = '$usu_tipo_via_interseccion',usu_numero_adicional = '$usu_numero_adicional',usu_barrio = '$usu_barrio',usu_complemento = '$usu_complemento',usu_rol = $usu_rol WHERE usu_id = $usu_id";   

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
        $sql = "SELECT u.*, r.rol_nombre FROM usuarios AS u INNER JOIN roles AS r ON 
            r.rol_id = u.usu_rol WHERE u.usu_id = $usu_id";

        $usuarios = $obj->consult($sql);

        include_once '../view/Usuarios/delete.php';
    }
    public function postDelete()
    {
        $obj = new UsuariosModel();
        $usu_id = $_POST['usu_id'];
        $sql = "DELETE FROM usuarios WHERE usu_id = $usu_id";
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
        $sql = "SELECT u.usu_id,tpd.td_nombre,u.usu_numerodocumento,u.usu_numero_via,tv2.tv_nombre AS tipo_via_nombre,u.usu_numero_interseccion,u.usu_complemento,u.usu_nombre,u.usu_correo,u.usu_estado,u.usu_telefono,tv.tv_nombre,u.usu_apellido,r.rol_nombre,b.nombre_barrio,e.nombre_estado AS estado_nombre FROM usuarios u INNER JOIN roles r ON u.usu_rol = r.rol_id INNER JOIN estado e ON u.usu_estado = e.id_estado INNER JOIN barrios b ON u.usu_barrio = b.id_barrio INNER JOIN tipo_via tv ON u.usu_tipo_via = tv.tv_id INNER JOIN tipo_via tv2 ON u.usu_tipo_via_interseccion = tv2.tv_id INNER JOIN tipodedocumento tpd ON u.usu_td = tpd.td_id AND (usu_nombre LIKE '%$buscar%' OR u.usu_apellido LIKE '%$buscar%' OR u.CORREO_USUARIO LIKE '%$buscar%' OR u.CORREO_USUARIO)";

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
        $sql = "UPDATE usuarios SET usu_estado = $statusToModify WHERE usu_id = $usu_id";

        $ejecutar = $obj->uptade($sql);
        
        if ($ejecutar) {
            $sql = "SELECT u.usu_id,tpd.td_nombre,u.usu_numerodocumento,u.usu_numero_via,tv2.tv_nombre AS tipo_via_nombre,u.usu_numero_interseccion,u.usu_complemento,u.usu_nombre,u.usu_correo,u.usu_estado,u.usu_telefono,tv.tv_nombre,u.usu_apellido,r.rol_nombre,b.nombre_barrio,e.nombre_estado AS estado_nombre FROM usuarios u INNER JOIN roles r ON u.usu_rol = r.rol_id INNER JOIN estado e ON u.usu_estado = e.id_estado INNER JOIN barrios b ON u.usu_barrio = b.id_barrio INNER JOIN tipo_via tv ON u.usu_tipo_via = tv.tv_id INNER JOIN tipo_via tv2 ON u.usu_tipo_via_interseccion = tv2.tv_id INNER JOIN tipodedocumento tpd ON u.usu_td = tpd.td_id ORDER BY u.usu_id ASC";

            $usuarios = $obj->consult($sql);
            include_once '../view/Usuarios/buscar.php';
        } else {
            echo "No funciono esta vaina";
            
        }
    }

    public function CambiarLosEstados()
    {

        $obj = new UsuariosModel();
        $usu_id = $_POST['user'];
        $est_id = $_POST['id'];

        if ($est_id == 3) {
            $sql = "UPDATE tarea SET ESTADO_TAREA = 4 WHERE ID_TAREA = $usu_id";
        } else if ($est_id == 4) {
            $sql = "UPDATE tarea SET ESTADO_TAREA = 3 WHERE ID_TAREA = $usu_id";
        }

        $ejecutar = $obj->uptade($sql);

        if ($ejecutar) {
            $sql = "SELECT t.*,u.*,m.*, e.nombre FROM tarea AS t INNER JOIN usuarios AS u ON u.ID_USUARIO=t.USUARIO_ID INNER JOIN materia AS m ON m.ID_MATERIA = t.MATERIA JOIN estado AS e ON t.ESTADO_TAREA = e.id";

            $tareas = $obj->consult(($sql));

            include_once '../view/Tareas/buscar.php';
        } else {
            echo "No se pudo realizar la eliminacion";
        }
    }
}   