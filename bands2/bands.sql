CREATE DATABASE IF NOT EXISTS bandSite;
GRANT ALL PRIVILEGES ON bandSite.* to 'banduser'@'localhost' identified by 'band';
USE bandSite;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
	user_id INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(user_id),
	username VARCHAR(30) NOT NULL,
	password VARCHAR(50) NOT NULL,
	location VARCHAR(30)
);

DROP TABLE IF EXISTS band;
CREATE TABLE band (
	band_id INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(band_id),
	band_name VARCHAR(25) NOT NULL,
	hometown VARCHAR(30) NOT NULL,
	genre VARCHAR(50) NOT NULL,
	description BLOB NOT NULL,
	picture_file VARCHAR(75),
	albums VARCHAR(100)
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
	band_name VARCHAR(25) NOT NULL,
	date DATE NOT NULL,
	time TIME NOT NULL,
	venue_id INT NOT NULL,
	CONSTRAINT venue_venue_id_fk
	FOREIGN KEY(venue_id)
	REFERENCES venue (venue_id)
);

INSERT INTO users VALUES
	(1, "guest", "", NULL);

INSERT INTO band 
	(band_name, hometown, genre, description, picture_file, albums)
	VALUES
	("Segmentation Fault", "Peoria, IL", "classic rock", "Revitalizes old songs!", NULL, "P vs NP"),
	("Artificial Intelligence", "Raleigh, NC", "rock", "Large group. Loud music.", NULL, "Automaton"),
	("Dual Core", "Martinsburg, PA", "jazz", "Smooth instrumental jazz.", NULL, "Multithreaded"),
	("Null Pointer Exception", "Manchester, IN", "classical", "Classy!", NULL, "Array Index Out of Bounds"),
	("Ordenamiento De Burbuja", "Barcelona, Spain", "pop", "El mejor del música pop espanol!", NULL, NULL);

INSERT INTO venue
	(venue, location, description, picture_file)
	VALUES
	("The Gauntlet", "Fredericksburg, VA", "The most popular club in Fredericksburg!", NULL),
	("La Burbuja", "Barcelona, Spain", "¡El club más popular de Barcelona!", NULL);