#genere un graph (dot) en fonction de la base de donees
import sqlite3 as lite
import sys

f = open('graph.dot', 'w')

con = lite.connect('allmusic.db')
with con:
  cur = con.cursor()
  cur.execute("SELECT * FROM Creditsalbum")

  rows = cur.fetchall()

  albumId = 0
  primArtists = []
  credits = []

  f.write("digraph G { \n")

  for row in rows:
    if albumId != row[0]:
      prevArt =[]
      for art in primArtists:
#        if prevArt != []:
#          line = '"'+ prevArt[2] + '" +-> "' + art[2] + '" [album="' + art[1] + '" job="'+  art[3] +"\"] \n"
#          f.write(line.encode('utf-8'))
#        else:
#          prevArt = art

        for credit in credits:
          if credit[2] != art[2]:
            line = '"'+ art[2] + '" -> "' + credit[2] + '" [album="' + credit[1] + '" job="'+  credit[3] +"\"] \n"
            f.write(line.encode('utf-8'))
          primArtists = []
          credits = []
#580316, u'75th Birthday Bash Live!', u'Mel Lee', u'Drums', 9, 1825961)
      albumId = row[0]
    else:
      if row[4] == 1: #primary artist
        primArtists.append(row)
      elif row[4] != 6: #guest artist est elimine (doublon)
        credits.append(row)
  f.write("}\n")
  f.close()
      


  

