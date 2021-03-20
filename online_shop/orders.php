<?php
    include_once 'navbar.php';
    $orders = $product->orders();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
</head>
<body>
    <div class="container">
    <?php
        while($q = $orders->fetch_assoc()){
    ?>
    <p>Clientul <?php echo $q['firstName']. ' ' .$q['lastName'] ?> a comandat <?php echo $q['quantity'] ?>
     bucati de <?php echo $q['name'] ?> la pretul de <?php echo $q['price'] ?>.
    </p> 
    <?php
        }
    ?> 
    </div>
</body>
</html>
