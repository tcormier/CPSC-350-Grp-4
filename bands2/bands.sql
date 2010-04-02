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

DROP TABLE IF EXISTS band_albums;
CREATE TABLE band_albums (
band_id INT NOT NULL,
CONSTRAINT band_band_id_fk
FOREIGN KEY(band_id)
REFERENCES band (band_id),
album_name VARCHAR(50)
);

DROP TABLE IF EXISTS band_genres;
CREATE TABLE band_genres (
band_id INT NOT NULL,
CONSTRAINT band_band_id_fk
FOREIGN KEY(band_id)
REFERENCES band (band_id),
genre_id INT NOT NULL,
CONSTRAINT genre_genre_id_fk
FOREIGN KEY(genre_id)
REFERENCES genre (genre_id)
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
description BLOB NOT NULL,
picture_file VARCHAR(75)
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
	event_id INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(event_id),
	event_name VARCHAR(20) NOT NULL,
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
	("Dual Core", "Martinsburg, PA", 3,2,4, "They are not hyperThreaded yet", NULL, "Multithreaded"),
	("Null Pointer Exception", "Manchester, IN",4,3,5, "Classy!", NULL, "Array Index Out of Bounds"),
	("Dave Matthews Band", "Charlottsville, VA", 5,3,4, "Under the table and dreaming", NULL, "Crush"),
	("Mambo 5", "Detroit, MI", 3,4,2, "ah 1, ah 2, ah 3, ah 4, 5", NULL, NULL),
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
	(band_id, event_name, date, time, venue_id)
	VALUES
	(1,"Woodstock", "2010-08-12","5:00",6),
	(2,"Woodstock", "2010-08-12","6:00",6),
	(3,"Woodstock", "2010-08-12","7:00",6),
	(4,"Woodstock", "2010-08-12","8:00",6),
	(5,"Woodstock", "2010-08-12","9:00",6),
	(6,"Woodstock", "2010-08-12","10:00",6),
	(7,"Woodstock", "2010-08-12","11:00",6),
	(8,"Woodstock", "2010-08-12","12:00",6),
	(9,"Woodstock", "2010-08-12","1:00",6);
	
	