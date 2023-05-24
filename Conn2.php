<?php

abstract class Conn2
{
    public string $db = "mysql";
    public string $host = "localhost";
    public string $user = "u986902309_roger1";
    public string $pass = "Roger*2024";
    public string $dbname = "u986902309_roger";
    public int $port = 3306;
    public object $connect;

    public function connectDb()
    {
        try{
            
            
            $this->connect = new PDO($this->db . ':host=' . $this->host . ';dbname='. $this->dbname, $this->user, $this->pass);
            
            return $this->connect;
        }catch (Exception $err){
           
        }
    }
}