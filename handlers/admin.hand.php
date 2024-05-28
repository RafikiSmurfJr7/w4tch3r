<?php

    session_start();

    if(isset($_SESSION['user']))
    {
        $_SESSION['page'] = 'administration';
        $_SESSION['active_link'] = 'admin';
    }

    header('Location: ../index.php');
    
    


?>