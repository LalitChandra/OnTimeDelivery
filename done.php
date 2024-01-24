<?php
echo "Done";
include('database_connection.php');

// Retrieve the data sent from JavaScript
$data = json_decode(file_get_contents('php://input'), true);

// Extract the product details
$store_name = $data['store_name'];
$store_description = $data['location_description'];
$product_name = $data['product'];
$product_quantity = $data['product_quantity'];

$storeName = mysqli_real_escape_string($con,$store_name);
$storeDescription = mysqli_real_escape_string($con,$store_description);
$productName = mysqli_real_escape_string($con,$product_name);
$productQuantity = mysqli_real_escape_string($con,$product_quantity);

// $conn = mysqli_connect($host, $user, $password, $database);
// if (!$conn) {
//   die('Error connecting to the database: ' . mysqli_connect_error());
// }

// Insert the data into the MySQL database
$sql = "INSERT INTO order_details (store_name, store_description, product_name, quantity) VALUES ('$storeName','$storeDescription','$product_name', '$product_quantity')";

if (mysqli_query($con, $sql)) {
  echo 'Data inserted successfully';
} else {
  echo 'Error inserting data: ' . mysqli_error($con);
}

// Close the database connection
mysqli_close($con);
?>
