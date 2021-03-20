<?php
	include "navbar.php";
	if(isset($_SESSION['login'])){
        header("Location: shop.php");
    }
    $user = new User();
	$message = "";
	
    if(isset($_REQUEST['submit'])){
		extract($_REQUEST);
		if($firstName=="" || $lastName=="" || $email=="" || $password =="" || $phoneNumber==""){
			$message = "All the fields are required.";
		}
		else {
			if(isset($_REQUEST['admin'])){
				$isAdmin = 1;
			}
			else $isAdmin = 0;
			$register = $user->registerUser($firstName,$lastName,$email,$password,$phoneNumber, $isAdmin);
        	if($register){
				header('Location: login.php');
       	 	} else {
           	 	$message = "Invalid credentials";
			}
		}
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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

<div class="container">
        <div class="row justify-content-center centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Please sign up!<br><small>It's free!</small></h3>
			 			</div>
			 			<div class="panel-body">
			    		<form action="" method="POST" role="form">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			                <input type="text" name="firstName" id="firstName" class="form-control input-sm" placeholder="First Name">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="lastName" id="lastName" class="form-control input-sm" placeholder="Last Name">
			    					</div>
			    				</div>
			    			</div>

			    			<div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="phoneNumber" id="phone_number" class="form-control input-sm" placeholder="Phone number">
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-check">
										<input type="checkbox" name="admin" value="admin" class="form-check-input" id="admin">
										<label class="form-check-label" for="admin">Admin account?</label>
									</div>
			    				</div>
			    			</div>
							<?php
                                echo "<p class=\"error\">".$message."</p>";
                            ?> 
			    			<input type="submit" name="submit" value="Register" class="btn btn-info btn-block">
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>
</body>
</html>