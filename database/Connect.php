<?php

class Connect{
    protected $host = 'localhost';
    protected $user = 'root';
    protected $pass ='';
    protected $db = 'lion';
    protected $conn = null;
    public function __construct(){
        $this->conn= mysqli_connect($this->host, $this->user,$this->pass, $this->db);
        return $this->conn;
    }
}



?>