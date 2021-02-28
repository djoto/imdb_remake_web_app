<?php
    session_start();
    $idForEdit = $_SESSION['idM'];
    $titleForEdit = $_SESSION['titleM'];
    $aboutForEdit = $_SESSION['aboutM'];
    $genreForEdit = $_SESSION['genreM'];
    $screenplayForEdit = $_SESSION['screenplayM'];
    $directorsForEdit = $_SESSION['directorsM'];
    $productionForEdit = $_SESSION['productionM'];
    $starringForEdit = $_SESSION['starringM'];
    $releaseForEdit = $_SESSION['releaseM'];
    $pictureForEdit = $_SESSION['pictureM'];
    $durationForEdit = $_SESSION['durationM'];
    $gradeNOTForEdit = $_SESSION['gradeM'];
    $numGradesNOTForEdit = $_SESSION['numGradesM'];

    $titleForEditErr = $genreForEditErr = $screenplayForEditErr = $directorForEditErr = $productionForEditErr = $starringForEditErr = $releaseForEditErr = $pictureForEditErr = $durationForEditErr = $descriptionForEditErr = "";

    $servername = "localhost";
    $username = "root";
    $password = "password";
    $dBase = "imdbMyDatabase";

    $connectToEdit = new mysqli($servername, $username, $password, $dBase);
    
    $counterCheckForEdit = 0;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["titleForEdit"])) {
            $titleForEditErr = "* Required field";
        } else {
            $titleForEdit = test_input($_POST["titleForEdit"]);
            $counterCheckForEdit++;
        }

        if (empty($_POST["genreForEdit"])) {
            $genreForEditErr = "* Required field";
        } else {
            $genreForEdit = test_input($_POST["genreForEdit"]);
            $counterCheckForEdit++;
        }

        if (empty($_POST["screenplayForEdit"])) {
            $screenplayForEditErr = "* Required field";
        } else {
            $screenplayForEdit = test_input($_POST["screenplayForEdit"]);
            $counterCheckForEdit++;
        }

        if (empty($_POST["directorsForEdit"])) {
            $directorForEditErr = "* Required field";
        } else {
            $directorsForEdit = test_input($_POST["directorsForEdit"]);
            $counterCheckForEdit++;
        }

        if (empty($_POST["productionForEdit"])) {
            $productionForEditErr = "* Required field";
        } else {
            $productionForEdit = test_input($_POST["productionForEdit"]);
            $counterCheckForEdit++;
        }

        if (empty($_POST["starringForEdit"])) {
            $starringForEditErr = "* Required field";
        } else {
            $starringForEdit = test_input($_POST["starringForEdit"]);
            $counterCheckForEdit++;
        }

        if (empty($_POST["releaseForEdit"])) {
            $releaseForEditErr = "* Required field";
        } else {
            $releaseForEdit = test_input($_POST["releaseForEdit"]);
            $counterCheckForEdit++;
        }

        if (empty($_POST["pictureForEdit"])) {
            $pictureForEditErr = "* Required field";
        } else {
            $pictureForEdit = test_input($_POST["pictureForEdit"]);
            $counterCheckForEdit++;
        }

        if (empty($_POST["durationForEdit"])) {
            $durationForEditErr = "* Required field";
        } else {
            $durationForEdit = test_input($_POST["durationForEdit"]);
            $counterCheckForEdit++;
        }

        if (empty($_POST["aboutForEdit"])) {
            $descriptionForEditErr = "* Required field";
        } else {
            $aboutForEdit = test_input($_POST["aboutForEdit"]);
            $counterCheckForEdit++;
        }
    }

    if ($counterCheckForEdit == 10){
        $statusUpdateForEdit = "UPDATE imdbMovies SET titleM='$titleForEdit', aboutM='$aboutForEdit', genreM='$genreForEdit', screenplayM='$screenplayForEdit', directorsM='$directorsForEdit', productionM='$productionForEdit', starringM='$starringForEdit', releaseM='$releaseForEdit', pictureM='$pictureForEdit', durationM='$durationForEdit', genreM='$genreForEdit' WHERE idM=$idForEdit";
        if ($connectToEdit->query($statusUpdateForEdit) === TRUE) {
           // echo "Success";
        } else {
           // echo "Error";
        }

        $counterCheckForEdit = 0;
        header("Location:pageAdmin.php");

    }
    else {
        $counterCheckForEdit = 0;
    }
    

    $connectToEdit->close();

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>