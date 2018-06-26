<?php
/*________________________________________________________________

   API Developed by Lenilson Madureira, for educational purposes.
   25/06/2018 - Catu-BA

___________________________________________________________________*/

header("Content-type: application/json; charset=utf-8"); // add header Json
header("Access-Control-Allow-Origin: *");               // Permission for read in server




// taking page information and save in variable @html
$url = 'https://www.animesonlinebr.com.br/animes-legendados.html';
$html = file_get_contents($url);


// scrapping page
$pattern_link= '/<li><a title="(.*s)" href="(https.*)">?/';
preg_match_all($pattern_link,$html,$links);

$position =$_GET['data']; // variable contain position in array


/*
This function find URL the contains anime information
    @links -> Links_array($links);
    @position -> Animes_array[x];
*/


function find_link($links,$position) { 
    
    $count2 =1;
    

    foreach($links as $key){
        foreach($key as $x => $valor) {
            
            
            if($count2 == 3 && $x == $position){
                $url = $valor; 
            
            }      
        }
        $count2++;
    }
    $data = load_info_anime($url,$position);
    return $data;

}

/*
This function find anime information in URL
    @url -> 'https:// .*';
    @position -> Animes_array[x];
*/


function load_info_anime($url,$position){

    
    $html = file_get_contents($url);
    
    $pattern_tags = '/<span itemprop="genre">(.*)<\/span>/';
    $pattern_sinopse = '/<p id="sinopse2" style="display:block !important;">(.*)<\/p>/';
    $pattern_img = '/<div id="capaAnime"><img src="(.*)" ?alt/';

    preg_match_all($pattern_tags,$html,$tags);
    preg_match_all($pattern_sinopse,$html,$sinopses);
    preg_match_all($pattern_img,$html,$imgs);

    $data['id'] =$position;
    $data['tags'] = $tags[1];
    $data['sinopse'] = $sinopses[1];
    $data['img']=$imgs[1];
    
    return $data;

}

$data = find_link($links,$position);
$data = json_encode($data);
echo "$data";


