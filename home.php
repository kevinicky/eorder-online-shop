<?php
session_start();
$product_id = array();
// session_destroy();

if (filter_input(INPUT_POST, 'add_to_cart')) {
    if (isset($_SESSION['shopping_cart'])) {
        $count = count($_SESSION['shopping_cart']);
        $product_id = array_column($_SESSION['shopping_cart'], 'id');

        if (!in_array(filter_input(INPUT_GET, 'id'), $product_id)) {
            $_SESSION['shopping_cart'][$count] = array(
                'id' => filter_input(INPUT_GET, 'id'),
                'name' => filter_input(INPUT_POST, 'name'),
                'price' => filter_input(INPUT_POST, 'price'),
                'quantity' => filter_input(INPUT_POST, 'quantity')
            );
        } else {
            for ($i = 0; $i < count($product_id); $i++) {
                if ($product_id[$i] == filter_input(INPUT_GET, 'id')) {
                    $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                }
            }
        }
    } else {
        $_SESSION['shopping_cart'][0] = array(
            'id' => filter_input(INPUT_GET, 'id'),
            'name' => filter_input(INPUT_POST, 'name'),
            'price' => filter_input(INPUT_POST, 'price'),
            'quantity' => filter_input(INPUT_POST, 'quantity')
        );
    }
}

if (filter_input(INPUT_GET, 'action') == 'delete') {
    foreach ($_SESSION['shopping_cart'] as $key => $product) {
        if ($product['id'] == filter_input(INPUT_GET, 'id')) {
            unset($_SESSION['shopping_cart'][$key]);
        }
    }
    $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
}

if (filter_input(INPUT_GET, 'action') == 'plus') {
    foreach ($_SESSION['shopping_cart'] as $key => $product) {
        if ($product['id'] == filter_input(INPUT_GET, 'id')) {
            $_SESSION['shopping_cart'][$key]['quantity']++;
        }
    }
}

if (filter_input(INPUT_GET, 'action') == 'min') {
    foreach ($_SESSION['shopping_cart'] as $key => $product) {
        if ($product['id'] == filter_input(INPUT_GET, 'id')) {
            if ($_SESSION['shopping_cart'][$key]['quantity'] - 1 >= 1) {
                $_SESSION['shopping_cart'][$key]['quantity']--;
            }
        }
    }
}

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
    <nav class="navbar-fixed-top navbar-default">
        <div class="container-fluid bg-warning">
            <div class="navbar-header">
                <div class="navbar-left">
                    <img src="Assets/logo1.png" alt="">
                </div>
            </div>
            <div>
                <ul class="nav navbar-nav navbar-right nav-item">
                <li><a href="#" style="color: white;">Home</a></li>
                <li><a href="about.php" style="color: white;">About</a></li>
                <li><a href="#footer" style="color: white;">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top:5%;">
        <?php
        $data = array(
            array(
                'id' => 1,
                'name' => 'Glorious GMMK',
                'price' => 250000,
                'image' => 'keyboard.jpg'
            ),
            array(
                'id' => 2,
                'name' => 'Logitech G203 Prodigy',
                'price' => 215000,
                'image' => 'mouse.jpg'
            ),
            array(
                'id' => 3,
                'name' => 'LG Monitor 24" 24M38H',
                'price' => 1150000,
                'image' => 'monitor.jpg'
            ),
            array(
                'id' => 4,
                'name' => 'Notebook usb speaker',
                'price' => 120000,
                'image' => 'speaker.jpg'
            ),
            array(
                'id' => 5,
                'name' => 'Adobe Creative Suit 6',
                'price' => 785400,
                'image' => 'adobecs6.jpg'
            ),
            array(
                'id' => 6,
                'name' => 'Sandisk Crusher Blade 16GB',
                'price' => 100500,
                'image' => 'sundisk.jpg'
            )
        );
        ?>
        <div class="row">
            <!-- show mini shopping cart -->
            <div class="col-sm-4">
                <div class="panel panel-warning positon-fixed">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-shopping-cart">
                            Cart
                        </span>
                    </div>
                    <table class="table">
                        <thead class="thead">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(!empty($_SESSION['shopping_cart'])):
                                $i = 1;
                                foreach($_SESSION['shopping_cart'] as $key => $product):

                            ?>
                            <tr>
                                <th scope="row"><?php echo $i ?></th>
                                <td><?php echo $product['name'] ?></td>
                                <td><?php echo $product['quantity'] ?></td>
                            </tr>
                            <?php
                                endforeach;
                            endif;
                            ?>
                        </tbody>
                    </table>
                    <?php
                    if (!empty($_SESSION['shopping_cart'])):
                    ?>
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#viewCart" data-backdrop="static" data-keyboard="false"> View Cart </button>
                    <a href="checkout.php">
                        <button type="button" class="btn btn-success btn-sm">Check Out</button>
                    </a>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
            <!-- carousel -->
            <div class="col-sm-8">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        Our Product
                    </div>
                    <div class="panel-body">
                        <!-- bootstrap carousel -->
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <!-- Carousel indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img src="Assets/1.jpg">
                                    <div class="carousel-caption">
                                        <h3>Intel Core I9 Unlocked</h3>
                                        <p>When paired with Intel® Optane™ memory, accelerates the loading and launching of the games you play.
                                        </p>
                                    </div>
                                </div>
                                <div class="item">
                                    <img src="Assets/2.jpg">
                                    <div class="carousel-caption">
                                        <h3>AMD Ryzen 7 2700X </h3>
                                        <p>AMD’s ultimate cooling solution for Ryzen™ 7 processors features per-RGB light control, direct-contact heat pipes, and a thin profile for improved compatibility.
                                        </p>
                                    </div>
                                </div>
                                <div class="item">
                                    <img src="Assets/3.jpg">
                                    <div class="carousel-caption">
                                        <h3>Nvidia GeForce 1080TI</h3>
                                        <p>The GeForce® GTX 1080 Ti is our flagship 10-series gaming GPU.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <a href="#myCarousel" class="carousel-control left" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a href="#myCarousel" class="carousel-control right" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- view shopping cart -->
        <div class="modal fade" id="viewCart" role="dialog" data-keyboard="false">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style="color:white;">Your Shopping Cart</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Optional</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($_SESSION['shopping_cart'])) :
                                    $totalPrice = 0;
                                    $totalQty = 0;
                                    foreach ($_SESSION['shopping_cart'] as $key => $product) :
                                        ?>
                                        <tr>
                                            <td><?php echo $product['name'] ?></td>
                                            <td><?php echo number_format($product['price'], 2) ?></td>
                                            <td><?php echo $product['quantity'] ?></td>
                                            <td>
                                                <a href="home.php?action=plus&id=<?php echo $product['id'] ?>">
                                                    <span class="glyphicon glyphicon-plus-sign"></span>
                                                </a>
                                                <a href="home.php?action=min&id=<?php echo $product['id'] ?>">
                                                    <span class="glyphicon glyphicon-minus-sign"></span>
                                                </a>
                                                <a href="home.php?action=delete&id=<?php echo $product['id'] ?>">
                                                    <span class="glyphicon glyphicon-remove-sign"></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                        $totalPrice = $totalPrice + ($product['quantity'] * $product['price']);
                                        $totalQty = $totalQty + $product['quantity'];
                                    endforeach;
                                endif;
                                ?>
                            </tbody>
                            <tfoot>
                                <td>Total</td>
                                <td><?php echo number_format($totalPrice, 2) ?></td>
                                <td><?php echo $totalQty ?></td>
                            </tfoot>
                        </table>
                    </div>
                    <div class="modal-footer bg-warning">
                        <a href="checkout.php">
                            <button type="button" class="btn btn-success btn-sm">Check Out</button>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- show item per row -->
    <?php
    $count = 0;
    foreach ($data as $key => $product) :
        if ($count % 4 == 0) {
            echo '<div class="row">';
        }
        ?>
        <div class="col-sm-4 col-md-3">
            <form method="POST" action="home.php?action=add&id=<?php echo $product['id']; ?>">
                <div class="products">
                    <img src="Assets/<?php echo $product['image'] ?>" alt="" class="img-responsive">
                    <h4><?php echo $product['name'] ?></h4>
                    <h4><?php echo number_format($product['price'], 2) ?></h4>
                    <label for="qty">Quantity</label>
                    <input type="text" name="quantity" id="qty" class="form-control" value="1">
                    <input type="hidden" name="name" value="<?php echo $product['name'] ?>">
                    <input type="hidden" name="price" value="<?php echo $product['price'] ?>">
                    <input type="submit" name="add_to_cart" class="btn-warning" value="Add to Cart" style="margin-top:5px;">
                </div>
            </form>
        </div>
        <?php
        if ($count % 4 == 3) {
            echo '</div>';
        }
        $count++;
    endforeach;
    if ($count % 4 > 0) {
        echo '</div>';
    }
    ?>
    <!-- Footer -->
    <div class="container text-center text-md-left mt-5" id="footer">
        <div class="row mt-3 dark-grey-text">
            <div class="col-md-3 col-lg-4 col-xl-3 mb-4">
                <h6 class="text-uppercase font-weight-bold">E-Order</h6>
                <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                <p>E-Order is computer online shop that provide all of your needs about computer.</p>
            </div>
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                                  
            </div>
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                <h6 class="text-uppercase font-weight-bold">Products</h6>
                <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                <p>
                    <a class="dark-grey-text" href="#!">Hardware</a>
                </p>
                <p>
                    <a class="dark-grey-text" href="#!">Software</a>
                </p>
                <p>
                    <a class="dark-grey-text" href="#!">Computer Networking</a>
                </p>
                <p>
                    <a class="dark-grey-text" href="#!">Gamming Gear</a>
                </p>    
            </div>
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                <h6 class="text-uppercase font-weight-bold">Contact</h6>
                <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                <p><i class="glyphicon glyphicon-home mr-3"></i> K.H Syahdan No.1</p>
                <p><i class="glyphicon glyphicon-envelope mr-3"></i> helpcenter@eorder.com</p>
                <p><i class="glyphicon glyphicon-earphone mr-3"></i> 081234567890</p>                    
            </div>
        </div>
    </div>

    <div class="footer-copyright text-center text-black-50 py-3">© 2019 Copyright:
        <a class="dark-grey-text" href="#"> eorder team</a>
    </div>
</body>

</html>
