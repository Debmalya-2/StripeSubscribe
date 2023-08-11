<?php
    $login=false;
    $showError=false;
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        require '_dbConnect.php';
        $umail=$_POST["umail"];
        $pass=$_POST["pass"];

        $sql = "SELECT * FROM registration where email='$umail' AND password='$pass'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if($num==1){
            $login=true;
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['usermail']=$umail;
            header("location: plan.php");
        }
        else{
            $showError="Invalid Credentials";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<body style="background-color:rgb(36, 65, 138)">
<?php require "nav.php";?>
    <?php
        if($login){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> You are logged in.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    ?>
    <div class="container my-5 d-flex align-content-between">
    <div class="card mx-auto col-md-5 ">
        <h5 class="card-header text-center">Login to your Account</h5>
        <div class="card-body">
        <form action="/stripe/login.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="umail" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="pass" name="pass" aria-describedby="passwordHelpBlock" required>
            </div>
            <div class="text-center"><button type="submit" class="mybtn text-center">Login</button></div>
        </form>
        <p class="my-2 text-center">New to myApp? <a href="/stripe/register.php" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Sign Up</a></p>
        </div>
    </div>
    </div>
</body>
</html>