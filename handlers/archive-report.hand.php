<?php

    include '../Classes/Main.php';
    include '../config/connect.php';

    session_start();


    if(isset($_SESSION['user']))
    {

        $id = $_POST['id'];
        $user_id = $_POST['user_id'];
        $content = $_POST['text'];
        $date = $_POST['date'];


        Main::archive_report($conn, $id, $user_id, $content, $date);

    }


?>