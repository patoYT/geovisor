<?php
class Connection {
    private $host;
    private $user;
    private $pass;
    private $database;
    private $port;
    private $link;


function __construct(){
    $this->setConnect(); 
    $this->connect();
}
private function setConnect(){
    require_once 'conf.php';

    $this->host = $host;
    $this->user = $user;
    $this->pass = $pass;
    $this->port = $port;
    $this->database = $database;

}

private function connect()
    {
        //en PG primero creo una cadena de conexión para conectarse a una base de datos PostgreSQL
        $conn_string = "host=$this->host port=$this->port dbname=$this->database user=$this->user password=$this->pass";
        $this->link = pg_connect($conn_string);
        //Aquí se está creando una cadena de conexión para conectarse a una base de datos PostgreSQL
        if ($this->link) {
            echo"Conexion exitosa <br>";
        } else {
            die(pg_last_error($this->link));
        }
    }

    public function getConnect()
    {
        return $this->link;
    }
    public function close()
    {
        pg_close($this->link);
    }
}



?>