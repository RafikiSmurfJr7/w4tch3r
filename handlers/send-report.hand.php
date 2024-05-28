<?php

    include '../config/connect.php';
    include '../Classes/User.php';

    session_start();

    $text = $_POST['text'];


    $_SESSION['user']->send_report($conn, $text);

?>