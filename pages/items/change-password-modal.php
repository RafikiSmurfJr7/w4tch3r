<div class="modal fade" tabindex="-1" id="changePassword" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
          <div class="modal-header">
              <h3>Mudar palavra-passe</h3>
              <a style="cursor:pointer;font-size: 1.5rem;" data-bs-dismiss="modal"><i class="bi bi-x-lg text-danger"></i></a>
          </div>
          <div class="modal-body">
              <form action="handlers/change-password.hand.php" id="changePasswordForm" method='POST'>
              <div id="errorAlert"></div>
              <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="input-group">
                            <span class="input-group-text"><h4><i class="bi bi-key-fill"></i></h4></span>
                            <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Palavra-passe antiga...">
                            <br>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                  <div class="col">
                    <div class="input-group">
                          <span class="input-group-text"><h4><i class="bi bi-key-fill"></i></h4></span>
                          <input type="password" class="form-control" id="password" name="password" placeholder="Palavra-passe nova...">
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col">
                    <div class="input-group">
                          <span class="input-group-text"><h4><i class="bi bi-key-fill"></i></h4></span>
                          <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirmar nova palavra-passe...">
                          <br>
                    </div>
                  </div>
                </div>
              </div>
              </form>
          </div>
          <div class="modal-footer">
              <button class="btn btn-success" id="savePasswordChanges">Salvar alterações</button>
          </div>
    </div>
  </div>
</div>


