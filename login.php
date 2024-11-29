<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_auth";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['password'])) {
            echo "<script>window.location.href='text_to_speech.html';</script>";
        } else {
            echo "<script>alert('Incorrect password.'); window.location.href='index.html';</script>";
        }
    } else {
        echo "<script>alert('User not found.'); window.location.href='index.html';</script>";
    }
}

$conn->close();
?>
