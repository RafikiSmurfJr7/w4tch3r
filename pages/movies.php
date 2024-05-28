<!DOCTYPE html>
<html>

<body onload="show_page()">


    <?php require 'pages/items/menu.php';?>


<?php include 'items/loading.php';?>
<div id="page" class="hide">

    <br>


    <center><h2><i class="bi bi-film"></i>&nbsp;Filmes</h2></center>
    <br>
        <div class="container">
            <div class="row">
            
                    <?php $genres = Main::get_genres($conn);?>

                    <div class="col-2">

                        <select class="form-select" aria-label="genre" id="genre">

                            <?php if(isset($_GET['genre'])):?>
                                <option value="">Categoria/Género</option>
                            <?php endif;?>

                            <option selected value="<?php if(isset($_GET['genre'])): echo $_GET['genre']; endif;?>"><?php if(isset($_GET['genre'])){echo $_GET['genre'];}else{?>Categoria/Género<?php }?></option>
                            <?php while($data_genres = $genres->fetch_array()):?>
                            <option value="<?php echo $data_genres['name_pt'];?>"><?php echo $data_genres['name_pt'];?></option>
                            <?php endwhile;?>
                        </select>

                    </div>

                    <?php $release_date = Main::get_movie_data($conn, 'release_date', 'DESC');?>


                    <div class="col-2">
                        <select class="form-select" aria-label="year" id="year">
                        <?php if(isset($_GET['year'])):?>
                            <option value="">Ano</option>
                        <?php endif;?>

                        <option selected value="<?php if(isset($_GET['year'])): echo $_GET['year'];endif;?>"><?php if(isset($_GET['year'])){echo $_GET['year'];}else{?>Ano<?php }?></option>
                            <?php  while($years = $release_date->fetch_array()):?>
                                <?php 
                                    
                                    $year = $years['release_date'][0]. $years['release_date'][1].$years['release_date'][2].$years['release_date'][3];
                                    
                                    if($year != $last_year_value):
                                ?>
                                <option value="<?php echo $year;?>"><?php echo $year;?></option>
                                <?php 
                                    endif;
                                $last_year_value = $year;?>
                            <?php  endwhile;?>
                        
                        </select>
                    </div>


                    <div class="col-5">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Nome do filme..." id="searchbar_text" value="<?php if(isset($_GET['searchbar_text'])){echo $_GET['searchbar_text'];}?>">
                        </div>
                    </div>

                    <div class="col-1">
                        <div class="input-group">
                            <button id="search_bt" type="button" class="btn btn-secondary">&nbsp;<i class="bi bi-search"></i>&nbsp;</button>
                        </div>
                    </div>

                    <div class="col-auto">
                        <a href="?" class="link-danger"><h2><i class="bi bi-trash"></i></h2></a>
                    </div>
            </div>
        </div>
    <br>

    <?php 
    
    //declaração e analise de variavéis para procura, paginação, filtração... etc

    if(isset($_GET['search']) && $_GET['search'] == true)
    {

        $title = (isset($_GET['searchbar_text'])) ? $_GET['searchbar_text'] : '%%';
        $genre = (isset($_GET['genre'])) ? $_GET['genre'] : '%%';
        $year = (isset($_GET['year'])) ? $_GET['year'] : '%%';

        $movies = Main::search_for_movie($conn, $title , $genre , $year); 

        $n_movies = Main::count_movies($conn, $title , $genre , $year);
        $n_movies=$n_movies->fetch_array();
        
        

    }
    else
    {

        $movies = Main::get_movie_data($conn,'id', 'DESC');

        $n_movies = Main::count_movies($conn);
        $n_movies=$n_movies->fetch_array();
       
    }

        $movies_per_page = 20;

        $last_page = intval($n_movies['n']/$movies_per_page+1);

        if(isset($_GET['page']))
        {
            
            $page = $_GET['page'];

            if($page < 1 || $page > $last_page)
            {
                $page = 1;
            }
        }
        else
        {
            $page = 1;
        }
    
        
    ?>

    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <?php if($movies->num_rows<1):?>

                <center><h3 class="text-danger"><i class="bi bi-emoji-frown"></i>&nbsp;Não foi encontrado nenhum filme</h3></center>

            <?php else:?>
            <?php $c=0;?>
            <?php while ($data_movies = $movies->fetch_array()):?>
                <?php if($c < $page*$movies_per_page):?>
                    <?php if($c>=($page-1)*$movies_per_page):?>
                    <div class="col-auto">
                        <?php sleep(0.1);?>
                        <div class="movie-poster-container">
                        <a href="handlers/watch-movie.hand.php?movie=<?php echo $data_movies['imdb_id'];?>"><img onerror="location.reload()" class="movie-poster" src="<?php echo $data_movies['poster_link'];?>" alt="<?php echo $data_movies['title'];?>">
                        <div class="overlay"><i class="bi bi-clock"></i> <?php echo $data_movies['time'];?></div></a>
                        </div>
                        <center><p class="movie-title"><?php echo $data_movies['title'];?></p></center>
                    </div>
                    <?php endif;?>
                <?php else:?>
                    <?php $data_movies['tmdb_id'];?>
                <?php endif;?>
                <?php $c++;?>
            <?php endwhile;?>

            <?php endif;?>
        </div>

        <br>

        <!--pagination--><?php include 'pages/items/pagination.php';?><!--pagination-->

    </div>


    <!--Guarda os valores de pesquisa antes de carregar a proxima pagina-->
    <?php $_SESSION['search_bar_val'] = $_SERVER['QUERY_STRING'];?>

</div><!--page-->


    <script>
        

        $('#search_bt').on('click', function(){
            var genre = $('#genre').val();
            var year = $('#year').val();
            var searchbar_text = $('#searchbar_text').val();
            
            searchbar_text = searchbar_text.replace("'", "");

            var url = '';

            if(genre!=''){url += `&genre=${genre}`};
            if(year!=''){url += `&year=${year}`};
            if(searchbar_text!=''){url += `&searchbar_text=${searchbar_text}`};

            location=`?search=true${url}`;

        });

        $(function () {
            if (performance.navigation.type == 1) {
                //location='?';
            }
        });

        $(document).on('keydown', function(e){
            
            if(e.key == 'F5'){
                e.preventDefault();
                location='?';
            }
        });

    </script>


</body>
</html>