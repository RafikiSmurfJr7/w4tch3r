<?php

    require '../config/connect.php';
    require '../Classes/Main.php';
    require '../Classes/User.php';

    session_start();

    if(isset($_POST['username']) && isset($_POST['password']))
    {
        
        $username = $_POST['username'];
        $password = $_POST['password'];

        if($username == '' || $password == '')
        {

            $_SESSION['error'] = 'Não pode deixar campos vazios!';

            header('Location: ../index.php');

        }else
        {

            $data_login= Main::login($conn, $username, $password);


            if($data_login)
            {
                

                while($data = $data_login->fetch_array())
                {
                    
                    $user_data = array(
                        'id' => $data['id'],
                        'username' =>  $data['username'],
                        'email' => $data['email'],
                        'premissions' => $data['premissions']
                    );
                    
                }

                $user = new User($user_data['id'], $user_data['username'], $user_data['email'], $user_data['premissions']); 

                //echo $user->premissions;

                $_SESSION['user'] = $user;
                $_SESSION['page'] = 'home';
                $_SESSION['active_link'] = 'home';

                header('Location: ../index.php');

            }
            else
            {
            
                $_SESSION['error'] = 'Dados Incorretos.';

                header('Location: ../index.php');

            }
        }

    }
    else
    {
        header('Location: ../index.php');
    }
    

    

?>