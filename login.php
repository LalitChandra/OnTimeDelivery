<!DOCTYPE html>
<html>
<head>
    <title>Login page</title>
    <script type="text/javascript">
        function preventBack() {
            window.history.forward();
        }
        setTimeout("preventBack()",0);
        window.onunload = function(){null;}
    </script>
    <!-- Add Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">

    <div class="row justify-content-center align-items-center" style="height: 100vh;">

        <div class="col-6">

            <h1 class="text-center mb-5">Login</h1>

            <div class="row">
                <div class="col">
                    <form action="login_process.php" method="POST" autocomplete="off" name="login" class="p-5 border rounded">
                        <h3>Login as Customer</h3>
                        <div class="form-group">
                            <label for="email">Email address:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                        </div>

                        <div class="form-group">
                            <label for="pass">Password:</label>
                            <input type="password" class="form-control" id="pass" name="password" placeholder="Enter password">
                        </div>

                        <button type="submit" class="btn btn-primary" id="btn" name="login">Login as Customer</button>
                        <div class="text-center mt-3">
                        <a href="signup.php">Sign up as Customer</a>
                        </div>
                    </form>
                </div>

                <div class="col">
                    <form action="login_process_driver.php" method="POST" autocomplete="off" name="login_driver" class="p-5 border rounded">
                        <h3>Login as Driver</h3>
                        <div class="form-group">
                            <label for="email_driver">Email address:</label>
                            <input type="email" class="form-control" id="email_driver" name="email" placeholder="Enter email">
                        </div>

                        <div class="form-group">
                            <label for="pass_driver">Password:</label>
                            <input type="password" class="form-control" id="pass_driver" name="password" placeholder="Enter password">
                        </div>

                        <button type="submit" class="btn btn-primary" id="btn_driver" name="login_driver">Login as Driver</button>
                        <div class="text-center mt-3">
                        <a href="signupDriver.php">Signup as Driver</a>
                        </div>
                    </form>
                </div>
            </div>

            
           

        </div>

    </div>

</div>

<!-- Add Bootstrap JS and its dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
