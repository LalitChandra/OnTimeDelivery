<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Order Management</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .card {
            width: 300px;
            border: none;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.15);
            padding: 20px;
        }
        .card .btn {
            font-size: 20px;
            transition: all 0.3s ease;
            width: 100%;
        }
        .card .btn:hover {
            transform: scale(1.1);
        }
        .logout-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
            color: #dc3545;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .logout-link:hover {
            transform: scale(1.1);
        }
        .logout-link img {
            width: 30px;
        }
    </style>
</head>
<body>

    <div class="card text-center">
        <h1 class="mb-5">Order Management</h1>
        <a href="active_orders.php" class="btn btn-primary mb-3">Active Orders</a>
        <a href="past_orders.php" class="btn btn-secondary mb-3">Past Orders</a>
        <a href='logout_process.php' class='logout-link'>
            <img src='/profile-menu-img/images/purchased.png'>
            <span>Logout</span>
        </a>
    </div>

    <!-- Bootstrap JS and its dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
