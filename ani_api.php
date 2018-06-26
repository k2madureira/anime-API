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

$count=1;
$x =1;

$ani_array = array();

foreach($matches as $key){
    foreach($key as $valor) {
        
        if($count == 2){

            $str = str_replace(" - Episódios","",$valor);
            $str = deleteAccents($str);
            $str_position = substr($str,0,1);

           $aniName[$str_position][]=$str;
           $x++;
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
$aniName = json_encode($aniName);
echo "$aniName"; 