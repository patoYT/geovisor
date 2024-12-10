<?php
include_once '../model/Vial/VialModel.php';

class VialController
{
    public function getCreate()
    {
        $obj = new VialModel();

        $sqlTipo_daño = "SELECT * FROM tipo_daño WHERE tabla_pertenece = 'vía pública'";
        $tipos_de_daño = $obj->consult($sqlTipo_daño);

        include_once '../view/Vial/Create.php';
    }
    
}
?>
