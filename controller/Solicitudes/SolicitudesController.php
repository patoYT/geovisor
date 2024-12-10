<?php
    include_once '../model/solicitudes/SolicitudesModel.php';

    class SolicitudesController{

        public function getSolicitudes(){

            echo 'Si esta cargando :)';
            
            include_once '../view/solicitudes/create.php';
        }

    }
?>