<div class="row" id="pagination">
    <div class="col-12 d-flex justify-content-center">
        
        <nav aria-label="movie-page-nav">
        <ul class="pagination">
            <li class="page-item <?php if($page <= 1){echo 'disabled';}?>">
            <a class="page-link bg-dark text-white movies-pagination" href="?<?php echo str_replace('&page='.$page, '', $_SERVER['QUERY_STRING']);?>&page=<?php echo $page-1;?>" aria-label="Previous">
            <i class="bi bi-caret-left-fill">&nbsp;</i>
            </a>
            </li>
            
            <?php if($page != 1):?>
            <li class="page-item"><a class="page-link bg-dark text-white movies-pagination" href="?">1</a></li>
            <?php endif;?>
            <?php for($c=$page;$c<=$page+5;$c++):?>
                <?php if($c>=$last_page){break;}?>
                <li class="page-item "><a class="page-link bg-dark text-white movies-pagination <?php if($c == $page){echo 'page-selected';}?>" href="?<?php echo str_replace('&page='.$page, '', $_SERVER['QUERY_STRING']);?>&page=<?php echo $c;?>"><?php echo $c;?></a></li>
            <?php endfor;?>

            <li class="page-item disabled"><a class="page-link bg-dark text-white movies-pagination">...</a></li>
            <li class="page-item"><a class="page-link bg-dark text-white movies-pagination <?php if($c == $page){echo 'page-selected';}?>" href="?<?php echo str_replace('&page='.$page, '', $_SERVER['QUERY_STRING']);?>&page=<?php echo $last_page;?>"><?php echo $last_page;?></a></li>
            
            <li class="page-item <?php if($page >= $last_page){echo 'disabled';}?>">
            <a class="page-link bg-dark text-white movies-pagination" href="?<?php echo str_replace('&page='.$page, '', $_SERVER['QUERY_STRING']);?>&page=<?php echo $page+1;?>" aria-label="Next">
            <i class="bi bi-caret-right-fill">&nbsp;</i>
            </a>
            </li>
        </ul>
        </nav>
        
    </div>
</div>