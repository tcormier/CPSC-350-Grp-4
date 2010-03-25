CREATE DATABASE IF NOT EXISTS bandSite;
GRANT ALL PRIVILEGES ON bandSite.* to 'banduser'@'localhost' identified by 'band';
USE bandSite;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
	user_id INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(user_id),
	username VARCHAR(30) NOT NULL,
	password VARCHAR(40) NOT NULL,
	location VARCHAR(30)
);

DROP TABLE IF EXISTS genre;
CREATE TABLE genre (
	genre_id INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(genre_id),
	genre_name VARCHAR(20) NOT NULL
);

DROP TABLE IF EXISTS band;
CREATE TABLE band (
	band_id INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(band_id),
	band_name VARCHAR(25) NOT NULL,
	hometown VARCHAR(30) NOT NULL,
	genre1 INT,
	genre2 INT,
	genre3 INT,
	CONSTRAINT genre_genre1_fk
	FOREIGN KEY(genre1)
	REFERENCES genre(genre_id),
	CONSTRAINT genre_genre2_fk
	FOREIGN KEY(genre2)
	REFERENCES genre(genre_id),
	CONSTRAINT genre_genre3_fk
	FOREIGN KEY(genre3)
	REFERENCES genre(genre_id),
	description BLOB NOT NULL,
	picture_file VARCHAR(75),
	album1 VARCHAR(50),
	album2 VARCHAR(50),
	album3 VARCHAR(50),
	album4 VARCHAR(50),
	album5 VARCHAR(50)
);

DROP TABLE IF EXISTS venue;
CREATE TABLE venue (
	venue_id INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(venue_id),
	venue VARCHAR(30) NOT NULL,
	location VARCHAR(30) NOT NULL,
	description BLOB NOT NULL,
	picture_file VARCHAR(75)
);

DROP TABLE IF EXISTS upcoming_shows;
CREATE TABLE upcoming_shows (
	band_id INT NOT NULL,
	CONSTRAINT band_band_id_fk
	FOREIGN KEY(band_id)
	REFERENCES band (band_id),
	date VARCHAR(20) NOT NULL,
	time VARCHAR(20) NOT NULL,
	venue_id INT NOT NULL,
	CONSTRAINT venue_venue_id_fk
	FOREIGN KEY(venue_id)
	REFERENCES venue (venue_id)
);

INSERT INTO users (username, password) VALUES
	("guest", SHA(""));

INSERT INTO band 
	(band_name, hometown, genre1, genre2, genre3, description, picture_file, album1)
	VALUES
	("Segmentation Fault", "Peoria, IL", 1,3,4, "Revitalizes old songs!", NULL, "P vs NP"),
	("Artificial Intelligence", "Raleigh, NC", 2,3,4, "Large group. Loud music.", NULL, "Automaton"),
	("Dual Core", "Martinsburg, PA", "jazz", 3,2,4, NULL, "Multithreaded"),
	("Null Pointer Exception", "Manchester, IN",4,3,5, "Classy!", NULL, "Array Index Out of Bounds"),
	("Dave Matthews Band", "Charlottsville, VA", 5,3,4, "Under the table and dreaming", NULL, "Crush"),
	("Mambo 5", "Detroit, MI", 3,4,2, "1, 2, 3, 4, 5", NULL, NULL),
	("Airplane", "San Francisco, CA", 2,1,4, "Always good music in the hood.", NULL, "Helicopter");

INSERT INTO venue
	(venue, location, description, picture_file)
	VALUES
	("The Gauntlet", "Fredericksburg, VA", "The most popular club in Fredericksburg!", NULL),
	("La Burbuja", "Barcelona, Spain", "¡El club más popular de Barcelona!", NULL),
	("Outer Space", "Richmond, VA", "Directly above the atmosphere in Richmond.", NULL),
	("The Box", "Detroit, MI", "Small like a cardboard box.", NULL),
	("Arctic", "Moscow, Russia", "It's pretty cold.", NULL),
	("Boost Mobile", "Houston, TX", "Yo man where you at?", NULL),
	("The Cage", "Miami, FL", "It's hot in the CAGE.", NULL),
	("Cheese Head", "Green Bay, WI", "Brett hates us now.", NULL),
	("The Hulk", "Disney, FL", "Great times had by all!", NULL);

INSERT INTO genre
	(genre_name)
	VALUES
	("Rock"),("Electric"),("Country"),("Rap"),("Classical");

INSERT INTO upcoming_shows
	(date, time)
	VALUES
	("7/12/2010","8:00p.m."),
	("8/13/2010","8:00p.m."),
	("8/15/2010","8:30p.m."),
	("6/14/2010","8:00p.m."),
	("8/04/2010","8:00p.m."),
	("7/07/2010","8:00p.m."),
	("8/20/2010","8:00p.m."),
	("2/04/2011","8:00p.m."),
	("2/07/2011","8:15p.m."),
	("8/26/2010","8:00p.m."),
	("9/04/2010","8:10p.m.");