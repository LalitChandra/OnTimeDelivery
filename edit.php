<?php
include('database_connection.php');
include('profile.php');
session_start();
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    // You can use the $id variable in this file
}
