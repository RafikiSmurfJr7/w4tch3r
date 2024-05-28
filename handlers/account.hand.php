<?php 

    session_start();

    if(isset($_SESSION['user']))
    {
        
        $_SESSION['page'] = 'account';
        $_SESSION['active_link'] = 'account';

    }

    header('Location: ../index.php');

?>