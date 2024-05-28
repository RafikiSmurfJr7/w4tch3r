<div class="modal fade" tabindex="-1" id="favMoviesModal">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-star-fill text-warning"></i>&nbsp;Filmes favoritos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <?php 
            $fav_movies_data = $_SESSION['user']->get_fav_movies($conn);
        ?>

        <?php if($fav_movies_data->num_rows<1):?>

            <div class="container-fluid">
                <div class="row"><center><h3 class="text-warning"><i class="bi bi-emoji-frown"></i>&nbsp;Você nao tem nenhum filme adicionado nesta categoria</h3></center></div>
            </div>

        <?php else:?>

            <div class="container-fluid">
                
                <?php while($fav_movies = $fav_movies_data->fetch_array()):?>

                <div class="row">
                    <div class="col-auto"><img onerror="location.reload()" src="<?php echo $fav_movies['poster_link'];?>" alt="<?php $fav_movies['title']?>" width="50"></div>
                    
                    <div class="col-10"><h5><?php echo $fav_movies['title'];?> (<?php echo $fav_movies['time'];?>)</h5><h6><?php echo $fav_movies['description'];?></h6></div>

                    <div class="col-1"><h6>Adicionado como favorito em:</h6><h6><?php echo $fav_movies['date'];?></h6><p><a class="text-primary" href="handlers/watch-movie.hand.php?movie=<?php echo $fav_movies['imdb_id'];?>"><i class="bi bi-film"></i>&nbsp;Ver Pagina</a></p></div>
                </div>
                <hr>
                <br>
                <?php endwhile;?>
            </div>

        <?php endif;?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>