<?php

include('database_connection.php');
include('profile.php');
if(isset($_POST['orderFor']));
{
    $truncate1 = "truncate deliveryData;";
    $truncate2 = "truncate temp_orderDetails;";
    if(mysqli_query($con, $truncate1) && mysqli_query($con, $truncate2))
    {
    $name_unsafe = $_POST['full_name'];
    $phone_unsafe = $_POST['phone'];
    $dest_unsafe = $_POST['dest_address'];
    $store_unsafe = $_POST['store_address'];
    

    $name = mysqli_real_escape_string($con, $name_unsafe);
    $phone  = mysqli_real_escape_string($con, $phone_unsafe);
    $dest = mysqli_real_escape_string($con, $dest_unsafe);
    $store = mysqli_real_escape_string($con, $store_unsafe);

    $sql = "INSERT INTO deliveryData (full_name, phone_number, delivery_address, store_address) VALUES ('$name','$phone','$dest','$store');";
    if (mysqli_query($con, $sql)) {
        header("Location: order_details.php");
      } else {
        echo 'Error inserting data: ' . mysqli_error($con);
      }
    }
      // Close the database connection
       mysqli_close($con);
}
?>