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
album_id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(album_id),
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

DROP TABLE IF EXISTS comments;
CREATE TABLE comments
(
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
band_id INT NOT NULL,
CONSTRAINT band_band_id_fk
FOREIGN KEY(band_id)
REFERENCES band (band_id),
comment_name BLOB NOT NULL
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
	(band_name, hometown, description, picture_file)
	VALUES
	("Segmentation Fault", "Peoria, IL", "Revitalizes old songs!", NULL),
	("Artificial Intelligence", "Raleigh, NC", "Large group. Loud music.", NULL),
	("Dual Core", "Martinsburg, PA", "They are not hyperThreaded yet", NULL),
	("Null Pointer Exception", "Manchester, IN", "Classy!", NULL),
	("Dave Matthews Band", "Charlottsville, VA", "Under the table and dreaming", NULL),
	("Mambo 5", "Detroit, MI", "ah 1, ah 2, ah 3, ah 4, 5", NULL),
	("Airplane", "San Francisco, CA", "Always good music in the hood.", NULL);

INSERT INTO comments
	(band_id, comment_name)
	VALUES
	(1, "This band rocks!"), (1, "I love this band!"), (2,"I hate this band!"), (3,"Great Concerts"), (4,"I love this band"),
	(4, "I can't wait to see them in concert"), (5,"AHHHHHHHHHHH"), (6,"Great Concert"), (7,"It was a great movie");
	
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
	
INSERT INTO band_genres
	(band_id, genre_id)
	VALUES
	(1,5), (2,5), (3,5), (4,5), (5,5), (6,5), (7,5), (1,4), (2,4), (3,4), (4,4), (5,4), (6,4),
	(7,4), (1,3), (2,3), (3,3), (4,3), (5,3), (6,3), (7,3), (1,2), (2,2), (3,2), (4,2),
	(5,2), (6,2), (7,2), (1,1), (2,1), (3,1), (4,1), (5,1), (6,1), (7,1);
	
INSERT INTO band_albums
	(band_id, album_name)
	VALUES
	(1,"The Segments"), (1,"The Segments 2"), (2,"AI"), (3,"Dual Core"), (4,"Exceptions"), (4,"Excepting"), (5, "Crush"),
	(5,"Under the Table and Dreaming"), (6,"Mambo"), (7,"Helicopter");

INSERT INTO upcoming_shows
	(band_id, event_name, date, time, venue_id)
	VALUES
	(1,"Woodstock", "2010-08-12","5:00",6),
	(2,"Woodstock", "2010-08-12","6:00",6),
	(3,"Woodstock", "2010-08-12","7:00",6),
	(4,"Woodstock", "2010-08-12","8:00",6),
	(5,"Woodstock", "2010-08-12","9:00",6),
	(6,"Woodstock", "2010-08-12","10:00",6),
	(7,"Woodstock", "2010-08-12","11:00",6);
	
	
	