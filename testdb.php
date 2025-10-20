<?php
$servername = "localhost";
$dbname = "practice";
$dbUsername = "root";
$dbPassword = "";
$port = 3307; // MySQL 的實際端口

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbname, $port);

if (!$conn) {
    die("無法連線: " . mysqli_connect_error());
} else {
    echo "成功連線!";
}
?>
