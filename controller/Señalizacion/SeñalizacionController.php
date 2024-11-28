<?php
include_once '../model/Señalizacion/SeñalizacionModel.php';

class SeñalizacionController
{
    public function getCreate()
    {
        $obj = new SeñalizacionModel();

        $sql = "SELECT * FROM clase_vehiculos";
        $clase_vehiculos = $obj->consult($sql);

        $sql = "SELECT * FROM subtipo_choque";
        $subtipo_choques = $obj->consult($sql); 
        
        $sql = "SELECT * FROM tipo_choque";
        $tipo_choques = $obj->consult($sql); 

        include_once '../view/Señalizacion/Create.php';
    }
    
}
?>
