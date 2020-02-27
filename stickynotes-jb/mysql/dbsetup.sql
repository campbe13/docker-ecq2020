/*  user for use in app */
/*
DROP USER 'student2'@'localhost';
*/
CREATE USER 'student2'@'localhost' IDENTIFIED BY 'secret';

DROP DATABASE IF EXISTS assignment22;
CREATE DATABASE IF NOT EXISTS assignment22;

USE assignment22;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS sticky_notes;
    
CREATE TABLE users (username varchar(50) PRIMARY KEY NOT NULL, 
	password varchar(255) NOT NULL, badLoginAttempts int DEFAULT 0, 
	lastLoginTimestamp timestamp);

CREATE TABLE sticky_notes (id SERIAL PRIMARY KEY, username varchar(50),
	FOREIGN KEY(username) REFERENCES users(username),
	note VARCHAR(500) NOT NULL, zIndex int DEFAULT 0, 
	topLocation int DEFAULT 0, leftLocation int DEFAULT 0);

/*  user for use in app */
GRANT ALL PRIVILEGES ON assignment22.* TO 'student2'@'localhost';
    
/*
 Remove when in production 
 add demo user
*/
/*
INSERT INTO users("demo", "test123");
*/
/*
 Remove when in production 
 seed data for  demo user
*/
/*
INSERT INTO sticky_notes(username, note, zIndex, topLocation,  leftLocation) VALUES ('demo', 'Hi there', 1, 400, 500);
INSERT INTO sticky_notes(username, note, zIndex, topLocation,  leftLocation) VALUES ('demo', 'Welcome to the demo account!', 2, 200, 800);
*/
