<?php
    session_start();
    include("loadDbTableAdmin.php");
  
    $logInNameErr = $logInPasswdErr = "";
    $logInName = $logInPassword = "";
    $labelIfNotExists = "";

    $conne = new mysqli($servername, $username, $password, $dBase);

    $counterLogIn = 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["logInName"])) {
            $logInNameErr = "* Required field";
        } else {
            $logInName = test_input($_POST["logInName"]);
            // check if input is invalid name or email
            if (!preg_match("/^[a-zA-Z]+$/",$logInName) && !filter_var($logInName, FILTER_VALIDATE_EMAIL)) {
                $logInNameErr = "* Only letters allowed (or invalid e-mail)";
            }
            else{
                $counterLogIn++;
            }
        }
        
        if (empty($_POST["logInPassword"])) {
            $logInPasswdErr = "* Required field";
        } else {
            $logInPassword = test_input($_POST["logInPassword"]);
            $counterLogIn++;
        }
        
    }

    $tryIt = "SELECT id, firstname, lastname, email, username, passwd, accountType, statusLogInOut FROM imdbAllUsers";
    $result = $conne->query($tryIt);

    $counterIfExists = 0;

    if ($counterLogIn == 2){
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if (($row["email"] == $logInName || $row["username"] == $logInName) && $row["passwd"] == $logInPassword){

                    $counterIfExists++;

                    $_SESSION['id'] = $row["id"];
                    $_SESSION['firstname'] = $row["firstname"];
                    $_SESSION['lastname'] = $row["lastname"];
                    $_SESSION['email'] = $row["email"];
                    $_SESSION['username'] = $row["username"];
                    $_SESSION['passwd'] = $row["passwd"];
                    $_SESSION['accountType'] = $row["accountType"];
                    $userId = $row["id"];

                    $statusUpdate = "UPDATE imdbAllUsers SET statusLogInOut='in' WHERE id=$userId";

                    if ($conne->query($statusUpdate) === TRUE) {
                        //something... 
                    } else {
                        //something else...         
                    }
                    
                    $selectStatus = "SELECT statusLogInOut FROM imdbAllUsers WHERE id=$userId";
                    $selectedStat = $conne->query($selectStatus);

                    if ($selectedStat->num_rows > 0) {
                        while($rowStat = $selectedStat->fetch_assoc()) {
                            if($rowStat["statusLogInOut"] == "in"){
                                $_SESSION['statusLogInOut'] = $rowStat["statusLogInOut"];
                                if($_SESSION['accountType'] == "admin"){
                                    header("Location:pageAdmin.php");
                                }
                                else{
                                    header("Location:pageUser.php");
                                }
                            }
                        }
                    }
                }
            }
            if ($counterIfExists == 0){
                $labelIfNotExists = "*Invalid email, username or password! Try again.";
            }
        }
        $counterLogIn = 0;
    }

    $conne->close();

    function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }

?>

