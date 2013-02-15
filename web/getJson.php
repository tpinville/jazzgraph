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

$arArtiste = "'Tony Williams', 'John Coltrane', 'Miles Davis', 'Elvin Jones', 'Charlie Parker'";
$arArtiste = "'Ron Carter', '', 'Billy Cobham'";

$requete = "select id from Artists where name in (".$arArtiste.")";
$q = mysql_query($requete); 
$i = 0;
$tabColor = array();


while($r = mysql_fetch_assoc($q)) 
{
  $tabColor[$r['id']] = $i;
  $i = $i +100;
}

$filtre = 2;

$requete= "SELECT p.artistid as id,"               
  ."ar.name as label, c.artistid "
  ."FROM Credits c,LinksArtistCategory l,ArtistCategories ac, Albums a, AlbumPrimaryArtists p, Artists ar "
  ."where a.id = c.albumid "
  ."and  c.artistid = l.artistid "
  ."and ar.id = p.artistid "
  ."and p.albumid = a.id "
  ."and c.artistid in (select id from Artists where name in (".$arArtiste.")) "
  ."and p.artistid in (select artistid from LinksArtistCategory where artistcategoryid = ".$filtre.") "
  ."group by p.artistid";


//$q = mysql_query($requete,$connection); // envoi de la requête
$q = mysql_query($requete); 

$rows = array();
$i = 0;
$arrCorrId = array();
//  while ($r = mysql_fetch_array($q))

while($r = mysql_fetch_assoc($q)) 
{
  $arrCorrId[$r['id']] = $i;
  $r['color'] = 'rgb('.$tabColor[$r['artistid']].',125,125)';
  $r['id'] = $i*1;
  $rows['nodes'][] = $r;    
  $i++;
} 
//print_r($arrCorrId);

$requete = "SELECT p.artistid as source, c.artistid as target, a.title as label "
  ."FROM Credits c,LinksArtistCategory l,ArtistCategories ac, Albums a, AlbumPrimaryArtists p, Artists ar "                
  ."where a.id = c.albumid "
  ."and a.id = c.albumid "
  ."and  c.artistid = l.artistid "
  ."and ar.id = p.artistid "
  ."and p.albumid = a.id "
  ."and c.artistid in (select id from Artists where name in (". $arArtiste .")) "
  ."and l.artistcategoryid = ".$filtre." "
  ."and p.artistid in (select artistid from LinksArtistCategory where artistcategoryid = ".$filtre.") "
  ."" ;
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
