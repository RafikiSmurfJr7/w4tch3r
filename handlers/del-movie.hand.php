<?php

    include '../Classes/Main.php';
    include '../config/connect.php';

    session_start();

    if(isset($_SESSION['user']))
    {
        $id = $_POST['id'];

        Main::del_movie($conn, $id);
    }



?>