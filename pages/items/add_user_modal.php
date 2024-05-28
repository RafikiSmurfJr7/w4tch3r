
<div class="modal fade" id="add_user" tabindex="-1" aria-labelledby="add_userLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Criar utilizador</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
        <form id="addUser" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Nome de utilizador:</label>
            <input type="text" class="form-control" id="username" required>
        </div>      
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" required>
        </div>
        <div class="mb-3">
            <label for="premissions" class="form-label">Nivel de premissão:</label>
            <div class="row">
                <div class="col-5"><input class="form-check-input" type="radio" name="premissions" value="1"><label class="form-check-label" for="1">Nvl. 1</label></div>
                <div class="col-4"><input class="form-check-input" type="radio" name="premissions" value="2"><label class="form-check-label" for="2">Nvl. 2</label></div>
                <div class="col-2"><input class="form-check-input" type="radio" name="premissions" value="3"><label class="form-check-label" for="3">Nvl. 3</label></div>
            </div>
        </div>
        
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Fechar</button>

          <button id="addUserBtn" type="submit" class="btn btn-dark">Adicionar</button>
        
      </div>
      </form>
    </div>
  </div>
</div>
