<?php
include_once '../model/Reductores/ReductoresModel.php';

class ReductoresController
{
    public function getCreate()
    {
        $obj = new ReductoresModel();

        $sqlestado = "SELECT * FROM estado";
        $estados = $obj->consult($sqlestado);

        $sqltipo_reductor = "SELECT * FROM tipo_reductor";
        $tipo_reductores = $obj->consult($sqltipo_reductor); 
        
        $sqltipo_señal = "SELECT * FROM tipo_señal";
        $tipo_señales = $obj->consult($sqltipo_señal); 

        $sqlCategoria_reductor = "SELECT * FROM categoria_reductor";
        $categoria_reductores = $obj->consult($sqlCategoria_reductor); 

        $sqlTipo_daño = "SELECT * FROM tipo_daño WHERE tabla_pertenece = 'señalizaciones viales'";
        $tipos_de_daño = $obj->consult($sqlTipo_daño);
        
        include_once '../view/Reductores/CreateR.php';
    }

    public function postCreate(){

        $obj = new ReductoresModel();

        $tipo_solicitud = $_POST['EstadoSeñalizacion'];
        $tipo_daño = $_POST['TipoDaño'];
        $categoria_reductor = $_POST['cate_reductor'];
        $tipo_solici = $_POST['tipo_solicitud'];
        $tipo_reduct = $_POST['tipo_reductor'];
        $direccion = "cr cualquier Vaina";
        $usu_id = $_SESSION["id"];
        $observaciones = $_POST['observaciones'];


        $sql = "INSERT INTO solicitudes (id_tipo_solicitud,id_usuario,coordenadas,observaciones) VALUES ($tipo_solicitud,$usu_id,'$direccion','$observaciones')";
    }
    
}
?>
