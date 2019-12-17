<?php

class ScoresRepository {
    private $table_name = "scores";

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    public function findAll() {
        // select all query
        $query = "SELECT s.score FROM  $this->table_name as s ORDER BY s.score ASC LIMIT 5;";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'ScoreEntity');
    }
    

    function create($scoreEntity){
        // query to insert record
        $query = "INSERT INTO $this->table_name(score) VALUES (:score)";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $score = htmlspecialchars(strip_tags($scoreEntity->score));
     
        // bind values
        $stmt->bindParam(':score', $score);

        // execute query
        if($stmt->execute()){
            return $scoreEntity;
        }
        
        return False;
    }
}