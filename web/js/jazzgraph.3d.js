

function initd3(artiste, dbl) 
{

if ( load == 0)
  {
    load = 1;
    setForm();
  }
  // à l'init
  if (artiste == '' || artiste.type == 'DOMContentLoaded')
  {
    artiste=  'Miles_Davis';
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
   document.getElementById('sigma-example').innerHTML = '';
  getInfoArtiste(artiste)
  getVideoYoutube(artiste);

  var width = 1000,
      height = 800;

  var color = d3.scale.category20();

  var force = d3.layout.force()
      .charge(-1200)
      .linkDistance(300)
      .size([width, height]);

  var svg = d3.select("#sigma-example").append("svg")
      .attr("width", width)
      .attr("height", height);

  d3.json("gexf/" + artiste + ".json", function(error, graph) {
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
