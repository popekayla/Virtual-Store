<?php
session_start();
if(isset($_SESSION['user']) == 'yes') {

    if(isset($_GET['prod_ID'])) {
        $prodID = $_GET['prod_ID'];
        $download_name="";
        
            try {
            
            require "database/dbConnect.php";	//CONNECT to the database

            $sql = "SELECT download_name FROM products
                    WHERE ID = :prodID";
            
            //PREPARE the SQL statement
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':prodID', $prodID);
            
            //EXECUTE the prepared statement
            $stmt->execute();		
            
            //Prepared statement result will deliver an associative array
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $download_name = $row['download_name'];
            }

            catch(PDOException $e) {
            $message = "There has been a problem. The system administrator has been contacted. Please try again later.";

            error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
            error_log($e->getLine());
            error_log(var_dump(debug_backtrace()));				
            }
        }
    }
        ?>
        <!DOCTYPE html>

<html>

<head>

    <title>Dice & Things</title>

    <style>
        html {
            height: 100%;
        }

        body {
            background: #B06AB3;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to bottom, #4568DC, #B06AB3);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to bottom, #4568DC, #B06AB3);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            line-height: 1.75em;
            text-align: center;
            color: #ffffff;
        }


        .container {
            width: 80%;
            margin: 5em auto;
        }

        .download {
            display: flex;
            justify-content: center;
        }

        a {
            color: #ffffff;
            text-decoration: none;
        }

        a:hover {
            color: #444f75;
        }
    </style>

</head>

<body>
    <div class="container">

    <?php if(isset($_SESSION['user']) == 'yes') { ?>

        <h2>Order Placed Successfully!</h2>
        <p>You can download your content below</p>

        <div class="download">
            <ul>
                <li><a href="images/<?php echo $download_name?>.jpg" download>JPG</a></li>
                <li><a href="images/<?php echo $download_name?>.pdf" download>PDF</a></li>
                <li><a href="images/<?php echo $download_name?>.zip" download>Both</a></li>
            </ul>
        </div>

        <h3><a href="shop.php">&#x2190;Go Back to Store</a> </h3>

    <?php } else { ?>

        <p>Oops! You must've come here by mistake</p>
        <h3><a href="index.html">&#x2190;Go Back to Store</a> </h3>

    <?php }?>

    </div>

</body>

</html>