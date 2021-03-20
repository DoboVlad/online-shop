<?php
    include "navbar.php";
    if(!isset($_SESSION['login'])){
        header("Location: login.php");
    }
    if($user->isAdmin($_SESSION['id']) == 0){
        header("Location: shop.php");
    }
    if(isset($_GET['delete_id'])){
        $id = $_GET['delete_id'];
        $product->deleteProduct($id);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
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
            margin-bottom: 5px;
            margin-left: 15px;
        }
    </style>
    <script>
        function alertUser(){
            alert('This product will be deleted');
        }
    </script>
</head>
<body>
<table class="table">
        <button class="btn btn-success"><a href="add.php">Add product</a></button>
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Price</th>
      <th scope="col">Image</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        $list_products = $product->getAllProducts();
        foreach($list_products as $product){
    ?>
    <tr>
      <td><?php echo $product['name'] ?></td>
      <td><?php echo $product['description'] ?></td>
      <td><?php echo $product['price'] ?></td>
      <td><img src="<?php echo $product['image'] ?>" style="width:200px;" alt=""></td>
      <td>
        <button class="btn btn-danger"><a href="?delete_id=<?php echo $product['id']; ?>" onClick="alertUser()">DELETE</a></button>
        <button class="btn btn-warning"><a href="update.php?update_id=<?php echo $product['id']; ?>">UPDATE</a></button>
      </td>
    </tr>
    <?php 
        }
    ?>
  </tbody>
</table>
</body>
</html>