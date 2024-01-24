<?php
session_start();

include('database_connection.php');

if(isset($_POST['signup']));
{
    $fullname = $_POST['fullname'];
    $email_unsafe=$_POST['email'];
    $pass_unsafe=$_POST['password'];
    $phone_unsafe=$_POST['phone'];
    
    $pass = mysqli_real_escape_string($con,$pass_unsafe);
    $name = mysqli_real_escape_string($con,$fullname);
    $email = mysqli_real_escape_string($con,$email_unsafe);
    $phone = mysqli_real_escape_string($con,$phone_unsafe);

    $query=mysqli_query($con,"insert into userDetails (full_name, emailID, password, phone_number) VALUES ('$name', '$email', '$pass', '$phone')")or die(mysqli_error($con));
    $query=mysqli_query($con,"select * from userDetails where emailID='$email' and password='$pass'")or die(mysqli_error($con));

    $row=mysqli_fetch_array($query);

         $name=$row['emailID'];
         $counter=mysqli_num_rows($query);
         $id=$row['id'];

         if ($counter == 0)
         {
            echo "<script type='text/javascript'>alert('Invalid Email or Password!');
            document.location='login.php'</script>";
         }
         else
         {
            $_SESSION['id']=$id;
            $_SESSION['emailID']=$email;

            echo "<script type='text/javascript'>document.location='index.php'</script>";
         }

}
?>