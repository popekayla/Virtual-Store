<?php 
    try {
        
        require "database/dbConnect.php";	//CONNECT to the database

        $sql = "SELECT * FROM products
                ORDER BY ID DESC
                LIMIT 4";
        
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
?>

<!DOCTYPE html>

<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dice & Things</title>

    <script src="js/hamburger.js"></script>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/homeStyle.css">

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

    <section class="head">
        <div class="container flex space-between align-start">

            <div class="info">
                <h1>Lorem Ipsum</h1>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et
                    dolore magna aliqua. Elit at imperdiet dui accumsan sit amet nulla facilisi.</p>

                <p>Faucibus et molestie ac feugiat sed lectus vestibulum mattis. Fermentum iaculis eu non diam
                    phasellus.
                    Interdum posuere lorem ipsum dolor sit amet consectetur adipiscing.</p>

                <a href="shop.php"><button>Shop now!</button></a>

            </div>

            <div class="dice">
                <img src="images/dice.png">
            </div>
        </div>

    </section>
    <!--End head-->

    <section class="about">

        <div class="container flex align-center">

            <div class="img">
                <img src="images/dungeons-and-dragons-4413056_1920.jpg">
            </div>

            <div class="text">
                <h2>Lorem Ipsum</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et
                    dolore magna aliqua. Elit at imperdiet dui accumsan sit amet nulla facilisi.</p>

                <p>Faucibus et molestie ac feugiat sed lectus vestibulum mattis. Fermentum iaculis eu non diam
                    phasellus.
                    Interdum posuere lorem ipsum dolor sit amet consectetur adipiscing.</p>

                <p>
                    <a href="shop.php?product_category=dice"><button>Dice Sets</button></a>
                    <a href="shop.php?product_category=dice_tray"><button>Dice Trays</button></a>
                    <a href="shop.php?product_category=dice_bag"><button>Dice Bags</button></a>
                    <a href="shop.php?product_category=char-sheet"><button>Character Sheets</button></a>
                </p>
            </div>

        </div>

    </section>
    <!--End about-->

    <section class="latest">

        <div class="container">

            <h2>Latest Things</h2>

            <div class="product-grid flex space-between">

            <?php 
               while( $row=$stmt->fetch(PDO::FETCH_ASSOC) ) {
            ?>
                <div class="product">

                    <img src="images/<?php echo $row['product_file_name'];?>">
                    <h4><?php echo $row['product_name'];?></h4>
                    <p><?php echo $row['product_price'];?></p>
                    <a href="shop.html"><button>Shop Now &rarr;</button></a>

                </div>

               <?php } ?>

            </div>

        </div>

    </section>
    <!--End latest-->

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