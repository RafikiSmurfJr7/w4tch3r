<?php

    include '../Classes/User.php';
    include '../config/connect.php';

    session_start();

    if(isset($_SESSION['user']))
    {
        $id = $_GET['id'];

        echo $id;

        $_SESSION['user']->add_to_seen($conn, $id);
    }


?>