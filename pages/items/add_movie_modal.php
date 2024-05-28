
<div class="modal fade" id="add_movie" tabindex="-1" aria-labelledby="add_movie" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addMovieLabel">Adicionar Filme</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="linkIcon"><i class="bi bi-link"></i></span>
                            <input type="text" class="form-control" id="TMDB_ID" placeholder="Insira o link TMDB" aria-label="TMDBLink" aria-describedby="TMDBLink">
                        </div>
                    </div>
                </div>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Fechar</button>
        <button id="addMovie" type="button" class="btn btn-dark">Adicionar</button>
      </div>
    </div>
  </div>
</div>

