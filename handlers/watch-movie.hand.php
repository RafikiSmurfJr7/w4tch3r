<?php

    session_start();

    if(isset($_SESSION['user']))
    {

        $movie_id = $_GET['movie'];

        $_SESSION['movie_id'] = $movie_id;
        $_SESSION['page'] = 'watch-movie';
        $_SESSION['active_link'] = 'movies';
    }

    
    header('Location: ../index.php');



?>