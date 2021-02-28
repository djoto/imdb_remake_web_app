<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dBase = "imdbMyDatabase";
        $connectForUpdate = new mysqli($servername, $username, $password, $dBase);

        $currentIdForLogOut =  $_SESSION['id'];

        $statusUpdateOnLogOut = "UPDATE imdbAllUsers SET statusLogInOut='out' WHERE id=$currentIdForLogOut";
        if ($connectForUpdate->query($statusUpdateOnLogOut) === TRUE) {
            //something...
        } else {
            //something else... 
        }

        $selectAfterOut = "SELECT id, statusLogInOut FROM imdbAllUsers WHERE id=$currentIdForLogOut";
        $selectedAftOut = $connectForUpdate->query($selectAfterOut);
        if ($selectedAftOut->num_rows > 0) {
            while($rowOut = $selectedAftOut->fetch_assoc()) {
                if($rowOut["id"] == $currentIdForLogOut){
                    $_SESSION['statusLogInOut'] = $rowOut["statusLogInOut"];
                }
            }
        }

        $connectForUpdate->close();

        header("Location:imdb_log_in.php");
    }
?>