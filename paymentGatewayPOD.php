
<?php include('profile.php');?>
<!DOCTYPE html>
<head>
    <title>Payment Gateway</title>
    <style>
    #paymentForm {
        width: 300px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    #paymentForm input[type="text"],
    #paymentForm input[type="number"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    #paymentForm input[type="submit"] {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 4px;
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
    }

    #paymentForm input[type="submit"]:hover {
        background-color: #45a049;
    }
    .center-text {
    text-align: center;
}
</style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <h2 class="center-text"> A default 10$ deposit amount will be deducted from your account</h2>
            <form id="paymentForm" method="post" name="card details" class="p-4 border rounded">
                <div class="form-group">
                    <input type="text" class="form-control" id="nameOnCard" name="nameOnCard" placeholder="Enter Name on your card">
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" id="cardNumber" name="cardNumber" placeholder="Enter Card Number">
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" id="expiryMonth" name="expiryMonth" placeholder="month of card expiry">
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" id="expiryYear" name="expiryYear" placeholder="year of card expiry">
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" id="cvv" name="cvv" placeholder="CVV">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" value="Submit and Pay">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
<script>
    document.getElementById('paymentForm').onsubmit = function() {
        // Get form values
        var nameOnCard = document.getElementById('nameOnCard').value;
        var cardNumber = document.getElementById('cardNumber').value;
        var expiryMonth = document.getElementById('expiryMonth').value;
        var expiryYear = document.getElementById('expiryYear').value;
        var cvv = document.getElementById('cvv').value;

        // Current month and year
        var currentDate = new Date();
        var currentMonth = currentDate.getMonth() + 1; // getMonth() is zero-based
        var currentYear = currentDate.getFullYear();

        // Validate nameOnCard
        if (nameOnCard == "") {
            alert("Name on card is required.");
            return false;
        }

        // Validate cardNumber
        if (cardNumber.length != 16) {
            alert("Card number must be 16 digits.");
            return false;
        }

        // Validate expiryMonth and expiryYear
        if (expiryMonth < 1 || expiryMonth > 12 || expiryYear < currentYear || (expiryYear == currentYear && expiryMonth < currentMonth)) {
            alert("Expiry date is invalid or has already passed.");
            return false;
        }

        // Validate cvv
        if (cvv.length != 3) {
            alert("CVV must be 3 digits.");
            return false;
        }

        return true;
    };
</script>


<?php
// session_start();
$caller = 'paymentGatewayPOD.php';
include('searchForDriver.php');
ob_start();
    // include('base.php');
    include('database_connection.php');
    
    
    $id = $_SESSION['id'];
    if (isset($_POST['submit'])) {
        $name=$_POST['nameOnCard'];
        $number = $_POST['cardNumber'];
        $expiryMonth = $_POST['expiryMonth'];
        $expiryYear = $_POST['expiryYear'];
        $cvv = $_POST['cvv'];

        $query = mysqli_query($con, "INSERT INTO cardDetails (nameOnCard, numberOnCard, expiryMonth, expiryYear, cvv) VALUES ('$name', '$number', '$expiryMonth', '$expiryYear', '$cvv')") or die(mysqli_error($con));
        if (mysqli_affected_rows($con) > 0) {
            ob_end_clean();
            header('Location:searchForDriver.php');
        }
    }
ob_end_flush();
?>