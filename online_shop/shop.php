<?php
    include "navbar.php";
    
    if(isset($_REQUEST['cart'])){
        if(!isset($_SESSION['login'])){
            header("Location: login.php");
        }else {
            extract($_REQUEST);
            header("Location: cos.php?id=".$id."&q=".$quantity);
        }
    }

    if(isset($_REQUEST['sort'])){
        extract($_REQUEST);
        if($id > 0){
        $products = $product->getAllProductsByCategory($id);
    } else {
            $products = $product->getAllProducts();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
</head>
<?php
    
?>
<body>
<div class="helper-1">
    <form action="" method="get" class="category">
        <select class="browser-default custom-select" name="id">
            <option value="0" selected>All</option>
            <?php
                $categories = $product->categories();
                while($category = $categories->fetch_assoc()){
            ?>
            <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
            <?php
                }
            ?>
        </select>
        <button type="submit" name="sort" class="btn btn-primary">Sort</button>
    </form>
</div>
<div class ='row'>
    <?php
        if(!isset($_GET['id'])){
        $productsList = $product->getAllProducts();
        while($prod = $productsList->fetch_assoc()){
    ?>
            <div class='col-sm-4'> 
            <div class="section">
                <div class="helper">
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?php echo $prod['id']; ?>">
                    <p class="produs">Name: <?php echo $prod['name'] ?></p>
                    <p class="produs">Description: <?php echo $prod['description'] ?></p>
                    <p class="produs">Price: <?php echo $prod['price'] ?></p>
                    <p class="produs">Quantity: <input type="number" name="quantity" value="1"></p>
                    <button class='btn btn-success' name="cart" type="submit">Add to cart</button>
                    </form>
                </div>
                <div class="helper2">
                    <p><img src="<?php echo $prod['image'] ?>" style="width:200px;" alt="produs"></p>
                </div>   
                </div>
        </div> 
        <?php
        }
    }else {
        ?>
        <?php
            while($prod = $products->fetch_assoc()){
                ?>
             <div class='col-sm-4'> 
            <div class="section">
                <div class="helper">
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?php echo $prod['id']; ?>">
                    <p class="produs">Name: <?php echo $prod['name'] ?></p>
                    <p class="produs">Description: <?php echo $prod['description'] ?></p>
                    <p class="produs">Price: <?php echo $prod['price'] ?></p>
                    <p class="produs">Quantity: <input type="number" name="quantity" value="1"></p>
                    <button class='btn btn-success' name="cart" type="submit">Add to cart</button>
                    </form>
                </div>
                <div class="helper2">
                    <p><img src="<?php echo $prod['image'] ?>" style="width:200px;" alt="produs"></p>
                </div>   
                </div>
        </div> 
        <?php
            }
        }
        ?>
           
</div>
</body>
</html>