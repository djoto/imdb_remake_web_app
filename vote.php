<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dBase = "imdbMyDatabase";
    
        $alreadyVoted = "";
        $_SESSION['alreadyVoted'] = $alreadyVoted;

        $connectForVote = new mysqli($servername, $username, $password, $dBase);

        $idCurrentUser = $_SESSION['id'];
        $idMovieForVote = $_SESSION['idM'];
        
        $yourMovieGrade = $_POST["yourGrade"];

        $selectFromVotesTable = "SELECT idV, idUserV, idMovieV FROM votesTable";
        $resultFromVotesTable = $connectForVote->query($selectFromVotesTable);

        $counterForVotes = 0;

        if ($resultFromVotesTable->num_rows > 0) {
            while($rowFromVotesTable = $resultFromVotesTable->fetch_assoc()) {
                if ($rowFromVotesTable["idUserV"] == $idCurrentUser && $rowFromVotesTable["idMovieV"] == $idMovieForVote){
                    $counterForVotes++;
                }
            }
        } else {
            $counterForVotes = 0;
        }

        if ($counterForVotes == 0){

            $selectFromMoviesForVote = "SELECT gradeM, numGradesM FROM imdbMovies WHERE idM=$idMovieForVote";
            $selectedWithMovieIdForVote = $connectForVote->query($selectFromMoviesForVote);
            while($rowSelectedForVote = $selectedWithMovieIdForVote->fetch_assoc()) {
                $selectedSumForVote = $rowSelectedForVote["gradeM"];
                $selectedNumGradesForVote = $rowSelectedForVote["numGradesM"];
            }
            $numOfGradesAfterVote = (int)$selectedNumGradesForVote + 1;
            $selectedSumOfVotesAfter = $selectedSumForVote + $yourMovieGrade;
        
            $statusUpdateGradeForVote = "UPDATE imdbMovies SET gradeM='$selectedSumOfVotesAfter', numGradesM='$numOfGradesAfterVote' WHERE idM=$idMovieForVote";
            if ($connectForVote->query($statusUpdateGradeForVote) === TRUE) {
                //something... 
            } else {
                //something else...
            }

            $stmtV = $connectForVote->prepare("INSERT INTO votesTable (idUserV, idMovieV) VALUES (?, ?)");
            $stmtV->bind_param("ss", $idUserVote, $idMovieVote);
            $idUserVote = $idCurrentUser;
            $idMovieVote = $idMovieForVote;
            $stmtV->execute(); 
            $stmtV->close();
        }
        else{
            $alreadyVoted = "*You already voted!";
            $_SESSION['alreadyVoted'] = $alreadyVoted;
        }

        $connectForVote->close();
    }

    header("Location: moviePageUser.php?uid=".$idMovieForVote.";");
?>