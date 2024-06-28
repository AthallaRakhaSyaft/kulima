<?php
// login.php

// Masukkan koneksi ke database (conn.php)
include "conn.php";

// Ambil nilai username dan password dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Lindungi dari serangan SQL Injection dengan mysqli_real_escape_string
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

// Query untuk mencari user berdasarkan username dan password
$query = "SELECT * FROM login WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) == 1) {
    // Jika data ditemukan, artinya login berhasil
    session_start(); // Memulai sesi untuk menyimpan status login
    $_SESSION['username'] = $username; // Simpan username dalam sesi
    header("Location: dashboard.html"); // Redirect ke halaman selamat datang
} else {
    // Jika data tidak ditemukan, artinya login gagal
    echo "Username atau Password salah. <a href='login.html'>Coba lagi</a>";
}

// Tutup koneksi database
mysqli_close($conn);
?>
