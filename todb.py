#!/usr/bin/env python
#-*- coding:utf-8 -*-
#
# Methodes pour ajouter le resultat de requetes a la base de donnees

from allmusic import *

import sqlite3 as lite
import sys


def artistToDB(artist,cur):
  artistId = strToId(artist['ids']['nameId']) # 'MN0000423829' -> 423829
  
  # Verifie si l'artiste n'est pas deja dans la table Artists
  cur.execute('SELECT COUNT(*) FROM Artists WHERE id='+str(artistId))
  data = cur.fetchone()
  if data[0] > 0:
    print "*** Artiste deja dans la base"
    return
  
  name = artist['name']
  print "**********************************************"
  print artist['active']

  if artist['active'] == None:
    active = []
  else:
    active = [int(d[:-1]) for d in artist['active']] # '1960s','1970s',... -> 1960, 1970,...
  birthDate,birthPlace='NULL','NULL'
  if artist.has_key('birth') and artist['birth'] != None:
    if artist['birth'].has_key('date') and artist['birth']['date'] != None:
      birthDate = artist['birth']['date']
    if artist['birth'].has_key('place') and artist['birth']['place'] != None:
      birthPlace = artist['birth']['place']
  print 'birthDate=%s, birthPlace=%s' % (birthDate,birthPlace)
  country = 'NULL'
  if artist.has_key('country') and artist['country'] != None:
    country = artist['country']
  deathDate,deathPlace='NULL','NULL'
  if artist.has_key('death') and artist['death'] != None:
    if artist['death'].has_key('date') and artist['death']['date'] != None:
      deathDate = artist['death']['date']
    if artist['death'].has_key('place') and artist['death']['place'] != None:
      deathPlace = artist['death']['place']
  headlineBio = 'NULL'
  if artist.has_key('headlineBio') and artist['headlineBio'] != None:
    headlineBio = artist['headlineBio'].encode('utf-8')

    print("INSERT INTO Artists VALUES(?,?,?,?,?,?,?,?)" , (artistId, name, birthDate, birthPlace, deathDate, deathPlace, country, headlineBio))
#le buffer est nécessaire dans certains cas pour des problemes d'encoding
    cur.execute("INSERT INTO Artists VALUES(?,?,?,?,?,?,?,?)" , (artistId, name, birthDate, birthPlace, deathDate, deathPlace, country, buffer(headlineBio)))

  #le buffer est nécessaire dans certains cas pour des problemes d'encoding
  data = cur.fetchone()
  
  # Ajoute les annees d'activite a la table ActiveYears
  for decade in active:
    cur.execute(('INSERT INTO ActiveYears VALUES(?,?)'),(artistId, decade))
    data = cur.fetchone()
  
  # Ajoute les genres de l'artiste a la table ArtistGenres
  musicGenres = artist['musicGenres']
  print musicGenres

  if musicGenres != None:
    for musicGenre in musicGenres:
      genreId = strToId(musicGenre['id'])
      weight = int(musicGenre['weight'])
      # Verifie que le genre est deja dans la table des genres
      cur.execute('SELECT COUNT(*) FROM Genres WHERE id='+str(genreId))
      data = cur.fetchone()
      if data[0] == 0:
        # Il faut d'abord ajouter le genre a la table des genres
        genreName = musicGenre['name']
        cur.execute('INSERT INTO Genres VALUES(?,?)', (genreId, genreName))
        data = cur.fetchone()
      cur.execute(('INSERT INTO ArtistGenres VALUES(?,?,?)'), (artistId, genreId, weight))
      data = cur.fetchone()

def isAlbumInDb(albumId,cur):
  # Verifie si l'artiste n'est pas deja dans la table Artists
  cur.execute('SELECT COUNT(*) FROM Albums WHERE id='+str(albumId))
  data = cur.fetchone()
  if data[0] > 0:
    print "*** Album deja dans la base ", albumId
    return True
  else:
    return False
  
def albumToDB(album,cur):
  albumId = strToId(album['ids']['albumId']) # 'MW0000187921' -> 187921
 
  if isAlbumInDb(albumId,cur) == True:
    return
  
  title = album['title']
  originalReleaseDate = 'NULL'
  if album.has_key('year') and album['year'] != '': # API v1
    originalReleaseDate = album['year']
  elif album.has_key('originalReleaseDate') and album['originalReleaseDate'] != None: # API v2.1
    originalReleaseDate = album['originalReleaseDate']
  label = 'NULL' # API v1
  if album.has_key('label') and album['label'] != '':
    label = album['label']
  atype = 'NULL' # API v1
  if album.has_key('atype'):
    atype = album['type']
  rating = int(album['rating'])
  duration = 'NULL' # Seulement dans l'API v2.1
  if album.has_key('duration'):
    duration = album['duration']
  # Execute la requete d'insertion dans Albums
  cur.execute("INSERT INTO Albums VALUES(?,?,?,?,?,?,?)", (albumId, title, originalReleaseDate, label, atype, rating, duration))
  data = cur.fetchone()  
  # Ajoute les flags de l'album a la table AlbumFlags
  flags = album['flags']
  if flags != None:
    for flag in flags:
      cur.execute("INSERT INTO AlbumFlags VALUES(?,?)", (albumId, flag))
      data = cur.fetchone()
  
  # Ajoute les artistes principaux de l'album
  # a la table AlbumPrimaryArtists (API v2.1)
  if album.has_key('primaryArtists'):
    artists = album['primaryArtists']
    for artist in artists:
      artistId = strToId(artist['id'])
      # Verifie que cet artiste est deja dans la table Artists
      cur.execute('SELECT COUNT(*) FROM Artists WHERE id='+str(artistId))
      data = cur.fetchone()
      if data[0] == 0:
        # Il faut d'abord ajouter l'artiste a la table Artists
        artistResult = reqArtistById(artistId)
        artistToDB(artistResult,cur)
      cur.execute(("INSERT INTO AlbumPrimaryArtists VALUES(?,?)"), (albumId, artistId))
      data = cur.fetchone()
  
  # Ajoute les genres de l'album la table AlbumGenres (API v2.1)
  if album.has_key('genres'):
    genres = album['genres']
    if genres != None:
      for genre in genres:
        genreId = strToId(genre['id'])
        weight = int(genre['weight'])
        # Verifie que le genre est deja dans la table Genres
        cur.execute('SELECT COUNT(*) FROM Genres WHERE id='+str(genreId))
        data = cur.fetchone()
        if data[0] == 0:
          # Il faut d'abord ajouter le genre a la table Genres
          genreName = genre['name']
          cur.execute("INSERT INTO Genres VALUES(?,?)", (genreId, genreName))
          data = cur.fetchone()
        cur.execute("INSERT INTO AlbumGenres VALUES(?,?,?)", (albumId, genreId, weight))
        data = cur.fetchone()
  # TODO ajouter les primaryArtists dans une table AlbumPrimaryArtists


def creditToDB(credit,albumId,cur, con):
  if albumId == None:
    print '__ERR : l\'id de l\'album doit etre specifie'
    return
  
  print credit
  nameId = strToId(credit['id']) # 'MN0000423829' -> 423829
  
  # Verifie si cet artiste se trouve deja dans la table Artists
  cur.execute('SELECT COUNT(*) FROM Artists WHERE id='+str(nameId))
  data = cur.fetchone()
  if data[0] == 0:
    # Il faut d'abord ajouter l'artiste a la table Artists
    artist = reqArtistById(nameId)
    if artist == None:
      print '__ERR : impossible de trouver l\'artiste '+nameIdToStr(nameId)+' sur allmusic !'
      return
    artistToDB(artist,cur)
  
  #name = '"'+credit['name'].encode('utf-8')+'"'
  '''
  ctype = credit['type'] # un caractere
  
  cur.execute("INSERT INTO CreditTypes VALUES(?,?,?)", (albumId, nameId, ctype))
  data = cur.fetchone()
  '''

  # Ajoute les jobs effectues sur l'album dans la table CreditJobs
  jobs = map(lambda x : x.strip(),credit['credit'].split(','))
  for job in jobs:
    jobLabel = (job,)
    print job
    cur.execute("SELECT COUNT(jobId) FROM jobs WHERE job=?", jobLabel)
    data = cur.fetchone()

    if data[0] == 0:
      cur.execute("INSERT INTO Jobs (job) VALUES(?)", jobLabel)
      print("INSERT INTO Jobs (job) VALUES(?)", jobLabel)
      con.commit()

    cur.execute("SELECT jobId FROM jobs WHERE job=?", jobLabel)
    data = cur.fetchone()
    if data[0] == 0:
      print "**********************************" 
      print jobLabel
      print "+++++++++ ", albumId,nameId,data[0]
    else:
      try:
        print("INSERT INTO Credits VALUES(?,?,?)", (albumId,nameId,data[0]))
        cur.execute("INSERT INTO Credits VALUES(?,?,?)", (albumId,nameId,data[0]))
      except :
        print albumId,nameId,data[0]
        print "---- Credit deja insere"

    con.commit()
    

def searchResultsToDB(results):
  con = lite.connect('allmusic.db')
  with con:
    cur = con.cursor()
    for result in results:
      if result['type'] == 'artist':
        artistToDB(result['name'],cur)
      elif result['type'] == 'album':
        albumToDB(result['album'],cur)
      else:
        print '__ERR : type de recherche non pris en charge'
    con.commit()
    con.close()

