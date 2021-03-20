<?php
    session_start(); 
    include_once "Classes/user.php";
    include_once "Classes/product.php"; 
    $user = new User();
    $product = new Product();
    if(isset($_GET['logout'])){
        
        $user->logout();
        header("Location: login.php");
    }

?>
<header>
        <nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-light bg-white border-bottom box-shadow mb-3">
            <div class="container">
                <a class="navbar-brand" href="shop.php">Shop</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse d-sm-inline-flex flex-sm-row-reverse">
                    <ul class="navbar-nav flex-grow-1">
                        <?php
                            if($user->getSession()){
                                ?>
                             <li class="nav-item">
                                <a class="nav-link text-dark" href="cos.php">Cart</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="?logout=logout">Logout</a>
                            </li>
                            <?php 
                                if($user->isAdmin($_SESSION['id'])){
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link text-dark" href="manage.php">Manage products</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-dark" href="orders.php">Orders</a>
                                    </li>
                            <?php
                                }
                            ?>
                        <?php
                            }
                            else{
                            ?>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="register.php">Register</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="login.php">Login</a>
                            </li>
                        <?php
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
</header>