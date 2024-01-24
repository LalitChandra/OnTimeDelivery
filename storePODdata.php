
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .full-height {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f9f9f9;
            margin: 0;
        }
        .spinner {
            border: 16px solid #f3f3f3;
            border-top: 16px solid #3498db;
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="container full-height">
<?php
session_start();
include('profile.php');
include ('database_connection.php');
$host = 'localhost';
$db   = 'ontimedelivery';
$user = 'root';
$pass = 'OlcB@0310';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

while (true) {
    // SQL query to check if any driver is available
    $sql = 'SELECT * FROM `driversTable` WHERE `driverStatus` = "available" LIMIT 1';
    $stmt = $pdo->query($sql);

    if ($stmt->rowCount() > 0) {
        // Fetching the first available driver's details
        $driver = $stmt->fetch();
        $id = $driver['id'];
        // Present the driver details
        $query = "Update driversTable SET driverStatus='busy' where id=$id";
        $stmt = $pdo->query($query);
        echo "<div class='alert alert-primary' role='alert' style='background-color: #9ec6ff; color: #000;'>";
    echo "<h4 class='alert-heading' style='color: #4a4a4a;'>Good News!</h4>";
    echo "<p style='color: #000;'>A driver got assigned to place your order: <strong style='color: #0056b3;'>" . $driver['driverName'] . "</strong></p>";
    echo "<hr>";
    echo "<p class='mb-0' style='color: #000;'>Their phone number is: <strong style='color: #0056b3;'>" . $driver['driverPhoneNumber'] . "</strong></p>";
    echo "<p class='mb-0' style='color: #000;'>Feel free to contact if anything specific is needed.</p>";
    echo "<br/>";
    echo "<a href='index.php' class='btn btn-dark'>Want to go to home page?</a>";
    echo "</div>";

    $id = $_SESSION['id'];
    $sql = "SELECT productName, quantity FROM temp_orderDetails";
    $result = $con->query($sql);

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
        break; // We only want the first row
    }
    } else {
        echo "No results for delivery address";
    }

    $stmt = $con->prepare("INSERT INTO orderDetails (user_id, orderData, storeAddress, deliveryAddress) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $id, $orderData_json, $store_address, $delivery_address);
    
    if ($stmt->execute()) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $stmt->error;
      }
    // $stmt = $pdo->prepare($query);
    // $stmt->execute(['id' => $id]);

        break;
    } else {
    //     echo "<script>
    // setTimeout(function(){
    //     document.getElementById('spinner').style.display='none'; 
    // }, 10000);
    // </script>";
    // echo "<div id='spinner' class='spinner'></div>";
    sleep(5);
    continue;
    }
}
?>
</div>
</body>