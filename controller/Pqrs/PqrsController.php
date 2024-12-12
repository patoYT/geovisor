<?php
include_once '../model/pqrs/pqrsModel.php';

class pqrsController
{
    public function getCreate()
    {
        $obj = new pqrsModel();

        include_once '../view/pqrs/create.php';
    }
    
}
?>
