<?
require 'conf.php';
require 'jsonwrapper/jsonwrapper.php';
require_once 'jsonwrapper/JSON/JSON.php';

$db="jazzgraph";
$connection = mysql_connect($GLOBALS["url"],$GLOBALS["user"],$GLOBALS["password"]);
// test la connection
if ( ! $connection )
{
  die ("connection impossible");
}
$idArtiste = (int) $_GET['id'];

// Connecte la base
mysql_select_db($db) or die ("pas de connection");

  $requete = "select birthdate as `Birth Date`, birthplace as `Birth place`,
  deathDate as `Death date`,  Country,
  decade as Decades from Artists a 
  Join ActiveYears y on  y.artistid = a.id
  where a.id =  $idArtiste
  order by decade";


  //print $requete;
  $q = mysql_query($requete); 

  $reponse = array();
  $decade = "";

  while($r = mysql_fetch_assoc($q)) 
  {
    $reponse = $r;
    $decade .= " " . $r['Decades'];
  }

  $reponse['Decades'] = $decade;

  print json_encode($reponse);
?>
