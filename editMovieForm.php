<!DOCTYPE html>
<html>
<!--
	Domaci 4 (PIA 2020)
	-->
<head>
    <title>IMDb Edit Movie</title>
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

    <?php include("editMovie.php");?>


    <div class="container" id="signUpDiv" style="margin-top: 2%;">
        <h2>Change movie data:</h2><br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
            Title: <br>
            <input id="yourInput" type="text" name="titleForEdit" value="<?php echo $titleForEdit; ?>">
            <br>
            <span class="error"><?php echo $titleForEditErr;?></span>
            <br>
            <br>
            Genre(s): <br>
            <input id="yourInput" type="text" name="genreForEdit" value="<?php echo $genreForEdit; ?>">
            <br>
            <span class="error"><?php echo $genreForEditErr;?></span>
            <br>
            <br>
            Screenplay: <br>
            <input id="yourInput" type="text" name="screenplayForEdit" value="<?php echo $screenplayForEdit; ?>">
            <br>
            <span class="error"><?php echo $screenplayForEditErr;?></span>
            <br>
            <br>
            Director(s): <br>
            <input id="yourInput" type="text" name="directorsForEdit" value="<?php echo $directorsForEdit; ?>">
            <br>
            <span class="error"><?php echo $directorForEditErr;?></span>
            <br>
            <br>
            Production: <br>
            <input id="yourInput" type="text" name="productionForEdit" value="<?php echo $productionForEdit; ?>">
            <br>
            <span class="error"><?php echo $productionForEditErr;?></span>
            <br>
            <br>
            Starring: <br>
            <input id="yourInput" type="text" name="starringForEdit" value="<?php echo $starringForEdit; ?>">
            <br>
            <span class="error"><?php echo $starringForEditErr;?></span>
            <br>
            <br>
            Release year (YYYY): <br>
            <input id="yourInput" type="text" name="releaseForEdit" value="<?php echo $releaseForEdit; ?>">
            <br>
            <span class="error"><?php echo $releaseForEditErr;?></span>
            <br>
            <br>
            Picture name (from ./images/): <br>
            <input id="yourInput" type="text" name="pictureForEdit" value="<?php echo $pictureForEdit; ?>">
            <br>
            <span class="error"><?php echo $pictureForEditErr;?></span>
            <br>
            <br>
            Duration (min): <br>
            <input id="yourInput" type="text" name="durationForEdit" value="<?php echo $durationForEdit; ?>">
            <br>
            <span class="error"><?php echo $durationForEditErr;?></span>
            <br>
            <br>
            Description: <br>
            <textarea id="yourInput" type="text" name="aboutForEdit" rows="7"><?php echo $aboutForEdit; ?></textarea>
            <br>
            <span class="error"><?php echo $descriptionForEditErr;?></span>
            <br>
            <br>
            <input id="submitFormToChangeMovieData" type="submit" name="submit" value="Change data">  
            <br><br>
        </form> 
    </div>
</body>
</html>