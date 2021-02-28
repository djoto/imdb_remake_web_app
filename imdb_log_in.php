<!DOCTYPE html>
<html>
<!--
	Domaci 4 (PIA 2020)
	-->
<head>
    <title>IMDb Log In</title>
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
    <div class="sticky-top" id="imdb-logo">
        <div id="logo">IMDb-<i>remake</i></div>
    </div>

    <?php include("logInForm.php");?>

    <div class="container" id="logInDiv">
        <h2>Log in or Sign up:</h2><br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
            Username or e-mail: <br>
            <input id="yourInput" type="text" name="logInName" value="<?php echo $logInName;?>">
            <br>
            <span class="error"><?php echo $logInNameErr;?></span>
            <br>
            Password: <br>
            <input id="yourInput" type="password" name="logInPassword">
            <br>
            <span class="error"><?php echo $logInPasswdErr;?></span>
            <br>
            <input id="submitForm" type="submit" name="submit" value="Log in">  
            <br>
            <p style="color: red; margin-top: 5px;"><?php echo $labelIfNotExists; ?></p>
            You don't have account? Sign up!<br>
        </form> 
        <button id="signUpButton" onclick="openSignUpPage()">Sign up</button>
    </div>


 
</body>
</html>