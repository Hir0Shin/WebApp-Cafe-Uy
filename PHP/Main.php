<!DOCTYPE html>
<html lang="EN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ace Cafe</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="../Javascript/Javascript.js"></script>
<style>.inactive-section, .hidden {display: none;}</style>
<link rel="stylesheet" type="text/css" href="../CSS/Styles.css">
</head>
<body>
<header>
    <h1>☕︎ Ace Cafe</h1>
    <nav>
    <ul>
        <li><a href="#Orders" class="active">Orders</a></li>
        <li><a href="#RetrieveOrder">Retrieve Order</a></li>
        <li><a href="#NewOrder">New Order</a></li>
        <li><a href="#UpdateOrder">Update Order</a></li>
        <li><a href="#DeleteOrder">Delete Order</a></li>
    </ul>
    </nav>
    <a href="../Users/Logout.php"><button id="LogoutButton">
        <svg height="20px" width="20px" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 304.588 304.588" xml:space="preserve" fill="#000000">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="6.091760000000001"></g>
            <g id="SVGRepo_iconCarrier"> <g> <g> <g> 
            <polygon style="fill:#FFF8E7;" points="134.921,34.204 134.921,54.399 284.398,54.399 284.398,250.183 134.921,250.183 134.921,270.384 304.588,270.384 304.588,34.204 "></polygon> </g> 
            <g> <polygon style="fill:#FFF8E7;" points="150.27,223.581 166.615,239.931 254.26,152.286 166.615,64.651 150.27,80.979 210.013,140.733 0,140.733 0,163.838 210.008,163.838 "></polygon></g> </g> </g> </g></svg>
            <span>Logout</span>
    </button></a>
</header>
<main>




<!-- SHOW ORDERS -->
<section id="Orders" class="active-section">
<table>
    <caption>☕︎ Cafe Orders</caption>
    <tr>
        <th>Order ID</th>
        <th>Name</th>
        <th>Beverage</th>
        <th>Size</th>
        <th>Total Price</th>
        <th>Instructions</th>
        <th>Extras</th>
        <th>Milk</th>
        <th>Sinkers</th>
    </tr>
    <?php include 'Show.php';?>
</table>
</section>




<!-- RETRIEVE ORDER -->
<section id="RetrieveOrder" class="inactive-section"><div class="container">
    <h1>☕︎ Retrieve Order</h1>
    <form action="Retrieve.php" method="POST">
        <label>Order ID:</label><input type="number" name="OrderID" class="numinput" maxlength="5" placeholder="Enter your Order ID" required>
        <button type="submit" id="OrderButton">Retrieve Order</button>
    </form>
</div></section>




<!-- CREATE NEW ORDER -->
<section id="NewOrder" class="inactive-section"><div class=" container">
<h1>☕︎ Order Form</h1>
<form action="Order.php" method="POST">
    <label>Name:</label><input type="text" name="Name" class="textinput" maxlength="20" placeholder="Enter your Name" required>
    <label>Beverages:</label>
    <select name="Beverage" id="Beverage" required>
        <option disabled class="select-holder" value="" selected>-SELECT YOUR BEVERAGE-</option>
        <option disabled class="select-holder" value="">-COFFEE-</option>
        <option class="coffee" value="Espresso">₱145 - Espresso</option>
        <option class="coffee" value="Americano">₱180 - Americano</option>
        <option class="coffee" value="Cortado">₱225 - Cortado</option>
        <option class="coffee" value="Flat White">₱225 - Flat White</option>
        <option class="coffee" value="Vanilla Latte">₱250 - Vanilla Latte</option>
        <option class="coffee" value="Cappuccino">₱250 - Cappuccino</option>
        <option class="coffee" value="Mocha">₱300 - Mocha</option>
        <option class="coffee" value="Spanish Latte">₱350 - Spanish Latte</option>
        <option class="coffee" value="Coconut Latte">₱395 - Coconut Latte</option>
        <option disabled class="select-holder" value="">-MILKTEA-</option>
        <option class="milktea" value="Pearl Milktea">₱100 - Pearl Milktea</option>
        <option class="milktea" value="Taro">₱120 - Taro</option>
        <option class="milktea" value="Matcha">₱155 - Matcha</option>
        <option class="milktea" value="Wintermelon Latte">₱160 - Wintermelon Latte</option>
        <option class="milktea" value="Wintermelon Mousse">₱170 - Wintermelon Mousse</option>
        <option class="milktea" value="Salted Caramel">₱170 - Salted Caramel</option>
        <option class="milktea" value="Cream Cheese">₱180 - Cream Cheese</option>
        <option class="milktea" value="Cookies & Cream">₱190 - Cookies & Cream</option>
        <option class="milktea" value="Black Forest">₱200 - Black Forest</option>
    </select>
    <div id="size-group">
    <label>Sizes:</label>
        <input type="radio" name="size" id="small" value="Small"><label for="small">Small: -₱15</label>
        <input type="radio" name="size" id="regular" value="Regular" checked><label for="regular" checked>Regular</label>
        <input type="radio" name="size" id="medium" value="Medium"><label for="medium">Medium: +₱15</label>
        <input type="radio" name="size" id="large" value="Large"><label for="large">Large: +₱20</label>
    </div>
    <div id="extras-group">
    <label>Extras:</label>
        <input type="checkbox" name="extras[]" id="sugarcube" value="SugarCube"><label for="sugarcube">+₱10 - Sugar Cube</label>
        <input type="checkbox" name="extras[]" id="creamer" value="Creamer"><label for="creamer">+₱10 - Creamer</label>
        <input type="checkbox" name="extras[]" id="syrup" value="Vanilla Syrup"><label for="syrup">+₱55 - Vanilla Syrup</label><br>
        <input type="checkbox" name="extras[]" id="eshot" value="Espresso Shot"><label for="eshot">+₱65 - Espresso Shot</label>
        <input type="checkbox" name="extras[]" id="ematcha" value="Extra Matcha"><label for="ematcha">+₱90 - Extra Matcha</label>
    </div>
    <div id="milk-group" class="hidden">
    <label>Milk:</label>
        <input type="radio" name="milk" class="milk" id="none" value="None"><label for="none">No Milk</label>
        <input type="radio" name="milk" class="milk" id="cowmilk" value="Cow Milk" checked><label for="cowmilk">Cow's Milk</label>
        <input type="radio" name="milk" class="milk" id="lowfat" value="Low Fat"><label for="lowfat">Low Fat: +₱10</label>
        <input type="radio" name="milk" class="milk" id="skimmed" value="Skimmed"><label for="skimmed">Skimmed: +₱10</label><br>
        <input type="radio" name="milk" class="milk" id="soy" value="Soy Milk"><label for="soy">Soy Milk: +₱40</label>
        <input type="radio" name="milk" class="milk" id="oat" value="Oat Milk"><label for="oat">Oat Milk: +₱40</label>
        <input type="radio" name="milk" class="milk" id="almond" value="Almond Milk"><label for="almond">Almond: +₱40</label>
        <input type="radio" name="milk" class="milk" id="coconut" value="Coconut Milk"><label for="coconut">Coconut: +₱40</label>
    </div>
    <div id="sinkers-group" class="hidden">
    <label>Sinkers:</label>
        <input type="checkbox" name="sinkers[]" class="sinkers" id="pearl" value="Pearl"><label for="pearl">+₱25 - Pearl</label>
        <input type="checkbox" name="sinkers[]" class="sinkers" id="pudding" value="Pudding"><label for="pudding">+₱25 - Pudding</label><br>
        <input type="checkbox" name="sinkers[]" class="sinkers" id="c1jelly" value="Coffee Jelly"><label for="c1jelly">+₱30 - Coffee Jelly</label>
        <input type="checkbox" name="sinkers[]" class="sinkers" id="c2jelly" value="Coconut Jelly"><label for="c2jelly">+₱30 - Coconut Jelly</label>
    </div>
    <div id="instructions"><label>Special Instructions:</label><textarea name="Instructions" class="textinput" rows="4"></textarea></div>
    <button type="submit" id="OrderButton">Place Order</button>
</form>
</div></section>




<!-- UPDATE ORDER -->
<section id="UpdateOrder" class="inactive-section"><div class="container">
<h1>☕︎ Update Order</h1>
<form action="Update.php" method="POST">
    <label>Order ID:</label><input type="number" name="OrderID" max="9999" class="numinput" placeholder="Enter your Order ID" required>
    <label>Name:</label><input type="text" name="Name" class="textinput" maxlength="20" placeholder="Enter your Name">
    <label>Beverages:</label>
    <select name="Beverage" id="Beverage2">
        <option class="select-holder" value="" selected>-SELECT YOUR BEVERAGE-</option>
        <option class="select-holder" value="">-COFFEE-</option>
        <option class="coffee" value="Espresso">Espresso</option>
        <option class="coffee" value="Americano">Americano</option>
        <option class="coffee" value="Cortado">Cortado</option>
        <option class="coffee" value="Flat White">Flat White</option>
        <option class="coffee" value="Vanilla Latte">Vanilla Latte</option>
        <option class="coffee" value="Cappuccino">Cappuccino</option>
        <option class="coffee" value="Mocha">Mocha</option>
        <option class="coffee" value="Spanish Latte">Spanish Latte</option>
        <option class="coffee" value="Coconut Latte">Coconut Latte</option>
        <option class="select-holder" value="">-MILKTEA-</option>
        <option class="milktea" value="Pearl Milktea">Pearl Milktea</option>
        <option class="milktea" value="Taro">Taro</option>
        <option class="milktea" value="Matcha">Matcha</option>
        <option class="milktea" value="Wintermelon Latte">Wintermelon Latte</option>
        <option class="milktea" value="Wintermelon Mousse">Wintermelon Mousse</option>
        <option class="milktea" value="Cream Cheese">Cream Cheese</option>
        <option class="milktea" value="Cookies & Cream">Cookies & Cream</option>
        <option class="milktea" value="Black Forest">Black Forest</option>
    </select>
    <div id="size-group">
    <label>Sizes:</label>
        <input type="radio" name="size" id="small" value="Small"><label for="small">Small</label>
        <input type="radio" name="size" id="regular" value="Regular"><label for="regular" checked>Regular</label>
        <input type="radio" name="size" id="medium" value="Medium"><label for="medium">Medium</label>
        <input type="radio" name="size" id="large" value="Large"><label for="large">Large</label>
    </div>
    <div id="extras-group">
    <label>Extras:</label>
        <input type="checkbox" name="extras[]" id="sugarcube" value="SugarCube"><label for="sugarcube">Sugar Cube</label>
        <input type="checkbox" name="extras[]" id="creamer" value="Creamer"><label for="creamer">Creamer</label>
        <input type="checkbox" name="extras[]" id="syrup" value="Vanilla Syrup"><label for="syrup">Vanilla Syrup</label><br>
        <input type="checkbox" name="extras[]" id="eshot" value="Espresso Shot"><label for="eshot">Espresso Shot</label>
        <input type="checkbox" name="extras[]" id="ematcha" value="Extra Matcha"><label for="ematcha">Extra Matcha</label>
    </div>
    <div id="milk-group2" class="hidden">
    <label>Milk:</label>
        <input type="radio" name="milk" class="milk" id="none" value="None"><label for="none">No Milk</label>
        <input type="radio" name="milk" class="milk" id="cowmilk2" value="Cow Milk" checked><label for="cowmilk2">Cow's Milk</label>
        <input type="radio" name="milk" class="milk" id="lowfat" value="Low Fat"><label for="lowfat">Low Fat</label>
        <input type="radio" name="milk" class="milk" id="skimmed" value="Skimmed"><label for="skimmed">Skimmed</label><br>
        <input type="radio" name="milk" class="milk" id="soy" value="Soy Milk"><label for="soy">Soy Milk</label>
        <input type="radio" name="milk" class="milk" id="oat" value="Oat Milk"><label for="oat">Oat Milk</label>
        <input type="radio" name="milk" class="milk" id="almond" value="Almond Milk"><label for="almond">Almond</label>
        <input type="radio" name="milk" class="milk" id="coconut" value="Coconut Milk"><label for="coconut">Coconut</label>
    </div>
    <div id="sinkers-group2" class="hidden">
    <label>Sinkers:</label>
        <input type="checkbox" name="sinkers[]" class="sinkers" id="pearl" value="Pearl"><label for="pearl">Pearl</label>
        <input type="checkbox" name="sinkers[]" class="sinkers" id="pudding" value="Pudding"><label for="pudding">Pudding</label>
        <input type="checkbox" name="sinkers[]" class="sinkers" id="c1jelly" value="Coffee Jelly"><label for="c1jelly">Coffee Jelly</label>
        <input type="checkbox" name="sinkers[]" class="sinkers" id="c2jelly" value="Coconut Jelly"><label for="c2jelly">Coconut Jelly</label>
    </div>
    <div id="instructions"><label>Special Instructions:</label><textarea name="Instructions" class="textinput" rows="4"></textarea></div>
    <button type="submit" id="OrderButton">Update Order</button>
</form>
</div></section>




<!-- DELETE ORDER -->
<section id="DeleteOrder" class="inactive-section"><div class="container">
<h1>☕︎ Delete Order</h1>
<form action="Delete.php" method="POST">
    <label>Order ID:</label><input type="number" name="OrderID" class="numinput" maxlength="20" placeholder="Enter your Order ID" required>
    <button type="submit" id="OrderButton">Delete Order</button>
</form>
</div></section>
</main>
</body>
</html>