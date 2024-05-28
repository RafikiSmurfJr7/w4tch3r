<?php 
    
    require_once 'includes/head.inc.php';

    include 'pages/items/logout-modal.php';
    
    include 'config/connect.php';
    include 'Classes/Main.php'; 
    include 'Classes/User.php'; 
    
    session_start();
    //session_destroy();

    if(!isset($_SESSION['user']))
    {
        
        include 'pages/login.php';
    }
    else
    {
        
        switch($_SESSION['page'])
        {
            case 'home':
                include 'pages/home.php';
                break;
            
            case 'movies':
                include 'pages/movies.php';
                break;

            case 'watch-movie':
                include 'pages/watch-movie.php';
                break;
            
            case 'account':
                include 'pages/account.php';
                break;

            case 'administration':
                include 'pages/administration.php';
                break;
        }
        
        
    }
    
?>