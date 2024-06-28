<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'websitekuliah';
$conn = mysqli_connect($host, $user, $pass, $db);

if (! $conn) {
    echo "Koneksi Error: ". mysqli_connect_error();
    exit();
}
?>