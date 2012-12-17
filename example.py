#!/usr/bin/env python
#-*- coding:utf-8 -*-
#
# Exemple d'ajout de l'album 'Kind of Blue' a la BD

from todb import *

con = lite.connect('allmusic.db')
with con:
  cur = con.cursor()
  results = reqAlbumByName('Kind of Blue')
  showResults(results) # Affiche tous les resultats de la recherche
  albumToDB(results[0]['album'],cur) # Ajoute le premier resultat a la BD
  con.commit()
  #con.close() # FIXME quand on le met, "Cannot operate on a closed database" !?
