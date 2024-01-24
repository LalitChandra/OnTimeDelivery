<?php session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    
</head>
<body>
    <div style="width:150px;margin:auto;height:500px;margin-top:300px">

    <?php
     include('database_connection.php');
     session_unset();
     session_destroy();

     echo '<meta http-equiv="refresh" content="2;url=login.php">';
     echo '<progress max=100><strong>Progress: 60% done.</strong></progress><br>';
     echo '<span class="itext">Logging out please wait!...</span>';


    ?>
    </div>

</body>
</html>
