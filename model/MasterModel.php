<?php

    include_once '../lib/conf/conection.php'; //Todas las url comienzan desde index

    class MasterModel extends Connection{

        public function insert($sql){
            $result = pg_query($this->getConnect(),$sql);
            return $result;
        }

        public function consult($sql){
            $result = pg_query($this->getConnect(),$sql);

            return $result;
        }

        public function uptade($sql){
            $result = pg_query($this->getConnect(),$sql);
            
            return $result;
        }

        public function delete($sql){
            $result = pg_query($this->getConnect(),$sql);

            return $result;
        }
            //Metodo para auto incrementar los indices 
        public function autoIncrement ($field,$table){
            $sql = ("SELECT MAX($field) FROM $table");
            $result = pg_query($this->getConnect(),$sql);
            $resp = pg_fetch_array($result);
            return $resp[0]+1;
        }

    }

?>