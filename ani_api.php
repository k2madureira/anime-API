<?php

/*________________________________________________________________

   API Developed by Lenilson Madureira, for educational purposes.
   25/06/2018 - Catu-BA

___________________________________________________________________*/

header("Content-type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");


$url = 'https://www.animesonlinebr.com.br/animes-legendados.html';
$html = file_get_contents($url);
$pattern = '/<li><a title="(.*s)"/';
  

preg_match_all($pattern,$html,$matches);


//var_dump($matches_link);

$count=1;


foreach($matches as $key){
    foreach($key as $x=> $valor) {
        
        if($count == 2){

            $str = str_replace(" - Episódios","",$valor);
            $str = deleteAccents($str);
            $str_position = substr($str,0,1);

           $info[$str_position][$x]['name']=$str;
           $info[$str_position][$x]['info']='https://twoconeb.000webhostapp.com/projetos/anime_API/ani_info.php?data='.$x;
           //$info[$str_position][$x]['info']='http://localhost/anime api/ani_info.php?data='.$x;
           
        }      
    }
    $count++;
}
  

function deleteAccents ($string){
    // REMOVING SPECIAL ACCENTS
    $tr = strtr($string,
        array (
          'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
          'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E',
          'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ð' => 'D', 'Ñ' => 'N',
          'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O',
          'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Ŕ' => 'R',
          'Þ' => 's', 'ß' => 'B', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
          'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
          'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
          'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
          'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y',
          'þ' => 'b', 'ÿ' => 'y', 'ŕ' => 'r', 'º' => '', 'ª' => ''
        )
    );

    return $tr;
}



$info = json_encode($info);

echo "$info"; 