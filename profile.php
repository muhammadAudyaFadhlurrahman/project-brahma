<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagani - My Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa
        }

        .profile-header {
            background: linear-gradient(135deg, #212529, #1a1a1a);
            color: #fff;
            padding: 40px 0
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">PAGANI</a>
            <div class="ms-auto d-flex align-items-center">
                <a class="nav-link me-3 text-white-50" href="index.php">Showcase</a>
                <a href="logout.php" class="btn btn-sm btn-outline-danger">Log Out</a>
            </div>
        </div>
    </nav>

    <div class="profile-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-2 text-center mb-3 mb-md-0">
                    <img src="assets/images/user-profile-icon-vector-1_666870-1779.avif" class="img-fluid rounded-circle shadow border border-3 border-warning" style="max-height:120px" alt="Profile">
                </div>
                <div class="col-md-10">
                    <h1 class="fw-bold"><?= isset($_SESSION['first_name']) ? htmlspecialchars($_SESSION['first_name']) . ' ' . htmlspecialchars($_SESSION['last_name'] ?? '') : 'Guest User' ?></h1>
                    <p class="lead mb-1 text-secondary">VIP Member since 2026</p>
                    <span class="badge bg-warning text-dark">Utopia Owner Group</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 p-3">
                    <h5 class="fw-bold border-bottom pb-2">Profile Actions</h5>
                    <ul class="nav flex-column gap-2 mt-2">
                        <li><a class="nav-link active bg-light rounded" href="#">Account Settings</a></li>
                        <li><a class="nav-link text-secondary" href="#">Saved Configurations</a></li>
                        <li><a class="nav-link text-secondary" href="#">Order Tracking</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow-sm border-0 p-4">
                    <h4 class="fw-bold mb-4">Personal Information</h4>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <p class="text-muted mb-0 small">Email</p><strong><?= htmlspecialchars($_SESSION['email'] ?? 'example@email.com') ?></strong>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-muted mb-0 small">Phone</p><strong>-</strong>
                        </div>
                        <div class="col-12">
                            <p class="text-muted mb-0 small">Address</p><strong>-</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>