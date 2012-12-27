#!/usr/bin/env python
#-*- coding:utf-8 -*-
#
# Fonctions pour faire des requetes sur la base AllMusic

import os
import simplejson
import json
import urllib
import io

import codecs
import sys

# TODO A cacher quelquepart
SEARCH_BASE = 'http://api.rovicorp.com/search/v2.1/music/search'
CALL_API = 'http://developer.rovicorp.com/io-docs/call-api'
API_KEY = 'brghmpbs732kts7npwjv649k'
API_SECRET = '9cP9vZ2bST'
SYN_TOKEN = '31c0044d7fd199270b22c67a1e8badca' # X-Ajax-Synchronization-Token dans le header la requete envoye par l'API console
COOKIE = 'MASH=53d8ccb05f0f708689d52df6a6504b6f' # Cookie dans le header la requete envoye par l'API console


API_KEY = 'pvspgubdv5q8grc8r9npb6eq'
API_SECRET = 'ZDvjkKDuhE'
SYN_TOKEN = '00996e8cf7e1c198e358ba31c6ec3a1b' # X-Ajax-Synchronization-Token dans le header la requete envoye par l'API console
COOKIE = 'MASH=9307c31cfea50cde35136c59dde75198' # Cookie dans le header la requete envoye par l'API console

# Seuil en dessous duquel les resultats sont ignores
# 2 => ne filtre que le nom exact (i.e. John Coltrane, Miles Davis)
# 1 => filtre les groupes et nom similaires (i.e. John Coltrane Quartet, Ryan Miles Davis)
RELEVANCE_THRESHOLD = 2.0

def relevant(result):
  """ Indique si le resultat d'une requete est suffisament pertinent
  """
  return result['relevance'][0]['value'] >= RELEVANCE_THRESHOLD

nameIdToStr = lambda nameId : 'MN'+str(nameId).zfill(10)

albumIdToStr = lambda albumId : 'MW'+str(albumId).zfill(10)

strToId = lambda s : int(s[2:])

# FIXME Problemes avec certains caracteres accentues !
def toQuery(s):
  """ Transforme une chaine de caractere pour qu'elle
      puisse servir dans une requete, en remplacant ou
      en eliminant les caracteres non supportes
  """
  s = s.encode('utf-8')
  return urllib.quote(s.replace(" ", "+"), safe='+')

# FIXME Listes empiriques, il en manque probablement beaucoup...
albumTypes = ['Album', 'EP', 'Single']
albumFlags = ['Compilation', 'Digitally Remastered', 'Instrumental', 'Limited Edition', 'Video', 'Bootleg', 'Gold', 'XRCD Mastered', 'Offensive image,title,lyrics', 'Tribute']

def basicRequest(endpointName):
   """ Requete basique, recupere 'There was an issue with your form submission' en cas de probleme
   """
   requete = "curl -L '" + CALL_API + "' -d '" + endpointName +  "&params[clu]=&params[start]=&params[end]=&params[rep]=1&params[facet]=&params[filter]=&params[include]=&params[size]=20&params[offset]=0&params[country]=US&params[language]=en&params[format]=json&apiId=117&apiKey=" + API_KEY + "&apiSecret="+ API_SECRET + "&basicAuthName=&basicAuthPass='  --header 'Host: developer.rovicorp.com' --header 'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:17.0) Gecko/17.0 Firefox/17.0' --header 'Accept: application/json, text/javascript, */*; q=0.01' --header 'Accept-Language: en-US,en;q=0.5' --header 'Accept-Encoding: gzip, deflate' --header 'Connection: keep-alive' --header 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8' --header 'X-Ajax-Synchronization-Token: "+ SYN_TOKEN + "' --header 'X-Requested-With: XMLHttpRequest' --header 'Referer: http://developer.rovicorp.com/io-docs' --header 'Cookie: " + COOKIE + "' --header 'Pragma: no-cache' --header 'Cache-Control: no-cache'"
   reponse = os.popen(requete).read()
   if reponse == 'There was an issue with your form submission':
      return None
   return reponse

def stdRequest(endpointName):
  reponse = basicRequest(endpointName)
  if reponse == None:
    return None
  #print reponse
  tmp = simplejson.loads(reponse)
  
  if tmp['responseBody'] == "<h1>403 Developer Inactive</h1>":
    print "*********** Erreur dans l'API Key : inactive" 
    return None
  results = simplejson.loads(tmp['responseBody'])
  
  #if reponse.find('responseBody') < 0:
  #   print "ERR_" + endpointName
  #   return None
  #else:
  #   reponse = reponse[reponse.index('status', reponse.index('responseBody'))-3:reponse.index('responseRaw')-3]
  #   reponse = reponse.replace('\\\\\\"', '')
  #   reponse = reponse.replace('\\"', '"').replace("\\n", "")
  #   results = simplejson.loads(reponse)
  
  return results

def reqArtistByName(nomArtiste):
  """Retourne le resultat d'une recherche sur le nom d'un artiste
     sous la forme d'une liste de dictionnaires
  """
  endpointName = "endpointName=Search&methodName=Search&httpMethod=GET&methodUri=search/v2.1/:endpoint/search&params[:endpoint]=music&params[entitytype]=artist&params[query]=" + toQuery(nomArtiste)

  #reponse = basicRequest(endpointName)
  #if reponse == None:
  #   return None
  #reponse = reponse[reponse.index('searchResponse') - 3: reponse.index('responseRaw')-3]
  #results = simplejson.loads(reponse.replace('\\"', '"').replace("\\n", ""))
  results = stdRequest(endpointName)
  if results != None:
    results = results['searchResponse']['results']
  return results

def reqArtistById(artistId):
  """Retourne le resultat d'une requete sur l'id d'un artiste
  """
  result = stdRequest("endpointName=Name&methodName=Info&httpMethod=GET&methodUri=data/v1/name/info&params[nameid]=" + nameIdToStr(artistId))
  if result != None:
    result = result['name']
  return result

# TODO a debugger
def reqInfluencers(artistId):
   return stdRequest("endpointName=Name&methodName=Influencers&httpMethod=GET&methodUri=data/v1/influencers&params[nameid]=" + nameIdToStr(artistId))

def reqAlbumByName(nomAlbum):
  """Retourne le resultat d'une recherche sur le nom d'un album
    sous la forme d'une liste de dictionnaires
  """
  endpointName = "endpointName=Search&methodName=Search&httpMethod=GET&methodUri=search/v2.1/:endpoint/search&params[:endpoint]=music&params[entitytype]=album&params[query]=" + toQuery(nomAlbum)
  results = stdRequest(endpointName)
  if results != None:
    results = results['searchResponse']['results']
  return results

def reqCredits(albumId):
  results = stdRequest("endpointName=Album&methodName=Credits&httpMethod=GET&methodUri=data/v1/album/credits&params[album]=&params[albumid]=" + albumIdToStr(albumId))
  if results != None:
    results = results['credits']
  return results

# TODO Utiliser l'id de l'artiste a la place !!
#def reqDiscography(nomArtiste):
#   endpointName = 'endpointName=Name&methodName=Discography&httpMethod=GET&methodUri=data/v1/name/discography&params[name]=' + nomArtiste.replace(" ","+")
#   results  = stdRequest(endpointName)
#   if results == None or results['status'] == 'error': 
#      print '__ERR : ' + nomArtiste
#   else:
#      for resultat in results['discography']:
#         #test a l'arrache pour voir si les credits ont deja ete rajoute 
#         if len(os.popen('grep '+resultat['ids']['albumId']+' fullLinks.dot').read()) == 0:
#            print resultat['ids']['albumId'], resultat['title']
#            getCredits(resultat['ids']['albumId'], nomArtiste, resultat['title'] )

def reqDiscography(artistId):
  results = stdRequest("endpointName=Name&methodName=Discography&httpMethod=GET&methodUri=data/v1/name/discography&params[name]=&params[amgmovieid]=&params[amgpopid]=&params[amgclassicalid]=&params[cosmoid]=&params[nameid]=" + nameIdToStr(artistId))
  if results != None:
    results = results['discography']
  return results

def showResults(results):
  """ Affiche les resultats d'une recherche (API v2.1) suivant leur pertinence
  """
  for result in results:
    line = ''
    if result.has_key('relevance'):
      line = line + str(result['relevance'][0]['value'])+' : '
    if result['type'] == 'artist': # Recherhe sur un artiste
      line = line + result['name']['name'] + ' (' + result['name']['ids']['nameId'] + ')'
    elif result['type'] == 'album': # Recherhe sur un album
      line = line + result['album']['title'] + ' (' + result['album']['ids']['albumId'] + ')'
    else:
      print '__ERR : type de recherche non pris en charge'
      return None
    print line

def showAlbum(album):
  print album['title'] + ' (' + album['ids']['albumId'] + ')'

# TODO
#def showCredits(credits)
#  elif result.has_key('credit'): # Requete de credits d'un album
#      line = line + result['name'] + ' (' + result['id'] + ') : ' + result['credit'] + #' [' + result['type'] + ']'
