<?php
                $conn= new mysqli('localhost', 'root', '', 'deliverysy');
            
            
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $code = $_POST['prodcode'];
                    $username = $_POST['username'];
            
                    $conn->query("INSERT INTO products (prodcode,username) values ('$code', '$username')");
                    echo "Product has been added!";
                }
            
                if (isset($_GET['delete_prodcode'])) {
                    $delete_prodcode = $_GET['delete_prodcode'];
                    $conn->query( "DELETE FROM products WHERE username = '$delete_prodcode'");
                    
                }
?>

<html>
<body>
    <br>
    <button onclick="location.href='pullout.php'">Pullout</button>    

    <form action="product.php" method="post">
        <h2>Product</h2> 
        Code: <input type="text" name="prodcode" id="prodcode" placeholder="Enter the Code."> <br> 
        Name: <input type="text" name="username" id="usename" placeholder="Enter a Name.">
        <input type="submit" value="Add">

    </form>

    <?php
        $result =$conn->query('SELECT * FROM products');
        if ($result -> num_rows > 0) {
            echo" <table border= '1'>
                    <tr>
                        <th>Delete</th>
                        <th>Code</th> 
                        <th>Name</th>
                    </tr>";
            while ($row = $result->fetch_assoc()){
                echo "<tr>
                <td><a href='?delete_prodcode={$row['username']}'>Delete</a></td>
                    <td>{$row['prodcode']}</td>
                    <td> <a href='delivery.php'>{$row['username']}</a> </td>
                    
                    </tr>";
                }
                echo "</table>";
            } else {
                echo "No products yet.";
            }
            
            ?>

</body>
</html>