<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - SLC Online Bookstore</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background-color: #f8f9fa;
            padding: 80px 0;
            text-align: center;
        }
        .team-card img {
            height: 250px;
            object-fit: cover;
        }
    </style>
</head>
<body>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="display-4">About SLC Online Bookstore</h1>
            <p class="lead">Your one-stop shop for a wide range of books at the comfort of your home.</p>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="images/bookstore.jpg" alt="SLC Bookstore" class="img-fluid rounded shadow">
                </div>
                <div class="col-md-6">
                    <h2>Our Story</h2>
                    <p>
                        SLC Online Bookstore was founded with a mission to make books accessible to everyone, everywhere. 
                        We offer a wide variety of genres including fiction, non-fiction, academic, and more. Our team is 
                        dedicated to providing excellent customer service and a seamless online shopping experience.
                    </p>
                    <p>
                        Whether you're a student, a professional, or a casual reader, SLC Online Bookstore is here to help 
                        you find the perfect book.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Meet Our Team</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card team-card shadow-sm">
                        <img src="images/team1.jpg" class="card-img-top" alt="Team Member 1">
                        <div class="card-body text-center">
                            <h5 class="card-title">Jane Doe</h5>
                            <p class="card-text">Founder & CEO</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card team-card shadow-sm">
                        <img src="images/team2.jpg" class="card-img-top" alt="Team Member 2">
                        <div class="card-body text-center">
                            <h5 class="card-title">John Smith</h5>
                            <p class="card-text">Operations Manager</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card team-card shadow-sm">
                        <img src="images/team3.jpg" class="card-img-top" alt="Team Member 3">
                        <div class="card-body text-center">
                            <h5 class="card-title">Emily Lee</h5>
                            <p class="card-text">Customer Support</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-light py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; <?php echo date('Y'); ?> SLC Online Bookstore. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/boot
