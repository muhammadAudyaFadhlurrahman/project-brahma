<?php
session_start();
include 'config/koneksi.php';

$query = "SELECT * FROM cars";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagani Hypercars</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">PAGANI</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#cars">Cars</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
            </ul>
        </div>
    </div>
</nav>

<section class="py-5 bg-light">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Pagani Hypercars</h1>
        <p class="lead">Where Art Meets Engineering</p>
        <img src="assets/images/908398.jpg" class="img-fluid rounded shadow" alt="Pagani">
    </div>
</section>

<section id="about" class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">About Pagani</h2>
        <p class="text-center">
            Founded by Horacio Pagani in 1992, Pagani Automobili creates
            handcrafted hypercars that combine engineering and art.
        </p>
    </div>
</section>

<section id="cars" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Featured Models</h2>

        <div class="row g-4">

        <?php if($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img
                            src="assets/images/<?= htmlspecialchars($row['image_url']) ?>"
                            class="card-img-top"
                            alt="<?= htmlspecialchars($row['name']) ?>"
                        >

                        <div class="card-body">
                            <h5 class="card-title">
                                <?= htmlspecialchars($row['name']) ?>
                            </h5>

                            <p class="card-text">
                                <?= htmlspecialchars($row['description']) ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    Tidak ada data mobil.
                </div>
            </div>
        <?php endif; ?>

        </div>
    </div>
</section>

<section id="contact" class="py-5 text-center">
    <div class="container">
        <h2>Contact</h2>
        <p>Email : info@pagani.com</p>
    </div>
</section>

<footer class="bg-dark text-white text-center py-4">
    <p class="mb-0">&copy; 2026 Pagani Hypercars</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
