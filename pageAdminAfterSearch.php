<!DOCTYPE html>
<html>
<!--
	Domaci 4 (PIA 2020)
	-->
<head>
    <title>IMDb Admin Page</title>
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

    <div class="sticky-top" id="imdb-logo">
        <div id="logo">IMDb-<i>remake</i></div>
        <div id="userData"><i>Account:</i>&emsp;<?php echo $currentFirstname?> <?php echo $currentLastname?> - <?php echo $currentUsername." (". $currentAccountType.")"?></div>
        <form action="logOut.php" method="POST"> 
            <input type="submit" name="logOutbutton" value="Log Out"/>
        </form>
    </div>

    <div class="search-container">
        <form action="#">
            <input id="yourSearchInput" type="text" placeholder="Search by title..." name="search">
            <button id="submitSearchTitle" type="button" onclick="searchByTitleAdmin()"><i class="fa fa-search"></i></button>
        </form>
        <div class="dropdown">
            <button class="dropbtn">Search by genre&ensp;<i class="fa fa-caret-down"></i></button>
            <div class="dropdown-content">
                <a href="#" onclick="loadPageAdmin()">ALL MOVIES</a>
                <a href="#" onclick="searchByGenreAdmin('adventure')">Adventure</a>
                <a href="#" onclick="searchByGenreAdmin('comedy')">Comedy</a>
                <a href="#" onclick="searchByGenreAdmin('crime')">Crime</a>
                <a href="#" onclick="searchByGenreAdmin('drama')">Drama</a>
                <a href="#" onclick="searchByGenreAdmin('action')">Action</a>
                <a href="#" onclick="searchByGenreAdmin('fantasy')">Fantasy</a>
                <a href="#" onclick="searchByGenreAdmin('history')">History</a>
                <a href="#" onclick="searchByGenreAdmin('horror')">Horror</a>
                <a href="#" onclick="searchByGenreAdmin('thriller')">Thriller</a>
                <a href="#" onclick="searchByGenreAdmin('mystery')">Mystery</a>
                <a href="#" onclick="searchByGenreAdmin('philosophical')">Philosophical</a>
                <a href="#" onclick="searchByGenreAdmin('political')">Political</a>
                <a href="#" onclick="searchByGenreAdmin('romance')">Romance</a>
                <a href="#" onclick="searchByGenreAdmin('science fiction')">Science fiction</a>
                <a href="#" onclick="searchByGenreAdmin('social')">Social</a>
                <a href="#" onclick="searchByGenreAdmin('western')">Western</a>
                <a href="#" onclick="searchByGenreAdmin('animation')">Animation</a>
            </div>
        </div>

        <div class="addMovie">
            <button id="openAddFormPage" onclick="openPageToAddMovie()">Add movie</button>
        </div>
    </div>
    
    <div id="allMovies" class="container"><br>
        <div class="movie-items" id="moviesDisplay">
            <?php
            $regexStr = $_GET["regex"];
            $regexStrLowerCase = strtolower($regexStr);
            $searchType = $_GET["type"];
            $pattern = "/".$regexStrLowerCase."/i";

            $servername = "localhost";
            $username = "root";
            $password = "password";
            $dBase = "imdbMyDatabase";

            $connectForMovies = new mysqli($servername, $username, $password, $dBase);

            $fromMoviesSelected = "SELECT idM, titleM, aboutM, genreM, screenplayM, directorsM, productionM, starringM, releaseM, pictureM, durationM, gradeM, numGradesM FROM imdbMovies";
            $resultMoviesSelection = $connectForMovies->query($fromMoviesSelected);
            $moviesAll = "";
            $elementIdNum = 1;
            while($rowMovies = $resultMoviesSelection->fetch_assoc()) {
                $lowerCaseStrTitle = strtolower($rowMovies["titleM"]);
                $lowerCaseStrGenre = strtolower($rowMovies["genreM"]);
                $averageRate = (float)$rowMovies["gradeM"] / $rowMovies["numGradesM"];
                $averageRateStr = number_format((float)$averageRate , 2, '.', '');
                if ($searchType == "byTitle" && (preg_match($pattern, $lowerCaseStrTitle) != 0)){
                    $moviesAll .= '<div class="movie-item" id="movie'.$elementIdNum.'"><a class="link-movie-item" id="'.$rowMovies["idM"].'" onclick="loadMoviePageAdmin('.$rowMovies["idM"].')">
                    <img src="images/'.$rowMovies["pictureM"].'" alt="moviePicture">
                        <div class="describe-movie-item">
                            <div class="describeTitle" id="describeTitle"><span id="movieTitle'.$elementIdNum.'">'.$rowMovies["titleM"].'</span><br><p id="movieGenre'.$elementIdNum.'" style="font-size: small;">'.'('.$rowMovies["genreM"].')'.'</p></div>
                            <div class="describeRate"><i class="fa fa-star-o" style="color: black;"></i>&nbsp;'.$averageRateStr.'</div>
                        </div>
                        </a>
                    </div>';
                    $elementIdNum++;
                }
                else if ($searchType == "byGenre" && (preg_match($pattern, $lowerCaseStrGenre) != 0)){
                    $moviesAll .= '<div class="movie-item" id="movie'.$elementIdNum.'"><a class="link-movie-item" id="'.$rowMovies["idM"].'" onclick="loadMoviePageAdmin('.$rowMovies["idM"].')">
                    <img src="images/'.$rowMovies["pictureM"].'" alt="moviePicture">
                        <div class="describe-movie-item">
                            <div class="describeTitle" id="describeTitle"><span id="movieTitle'.$elementIdNum.'">'.$rowMovies["titleM"].'</span><br><p id="movieGenre'.$elementIdNum.'" style="font-size: small;">'.'('.$rowMovies["genreM"].')'.'</p></div>
                            <div class="describeRate"><i class="fa fa-star-o" style="color: black;"></i>&nbsp;'.$averageRateStr.'</div>
                        </div>
                        </a>
                    </div>';
                    $elementIdNum++;
                }

            }
            echo $moviesAll;
            $connectForMovies->close();
            ?>
        </div>
    </div> 


 
</body>
</html>