<?php
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input
    if (empty($_POST['vkendalawebsite']) || empty($_POST['vsaran'])) {
        $error = "Semua kolom harus diisi.";
    } else {
        // Ambil nilai dari form dan lakukan sanitasi input
        $vkendalawebsite = htmlspecialchars($_POST['vkendalawebsite']);
        $vsaran = htmlspecialchars($_POST['vsaran']);

        // Sisipkan koneksi ke database
        include "conn.php"; // Pastikan file conn.php berisi koneksi ke database

        // Buat pernyataan SQL dengan prepared statement
        $query = "INSERT INTO reportsystemwebsite (kendalawebsite, saran) VALUES (?, ?)";
        
        // Siapkan statement
        $stmt = mysqli_prepare($conn, $query);
        if ($stmt === false) {
            die('MySQL prepare error: ' . mysqli_error($conn));
        }

        // Bind parameter ke statement
        mysqli_stmt_bind_param($stmt, "ss", $vkendalawebsite, $vsaran);

        // Eksekusi statement
        $execute = mysqli_stmt_execute($stmt);
        if ($execute === false) {
            $error = 'Error: ' . mysqli_stmt_error($stmt);
        } else {
            // Data berhasil disimpan, tetapi tidak perlu ditampilkan di sini
            // Anda bisa mengarahkan pengguna ke halaman lain jika perlu
            // header('Location: halaman_berhasil.php');
        }

        // Tutup statement dan koneksi ke database
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>kulima</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        /* Gaya umum */
        body {
            font-family: Arial, sans-serif; /* Memilih font untuk teks */
            background-color: #f0f0f0; /* Warna latar belakang */
            margin: 0; /* Menghilangkan margin bawaan dari body */
            padding: 0; /* Menghilangkan padding bawaan dari body */
        }
        
        .container {
            max-width: 600px; /* Lebar maksimum container */
            margin: 20px auto; /* Posisi tengah dan margin di atas/bawah */
            background-color: #ffffff; /* Warna latar belakang container */
            padding: 20px; /* Padding dalam container */
            border-radius: 8px; /* Sudut bulat pada container */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Bayangan lembut */
        }

        h3 {
            text-align: center; /* Teks rata tengah */
        }

        .form-group {
            margin-bottom: 15px; /* Margin bawah setiap grup form */
        }

        .input-field {
            width: 100%; /* Lebar input field 100% dari container */
            padding: 8px; /* Padding dalam input field */
            border: 1px solid #ccc; /* Garis border dengan warna abu-abu */
            border-radius: 4px; /* Sudut bulat pada input field */
            box-sizing: border-box; /* Box-sizing untuk padding dan border */
        }

        .submit-button, .return-button {
            background-color: black; /* Warna latar belakang */
            color: white; /* Warna teks putih */
            padding: 10px 20px; /* Padding dalam tombol */
            border: none; /* Tidak ada border */
            border-radius: 4px; /* Sudut bulat pada tombol */
            cursor: pointer; /* Kursor menunjukkan area bisa di-klik */
            font-size: 14px; /* Ukuran font */
        }

        .submit-button {
            float: right; /* Meletakkan tombol di sebelah kanan */
        }

        .submit-button:hover, .return-button:hover {
            background-color: #333; /* Warna latar belakang saat tombol dihover */
        }

        .centered-button {
            text-align: center; /* Teks dan konten terpusat */
            margin-top: 20px; /* Margin atas dari tombol kembali */
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Report System Website</h3>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="form-group">
                <label for="vkendalawebsite">Kendala Website</label>
                <input type="text" name="vkendalawebsite" id="vkendalawebsite" class="input-field" required>
            </div>
            <div class="form-group">
                <label for="vsaran">Saran:</label>
                <input type="text" name="vsaran" id="vsaran" class="input-field" required>
            </div>
        
            <input type="submit" name="submit" value="Simpan" class="submit-button">

            <div class="centered-button">
            <button onclick="window.location.href = 'dashboard.html';" class="return-button">Kembali</button>
        </div>
        </form>
    </div>

</body>
</html>
