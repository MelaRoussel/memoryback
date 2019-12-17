<?php

class ScoreEntity {
    // object properties
    public $id;
    public $score;
    
    // constructor with $db as database connection
    public function setId($id) {
        $this->id = $id;
        
        return $this;
    }
    // constructor with $db as database connection
    public function setScore($score) {
        $this->score = $score;
        
        return $this;
    }
}