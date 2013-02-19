

function initd3(arArtistes, dbl) 
{
  // à l'init
  if (arArtistes == '' || arArtistes.type == 'DOMContentLoaded')
  {
    idArtistes =  '175553,9680';
    nomArtiste = 'John Coltrane';
  }
  else
  {
    nomArtiste = mapIdLabel[arArtistes[0]];
    idArtistes = arArtistes.join(',');
  }

  if (dbl == 0)
  {
    console.log(dbl);
    $('#sigma-example').single_double_click(function () {
        getInfoArtiste(nomArtiste)
        getVideoYoutube(nomArtiste);
      }, function () {
        init(nomArtiste, 1);
    });
  }

  if (nomArtiste != undefined)
  {
    getInfoArtiste(nomArtiste);
    getVideoYoutube(nomArtiste);
  }
   document.getElementById('sigma-example').innerHTML = '';

  var width = 1000,
      height = 600;

  var color = d3.scale.category20();

  var force = d3.layout.force()
      .charge(-60)
      .linkDistance(120)
      .size([width, height]);

  var svg = d3.select("#sigma-example").append("svg")
      .attr("width", width)
      .attr("height", height);

  //d3.json("gexf/" + artiste + ".json", function(error, graph) {
  d3.json("getJson.php?ids=" + idArtistes, function(error, graph) {
    force
        .nodes(graph.nodes)
        .links(graph.edges)
        .start();

    var link = svg.selectAll(".link")
        .data(graph.edges)
      .enter().append("line")
        .attr("class", "link")
//        .style("stroke-width", function(d) { return Math.sqrt(d.weight); });

    var node = svg.selectAll(".node")
        .data(graph.nodes, function(d) { return d.id; })
      .enter().append("circle")
        .attr("class", "node")
        .attr("r", 5)
        .style("fill", function(d) { return color(d.color); })
        .call(force.drag);

    node.append("title")
        .text(function(d) { return d.label; });

    force.on("tick", function() {
      link.attr("x1", function(d) { return d.source.x; })
          .attr("y1", function(d) { return d.source.y; })
          .attr("x2", function(d) { return d.target.x; })
          .attr("y2", function(d) { return d.target.y; });

      node.attr("cx", function(d) { return d.x; })
          .attr("cy", function(d) { return d.y; });
    });
  });
}
