import os
import simplejson, urllib

import constantes # fichier avec SEARCH_BASE CALL_API  API_KEY  API_SECRET SYN_TOKEN COOKIE

import codecs
import sys

streamWriter = codecs.lookup('utf-8')[-1]
sys.stdout = streamWriter(sys.stdout)


'''
def search(query, size=20,  **kwargs):
  kwargs.update({
    'apikey': API_KEY,
    'sig': SIG,
    'entitytype': 'artist',
    'query': query,
    'size': size,
    'country': 'US',
    'language': 'en',
    'offset': 0,
    'format': 'json'
    })


  url = SEARCH_BASE + '?' + urllib.urlencode(kwargs)
  print url
  results = simplejson.load(urllib.urlopen(url))
  print results['searchResponse']['results'][0]['id']
  pprint(results)
  
  for result in results:
    print result

  #return result['results']
'''  

def basicRequest(endpointName):
   requete = "curl -L '" + constantes.CALL_API + "' -d '" + endpointName +  "&params[clu]=&params[start]=&params[end]=&params[rep]=1&params[facet]=&params[filter]=&params[include]=&params[size]=20&params[offset]=0&params[country]=US&params[language]=en&params[format]=json&apiId=117&apiKey=" + constantes.API_KEY + "&apiSecret="+ constantes.API_SECRET + "&basicAuthName=&basicAuthPass='  --header 'Host: developer.rovicorp.com' --header 'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:17.0) Gecko/17.0 Firefox/17.0' --header 'Accept: application/json, text/javascript, */*; q=0.01' --header 'Accept-Language: en-US,en;q=0.5' --header 'Accept-Encoding: gzip, deflate' --header 'Connection: keep-alive' --header 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8' --header 'X-Ajax-Synchronization-Token: "+ constantes.SYN_TOKEN + "' --header 'X-Requested-With: XMLHttpRequest' --header 'Referer: http://developer.rovicorp.com/io-docs' --header 'Cookie: " + constantes.COOKIE + "' --header 'Pragma: no-cache' --header 'Cache-Control: no-cache'"

   #print requete
   reponse = os.popen(requete).read()

   #if reponse == "There was an issue with your form submission":

   return reponse 
   #print reponse
   #print "--"

def getInfoArtiste(artiste):
   endpointName = "endpointName=Search&methodName=Search&httpMethod=GET&methodUri=search/v2.1/:endpoint/search&params[:endpoint]=music&params[entitytype]=artist&params[query]=" + artiste.replace(" ", "+") 

   reponse = basicRequest(endpointName)
   reponse = reponse[reponse.index('searchResponse') - 3: reponse.index('responseRaw')-3]
   results = simplejson.loads(reponse.replace('\\"', '"').replace("\\n", ""))
   return results


def getStandardRequest(endpointName):
   reponse = basicRequest(endpointName) 

   if reponse.find('responseBody') < 0:
      print "ERR_" + endpointName
      return False
   else:
      reponse = reponse[reponse.index('status', reponse.index('responseBody'))-3:reponse.index('responseRaw')-3]
      reponse = reponse.replace('\\\\\\"', '')
      reponse = reponse.replace('\\"', '"').replace("\\n", "")

      results = simplejson.loads(reponse)

   return results

#print requete

def getIdArtist(nomArtiste):
   results = getInfoArtiste(nomArtiste)

   return results['searchResponse']['results'][0]['id']

def getCredits(albumId, nomArtiste, nomAlbum):
   endpointName = "endpointName=Album&methodName=Credits&httpMethod=GET&methodUri=data/v1/album/credits&params[album]=&params[albumid]=" + albumId

   results  = getStandardRequest(endpointName)
   #print results
   
   if results != False:
      for resultat in  results['credits']:
         #print resultat
         #print resultat['credit'], resultat['name']
         if nomArtiste != resultat['name']:
            print '"'+ nomArtiste +'" -> "'+resultat['name']+'" [label="'+ nomAlbum+' |'+resultat['credit'] +'|"]' 
         #print resultat['credit']

def getDiscography(nomArtiste):
   endpointName = 'endpointName=Name&methodName=Discography&httpMethod=GET&methodUri=data/v1/name/discography&params[name]=' + nomArtiste.replace(" ","+")

   results  = getStandardRequest(endpointName)
   
   
   if results == False or results['status'] == 'error': 
      print '__ERR : ' + nomArtiste
   else:
      for resultat in results['discography']:
         #test a l'arrache pour voir si les credits ont deja ete rajoute 
         if len(os.popen('grep '+resultat['ids']['albumId']+' *.log').read()) == 0:
            print resultat['ids']['albumId'], resultat['title']
            getCredits(resultat['ids']['albumId'], nomArtiste, resultat['title'] )

#print getCredits('MW0000449011')

#print getInfoArtiste('Eric Clapton')
f = open('bebop.txt', 'r')
reponse = f.readlines()

for artiste in reponse:
   artiste = artiste.replace('\n','')
   getDiscography(artiste)

f.close()

   #&params[amgmovieid]=&params[amgpopid]=&params[amgclassicalid]=&params[cosmoid]=&params[nameid]=&params[type]=&params[count]=0&params[offset]=0&params[country]=US&params[language]=en&params[format]=json&apiId=117&apiKey=brghmpbs732kts7npwjv649k&apiSecret=9cP9vZ2bST&basicAuthName=&basicAuthPas

#"curl -L 'http://developer.rovicorp.com/io-docs/call-api' -d 'endpointName=Search&methodName=Search&httpMethod=GET&methodUri=search/v2.1/:endpoint/search&params[:endpoint]=music&params[entitytype]=album&params[query]=a+love+supreme&params[clu]=&params[start]=&params[end]=&params[rep]=1&params[facet]=&params[filter]=&params[include]=&params[size]=20&params[offset]=0&params[country]=US&params[language]=en&params[format]=json&apiId=117&apiKey=brghmpbs732kts7npwjv649k&apiSecret=9cP9vZ2bST&basicAuthName=&basicAuthPass='  --header 'Host: developer.rovicorp.com' --header 'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:17.0) Gecko/17.0 Firefox/17.0' --header 'Accept: application/json, text/javascript, */*; q=0.01' --header 'Accept-Language: en-US,en;q=0.5' --header 'Accept-Encoding: gzip, deflate' --header 'Connection: keep-alive' --header 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8' --header 'X-Ajax-Synchronization-Token: f2d23791524554df676dfc0009478fe9' --header 'X-Requested-With: XMLHttpRequest' --header 'Referer: http://developer.rovicorp.com/io-docs' --header 'Cookie: MASH=eac40269c8a508852fb6929df7a9e5b5' --header 'Pragma: no-cache' --header 'Cache-Control: no-cache'"

