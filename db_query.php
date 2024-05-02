<?php
function get_film($user_input, $filtro) {
    $movies = array();

    $mysqli = new mysqli('localhost','root','','db_film');
    if ($mysqli -> connect_errno) {
        echo "Failed: " . $mysqli -> connect_error;
        exit();
    }

    if ($user_input !== NULL) {
        $query_movies = 'SELECT * FROM movie WHERE '. $filtro .' LIKE "%'.$user_input.'%"';
    } else if ($user_input === NULL) {
        $query_movies = 'SELECT * FROM movie';
    }

    $movies_output = $mysqli -> query($query_movies);

    while ($moviesRow = $movies_output -> fetch_assoc()) {
        $movies[] = $moviesRow;

        $last_movie = $movies[count($movies) - 1];
        $id_film = $last_movie['id'];

        $query_attori = 'SELECT actor.* FROM movie_actor 
        INNER JOIN actor ON actor.id = movie_actor.actor_id 
        WHERE movie_actor.movie_id = '.$id_film;

        $actorsResult = $mysqli -> query($query_attori);
        if (!$actorsResult) {
            die("Errore $id_film: " . $mysqli -> connect_error);
        } 

        while ($actorsRow = $actorsResult -> fetch_assoc()) {
            $movies[count($movies) - 1]['actors'][] = $actorsRow;
        }

        $query_direct = 'SELECT director.* FROM movie_director 
        INNER JOIN director ON director.id = movie_director.director_id 
        WHERE movie_director.movie_id = '.$id_film;

        $risult_direct = $mysqli -> query($query_direct);
        if (!$risult_direct) {
            die("Errore $id_film: " . $mysqli -> connect_error);
        }

        while ($directorsRow = $risult_direct -> fetch_assoc()) {
            $movies[count($movies) - 1]['directors'][] = $directorsRow;
        }

        $query_generi = 'SELECT genre.* FROM movie_genre 
        INNER JOIN genre ON genre.id = movie_genre.genre_id 
        WHERE movie_genre.movie_id = '.$id_film;

        $risultati_generi = $mysqli -> query($query_generi);
        if (!$risultati_generi) {
            die("Errore $id_film: " . $mysqli -> connect_error);
        }

        while ($genresRow = $risultati_generi -> fetch_assoc()) {
            $movies[count($movies) - 1]['genres'][] = $genresRow;
        }
    }


    $mysqli -> close();

    return $movies;
}


function get_attori($user_input, $filtro) {
    $actors = array();

    $mysqli = new mysqli('localhost','root','','db_film');
    if ($mysqli -> connect_errno) {
        echo "Failed: " . $mysqli -> connect_error;
        exit();
    }

    if ($user_input !== NULL) {
        $query = 'SELECT * FROM actor WHERE '. $filtro .' LIKE "%'.$user_input.'%"';
    } else if ($user_input === NULL) {
        $query = 'SELECT * FROM actor';
    }

    $result = $mysqli -> query($query);

    while ($row = $result -> fetch_assoc()) {
        $actors[] = $row;
    }


    $mysqli -> close();

    return $actors;
}


function get_direttori($user_input, $filtro) {
    $directors = array();

    $mysqli = new mysqli('localhost','root','','db_film');
    if ($mysqli -> connect_errno) {
        echo "Failed: " . $mysqli -> connect_error;
        exit();
    }

    
    if ($user_input !== NULL) {
        $query = 'SELECT * FROM director WHERE '. $filtro .' LIKE "%'.$user_input.'%"';
    } else if ($user_input === NULL) {
        $query = 'SELECT * FROM director';
    }
    
    $result = $mysqli -> query($query);

    while ($row = $result -> fetch_assoc()) {
        $directors[] = $row;
    }


    $mysqli -> close();

    return $directors;
}


function get_generi($user_input, $filtro) {
    $genres = array();

    $mysqli = new mysqli('localhost','root','','db_film');
    if ($mysqli -> connect_errno) {
        echo "Failed: " . $mysqli -> connect_error;
        exit();
    }

    if ($user_input !== NULL) {
        $query = 'SELECT * FROM genre WHERE '. $filtro .' LIKE "%'.$user_input.'%"';
    } else if ($user_input === NULL) {
        $query = 'SELECT * FROM genre';
    }

    $result = $mysqli -> query($query);

    while ($row = $result -> fetch_assoc()) {
        $genres[] = $row;
    }


    $mysqli -> close();

    return $genres;
}
?>