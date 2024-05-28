<?php

    require '../config/connect.php';
    require '../Classes/Main.php';


    $id = $_POST['id'];


    Main::del_user($conn, $id);


?>