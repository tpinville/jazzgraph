#!/usr/bin/env python
#-*- coding:utf-8 -*-
#
# Ajoute les artistes d'une liste ainsi que leur discographie (infos de leurs albums)
# TODO pas termine, pour l'instant c'est un test qui d'ajoute qu'un seul artiste

from todb import *
from itertools import ifilter

ignoredAlbumFlags = set(['Compilation','Bootleg','Video'])

con = lite.connect('allmusic.db')
with con:
  cur = con.cursor()
  artistName = 'John Coltrane'
  artistResults = reqArtistByName(artistName)
  print '=== '+artistName + ' ====================='
  showResults(artistResults)
  # Ne considere que les resultats avec une
  # pertinence suffisante (cf allmusic.py)
  artistResults = filter(relevant,artistResults)
  print "*** Apres filtrage des artistes pertinents :"
  showResults(artistResults)
  for artistResult in artistResults:
    artistId = strToId(artistResult['name']['ids']['nameId'])
    artistName = artistResult['name']['name']
    print '*** Ajout de l\'artiste \"'+artistName+'\" (id='+str(artistId)+')'
    # Ajoute l'artiste a la base
    artistToDB(artistResult['name'],cur)
    con.commit()
    # Recupere sa discographie
    discResults = reqDiscography(artistId)
    tailleDisc = len(discResults)
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
        print "*** Ajout de l'album \""+albumName+"\" (id=" \
          +str(albumId)+", "+ str(cptDiscResults)+"/"+str(tailleDisc)+")"
        albumSearchResults = reqAlbumByName(albumName)
        if albumSearchResults != None:
          albumSearchResult = next(ifilter(lambda r : strToId(r['album']['ids']['albumId'])==albumId, albumSearchResults))
          if albumSearchResult != None:
            albumToDB(albumSearchResult['album'],cur)
            con.commit()
          else:
            print "!!! Impossible de trouver les infos de l'album"
        else:
          print "Echec de la recherche de l'album intitule "+albumName
  #con.close() # FIXME quand on le met, "Cannot operate on a closed database" !?
