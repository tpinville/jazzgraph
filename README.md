Creer la base de donnees allmusic :

sqlite3 allmusic.db < createTables.sql
sqlite3 allmusic.db < data.sql

Pour ajouter les infos, la discographie complete et les credits pour chaque album, d'une liste de musiciens :
composer la liste dans artistes.txt
puis executer "addArtistsToDB.py artistes.txt"

Pour generer un graph : genGraph.py
