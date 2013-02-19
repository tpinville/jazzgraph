<?
require 'conf.php';
$db="jazzgraph";
$connection = mysql_connect($GLOBALS["url"],$GLOBALS["user"],$GLOBALS["password"]);
// test la connection
if ( ! $connection )
{
  die ("connection impossible");
}


// Connecte la base
mysql_select_db($db) or die ("pas de connection");

function getSelectBox($ids)
{
  $arIds = split(",",$ids);
  $requete = "select name, Artists.id as id from
   Artists 
   INNER JOIN Credits ON Credits.artistid = Artists.id
   INNER JOIN Albums ON  Albums.id = Credits.albumid 
   INNER JOIN LinksArtistCategory on LinksArtistCategory.artistid = Artists.id
   INNER JOIN ArtistCategories on ArtistCategories.id = LinksArtistCategory.artistCategoryId
   and ArtistCategories.id = 1
   group by name";
  $q = mysql_query($requete); 
  while($r = mysql_fetch_assoc($q)) 
  {
    $selected = "";

    if (in_array($r['id'], $arIds))
      $selected = "selected";

   echo "<option value='". $r['id']  ."' $selected>". $r['name']  ."</option>";
  }
}
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="stylesheet" type="text/css" href="/css/jazzgraph.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="/css/jquery.asmselect.css" />
  <script src="/js/prettify.js"></script>
  <script src="/js/sigma.min.js"></script>
  <script src="/js/jquery.min.js"></script>
  <script type="text/javascript" src="/js/jquery.asmselect.js"></script>
  <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
  <script type="text/javascript" src="http://swfobject.googlecode.com/svn/trunk/swfobject/swfobject.js"></script>
  <script type="text/javascript">    
    var mapIdLabel = new Object();
    var nomArtiste = '';
  </script>
  <script src="/js/sigma.parseGexf.js"></script>
  <script src="/js/sigma.parseJSON.js"></script>
  <script src="/d3.v3.js"></script>
  <script src="/js/jazzgraph.js"></script>
  <script src="/js/jazzgraph.3d.js"></script>
  <script src="/js/jazzgraph.style.js"></script>
  <script src="/js/sigma.forceatlas2.js"></script>
</head>
<body>
<div id="selectartists">
<div class="styled-select">
<select multiple="multiple" class="asmselect" size=4 title="Select some artists" id="jazzartists">
<?=getSelectBox('175553,9680');?>
</select>
</div>
<br/>

<div align="center"> 
<a href="#" class="button" onclick="init(getSelectValue('jazzartists'),1);">GO ! (Dexter) </a>
<br/>   
<br/>   
<br/>   
<div >
<a href="#" class="button" id="stop-layout">Stop Layout</a>
</div>
</div>
<!--  <div class="ui-widget">
  <label for="listArtists">Artistes </label>
  <input id="listArtists" />
  </div>-->

 </div>

<div class="container">
    <div class="row">
  
  <div class="span12 sigma-parent" id="sigma-example-parent">
    <div class="sigma-expand" id="sigma-example"></div>
  </div>
</div>

<div id="images">
  <div id="infoartiste">
  </div>
  <div id="playerContainer">
     <object id="player"></object>
  </div>
  <div id="videos2">
  </div>
 </div>
 <div id="albums">
 </div>
  </div>

</body>
</html>

