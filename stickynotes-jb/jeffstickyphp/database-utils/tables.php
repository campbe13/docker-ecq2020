<?php 

/**
 * Used to load/reset tables for project. 
 */

//Load database credentials
$config = parse_ini_file("config.ini");

try { 
    
    //Set pdo object
    $pdo=new PDO("mysql:dbname=".$config['database_name'].";host=".$config['server_name'], $config['user'] , $config['password']); 
    
    //Ensures that exceptions are thrown
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 

    //Drop tables if they exist
    $dropUsersTable = 'DROP TABLE IF EXISTS users';
    $dropStickyNotesTable = 'DROP TABLE IF EXISTS sticky_notes';
    
    //Queries to create tables
    $createUsersTable = 'CREATE TABLE users (username varchar(50) PRIMARY KEY NOT NULL, password varchar(255) NOT NULL, badLoginAttempts int DEFAULT 0, lastLoginTimestamp timestamp)';
    $createStickyNotesTable = 'CREATE TABLE sticky_notes (id SERIAL PRIMARY KEY, username varchar(50), FOREIGN KEY(username) REFERENCES users(username), note VARCHAR(500) NOT NULL, zIndex int DEFAULT 0, topLocation int DEFAULT 0, leftLocation int DEFAULT 0)';
    
    //The following is the username and password for a demo account. 
    //It has 2 stickies with the contents "Test" and "Test 2" (Test 2 should be above test 1)
    //Remove when in production 
    $createDemoUserQuery = "INSERT INTO users(username, password) VALUES (?, ?)";
    $statement = $pdo->prepare($createDemoUserQuery);
    $statement->bindValue(1, 'demo');
    $hash = password_hash("test123", PASSWORD_DEFAULT);
    $statement->bindValue(2, $hash);

    //Test sticky notes.
    $createStickyQueryOne = "INSERT INTO sticky_notes(username, note, zIndex, topLocation,  leftLocation) VALUES ('demo', 'Hi there', 1, 400, 500)";
    $createStickyQueryTwo = "INSERT INTO sticky_notes(username, note, zIndex, topLocation,  leftLocation) VALUES ('demo', 'Welcome to the demo account!', 2, 200, 800)";
    
    // Execute queries.
    
    //Drop tables if exist
    $pdo->exec($dropStickyNotesTable);
    $pdo->exec($dropUsersTable); 
    
    //Create tables
    $pdo->exec($createUsersTable);
    $pdo->exec($createStickyNotesTable);
    
    //Insert test data
    $statement->execute(); 
    $pdo->exec($createStickyQueryOne);
    $pdo->exec($createStickyQueryTwo);
    

} catch (PDOException $e) {
    
    echo $e->getMessage();
	exit;
	
} finally {
    
     unset($pdo);
     
}  

?>