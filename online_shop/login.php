<?php
    include_once "navbar.php";
    include_once "Classes/user.php";
    if(isset($_SESSION['login'])){
        header("Location: shop.php");
    }
    $user = new User();
    $message = "";
    if(isset($_REQUEST['submit'])){
        extract($_REQUEST);
        $login = $user->loginUser($email, $password);
        if($login){
            header("Location: shop.php");
        }else {
            $message = "Invalid credentials";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        .container{
            width: 100%; 
        }
        .centered-form{
            text-align: center;
            margin: auto;
        }
        .error {
            color:red;
        }
    </style>
</head>
<body>
<?php
    
?>
<div class="container">
        <div class="row justify-content-center centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Log in!<br></h3>
			 			</div>
			 			<div class="panel-body">
			    		<form method="POST" action="" role="form">
			    			<div class="form-group">
			    				<input type="email" name="email" class="form-control" placeholder="Email Address">
			    			</div>
			    			<div class="form-group">
			    				<input type="password" name="password" class="form-control" placeholder="Password">
			    			</div>
                            <?php
                                echo "<p class=\"error\">".$message."</p>";
                            ?> 
			    			<input type="submit" name="submit" value="Login" class="btn btn-info btn-block">
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>
</body>
</html>