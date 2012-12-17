#!/usr/bin/env python
#-*- coding:utf-8 -*-
#
# Fonctions pour sauvegarder les resultats des requetes
# sous la forme de fichiers json

# Chemin ou stocker les fichiers json
RESULTS_PATH = './json'

def writeResultToFile(filename,jsonDic):
  with io.open(filename, 'wb') as outfile:
    json.dump(jsonDic, outfile)

def resultFilepath(result):
  """ Determine le chemin et nom de fichier json pour le resultat donne
  """
  basePath = RESULTS_PATH+'/'+result['type']+'/'
  if result['type'] == 'artist':
    return basePath + result['name']['ids']['nameId']+'.json'
  else:
    print '__ERR : type de reponse non pris en charge'

def saveResults(results):
  for result in results:
    if relevant(result):
      writeResultToFile(resultFilepath(result),result['name'])

def addArtists(nomArtiste):
  results = reqArtist(nomArtiste)
  if results != None:
    saveResults(results)
