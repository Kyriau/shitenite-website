USE votingsite;

DROP TABLE IF EXISTS MovieNight;
DROP TABLE IF EXISTS Vote;
DROP TABLE IF EXISTS VoteRound;
DROP TABLE IF EXISTS Movie;
DROP TABLE IF EXISTS RegistrationKey;
DROP TABLE IF EXISTS SiteUser;

CREATE TABLE SiteUser (
	
	id INT NOT NULL AUTO_INCREMENT,
	username VARCHAR(32) NOT NULL,
	password VARCHAR(255) NOT NULL,
	
	PRIMARY KEY (id)
	
);

CREATE TABLE RegistrationKey (
	
	regKey VARCHAR(255) NOT NULL,
	used BOOLEAN DEFAULT FALSE,
	
	PRIMARY KEY (regkey)
	
);

CREATE TABLE Movie (
	
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	imgSrc VARCHAR(255) NOT NULL,
	nominator INT NOT NULL,
	
	PRIMARY KEY (id),
	
	FOREIGN KEY (nominator) REFERENCES SiteUser
	
);

CREATE TABLE VoteRound (
	
	id INT NOT NULL AUTO_INCREMENT,
	movieNightID INT NOT NULL,
	
	PRIMARY KEY (id),
	
	FOREIGN KEY (movieNightID) REFERENCES MovieNight
	
);

CREATE TABLE VoteOption (
	
	id INT NOT NULL,
	movieID INT NOT NULL,
	
	PRIMARY KEY (id),
	
	FOREIGN KEY (movieID) REFERENCES Movie
	
)

CREATE TABLE Vote (

	siteUserID INT NOT NULL
	voteOptionID INT NOT NULL,
	voteRoundID INT NOT NULL,
	
	PRIMARY KEY (siteUserID, movieID, voteRoundID),
	
	FOREIGN KEY (siteUserID) REFERENCES SiteUser,
	FOREIGN KEY (movieID) REFERENCES Movie,
	FOREIGN KEY (voteRoundID) REFERENCES VoteRound

);

CREATE TABLE MovieNight (
	
	id INT NOT NULL AUTO_INCREMENT,
	night DATE NOT NULL,
	
	PRIMARY KEY (id)
	
);

INSERT INTO RegistrationKey(regKey) VALUES
	('abcd0'),
    ('abcd1'),
    ('abcd2'),
    ('abcd3'),
    ('abcd4'),
    ('abcd5'),
    ('abcd6'),
    ('abcd7'),
    ('abcd8'),
    ('abcd9'),
	('asdf0'),
	('asdf1'),
	('asdf2'),
	('asdf3'),
	('asdf4'),
	('asdf5'),
	('asdf6'),
	('asdf7'),
	('asdf8'),
	('asdf9')
;