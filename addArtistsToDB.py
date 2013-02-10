#!/usr/bin/env python
#-*- coding:utf-8 -*-
#
# Ajoute les artistes d'une liste ainsi que leur discographie (infos de leurs albums)
# TODO pas termine, pour l'instant c'est un test qui d'ajoute qu'un seul artiste


import sys

from todb import *
from itertools import ifilter

#bidouille permettant de traiter les caractères spéciaux
streamWriter = codecs.lookup('utf-8')[-1]
sys.stdout = streamWriter(sys.stdout)
###

DEBUG = True

ignoredAlbumFlags = set(['Compilation','Bootleg','Video'])

def addArtistToDb(artistName):
  con = lite.connect('data/allmusic.db')
  #con = mdb.connect('localhost', 'root', '', 'jazzgraph');
  with con:
    cur = con.cursor()
    artistResults = reqArtistByName(artistName)
    if DEBUG == True:
      print '=== '+artistName + ' ====================='

    if artistResults == None:
      if DEBUG == True:
        print "Erreur de recuperation artiste" 
    else:
      showResults(artistResults)
      # Ne considere que les resultats avec une
      # pertinence suffisante (cf allmusic.py)
      artistResults = filter(relevant,artistResults)

      if DEBUG == True:
        print "*** Apres filtrage des artistes pertinents :"

      showResults(artistResults)
      for artistResult in artistResults:
        artistId = strToId(artistResult['name']['ids']['nameId'])
        artistName = artistResult['name']['name']
        if DEBUG == True:
          print '*** Ajout de l\'artiste \"'+artistName+'\" (id='+str(artistId)+')'
        # Ajoute l'artiste a la base
        artistToDB(artistResult['name'],cur)
        con.commit()
        # Recupere sa discographie
        discResults = reqDiscography(artistId)

        if discResults == None:
           print "Pas de discographie associee"
        else:
           tailleDisc = len(discResults)
           
           if DEBUG == True:
             print "taille de la discographie complete : "+str(tailleDisc)

           cptDiscResults = 0
           
           for discResult in discResults:
             cptDiscResults = cptDiscResults + 1 
             flags = discResult['flags']
           
             # Ignore les compilations, videos et bootlegs
             if flags == None or len(flags) == 0 \
                 or len(ignoredAlbumFlags.intersection(set(flags)))==0:
               albumId = strToId(discResult['ids']['albumId'])
               albumName = discResult['title']

               if isAlbumInDb(albumId,cur) == False:
                 if DEBUG == True:
                   print "*** Ajout de l'album \""+albumName+"\" (id=" \
                   +str(albumId)+", "+ str(cptDiscResults)+"/"+str(tailleDisc)+")"

                 albumSearchResults = reqAlbumByName(albumName)

                 if albumSearchResults != None:
                   try:
                     albumSearchResult = next(ifilter(lambda r : strToId(r['album']['ids']['albumId'])==albumId, albumSearchResults))
                     if albumSearchResult != None:
                       albumToDB(albumSearchResult['album'],cur)
                       con.commit()
                     else:
                       print "!!! Impossible de trouver les infos de l'album"
                   except StopIteration:
                     print "fin des valeurs albumId"
                 else:
                   print "Echec de la recherche de l'album intitule "+albumName

                 #Ajout des credits 
                 credits = reqCredits(albumId)
                 for credit in credits:
                   creditToDB(credit,albumId, cur, con)


    #con.close() # FIXME quand on le met, "Cannot operate on a closed database" !?

if len(sys.argv) < 2:
  print "Nom du fichier contenant la liste des artistes a preciser"
else:
  print sys.argv[1]
  f = open(sys.argv[1], 'r')
  reponse = f.readlines()

  for artiste in reponse:
     artiste = artiste.replace('\n','')
     addArtistToDb(artiste)

  f.close()
