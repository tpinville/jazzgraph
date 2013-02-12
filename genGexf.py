import sys
import os
import json


def convertJson(path):
  with open(path) as f:
    data = json.load(f)

    arrCorrId = []
    for d in data['nodes']:
      arrCorrId.append(d['id'])

    i = 0
    for idd in arrCorrId:
      os.system("sed -i 's/\"" +idd + '\"/' + str(i) + "/g' " + path)
      i = i + 1


if len(sys.argv) < 2:
  print "Nom du fichier contenant la liste des artistes a preciser"
else:
  print sys.argv[1]
  f = open(sys.argv[1], 'r')
  reponse = f.readlines()

#  print "<select>"
  for artiste in reponse:
    artiste = artiste.replace('\n','')
#     if( os.path.getsize("gexf/" + artiste.replace(" ","_") + ".gexf") > 1095):
#        print "<option value='"+ artiste.replace(" ","_") +"'>"+ artiste + "</option>"
    os.system("java -jar JazzGraph.jar '" + artiste + "' 5 json")
    convertJson('web/gexf/' + artiste.replace(" ","_") + ".json")
    print 'conversion du fichier json '

#  print "</select>"
     
  f.close()
