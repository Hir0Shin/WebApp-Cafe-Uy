<?php
include '../Database/Database.php';

try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $line = $db->prepare("SELECT * FROM orders");
    $line->execute();

    $showA = $line->fetchAll();
    foreach ($showA as $show) {
        echo "<tr>";
        echo "<td>" . $show['orderID'] . "</td>";
        echo "<td>" . $show['name'] ."</td>";
        echo "<td>" . $show['beverageType'] ."</td>";
        echo "<td>" . $show['size'] ."</td>";
        echo "<td>" . number_format($show['totalPrice']) ."</td>";
        echo "<td>" . $show['instructions'] ."</td>";
        echo "<td>" . $show['extras'] ."</td>";
        echo "<td>" . $show['milk'] ."</td>";
        echo "<td>" . $show['sinkers'] ."</td>";
        echo "</tr>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$db = null;
?>