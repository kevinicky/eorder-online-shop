<?php
session_start();
if (!empty($_SESSION['shopping_cart'])) {
    $totalPrice = 0;
    foreach ($_SESSION['shopping_cart'] as $key => $product) {
        $totalPrice = $totalPrice + ($product['quantity'] * $product['price']);
    }
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
            <h4 style="color: white">Invoice</h4>
        </div>
        <div class="row pad-top-botm client-info">
            <div class="col-lg-6 col-md-6 col-sm-6">

                <b>Name : </b>
                <strong><?php echo $_POST['name'] ?></strong>
                <br>
                <b>Address : </b> <?php echo $_POST['address'] ?>
                <br>
                <b>Email : </b> <?php echo $_POST['email'] ?>
                <br>
                <b>Phone No : </b> <?php echo $_POST['phone'] ?>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <h4><strong>Payment Details</strong></h4>
                <b>Bill Amount : </b> IDR <?php echo number_format($totalPrice, 2) ?>
                <br>
                <b>Payment Status : </b> Paid
                <br>
                <b>Courier Type : </b> <?php echo $_POST['courier'] ?>
                <br>
                <b>Bill Date : </b> <?php echo date("d M Y") ?>
                <br>
                <b>Delivery Date : </b> <?php echo date("d M Y") ?>
            </div>
        </div>
        <div class="row" style="margin-top: 10%;">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($_SESSION['shopping_cart'])) :
                                $i = 0;
                                foreach ($_SESSION['shopping_cart'] as $key => $product) :
                                    ?>
                                    <tr>
                                        <td><?php echo ($i + 1) ?></td>
                                        <td><?php echo $product['name'] ?></td>
                                        <td><?php echo $product['quantity'] ?></td>
                                        <td>IDR <?php echo number_format($product['price'], 2) ?></td>
                                        <td>IDR <?php echo number_format(($product['price'] * $product['quantity']), 2) ?></td>
                                    </tr>
                                <?php
                            endforeach;
                        endif;
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <a href="home.php">
        <?php
            session_destroy();
        ?>
        <button class="btn btn-warning btn-md" style="float: right; margin-right: 10%; margin-top: 3%;">Back to Home</button>
    </a>
</body>

</html>