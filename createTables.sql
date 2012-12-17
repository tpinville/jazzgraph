-- Script de creation de la base de donnees

CREATE TABLE Artists(id integer primary key,
                       name text not null,
                       birthDate date,
                       birthPlace text,
                       deathDate date,
                       deathPlace text,
                       country text,
                       headlineBio text);
CREATE TABLE ActiveYears(artistId integer references Artists(id) not null,
                           decade integer not null,
                           PRIMARY KEY(artistId,decade));
CREATE TABLE Influencers(artistId integer references Artists(id) not null,
                           influencerId integer references Artists(id) not null,
                           weight integer not null,
                           PRIMARY KEY(artistId,weight));

CREATE TABLE Albums(id integer primary key,
                      title text not null,
                      originalReleaseDate date not null,
                      label text,
                      type text, -- a remplacer par un enum quand on est sur de connaitre toutes les valeurs possibles
                      rating int not null,
                      duration int);
CREATE TABLE AlbumPrimaryArtists(
                      albumId integer REFERENCES Albums(id) not null,
                      artistId integer REFERENCES Artists(id) not null,
                      PRIMARY KEY(albumId,artistId));
CREATE TABLE AlbumFlags(albumId integer REFERENCES Albums(id) not null,
                         flag text not null,
                         PRIMARY KEY(albumId,flag));
CREATE TABLE CreditTypes(albumId integer references Albums(id) not null,
                           artistId integer references Artists(id) not null,
                           type char not null,
                           PRIMARY KEY(albumId,artistId));
CREATE TABLE CreditJobs(albumId integer REFERENCES Albums(id) not null,
                         artistId integer REFERENCES Artists(id) not null,
                         job text not null,
                         PRIMARY KEY(albumId,artistId,job));

CREATE TABLE Genres(id integer primary key, name text not null);
CREATE TABLE ArtistGenres(artistId integer REFERENCES Artists(id) not null,
                           genreId integer REFERENCES Genres(id) not null,
                           weight integer not null,
                           PRIMARY KEY(artistId,genreId));
CREATE TABLE AlbumGenres(albumId integer REFERENCES Albums(id) not null,
                           genreId integer REFERENCES Genres(id) not null,
                           weight integer not null,
                           PRIMARY KEY(albumId,genreId));

CREATE TABLE Styles(id integer primary key, name text not null);
CREATE TABLE ArtistStyles(artistId integer REFERENCES Artists(id) not null,
                           styleId integer REFERENCES Styles(id) not null,
                           weight integer not null);

-- TODO : MembersOf
