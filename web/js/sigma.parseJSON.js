sigma.publicPrototype.parseJSON = function(jsonPath) {
  var sigmaInstance = this;

  var j = 0;

  jQuery.getJSON(jsonPath, function(data) {
      for (i=0; i<data.nodes.length; i++)
      {
        var nodeNode = data.nodes[i];
        

        var id = nodeNode.id;
        var label = nodeNode.label;

         mapIdLabel[id] = label; //rajout TOP

         //viz
         var size = 1;
         var x = 100 - 200*Math.random();
         var y = 100 - 200*Math.random();
         var color = '#'+sigma.tools.rgbToHex(parseFloat(nodeNode.color.r), parseFloat(nodeNode.color.g), parseFloat(nodeNode.color.b))
        //var x = parseFloat(nodeNode.position.x);
        //var y = parseFloat(nodeNode.position.y);
//        var color = '#FFFFFF';

//        console.log(color);
        var clean_node = {id:id, label:label, color:color, x:x, y:y, attributes:[], size:size};
        /*
        for (j=0; j < nodeNode.attributes.length; j++){
        var raw_attribute = nodeNode.attributes[j];
        var attr = raw_attribute.for;
        var val = raw_attribute.value;
        clean_node.attributes.push({attr:attr, val:val});
        }*/

        //console.log(id);
        sigmaInstance.addNode(id, clean_node);
      };

      for(i=0; i<data.edges.length; i++)
      {
        var edgeNode = data.edges[i];

        /*
        $.each(edgeNode, function(key, val)
        {
          console.log(key + " - " + val);
        });*/
        var edge = {
              id:         i,
              sourceID:   edgeNode.source,
              targetID:   edgeNode.target,
              label:      edgeNode.label,
              attributes: []
        };
        /*
        for (j=0; j < edgeNode.attributes.length; j++){
          var raw_attribute = edgeNode.attributes[j];
          var attr = raw_attribute.for;
          var val = raw_attribute.value;
          edge.attributes.push({attr:attr, val:val});
        }*/
        //console.log(i, edgeNode.source, edgeNode.target, edge);
        sigmaInstance.addEdge(i, edgeNode.source, edgeNode.target, edge);
      };
  });
};
