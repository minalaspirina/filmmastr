<?php
    require_once("db_query.php");

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if ($_SERVER['PATH_INFO'] == '/movies') {

            if (isset($_GET['titolo'])) {
                $user_input = $_GET['titolo'];
                $filtro = 'titolo';
            } else if (isset($_GET['trama'])) {
                $user_input = $_GET['trama'];
                $filtro = 'trama';
            } else if (isset($_GET['durata'])) {
                $user_input = $_GET['durata'];
                $filtro = 'durata';
            } else if (isset($_GET['data_uscita'])) {
                $user_input = $_GET['data_uscita'];
                $filtro = 'data_uscita';
            } else {
                $user_input = NULL;
                $filtro = NULL;
            }

            $movies = get_film($user_input, $filtro);


            http_response_code(200);
            header("Content-Type: application/json");
            echo json_encode([
                "status" => 200,
                "message" => "OK",
                "payload" => $movies
            ]);
        } else if ($_SERVER['PATH_INFO'] == '/actors') {

            if (isset($_GET['last_name'])) {
                $user_input = $_GET['last_name'];
                $filtro = 'last_name';
            } else if (isset($_GET['name'])) {
                $user_input = $_GET['name'];
                $filtro = 'name';
            } else {
                $user_input = NULL;
                $filtro = NULL;
            }

            $actors = get_attori($user_input, $filtro);

            
            http_response_code(200);
            header("Content-Type: application/json");
            echo json_encode([
                "status" => 200,
                "message" => "OK",
                "payload" => $actors
            ]);
        } else if ($_SERVER['PATH_INFO'] == '/directors') {

            if (isset($_GET['last_name'])) {
                $user_input = $_GET['last_name'];
                $filtro = 'last_name';
            } else if (isset($_GET['name'])) {
                $user_input = $_GET['name'];
                $filtro = 'name';
            } else {
                $user_input = NULL;
                $filtro = NULL;
            }
            $directors = get_direttori($user_input, $filtro);


            http_response_code(200);
            header("Content-Type: application/json");
            echo json_encode([
                "status" => 200,
                "message" => "OK",
                "payload" => $directors
            ]);
        } else if ($_SERVER['PATH_INFO'] == '/genres') {

            if (isset($_GET['name'])) {
                $user_input = $_GET['name'];
                $filtro = 'name';
            } else {
                $user_input = NULL;
                $filtro = NULL;
            }

            $genres = get_generi($user_input, $filtro);
            

            http_response_code(200);
            header("Content-Type: application/json");
            echo json_encode([
                "status" => 200,
                "message" => "OK",
                "payload" => $genres
            ]);
        }  
    } else {
        http_response_code(405);
        header("Content-Type: application/json");
        echo json_encode([
            "status" => 405,
            "message" => "Method not allowed",
            "payload" => []
        ]);
    }

    exit;
?>