<?php

    include '../Classes/Main.php';
    include '../config/connect.php';

    session_start();

    if(isset($_SESSION['user']))
    {

        $id = $_POST['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $premissions = $_POST['premissions'];

        /*$id = $_GET['id'];
        $username = $_GET['username'];
        $email = $_GET['email'];
        $premissions = $_GET['premissions'];`/
        */
        
        Main::update_user_data($conn, $id, $username, $email, $premissions);

    }

?>