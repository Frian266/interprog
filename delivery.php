<?php 
 include 'connect.php';

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $delivery_code = $_POST["delcode"];
    $date = $_POST["date"];
    $supplier = $_POST["supplier"];
    $product = $_POST["product"];
    $quantity = $_POST["quantity"];

    $conn->query("INSERT INTO flfdel ( delcode, supplier, proddate, product, quantity) VALUES ( '$delivery_code', '$supplier', '$date', '$product', '$quantity')");
    
}

?>

<html>
<body>
    <button onclick="location.href='product.php'">Product</button> <br><br>
    <button onclick="location.href='pullout.php'">Pullout</button>    
    

    <form action="delivery.php" method="get">
        <h3>Delivery</h3>
    
        Delivery Code: <input type="text" name="delcode" id="delcode" placeholder="Enter Delivery Code"><br>
        Supplier: <input type="text" name="supplier" id="supplier"> <br>
        Date: <input type="date" name="date" id="date"><br>
        Product: 
        <select name="product" id="product">
        <?php
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql); 
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=$row[username]>$row[username]</option>";               
                }
        ?>
        </select> <br>
        Quantity: <input type="number" name="quantity" id="">
        <input type="submit" value="Add">
    </form>
            
    <h3>Entries</h3>
    <?php 

        if (isset($account_id)) {
            $sql = "SELECT * FROM flfdel WHERE account_id = $account_id";

            $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
                echo "<table border='1'>
                        <tr>
                            <th>Delete</th>
                            <th>Delivery date</th>
                            <th>supplier</th>
                            <th>product</th>
                            <th>quantity</th>
                        </tr>";
    
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>

                            <td>delete</td>
                            <td>{$row['proddate']}</td>
                            <td>{$row['supplier']}</td>
                            <td>{$row['product']}</td>
                            <td>{$row['quantity']}</td>
                        </tr>";
                }
    
                echo "</table>";
            } else {
                echo "No entries yet.";
            }
        }
    ?>
</body>
</html>