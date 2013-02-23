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
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/cv.css" rel="stylesheet">
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
    var idArtiste = '';
  </script>
  <script src="/js/sigma.parseGexf.js"></script>
  <script src="/js/sigma.parseJSON.js"></script>
  <script src="/js/jazzgraph.js"></script>
  <script src="/js/jazzgraph.3d.js"></script>
  <script src="/js/jazzgraph.style.js"></script>
  <script src="/js/sigma.forceatlas2.js"></script>
</head>
<body>

  <!-- Navbar
  ================================================== -->
  <div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
    <div class="container">
      <a class="btn btn-navbar" data-toggle="collapse"
      data-target=".nav-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </a>
      <a class="brand" href="../"></a>
      <div class="nav-collapse collapse" id="main-menu">
        <ul class="nav" id="main-menu-left">
        <li><a id="swatch-link" href="cv.html">CV</a></li>
        <li><a href="publications.html">Publications</a></li>
        <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Thèmes de recherche<b class="caret"></b></a>
        <ul class="dropdown-menu" id="swatch-menu">-
        <li><a href="ea.html">Algorithmes évolutionnistes</a></li>
        <li><a href="nn.html">Réseaux de neurones</a></li>
        <li><a href="er.html">Robotique évolutionniste</a></li>
        <li><a href="rl.html">Apprentissage par renforcement</a></li>
        </ul>
        </li>
        <li><a href="index.php">Musique</a></li>
        <ul class="nav pull-right" id="main-menu-right">
        </ul>
    </div>
    </div>
    </div>
  </div>
  <br/>
  <br/>
   <div class="row">
       <div class="span12">
       </div>
   </div>
   <div class="row">

       <div class="span1"></div>

       <div class="span2 selectartists" id="selectartists">
         <div>
         <br/>
              <a href="#" class="btn" width=200  onclick="init('',1,0,1);"
                id="graph">Show all artists &nbsp; </a>
                
                <br/>
                <br/>
          </div>
        <div class="styled-select">
            <select multiple="multiple" class="asmselect"  title="Select artists" id="jazzartists">
            <?=getSelectBox('505770,988386,175553,9680');?>
            </select></div>
             <div>
              <a href="#" class="btn" 
              onclick="init(getSelectValue('jazzartists'),1);">GO ! (Dexter)
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a> 
<!--              <a href="#" class="btn" id="stop-layout">Stop Layout</a>-->
                </div>

          <div id="albums"> </div>         
        </div>

        <div id="sigma-example-parent" class="span11 sigma-parent">
            <div class="sigma-expand " id="sigma-example"></div>
        </div>

        <div class="span3">
            <div id="imgArtiste"> </div>
            <div id="infoartiste"> </div>
            <div id="bio"> </div>

            <div id="infoAl"><br/> </div>
        </div>


    </div>

    <div class="row listvideos">
        <div class="span12"> <br/> </div>
     </div>

        <div class="row listvideos">
        <div class="">
        <div class="span3"> </div>
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
    <script src="js/bootstrap.js"></script>
</body>
</html>
