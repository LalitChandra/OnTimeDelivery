<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="styles/style.css">
    <script type="text/javascript">
        function preventBack() {
            window.history.forward();
        }
        setTimeout("preventBack()",0);
        window.onunload = function(){null;}
    </script>
</head>

<body>
    <!-- <div class="hero"> -->
        <nav>
        <a href="index.php"><img src="logo.jpeg" class="logo" id="home" onclick= "gohome()"></a>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Features</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <img src="/profile-menu-img/images/user1.png" class="user-pic" onclick="toggleMenu()">
            <?php 
            include('database_connection.php');
            session_start();
            $id = $_SESSION['id'];
            $query = "select * from userDetails where id='$id'";
            $result = mysqli_query($con, $query);
            $user_name = "";
                if(mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $username = $row['full_name']; 
            }
            echo "
            <div class='sub-menu-wrap' id='subMenu'>
                <div class='sub-menu'>
                    <div class='user-info'>
                        <img src='/profile-menu-img/images/user1.png'>
                        <h3>$username</h3>
                    </div>
                    <hr>

                        <a href='editProfile.php' class= 'sub-menu-link'>
                            <img src='/profile-menu-img/images/profile.png'>
                            <p> Edit Profile</p>
                            <span>></span>
                        </a>
                        <a href='pastOrders.php' class= 'sub-menu-link'>
                            <img src='/profile-menu-img/images/purchased.png'>
                            <p> Past Orders</p>
                            <span>></span>
                        </a>
                        <a href='logout_process.php' class= 'sub-menu-link'>
                            <img src='/profile-menu-img/images/purchased.png'>
                            <p> Logout</p>
                            <span>></span>
                        </a>
                </div>
            </div>"?>
        </nav>
    <!-- </div> -->
<script>
    let subMenu = document.getElementById("subMenu");
    let home = document.getElementById("home");
    function gohome() {
        
    }
    function toggleMenu(){
        subMenu.classList.toggle("open-menu");
    }
</script>
</body>