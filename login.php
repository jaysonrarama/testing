<?php
session_start();

        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST ['username'], $_POST['password'])){
            $username = $_POST ['username'];
            $password = $_POST ['password'];
        

            if($username == 'username' && $password == '123' ){
                $_SESSION['user'] = $username;
                header("Location: index.php");
                exit;
            }else{
                echo"<div style='color:red;text-align-center;'> Invalid Login </div>";
            }

        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style/bootstrap.css" rel="stylesheet">
    <title>Document</title>
</head>
<body class="bg-light">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="text-center mb-4">Login</h3>
                        <form action="index.php" method= "POST">
                            <div class="mb-3">
                                 <label for="username" class="form-label">Username</label>
                                 <input type="text" name="username" class="form-control">
                            </div>
                            <div class="mb-3">
                                 <label for="password" class="form-label">Password</label>
                                 <input type="password" name="password" class="form-control">
                            </div>
                            <button name="login" type="submit" class="btn btn-primary w-100">Login</button>
                           
                        </form>
                   
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>