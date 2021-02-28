<!DOCTYPE html>
<html>
<!--
	Domaci 4 (PIA 2020)
	-->
<head>
    <title>IMDb Add Movie</title>
    <meta name="author" content="Ђорђе Гачић" />
    <meta charset="utf-8" />
    <meta name="description" content="JavaScript/jQuery/PHP homework assignment." />
    <meta name="keywords" content="pia, web programming, html, css, bootstrap, javascript, jquery, PHP, mySQL" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
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
            header("Location:imdb_index.php");
        }
    ?>
    <div class="sticky-top" id="imdb-logo">
        <div id="logo">IMDb-<i>remake</i></div>
        <div id="userData"><i>Account:</i>&emsp;<?php echo $currentFirstname?> <?php echo $currentLastname?> - <?php echo $currentUsername." (". $currentAccountType.")"?></div>
        <form action="logOut.php" method="POST"> 
            <input type="submit" name="logOutbutton" value="Log Out"/>
        </form>
    </div>

    <?php include("addMovie.php");?>


    <div class="container" id="signUpDiv" style="margin-top: 2%;">
        <h2>Set movie data:</h2><br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
            Title: <br>
            <input id="yourInput" type="text" name="addTitle">
            <br>
            <span class="error"><?php echo $titleErr;?></span>
            <br>
            Genre(s): <br>
            <input id="yourInput" type="text" name="addGenre">
            <br>
            <span class="error"><?php echo $genreErr;?></span>
            <br>
            Screenplay: <br>
            <input id="yourInput" type="text" name="addScreenplay">
            <br>
            <span class="error"><?php echo $screenplayErr;?></span>
            <br>
            Director(s): <br>
            <input id="yourInput" type="text" name="addDirector">
            <br>
            <span class="error"><?php echo $directorErr;?></span>
            <br>
            Production: <br>
            <input id="yourInput" type="text" name="addProduction">
            <br>
            <span class="error"><?php echo $productionErr;?></span>
            <br>
            Starring: <br>
            <input id="yourInput" type="text" name="addStarring">
            <br>
            <span class="error"><?php echo $starringErr;?></span>
            <br>
            Release year (YYYY): <br>
            <input id="yourInput" type="text" name="addRelease">
            <br>
            <span class="error"><?php echo $releaseErr;?></span>
            <br>
            Picture name (from ./images/): <br>
            <input id="yourInput" type="text" name="addPicture">
            <br>
            <span class="error"><?php echo $pictureErr;?></span>
            <br>
            Duration (min): <br>
            <input id="yourInput" type="text" name="addDuration">
            <br>
            <span class="error"><?php echo $durationErr;?></span>
            <br>
            Description: <br>
            <textarea id="yourInput" type="text" name="addDescription" rows="7"></textarea>
            <br>
            <span class="error"><?php echo $descriptionErr;?></span>
            <br>
            <input id="submitFormToAddMovie" type="submit" name="submit" value="Add to database">  
            <br><br>
        </form> 
    </div>
</body>
</html>