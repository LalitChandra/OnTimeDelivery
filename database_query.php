<?php
include("database_connection.php");
$sql = "SELECT id, driverName, driverPhoneNumber, carModel FROM driversTable WHERE driverStatus='Available' ORDER BY id DESC LIMIT 1";
$result = $con->query($sql);
while(true) {
if ($result->num_rows > 0) {
    // Output data of each row
    $row = $result->fetch_assoc();
    // echo $row["driverName"]. "  ". $row["driverPhoneNumber"]. " ". $row["carModel"];
    // Change driverStatus to 'busy'
    $driverId = $row['id'];
    $updateSql = "UPDATE driversTable SET driverStatus='busy' WHERE id=$driverId";
    if ($con->query($updateSql) === TRUE) {
       echo "Driver assigned successfully. Below are the details of the driver.";
       echo "--------------------------------";
       echo "Driver Name: ".$row['driverName']. " Driver Phone Number".$row['driverPhoneNumber']; 
       sleep(15);
       header("Location: index.php");
    } else {
        echo "Error updating driver status: " . $con->error;
    }
} else {
    echo "<html>
    <head>
        <title>Loading...</title>
        <style>
            /* Style your loading page as needed */
            #loading-icon {
                width: 50px;
                height: 50px;
                /* You can use any loading GIF */
                background: url('loading.gif');
            }
        </style>
    </head>
    <body>
        <div id='loading-icon'></div>
    </body>
</html>";
    sleep(30);
}
}
?>