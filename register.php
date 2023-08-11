<?php
$showAlert=false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    require '_dbConnect.php';
    $uname=$_POST["uname"];
    $umail=$_POST["umail"];
    $pass=$_POST["pass"];
    $sql = "SELECT * FROM `registration` where username='$uname'";
    $result = mysqli_query($conn, $sql);
    $num=mysqli_num_rows($result);
    if($num == 1){
        $showError="Username already exist";
    }
    else{
        $sql = "INSERT INTO `registration` (`username`, `email`, `password`, `date`) VALUES ('$uname', '$umail', '$pass', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if($result){
            $showAlert=true;
        }  
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<body style="background-color:rgb(36, 65, 138)">
<?php require "nav.php";?>
    <?php
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Registered Successfully!</strong> You can now <a href="/stripe/login.php">login</a>.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    ?>
    <div class="container my-5 d-flex align-content-between">
    <div class="card mx-auto col-md-5">
        <h5 class="card-header text-center">Create Account</h5>
        <div class="card-body">
        <form action="/stripe/register.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Name</label>
                <input class="form-control" maxlength="11" type="text" id="uname" name="uname" aria-label="default input example" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="umail" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="pass" >
            </div>
            <div class="text-center"><button type="submit" class="mybtn">Sign Up</button></div>
        </form>
        <p class="my-2 text-center">Already have an account? <a href="/stripe/login.php" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Login</a></p>
        </div>
    </div>
    </div>
</body>
</html>