<?php
include('database_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text_input = $_POST['textInput'];
    $image_input = $_FILES['imageInput'];

    if(isset($image_input) && $image_input['error'] == 0){
        // Open a file for binary reading
        $imageSize = $image_input['size']; // This is the size of the uploaded file in bytes
        echo "The size of the uploaded file is: " . $imageSize . " bytes.";
        $file = fopen($image_input['tmp_name'], 'rb');

        // Read the file
        $image_content = fread($file, filesize($image_input['tmp_name']));

        // Escape special characters in a string for use in an SQL statement
        $image_content = mysqli_real_escape_string($con, $image_content);
        
        // Close the file
        fclose($file);

        // Execute the SQL statement
        $sql = "INSERT INTO tbl_images (billImage) VALUES ('$image_content')";

        if($con->query($sql)){
            $id = $con->insert_id; // Get the ID of the last inserted row
            $sql = "SELECT billImage FROM tbl_images WHERE id = $id";
            $result = $con->query($sql);
            if ($result) {
                $row = $result->fetch_assoc();
                // header("Content-type: image/png"); // adjust with appropriate image type
                // echo $row['billImage'];

                $imageData = base64_encode($row['billImage']);
                echo '<img src="data:image/png;base64,' . $imageData . '">';
                
            } else {
                echo "Error retrieving image: " . $con->error;
            }
        }else{
            echo "Error inserting record: " . $con->error;
        }
    }else{
        echo "No file uploaded or there was an upload error.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Bill Payment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Submit the bill</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="textInput">Enter the bill amount</label>
                <input type="text" class="form-control" id="textInput" name="textInput" placeholder="DIGITS only">
            </div>
            <div class="form-group">
                <label for="imageInput">Upload Image:</label>
                <input type="file" class="form-control-file" id="imageInput" name="imageInput">
            </div>
            <div class="form-group">
                <input type="submit" id="submit" name="submit">
            </div>
            
        </form>
        
    </div>
    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
