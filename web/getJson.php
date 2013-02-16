<?
$db="jazzgraph";
$connection = mysql_connect("localhost","root","");
// test la connection
if ( ! $connection )
{
  die ("connection impossible");
}

// Connecte la base
mysql_select_db($db) or die ("pas de connection");

$arArtiste = array("'Tony Williams'", "'John Coltrane'", "'Miles Davis'","'Charles Mingus'", "'James Carter'");
$arArtiste = array(9680,131227,175553,423829,791318);
$arArtiste = array($_GET['ids']);
$artiste = join(",", $arArtiste);
$nbArtistes = sizeof($arArtiste);
//$arArtiste = "'Ron Carter', '', 'James Carter'";

$tabColor = array();
foreach($arArtiste as $val)
{
   $color['r'] = rand(10,240);
   $color['g'] = rand(10,240);
   $color['b'] = rand(10,240);
   $tabColor[$val] = $color;
}

$filtre = 2;

$requete= "SELECT p.artistid as id,"               
  ."ar.name as label, c.artistid "
  ."FROM Credits c,LinksArtistCategory l,ArtistCategories ac, Albums a, AlbumPrimaryArtists p, Artists ar "
  ."where a.id = c.albumid "
  ."and  c.artistid = l.artistid "
  ."and ar.id = p.artistid "
  ."and p.albumid = a.id "
//  ."and c.artistid in (select id from Artists where name in (".$artiste.")) "
  ."and c.artistid in (".$artiste.") "
  ."and p.artistid in (select artistid from LinksArtistCategory where artistcategoryid = ".$filtre.") "
  ."group by p.artistid order by c.artistid";

$q = mysql_query($requete); 

$rows = array();
$color = array();
$i = 0;
$arrCorrId = array();
$artistPrev = "";

while($r = mysql_fetch_assoc($q)) 
{
  $arrCorrId[$r['id']] = $i;

  if ( $artistPrev != $r['artistid'])
   $color = $tabColor[$r['artistid']] ;
  
  if (in_array($r['id'], $arArtiste)) 
  {
    $r['size'] = 5;
    $r['color'] = $tabColor[$r['id']]; 
  }
  else
  {
    $r['size'] = 1;
    $r['color'] = $color;
  }

  $r['id'] = $i*1;

  $rows['nodes'][] = $r;    
  $i++;
  $artistPrev =  $r['artistid'];
} 
//print_r($arrCorrId);

$requete = "SELECT p.artistid as source, c.artistid as target, a.title as label "
  ."FROM Credits c,LinksArtistCategory l,ArtistCategories ac, Albums a, AlbumPrimaryArtists p, Artists ar "                
  ."where a.id = c.albumid "
  ."and a.id = c.albumid "
  ."and  c.artistid = l.artistid "
  ."and ar.id = p.artistid "
  ."and p.albumid = a.id "
//."and c.artistid in (select id from Artists where name in (". $artiste .")) "
  ."and c.artistid in (". $artiste .") "
  ."and l.artistcategoryid = ".$filtre." "
  ."and p.artistid in (select artistid from LinksArtistCategory where artistcategoryid = ".$filtre.") "
//  ." group by source, target" 
  ."";
$q = mysql_query($requete); 
$i = 0;

//  while ($r = mysql_fetch_array($q))
while($r = mysql_fetch_assoc($q)) 
{
  $r['id'] = $i*1;
  if ($arrCorrId[$r['source']] != NULL && $arrCorrId[$r['target']] != NULL)
  {
    $r['source'] = $arrCorrId[$r['source']];
    $r['target'] = $arrCorrId[$r['target']];

    $rows['edges'][] = $r;    
    $i++;
  }
} 

print json_encode($rows);
?>
