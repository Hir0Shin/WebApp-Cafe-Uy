<html lang="EN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ace Cafe - Login</title>
<link rel="stylesheet" type="text/css" href="../CSS/Styles.css">
</head>
<body>
<div class="Access-container">
<?php
echo "<style>
strong {
    font-family: Arial, Helvetica, sans-serif;
    color: #553C2A;
    text-align: center;
    margin-bottom: 20px;
}
</style>";
SESSION_START();
include "../Database/Database.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $Username = $_POST["Username"];
    $Password = $_POST["Password"];

    try {
        $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $line = $db->prepare("SELECT * FROM users WHERE username = :username");
        $line->bindParam(':username', $Username);
        $line->execute();

        if ($line->rowCount() > 0) {
            $User = $line->fetch(PDO::FETCH_ASSOC);

            if (password_verify($Password, $User['password'])) {
                $_SESSION['username'] = $Username;
                header("Location:../PHP/Main.php");
                exit();
            } else {
                echo "<strong>Invalid Username or Password.</strong>";
            }
        } else {
            echo "<strong>Username does not exist!</strong>";
        }
    } catch (PDOException $e) {
        echo "Error: ". $e->getMessage();
    }
}
?>
<style>a, a button, a:visited {text-decoration: none;}</style>
<a href="./Login.html"><button class="AccessButton">🡸Back</button></a>
</div>
</body>
</html>