<HEAD>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #4CAF50;
        color: white;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    tr:hover {
        background-color: #ddd;
    }
</style>

</HEAD>

<?php
include('database_connection.php');
include('driverDashboard.php');
$id = $_SESSION['id'];

$result = $con->query("select * from driversTable where id=$id");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $order_id = $row['order_id'];
    if($row['order_id']==0) {
        echo "no active orders found";
    }
    else {
        $service = $row['service'];
        if($service == "paymentGateway.php"){
        
        $result = $con->query("select * from orderDetails where order_id = $order_id");
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
                    echo "</table><br><br>";
                    echo "<br>";
                    echo "<a href='projectBillPayment.php' class='btn btn-primary'>Items Got Picked</a>";
        }
        }
        else {
            $sql = mysqli_query($con, "select * from orderDetails where order_id = $order_id");
            $result = $con->query($sql);
        }
    }
}
?>