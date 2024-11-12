<?php

    include_once '../lib/conf/conection.php'; //Todas las url comienzan desde index

    class MasterModel extends Connection{

        public function insert($sql){
            $result = mysqli_query($this->getConnect(),$sql);
            return $result;
        }

        public function consult($sql){
            $result = mysqli_query($this->getConnect(),$sql);

            return $result;
        }

        public function uptade($sql){
            $result = mysqli_query($this->getConnect(),$sql);
            
            return $result;
        }

        public function delete($sql){
            $result = mysqli_query($this->getConnect(),$sql);

            return $result;
        }
            //Metodo para auto incrementar los indices 
        public function autoIncrement ($field,$table){
            $sql = ("SELECT MAX($field) FROM $table");
            $result = mysqli_query($this->getConnect(),$sql);
            $resp = mysqli_fetch_array($result);
            return $resp[0]+1;
        }

    }

?>