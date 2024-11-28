<?php
include_once '../model/Vial/VialModel.php';

class VialController
{
    public function getCreate()
    {
        $obj = new VialModel();

        $sql = "SELECT * FROM clase_vehiculos";
        $clase_vehiculos = $obj->consult($sql);

        $sql = "SELECT * FROM subtipo_choque";
        $subtipo_choques = $obj->consult($sql); 
        
        $sql = "SELECT * FROM tipo_choque";
        $tipo_choques = $obj->consult($sql); 

        include_once '../view/Vial/Create.php';
    }
    
}
?>
