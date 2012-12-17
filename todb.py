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
  
  name = '"'+artist['name'].encode('utf-8')+'"'
  active = [int(d[:-1]) for d in artist['active']] # '1960s','1970s',... -> 1960, 1970,...
  birthDate,birthPlace='NULL','NULL'
  if artist.has_key('birth') and artist['birth'] != None:
    if artist['birth'].has_key('date') and artist['birth']['date'] != None:
      birthDate = '"'+artist['birth']['date'].encode('utf-8')+'"'
    if artist['birth'].has_key('place') and artist['birth']['place'] != None:
      birthPlace = '"'+artist['birth']['place'].encode('utf-8')+'"'
  print 'birthDate=%s, birthPlace=%s' % (birthDate,birthPlace)
  country = 'NULL'
  if artist.has_key('country') and artist['country'] != None:
    country = '"'+artist['country'].encode('utf-8')+'"'
  deathDate,deathPlace='NULL','NULL'
  if artist.has_key('death') and artist['death'] != None:
    if artist['death'].has_key('date') and artist['death']['date'] != None:
      deathDate = '"'+artist['death']['date'].encode('utf-8')+'"'
    if artist['death'].has_key('place') and artist['death']['place'] != None:
      deathPlace = '"'+artist['death']['place'].encode('utf-8')+'"'
  headlineBio = 'NULL'
  if artist.has_key('headlineBio') and artist['headlineBio'] != None:
    headlineBio = '"'+artist['headlineBio'].encode('utf-8')+'"'
  req = ('INSERT INTO Artists VALUES(%d,%s,%s,%s,%s,%s,%s,%s)') \
    % (artistId, name, birthDate, birthPlace, deathDate, deathPlace, country, headlineBio)
  print req
  cur.execute(req)
  data = cur.fetchone()
  
  # Ajoute les annees d'activite a la table ActiveYears
  for decade in active:
    cur.execute(('INSERT INTO ActiveYears VALUES(%d,%d)') \
      % (artistId, decade))
    data = cur.fetchone()
  
  # Ajoute les genres de l'artiste a la table ArtistGenres
  musicGenres = artist['musicGenres']
  for musicGenre in musicGenres:
    genreId = strToId(musicGenre['id'])
    weight = int(musicGenre['weight'])
    # Verifie que le genre est deja dans la table des genres
    cur.execute('SELECT COUNT(*) FROM Genres WHERE id='+str(genreId))
    data = cur.fetchone()
    if data[0] == 0:
      # Il faut d'abord ajouter le genre a la table des genres
      genreName = '"'+musicGenre['name'].encode('utf-8')+'"'
      cur.execute('INSERT INTO Genres VALUES(%d,%s)' % (genreId, genreName))
      data = cur.fetchone()
    cur.execute(('INSERT INTO ArtistGenres VALUES(%d,%d,%d)') \
      % (artistId, genreId, weight))
    data = cur.fetchone()


def albumToDB(album,cur):
  albumId = strToId(album['ids']['albumId']) # 'MW0000187921' -> 187921
  
  # Verifie si l'artiste n'est pas deja dans la table Artists
  cur.execute('SELECT COUNT(*) FROM Albums WHERE id='+str(albumId))
  data = cur.fetchone()
  if data[0] > 0:
    print "*** Album deja dans la base"
    return
  
  title = '"'+album['title'].encode('utf-8')+'"'
  originalReleaseDate = 'NULL'
  if album.has_key('year') and album['year'] != '': # API v1
    originalReleaseDate = '"'+album['year'].encode('utf-8')+'"'
  elif album.has_key('originalReleaseDate'): # API v2.1
    originalReleaseDate = '"'+album['originalReleaseDate'].encode('utf-8')+'"'
  label = 'NULL' # API v1
  if album.has_key('label') and album['label'] != '':
    label = '"'+album['label'].encode('utf-8')+'"'
  atype = 'NULL' # API v1
  if album.has_key('atype'):
    atype = '"'+album['type'].encode('utf-8')+'"'
  rating = int(album['rating'])
  duration = 'NULL' # Seulement dans l'API v2.1
  if album.has_key('duration'):
    duration = album['duration']
  # Execute la requete d'insertion dans Albums
  req = 'INSERT INTO Albums VALUES(%d,%s,%s,%s,%s,%d,%s)' % (albumId, title, originalReleaseDate, label, atype, rating, duration)
  print req
  cur.execute(req)
  data = cur.fetchone()  
  # Ajoute les flags de l'album a la table AlbumFlags
  flags = album['flags']
  if flags != None:
    for flag in flags:
      cur.execute('INSERT INTO AlbumFlags VALUES(%d,"%s")' % (albumId, flag))
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
      cur.execute(('INSERT INTO AlbumPrimaryArtists VALUES(%d,%d)') \
          % (albumId, artistId))
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
          genreName = '"'+musicGenre['name'].encode('utf-8')+'"'
          cur.execute('INSERT INTO Genres VALUES(%d,%s)' % (genreId, genreName))
          data = cur.fetchone()
        cur.execute(('INSERT INTO AlbumGenres VALUES(%d,%d,%d)') \
          % (albumId, genreId, weight))
        data = cur.fetchone()
  # TODO ajouter les primaryArtists dans une table AlbumPrimaryArtists


def creditToDB(credit,albumId,cur):
  if albumId == None:
    print '__ERR : l\'id de l\'album doit etre specifie'
    return
  
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
  ctype = '"'+credit['type'].encode('utf-8')+'"' # un caractere
  req = 'INSERT INTO CreditTypes VALUES(%d,%d,%s)' % (albumId, nameId, ctype)
  print req
  cur.execute(req)
  data = cur.fetchone()
  
  # Ajoute les jobs effectues sur l'album dans la table CreditJobs
  jobs = map(lambda x : x.strip(),credit['credit'].split(','))
  for job in jobs:
    req = 'INSERT INTO CreditJobs VALUES(%d,%d,%s)' % (albumId, nameId, job)
    print req
    cur.execute(req)
    data = cur.fetchone()


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

