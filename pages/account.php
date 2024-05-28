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

        $data = $_SESSION['user']->get_user_data($conn);    
    ?>

    <br>
    <?php while($user_data = $data->fetch_array()):?>
    <div class="container" style="background-color: rgb(236, 236, 236);padding: 15px; border-radius: 15px;">
        <div class="row">
                <div class="col">
                    <center>
                    <div class="alert alert-primary" role="alert" align="justify">
                    <h4 class="alert-heading"><i class="bi bi-person-fill"></i>&nbsp;Área do Utilizador!</h4>
                    <p><i class="bi bi-info-circle-fill"></i>&nbsp;Esta é a sua área, aqui pode editar os seu dados e ver informações sobre a sua conta.</p>
                    <hr>
                    <p class="mb-0"><i class="bi bi-exclamation-triangle-fill"></i>&nbsp;Se não conseguir ou encontrar alguma dificuldade ao tentar editar os seus dados contacte o administrador por aqui (<a class="link" data-bs-toggle="modal" data-bs-target="#sendReportModal" style="cursor: pointer;">&nbsp;<i class="bi bi-telephone-fill"></i>&nbsp;Contactar administrador</a>).</p>
                    </div>
                    </center>
                </div>
            </div>
            <br>
        <div class="row">
             <div class="col"><center><div style="font-size: 5rem;"><i class="bi bi-person-circle"></i></div></center></div>            
        </div>
        <div class="row">
            <div class="col"><center><div style="font-size: 2rem;"><?php echo $user_data['username'];?></div></center></div>  
        </div>
        <br>
        <div class="row">
            <div class="col">
                <center><h4><a style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#personalData"><i class="bi bi-info-circle text-primary"></i></a>&nbsp;Dados Pessoais:</h4></center>
            </div>
            <div class="col">
                <center><h4>Dados W4TCH3R:</h4></center>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <div class="input-group">
                    <span class="input-group-text">Nome de utilizador:</span>
                    <input type="text" class="form-control" value="<?php echo $user_data['username'];?>" readonly>
                </div>
            </div>
            <div class="col">
                <center><h5>Marcados como visto</h5></center><center><h5><i class="bi bi-eye-fill text-primary"></i>&nbsp;<?php echo $user_data['n_seen'];?></h5></center>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <div class="input-group">
                    <span class="input-group-text">Email:</span>
                    <input type="email" class="form-control" value="<?php echo $user_data['email'];?>" readonly>
                </div>
            </div>
            <div class="col">
                <center><h5>Favoritos</h5></center><center><h5><i class="bi bi-star-fill text-warning"></i></i>&nbsp;<?php echo $user_data['n_fav'];?></h5></center>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <div class="input-group">
                    <span class="input-group-text">Password:</span>
                    <input type="password" class="form-control" value="<?php echo $user_data['password'];?>" readonly>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#changePassword"><i class="bi bi-pencil-fill"></i></button>
                </div>
            </div>
            <div class="col">
                <center>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#seenMoviesModal">Ver &nbsp;<i class="bi bi-eye-fill"></i></button>
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#favMoviesModal">Ver &nbsp;<i class="bi bi-star-fill"></i></button>
                </center>
            </div>
        </div>
    </div>
    <br>
    <?php endwhile;?>

        <?php include 'pages/items/change-password-modal.php';?>
        <?php include 'pages/items/pdata-modal.php';?>
        <?php include 'pages/items/send-report-modal.php';?>
        <?php include 'pages/items/seen-movies-modal.php';?>
        <?php include 'pages/items/fav-movies-modal.php';?>


</div><!--page-->

<script>

        $('#savePasswordChanges').on('click', function(){
            var oldPassword = $('#oldPassword').val();
            var password = $('#password').val();
            var confirmPassword = $('#confirmPassword').val();

            for(var c=0;c<=password.length;c++){
                var password = password.replace(' ', '');
            }

            for(var c=0;c<=confirmPassword.length;c++){
                var confirmPassword = confirmPassword.replace(' ', '');
            }


            if(oldPassword == '' || password == '' || confirmPassword == ''){
                $('#errorAlert').html('<div class="alert alert-danger"><center><h6><i class="bi bi-exclamation-triangle-fill"></i>&nbsp;Não pode deixar campos vazios!!</h6></center></div>');
            }else{
                
                if(password != confirmPassword){
                    $('#errorAlert').html('<div class="alert alert-danger"><center><h6><i class="bi bi-exclamation-triangle-fill"></i>&nbsp;Passwords não são iguais!!</h6></center></div>');
                }else if(password.length <= 8){

                    $('#errorAlert').html('<div class="alert alert-danger"><center><h6><i class="bi bi-exclamation-triangle-fill"></i>&nbsp;As passwords devem conter mais do que 8 caracteres!!</h6></center></div>');

                }else{

                    $('#changePasswordForm').submit();

                }
                
                
            }

        });


        $('#sendReportBt').on('click', function(){
            var text = $('#reportText').val();
            text = text.replace(/\n|\r/g, "");
            $.ajax({
                url: 'handlers/send-report.hand.php',
                type: "POST",
                data : {text:text},
                success: function(data){
                    //console.log(data);
                    location.reload();
                },
                error: function(xhr, status, error){
                    //console.error(xhr);
                }

            });
            
        });
        

</script>


</body>
</html>