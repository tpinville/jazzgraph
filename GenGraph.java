/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.jazzgraph;

import java.awt.Color;
import java.io.File;
import java.io.IOException;
import java.util.concurrent.TimeUnit;
import org.gephi.data.attributes.api.AttributeColumn;
import org.gephi.data.attributes.api.AttributeController;
import org.gephi.data.attributes.api.AttributeModel;
import org.gephi.graph.api.DirectedGraph;
import org.gephi.graph.api.GraphController;
import org.gephi.graph.api.GraphModel;
import org.gephi.io.database.drivers.MySQLDriver;
import org.gephi.io.exporter.api.ExportController;
import org.gephi.io.importer.api.Container;
import org.gephi.io.importer.api.EdgeDefault;
import org.gephi.io.importer.api.ImportController;
import org.gephi.io.importer.plugin.database.EdgeListDatabaseImpl;
import org.gephi.io.importer.plugin.database.ImporterEdgeList;
import org.gephi.io.processor.plugin.DefaultProcessor;
import org.gephi.layout.plugin.AutoLayout;
import org.gephi.layout.plugin.force.StepDisplacement;
import org.gephi.layout.plugin.force.yifanHu.YifanHuLayout;
import org.gephi.layout.plugin.forceAtlas.ForceAtlasLayout;
import org.gephi.partition.api.Partition;
import org.gephi.partition.api.PartitionController;
import org.gephi.partition.plugin.NodeColorTransformer;
import org.gephi.preview.api.PreviewController;
import org.gephi.preview.api.PreviewModel;
import org.gephi.preview.api.PreviewProperty;
import org.gephi.preview.types.EdgeColor;
import org.gephi.project.api.ProjectController;
import org.gephi.project.api.Workspace;
import org.gephi.ranking.api.Ranking;
import org.gephi.ranking.api.RankingController;
import org.gephi.ranking.api.Transformer;
import org.gephi.ranking.plugin.transformer.AbstractColorTransformer;
import org.gephi.ranking.plugin.transformer.AbstractSizeTransformer;
import org.gephi.statistics.plugin.GraphDistance;
import org.gephi.statistics.plugin.Modularity;
import org.openide.util.Lookup;

/**
 *
 * @author tpinville
 */
public class GenGraph {
    
    public void script(String[] args) {
        for (int i = 0; i < args.length; i++) {
            System.out.println(args[i]);
        }
          
        String artist;
        int delay = 15;
        
        if (args.length > 0)            
        {
            artist = args[0] ;
            if (args.length > 1)
                delay = Integer.parseInt(args[1]);                
        }
        else
            artist = "Charles Mingus";   
        
        String query = "%" + artist + "%";
        System.out.println(artist);
        
        //Init a project - and therefore a workspace
        ProjectController pc = Lookup.getDefault().lookup(ProjectController.class);
        pc.newProject();
        Workspace workspace = pc.getCurrentWorkspace();

        //Get controllers and models
        ImportController importController = Lookup.getDefault().lookup(ImportController.class);
        GraphModel graphModel = Lookup.getDefault().lookup(GraphController.class).getModel();
        AttributeModel attributeModel = Lookup.getDefault().lookup(AttributeController.class).getModel();

        //Import database
        EdgeListDatabaseImpl db = new EdgeListDatabaseImpl();
        db.setDBName("jazzgraph");
        db.setHost("localhost");
        db.setUsername("root");
        db.setPasswd("");
        db.setSQLDriver(new MySQLDriver());
        //db.setSQLDriver(new PostgreSQLDriver());
        //db.setSQLDriver(new SQLServerDriver());
        db.setPort(3306);
        //db.setNodeQuery("SELECT nodes.id AS id, nodes.label AS label, nodes.url FROM nodes");
        //String artist = "Lee morgan%' OR name like 'Miles Davis%";
        
        
        
        db.setNodeQuery("select id as id, label as label FROM Nodes where id in "
                + "(SELECT targetid FROM Edges LEFT JOIN Artists ON sourceid = Artists.id "
                + "where name like '"+ query + "' "
                + "UNION SELECT sourceid FROM Edges LEFT JOIN Artists ON targetid = Artists.id "
                + "where name like '"+ query + "'"
                + ")");
        
        db.setEdgeQuery("SELECT sourceid AS source, targetid as target, label as label FROM Edges LEFT JOIN Artists "
                + "ON sourceid = Artists.id ");
                //+ "where sourceid in  (select id from Artists where name like '"+ query + "')");
        
        ImporterEdgeList edgeListImporter = new ImporterEdgeList();
        
        Container container = importController.importDatabase(db, edgeListImporter);
        container.setAllowAutoNode(false);      //Don't create missing nodes
        container.getLoader().setEdgeDefault(EdgeDefault.DIRECTED);   

        //Append imported data to GraphAPI
        importController.process(container, new DefaultProcessor(), workspace);

                 
        //See if graph is well imported
        DirectedGraph graph = graphModel.getDirectedGraph();
        System.out.println("Nodes: " + graph.getNodeCount());
        System.out.println("Edges: " + graph.getEdgeCount());
        

        //Get Centrality
        GraphDistance distance = new GraphDistance();
        distance.setDirected(true);
        distance.execute(graphModel, attributeModel);        

        //Rank color by Degree
        RankingController rankingController = Lookup.getDefault().lookup(RankingController.class);
        Ranking degreeRanking = rankingController.getModel().getRanking(Ranking.NODE_ELEMENT, Ranking.DEGREE_RANKING);
        AbstractColorTransformer colorTransformer = (AbstractColorTransformer) rankingController.getModel().getTransformer(Ranking.NODE_ELEMENT, Transformer.RENDERABLE_COLOR);
        colorTransformer.setColors(new Color[]{new Color(0xFEF0D9), new Color(0xB30000)});
        rankingController.transform(degreeRanking,colorTransformer);


        //Rank size by centrality
        AttributeColumn centralityColumn = attributeModel.getNodeTable().getColumn(GraphDistance.BETWEENNESS);
        Ranking centralityRanking = rankingController.getModel().getRanking(Ranking.NODE_ELEMENT, centralityColumn.getId());
        AbstractSizeTransformer sizeTransformer = (AbstractSizeTransformer) rankingController.getModel().getTransformer(Ranking.NODE_ELEMENT, Transformer.RENDERABLE_SIZE);
        sizeTransformer.setMinSize(10);
        sizeTransformer.setMaxSize(100);
        rankingController.transform(centralityRanking,sizeTransformer);        
        

        //Rank label size - set a multiplier size
        Ranking centralityRanking2 = rankingController.getModel().getRanking(Ranking.NODE_ELEMENT, centralityColumn.getId());
        AbstractSizeTransformer labelSizeTransformer = (AbstractSizeTransformer) rankingController.getModel().getTransformer(Ranking.NODE_ELEMENT, Transformer.LABEL_SIZE);
        labelSizeTransformer.setMinSize(1);
        labelSizeTransformer.setMaxSize(3);
        rankingController.transform(centralityRanking2,labelSizeTransformer);

        //Set 'show labels' option in Preview - and disable node size influence on text size
        PreviewModel previewModel = Lookup.getDefault().lookup(PreviewController.class).getModel();
        previewModel.getProperties().putValue(PreviewProperty.SHOW_NODE_LABELS, Boolean.TRUE);
        previewModel.getProperties().putValue(PreviewProperty.NODE_LABEL_PROPORTIONAL_SIZE, Boolean.TRUE);
        previewModel.getProperties().putValue(PreviewProperty.SHOW_EDGE_LABELS, Boolean.TRUE);
 

        //Run modularity algorithm - community detection
        Modularity modularity = new Modularity();
        modularity.execute(graphModel, attributeModel);

        //Partition with 'modularity_class', just created by Modularity algorithm
        PartitionController partitionController = Lookup.getDefault().lookup(PartitionController.class);
        AttributeColumn modColumn = attributeModel.getNodeTable().getColumn(Modularity.MODULARITY_CLASS);
        Partition p2 = partitionController.buildPartition(modColumn, graph);
        System.out.println(p2.getPartsCount() + " partitions found");
        NodeColorTransformer nodeColorTransformer2 = new NodeColorTransformer();
        nodeColorTransformer2.randomizeColors(p2);
        partitionController.transform(p2, nodeColorTransformer2);        
        
        //Preview
        PreviewModel model = Lookup.getDefault().lookup(PreviewController.class).getModel();
        model.getProperties().putValue(PreviewProperty.SHOW_NODE_LABELS, Boolean.TRUE);
        model.getProperties().putValue(PreviewProperty.EDGE_COLOR, new EdgeColor(Color.GRAY));
        model.getProperties().putValue(PreviewProperty.EDGE_THICKNESS, new Float(0.1f));
        model.getProperties().putValue(PreviewProperty.NODE_LABEL_FONT, model.getProperties().getFontValue(PreviewProperty.NODE_LABEL_FONT).deriveFont(8));

        //Layout for 1 minute
        AutoLayout autoLayout = new AutoLayout(delay    , TimeUnit.SECONDS);
        autoLayout.setGraphModel(graphModel);
        YifanHuLayout firstLayout = new YifanHuLayout(null, new StepDisplacement(1f));
        
        ForceAtlasLayout secondLayout = new ForceAtlasLayout(null);
        AutoLayout.DynamicProperty adjustBySizeProperty = AutoLayout.createDynamicProperty("forceAtlas.adjustSizes.name", Boolean.TRUE, 0.1f);//True after 10% of layout time
        AutoLayout.DynamicProperty repulsionProperty = AutoLayout.createDynamicProperty("forceAtlas.repulsionStrength.name", new Double(1500.), 0f);//500 for the complete period
        autoLayout.addLayout(firstLayout, 0.5f);
        autoLayout.addLayout(secondLayout, 0.5f, new AutoLayout.DynamicProperty[]{adjustBySizeProperty, repulsionProperty});
        autoLayout.execute();        
        
        //Export
        ExportController ec = Lookup.getDefault().lookup(ExportController.class);
        try {
            ec.exportFile(new File("/home/tpinville/git/jazzgraph/gexf/"+artist.replace(" ", "_") +".gexf"));
        } catch (IOException ex) {
            ex.printStackTrace();
            return;
        } 
    }
}
