<!-- welcome.php -->
<?php
session_start(); // Mulai sesi untuk mengakses data sesi

// Periksa apakah pengguna sudah login atau belum
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    echo "<h2>Selamat datang, $username!</h2>";
    echo "<p><a href='logout.php'>Logout</a></p>";
} else {
    // Jika belum login, redirect ke halaman login
    header("Location: login.html");
    exit();
}
?>
