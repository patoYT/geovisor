<?php
include_once '../model/Accidentes/AccidentesModel.php';

class AccidentesController
{
    public function getCreate()
    {
        $obj = new AccidentesModel();

        $sql = "SELECT * FROM clase_vehiculos";
        $clase_vehiculos = $obj->consult($sql);

        $sql = "SELECT * FROM subtipo_choque";
        $subtipo_choques = $obj->consult($sql); 
        
        $sql = "SELECT * FROM tipo_choque";
        $tipo_choques = $obj->consult($sql); 

        include_once '../view/Accidentes/create.php';
    }
    
}
?>
