<html lang="EN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ace Cafe - Retrieve Order</title>
<link rel="stylesheet" type="text/css" href="../CSS/Styles.css">
</head>
<body>
<div class="container">
<style>
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
}</style>
<a class="HomeButton" href='Main.php'>🏠︎Home</a>
    <?php
    include '../Database/Database.php';

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $OID = $_POST['OrderID'];

        try {
            $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $line = $db->prepare("SELECT * FROM orders WHERE orderID = :orderID");
            $line->bindParam(":orderID", $OID);
            $line->execute();

            $rt = $line->fetch();
            if ($rt) {
                echo "<table>";
                echo "<caption>☕︎ Ace Cafe Order Details</caption>";
                echo "<tr><th>OrderID</th><td>" . $rt['orderID'] . "</td></tr>";
                echo "<tr><th>Name</th><td>" . $rt['name'] . "</td></tr>";
                echo "<tr><th>Beverage</th><td>" . $rt['beverageType'] . "</td></tr>";
                echo "<tr><th>Size</th><td>" . $rt['size'] . "</td></tr>";
                echo "<tr><th>Total Price</th><td>" . $rt['totalPrice'] . "</td></tr>";
                echo "<tr><th>Instructions</th><td>" . $rt['instructions'] . "</td></tr>";
                echo "<tr><th>Extras</th><td>" . $rt['extras'] . "</td></tr>";
                echo "<tr><th>Milk</th><td>" . $rt['milk'] . "</td></tr>";
                echo "<tr><th>Sinkers</th><td>" . $rt['sinkers'] . "</td></tr>";
                echo "</table>";
            } else {
                echo "<p>No Order found with the provided ID. Please check your Order ID and try again.</p>";
            }
        } catch (PDOException $e) {
            echo "Error:" . $e->getMessage();
        }
    }
    $db = null;
    ?>
</div>
</body>
</html>