import sys
import os

if len(sys.argv) < 2:
  print "Nom du fichier contenant la liste des artistes a preciser"
else:
  print sys.argv[1]
  f = open(sys.argv[1], 'r')
  reponse = f.readlines()

  print "<select>"
  for artiste in reponse:
     artiste = artiste.replace('\n','')
     if( os.path.getsize("gexf/" + artiste.replace(" ","_") + ".gexf") > 1095):
        print "<option value='"+ artiste.replace(" ","_") +"'>"+ artiste + "</option>"
     #os.system("java -jar JazzGraph.jar '" + artiste + "' 20")
  print "</select>"
     
  f.close()
