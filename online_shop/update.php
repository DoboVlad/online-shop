<?php 
    include "navbar.php";
    $message = "";
    if(!isset($_SESSION['login'])){
        header("Location: login.php");
    }
    if($user->isAdmin($_SESSION['id']) == 0){
        header("Location: shop.php");
    }
    if(isset($_GET['update_id'])){
        $id = $_GET['update_id'];
        $prod = $product->searchProduct($id);
    }
    if(isset($_REQUEST['submit'])){
        extract($_REQUEST);
        if($name == "" || $price == ""){
            $message = "Name and price are required.";
            $prod = $product->searchProduct($id);
        }else {
            $product->saveUpdatedProduct($id, $name, $description,$price);
            header("Location: manage.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update a product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        .form{
            margin-left: 200px;
            width: 300px;
        }
        a{
            color: white;
        }
        a:link{
            text-decoration: none;
            color: white;
        }
        a:hover {
            color: white;
        }
        button{
            margin-top: 20px;
            margin-bottom: 5px;
            margin-left: 15px;
        }
        .error {
            color:red;
        }
    </style>
</head>
<body>
    <?php 
        while($row = $prod->fetch_assoc()){
    ?>
        <div class="form">
        <form action="" action="GET">
            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" id="name" value="<?php echo $row['name'] ?>">
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?php echo $row['description'] ?></textarea>
            </div>
            <label for="price">Price:</label>
            <input type="text" class="form-control" name="price" id="price" value="<?php echo $row['price'] ?>">
            <?php
                echo "<p class=\"error\">".$message."</p>";
            ?> 
            <button type="submit" class="btn btn-success" name="submit">Save changes</button>
        </form>
        </div>
    <?php
        }
    ?>
</body>
</html>