<?php

    require '../config/connect.php';
    require '../Classes/Main.php';

 
    $tmdb_id = $_GET['tmdb_id'];
    $imdb_id = $_GET['imdb_id'];
    $title = $_GET['title'];
    $tagline = $_GET['tagline'];
    $description = $_GET['description'];
    $genres = $_GET['genres'];
    $release_date = $_GET['release_date'];
    $time = $_GET['time'];
    $rating = $_GET['rating'];
    $poster_link = $_GET['poster_link'];



    $redirect = Main::insert_movie_data($conn, $tmdb_id, $imdb_id, $title, $tagline, $description, $genres, $release_date, $time, $rating, $poster_link);

    /*inserção em serie
    $tmdb_id+=1;
    header('Location: ../movies.php?id='.$tmdb_id);
    */
    
    header('Location: '.$redirect);

/*
    echo $tmdb_id . "<br>";
    echo "<br>";
    echo $imdb_id . "<br>";
    echo "<br>";
    echo $title . "<br>";
    echo "<br>";
    echo $tagline . "<br>";
    echo "<br>";
    echo $description . "<br>";
    echo "<br>";
    echo $genres . "<br>";
    echo "<br>";
    echo $release_date . "<br>";
    echo "<br>";
    echo $time . "<br>";
    echo "<br>";
    echo $rating . "<br>";
    echo "<br>";
    echo $poster_link . "<br>";
    echo "<br>";
*/
?>