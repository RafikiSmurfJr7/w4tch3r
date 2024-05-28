<?php

    require 'database/data.php';

    $conn = new mysqli($link['server'], $link['username'], $link['password'], $link['database']); 

    $conn->set_charset("utf8");

    if($conn->connect_error)
    {
        die();
    }

?>