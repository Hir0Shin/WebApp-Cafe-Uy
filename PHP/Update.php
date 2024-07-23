<html lang="EN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ace Cafe - Update</title>
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
<a class='HomeButton' href='Main.php'>🏠︎Home</a>
<?php
include '../Database/Database.php';

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

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $OID = $_POST['OrderID'];

    try {
        $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $line = $db->prepare("SELECT * FROM orders WHERE orderID = :orderID");
        $line->bindParam(':orderID', $OID);
        $line->execute();

        $res = $line->fetch();
        if ($res) {
            $name = isset($_POST['name']) && $_POST['name'] !== "" ? $_POST['name'] : $res['name'];
            $beverage_type = isset($_POST['Beverage']) && $_POST['Beverage'] !== "" ? $_POST['Beverage'] : $res['Beverage'];
            $size = isset($_POST['size']) && $_POST['size'] !== "" ? $_POST['size'] : $res['size'];
            $extras = isset($_POST['extras']) && is_array($_POST['extras']) ? $_POST['extras'] : explode(", ", $res['extras']);
            $milk = isset($_POST['milk']) && $_POST['milk'] !== "" ? $_POST['milk'] : $res['milk'];
            $sinkers = isset($_POST['sinkers']) && is_array($_POST['sinkers']) ? $_POST['sinkers'] : explode(", ", $res['sinkers']);
            $instructions = isset($_POST['Instructions']) ? $_POST['Instructions'] : $res['Instructions'];
            $total_price = CalculateTotalPrice($beverage_prices, $size_prices, $extras_prices, $milk_prices, $sinkers_prices, $beverage_type, $size, $extras, $milk, $sinkers);

            $update = $db->prepare("UPDATE orders SET name=:name, beverageType=:beverageType, size=:size, extras=:extras, milk=:milk, sinkers=:sinkers, totalPrice=:totalPrice, instructions=:instructions WHERE orderID=:orderID");
            $update->execute([
                ':name' => $name,
                ':beverageType' => $beverage_type,
                ':size' => $size,
                ':extras' => implode(", ", $extras),
                ':milk' => $milk,
                ':sinkers' => implode(", ", $sinkers),
                ':totalPrice' => $total_price,
                ':instructions'=> $instructions,
                ':orderID' => $OID
            ]);
            echo '<strong>Order details updated successfully!</strong>';
        } else {
            echo '<strong>Order not found. Please check the Order ID and try again.</strong>';
        }
    } catch (Exception $e) {
        echo 'Error: '. $e->getMessage();
    }
    $db = null;
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
        if (isset($sinkers_prices[$sinker])) {
            $total_price += $sinkers_prices[$sinker];
        }
    return $total_price;
    }
}
?>
</div>
</body>
</html>