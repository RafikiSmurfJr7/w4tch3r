<!DOCTYPE html>
<html>
<body class="login-body">
    
    
<div class="container .container-sm center-page" style="background-color: white; width: 500px; border-radius: 10px; padding: 20px;">
    <div class="row justify-content-center">
        <div class="col-sm-10">
            <img src="assets/img/w4tc3r_logo_dark.svg" alt="logo">
        </div>
    </div>
    <br>
    <?php if(isset($_SESSION['error'])):?>
        <div class="alert alert-danger" role="alert">
            <center><?php echo $_SESSION['error'];?></center>
        </div>
    <?php session_destroy();?>    
    <?php endif;?>
    <div class="row justify-content-center">
    <form action="handlers/login.hand.php" method="POST">
        <div class="mb-4">
            <label for="username" class="form-label">Nome de Utilizador:</label>
            <input type="text" class="form-control" id="username" name="username">
        </div>
        <div class="mb-4">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        
        
        <center><button type="submit" id="bt_login" class="btn btn-dark">Entrar</button></center>
        
    </form>
    <!--<center><br><a href="#" class="link-dark">Cria a tua conta!</a></center>-->
    </div>
</div>

    <script>

        $(function () {
            if (performance.navigation.type == 1) {
                location='?';
            }
        });

    </script>

</body>
</html>