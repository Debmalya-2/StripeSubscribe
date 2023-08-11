<?php
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
        header("location: login.php");
        exit;
    }
    $_SESSION['option']=$_COOKIE['option'];
    $priceList = ["Mobile"=>100, "Basic"=>200, "Standard"=>500, "Premium"=>700];
    $_SESSION['price']=$priceList[$_SESSION['option']];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Information</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<body style="background-color:rgb(36, 65, 138)">
<?php require "nav.php";?>
<?php
    echo '<div class="container my-5">
    <div class="card mb-5 col-md-10 mx-auto">
        <div class="row g-0">
            <div class="col-md-6">
                <div class="card-body">
                    <h5 class="card-title">Complete Payment</h5>
                    <form action="/stripe/checkout.php" method="post">
                        <div class="mb-3 col-md-9">
                            <label for="username" class="form-label">Enter your debit or credit card details below</label>
                            <input class="form-control" maxlength="11" type="text" id="uname" name="uname" aria-label="default input example" placeholder="Card number" required>
                        </div>
                        <div class="col-auto mx-1">
                            <button type="submit" class="mybtn">Confirm Payment</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h5 class="card-title">Order Summary</h5>
                    <table class="table">
                        <tbody>
                            <tr>
                            <th scope="row">Plan Name</th>
                            <td>'.$_SESSION['option'].'</td>
                            </tr>
                            <tr>
                            <th scope="row">Billing Cycle</th>
                            <td>Monthly</td>
                            </tr>
                            <tr>
                            <th scope="row">Plan Price</th>
                            <td>&#8377;'.$_SESSION['price'].'/mo</td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="card-text"><small class="text-muted">Last updated 1 min ago</small></p>
                </div>
            </div>
        </div>
    </div>
</div>';
?>
</body>
</html>