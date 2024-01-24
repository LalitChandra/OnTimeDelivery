<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="index.css" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title> Dashboard </title>
    <style>
    .display-4 {
        color: #3498db;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        animation: fadein 2s;
    }

    @keyframes fadein {
        from { opacity: 0; }
        to   { opacity: 1; }
    }
</style>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php include('profile.php'); ?>
    
<div class="container mt-5">
<div class="text-center">
    <h1>We offer two exceptional services</h1>
</div>
        <div class="row mt-5 text-center">
            <div class="col-md-5 text-center">
                <a href="orderForDetails.php" class="text-decoration-none">
                    <img class="img-fluid" src="grocery.png" alt="Grocery" width="200" height="200">
                </a>
                <p>Convenient online delivery of groceries and essential items, making life easier and safer.</p>
            </div>
            <div class="col-md-3 text-center">
                <a href="POD.php" class="text-decoration-none">
                    <img class="img-fluid" src="Pickup.png" alt="Pickup" width="200" height="200">
                </a>
                <p>Fast, reliable pickup and drop service for packages—seamless delivery at your convenience.</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Popper.js and Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>