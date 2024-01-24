<?php

include('database_connection.php');
include('profile.php');
session_start();
$id = $_SESSION['id'];
if(isset($_POST['POD'])); {
    $slocation_unsafe = $_POST['slocation'];
    $dlocation_unsafe = $_POST['dlocation'];
    $product_description_unsafe = $_POST['p_description'];
    $product_weight_unsafe = $_POST['weight'];

    $slocation = mysqli_real_escape_string($con, $slocation_unsafe);
    $dlocation = mysqli_real_escape_string($con, $dlocation_unsafe);
    $pdescription = mysqli_real_escape_string($con, $product_description_unsafe);
    $pweight = mysqli_real_escape_string($con, $product_weight_unsafe);

    $sql = "INSERT INTO POD_data (source_location, destination_location, product_description, product_weight, user_id)
    VALUES ('$slocation', '$dlocation', '$pdescription', '$pweight', '$id');";
    if(mysqli_query($con, $sql)) {
        header("Location: paymentGatewayPOD.php");
    }
    if(isset($_POST['more'])) {
        header("Location: POD.php");
    }
} 
?>