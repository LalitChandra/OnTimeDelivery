<!DOCTYPE html>
<head>
    <title>Delete Items</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }
        .form-container {
            max-width: 500px;
            margin: 0 auto;
        }
    </style>

</head>
<?include 'profile.php'?>
<body>

<div class="form-container">
        <form method="post" action="" name="deleteOrder" id="deleteOrder">
            <div class="form-group">
                <label for="productName">Product Name</label>
                <input type="text" class="form-control" name="productName" id="productName" placeholder="Enter item you want to delete">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-danger" name="submit" value="Delete this item">
                <input type="submit" class="btn btn-primary" name="Next" value="Next">
            </div>
        </form>
</div>
<?php
    // Check if the form is submitted
    include('database_connection.php');
    if(isset($_POST['submit'])){
        // Retrieve the product name from the form submission
        $productName = $_POST['productName'];
        // Construct the delete query
        $sql = "DELETE FROM temp_orderDetails WHERE productName = '$productName'";

        // Execute the delete query
        if ($con->query($sql) === TRUE) {
            echo "Deleted this item : ".$productName;
            echo "<br>";

            $sql = "SELECT productName, quantity FROM temp_orderDetails";
            $result = $con->query($sql);
            echo '<style>
body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    background-color: #f2f2f2;
    font-family: Arial, sans-serif;
}
table {
    border-collapse: collapse;
    width: 50%;
    border: 1px solid #ddd;
}
th, td {
    text-align: left;
    padding: 8px;
}
th {
    background-color: #4CAF50;
    color: white;
}
</style>';
            
            if ($result->num_rows > 0) {
                // Output data of each row
                echo "<center>";
                echo "<table style='border: 1px solid black; width: 50%;'>";
                echo "<tr><th>Product Name</th><th>Product Quantity</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["productName"] . "</td>";
                    echo "<td>" . $row["quantity"] . "</td>";
                    echo "</tr>";
                }
                echo "</table> </center>";
            } else {
                echo "0 results";
            }
        } else {
            echo "Error deleting record: " . $con->error;
        }

        // Close the database connection
        $con->close();
    }
    else if(isset($_POST['Next'])){
       header("Location: paymentGateway.php"); 
    }
    ?>
</body>