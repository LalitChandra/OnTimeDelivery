<!DOCTYPE html>
<head>
    <title>Order Details</title>
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

        
        input[type="submit"] {
            margin-top: 20px;
            margin-bottom: 10px;
        }
        label,
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
        margin-top: 600px; /* Add margin at the top of the form */
    }
    .required-field {
          color: red;
        }
    </style>
</head>
<?php include('base.php'); ?>
<body>
<div id="formContainer">
    <form name="order_form" method="post" action="orderDetails.php" autocomplete="off">
        <label for="product">Product Name:</label>
        <input type="text" id="product" name="product" required>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required>

        <input type="submit" name="button1" value="Add More"></input>
        <input type="submit" name="button2" value="Next"></input>

    </form>
</div>
</body>
<?php include('footer.php'); ?>