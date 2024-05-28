<!DOCTYPE html>
<html>
<body onload="show_page()">
    

    <?php require 'pages/items/menu.php';?>

    
<?php include 'pages/items/loading.php';?>
<div id="page" class="hide">

        
        <?php if(isset($_SESSION['error_alert']) && isset($_SESSION['error_icon']) && isset($_SESSION['error'])):?>
            <?php include 'pages/items/error-modal.php';?>
            <script>$(document).ready(function(){$('#errorModal').modal('show');});</script>
        <?php endif;?>

        <br>
        <br>

    <div class="container-fluid">

        <ul class="nav nav-tabs" id="adminTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link text-dark active" id="tablesTab" data-bs-toggle="tab" data-bs-target="#tables-tab-pane" type="button" role="tab" aria-controls="tables-tab-pane" aria-selected="true">Tabelas de dados</button>
            </li>
            <li class="nav-item " role="presentation">
                <button class="nav-link text-dark" id="reportsTab" data-bs-toggle="tab" data-bs-target="#reports-tab-pane" type="button" role="tab" aria-controls="reports-tab-pane" aria-selected="false">Relatórios</button>
            </li>
        </ul>

    </div><!--container tabs-->

<br>


<div class="tab-content" id="tabsContent">
<div class="tab-pane fade show active" id="tables-tab-pane" role="tabpanel" aria-labelledby="tables-tab" tabindex="0"> 
<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->



<div class="container-fluid">
    <div class="row">

        <div class="col-12 col-auto">

        <div id="addedMovies">

        <?php 

            $movie_data = Main::get_movie_data($conn);

        ?>
        <div class="table-responsive" style="padding:20px;">
        <center>

        <table class="table table-striped table-bordered" id="movie_data" style="width:100%">
            <thead class="table-dark">
                <tr><th colspan="8"><center><h4>Administrar filmes</h4></center></th></tr>
            <tr><th>Titlulo</th><th>Data de lançamento</th><th>Gêneros</th><th>Tempo de filme</th><th>Pontuação</th><th>ID do TMDB</th><th>ID do IMDB</th><th>Eliminar</th></tr> 
            </thead>
            <tbody>
                <?php while ($data = $movie_data->fetch_array()):?>
                <tr>
                    <td><?php echo $data['title'];?></td>
                    <td><?php echo $data['release_date'];?></td>
                    <td><?php echo $data['genres'];?></td>
                    <td><?php echo $data['time'];?></td>
                    <td><?php echo $data['rating'];?></td>
                    <td><?php echo $data['tmdb_id'];?></td>
                    <td><?php echo $data['imdb_id'];?></td>
                    <td><center><button onclick="delMovie(<?php echo $data['id'];?>)" type="button" class="btn btn-outline-danger"><i class="bi bi-trash-fill"></i></button></center></td>
                    
                </tr>
                <?php endwhile;?>
            </tbody>
        </table>
        </center>
        </div>


        <!-- Movie modal -->
        <?php include 'pages/items/add_movie_modal.php';?>
        <center><button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#add_movie"><i class="bi bi-film"></i><i class="bi bi-plus"></i>&nbsp; Adicionar filmes </button></center>

        </div><!--addedMovies-->
                
        </div><!--col-->
        </div><!--row-->
        <br>
        <hr>

        <div class="row">
        <div class="col-12 col-auto">

        <div id="adminUsers">

            <?php $users_data = Main::get_users_data($conn);?>
            
            <div class="table-responsive" style="padding:20px;">
            <center>
            
            <table class="table table-striped table-bordered" id="users_data" style="width:100%">
                
                <thead class="table-dark">
                    <tr><th colspan="6"><center><h4>Administrar utilizadores</h4></center></th></tr>
                    <tr><th>ID</th><th>Nome de utilizador</th><th>Email</th><th>Nivel de premissão</th><th>Editar</th><th>Eliminar</th></tr>
                </thead>
                <tbody>
                    <?php while($data = $users_data->fetch_array()):?>
                        <tr>
                            <td><center><?php echo $data['id'];?></center></td>
                            <td><center><?php echo $data['username'];?></center></td>
                            <td><center><?php echo $data['email'];?></center></td>
                            <td><center><?php echo $data['premissions'];?></center></td>
                            <?php if($data['username'] != $_SESSION['user']->username):?>
                            <td><center><button onclick="editUser(<?php echo $data['id'].',`'.$data['username'].'`,`'.$data['email'].'`,`'.$data['password'].'`,'.$data['premissions'];?>)" type="button" class="btn btn-outline-success"><i class="bi bi-pencil-fill"></i></button></center></td>
                            <td><center><button onclick="delUser(<?php echo $data['id'];?>)" type="button" class="btn btn-outline-danger" ><i class="bi bi-person-x-fill"></i></button></center></td>
                            <?php else:?>
                            <td><center></center></td>
                            <td><center></center></td>
                            <?php endif;?>
                        </tr>
                    <?php endwhile;?>
                </tbody>
            </table>
            </center>
            </div>
            <?php include 'pages/items/add_user_modal.php';?>
            <?php include 'pages/items/edit-user-modal.php';?>
            
            <center><button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#add_user">
            <i class="bi bi-person-plus-fill"></i> &nbsp; Adicionar utilizador
            </button></center>


        </div><!--adminUsers-->


        </div><!--col-->

    </div><!--row-->
</div><!--container-->

<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
</div><!--tab-pane fade show active-->



<div class="tab-pane fade" id="reports-tab-pane" role="tabpanel" aria-labelledby="reports-tab" tabindex="0">
<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////--> 

            <?php $reports_data = Main::get_reports($conn);?>

            <?php $archived_reports_data = Main::get_archived_reports($conn);?>

                                

            <div class="container-fluid"  style="padding: 15px; border-radius: 15px;">
                <div class="row">
                    <div class="col-6 col-auto">
                        
                            <center><h3 class="text-primary"><i class="bi bi-inbox"></i> Caixa de entrada</h3></center>
                            <br>
                            <hr>
                            <div id="reports_container">
                            
                            <?php if( $reports_data->num_rows <1):?>
                        
                                <br><center><h4 id="inboxEmpty" class="text-primary text-opacity-75">A sua caixa de entrada está vazia <i class="bi bi-emoji-frown"></i></h4></center>

                            <?php else:?>
                            
                                <?php while($data = $reports_data->fetch_array()):?>
                                    
                                    <div class="alert alert-primary" id="report<?php echo $data['id'];?>">
                                        <h6><i class="bi bi-person"></i>: <?php echo $data['username'];?>[<?php echo $data['user_id'];?>]</h6>
                                        <hr>
                                        <b>
                                        <div class="reportContent">
                                            <i class="bi bi-envelope"></i> Mensagem: <?php echo $data['text'];?>
                                        </div>
                                        <br>
                                        <br><i class="bi bi-calendar-minus"></i>: <?php echo $data['date'];?>
                                        </b>
                                        <div align="right"><button class="btn btn-primary" id="btnArchive<?php echo $data['id'];?>" onclick="archive_report(<?php echo $data['id'];?>, <?php echo $data['user_id'];?>, '<?php echo $data['text'];?>', '<?php echo $data['date'];?>')"><i class="bi bi-archive"></i></button></div>
                                        
                                    </div>
                                        
                                <?php endwhile;?>
                            <?php endif;?>
                            </div>
                    </div>

                    <div class="col-6 col-auto">
                        <center><h3 class="text-secondary"><i class="bi bi-archive"></i> Arquivados</h3></center>
                        <br>
                        <hr>

                        <div id="archived_reports_container">
                        <?php if( $archived_reports_data->num_rows <1):?>

                            
                            <br><center><h4 id="archiveEmpty" class="text-muted">O seu arquivo está vazio <i class="bi bi-emoji-frown"></i></h4></center>

                        <?php else:?>

                            <?php while($data = $archived_reports_data->fetch_array()):?>
                                    
                                <div class="alert alert-warning" id="archivedReport<?php echo $data['id'];?>">
                                    <h6><i class="bi bi-person"></i>: <?php echo $data['username'];?>[<?php echo $data['user_id'];?>]</h6>
                                    <hr>
                                    <b>
                                    <div class="reportContent">
                                        <i class="bi bi-envelope"></i> Mensagem: <?php echo $data['text'];?>
                                    </div>
                                    <br>
                                    <br><i class="bi bi-calendar-minus"></i>: <?php echo $data['date'];?>
                                    </b>
                                    <div align="right"><button class="btn btn-danger" id="btnDelArchivedReport<?php echo $data['id'];?>" onclick="delete_report(<?php echo $data['id'];?>)"><i class="bi bi-trash-fill"></i></button></div>
                                </div>
                                        
                            <?php endwhile;?>
                        
                        <?php endif;?>

                        </div>
                    </div>

                </div>
            </div>





<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
</div><!--tab-pane fade-->



</div><!--tab-content-->


    <br>
    <br>
    

</div><!--page-->
    <script>


            $(document).ready(function(){
                $('#movie_data').DataTable();
                $('#users_data').DataTable();
                
            });
            

            $('#addMovie').on('click', function(){
                location = `tmdb-api-data.php?link=${$('#TMDB_ID').val()}`;
            });


            $('form#addUser').on('submit', function(){

                var username = $('#add_user input#username').val();
                var password = $('#add_user input#password').val();
                var email = $('#add_user input#email').val();
                var premissions = $('#add_user input[name=premissions]:checked').val();

                $.ajax({
                    type: "POST",
                    url: "handlers/add-user.hand.php",
                    data: {username:username, email:email, password:password, premissions:premissions},
                    success: function(data){
                        //console.log(data);
                        location.reload();
                    },
                    error: function(xhr, status, error){
                        //console.error(xhr);
                    }
                });
            });

            function delUser(id){
                                               
                //console.log(id);
            
                var id = id;

                $.ajax({
                    type: "POST",
                    url: "handlers/del-user.hand.php",
                    data: {id:id},
                    success: function(data){
                        //console.log(data);
                        location.reload();
                    },
                    error: function(xhr, status, error){
                        //console.error(xhr);
                    }
                });
            
            }

            function delMovie(id){
                                               
                //console.log(id);
            
                var id = id;

                $.ajax({
                    type: "POST",
                    url: "handlers/del-movie.hand.php",
                    data: {id:id},
                    success: function(data){
                        //console.log(data);
                        location.reload();
                    },
                    error: function(xhr, status, error){
                        //console.error(xhr);
                    }
                });
            
            }

            function editUser(id, username, email, password, premissions){
               
                $('#editUserId').html(`<center>${id}</center>`);
                $('#editUserUsername').val(username);
                $('#editUserEmail').val(email);
                $('#editUserPassword').val(password);
                $('input#editUserPassword').attr('readonly', true);

                $(`#editUser input[name=premissions][value='${premissions}']`).prop('checked', true)

                $('#editUserModal').modal('show');

            }

            $('form#editUser').on('submit', function(){
                
                var id = $('#editUserId').text();
                var username = $('#editUserUsername').val();
                var email = $('#editUserEmail').val();
                var premissions = $('#editUser input[name=premissions]:checked').val();
                
               $.ajax({
                    type: "POST",
                    url: "handlers/edit-user.hand.php",
                    data: {id:id, username:username, email:email, premissions:premissions},
                    success: function(data){
                        //console.log(data);
                        location.reload();
                    },
                    error: function(xhr, status, error){
                        //console.error(xhr);
                    }
                });
                
            });


            function archive_report(id,user_id, text,date){
                $(`#report${id}`).addClass('hide');

                $(`#btnArchive${id}`).addClass('btn-danger');
                $(`#btnArchive${id}`).html('<i class="bi bi-trash-fill"></i>');
                $(`#btnArchive${id}`).attr('onclick', `delete_report()`);
                $('#archiveEmpty').addClass('hide');
    
                $('#archived_reports_container').append(`<div class="alert alert-warning">${$(`#report${id}`).html()}</div>` );


                $.ajax({
                    type: "POST",
                    url: "handlers/archive-report.hand.php",
                    data: {id:id, user_id :user_id, text:text,date:date},
                    success: function(data){
                        //console.log(data);
                        //location.reload();
                    },
                    error: function(xhr, status, error){
                        //console.error(xhr);
                    }
                });
                

            }


            function delete_report(id = null){
                
                $(`#archivedReport${id}`).addClass('hide');
                
                $.ajax({
                    type: "POST",
                    url: "handlers/del-archived-report.hand.php",
                    data: {id:id,},
                    success: function(data){
                        //console.log(data);
                        //location.reload();
                    },
                    error: function(xhr, status, error){
                        //console.error(xhr);
                    }
                });
            }

    </script>

</body>
</html>