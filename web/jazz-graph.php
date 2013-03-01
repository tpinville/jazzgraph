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
<html lang="en">
<head>
<title>Music</title> 
  <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/cv.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/css/jazzgraph.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/css/jquery.asmselect.css" />
<style type="text/css">
@media (min-width: 900px) { 
  .platform {width:1280px; 
     background-color: #E7E7E7; 
  }

}
</style>
</head>

<body>

    <div class="modal hide fade" id="infos">
      <div class="modal-header"> <a class="close" data-dismiss="modal">×</a>
      <h3>Graphe des collaborations dans le jazz</h3>
      </div>
      <div class="modal-body">
      <h4 align="center"></h4>
      <h4>Menu :</h4>
      <ul>
      <li><b>Show all artists</b> : affiche le graphe complet des
      collaborations entre musiciens.</li>
      <li><b>Select artists</b> : Sélection des artistes pour générer le
      graphe des collaborations.</li>
      <li><b>GO !</b> : affiche le graphe des collaborations entre les
      artistes sélectionnés.</li>
      </ul>
      <br/>
      
      <h4>Sur le graphe : </h4>
        <ul>
         <li><b>Scroll souris</b> : zoom sur le graphe.</li>
         <li><b>Clic souris</b> : déplacement dans le graphe.</li>
         <li><b>Mouseover</b> : affiche les différentes collaborations pour
         l'artiste sélectionné.</li>
         <li><b>Double clic</b> sur un noeud : affichage des infos de l'artiste sélectionné + différentes vidéos youtube associées. </li>
         </ul>
      </div>
      <div class="modal-footer"> <a class="btn" data-dismiss="modal">Fermer</a> </div>
        <div class="span12"> <br/> </div>
     </div>

<?php include ("menu.html")?>

		<div class="platform">

   <div class="row">

       <div class="span2 selectartists" id="selectartists">
         <div>
         <br/>
         <br/>
              <a href="#" class="btn" width=200  onclick="init('',1,0,1);"
                id="graph">Show all artists &nbsp; </a>
                
                <br/>
                <br/>
          </div>
        <div class="styled-select">
            <select multiple="multiple" class="asmselect"  title="Select artists" id="jazzartists">
            <?=getSelectBox('175553,9680');?>
            </select></div>
             <div>
              <a href="#" class="btn" 
              onclick="init(getSelectValue('jazzartists'),1);">GO ! (Dexter)
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a> 
<!--              <a href="#" class="btn" id="stop-layout">Stop Layout</a>-->
                </div>
<br/>
<a class="btn" data-toggle="modal" href="#infos" >Informations&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a> 
          <div id="albums"> </div>         
        </div>

        <div id="sigma-example-parent" class="span11 sigma-parent">
            <div class="sigma-expand " id="sigma-example">
        </div>
        </div>

        <div class="span3">
        <br/>
            <div id="imgArtiste"> </div>
            <div id="infoartiste"> </div>
            <div id="bio"> </div>

            <div id="infoAl"><br/> </div>
        </div>


    </div>

    <div class="row">

        <div class="row listvideos">
        <div class="">
        <div class="span2"> </div>
        <div class="span8 listvideos"> 
            <div id="videos2"></div>
       </div>
        <div class="span3"> 
            <div id="playerContainer"><object id="player"></object> </div>
       </div>
       </div>
       </div>
    <div class="row listvideos">
        <div class="span"> <br/> </div>
     </div>
 </div>
  <script type="text/javascript">    
    var mapIdLabel = new Object();
    var nomArtiste = '';
    var idArtiste = '';
  </script>
  <script src="/js/sigma.min.js"></script>
  <script src="/js/jquery.min.js"></script>
  <script src="/js/jquery.asmselect.js"></script>
  <script src="/js/swfobject.js"></script>
  <script src="/js/sigma.parseGexf.js"></script>
  <script src="/js/sigma.parseJSON.js"></script>
  <script src="/js/jazzgraph.3d.js"></script>
  <script src="/js/jazzgraph.style.js"></script>
  <script src="/js/sigma.forceatlas2.js"></script>
  <script src="/js/bootstrap.js"></script>
  <script src="/js/jazzgraph.js"></script>
  <?include("footer.inc")?>
</body>
</html>
