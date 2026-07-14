<?php
$host     = "localhost";
$username = "root";       // Username bawaan XAMPP/MAMP biasanya 'root'
$password = "";           // Password bawaan XAMPP biasanya kosong
$database = "pagani_db";

// Membuat koneksi menggunakan ekstensi MySQLi
$conn = new mysqli($host, $username, $password, $database);

// Periksa apakah koneksi berhasil atau gagal
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
?>