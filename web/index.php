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
      //init();
  }
  }


</script>
<div id="selectartists">

<div id=swing>
<select>
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
$requete = "select name, Artists.id as id, job from
 Artists 
 INNER JOIN Credits ON Credits.artistid = Artists.id
 INNER JOIN Albums ON  Albums.id = Credits.albumid 
 INNER JOIN Jobs ON Jobs.jobid = Credits.jobid
 INNER JOIN LinksArtistCategory on LinksArtistCategory.artistid = Artists.id
 INNER JOIN ArtistCategories on ArtistCategories.id = LinksArtistCategory.artistCategoryId
 where job like '%sax%'
 and ArtistCategories.id = 1
 group by name";
$q = mysql_query($requete); 
while($r = mysql_fetch_assoc($q)) 
{
 echo "<option value='". $r['id']  ."'>". $r['name']  ."</option>";
}

?>
</select>
</div>
<div id="bop">
<select>
<option value='Art_Blakey'>Art Blakey</option>
<option value='Art_Pepper'>Art Pepper</option>
<option value='Barney_Kessel'>Barney Kessel</option>
<option value='Betty_Carter'>Betty Carter</option>
<option value='Bill_Evans'>Bill Evans</option>
<option value='Billy_Eckstine'>Billy Eckstine</option>
<option value='Bud_Powell'>Bud Powell</option>
<option value='Cannonball_Adderley'>Cannonball Adderley</option>
<option value='Charles_Mingus'>Charles Mingus</option>
<option value='Charlie_Christian'>Charlie Christian</option>
<option value='Charlie_Parker'>Charlie Parker</option>
<option value='Chet_Baker'>Chet Baker</option>
<option value='Clifford_Brown'>Clifford Brown</option>
<option value='Curtis_Fuller'>Curtis Fuller</option>
<option value='Dexter_Gordon'>Dexter Gordon</option>
<option value='Dizzy_Gillespie'>Dizzy Gillespie</option>
<option value='Don_Byas'>Don Byas</option>
<option value='Ella_Fitzgerald'>Ella Fitzgerald</option>
<option value='Fats_Navarro'>Fats Navarro</option>
<option value='Herb_Ellis'>Herb Ellis</option>
<option value='Horace_Silver'>Horace Silver</option>
<option value='Jimmy_Cobb'>Jimmy Cobb</option>
<option value='Joe_Pass'>Joe Pass</option>
<option value='John_Coltrane'>John Coltrane</option>
<option value='John_Lewis'>John Lewis</option>
<option value='Kenny_Burrell'>Kenny Burrell</option>
<option value='Kenny_Clarke'>Kenny Clarke</option>
<option value='Kenny_Dorham'>Kenny Dorham</option>
<option value='Lee_Konitz'>Lee Konitz</option>
<option value='Lennie_Tristano'>Lennie Tristano</option>
<option value='Lucky_Thompson'>Lucky Thompson</option>
<option value='Max_Roach'>Max Roach</option>
<option value='Miles_Davis'>Miles Davis</option>
<option value='Milt_Jackson'>Milt Jackson</option>
<option value='Pat_Martino'>Pat Martino</option>
<option value='Paul_Chambers'>Paul Chambers</option>
<option value='Philly_Joe_Jones'>Philly Joe Jones</option>
<option value='Ray_Brown'>Ray Brown</option>
<option value='Roy_Haynes'>Roy Haynes</option>
<option value='Sarah_Vaughan'>Sarah Vaughan</option>
<option value='Sonny_Rollins'>Sonny Rollins</option>
<option value='Sonny_Stitt'>Sonny Stitt</option>
<option value='Thelonious_Monk'>Thelonious Monk</option>
<option value='Wardell_Gray'>Wardell Gray</option>
<option value='Wes_Montgomery'>Wes Montgomery</option>
</select> 
</div>
<div id="hardbop">
<select>
<option value='Art_Blakey'>Art Blakey</option>
<option value='Art_Farmer'>Art Farmer</option>
<option value='Benny_Golson'>Benny Golson</option>
<option value='Big_John_Patton'>Big John Patton</option>
<option value='Billy_Higgins'>Billy Higgins</option>
<option value='Bobby_Hutcherson'>Bobby Hutcherson</option>
<option value='Booker_Ervin'>Booker Ervin</option>
<option value='Brother_Jack_McDuff'>Brother Jack McDuff</option>
<option value='Bud_Powell'>Bud Powell</option>
<option value='Cal_Tjader'>Cal Tjader</option>
<option value='Charles_Mingus'>Charles Mingus</option>
<option value='Clifford_Brown'>Clifford Brown</option>
<option value='Curtis_Fuller'>Curtis Fuller</option>
<option value='Dexter_Gordon'>Dexter Gordon</option>
<option value='Donald_Byrd'>Donald Byrd</option>
<option value='Elmo_Hope'>Elmo Hope</option>
<option value='Elvin_Jones'>Elvin Jones</option>
<option value='Eric_Dolphy'>Eric Dolphy</option>
<option value='Freddie_Hubbard'>Freddie Hubbard</option>
<option value='Gary_Burton'>Gary Burton</option>
<option value='George_Benson'>George Benson</option>
<option value='Gigi_Gryce'>Gigi Gryce</option>
<option value='Grant_Green'>Grant Green</option>
<option value='Hank_Mobley'>Hank Mobley</option>
<option value='Herb_Ellis'>Herb Ellis</option>
<option value='Herbie_Hancock'>Herbie Hancock</option>
<option value='Horace_Silver'>Horace Silver</option>
<option value='Jackie_McLean'>Jackie McLean</option>
<option value='Jay_Jay_Johnson'>Jay Jay Johnson</option>
<option value='Jimmy_McGriff'>Jimmy McGriff</option>
<option value='Jimmy_Smith'>Jimmy Smith</option>
<option value='Joe_Henderson'>Joe Henderson</option>
<option value='Joe_Pass'>Joe Pass</option>
<option value='John_Coltrane'>John Coltrane</option>
<option value='Kai_Winding'>Kai Winding</option>
<option value='Kenny_Burrell'>Kenny Burrell</option>
<option value='Kenny_Clarke'>Kenny Clarke</option>
<option value='Kenny_Dorham'>Kenny Dorham</option>
<option value='Kenny_Drew'>Kenny Drew</option>
<option value='Larry_Coryell'>Larry Coryell</option>
<option value='Larry_Goldings'>Larry Goldings</option>
<option value='Lee_Konitz'>Lee Konitz</option>
<option value='Lee_Morgan'>Lee Morgan</option>
<option value='Les_Paul'>Les Paul</option>
<option value='Lionel_Hampton'>Lionel Hampton</option>
<option value='Lonnie_Liston'>Lonnie Liston</option>
<option value='Lou_Donaldson'>Lou Donaldson</option>
<option value='Max_Roach'>Max Roach</option>
<option value='McCoy_Tyner'>McCoy Tyner</option>
<option value='Miles_Davis'>Miles Davis</option>
<option value='Milt_Jackson'>Milt Jackson</option>
<option value='Ornette_Coleman'>Ornette Coleman</option>
<option value='Paul_Chambers'>Paul Chambers</option>
<option value='Philly_Joe_Jones'>Philly Joe Jones</option>
<option value='Rahsaan_Roland_Kirk'>Rahsaan Roland Kirk</option>
<option value='Ray_Brown'>Ray Brown</option>
<option value='Red_Garland'>Red Garland</option>
<option value='Ron_Carter'>Ron Carter</option>
<option value='Russell_Malone'>Russell Malone</option>
<option value='Sonny_Clark'>Sonny Clark</option>
<option value='Sonny_Rollins'>Sonny Rollins</option>
<option value='Sonny_Stitt'>Sonny Stitt</option>
<option value='Stanley_Turrentine'>Stanley Turrentine</option>
<option value='Steve_Turre'>Steve Turre</option>
<option value='Thelonious_Monk'>Thelonious Monk</option>
<option value='Wayne_Shorter'>Wayne Shorter</option>
<option value='Wes_Montgomery'>Wes Montgomery</option>
<option value='Wynton_Marsalis'>Wynton Marsalis</option>
</select>

</div>

 <div id="funk">
 <select>
 
<option value='Billy_Cobham'>Billy Cobham</option>
<option value='Bobby_Hutcherson'>Bobby Hutcherson</option>
<option value='Bob_James'>Bob James</option>
<option value='Brother_Jack_McDuff'>Brother Jack McDuff</option>
<option value='Cannonball_Adderley'>Cannonball Adderley</option>
<option value='Cedar_Walton'>Cedar Walton</option>
<option value='Dizzy_Gillespie'>Dizzy Gillespie</option>
<option value='Donald_Byrd'>Donald Byrd</option>
<option value='Freddie_Hubbard'>Freddie Hubbard</option>
<option value='George_Benson'>George Benson</option>
<option value='Grant_Green'>Grant Green</option>
<option value='Grover_Washington,_Jr.'>Grover Washington, Jr.</option>
<option value='Hank_Crawford'>Hank Crawford</option>
<option value='Herbie_Hancock'>Herbie Hancock</option>
<option value='Horace_Silver'>Horace Silver</option>
<option value='Jimmy_McGriff'>Jimmy McGriff</option>
<option value='Jimmy_Smith'>Jimmy Smith</option>
<option value='Joe_Farrell'>Joe Farrell</option>
<option value='Lonnie_Liston_Smith'>Lonnie Liston Smith</option>
<option value='Lou_Donaldson'>Lou Donaldson</option>
<option value='Miles_Davis'>Miles Davis</option>
<option value='Quincy_Jones'>Quincy Jones</option>
<option value='Ron_Carter'>Ron Carter</option>
<option value='Stanley_Turrentine'>Stanley Turrentine</option>
<option value='Wayne_Shorter'>Wayne Shorter</option>
<option value='Wes_Montgomery'>Wes Montgomery</option>
<option value='Yusef_Lateef'>Yusef Lateef</option>
</select>
   </div>
 </div>

<div class="container">
    <div class="row">
  
  <div class="span12 sigma-parent" id="sigma-example-parent">
    <div class="sigma-expand" id="sigma-example"></div>
  </div>
</div>

<div id="images">
<input type="radio" name="type" value="" onclick="init(nomArtiste, 1, 0);">sigma.js
<input type="radio" name="type" value="" onclick="init(nomArtiste, 1,1);">d3.js
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
