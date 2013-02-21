<?
require 'conf.php';
require 'jsonwrapper/jsonwrapper.php';
require_once 'jsonwrapper/JSON/JSON.php';

global $couleurs;
  $couleurs = array(
            array('r' => 128, 'g' => 0,'b' => 0),
            array('r' => 153, 'g' => 255,'b' => 51),
            array('r' => 51, 'g' => 153,'b' => 153),
            array('r' => 238, 'g' => 255,'b' => 127),
            array('r' => 128, 'g' => 0,'b' => 128),
            array('r' => 40, 'g' => 131,'b' => 184),
            array('r' => 184, 'g' => 177,'b' => 40),
            array('r' => 245, 'g' => 101,'b' => 44),
            array('r' => 128, 'g' => 0,'b' => 128),
            array('r' => 0, 'g' => 128,'b' => 128),
            array('r' => 0, 'g' => 0,'b' => 128),
            array('r' => 128, 'g' => 128,'b' => 128),
            array('r' => 128, 'g' => 0,'b' => 0),
            array('r' => 128, 'g' => 128,'b' => 0),
            array('r' => 0, 'g' => 128,'b' => 0),
            array('r' => 128, 'g' => 0,'b' => 128),
            array('r' => 0, 'g' => 128,'b' => 128),
            array('r' => 0, 'g' => 0,'b' => 128),
            array('r' => 255, 'g' => 0,'b' => 0),
            array('r' => 0, 'g' => 255,'b' => 0),
            array('r' => 0, 'g' => 0,'b' => 255),
            array('r' => 255, 'g' => 255,'b' => 0),
            array('r' => 0, 'g' => 255,'b' => 255),
            array('r' => 255, 'g' => 0,'b' => 255),
            array('r' => 192, 'g' => 192,'b' => 192),
            array('r' => 128, 'g' => 128,'b' => 128),
            array('r' => 192, 'g' => 0,'b' => 64),
            array('r' => 128, 'g' => 128,'b' => 0));


global $arArtiste ;
$arArtiste = split(",", $_GET['ids']);
global $indexColor;
global $idArtiste;
$indexColor =0;


$globJson = array();
$globJson = json_decode(FILE_get_contents ("json/".$arArtiste[0] .".json"),true);
$idArtiste = $arArtiste[0] ;
$globJson['nodes'] = array_map("changeColor", $globJson['nodes']);
//   $globJson = $services_json->decode(FILE_get_contents ("json/".$arArtiste[0] .".json"),true);


function changeColor($row)
{
   global $indexColor,$couleurs;//,$idArtiste, $arArtiste;

      $row['color'] = $couleurs[$indexColor];
   return $row;
}


function verifSize($row)
{
   global $arArtiste;
   if (in_array($row['id'] , $arArtiste))
      $row['size'] = 5;

   return $row;
}

//   $globJson['nodes'][$arArtiste[0]]['color'  = 

$i=0;
foreach($arArtiste as $id)
{
   if ($i > 0)
   {
 //    $json = $services_json->decode(FILE_get_contents ("json/$id.json"),true);
      $json = (array)json_decode(FILE_get_contents ("json/$id.json"),true);
      if (count($globJson) <1)
      {
         $globJson  = $json;
      }
      elseif (is_array($json) && count($json)> 1)
      {   
         $indexColor++;
         $idArtiste = $id;
         $json['nodes'] = array_map("changeColor", $json['nodes']);
         
         $globJson['nodes'] = array_merge($globJson['nodes'], $json['nodes']);
         $globJson['edges'] = array_merge($globJson['edges'], $json['edges']);
      }
   }
 $i++;
}

$globJson['nodes'] = array_map("verifSize", (array)$globJson['nodes']);

  print json_encode($globJson);
?>
