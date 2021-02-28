<!DOCTYPE html>
<html>
<!--
	Domaci 4 (PIA 2020)
	-->
<head>
    <title>IMDb - Sign Up</title>
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

    <?php include("signUpForm.php");?>


    <div class="container" id="signUpDiv" style="margin-top: 2%;">
        <h2>Registration:</h2><br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
            Name: <br>
            <input id="yourInput" type="text" name="signUpName" value="<?php echo $signUpName;?>">
            <br>
            <span class="error"><?php echo $signUpNameErr;?></span>
            <br>
            Surname: <br>
            <input id="yourInput" type="text" name="signUpSurname" value="<?php echo $signUpSurname;?>">
            <br>
            <span class="error"><?php echo $signUpSurnameErr;?></span>
            <br>
            E-mail: <br>
            <input id="yourInput" type="text" name="signUpEmail" value="<?php echo $signUpEmail;?>">
            <br>
            <span class="error"><?php echo $signUpEmailErr;?></span>
            <br>
            Username: <br>
            <input id="yourInput" type="text" name="signUpUsername" value="<?php echo $signUpUsername;?>">
            <br>
            <span class="error"><?php echo $signUpUsernameErr;?></span>
            <br>
            Password: <br>
            <input id="yourInput" type="password" name="signUpPassword">
            <br>
            <span class="error"><?php echo $signUpPasswordErr;?></span>
            <br>
            <p style="color: red;"><?php echo $labelAlreadyExists; ?></p>
            <input id="submitForm" type="submit" name="submit" value="Register">  
            <br><br>
        </form> 
    </div>
</body>
</html>