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
    <div class="container my-5 d-flex align-content-between">
    <div class="card mx-auto col-md-5 ">
        <h5 class="card-header text-center">Login to your Account</h5>
        <div class="card-body">
        <?php
            if($showError){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                <strong>Failure!</strong> Invalid Credentials.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }
        ?>
        <form action="/stripe/login.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="umail" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="pass" name="pass" aria-describedby="passwordHelpBlock" required>
            </div>
            <div class="text-center"><button type="submit" name="submit" class="mybtn text-center">Login</button></div>
        </form>
        <p class="my-2 text-center">New to myApp? <a href="/stripe/register.php" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Sign Up</a></p>
        </div>
    </div>
    </div>
</body>
</html>
