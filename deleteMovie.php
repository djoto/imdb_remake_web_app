<?php
    session_start();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dBase = "imdbMyDatabase";
        $connectForDelete = new mysqli($servername, $username, $password, $dBase);

        $currentIdForDelete =  $_SESSION['idM'];

        $selectedForDelete = "DELETE FROM imdbMovies WHERE idM=$currentIdForDelete";

        if ($connectForDelete->query($selectedForDelete) === TRUE) {
        //echo "Record deleted successfully";
        } else {
        //echo "Error deleting record: " . $connectForDelete->error;
        }
        $connectForDelete->close();
    }


    header("Location:pageAdmin.php");
?>