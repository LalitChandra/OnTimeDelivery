<!DOCTYPE html>
<html>
<head>
    <title>Signup or Registration</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h2 class="text-center">Signup or Registration</h2>
                <form method="post" action="signup_process.php" autocomplete="off" autofill="off">
                    <div class="form-group">
                        <input type="text" name="fullname" class="form-control" placeholder="Full Name" required value="">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" required value="" autocomplete="off">
                    </div>
                    <div class="form-group">
                        
                        <input type="tel" id="phone" name="phone" class="form-control" placeholder="Enter your phone number" pattern="[0-9]{10}" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required value="">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Signup">
                    </div>
                    <div class = "form-group">
                        <input type="button" onclick="window.location.href='login.php'" class="btn btn-primary" value= "Go Back to login"></input>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Full name must only contain letters and spaces
if (!preg_match("/^[a-zA-Z ]*$/", $_POST["fullname"])) {
    die("Only letters and spaces allowed in the Full Name field.");
}

// Validate email
if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
}

// Validate phone number - should be 10 digits
if (!preg_match("/^[0-9]{10}$/", $_POST["phone"])) {
    die("Invalid phone number. Please enter a 10 digit phone number.");
}

// Validate password - this is a simple length check, you might want to add more rules
if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters long.");
}

    }
    ?>

    <!-- Bootstrap JS and its dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

