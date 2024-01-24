<!DOCTYPE html>
<head>
    <title> Order For</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f1f1f1;
            text-align: center;
        }

        label,
        input[type="submit"] {
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
        }

        input[type="submit"]:hover {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        #footer {
            width: 100%;
            background-color: #f1f1f1;
            padding: 20px;
            text-align: center;
        }

        #formContainer {
        display: flex;
        flex-direction: column;
        align-items: center;
        max-width: 400px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f1f1f1;
        margin-top: 20px;
        margin-bottom: 20px;
    }
    #formContainer form {
        margin-top: 700px; /* Add margin at the top of the form */
    }
    </style>
</head>
<?php include('base.php'); ?>
<body>
<div id="formContainer">
<center>
    <form method="post" action="deliveryData.php" name="orderFor">
        <label for="full_name">Receiver's Name</label>
        <input type="text" name="full_name" id="full_name"/><br/><br/>
        <label for="phone">Receivers Phone Number</label>
        <input type="number" name="phone" required/><br/><br/>
        <label for="dest_address">Receiver's Address</label>
        <input type="text" name="dest_address" required/><br/><br/>
        <label for="store_address">Store Address</label>
        <input type="text" name="store_address" required/><br/><br/>
        <input type="submit" value="Proceed to Items"></input>
    </form>
</center>
</div>
<?php include('footer.php'); ?>
</body>
</html>

