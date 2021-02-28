<?php
    $titleErr = $genreErr = $screenplayErr = $directorErr = $productionErr = $starringErr = $releaseErr = $pictureErr = $durationErr = $descriptionErr = "";
    $addTitle = $addGenre = $addScreenplay = $addDirector = $addProduction = $addStarring = $addRelease = $addPicture = $addDuration = $addDescription = "";

    $servername = "localhost";
    $username = "root";
    $password = "password";
    $dBase = "imdbMyDatabase";

    $connectToAdd = new mysqli($servername, $username, $password, $dBase);

    $stmtA = $connectToAdd->prepare("INSERT INTO imdbMovies (titleM, aboutM, genreM, screenplayM, directorsM, productionM, starringM, releaseM, pictureM, durationM, gradeM, numGradesM) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmtA->bind_param("ssssssssssss", $addTitle, $addDescription, $addGenre , $addScreenplay, $addDirector, $addProduction, $addStarring, $addRelease, $addPicture, $addDuration, $gradeA, $numGradesA);
    
    $gradeA = 0;
    $numGradesA = 0;
    
    $counterCheckToAdd = 0;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["addTitle"])) {
            $titleErr = "* Required field";
        } else {
            $addTitle = test_input($_POST["addTitle"]);
            $counterCheckToAdd++;
        }

        if (empty($_POST["addGenre"])) {
            $genreErr = "* Required field";
        } else {
            $addGenre = test_input($_POST["addGenre"]);
            $counterCheckToAdd++;
        }

        if (empty($_POST["addScreenplay"])) {
            $screenplayErr = "* Required field";
        } else {
            $addScreenplay = test_input($_POST["addScreenplay"]);
            $counterCheckToAdd++;
        }

        if (empty($_POST["addDirector"])) {
            $directorErr = "* Required field";
        } else {
            $addDirector = test_input($_POST["addDirector"]);
            $counterCheckToAdd++;
        }

        if (empty($_POST["addProduction"])) {
            $productionErr = "* Required field";
        } else {
            $addProduction = test_input($_POST["addProduction"]);
            $counterCheckToAdd++;
        }

        if (empty($_POST["addStarring"])) {
            $starringErr = "* Required field";
        } else {
            $addStarring = test_input($_POST["addStarring"]);
            $counterCheckToAdd++;
        }

        if (empty($_POST["addRelease"])) {
            $releaseErr = "* Required field";
        } else {
            $addRelease = test_input($_POST["addRelease"]);
            $counterCheckToAdd++;
        }

        if (empty($_POST["addPicture"])) {
            $pictureErr = "* Required field";
        } else {
            $addPicture = test_input($_POST["addPicture"]);
            $counterCheckToAdd++;
        }

        if (empty($_POST["addDuration"])) {
            $durationErr = "* Required field";
        } else {
            $addDuration = test_input($_POST["addDuration"]);
            $counterCheckToAdd++;
        }

        if (empty($_POST["addDescription"])) {
            $descriptionErr = "* Required field";
        } else {
            $addDescription = test_input($_POST["addDescription"]);
            $counterCheckToAdd++;
        }
    }

    if ($counterCheckToAdd == 10){
        $stmtA->execute();

        $counterCheckToAdd = 0;
        header("Location:pageAdmin.php");

    }
    else {
        $counterCheckToAdd = 0;
    }
    
    $stmtA->close();

    $connectToAdd->close();

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>