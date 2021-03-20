<?php 
    include "navbar.php";
    if(!isset($_SESSION['login'])){
        header("Location: login.php");
    }
    if($user->isAdmin($_SESSION['id']) == 0){
        header("Location: shop.php");
    }
    $message = "";
    if(isset($_REQUEST['submit'])){
        extract($_REQUEST);
        if($name == "" || $img == "" || $price == "" || $price == "0"){
            $message = "Name, image and price are required.";
        } else {
            $product->addNewProduct($name, $description, $price, $img, $id);
            header("Location:manage.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        .form{
            margin-left: 200px;
            width: 300px;
        }
        .error {
            color:red;
        }
    </style>
</head>
<body>
    <div class="form">
    <form action="">
        <label for="name">Name:</label>
        <input type="text" class="form-control" name="name" id="name">
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <label for="price">Price:</label>
        <input type="text" class="form-control" name="price" id="price">
        <div class="form-group">
            <label for="img">Image:</label>
            <input type="file" class="form-control" name="img" id="img">
        </div>
        <?php
            echo "<p class=\"error\">".$message."</p>";
        ?> 
         <select class="browser-default custom-select" name="id">
            <option value="" disabled selected value="0">All</option>
            <?php
                $categories = $product->categories();
                while($category = $categories->fetch_assoc()){
            ?>
            <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
            <?php
                }
            ?>
        </select>
        <button type="submit" class="btn btn-success" name="submit" type="submit">Add</button>
    </form>
    </div>
</body>
</html>