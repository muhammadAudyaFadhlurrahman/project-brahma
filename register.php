<?php
session_start();
require_once "config/koneksi.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = trim($_POST['first_name']);
    $last_name  = trim($_POST['last_name']);
    $email      = trim($_POST['email']);
    $password   = $_POST['password'];

    // Cek apakah email sudah terdaftar
    $cek = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $cek->bind_param("s", $email);
    $cek->execute();
    $cek->store_result();

    if ($cek->num_rows > 0) {

        $error = "Email sudah terdaftar.";
    } else {

        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        $insert = $conn->prepare("
            INSERT INTO users(first_name,last_name,email,password)
            VALUES(?,?,?,?)
        ");

        $insert->bind_param(
            "ssss",
            $first_name,
            $last_name,
            $email,
            $hashPassword
        );

        if ($insert->execute()) {

            $_SESSION['success'] = "Registrasi berhasil. Silakan login.";
            header("Location: login.php");
            exit;
        } else {

            $error = "Registrasi gagal.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width,initial-scale=1.0'>
    <title>Pagani - Register</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <style>
        body {
            background: #1a1a1a;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0
        }

        .card {
            border: none;
            border-radius: 10px;
            background: #212529;
            color: #fff;
            width: 100%;
            max-width: 450px
        }

        .btn-warning {
            background: #f18930;
            border: none
        }
    </style>
</head>

<body>
    <div class='card shadow p-4 mx-3'>
        <div class='text-center mb-4'>
            <h2 class='fw-bold'>CREATE ACCOUNT</h2>
            <p class='text-muted small'>Join the exclusive inner circle of Pagani collectors</p>
        </div>
        <?php if ($error): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <form action="" method='POST'>
            <div class='row g-2 mb-3'>
                <div class='col'><label class='form-label text-secondary small'>First Name</label><input name='first_name' type='text' class='form-control bg-dark text-white border-secondary' required></div>
                <div class='col'><label class='form-label text-secondary small'>Last Name</label><input name='last_name' type='text' class='form-control bg-dark text-white border-secondary' required></div>
            </div>
            <div class='mb-3'><label class='form-label text-secondary small'>Email</label><input name='email' type='email' class='form-control bg-dark text-white border-secondary' required></div>
            <div class='mb-3'><label class='form-label text-secondary small'>Password</label><input name='password' type='password' class='form-control bg-dark text-white border-secondary' required></div><button class='btn btn-warning w-100 fw-bold mt-2 py-2'>Create Account</button>
        </form>
        <div class='text-center mt-3'>
            <p class='mb-0 text-muted small'>Already a member? <a href='login.php' class='text-warning text-decoration-none'>Sign In</a></p><a href='index.php' class='d-block mt-3 text-secondary text-decoration-none small'>&larr; Back to Main Site</a>
        </div>
    </div>
</body>

</html>