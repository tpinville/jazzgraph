-- Table: Artists
CREATE TABLE Artists ( 
    id          INTEGER PRIMARY KEY,
    name        TEXT    NOT NULL,
    birthDate   DATE,
    birthPlace  TEXT,
    deathDate   DATE,
    deathPlace  TEXT,
    country     TEXT,
    headlineBio TEXT 
);




-- Table: ActiveYears
CREATE TABLE ActiveYears ( 
    artistId INTEGER REFERENCES Artists ( id ) 
                     NOT NULL,
    decade   INTEGER NOT NULL,
    PRIMARY KEY ( artistId, decade ) 
);




-- Table: Influencers
CREATE TABLE Influencers ( 
    artistId     INTEGER REFERENCES Artists ( id ) 
                         NOT NULL,
    influencerId INTEGER REFERENCES Artists ( id ) 
                         NOT NULL,
    weight       INTEGER NOT NULL,
    PRIMARY KEY ( artistId, weight ) 
);




-- Table: Albums
CREATE TABLE Albums ( 
    id                  INTEGER PRIMARY KEY,
    title               TEXT    NOT NULL,
    originalReleaseDate DATE    NOT NULL,
    label               TEXT,
    type                TEXT,
    rating              INT     NOT NULL,
    duration            INT 
);




-- Table: AlbumPrimaryArtists
CREATE TABLE AlbumPrimaryArtists ( 
    albumId  INTEGER REFERENCES Albums ( id ) 
                     NOT NULL,
    artistId INTEGER REFERENCES Artists ( id ) 
                     NOT NULL,
    PRIMARY KEY ( albumId, artistId ) 
);




-- Table: AlbumFlags
CREATE TABLE AlbumFlags ( 
    albumId INTEGER REFERENCES Albums ( id ) 
                    NOT NULL,
    flag    TEXT    NOT NULL,
    PRIMARY KEY ( albumId, flag ) 
);




-- Table: Genres
CREATE TABLE Genres ( 
    id   INTEGER PRIMARY KEY,
    name TEXT    NOT NULL 
);




-- Table: ArtistGenres
CREATE TABLE ArtistGenres ( 
    artistId INTEGER REFERENCES Artists ( id ) 
                     NOT NULL,
    genreId  INTEGER REFERENCES Genres ( id ) 
                     NOT NULL,
    weight   INTEGER NOT NULL,
    PRIMARY KEY ( artistId, genreId ) 
);




-- Table: AlbumGenres
CREATE TABLE AlbumGenres ( 
    albumId INTEGER REFERENCES Albums ( id ) 
                    NOT NULL,
    genreId INTEGER REFERENCES Genres ( id ) 
                    NOT NULL,
    weight  INTEGER NOT NULL,
    PRIMARY KEY ( albumId, genreId ) 
);




-- Table: Styles
CREATE TABLE Styles ( 
    id   INTEGER PRIMARY KEY,
    name TEXT    NOT NULL 
);




-- Table: ArtistStyles
CREATE TABLE ArtistStyles ( 
    artistId INTEGER REFERENCES Artists ( id ) 
                     NOT NULL,
    styleId  INTEGER REFERENCES Styles ( id ) 
                     NOT NULL,
    weight   INTEGER NOT NULL 
);




-- Table: Jobs
CREATE TABLE Jobs ( 
    jobId INTEGER PRIMARY KEY AUTOINCREMENT,
    job   TEXT 
);




-- Table: Credits
CREATE TABLE Credits ( 
    albumId  INTEGER NOT NULL
                     REFERENCES Albums ( id ),
    artistId INTEGER NOT NULL
                     REFERENCES Artists ( id ),
    jobId    INTEGER NOT NULL
                     REFERENCES Jobs ( jobId ),
    PRIMARY KEY ( albumId, artistId, jobId ) 
);




-- Table: JobCategories
CREATE TABLE JobCategories ( 
    jobCategoriesId INTEGER        PRIMARY KEY AUTOINCREMENT,
    jobCategory     VARCHAR( 50 ) 
);




-- Table: LinksJobCategory
CREATE TABLE LinksJobCategory ( 
    jobId         INTEGER REFERENCES Jobs ( jobId ),
    jobcategoryId INTEGER REFERENCES JobCategories ( jobCategoriesId ),
    PRIMARY KEY ( jobId, jobcategoryId ) 
);




-- View: Creditsalbum
CREATE VIEW Creditsalbum AS
       SELECT al.id,
              al.title,
              ar.name,
              j.job,
              j.jobId,
              ar.id artistId
         FROM albums al, 
              artists ar, 
              credits cr, 
              jobs j, 
              linksjobcategory ljo, 
              Jobcategories jc
        WHERE ar.id = cr.artistId 
              AND
              al.id = cr.albumId 
              AND
              cr.jobId = j.jobid 
              AND
              ljo.jobId = cr.jobId 
              AND
              ljo.jobcategoryId = jc.jobCategoriesId
        ORDER BY al.title,
                  cr.jobId;



