<?php

    include 'includes/head.inc.php';
    include 'Classes/Main.php';

    $tmdb_id = $_GET['link'];


    if(strpos($tmdb_id , 'https://www.themoviedb.org/movie/') === false)
    {

        Main::administration_insert_error();
        
    }



    $tmdb_id = str_replace('https://www.themoviedb.org/movie/', '' , $tmdb_id);
    //$tmdb_id = substr($tmdb_id, 0, strpos($tmdb_id, '-'));


    //$tmdb_id = 507086;

    $url = "https://api.themoviedb.org/3/movie/".$tmdb_id."?api_key=1ce463e8d4f905fbe27f298a95ed051b&language=pt-BR";
    echo "<div id='data' style='color: white;'>";
    
    $content = file_get_contents($url);
    if($content==false)
    {
        Main::administration_insert_error();
    }
    /*remove
    if($content == false){
        header('Location:?link=https://www.themoviedb.org/movie/'.$tmdb_id+1);
    }
    */
    print_r($content);
    echo "</div>";

?>

<script>

    var data_obj = JSON.parse($('#data').text());

    var imdb_id = data_obj.imdb_id;
    var tmdb_id = data_obj.id;
    var title = data_obj.original_title;
    var title = title.replaceAll("'", '');
    var release_date = data_obj.release_date;
    //organiza a data de maneira correta, mas nao é eficiente na BD
    //var release_date = `${release_date[8]}${release_date[9]}-${release_date[5]}${release_date[6]}-${release_date[0]}${release_date[1]}${release_date[2]}${release_date[3]}`;
    var description = data_obj.overview;
    var description = description.replaceAll("'", '');
    if(data_obj.poster_path != null && data_obj.poster_path != undefined){
        var poster_link = 'https://image.tmdb.org/t/p/original/' + data_obj.poster_path;
    }
    var time_min = data_obj.runtime;
    var time = String(parseInt(time_min/60)) + 'h:'+String(time_min - 60 * parseInt(time_min/60)) + 'm';
    var rating = String(Math.round(data_obj.vote_average*10));
    var rating = rating + '%';
    var tagline = data_obj.tagline;
    var tagline = tagline.replaceAll("'", '');
    var genres = '';
    for(var c=0;c<data_obj.genres.length;c++){
        
        var genres = genres + data_obj.genres[c].name + ' ' ;
    }

    console.log(tmdb_id);
    console.log(imdb_id);
    console.log(title);
    console.log(tagline);
    console.log(description);
    console.log(genres);
    console.log(release_date);
    console.log(time);
    console.log(rating);
    console.log(poster_link);

    location=`handlers/insert-movie.hand.php?tmdb_id=${tmdb_id}&imdb_id=${imdb_id}&title=${title}&tagline=${tagline}&description=${description}&description=${description}&genres=${genres}&release_date=${release_date}&time=${time}&rating=${rating}&poster_link=${poster_link}`;
    

</script>