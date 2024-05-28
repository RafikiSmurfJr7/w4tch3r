<?php 

    include '../config/connect.php';

    include '../Classes/User.php'; 

    session_start();    


    $old_password = $_POST['oldPassword'];
    
    $new_password = $_POST['password'];

    $redirect = $_SESSION['user']->update_password($conn, $old_password, $new_password);

    header('Location: '.$redirect);
?>