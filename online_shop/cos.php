<?php
    include_once "navbar.php";
    $message = "";
    $delete="";
    if(!isset($_SESSION['login'])){
        header("Location: login.php");
    }
    if(isset($_GET['id']) && isset($_GET['q'])){
        $user_id = $_SESSION['id'];
        $product->addToCart($user_id, $_GET['id'], $_GET['q']);
    }

    if(isset($_GET['delete_id'])){
        $delete_id = $_GET['delete_id'];
        $product->deleteFromCart($delete_id);
    }

    if(isset($_GET['finalise'])==1){
        $product->finaliseCommand($_SESSION['id']);
        $message = "Your command has been sent!";
    }

    if(isset($_GET['deleteCmd'])==1){
        $product->dropCommand($_SESSION['id']);
        $delete = "Your cart has been deleted";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
<?php
    
?>
    <table style="border: 1px solid black;">
    <?php
            $products = $product->getAllUserProducts($_SESSION['id']);
            if($products->num_rows > 0){
            while($prod = $products->fetch_assoc()){
        ?>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Delete products</th>
        </tr>
        <?php
            foreach($products as $prod){
        ?>
        <tr>
            <td><?php echo $prod['name'] ?></td>
            <td><?php echo $prod['price'] ?></td>
            <td><?php echo $prod['quantity'] ?></td>
            <td><a href="?delete_id=<?php echo $prod['id']; ?>" class="btn btn-danger">Delete</a></td>
        </tr>
        <?php
            }
        }
        } else {
        ?>
        <p>You don't have any products added yet</p>
        <?php
        }
        ?>
        <?php
            echo "<p style='color:#3bb300'>".$message."</p>";
            echo "<p style='color:#C82333'>".$delete."</p>";
        ?>
        </br>
        <a href="?finalise=1" class="btn btn-primary">Finalise command</a>
        <a href="?deleteCmd=1" class="btn btn-danger">Drop command</a>
    </table>
</body>
</html>