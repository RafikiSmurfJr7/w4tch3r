<div class="modal" tabindex="-1" id="errorModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="alert alert-<?php if(isset($_SESSION['error_alert'])){echo $_SESSION['error_alert'];unset($_SESSION['error_alert']);}?>" style="margin: 0px;">
            <h5><i class="<?php if(isset($_SESSION['error_icon'])){echo $_SESSION['error_icon']; unset($_SESSION['error_icon']);}?>"></i>&nbsp;<?php if(isset($_SESSION['error'])){echo $_SESSION['error'];unset($_SESSION['error']);}?></h5>
      </div>
    </div>
  </div>
</div>