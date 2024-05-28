<?php


    session_start();

    if(isset($_SESSION['user']))
    {

        $_SESSION['page'] = 'movies';
        $_SESSION['active_link'] = 'movies';

        
        header('Location: ../index.php?'.$_SESSION['search_bar_val']);
       
        
    }
    else
    {
        header('Location: ../index.php');
    }

    







?>