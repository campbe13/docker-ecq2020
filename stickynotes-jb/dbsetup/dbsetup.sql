/*  user for use in app */
 created via yaml for container
CREATE USER 'student2'@'localhost' IDENTIFIED BY 'secret';
*/

/* database for use in app
 created via yaml for container
DROP DATABASE IF EXISTS assignment2;
CREATE DATABASE IF NOT EXISTS assignment2;
*/
/* 
needed due to problem with
"php mysqli extension do not support new caching_sha2 authentication feature "
available in mysql 8+" 
I tried downgrading to 5.7.22, then 5.7.29 but mysqld crashed on startup
https://stackoverflow.com/questions/50026939/php-mysqli-connect-authentication-method-unknown-to-the-client-caching-sha2-pa

user for use in app 
student created by container instantiation, see docker-compose.yaml
*/

alter user 'student'@'%' IDENTIFIED WITH mysql_native_password BY 'secret';

USE assignment2;
DROP TABLE IF EXISTS users;

DROP TABLE IF EXISTS sticky_notes;

CREATE TABLE users (username varchar(50) PRIMARY KEY NOT NULL, password varchar(255) NOT NULL, badLoginAttempts int DEFAULT 0, lastLoginTimestamp timestamp);

CREATE TABLE sticky_notes (id SERIAL PRIMARY KEY, username varchar(50),
	FOREIGN KEY(username) REFERENCES users(username),
	note VARCHAR(500) NOT NULL, zIndex int DEFAULT 0, 
	topLocation int DEFAULT 0, leftLocation int DEFAULT 0);

/*
 doesn't work due to encryption of passwd, done via php 

 Remove when in production 
 add demo user

 Remove when in production 
 seed data for  demo user

INSERT INTO sticky_notes(username, note, zIndex, topLocation,  leftLocation) VALUES ('demo', 'Hi there', 1, 400, 500);
INSERT INTO sticky_notes(username, note, zIndex, topLocation,  leftLocation) VALUES ('demo', 'Welcome to the demo account!', 2, 200, 800);
INSERT INTO sticky_notes(username, note, zIndex, topLocation,  leftLocation) VALUES ('demo', 'blargh f', 1, 400,	 500);

*/
