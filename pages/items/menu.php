<nav class="navbar sticky-top navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand">
           <center>&nbsp;&nbsp;&nbsp;&nbsp;<img src="assets/img/w4tc3r_logo.svg" alt="" width="250"  class="d-inline-block align-text-top"></center> 
        </a>
        
        <ul class="nav justify-content-end">
             
            <?php
            
                

                $menu = Main::get_menu($conn);

                while ($item = $menu->fetch_array()):
                    if($_SESSION['user']->premissions>=$item['permissions']):
            ?>
        
                        
                    
                        <?php if($item['value'] == 'logout'):?>
                            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#logoutModal"><?php echo $item['items'];?></button>
                        <?php else:?>
                        <li class="nav-item">
                            <?php if(isset($_SESSION['active_link']) && $_SESSION['active_link'] == $item['value']):?>
                                <a class="nav-link link-light menu-link active" href="<?php echo $item['path'];?>"><?php echo $item['items'];?></a>
                            <?php else:?>
                                <a class="nav-link link-light menu-link" href="<?php echo $item['path'];?>"><?php echo $item['items'];?></a>
                            <?php endif;?>
                        </li>
                        <?php endif;?> 
                    
            
            <?php 
                    endif;
                endwhile;?>
        </ul>
        

    </div>
    </nav>
