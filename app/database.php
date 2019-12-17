<?php

class Database{
 
    // credentials
	private $host = "db";
	private $port = "5432";
    private $db_name = "database";
    private $username = "user";
    private $password = "password";
    public $conn;
 
    // Connection a la base de données
    public function getConnection(){
        $this->conn = null;
 
        try{
            $this->conn = new PDO("pgsql:host=$this->host;port=$this->port;dbname=$this->db_name;user=$this->username;password=$this->password");
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
	}

	public function createScoresTable() {
		$table = "scores";
		//Creation de ma table avec id et score 
		$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
		$sql ="CREATE TABLE IF NOT EXISTS $table (
			id SERIAL PRIMARY KEY,
			score integer NOT NULL
		);"; 
		$this->conn->exec($sql);
	
		return $this;
	}

}