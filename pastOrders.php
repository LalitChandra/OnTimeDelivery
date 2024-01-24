
<?php 
include('database_connection.php');
include('base.php');
session_start();
$id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Service Options</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
    table {
        width: 100%;
        border-spacing: 10px;
    }
    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
</style>
</head>
<body>
    <br><br>
    <div class="container mt-5">
        <h2 class="mb-3">Please choose a service:</h2>
        <form action="" method="post">
            <button type="submit" name="groceries" class="btn btn-primary mb-2">Groceries</button>
            <button type="submit" name="pickup_and_delivery" class="btn btn-secondary mb-2">Pickup and Delivery</button>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['groceries'])) {
            $sql = "select * from orderDetails where user_id='$id'";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>orderData</th>";
                echo "<th>storeAddress</th>";
                echo "<th>deliveryAddress</th>";
                echo "<th>orderDateTime</th>";
                echo "</tr>";

                while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>";
                        $orderData = json_decode($row["orderData"], true);
                        if (json_last_error() == JSON_ERROR_NONE) {
                            echo "<table class='table'>";
                            foreach ($orderData as $key => $value) {
                                echo "<tr>";
                                echo "<td><strong>" . htmlspecialchars($key)+1 . "</strong></td>";
                                if (is_string($value)) {
                                    echo "<td>" . htmlspecialchars($value) . "</td>";
                                } elseif (is_array($value) || is_object($value)) {
                                    // If the value is a JSON string, decode it
                                    // $jsonValue = json_decode($value, true);
                                    if (json_last_error() == JSON_ERROR_NONE) {
                                        // If the decoding was successful, iterate over the values
                                        $jsonValueString = "";
                                        foreach ($value as $jsonKey => $jsonVal) {
                                            $jsonValueString .= htmlspecialchars($jsonKey) . ": " . htmlspecialchars($jsonVal) . ", ";
                                        }
                                        echo "<td>" . rtrim($jsonValueString, ', ') . "</td>"; // Remove trailing comma and space
                                    }
                                }
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "Error: could not decode JSON data.";
                        }
                        echo "</td>";
                        echo "<td>" . htmlspecialchars($row["storeAddress"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["deliveryAddress"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["orderDateTime"]) . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    
            }
        }

        if (isset($_POST['pickup_and_delivery'])) {
            $sql = "select * from pod_data where user_id=$id";

            // Execute the query
                $result = $con->query($sql);

                // Start the table
                echo "<table class='table'>";
                echo "<tr><th>Source Location</th><th>Destination Location</th><th>Product Description</th><th>Product Weight</th><th>Date of pickup</th></tr>"; // replace with your actual column names

                // Loop through the results
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["source_location"] . "</td>"; // replace with your actual column names
                        echo "<td>" . $row["destination_location"] . "</td>";
                        echo "<td>" . $row["product_description"] . "</td>";
                        echo "<td>" . $row["product_weight"] . "</td>";
                        echo "<td>" . $row["dateOfOrder"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No results found</td></tr>";
                }
                echo "</table>";

        }
    }
    ?>
    
    <!-- Include Bootstrap JS and its dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>