<!DOCTYPE html>
<head>
    <title>Pickup Service</title>

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
    <form method="post" action="POD_details.php" name="POD">
        <label for="slocation">Pickup Location</label>
        <input type="text" name="slocation"/></br>
        <label for="dlocation">Drop off Location</label>
        <input type="text" name="dlocation"/></br>
        <label for="p_description">Product Description</label>
        <input type="text" name="p_description"/></br>
        <label for="weight">Expected Weight</label>
        <input type="number" name="weight"/></br>
        <input type="submit" value="Pickup and Deliver" />
    </form>
</center>
</div>
</body>
<?php include('footer.php');?>