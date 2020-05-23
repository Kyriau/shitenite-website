USE votingsite;

DROP TABLE IF EXISTS Vote;
DROP TABLE IF EXISTS VoteOption;
DROP TABLE IF EXISTS VoteRound;
DROP TABLE IF EXISTS Attendee;
DROP TABLE IF EXISTS MovieNight;
DROP TABLE IF EXISTS MovieNomination;
DROP TABLE IF EXISTS Movie;
DROP TABLE IF EXISTS RegistrationKey;
DROP TABLE IF EXISTS SiteUser;

CREATE TABLE SiteUser (
	
	id INT NOT NULL AUTO_INCREMENT,
	username VARCHAR(32) NOT NULL,
	password VARCHAR(255) NOT NULL,
	isPresenter BOOLEAN NOT NULL DEFAULT FALSE,
	
	PRIMARY KEY (id)
	
);

CREATE TABLE RegistrationKey (
	
	regKey VARCHAR(255) NOT NULL,
	used BOOLEAN NOT NULL DEFAULT FALSE,
	
	PRIMARY KEY (regkey)
	
);

CREATE TABLE Movie (
	
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	imgSrc VARCHAR(255) NOT NULL,
	description VARCHAR(255) NOT NULL,
	
	PRIMARY KEY (id)
	
);

CREATE TABLE MovieNomination (
	
	movieID INT NOT NULL,
	nominatorID INT NOT NULL,
	
	PRIMARY KEY (movieID),
	
	FOREIGN KEY (nominatorID) REFERENCES SiteUser(id)
	
);

CREATE TABLE MovieNight (
	
	id INT NOT NULL AUTO_INCREMENT,
	night DATE NOT NULL,
	winnerID INT,
	
	PRIMARY KEY (id),
	
	FOREIGN KEY (winnerID) REFERENCES Movie(id)
	
);

CREATE TABLE Attendee (
	
	siteUserID INT NOT NULL,
	movieNightID INT NOT NULL,
	
	PRIMARY KEY (siteUserID, movieNightID),
	
	FOREIGN KEY (siteUserID) REFERENCES SiteUser(id),
	FOREIGN KEY (movieNightID) REFERENCES MovieNight(id)
	
);

CREATE TABLE VoteRound (
	
	id INT NOT NULL AUTO_INCREMENT,
	movieNightID INT NOT NULL,
	
	PRIMARY KEY (id),
	
	FOREIGN KEY (movieNightID) REFERENCES MovieNight(id)
	
);

CREATE TABLE VoteOption (
	
	id INT NOT NULL,
	movieID INT NOT NULL,
	voteRoundID INT NOT NULL,
	movieNightID INT NOT NULL,
	
	PRIMARY KEY (id),
	
	FOREIGN KEY (movieID) REFERENCES Movie(id),
	FOREIGN KEY (voteRoundID) REFERENCES VoteRound(id),
	FOREIGN KEY (movieNightID) REFERENCES MovieNight(id)
	
);

CREATE TABLE Vote (

	siteUserID INT NOT NULL,
	voteOptionID INT NOT NULL,
	voteRoundID INT NOT NULL,
	movieNightID INT NOT NULL,
	
	PRIMARY KEY (siteUserID, voteOptionID),
	
	FOREIGN KEY (siteUserID) REFERENCES SiteUser(id),
	FOREIGN KEY (voteOptionID) REFERENCES VoteOption(id),
	FOREIGN KEY (voteRoundID) REFERENCES VoteRound(id),
	FOREIGN KEY (movieNightID) REFERENCES MovieNight(id)

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