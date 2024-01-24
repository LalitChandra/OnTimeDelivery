<!DOCTYPE html>
<html>
<head>
    <title>User Information</title>
    <style>
    table {
        width: 100%;
        border-spacing: 10px;
    }
    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>

    <?php
    // Database connection settings
    include('profile.php');
    include('database_connection.php');
    // session_start();
    $id = $_SESSION['id'];
    // Fetch user data from the database
    $sql = "SELECT * FROM userDetails where id=$id";
    $result = $con->query($sql);
    $successMessage = '';
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>full_name</th>";
        echo "<th>phone_number</th>";
        echo "<th>emailID</th>";
        echo "<th>password</th>";
        echo "<th>Action</th>";
        echo "</tr>";

        $row = $result->fetch_assoc();
        echo "<tr>";
        echo "<td>" . $row["full_name"] . "</td>";
        echo "<td>" . $row["phone_number"] . "</td>";
        echo "<td>" . $row["emailID"] . "</td>";
        echo "<td>*******</td>";
        echo "<td><a href='?action=change_password&id=" . $row["id"] . "'>Change Password</a></td>";
        echo "</tr>";
        echo "</table>";
        echo $successMessage;
        if (isset($_GET['action']) && $_GET['action'] == 'change_password' && isset($_GET['id'])) {
            $userId = $_GET['id'];
            echo "<div class='container mt-5'>
            <form class='form-group' action='' method='post'>
                <div class='form-group'>
                    <label for='old_password'>Old Password:</label>
                    <input type='password' class='form-control' id='old_password' name='old_password'>
                </div>
                <div class='form-group'>
                    <label for='new_password'>New Password:</label>
                    <input type='password' class='form-control' id='new_password' name='new_password'>
                </div>
                <div class='form-group'>
                    <label for='confirm_new_password'>Confirm New Password:</label>
                    <input type='password' class='form-control' id='confirm_new_password' name='confirm_new_password'>
                </div>
                <button type='submit' class='btn btn-primary mt-3'>Change Password</button>
            </form>
        </div>";

            if (isset($_POST['old_password'], $_POST['new_password'], $_POST['confirm_new_password'])) {
                // The form has been submitted
                // Now retrieve the form data
            
                $oldPassword = $_POST['old_password'];
            
                // Continue with processing the form data...
                
                if($row['password']==$oldPassword) {
                    if ($_POST['new_password'] === $_POST['confirm_new_password']) {
                        $newPassword = $_POST['new_password'];

                
                        // Prepare an SQL UPDATE statement
                        $stmt = $con->prepare("UPDATE userDetails SET password = ? WHERE id = ?");
                        $stmt->bind_param("si", $newPassword, $id);
                
                        // Execute the UPDATE statement

                        if ($stmt->execute()) {
                            $successMessage = "Password updated successfully.";
                        } else {
                            $successMessage = "Error updating password: " . $stmt->error;
                        }
                
                    } else {
                        $successMessage = "New password and confirm new password do not match.";
                    }
                }
                else {
                    $successMessage = "please ensure you entered correct old password";
                    // goto line;
                }

            }
            // handle password change for $userId
        }
    } else {
        $successMessage= "No data found.";
    }
if (!empty($successMessage)) {
    echo "<div id='successModal' class='modal' tabindex='-1' role='dialog'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title'>Success</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <p>$successMessage</p>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                    </div>
                </div>
            </div>
        </div>";
}
   
    $con->close();
    ?>


</body>
</html>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<!-- <script type="text/javascript">
    $(document).ready(function() {
        $(".alert").first().hide().fadeIn(200).delay(5000).fadeOut(1000, function () { $(this).remove(); });
    });
</script> -->
<script>
    $(document).ready(function() {
    $('#successModal').modal('show');

    setTimeout(function() {
        $('#successModal').modal('hide');
    }, 5000); // 5 seconds
});

</script>