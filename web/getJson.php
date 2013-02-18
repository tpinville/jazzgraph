<?
require 'conf.php';
require 'jsonwrapper/jsonwrapper.php';

$db="jazzgraph";

$connection = mysql_connect($GLOBALS["url"],$GLOBALS["user"],$GLOBALS["password"]);
// test la connection
if ( ! $connection )
{
  die ("connection impossible");
}

// Connecte la base
mysql_select_db($db) or die ("pas de connection");

$rows = array();


if ($_GET['art'] != "")
{

  $requete = " SELECT a.id, a.name 
  FROM Artists a
  JOIN LinksArtistCategory l ON a.id = l.artistid
  group by name
  ";

  $q = mysql_query($requete) or die(mysql_error()); 


  while($r = mysql_fetch_assoc($q)) 
  {
    $rows['artistes'][]=$r['name'];
  }
}
if ($_GET['ids'] != "")
{
  $arArtiste = array("'Tony Williams'", "'John Coltrane'", "'Miles Davis'","'Charles Mingus'", "'James Carter'");
  $arArtiste = array(9680,131227,175553,423829,791318);
  $artiste = $_GET['ids'];
  $arArtiste = split(",", $artiste);

  $couleurs = array(
            array('r' => 192, 'g' => 0,'b' => 64),
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
            array('r' => 128, 'g' => 0,'b' => 0),
            array('r' => 128, 'g' => 128,'b' => 0));

  $tabColor = array();
  $i=0;
  foreach($arArtiste as $val)
  {
     $tabColor[$val] = $couleurs[$i];
     $i++;
  }

  $filtre = 1;

  $requete= "SELECT p.artistid as id,"               
    ."ar.name as label, c.artistid "
    ."FROM Credits c,LinksArtistCategory l, Albums a, AlbumPrimaryArtists p, Artists ar "
    ."where a.id = c.albumid "
    ."and  c.artistid = l.artistid "
    ."and ar.id = p.artistid "
    ."and p.albumid = a.id "
  //  ."and c.artistid in (select id from Artists where name in (".$artiste.")) "
    ."and c.artistid in (".$artiste.") "
  //  ."and p.artistid in (select artistid from LinksArtistCategory where artistcategoryid = ".$filtre.") "
    ."group by p.artistid order by p.artistid";

  $q = mysql_query($requete) or die(mysql_error()); 

  $color = array();
  $i = 0;
  $arrCorrId = array();
  $artistPrev = "";

  while($r = mysql_fetch_assoc($q)) 
  {
    $arrCorrId[$r['id']] = $i;
    //print $r['id'] . "\n";

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

  //  $r['id'] = $i*1;
    $r['id'] = $r['id']*1;

    $rows['nodes'][] = $r;    
    $i++;
    $artistPrev =  $r['artistid'];
  } 
  //print_r($arrCorrId);

  $reload=false;

  foreach ($arArtiste as $a)
  {
  //foreach ($ as $a)
  }

  /*
  $listAlbums = array();
  $requete = "SELECT albumid FROM Credits WHERE artistid in ($artiste) group by albumid";
  $q = mysql_query($requete); 
  while($r = mysql_fetch_assoc($q)) 
    $listAlbums[] = $r['albumid'];


  $i=0;
  foreach($listAlbums as $album)
  {
    $requete = "SELECT  p.artistid as source, c.artistid as target, al.title as label 
      FROM Credits c 
      join Artists a on c.artistid = a.id
      join Albums al on al.id = c.albumid
      Join AlbumPrimaryArtists p on p.albumid = al.id
      JOIN LinksArtistCategory l on l.artistid = c.artistid  
      where al.id = $album
      and l.artistCategoryId = $filtre
       group by source, target, label";


  }*/


  $requete = "SELECT p.artistid as source, c.artistid as target, a.title as label "
    ."FROM Credits c, Albums a, AlbumPrimaryArtists p, Artists ar "                
  //  ."JOIN LinksArtistCategory on LinksArtistCategory.artistid = Credits.artistid "
    ."where a.id = c.albumid "
    ."and a.id = c.albumid "
  //  ."and  c.artistid = l.artistid "
    ."and ar.id = p.artistid "
    ."and p.albumid = a.id "
  //."and c.artistid in (select id from Artists where name in (". $artiste .")) "
    ."and c.artistid in (". $artiste .") "
  //  ."and l.artistcategoryid = ".$filtre." "
  //  ."and p.artistid in (select artistid from LinksArtistCategory where artistcategoryid = ".$filtre.") "
    ." group by source, target, label" 
    ."";
    $q = mysql_query($requete); 
    
    while($r = mysql_fetch_assoc($q)) 
    {
    //    $r['source'] = $arrCorrId[$r['source']];
    //    $r['target'] = $arrCorrId[$r['target']];
        $r['source'] = $r['source']*1;
        $r['target'] = $r['target']*1;

        $rows['edges'][] = $r;    
        $i++;
    }

}
  print json_encode($rows);
?>
