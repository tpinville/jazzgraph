<?
require 'web/conf.php';
require 'web/jsonwrapper/jsonwrapper.php';

$db="jazzgraph";

$connection = mysql_connect($GLOBALS["url"],$GLOBALS["user"],$GLOBALS["password"]);
// test la connection
if ( ! $connection )
{
  die ("connection impossible");
}

// Connecte la base
mysql_select_db($db) or die ("pas de connection");


//mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'",$db);

$filtre = 2;

$requete = " SELECT a.id, a.name 
FROM Artists a
JOIN LinksArtistCategory l ON a.id = l.artistid
where artistCategoryId = $filtre
group by name ";

$q = mysql_query($requete) or die(mysql_error()); 


while($r = mysql_fetch_assoc($q)) 
{


  $requete= "SELECT a.id as albumid,title, p.artistid, name
    FROM Albums a 
    JOIN AlbumPrimaryArtists p  ON p.albumid = a.id
    JOIN Artists ar  ON p.artistid = ar.id
    where p.artistid = ". $r['id'] . " group by a.id
    ";

  $q1 = mysql_query($requete) or die(mysql_error()); 
  $rows = array();
  $arNode = array();



  while($r1 = mysql_fetch_assoc($q1)) 
  {
      if (!in_array($r1['artistid'],$arNode))
      {
        $node = array();
        $node['id'] = $r1['artistid']*1;
        $node['label'] = $r1['name'];
        $node['size'] = 5;
        $node['color'] = array('r' => 192, 'g' => 0,'b' => 64);
        $rows['nodes'][] = $node;
        $arNode[] = $r1['artistid'];
      }

    $requete = "SELECT c.artistid as source, title as label, ar.name 
      from Credits c
      JOIN LinksArtistCategory l ON c.artistid = l.artistid
      JOIN Artists ar ON c.artistid = ar.id
      JOIN Albums a ON c.albumid = a.id
      where albumid = " . $r1['albumid']."
      and artistCategoryId = $filtre
      Group by c.artistid  ";

    $q2 = mysql_query($requete) or die(mysql_error()); 
    while($r2 = mysql_fetch_assoc($q2)) 
    {
      
      if (!in_array($r2['source'],$arNode))
      {
        $node = array();
        $node['id'] = $r2['source']*1;
        $node['label'] = $r2['name'];
        $node['size'] = 1;
        $node['color'] = array('r' => 192, 'g' => 0,'b' => 64);
        $rows['nodes'][] = $node;
        $arNode[] = $r2['source'];
      }


      if ($r['id'] != $r2['source'])
      {
        $edge = array();
        $edge['target'] = $r['id'];
        $edge['label'] = $r2['label'];
        $edge['source'] = $r2['source']*1;
        $rows['edges'][] = $edge;    
    }
  }

    $fp = fopen($r['id'].  '.json', 'w');
    fwrite($fp, json_encode($rows));
    fclose($fp);

  }


}


?>
