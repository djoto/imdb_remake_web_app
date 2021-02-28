<?php
    $servername = "localhost";
    $username = "root";
    $password = "password";
    $dBase = "imdbMyDatabase";

    // Create connection
    $conn = new mysqli($servername, $username, $password);
 

    $db = "CREATE DATABASE IF NOT EXISTS imdbMyDatabase";

    if ($conn->query($db) === TRUE) {
        //echo "Database created successfully";
    } 
    else {
        //echo "Error creating database: " . $conn->error;
    }

    $conn->close();
    $connec = new mysqli($servername, $username, $password, $dBase);



    $tableAllUsers = "CREATE TABLE IF NOT EXISTS imdbAllUsers (
        id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(50) NOT NULL,
        lastname VARCHAR(50) NOT NULL,
        email VARCHAR(50) NOT NULL,
        username VARCHAR(50) NOT NULL,
        passwd VARCHAR(100) NOT NULL,
        accountType VARCHAR(20) NOT NULL,
        statusLogInOut VARCHAR(10) NOT NULL
    )";

    if ($connec->query($tableAllUsers) === TRUE) {
        //echo "Table imdbAllUsers created successfully";
    } 
    else {
        //echo "Error creating table: " . $connec->error;
    }
    

    $tableMovies = "CREATE TABLE IF NOT EXISTS imdbMovies (
        idM INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        titleM VARCHAR(150) NOT NULL,
        aboutM VARCHAR(6000) NOT NULL,
        genreM VARCHAR(150) NOT NULL,
        screenplayM VARCHAR(250) NOT NULL,
        directorsM VARCHAR(250) NOT NULL,
        productionM VARCHAR(250) NOT NULL,
        starringM VARCHAR(250) NOT NULL,
        releaseM VARCHAR(20) NOT NULL,
        pictureM VARCHAR(250) NOT NULL,
        durationM INT(5) NOT NULL,
        gradeM VARCHAR(100) NOT NULL,
        numGradesM INT(10) NOT NULL
    )";
    if ($connec->query($tableMovies) === TRUE) {
        //echo "Table imdbMovies created successfully";
    } 
    else {
        //echo "Error creating table: " . $connec->error;
    }

    //TABLE WITH PAIRS: idUser(which vote) idMovie(that current user rate)
    $tableVotes = "CREATE TABLE IF NOT EXISTS votesTable (
        idV INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        idUserV INT(10) NOT NULL,
        idMovieV INT(10) NOT NULL
    )";
    if ($connec->query($tableVotes) === TRUE) {
        //echo "Table votesTable created successfully";
    } 
    else {
        //echo "Error creating table: " . $connec->error;
    }

    // MANUALY DELETE USER FROM DATABASE:
    // $sqlDel = "DELETE FROM imdbAllUsers WHERE id=5";
    // if ($connec->query($sqlDel) === TRUE) {
    //   //echo "Record deleted successfully";
    // } else {
    //   //echo "Error deleting record: " . $connec->error;
    // }

    //ADD ADMINISTRATOR IN DATABASE IF NOT EXISTS SOMEONE WITH SAME EMAIL OR USERNAME (only way to add admin!):
    //THIS WILL ADD ONE ADMIN ON FIRST LOAD
    $stmta = $connec->prepare("INSERT INTO imdbAllUsers (firstname, lastname, email, username, passwd, accountType, statusLogInOut) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmta->bind_param("sssssss", $signUpNameAdmin, $signUpSurnameAdmin, $signUpEmailAdmin, $signUpUsernameAdmin, $signUpPasswordAdmin, $usertypeAdmin, $signUpStatus);
    $signUpNameAdmin = "Đorđe";
    $signUpSurnameAdmin = "Gačić";
    $signUpEmailAdmin = "djordjegacic99tb@gmail.com";
    $signUpUsernameAdmin = "djoto";
    $signUpPasswordAdmin = "popokatepetl";
    $usertypeAdmin = "admin";
    $signUpStatus = "out";


    $selectedFromTableUsers = "SELECT email, username FROM imdbAllUsers";
    $resultSelectionUsers = $connec->query($selectedFromTableUsers);
    $counterAdmin = 0;
    while($rowA = $resultSelectionUsers->fetch_assoc()) {
        if ($rowA["email"] == $signUpEmailAdmin || $rowA["username"] == $signUpUsernameAdmin){
            $counterAdmin++;
        }
    }
    if($counterAdmin==0){
        $stmta->execute();
    }
    else{
        $counterAdmin = 0;
    }

    $stmta->close();

    $connec->close();
?>