<?php

    include '../Classes/Main.php';
    require '../config/connect.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $premissions = $_POST['premissions'];

    Main::add_user($conn, $username, $email ,$password, $premissions);
    

?>