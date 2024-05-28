<?php 

    class User
    {

        public int $id;
        public string $username;
        public string $email;
        public int $premissions;

        public function __construct($id, $username, $email, $premissions)
        {
            $this->id = $id;
            $this->username = $username;
            $this->email = $email;
            $this->premissions = $premissions;
        }

        public function get_user_data($conn)
        {
            $query = "SELECT users.*, (SELECT COUNT(favorites.id)FROM favorites JOIN users ON favorites.id_user = users.id where users.id = '$this->id') AS 'n_fav', (SELECT COUNT(seen.id)FROM seen JOIN users ON seen.id_user = users.id  where users.id = '$this->id') AS 'n_seen' FROM users WHERE users.id = '$this->id';";
        
            return $conn->query($query);
        }

        public function update_password($conn, $old_password, $new_password)
        {
            
            $result = $this->get_user_data($conn);

            $result = $result->fetch_array();

            $user_password = $result['password'];

            if($user_password != md5($old_password))
            {
                $_SESSION['error_alert'] = 'danger';
                $_SESSION['error_icon'] = 'bi-x-circle';
                $_SESSION['error'] = '[ERROR] A password que inseriu não é a sua.';

                
            }
            else
            {

                $query = "UPDATE `users` SET `password`= md5('$new_password') WHERE `id` = '$this->id'";
                
                $conn->query($query);

                $_SESSION['error_alert']= 'success';
                $_SESSION['error_icon']= 'bi-check-circle';
                $_SESSION['error'] = 'Dados atualizados.';
            
            }

            return '../index.php';

        }


        public function send_report($conn, $text)
        {
            $query = "INSERT INTO `reports`(`id_user`, `date`, `content`) VALUES ('$this->id', UTC_DATE() ,'$text')";
        
            $conn->query($query);

            $_SESSION['error_alert']= 'primary';
            $_SESSION['error_icon']= 'bi-envelope-check';
            $_SESSION['error'] = 'Relatório enviado com sucesso!';
            
        }

        public function add_to_fav($conn, $id)
        {
            $query = "SELECT * FROM `favorites` WHERE `id_user` = '$this->id' and `imdb_id` = '$id'";

            $result = $conn->query($query);

            if($result->num_rows < 1)
            {
                $query = "INSERT INTO `favorites`(`id_user`, `imdb_id`, `date`) VALUES ('$this->id','$id',UTC_DATE())";
            
                $conn->query($query);

                $_SESSION['error_alert']= 'success';
                $_SESSION['error_icon']= 'bi-check';
                $_SESSION['error'] = 'Filme adicionado aos favoritos!';
            
            }
            else
            {
                
                $result = $result->fetch_array();

                $fav_table_id = $result['id'];
                
                $query = "DELETE FROM `favorites` WHERE `id` = '$fav_table_id'";
            
                $conn->query($query);

                $_SESSION['error_alert']= 'primary';
                $_SESSION['error_icon']= 'bi-film';
                $_SESSION['error'] = 'Filme removido dos favoritos!';
            

            }

            header('Location: ../index.php');
        }

        public function get_fav_data($conn, $movie_id)
        {
            $query = "SELECT * FROM `favorites` WHERE `id_user` = '$this->id' and `imdb_id` = '$movie_id'";
        
            return $conn->query($query);
        
        }

        public function add_to_seen($conn, $id)
        {
            $query = "SELECT * FROM `seen` WHERE `id_user` = '$this->id' and `imdb_id` = '$id'";

            $result = $conn->query($query);

            if($result->num_rows < 1)
            {
                $query = "INSERT INTO `seen`(`id_user`, `imdb_id`, `date`) VALUES ('$this->id','$id',UTC_DATE())";
            
                $conn->query($query);

                $_SESSION['error_alert']= 'success';
                $_SESSION['error_icon']= 'bi-eye-fill';
                $_SESSION['error'] = 'Filme adicionado como visto!';
            
            }
            else
            {
                
                $result = $result->fetch_array();

                $seen_table_id = $result['id'];
                
                $query = "DELETE FROM `seen` WHERE `id` = '$seen_table_id'";
            
                $conn->query($query);

                $_SESSION['error_alert']= 'primary';
                $_SESSION['error_icon']= 'bi-eye-slash-fill';
                $_SESSION['error'] = 'Filme removido como visto!';
            

            }

            header('Location: ../index.php');
        }

        public function get_seen_data($conn, $movie_id)
        {
            $query = "SELECT * FROM `seen` WHERE `id_user` = '$this->id' and `imdb_id` = '$movie_id'";
        
            return $conn->query($query);
        
        }

        public function get_movies_seen($conn)
        {
            $query="SELECT movies.* , seen.id_user, seen.date FROM `movies` JOIN `seen` ON movies.imdb_id = seen.imdb_id WHERE seen.id_user = '$this->id'";
        
            return $conn->query($query);
        
        }

        public function get_fav_movies($conn)
        {
            $query="SELECT movies.* , favorites.id_user, favorites.date FROM `movies` JOIN `favorites` ON movies.imdb_id = favorites.imdb_id WHERE favorites.id_user = '$this->id'";
        
            return $conn->query($query);
        
        }

    }

?>