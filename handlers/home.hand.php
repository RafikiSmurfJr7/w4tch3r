<?php

    session_start();

    if(isset($_SESSION['user']))
    {
        $_SESSION['page'] = 'home';
        $_SESSION['active_link'] = 'home';
    }

    header('Location: ../index.php');
    
    


?>