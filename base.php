<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>On Time Delivery</title>
    <script src="https://kit.fontawesome.com/32f181d7c4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles\navbar.css">
    <link rel="stylesheet" href="styles\index.css">
    <link rel="stylesheet" href="styles\cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script type="text/javascript">
        function preventBack() {
            window.history.forward();
        }
        setTimeout("preventBack()",0);
        window.onunload = function(){null;}
    </script>
  <style>
    .logout-btn {
      background-color: #fff;
      border: none;
      cursor: pointer;
      transform: scale(1.2);
    }
  </style>
</head>
</head>
<body>
    <div id="navbar123">
        <div id="menubar123">
            <div id="menuLeft">
                <div><a href="index.php"><img src="logo.jpeg" alt="Logo" width="30" height="100"></a></div>
                <div class="menuTop">
                    <i class="fa-solid fa-location-dot" style="color: red;"></i>

                    <select class="options123">
                        <option>Windsor</option>
                        
                    </select></div>
            </div>
            <div id="menuRight">
                <a href="logout_process.php">
                    <button class="logout-btn">
                    <i class="fas fa-door-open"></i><p class="iconText123">Logout</p>
                  </button></a>
                <a href="profile.php">
                    <button class="logout-btn">
                    <i class="fas fa-user"></i><p class="iconText123">Profile</p>
                  </button></a>
            </div>
        </div>
    </div>
    
</body>