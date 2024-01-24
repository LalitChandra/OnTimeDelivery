<?php session_start();

include('database_connection.php');

if(isset($_POST['login']));
{
    $user_unsafe=$_POST['email'];
    $pass_unsafe=$_POST['password'];

    $user = mysqli_real_escape_string($con,$user_unsafe);
    $pass = mysqli_real_escape_string($con,$pass_unsafe);

    $query=mysqli_query($con,"select * from userDetails where emailID='$user' and password='$pass'")or die(mysqli_error($con));

    $row=mysqli_fetch_array($query);

         $name=$row['emailID'];
         $counter=mysqli_num_rows($query);
         $id=$row['id'];

         if ($counter == 0)
         {
            echo "<script type='text/javascript'>alert('Invalid Username or Password!');
            document.location='login.php'</script>";
         }
         else
         {
            $_SESSION['id']=$id;
            $_SESSION['emailID']=$name;

            echo "<script type='text/javascript'>document.location='index.php'</script>";
         }

}
?>