<?php

session_start();
$_SESSION['user'] = 'yes';

if(isset($_GET['product_category'])) {
    $prodCat = $_GET['product_category'];

    
        try {
        
        require "database/dbConnect.php";	//CONNECT to the database
        if ($prodCat !== "null") {
        $sql = "SELECT * FROM products
                WHERE product_category = :prodCat";
        } else {
            $sql = "SELECT * FROM products";
        }
        
        //PREPARE the SQL statement
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':prodCat', $prodCat);
        
        //EXECUTE the prepared statement
        $stmt->execute();		
        
        //Prepared statement result will deliver an associative array
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        }

        catch(PDOException $e) {
        $message = "There has been a problem. The system administrator has been contacted. Please try again later.";

        error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
        error_log($e->getLine());
        error_log(var_dump(debug_backtrace()));				
        }

} else {
    try {
    
        require "database/dbConnect.php";	//CONNECT to the database
    
        $sql = "SELECT * FROM products";
        
        //PREPARE the SQL statement
        $stmt = $conn->prepare($sql);
        
        //EXECUTE the prepared statement
        $stmt->execute();		
        
        //Prepared statement result will deliver an associative array
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        }
    
        catch(PDOException $e) {
        $message = "There has been a problem. The system administrator has been contacted. Please try again later.";
    
        error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
        error_log($e->getLine());
        error_log(var_dump(debug_backtrace()));				
        }
}

?>
<!DOCTYPE html>

<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dice & Things</title>

    <script src="js/hamburger.js"></script>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/shopStyle.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />

</head>

<body onload="onLoad()">

<header class="desktop">
        <div class="container flex space-between align-center">

            <div class="leftLinks">
                <a href="/dicenthings">Home</a>
                <a href="about.html">About</a>
            </div>

            <div class="logo">
                <img src="images/Logo-White.png">
            </div>

            <div class=" rightLinks">
                <a href="shop.php">Shop</a>
                <a href="contact.html">Contact</a>
            </div>
        </div>

    </header>

    <header class="mobileNav">

        <div class="container flex space-between align-center">


            <div class="logo">
                <img src="images/Logo-White.png" width="100">
            </div>

            <a class="menuIcon"><span></span></a>
        </div>

        <div class="menu mobile hidden">
            <ul>
                <li><a class="menuItem" href="/dicenthings">Home</a></li>
                <li><a class="menuItem" href="about.html">About</a></li>
                <li><a class="menuItem" href="shop.php">Shop</a></li>
                <li><a class="menuItem" href="contact.html">Contact</a></li>
            </ul>
        </div>

    </header>

    <div class="disclaimer">
        <p class="container">*This site is for academic purposes only.</p>
    </div>
    
    <div class="cart">
                <form target="paypal" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
                <input type="image" src="https://kmpope.com/wdv351Homework/payPalButtons/images/paypal-button-view-cart.jpg" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>

            </div>

    <section class="head">
        <div class="container flex justify-center">

            <h1>Shop</h1>

        </div>

    </section>
    <!--End head-->
    
    <div class="shopContainer">
        <div class="container">
            <section class="filter">

                <form id="filter" method="get">
                    <h4>Filter:</h4>
                    <select id="category" name="product_category">
                        <option value="null">-Select Category-</option>
                        <option value="dice">Polymer Dice</option>
                        <option value="dice-bag">Dice Bags</option>
                        <option value="dice-tray">Dice Trays</option>
                        <option value="char-sheet">Character Sheets</option>
                    </select>
                    <button type="submit">Go</button>
                </form>

            </section>
            <!--End about-->

            <section class="shop">

                <div class="flex flex-start">

                <?php 
                    while( $row=$stmt->fetch(PDO::FETCH_ASSOC) ) {
                ?>
                    <div class="card">
                        <img src="images/<?php echo $row['product_file_name']?>">
                        <h4><?php echo $row['product_name']?></h3>
                        <p><?php echo $row['product_description']?></p>
                        <hr>
                        <p class="price"><?php echo $row['product_price']?></p>
                        <?php echo $row['product_paypal']?>

                    </div>

                        <?php } ?>

                </div>

            </section>
            <!--End latest-->
        </div>
    </div>

    <footer>

        <div class="container flex space-between">

            <div class="logo">

                <img src="images/Logo-White.png">

            </div>

            <div class="contact">
                <h4>Contact</h4>
                <p>555-555-5555</p>
                <p>contact@dicenthings.com</p>
                <p>1234 Main St<br>
                    City, ST, 111111</p>
            </div>

            <div class="shop-links">

                <h4>Shop</h4>
                <p><a href="shop.php?product_category=dice">Dice Sets</a></p>
                <p><a href="shop.php?product_category=dice-tray">Dice Trays</a></p>
                <p><a href="shop.php?product_category=dice-bag">Dice Bags</a></p>
                <p><a href="shop.php?product_category=char-sheet">Character Sheets</a></p>

            </div>

        </div>

    </footer>

</body>

</html>