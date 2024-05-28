<!DOCTYPE html>
<html>
<body onload="show_page()">
    
    
    <?php include 'pages/items/menu.php';?>

<?php include 'pages/items/loading.php';?>
<div id="page" class="hide">



    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="alert alert-secondary">
                    <h4><b>Bem vindo ao W4TCH3R, <?php echo $_SESSION['user']->username;?>.</b></h4>
                    <h6>Este é um site em desenvolvimento de filmes com streaming...</h6>
                </div>
            </div>
        </div>
    
        <br>
               

        <?php $news_movie_data = Main::get_movie_data($conn, 'release_date', 'DESC');?>


        <div class="row">

            <center><h3><i class="bi bi-ticket-perforated-fill"></i>&nbsp;Novidades</h3></center>
            <br>
            <br>
            <hr>

            <div id="owlCarouselNewMovies" class="owl-carousel owl-theme">
                
                <?php $c=1;while( $c<=10 && $news_movie = $news_movie_data->fetch_array()):?>
                
                
                <div class="item">

                    <div class="movie-poster-container">
                        <a href="handlers/watch-movie.hand.php?movie=<?php echo $news_movie['imdb_id'];?>"><img onerror="location.reload()" class="movie-poster" src="<?php echo $news_movie['poster_link'];?>" alt="<?php echo $news_movie['title'];?>">
                        <div class="overlay"><i class="bi bi-clock"></i> <?php echo $news_movie['time'];?></div></a>
                    <center><p class="movie-title"><?php echo $news_movie['title'];?></p></center>
                    </div>
                </div>
            

                <?php $c++;endwhile;?>

            </div>


        </div>


        <br>
        <br>

        <?php $bestScore_movie_data = Main::get_movie_data($conn, 'rating', 'DESC');?>

        <div class="row">
        <center><div class="col-auto"><h3><i class="bi bi-stars"></i><i class="bi bi-camera-reels-fill"></i>&nbsp;Top 5 melhor pontuação</h3></div></center>
        </div>

        <hr>
        <br>

        <div class="row">
            
            <div id="owlCarouselTopMovies" class="owl-carousel owl-theme">
                <?php $c=1;while($c<=5 && $bestScore_movie = $bestScore_movie_data->fetch_array()):?>
                    <div class="item">
                    
                        <div class="movie-poster-container">
                        <a href="handlers/watch-movie.hand.php?movie=<?php echo $bestScore_movie['imdb_id'];?>"><img onerror="location.reload()" class="movie-poster" src="<?php echo $bestScore_movie['poster_link'];?>" alt="<?php echo $bestScore_movie['title'];?>">
                        <div class="overlay"><i class="bi bi-clock"></i> <?php echo $bestScore_movie['time'];?></div></a>
                        <center><p class="movie-title"><b><?php echo $c .'º</b> '. $bestScore_movie['title'];?></p></center>
                        </div>
                       
                    
                    </div>
                <?php $c+=1;endwhile;?>
            </div>

        </div>



    </div>

    
    <br>
    <br>

</div><!--page-->


<script>

        $('#owlCarouselNewMovies').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            mouseDrag: false,
            responsive:{
                0:{
                    items:1
                },
                500:{
                    items:4
                },
                1000:{
                    items:6
                }
            }
        });
        $('.owl-nav').css('font-size', '50');
        $('.owl-nav').css('margin-top', '-20');

        owlCarouselTopMovies

        $('#owlCarouselTopMovies').owlCarousel({
            loop:true,
            margin:0,
            nav:true,
            mouseDrag: false,
            responsive:{
                0:{
                    items:1
                },
                500:{
                    items:2
                },
                1000:{
                    items:5
                }
            }
        });



</script>
</body>
</html>