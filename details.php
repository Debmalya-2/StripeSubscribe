<?php
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
        header("location: login.php");
        exit;
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summary</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<body style="background-color:rgb(36, 65, 138)">
<?php require "nav.php";?>
<?php echo '<div class="card mx-auto my-5" style="width: 30rem;">
  <div class="card-body">
  <div style="display:flex;justify-content: space-between;"><div style="display:flex;"><h5 class="card-title">Current Plan Details </h5>
    <p class="text-white bg-success mx-2 px-2 rounded state">Active</p></div><div class="cancel" style="cursor:pointer" onClick="changeState()">Cancel</div></div>
    <h6 class="card-subtitle mb-2 text-muted">'.$_SESSION['option'].'</h6>
    <h2 class="card-subtitle mb-2 ">&#8377;'.$_SESSION['price'].'/mo</h2>
    <p class="card-text bg-light p-2">Your subscription has started on ';
    $mydate=getdate(date("U"));
    echo "$mydate[month] $mydate[mday], $mydate[year]".' and will auto renew on next month.</p>
  </div>
</div>';
?>
<script>
    function changeState(){
        var currentdate = new Date(); 
        const state = document.querySelector(".state");
        state.textContent="Cancelled";
        state.classList.remove("bg-success");
        const cancel = document.querySelector(".cancel");
        cancel.textContent="";
        state.classList.add("bg-danger");
        const cardText = document.querySelector(".card-text");
        cardText.textContent="Your subscription was cancelled and you will loose access to services.";
    }
</script>
</body>
</html>