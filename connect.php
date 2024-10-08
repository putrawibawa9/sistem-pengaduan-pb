<?php

class Connect {

private $host = "localhost";
private $port = 3306;
private $database = "crispybase";
private $username = "root";
private $password = "";


public function getConnection() : PDO {
    
return new PDO("mysql:host=$this->host:$this->port;dbname=$this->database", $this->username, $this->password);
}

}



?>