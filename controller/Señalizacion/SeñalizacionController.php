<?php
include_once '../model/Señalizacion/SeñalizacionModel.php';

class SeñalizacionController
{
    public function getCreate()
    {
        $obj = new SeñalizacionModel();

        $sqlCategoria = "SELECT * FROM categoria_señalizacion";
        $categorias = $obj->consult($sqlCategoria);

        $sqlTipo = "SELECT * FROM tipo_señalizacion";
        $tipos = $obj->consult($sqlTipo); 
        
        $sqlTipo_señal = "SELECT * FROM tipo_señal";
        $tipo_señal = $obj->consult($sqlTipo_señal); 

        $sqlTipo_daño = "SELECT * FROM tipo_daño WHERE tabla_pertenece = 'señalizaciones viales'";
        $tipos_de_daño = $obj->consult($sqlTipo_daño);

        include_once '../view/Señalizacion/Create.php';
    }
    
}
?>
