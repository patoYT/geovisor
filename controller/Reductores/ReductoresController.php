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

        $tipo_solicitud = $_POST['estadoSeñalizacion'];
        $tipo_daño = $_POST['tipoDaño'];
        $categoria_reductor = $_POST['cate_reductor'];

        $tipo_solici = isset($_POST['tipo_solicitud']) ? $_POST['tipo_solicitud'] : "";
        $reparacion = ($tipo_solici === 'reparacion');

        $tipo_reduct = $_POST['tipo_reductor'];
        $direccion = "cr cualquier Vaina";
        $usu_id = $_SESSION["id"];
        $observaciones = $_POST['observaciones'];

        if(!isset($tipo_solicitud)){

        }else{
            $sql = "INSERT INTO solicitudes_reductores_velocidad (usu_id,es_nuevo_reductor,categoria_id,tipo_id,descripcion,tipo_dano,direccion,estado_id) VALUES ($usu_id,$reparacion,$categoria_reductor,$tipo_reduct,$observaciones,$tipo_daño,$direccion)";
            
            var_dump($sql);
            $ejecutar = $obj->insert($sql);
            if ($ejecutar) {
                $_SESSION['errores']['registrar']['aceptado'] = "Se hizo el regitro con exito";
                redirect("../view/solicitudes/consult.php");
            } else {
                $_SESSION['errores']['registrar']['denegado'] = "No se pudo hacer";
                echo "No se pudo realizar el registro";
            }
        }

    }
    
}
?>
