<html lang="EN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ace Cafe - Delete Order</title>
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
SESSION_START();
include '../Database/Database.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['OrderID']) && !empty($_POST['OrderID'])) {
        $OID = $_POST['OrderID'];
        
        try {
            $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $line = $db->prepare("DELETE FROM orders WHERE orderID = :orderID");
            $line->bindParam(":orderID", $OID);
            $line->execute();

            if ($line->rowCount() > 0) {
                echo "<p>Order <strong>ID #$OID</strong> had been deleted successfully!</p>";
                echo "
                <script>
                alert('Order Deleted!');
                </script>
                ";
            } else {
                echo "<p>No Order found with the provided ID. Please check your Order ID and try again.</p>";
                echo "
                <script>
                setTimeout(function() {
                alert('No Order found. Please provie an existing ID!');
                }, 100);
                </script>
                ";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "<p>Please provide the Order ID.</p>";
    }
}
$bd = null;
?>
</div>
</body>
</html>