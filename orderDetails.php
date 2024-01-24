<?php
include('database_connection.php');
include('base.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['button1'])) {
        $product = $_POST['product'];
        $quantity = $_POST['quantity'];
        
        $query = mysqli_query($con, "INSERT INTO temp_orderDetails (productName, quantity) VALUES ('$product', '$quantity')") or die(mysqli_error($con));
        if (mysqli_affected_rows($con) > 0) {
            // Insert operation successful
            header("Location: order_details.php");
        } else {
            // Insert operation failed
            echo "Go back and place the last order correctly please.";
        }
    } elseif (isset($_POST['button2'])) {
        $product = $_POST['product'];
        $quantity = $_POST['quantity'];

        $query = mysqli_query($con, "INSERT INTO temp_orderDetails (productName, quantity) VALUES ('$product', '$quantity')") or die(mysqli_error($con));
        if (mysqli_affected_rows($con) > 0) {
            // Insert operation successful
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
            // Insert operation failed
            echo "Go back and place the last order correctly please.";
        }
    }
}
?>

<button type="submit" name="actionButton" onclick="window.location.href='order_details.php'">Go Back and Add More Items</button>
<button type="submit" name="delete" onclick="window.location.href='delete_items.php'">Delete Any Item</button>
<button class = "btn btn-primary rounded-pill px-3" type="button" name="submit" onclick="window.location.href='paymentGateway.php'">That's it</button>
<?php
// include('footer.php');?>