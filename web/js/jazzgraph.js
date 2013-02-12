jQuery.fn.single_double_click = function(single_click_callback, double_click_callback, timeout) {
  return this.each(function(){
      var clicks = 0, self = this;
      jQuery(this).click(function(event){
        clicks++;
        if (clicks == 1) {
        setTimeout(function(){
          if(clicks == 1) {
          console.log("single");
          single_click_callback.call(self, event);
          } else {
          console.log("dble !");
          double_click_callback.call(self, event);
          }
          clicks = 0;
          }, timeout || 600);
        }
        });
      });
}

function init(path, dbl) 
{
dbl = (dbl) ? dbl : 0;

if ( load == 0)
  {
    load = 1;
    setForm();
  }
  // à l'init
  if (path.type == 'DOMContentLoaded')
  {
    path =  'John_Coltrane';
  }

  if (dbl == 0)
  {
    console.log(dbl);
    $('#sigma-example').single_double_click(function () {
        console.log("click " + nomArtiste.replace(" ", "_"));
        getInfoArtiste(nomArtiste.replace(" ", "_"))
        getVideoYoutube(nomArtiste.replace(" ", "_"));
      }, function () {
        console.log("dbl click"+ nomArtiste.replace(" ", "_"));
        init(nomArtiste.replace(" ", "_"), 1);
    });
  }

  getInfoArtiste(path)
  getVideoYoutube(path);
  /**
   * First, let's instanciate sigma.js :
   */
   document.getElementById('sigma-example').innerHTML = '';
  var sigInst = sigma.init($('#sigma-example')[0]).drawingProperties({
   defaultLabelColor: '#fff',
   defaultLabelSize: 14,
   defaultLabelBGColor: '#fff',
   defaultLabelHoverColor: '#000',
   labelThreshold: 6,
   defaultEdgeType: ''
  }).graphProperties({
   minNodeSize: 0.5,
   maxNodeSize: 50,
   minEdgeSize: 1,
   maxEdgeSize: 1
  });


  // (requires "sigma.parseGexf.js" to be executed)
   sigInst.parseGexf('gexf/' + path + ".gexf");

  /**
   * Now, here is the code that shows the popup :
   */
  (function(){
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

            var artiste = '';
            nomArtiste = libelle;

            if (libelle == mapIdLabel[e.target])
            {
               artiste = mapIdLabel[e.source];
            }
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

            if(!neighbors[n.id]){
            n.hidden = 1;
            alert(n.hidden);
            }else{
            n.hidden = 0;
            }
      },[event.content[0]]).draw(2,2,2);



      //getInfoAlbum(libelle);
      //getImage(libelle.replace(' ','_')
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
sigInst.draw();
  })();
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
  $.getJSON("http://gdata.youtube.com/feeds/api/videos?q=jazz "+ artist + "&alt=json-in-script&callback=?&max-results=12&format=5", function(data) 
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
  document.getElementById('infoartiste').innerHTML = '<h1>' + artist.replace("_", " ") + '</h1>';
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
