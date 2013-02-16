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

function getSelectBox($type)
{
  $requete = "select name, Artists.id as id, job from
   Artists 
   INNER JOIN Credits ON Credits.artistid = Artists.id
   INNER JOIN Albums ON  Albums.id = Credits.albumid 
   INNER JOIN Jobs ON Jobs.jobid = Credits.jobid
   INNER JOIN LinksArtistCategory on LinksArtistCategory.artistid = Artists.id
   INNER JOIN ArtistCategories on ArtistCategories.id = LinksArtistCategory.artistCategoryId
   where job like '". $type ."%'
   and ArtistCategories.id = 1
   group by name";
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
   echo "<option value='". $r['id']  ."'>". $r['name']  ."</option>";
  }
}
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <script src="js/prettify.js"></script>
  <script src="js/sigma.min.js"></script>
  <script src="js/jquery.min.js"></script>
  <script type="text/javascript" src="http://swfobject.googlecode.com/svn/trunk/swfobject/swfobject.js"></script>
  <script type="text/javascript">    
    var mapIdLabel = new Object();
    var nomArtiste = '';
  </script>
  <script src="js/sigma.parseGexf.js"></script>
  <script src="js/sigma.parseJSON.js"></script>
  <script src="d3.v3.js"></script>
  <script src="js/jazzgraph.3d.js"></script>
  <script src="js/jazzgraph.js"></script>
  <script src="js/jazzgraph.style.js"></script>
  <script src="js/sigma.forceatlas2.js"></script>
  <link rel="stylesheet" type="text/css" href="css/jazzgraph.css" media="screen" />
</head>
<body>
<script type="text/javascript">
var load = 0; // tout pourri
var idTimeout = 0;

function init(artiste, dbl, type)
{
  dbl = (dbl) ? dbl : 0;
  type = (type) ? type : 0;
  
  if (type == 0)
    initGexf(artiste, dbl) ;
  else
    initd3(artiste, dbl);

}

if (document.addEventListener) {
  document.addEventListener('DOMContentLoaded', init, false);
      setForm();
} 
else{  
  window.onload = function() {
      init();
  }
  }


</script>
<div id="selectartists">

<select multiple size=40 id="jazzartists">
<?=getSelectBox('');?>
</select>

<button onclick="init(getSelectValue('jazzartists'),1);">GO ! (Dexter) </button>
   
<div class="span12 buttons-container">
<button class="btn" id="stop-layout">Stop Layout</button>
</div>
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

