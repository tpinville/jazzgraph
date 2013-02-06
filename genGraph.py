#genere un graph (dot) en fonction de la base de donees
import sqlite3 as lite
import sys

f = open('graph.dot', 'w')

con = lite.connect('allmusic.db')
with con:
  cur = con.cursor()
  cur.execute("SELECT * FROM Creditsalbum where id in (select credits.albumid from credits,artists, linksjobcategory  where artists.id = credits.artistid and credits.jobid = linksjobcategory.jobid and artists.name in ('Paul Chambers'))")

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
            line = '"'+ art[2].replace('"','') + '" -> "' + credit[2].replace('"','')  + '" [label="' + credit[1].replace('"','\"')  + '" job="'+  credit[3] +"\"] \n"
            f.write(line.encode('utf-8'))
#580316, u'75th Birthday Bash Live!', u'Mel Lee', u'Drums', 9, 1825961)

      primArtists = []
      credits = []
      albumId = row[0]
    else:
      if row[4] == 1: #primary artist
#        print row[2] + ' - ' + row[1]
        primArtists.append(row)
      elif row[4] != 6: #guest artist est elimine (doublon)
        credits.append(row)
  f.write("}\n")
  f.close()
      


  

