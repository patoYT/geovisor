<?php
include_once '../model/Reductores/ReductoresModel.php';

class ReductoresController
{
    public function getCreate()
    {
        $obj = new ReductoresModel();

        $sql = "SELECT * FROM clase_vehiculos";
        $clase_vehiculos = $obj->consult($sql);

        $sql = "SELECT * FROM subtipo_choque";
        $subtipo_choques = $obj->consult($sql); 
        
        $sql = "SELECT * FROM tipo_choque";
        $tipo_choques = $obj->consult($sql); 

        include_once '../view/Reductores/Create.php';
    }
    
}
?>
