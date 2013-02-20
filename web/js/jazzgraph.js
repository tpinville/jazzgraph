var load = 0; // tout pourri
var idTimeout = 0;
var listArtists = ["John Coltrane", "Miles Davis", "Charles Mingus"
];


$(document).ready(function() {
    $("select[multiple]").asmSelect({
      sortable: true,
      highlight: true,
      hideWhenAdded:true,
      animate: true,
      addItemTarget: 'top',
      removeLabel: 'X'
      });
});

jQuery.fn.single_double_click = function(single_click_callback, double_click_callback, timeout) {
  return this.each(function(){
      var clicks = 0, self = this;
      jQuery(this).click(function(event){
        clicks++;
        if (clicks == 1) {
        setTimeout(function(){
          if(clicks == 1) {
          single_click_callback.call(self, event);
          } else {
          double_click_callback.call(self, event);
          }
          clicks = 0;
          }, timeout || 600);
        }
        });
      });
}

function init(artiste, dbl, type, all)
{
  dbl = (dbl) ? dbl : 0;
  type = (type) ? type : 0;
  all = (all) ? all : 0;
  
  if (type == 0)
    initGexf(artiste, dbl, all) ;
  else
    initd3(artiste, dbl);

}

function initGexf(arArtistes, dbl, all) 
{

  clearTimeout(idTimeout);

  // à l'init
  if (arArtistes == '' || arArtistes.type == 'DOMContentLoaded')
  {
    idArtistes =  '175553,9680';
    nomArtiste = 'John Coltrane';
  }
  else
  {
     console.log(arArtistes);
    nomArtiste = mapIdLabel[arArtistes[0]];
    idArtistes = arArtistes.join(',');
  }

  if (dbl == 0)
  {
    $('#sigma-example').single_double_click(function () {
      }, function () {
//        init(nomArtiste, 1);
        getInfoArtiste(nomArtiste)
        getVideoYoutube(nomArtiste);
    });
  }

  if (nomArtiste != undefined)
  {
    getInfoArtiste(nomArtiste);
    getVideoYoutube(nomArtiste);
  }
  /**
   * First, let's instanciate sigma.js :
   */
   document.getElementById('sigma-example').innerHTML = '';
  var sigInst = sigma.init($('#sigma-example')[0]).drawingProperties({
   defaultLabelColor: '#fff',
   defaultLabelSize: 11,
   defaultLabelBGColor: '#fff',
   defaultLabelHoverColor: '#000',
      labelThreshold: 4,
   defaultEdgeType: 'curv'
  }).graphProperties({
   minNodeSize: 1,
   maxNodeSize: 15,
   minEdgeSize: 1,
   maxEdgeSize: 1     
  });

  sigInst.stopForceAtlas2();

  if (all == 1)
     sigInst.parseGexf("jazz.gexf");
  else
     sigInst.parseJSON("getJson.php?ids=" + idArtistes);

  console.log(idArtistes);
   //sigInst.parseJSON("json/9680.json");


  /**
   * Now, here is the code that shows the popup :
   */
    /*
sigInst.bind('overnodes',function(event){
      var nodes = event.content;
      var neighbors = {};
      sigInst.iterEdges(function(e){
         if(nodes.indexOf(e.source)>=0 || nodes.indexOf(e.target)>=0){
         neighbors[e.source] = 1;
         neighbors[e.target] = 1;
         }
         }).iterNodes(function(n){
            if(!neighbors[n.id]){
            alert(rr);
            n.hidden = 1;
            }else{
            n.hidden = 0;
            }
            }).draw(2,2,2);
      }).bind('outnodes',function(){
         sigInst.iterEdges(function(e){
            e.hidden = 0;
            }).iterNodes(function(n){
               n.hidden = 0;
               }).draw(2,2,2);
               });*/



    var popUp;
    var albums = new Array();

    // This function is used to generate the attributes list from the node attributes.
    // Since the graph comes from GEXF, the attibutes look like:
    // [
    //   { attr: 'Lorem', val: '42' },
    //   { attr: 'Ipsum', val: 'dolores' },
    //   ...
    //   { attr: 'Sit',   val: 'amet' }
    // ]
    function attributesToString(attr) {
      return '<ul>' +
        attr.map(function(o){
          return '<li>' + o.attr + ' : ' + o.val + '</li>';
        }).join('') +
        '</ul>';
    }

    function albumsToString(attr) {
      attr.sort();
      return '' +
        attr.map(function(o){
          return '' + o + '<br>';
        }).join('') +
        '';
    }



    function showNodeInfo(event) {
      popUp && popUp.remove();
      
      albums = new Array();
      var arAlbums = new Array();
      var nodes = event.content;
      var neighbors = {};
      var node;
      var libelle = mapIdLabel[event.content[0]];
      sigInst.iterEdges(function(e){
         if(nodes.indexOf(e.source)>=0 || nodes.indexOf(e.target)>=0)
         {
            neighbors[e.source] = 1;
            neighbors[e.target] = 1;
         }
         }).iterNodes(function(n){
           node = n;

            if(!neighbors[n.id]){
            n.hidden = 1;
            }else{
            n.hidden = 0;
            }
      }).draw(2,2,2);

      sigInst.iterEdges(function(e){
         if(nodes.indexOf(e.source)>=0 || nodes.indexOf(e.target)>=0)
         {
            var artiste = '';
            nomArtiste = libelle;

            if (libelle == mapIdLabel[e.target])
               artiste = mapIdLabel[e.source];
            else
               artiste = mapIdLabel[e.target];

            if (arAlbums.indexOf(e.label) == -1)
            {
              albums.push('<b>' + artiste + ' : </b> ' + e.label);
              arAlbums.push(e.label);
            }
         }
         }).iterNodes(function(n){
           node = n;
      },[event.content[0]]).draw(2,2,2);

      popUp = $(
            '<div class="node-info-popup"></div>Albums'
      )
      .append(
        // The GEXF parser stores all the attributes in an array named
        // 'attributes'. And since sigma.js does not recognize the key
        // 'attributes' (unlike the keys 'label', 'color', 'size' etc),
        // it stores it in the node 'attr' object :
        //attributesToString( node['attr']['attributes'] )
        albumsToString(albums)
      ).attr(
        'id',
        'node-info'+sigInst.getID()
      ).css({
        'display': 'inline-block',
        'border-radius': 3,
        'padding': 5,
        'background': '#222222',
        'color': '#fff',
        'font-family' :' Arial, Helvetica, sans-serif',
        'font-size' : '10px',
        'box-shadow': '0 0 4px #666',
        'position': 'absolute',
        'left': node.displayX,
        'top': node.displayY+15
      });

      $('ul',popUp).css('margin','0 0 0 0px');

      $('#sigma-example').append(popUp);
    } 

    function hideNodeInfo(event) {
      popUp && popUp.remove();
      popUp = false;

      sigInst.iterEdges(function(e){
         e.hidden = 0;
         }).iterNodes(function(n){
            n.hidden = 0;
            }).draw(2,2,2);
    }
    sigInst.bind('overnodes',showNodeInfo).bind('outnodes',hideNodeInfo);

    var isRunning = true;

    if (all == 0)
    {
      idTimeout = setTimeout(function() {
           sigInst.stopForceAtlas2();
      sigInst.draw();
           isRunning = false;
           document.getElementById('stop-layout').childNodes[0].nodeValue = 'Start Layout';
           }, 10000);
    }
    else 
        sigInst.draw(); 

    document.getElementById('stop-layout').addEventListener('click',function(){
        if(isRunning){
        isRunning = false;
        sigInst.stopForceAtlas2();
        document.getElementById('stop-layout').childNodes[0].nodeValue = 'Start Layout';
        }else{
        isRunning = true;
        sigInst.startForceAtlas2();
        document.getElementById('stop-layout').childNodes[0].nodeValue = 'Stop Layout';
        }
        },true);
}


function loadVideo(playerUrl, autoplay) {
  swfobject.embedSWF(
      playerUrl + '&rel=1&border=0&fs=1&autoplay=' + 
      (autoplay?1:0), 'player', '290', '250', '9.0.0', false, 
      false, {allowfullscreen: 'true'});
}

function getImage(title)
{
  document.getElementById('images').innerHTML = '';

  $.getJSON("http://en.wikipedia.org/w/api.php?action=query&prop=images&titles="+title+"&format=json&callback=?", function(data)  
      { 
      $.each(data.query.pages , function(key, val) 
        {      
        if(val.images != undefined)
        {
        $.each(val.images , function(cle, valeur) 
          {          
          var nomImage = valeur.title.replace(" ","_");

          if (nomImage.indexOf(title) > -1)
          {
          $.getJSON("http://en.wikipedia.org/w/api.php?action=query&titles="+ nomImage + "&prop=imageinfo&iiprop=url&format=json&callback=?", function(data) 
            {
            $.each(data.query.pages , function(key, val)
              {
              $.each(val.imageinfo , function(cle, valeur)
                {
                // '<img src='+ valeur.url + ' width=100 height=100/>';
                $("<img/>").attr("src", valeur.url).attr("width",220).attr("height",220).appendTo("#images");
                });
              });
            });
          }
          });
        }

        });
      });
}

function getVideoYoutube(artist)
{
  $.getJSON("http://gdata.youtube.com/feeds/api/videos?q=album "+ artist + "&alt=json-in-script&callback=?&max-results=6&format=5", function(data) 
      {
      var feed = data.feed;
      var entries = feed.entry || [];
      var html = ['<ul class="videos">'];
      for (var i = 0; i < entries.length; i++) {
      var entry = entries[i];
      var title = entry.title.$t.substr(0, 20);
      var thumbnailUrl = entries[i].media$group.media$thumbnail[0].url;
      var playerUrl = entries[i].media$group.media$content[0].url;
      html.push('<li onclick="loadVideo(\'', playerUrl, '\', true)">',
        '<span class="titlec">', title, '...</span><br /><img src="', 
        thumbnailUrl, '" width="130" height="97"/>', '</span></li>');
      }
      html.push('</ul><br style="clear: left;"/>');
      document.getElementById('videos2').innerHTML = html.join('');
      if (entries.length > 0) {
      loadVideo(entries[0].media$group.media$content[0].url, false);
      }
      });
}

function getInfoAlbum(artist)
{
  document.getElementById('albums').innerHTML = '<b>' + artist +' </b>';
  var API_KEY = '';
  var service_url = 'https://www.googleapis.com/freebase/v1/mqlread';
  var query = {'type':'/music/artist','name': artist,'album':[]};
  var params = {
    'key': API_KEY,
    'query': JSON.stringify(query)
  };

  $.getJSON(service_url + '?callback=?', params, function(response) {
      var result = response.result;
      $.each(result['album'] , function(key, val) 
        {
        $('<div>', {text:val}).appendTo("#albums");     

        });
      });
}

function getInfoArtiste(artist)
{
  document.getElementById('infoartiste').innerHTML = '<h1>' + artist + '</h1>';
  $.getJSON("http://api.discogs.com/database/search?q="+ artist +"&type=artist&callback=?", function(data) 
  {
    var artistid = data.data.results[0].id;

    if (artistid != undefined)
    {
      $.getJSON("http://api.discogs.com/artists/"+ artistid +"?callback=?", function(data)      {

  //      alert(data.data.images[0]);
  //      $.each(data.data, function(c,v){
  //        alert (c + '-' + v);
  //      });
          if (data.data.images != undefined)
          {
            var imgprop = data.data.images[0];
            var imgwidth = imgprop.width;
            var imgheight = imgprop.height;
            var fact =1;

            if (imgwidth > 200)
            {
              fact =  imgwidth/200;
              imgwidth = imgwidth / fact;
              imgheight= imgheight/ fact;
            }

            $("<img/>").attr("src", imgprop.uri150).attr("width",imgwidth).attr("height",imgheight).appendTo("#infoartiste");
          }

          if (data.data.profile != undefined)
            $('<div>', {text:data.data.profile}).appendTo("#infoartiste");     
        });
    }
  });
}


function getSelectValue(selectId)
{
  var elmt = document.getElementById(selectId);
  if(elmt.multiple == false)
  {
    return elmt.options[elmt.selectedIndex].value;
  }
  var values = new Array();
  for(var i=0; i< elmt.options.length; i++)
  {
    if(elmt.options[i].selected == true)
    {
      values[values.length] = elmt.options[i].value; 
    }
  } 
  return values;  
}

if (document.addEventListener) {
  document.addEventListener('DOMContentLoaded', init, false);
} 
else{  
  window.onload = function() {
      init();
  }
  }
