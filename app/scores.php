<?php

include_once "./database.php";
include_once "./Entity/score.php";
include_once "./Repository/scoresRepository.php";

$database = new Database();
$db = $database->getConnection();
$database->createScoresTable();

$scoresRepository = new ScoresRepository($db);

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
//Si la requête est une requête post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //recupère le json reçu 
    $data = json_decode(file_get_contents("php://input"));

    //si c'est vide
    if (empty($data->score)) {
        http_response_code(400);
        echo json_encode(['error' => "You must defined score."]);
        return;
    }
    // si ce n'est pas un integer
    if (!is_int($data->score)) {
        http_response_code(400);
        echo json_encode(['error' => "Score field must be a valid integer."]);
        return;
    }
    // si c'est -1 par exemple
    if ($data->score <= 0) {
        http_response_code(400);
        echo json_encode(['error' => "Score field must be greeter than 0."]);
        return;
    }

    $score = new ScoreEntity();
    $score->score = $data->score;

    $scoresRepository->create($score); 

    http_response_code(201);
    echo json_encode((array) $score);
    return;
}


// set response code - 200 OK
http_response_code(200);

$scores_arr['scores'] = array_map(function($s) {return $s->score;}, $scoresRepository->findAll());

// show products data in json format
echo json_encode($scores_arr);
