<?php

    class Main
    {


        public static function login($conn ,$username, $password)
        {
            
            $query = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = md5('$password')";

            $result = $conn->query($query);

            if($result->num_rows >= 1)
            {
                
                $result_data = $result->fetch_array();
                
                if($result_data['username'] == $username)
                {
                    $result = $conn->query($query);
                    return $result;    
                }
            }else
            {
                return false;
            }

        }

        public static function logout()
        {
            session_start();
            session_destroy();

            header('Location: ../index.php');
        }


        public static function get_menu($conn)
        {
            $query="SELECT * FROM `menu`";

            return $menu = $conn->query($query);
        }


        public static function insert_movie_data($conn, $tmdb_id, $imdb_id, $title, $tagline, $description, $genres, $release_date, $time, $rating, $poster_link)
        {
            $query = "SELECT * FROM `movies` WHERE `tmdb_id` = '$tmdb_id'";

            $result = $conn->query($query);
            session_start();
            if($result->num_rows == 0)
            {


                $query = "INSERT INTO `movies`(`tmdb_id`, `imdb_id`, `title`, `tagline`, `description`, `genres`, `release_date`, `time`, `rating`, `poster_link`) VALUES ('$tmdb_id','$imdb_id','$title','$tagline','$description','$genres','$release_date','$time','$rating','$poster_link')";
                
                $conn->query($query);


                $_SESSION['error_alert']= 'success';
                $_SESSION['error_icon']= 'bi-check-circle';
                $_SESSION['error']= 'Filme inserido com sucesso';

            }
            else
            {
                $_SESSION['error_alert']= 'danger';
                $_SESSION['error_icon']= 'bi-x-circle';
                $_SESSION['error']= 'O filme já se encontra na base de dados!!';
            }
            
            return '../index.php';
        }

        public static function get_movie_data($conn,$orderby = null, $order= null)
        {


            if($orderby != null)
            {
                $query = "SELECT * FROM `movies` ORDER BY `$orderby` $order";
            }
            else
            {
                $query = "SELECT * FROM `movies`";
            }

            

            return $conn->query($query);

        }

        public static function get_users_data($conn)
        {
            $query = "SELECT * FROM `users`";

            return $conn->query($query);
        }

        public static function add_user($conn, $username, $email,$password, $premissions)
        {

            session_start();

            $query="SELECT * FROM `users` WHERE `username` = '$username' OR `email` = '$email'";

            $result = $conn->query($query);

            if($result->num_rows < 1)
            {
                $query = "INSERT INTO `users`(`username`, `email`, `password`, `premissions`) VALUES ('$username','$email', MD5('$password'),'$premissions')";
                $conn->query($query);

                $_SESSION['error_alert']= 'success';
                $_SESSION['error_icon']= 'bi-check-circle';
                $_SESSION['error']= 'Utilizador inserido com sucesso.';
            }
            else
            {
                $_SESSION['error_alert']= 'danger';
                $_SESSION['error_icon']= 'bi-x-circle';
                $_SESSION['error']= 'Não foi possivel inserir o utilizador...';
            }


            header('Location: ../index.php');
        }

        public static function del_user($conn, $id)
        {

            session_start();

            $query = "DELETE FROM `users` WHERE `id` = '$id'";
            $result = $conn->query($query);
            $query = "DELETE FROM `seen` WHERE `id_user` = '$id'";
            $result = $conn->query($query);
            $query = "DELETE FROM `favorites` WHERE `id_user` = '$id'";
            $result = $conn->query($query);


            $_SESSION['error_alert']= 'success';
            $_SESSION['error_icon']= 'bi-check-circle';
            $_SESSION['error']= 'Utilizador eliminado com sucesso.';
        
        
        }

        public static function get_genres($conn)
        {
            $query = "SELECT * FROM `genres` ORDER BY `name_pt` ASC";

            return $conn->query($query);

        }

        public static function search_for_movie($conn, $title , $genre , $year)
        {
            $query = "SELECT * FROM `movies` WHERE `title` LIKE '%$title%' AND `genres` LIKE '%$genre%' AND `release_date` LIKE '%$year%' ORDER BY `release_date` DESC";
            
            return $conn->query($query);
        
        }

        public static function count_movies($conn, $title='' , $genre='' , $year='')
        {
            $query = "SELECT COUNT(`tmdb_id`) AS 'n' FROM `movies` WHERE `title` LIKE '%$title%' AND `genres` LIKE '%$genre%' AND `release_date` LIKE '%$year%' ORDER BY `release_date` ASC";

            return $conn->query($query);
            
        }

        public static function get_watch_data($conn, $imdb_id)
        {
            $query="SELECT * FROM `movies` WHERE `imdb_id` = '$imdb_id'";

            $result = $conn->query($query);

            if($result->num_rows >= 1)
            {
                return $result;
            }

        }


        //apenas utilizador quando se verifica que não é um link de um filme
        //talves depois mudar para todos os erros serem gerados por esta função
        public static function administration_insert_error()
        {
            session_start();

            $_SESSION['error_alert']= 'warning';
            $_SESSION['error_icon']= 'bi bi-exclamation-triangle';
            $_SESSION['error']= '[ERRO]... Certifique-se que o link que inseriu se refere a um filme.';

            header('Location: index.php');
        }

        public static function del_movie($conn, $id)
        {
            $query = "DELETE FROM `movies` WHERE `id` = '$id'";

            $conn->query($query);

            $_SESSION['error_alert']= 'success';
            $_SESSION['error_icon']= 'bi bi-check-circle';
            $_SESSION['error']= 'Filme eliminado com sucesso.';

        }


        public static function update_user_data($conn, $id, $username, $email, $premissions)
        {
            $query = "UPDATE `users` SET `username`='$username',`email`='$email',`premissions`='$premissions' WHERE `id` = '$id'";
        
            $conn->query($query);

            $_SESSION['error_alert']= 'success';
            $_SESSION['error_icon']= 'bi bi-check-circle';
            $_SESSION['error']= 'Dados atualizados com sucesso.';
        

            header('Location: ../index.php');

        }

        public static function get_reports($conn)
        {
            $query = "SELECT reports.id as id,users.id as user_id ,users.username as username , reports.content as text, reports.date  as date from users INNER JOIN reports ON reports.id_user = users.id ORDER BY reports.date DESC";
        
            return $conn->query($query);
        
        }

        public static function get_archived_reports($conn)
        {
            $query = "SELECT reports_archive.id as id,users.id as user_id ,users.username as username , reports_archive.content as text, reports_archive.date  as date from users INNER JOIN reports_archive ON reports_archive.id_user = users.id ORDER BY reports_archive.date DESC";
        
            return $conn->query($query);
        
        }

        public static function archive_report($conn, $id, $user_id, $content, $date)
        {
            $query="DELETE FROM `reports` WHERE `id` = $id";

            $conn->query($query);

            $query="INSERT INTO `reports_archive`(`id_user`, `content`, `date`) VALUES ('$user_id','$content','$date')";

            $conn->query($query);

        }

        public static function del_archived_report($conn, $id)
        {
            $query="DELETE FROM `reports_archive` WHERE `id` = $id";

            $conn->query($query);
        }

    
        
    
    
    }



?>