USE votingsite;

DROP TABLE IF EXISTS SiteUser;
DROP TABLE IF EXISTS RegistrationKey;

CREATE TABLE SiteUser (
	
	id INT NOT NULL AUTO_INCREMENT,
	username VARCHAR(32) NOT NULL,
	password VARCHAR(255) NOT NULL,
	
	PRIMARY KEY (id),
	
	INDEX (username)
	
);

CREATE TABLE RegistrationKey (
	
	regKey VARCHAR(255) NOT NULL,
	used BOOLEAN DEFAULT FALSE,
	
	PRIMARY KEY (regkey)
	
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
    ('abcd9')
;