<?php
// Pastikan file conn.php berisi koneksi ke database
include "conn.php";

// Menerima data dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memasukkan data ke database
    $query = "INSERT INTO login (username, password) VALUES (?, ?)";
    
    // Siapkan statement
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt === false) {
        die('MySQL prepare error: ' . mysqli_error($conn));
    }

    // Bind parameter ke statement
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);

    // Eksekusi statement
    $execute = mysqli_stmt_execute($stmt);
    if ($execute === false) {
        $error = 'Error: ' . mysqli_stmt_error($stmt);
    } else {
        // Redirect ke halaman login jika registrasi sukses
        header('Location: index.html');
        exit();
    }

    // Tutup statement
    mysqli_stmt_close($stmt);
}

// Tutup koneksi ke database
mysqli_close($conn);
?>
