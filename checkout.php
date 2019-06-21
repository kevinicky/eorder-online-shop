<?php
session_start();
// pre_r($_SESSION);

function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="bootstrap-3.3.4-dist/js/jquery-1.11.3.min.js"></script>
    <script src="bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="bootstrap-3.3.4-dist/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <title>eOrder</title>
</head>

<body>
    <div class="container">
        <div class="panel-heading panel panel-warning " style="background-color: #ff851b;color: white">
            <h4 style="color: white">Checkout</h4>
        </div>
        <form method="post" action="invoice.php" id="myForm">
            <div class="form-group">
                <label for="name">Full name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email">
                <small id="emailHelp" class="form-text text-muted">ex : niki@example.com</small>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone Number">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3" placeholder="Address"></textarea>
            </div>

            <div class="form-group">
                <label for="courier">Courier Type</label>
                <select class="form-control" id="courier" name="courier">
                    <option>Reguler</option>
                    <option>Express</option>
                </select>
            </div>

            <div class="form-group form-check">
                <label class="checkbox-inline">
                    <input type="checkbox" class="form-check-input" required> Check Me Out
                </label>
            </div>
            <a href="invoice.php">
                <button type="submit" class="btn btn-warning btn-sm">Submit</button>
            </a>
            <a href="home.php">
                <button type="button" class="btn btn-success btn-sm">Back</button>
            </a>
        </form>
        <script>
            document.getElementById('myForm').onsubmit=function(){
                if (!this.name.value || !this.email.value || !this.phone.value || !this.address.value){
                    alert("You must fill all field to continue");
                    return false;
                }
                return true;
            }
        </script>
    </div>
</body>

</html>