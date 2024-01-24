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
        height: 300px;
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
</style>
</head>
<body style="height: 100vh; display: flex; align-items: center; justify-content: center;">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2> A default 15$ deposit amount will be deducted from your account</h2>
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
        if (cardNumber.length != 16 || cardNumber.length==0) {
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
$caller = 'paymentGateway.php';
include('searchForDriver.php');
session_start();
ob_start();
    // include('base.php');
    include('database_connection.php');
    include('base.php');
    
    $id = $_SESSION['id'];
    if (isset($_POST['submit'])) {
        $name=$_POST['nameOnCard'];
        $number = $_POST['cardNumber'];
        $expiryMonth = $_POST['expiryMonth'];
        $expiryYear = $_POST['expiryYear'];
        $cvv = $_POST['cvv'];

        $query = mysqli_query($con, "INSERT INTO cardDetails (nameOnCard, numberOnCard, expiryMonth, expiryYear, cvv) VALUES ('$name', '$number', '$expiryMonth', '$expiryYear', '$cvv')") or die(mysqli_error($con));
        if (mysqli_affected_rows($con) > 0) {            
        $sql = "SELECT productName, quantity FROM temp_orderDetails";
        $result = $con->query($sql);

        /// for groceries
        $orderData = array();

            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $orderData[] = $row;
            }
            }
        $orderData_json = json_encode($orderData);
        $result_store_address = $con->query("SELECT store_address FROM deliveryData");

        if ($result_store_address->num_rows > 0) {
        // Output data of each row
            while($row = $result_store_address->fetch_assoc()) {
                $store_address = $row['store_address'];
                break; // We only want the first row
            }
        } else {
            echo "No results for store address";
        }

        // Execute the delivery_address query
        $result_delivery_address = $con->query("SELECT delivery_address FROM deliveryData");

        if ($result_delivery_address->num_rows > 0) {
        // Output data of each row
        while($row = $result_delivery_address->fetch_assoc()) {
            $delivery_address = $row['delivery_address'];
            break;
        }
        } else {
            echo "No results for delivery address";
        }
        $date = date('Y-m-d H:i:s');
        $stmt = $con->prepare("INSERT INTO orderDetails (user_id, orderData, storeAddress, deliveryAddress, orderDateTime) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $id, $orderData_json, $store_address, $delivery_address, $date);
    
        if ($stmt->execute()) {
            ob_end_clean();
            // echo "New record created successfully";
            header('Location: searchForDriver.php');
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
            
        }
        
    }
ob_end_flush();
?>