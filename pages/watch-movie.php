<!DOCTYPE html>
<html>
<body onload="show_page()">
    
    <?php include 'pages/items/menu.php';?>

<?php include 'pages/items/loading.php';?>
<div id="page" class="hide">

        <?php if(isset($_SESSION['error_alert']) && isset($_SESSION['error_icon']) && isset($_SESSION['error'])):?>
            <?php include 'pages/items/error-modal.php';?>
            <script>$(document).ready(function(){$('#errorModal').modal('show');});</script>
        <?php endif;?>


    <?php 

        //obtem dados do filme

        $movie_id = $_SESSION['movie_id'];

        $watch_movie_data = Main::get_watch_data($conn, $movie_id);

        $data = $watch_movie_data->fetch_array();

        //verifica se o utilizador marcou o filme como visto ou adicionou o filme aos favoritos

        $check_fav = $_SESSION['user']->get_fav_data($conn, $movie_id);
        $check_seen = $_SESSION['user']->get_seen_data($conn, $movie_id);

        if($check_fav->num_rows<1)
        {
            $fav = false;
        }
        else
        {
            $fav = true;
        }

        if($check_seen->num_rows<1)
        {
            $seen = false;
        }
        else
        {
            $seen = true;
        }
        
    ?>

    <br>
    <br>
    <div class="container" style="background-color: rgb(236, 236, 236);padding: 15px; border-radius: 15px;">
    <div class="row">
        <div class="col-6">
            <a href="handlers/movies.hand.php" class="link-dark"><h2><i class="bi bi-arrow-left-circle-fill arrow-back"></h2></i></a>
        </div>
        <div class="col-5">
            <a href="handlers/add-to-fav.hand.php?id=<?php echo $data['imdb_id'];?>" class="link-dark"><h2><i class="bi bi-star<?php if($fav){echo '-fill';}?> text-warning"><?php if($fav){echo '<i class="bi bi-check text-success"></i>';};?></h2></i></a>
        </div>
        <div class="col-1">
            <a href="handlers/add-to-seen.hand.php?id=<?php echo $data['imdb_id'];?>" class="link-dark"><h2><i class="bi <?php if(!$seen){echo 'bi-eye-slash-fill';}else{echo 'bi-eye-fill';}?> text-primary"><?php if($seen){echo '<i class="bi bi-check text-success"></i>';};?></h2></i></a>
        </div>
    </div>
        <div class="row">
            <div class="col-auto">
                <img style="border-radius: 10px;" src="<?php echo $data['poster_link'];?>" alt="<?php echo $data['title'];?>" width="300">
                <br>
                <br>
                <center><p><i class="bi bi-clock"></i> Duração: <?php echo $data['time'];?></p></center>
            </div>
            <div class="col">
                <center><h1><?php echo $data['title'];?> (<?php echo $data['release_date'][0].$data['release_date'][1].$data['release_date'][2].$data['release_date'][3];?>)</h1></center>
                <center><h6>(<?php echo str_replace(' ',';', $data['genres']);?>)</h6></center>
                <hr>
                <center><h5>"<?php echo $data['tagline'];?>"</h5></center>
                <br>
                <p><?php echo $data['description'];?></p>
                <br>
                <div class="row justify-content-md-center">
                    <div class="col-md-auto col-md-4"><center><h5><i class="bi bi-star-fill" style="color: rgb(246, 199, 0);"></i> Avaliação:</h5><br><h6 class="rating"><?php echo $data['rating'];?> <i class="bi bi-hand-thumbs-up-fill" style="color: green;"></i></h6><br><h6 class="rating"><?php echo 100 - intval(str_replace('%','',$data['rating']));?>% <i class="bi bi-hand-thumbs-down-fill" style="color: red;"></i></h6></center></div>
                    
                    <div class="col-md-auto col-md-4"><center><h5><i class="bi bi-link-45deg"></i>IMDB</h5><br><br><a class="imdb-link" href="https://www.imdb.com/title/<?php echo $data['imdb_id'];?>" target="_blank"><img src="assets/img/imdblogo.svg" alt="imdblogo" width="100"></a></center></div>
                    <div class="col-md-auto col-md-4"><center><h5><i class="bi bi-link-45deg"></i>TMDB</h5><br><a href="https://www.themoviedb.org/movie/<?php echo $data['tmdb_id'];?>" target="_blank"><img class="tmdb-logo" src="assets/img/tmdblogo.svg" alt="tmdblogo" width="100"></a></center></div>
                    
                </div>
                
            </div>
        </div>
        <br>
        <!--<div class="row">
            <div class="col-12 d-flex justify-content-center">
                <iframe class="screen" src="https://fsapi.xyz/movie/<?php //echo $data['tmdb_id'];?>" frameborder="0" allowfullscreen></iframe>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            </div>
        </div>-->
        
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <iframe class="screen" src="https://v2.vidsrc.me/embed/<?php echo $data['imdb_id'];?>" frameborder="0" height=720 allowfullscreen></iframe>
            </div>
        </div>

    </div>
    <br>
 
</div><!--page-->

</body>
</html>