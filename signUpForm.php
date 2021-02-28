<?php
    include("loadDbTableAdmin.php");

    $signUpNameErr = $signUpSurnameErr = $signUpEmailErr = $signUpUsernameErr = $signUpPasswordErr = "";
    $signUpName = $signUpSurname = $signUpEmail = $signUpUsername = $signUpPassword = "";

    $labelAlreadyExists = "";

    $connectSignUp = new mysqli($servername, $username, $password, $dBase);
    $selectedFromTable = "SELECT email, username FROM imdbAllUsers";
    $resultSelection = $connectSignUp->query($selectedFromTable);
    $counterSignUp = 0;
    $counterCheck = 0;
    $stmt = $connectSignUp->prepare("INSERT INTO imdbAllUsers (firstname, lastname, email, username, passwd, accountType, statusLogInOut) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $signUpName, $signUpSurname, $signUpEmail, $signUpUsername, $signUpPassword, $usertype, $userStatus);
    $usertype = "user";
    $userStatus = "out";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["signUpName"])) {
            $signUpNameErr = "* Required field";
        } else {
            $signUpName = test_input($_POST["signUpName"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z]+$/",$signUpName)) {
            $signUpNameErr = "* Only letters allowed";
            }
            else{
                $counterSignUp++;
            }
        }
        if (empty($_POST["signUpSurname"])) {
            $signUpSurnameErr = "* Required field";
        } else {
            $signUpSurname = test_input($_POST["signUpSurname"]);
            if (!preg_match("/^[a-zA-Z]+$/",$signUpSurname)) {
            $signUpSurnameErr = "* Only letters allowed";
            }
            else{
                $counterSignUp++;
            }
        }
        if (empty($_POST["signUpEmail"])) {
            $signUpEmailErr = "* Required field";
        } else {
            $signUpEmail = test_input($_POST["signUpEmail"]);
            if (!filter_var($signUpEmail, FILTER_VALIDATE_EMAIL)) {
            $signUpEmailErr = "* Invalid e-mail address.";
            }
            else{
                $counterSignUp++;
            }
        }

        if (empty($_POST["signUpUsername"])) {
            $signUpUsernameErr = "* Required field";
        } else {
            $signUpUsername = test_input($_POST["signUpUsername"]);
            if (!preg_match("/^[a-zA-Z]+$/",$signUpUsername)) {
            $signUpUsernameErr = "* Only letters allowed";
            }
            else{
                $counterSignUp++; 
            }
        }
        
        if (empty($_POST["signUpPassword"])) {
            $signUpPasswordErr = "* Required field";
        } else {
            $signUpPassword = test_input($_POST["signUpPassword"]);
            $counterSignUp++;
        }
        
    }
    while($row = $resultSelection->fetch_assoc()) {
        if ($row["username"] == $signUpUsername || $row["email"] == $signUpEmail){
            $counterCheck++;
        }
    }
    if ($counterCheck > 0){
        $labelAlreadyExists = "*Username or email already exists! Choose other.";
    }
    if ($counterSignUp == 5 && $counterCheck == 0){
        $stmt->execute();

        $counterSignUp = 0;
        header("Location:imdb_log_in.php");

    }
    else {
        $counterSignUp = 0;
        $counterCheck = 0;
    }
    
    $stmt->close();

    $connectSignUp->close();
    
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>