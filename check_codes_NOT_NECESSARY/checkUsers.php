<!DOCTYPE html>
<html>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "imdbMyDatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, firstname, lastname, email, username, passwd, accountType, statusLogInOut FROM imdbAllUsers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br> id: ". $row["id"]. " - Name: ". $row["firstname"]. " - Surname: ". $row["lastname"]." - Email: ". $row["email"]." - Username: ". $row["username"]. " - Password: ". $row["passwd"]." - AccountType: ". $row["accountType"]." - Status: ". $row["statusLogInOut"]."<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>

</body>
</html>
