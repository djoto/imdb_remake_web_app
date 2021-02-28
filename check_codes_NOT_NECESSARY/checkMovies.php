<!DOCTYPE html>
<html>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "imdbMyDatabase";

// Create connection
$connectM = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($connectM->connect_error) {
    die("Connection failed: " . $connectM->connect_error);
}

$sqlM = "SELECT idM, titleM, aboutM, genreM, screenplayM, directorsM, productionM, starringM, releaseM, pictureM, durationM, gradeM, numGradesM FROM imdbMovies";
$resultM = $connectM->query($sqlM);

if ($resultM->num_rows > 0) {
    // output data of each row
    while($rowM = $resultM->fetch_assoc()) {
        echo "<br> id: ". $rowM["idM"]. " - Title: ". $rowM["titleM"]. " - Description: ". $rowM["aboutM"]." - Genre(s): ". $rowM["genreM"]." - Screenplay: ". $rowM["screenplayM"]. " - Directed by: ". $rowM["directorsM"]." - Production: ". $rowM["productionM"]. " - Starring: ". $rowM["starringM"]. " - Release Year: ". $rowM["releaseM"]. " - Picture path: ". $rowM["pictureM"]. " - Duration: ". $rowM["durationM"]. " - Grade: ". $rowM["gradeM"]. " - Number of grades: ". $rowM["numGradesM"]. "<br>";
    }
} else {
    echo "0 results";
}

$connectM->close();
?>

</body>
</html>
