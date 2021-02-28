<!DOCTYPE html>
<html>
<!--
	Domaci 4 (PIA 2020)
	-->
<head>
    <title>IMDb Admin Movie Page</title>
    <meta name="author" content="Ђорђе Гачић" />
    <meta charset="utf-8" />
    <meta name="description" content="JavaScript/jQuery/PHP homework assignment." />
    <meta name="keywords" content="pia, web programming, html, css, bootstrap, javascript, jquery, PHP, mySQL" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="imdb.css">
    <script src="imdb.js"></script>
</head>
<body>
    <?php
        session_start();
        $currentId =  $_SESSION['id'];
        $currentFirstname = $_SESSION['firstname'];
        $currentLastname = $_SESSION['lastname'];
        $currentEmail = $_SESSION['email'];
        $currentUsername = $_SESSION['username'];
        $currentPassword = $_SESSION['passwd'];
        $currentAccountType = $_SESSION['accountType'];
        $currentUserStatus = $_SESSION['statusLogInOut'];
        if($currentUserStatus != "in"){
            header("Location:imdb_log_in.php");
        }
    ?>

    <?php
        $movieId = $_GET["uid"];

        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dBase = "imdbMyDatabase";

        $connectForLoadMovieInfo = new mysqli($servername, $username, $password, $dBase);

        $selectFromMovies = "SELECT idM, titleM, aboutM, genreM, screenplayM, directorsM, productionM, starringM, releaseM, pictureM, durationM, gradeM, numGradesM FROM imdbMovies WHERE idM=$movieId";
        $selectedWithMovieId = $connectForLoadMovieInfo->query($selectFromMovies);

        $selectedId = "";

        if ($selectedWithMovieId ->num_rows > 0) {

            while($rowSelected = $selectedWithMovieId->fetch_assoc()) {
                $selectedId = $rowSelected["idM"];
                $selectedTitle = $rowSelected["titleM"];
                $selectedAbout = $rowSelected["aboutM"];
                $selectedGenre = $rowSelected["genreM"];
                $selectedScreenplay = $rowSelected["screenplayM"];
                $selectedDirectors = $rowSelected["directorsM"];
                $selectedProduction = $rowSelected["productionM"];
                $selectedStarring = $rowSelected["starringM"];
                $selectedRelease = $rowSelected["releaseM"];
                $selectedPicture = $rowSelected["pictureM"];
                $selectedDuration = $rowSelected["durationM"];
                $selectedGrade = $rowSelected["gradeM"];
                $selectedNumGrades = $rowSelected["numGradesM"];
                $_SESSION['idM'] = $selectedId;
                $_SESSION['titleM'] = $selectedTitle;
                $_SESSION['aboutM'] = $selectedAbout;
                $_SESSION['genreM'] = $selectedGenre;
                $_SESSION['screenplayM'] = $selectedScreenplay;
                $_SESSION['directorsM'] = $selectedDirectors;
                $_SESSION['productionM'] = $selectedProduction;
                $_SESSION['starringM'] = $selectedStarring;
                $_SESSION['releaseM'] = $selectedRelease;
                $_SESSION['pictureM'] = $selectedPicture;
                $_SESSION['durationM'] = $selectedDuration;
                $_SESSION['gradeM'] = $selectedGrade;
                $_SESSION['numGradesM'] = $selectedNumGrades;

            }
        }

        $connectForLoadMovieInfo->close();
    ?>
    <div class="sticky-top" id="imdb-logo">
        <div id="logo">IMDb-<i>remake</i></div>
        <div id="userData"><i>Account:</i>&emsp;<?php echo $currentFirstname?> <?php echo $currentLastname?> - <?php echo $currentUsername." (". $currentAccountType.")"?></div>
        
        <form action="logOut.php" method="POST"> 
            <input type="submit" name="logOutbutton" value="Log Out"/>
        </form>
    </div>

    <div id="movieContent" class="container"><br>
        <div class="imgAndInfo">
            <div class="movieImg"><img src="images/<?php echo $selectedPicture?>" alt="moviePicture"></div>
            <div class="someInfo" style="height: 100%;">
                <p style="text-align: center; font-size: x-large; font-weight: bold;"><?php echo $selectedTitle?>&ensp;(<?php echo $selectedRelease?>)</p>
                <?php
                    $currentRating = (float)$selectedGrade / $selectedNumGrades;
                    $currentRatingStr = number_format((float)$currentRating , 2, '.', '');
                ?>
                <p style="text-align: center;"><b>Rating:</b>&ensp;<?php echo $currentRatingStr?></p>
                <p style="text-align: center;"><b>Number of grades:</b>&ensp;<?php echo $selectedNumGrades?></p>
            
            </div>
        </div>
        <div class="otherInfo">
            <p><b>Genre(s):</b>&ensp;<?php echo $selectedGenre?></p>
            <p><b>Screenplay:</b>&ensp;<?php echo $selectedScreenplay?></p>
            <p><b>Directed by:</b>&ensp;<?php echo $selectedDirectors?></p>
            <p><b>Production:</b>&ensp;<?php echo $selectedProduction?></p>
            <p><b>Starring:</b>&ensp;<?php echo $selectedStarring?></p>
            <p><b>Duration:</b>&ensp;<?php echo $selectedDuration?>min</p>
            <p><b>Description:</b><br><?php echo $selectedAbout?></p>
            <br>

            <div style="text-align: center; margin-bottom: 30px;">
                <form action="deleteMovie.php" method="POST"> 
                    <input type="submit" name="deleteMovieButton" value="Delete movie"/>
                </form>
                <br>
                <form action="editMovieForm.php" method="POST"> 
                    <input type="submit" name="editMovieButton" value="Edit movie data"/>
                </form>
            </div>
        </div>
    </div> 
 
</body>
</html>
