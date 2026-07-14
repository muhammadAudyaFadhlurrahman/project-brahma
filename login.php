<?php
session_start();
require_once "config/koneksi.php";

$error = "";

// Menampilkan pesan sukses dari register
if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['email'] = $user['email'];

            header("Location: profile.php");
            exit;
        } else {

            $error = "Password yang Anda masukkan salah.";
        }
    } else {

        $error = "Email tidak ditemukan.";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Pagani - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
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
            max-width: 400px
        }

        .btn-warning {
            background: #f18930;
            border: none
        }

        .btn-warning:hover {
            background: #d67420;
            color: #fff
        }
    </style>
</head>

<body>
    <div class="card shadow p-4 mx-3">
        <div class="text-center mb-4">
            <h2 class="fw-bold">PAGANI LOGIN</h2>
            <p class="text-muted small">Enter your credentials to access your dashboard</p>
        </div>
        <?php if (isset($success)): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <form action="" method="POST">
            <div class="mb-3"><label class="form-label text-secondary">Email address</label><input type="email" name="email" class="form-control bg-dark text-white border-secondary" required></div>
            <div class="mb-3"><label class="form-label text-secondary">Password</label><input type="password" name="password" class="form-control bg-dark text-white border-secondary" required></div><button class="btn btn-warning w-100 fw-bold mt-2 py-2" type="submit">Sign In</button>
        </form>
        <div class="text-center mt-3">
            <p class="mb-0 text-muted small">Don't have an account? <a href="register.php" class="text-warning text-decoration-none">Register here</a></p><a href="index.php" class="d-block mt-3 text-secondary text-decoration-none small">&larr; Back to Main Site</a>
        </div>
    </div>
</body>

</html>