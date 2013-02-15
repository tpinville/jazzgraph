sigma.publicPrototype.parseJSON = function(jsonPath,callback) {
  var sigmaInstance = this;

  var i = 0;

  jQuery.getJSON(jsonPath, function(data) {
      for (i=0; i<data.nodes.length; i++)
      {
        var nodeNode = data.nodes[i];
        
        $.each(nodeNode , function(key, val)
        {
//          console.log(key + " - " + val);
        });

        var id = nodeNode.id;
        var label = nodeNode.label;
        var color = '#'+sigma.tools.rgbToHex(parseFloat(nodeNode.color.r), parseFloat(nodeNode.color.g), parseFloat(nodeNode.color.b))
        var color = '#FFFFFF';
  //      var x = parseFloat(nodeNode.position.x);
  //      var y = parseFloat(nodeNode.position.y);
        i = i + 1;
        var x = i; 
        var y = 10;
//        console.log(color);
//        console.log(y);
        var size = parseFloat(nodeNode.size);
        size = 20;
        console.log(size);
        var clean_node = {id:id, label:label, color:color, x:x, y:y, attributes:[], size:size};
        /*
        for (j=0; j < nodeNode.attributes.length; j++){
        var raw_attribute = nodeNode.attributes[j];
        var attr = raw_attribute.for;
        var val = raw_attribute.value;
        clean_node.attributes.push({attr:attr, val:val});
        }*/

        sigmaInstance.addNode(id, clean_node);
      };

      for(i=0; i<data.edges.length; i++)
      {
        var edgeNode = data.edges[i];

        $.each(edgeNode, function(key, val)
        {
          console.log(key + " - " + val);
        });
        var edge = {
  id:         i,
              sourceID:   edgeNode.source,
              targetID:   edgeNode.target,
              label:      edgeNode.label,
              weight:     1,//parseFloat(edgeNode.weight),
              displaySize: 1,//    parseFloat(edgeNode.weight),
              attributes: []
        };
        /*
        for (j=0; j < edgeNode.attributes.length; j++){
          var raw_attribute = edgeNode.attributes[j];
          var attr = raw_attribute.for;
          var val = raw_attribute.value;
          edge.attributes.push({attr:attr, val:val});
        }
        */
        sigmaInstance.addEdge(i, edgeNode.source, edgeNode.target, edge);
      };
      //if (callback) callback.call(this);
  });
};
