<?php
    include('database_connection.php');
    $query = mysqli_query($con,"select * from walmart_products order by price desc limit 1") or die(mysqli_error($con));
    $row = mysqli_fetch_array($query);
    echo $row;

?>