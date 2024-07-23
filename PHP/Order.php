<html lang="EN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ace Cafe - Order</title>
<link rel="stylesheet" type="text/css" href="../CSS/Styles.css">
</head>
<body>
<?php
    function DisplayOrderSummary() {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            echo "<div class='container'>";
            echo "<style>
            .HomeButton, .HomeButton:visited {
                font-family: 'Courier New', monospace;
                font-size: 20px;
                font-weight: bold;
                margin: 0;
                padding: 0;
                color: #553C2A;
                text-decoration: none;
            }

            .HomeButton:hover {
                color: #8B4513;
                text-decoration: underline;
            }</style>";
            echo "<a class='HomeButton' href='Main.php'>🏠︎Home</a>";

            $beverage_prices = [
                "Espresso" => 145,
                "Americano" => 180,
                "Cortado" => 225,
                "Flat White" => 225,
                "Vanilla Latte" => 250,
                "Cappuccino" => 250,
                "Mocha" => 300,
                "Spanish Latte" => 350,
                "Coconut Latte" => 395,
                "Pearl Milktea" => 100,
                "Taro" => 120,
                "Matcha" => 155,
                "Wintermelon Latte" => 160,
                "Wintermelon Mousse" => 170,
                "Salted Caramel" => 170,
                "Cream Cheese" => 180,
                "Cookies & Cream" => 190,
                "Black Forest" => 200,
            ];
            $size_prices = [
                "Small" => -15,
                "Regular" => 0,
                "Medium" => 15,
                "Large" => 20,
            ];
            $extras_prices = [
                "SugarCube" => 10,
                "Creamer" => 10,
                "Vanilla Syrup" => 55,
                "Espresso Shot" => 65,
                "Extra Matcha" => 90,
            ];
            $milk_prices = [
                "None" => 0,
                "Cow Milk" => 0,
                "Low Fat" => 10,
                "Skimmed" => 10,
                "Soy Milk" => 40,
                "Oat Milk" => 40,
                "Almond Milk" => 40,
                "Coconut Milk" => 40,
            ];
            $sinkers_prices = [
                "Pearl" => 25,
                "Pudding" => 25,
                "Coffee Jelly" => 30,
                "Coconut Jelly" => 30,
            ];

            $name = htmlspecialchars($_POST['Name']);
            $beverageType = htmlspecialchars($_POST['Beverage']);
            $size = htmlspecialchars($_POST['size']);
            $instructions = htmlspecialchars($_POST['Instructions']);
            $beverage_type = $_POST['Beverage'];
            $size = $_POST['size'];
            $extras = isset($_POST['extras']) ? $_POST['extras'] : [];
            $milk = isset($_POST['milk']) && !empty($_POST['milk']);
            $sinkers = isset($_POST['sinkers']) ? $_POST['sinkers'] : [];
            $total_price = CalculateTotalPrice($beverage_prices, $size_prices, $extras_prices, $milk_prices, $sinkers_prices, $beverage_type, $size, $extras, $milk, $sinkers);
            $receiptContent = GenerateReceiptContent($name, $beverageType, $beverage_prices, $size, $size_prices, $extras_prices, $extras, $milk_prices, $milk, $sinkers_prices, $sinkers, $total_price, $instructions);

            DisplayOrderDetails($name, $beverage_type, $beverage_prices, $size_prices, $size, $extras_prices, $extras, $sinkers_prices, $sinkers, $milk_prices, $milk, $instructions, $total_price);
            DisplayJokeAndPassword($beverage_type, $name, $total_price);
            SaveReceipttoFile($receiptContent);
            InsertOrderToDatabase($name, $beverageType, $size, $extras, $milk, $sinkers, $instructions, $total_price);
            echo "</div>";
        }
    }


    function CalculateTotalPrice($beverage_prices, $size_prices, $extras_prices, $milk_prices, $sinkers_prices, $beverage_type, $size, $extras, $milk, $sinkers) {
        $total_price = $beverage_prices[$beverage_type] + $size_prices[$size];
        if (isset($_POST['milk']) && !empty($_POST['milk'])) {
            if ($_POST['milk'] !== 'Cow Milk' && 'None') {
                $total_price += $milk_prices[$_POST['milk']];
            }
        }
        foreach ($extras as $extra) {
            $total_price += $extras_prices[$extra];
        }
        foreach ($sinkers as $sinker) {
            $total_price += $sinkers_prices[$sinker];
        }
        return $total_price;
    }


    function DisplayOrderDetails($name, $beverage_type, $beverage_prices, $size_prices, $size, $extras_prices, $extras, $sinkers_prices, $sinkers, $milk_prices, $milk, $instructions, $total_price) {
        echo "<meta charset='utf-8'>";
        echo "<table>";
        echo "<caption>ORDER SUMMARY</caption>";
        echo "<tr><th>Name</th><td>" . htmlspecialchars($name) . "</td></tr>";
        echo "<tr><th>Beverage</th><td>" . htmlspecialchars($beverage_type) . "(₱" . number_format($beverage_prices[$beverage_type], 2) . ")</td></tr>";
        if ($size == "Small") {
            echo "<tr><th>Size</th><td>" . htmlspecialchars($size) . "(-₱" . number_format($size_prices[$size], 2) . ")</td></tr>";
        } elseif ($size != "Regular") {
            echo "<tr><th>Size</th><td>" . htmlspecialchars($size) . "(+₱" . number_format($size_prices[$size], 2) . ")</td></tr>";
        } else
            echo "<tr><th>Size</th><td>" . htmlspecialchars($size) . "</td></tr>";

        if (isset($_POST['milk']) && !empty($_POST['milk'])) {
            if ($_POST['milk'] == "Cow Milk") {
                echo "<tr><th>Milk</th><td>" . $_POST['milk'] . "</td></tr>";
            } elseif ($_POST['milk'] != "None") {
                echo "<tr><th>Milk</th><td>" . $_POST['milk'] . "(+₱" . number_format($milk_prices[$_POST['milk']], 2) . ")</td></tr>";
            }
        }
        if (!empty($sinkers)) {
            echo "<tr><th>Sinkers</th><td>" . implode(", ", $sinkers) . "(+₱" . number_format(array_sum(array_intersect_key($sinkers_prices, array_flip($sinkers))), 2) . ")</td></tr>";
        }
         
        if (!empty($extras)) {
            echo "<tr><th>Extras</th><td>" . implode(", ",$extras) . "(+₱" . number_format(array_sum(array_intersect_key($extras_prices, array_flip($extras))), 2) . ")</td></tr>";
        }
        echo "<tr><th>Total Price</th><td>" . "₱" . number_format($total_price, 2) . "</td></tr>";
        if ($instructions != "") {
            echo "<tr><th>Special Instructions</th><td>" . htmlspecialchars($instructions) . "</td></tr>";
        }
        echo "</table>";
    }


    function DisplayJokeAndPassword($beverage_type, $name, $total_price) {
        if ($beverage_type !== "Espresso") {
            echo "Hey, " . htmlspecialchars($name) . "!"; 
            echo "<p>Here's a joke for you: Why did the Coffee file a police report? It got mugged!</p>";
        }
        if ($total_price > 200 && $total_price < 350) {
            echo "<p>CR Password: <strong>Coffee00147</strong></p>";
        } elseif ($total_price >= 350) {
            echo "<p>Wifi Password: <strong>CafAce0617</strong></p>";
        }
    }


    function GenerateReceiptContent($name, $beverageType, $beverage_prices, $size, $size_prices, $extras_prices, $extras, $milk_prices, $milk, $sinkers_prices, $sinkers, $total_price, $instructions) {
        $receiptcontent = "Order Summary\n";
        $receiptcontent .= "----------------\n";
        $receiptcontent .= "Name:" . $name . "\n";
        $receiptcontent .= "Beverage:" . $beverageType . "(₱" . number_format($beverage_prices[$beverageType], 2) . ")\n";
        if ($size != 'Regular') {
            $receiptcontent .= "Size:" . "(₱" .number_format($size_prices[$size], 2) . ")\n";
        } else {
            $receiptcontent .= "Size:" . htmlspecialchars($size) . "\n";
        }
        if ($milk) {
            if ($milk != 'None') {
                $receiptcontent .= "Milk:" . "(+₱" . number_format($milk_prices[$milk], 2) . ")\n";
            }
        }
        if (!empty($extras)) {
            $receiptcontent .= "Extras:" . implode(", ", $extras) . "(+₱" . number_format(array_sum(array_intersect_key($extras_prices, array_flip($extras))), 2) . ")\n";
        }
        if (!empty($sinkers)) {
            $receiptcontent .= "Sinkers:" . implode(", ", $sinkers) . "(+₱" . number_format(array_sum(array_intersect_key($sinkers_prices, array_flip($sinkers))), 2) . "\n";
        }
        $receiptcontent .= "Total Price: ₱" . number_format($total_price, 2) . "\n";
        $receiptcontent .= "Total Price: ₱" . number_format($total_price, 2) . "\n";
        $receiptcontent .= "Special Instructions: " . $instructions . "\n";
        $receiptcontent .= "\n";
        $receiptcontent .= "Thank you for your order!";
        return $receiptcontent;
    }


    function SaveReceipttoFile($receiptContent) {
        $receipttxt = fopen("Ace Cafe Receipt.txt", "w") or die("Unable to open file~");
        fwrite($receipttxt, $receiptContent);
        fclose($receipttxt);
        echo "Receipt Created Successfully as Ace Cafe Receipt.txt!";
    }
    DisplayOrderSummary();


    function InsertOrderToDatabase($name, $beverageType, $size, $extras, $milk, $sinkers, $instructions, $total_price) {
        $db_host = 'localhost';
        $db_name = 'acecafe';
        $db_username = 'root';
        $db_password = 'shinlocal';

        try {
            $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $line = $db->prepare("INSERT INTO orders (name, beverageType, size, totalPrice, instructions, extras, milk, sinkers) VALUES (:name, :beverageType, :size, :totalPrice, :instructions, :extras, :milk, :sinkers)");

            $strExtras = implode(", ", $extras);
            $strSinkers = implode(", ", $sinkers);
            $line->bindParam(":name", $name);
            $line->bindParam(":beverageType", $beverageType);
            $line->bindParam(":size", $size);
            $line->bindParam(":totalPrice", $total_price);
            $line->bindParam(":instructions", $instructions);
            $line->bindParam(":extras", $strExtras);
            $line->bindParam(":milk", $_POST['milk']);
            $line->bindParam(":sinkers", $strSinkers);
            $line->execute();

            echo "<br/> Order Details inserted into Database successfuly!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    $db = null;
    }
?>  
</body>
</html>