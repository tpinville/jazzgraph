Creer la base de donnees allmusic :

sqlite3 allmusic.db < createTables.sql
sqlite3 allmusic.db < data.sql

Pour ajouter les infos, la discographie complete et les credits pour chaque album, d'une liste de musiciens :
composer la liste dans artistes.txt
puis executer "addArtistsToDB.py artistes.txt"

Pour generer un graph : genGraph.py

tips
  conversion sqlite -> mysql
    export sql avec sqlitestudio
    sur fichier sql
      %s/\]//g
      %s/[//g
      %s/AUTOINCREMENT/AUTO_INCREMENT/g
        remplacer 
         artistId INTEGER REFERENCES Artists ( id )
                              NOT NULL,
        par 
         artistId INTEGER NOT NULL, FOREIGN KEY (artistId) REFERENCES Artists ( id ),

      remplacer flag TEXT en flag varchar(40) pour primary key  
      
      repérer les albums non insérés
      select albumid from credits where albumid not in (select id from albums)
      group by albumid
      les insérer : 
        INSERT INTO Albums (id,title,originalreleasedate,rating) VALUES (222, 'TOCOMPLETE','', '');
      dans CREATE VIEW -> case sensitive




pour less graphs : 
  partie javascript   
    sigma.js

  partie génération   
    pygexf
