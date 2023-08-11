<?php
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
        header("location: login.php");
        exit;
    }
    if(isset($_POST["id"])){
        $_SESSION['option']=$_POST["id"];
        $priceList = ["Mobile"=>100, "Basic"=>200, "Standard"=>500, "Premium"=>700];
        $_SESSION['price']=$priceList[$_SESSION['option']];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription</title>
    <link rel="stylesheet" href="plan.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</head>
<body style="display:block">
    <?php require "nav.php";?>
    <div class="container">
        <table class="table">
            <thead>
                <div class="toggle-switch">
                    <div class="switches-container">
                        <input type="radio" id="switchMonthly" name="switchPlan" value="Monthly" checked="checked"  onCLick="toggleChange('Monthly')"/>
                        <input type="radio" id="switchYearly" name="switchPlan" value="Yearly"  onCLick="toggleChange('Yearly')"/>
                        <label for="switchMonthly">Monthly</label>
                        <label for="switchYearly">Yearly</label>
                        <div class="switch-wrapper">
                            <div class="switch">
                                <div>Monthly</div>
                                <div>Yearly</div>
                            </div>
                        </div>
                    </div>
                
                    <div class="state-on state mobile box arrow-bottom">Mobile</div>
                    <div class="state-off state basic box">Basic</div>
                    <div class="state-off state standard box">Standard</div>
                    <div class="state-off state premium box">Premium</div>
                </div>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Monthly Price</th>
                    <td>&#8377;100</td>
                    <td>&#8377;200</td>
                    <td>&#8377;500</td>
                    <td>&#8377;700</td>
                </tr>
                <tr>
                    <th scope="row">Video Quality</th>
                    <td>Good</td>
                    <td>Good</td>
                    <td>Better</td>
                    <td>Best</td>
                </tr>
                <tr>
                    <th scope="row">Resolution</th>
                    <td>480p</td>
                    <td>480p</td>
                    <td>1080p</td>
                    <td>4K+HDR</td>
                </tr>
                <tr>
                    <th scope="row">Devices you can use to watch</th>
                    <tr>
                        <th scope="row"></th>
                        <td>Phone</td>
                        <td>Phone</td>
                        <td>Phone</td>
                        <td>Phone</td>
                    </tr>
                    <tr>
                    <th scope="row"></th>
                        <td>Tablet</td>
                        <td>Tablet</td>
                        <td>Tablet</td>
                        <td>Tablet</td>
                    </tr>
                    <tr>
                    <th scope="row"></th>
                        <td></td>
                        <td>Computer</td>
                        <td>Computer</td>
                        <td>Computer</td>
                    </tr>
                    <th scope="row"></th>
                        <td></td>
                        <td>TV</td>
                        <td>TV</td>
                        <td>TV</td>
                    </tr>
                </tr>
            </tbody>
        </table>
        <div class="text-center"><button type="button" onClick="change()" class="mybtn" data-toggle="button" aria-pressed="false" autocomplete="off">Next</button></div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script>
        let option = "Mobile";
        function toggleChange(change){
            console.log(change);
        }
        function change(){
                document.cookie="option="+option;
                console.log(document.cookie);
                window.location.href = "/stripe/info.php";
        }
        const toggleSwitchUI = (() => {
            const allSwitches = document.querySelectorAll(".toggle-switch");
            
            allSwitches.forEach(myswitch => {

                const mobile = myswitch.querySelector(".mobile");
                const basic = myswitch.querySelector(".basic");
                const standard = myswitch.querySelector(".standard");
                const premium = myswitch.querySelector(".premium");
                
                
                mobile.classList.add("activated-state-on");
                basic.classList.add("activated-state-off");
                standard.classList.add("activated-state-off");
                premium.classList.add("activated-state-off");

                function resetState() {
                    mobile.classList.remove("activated-state-on");
                    mobile.classList.remove("arrow-bottom");
                    basic.classList.remove("activated-state-on");
                    basic.classList.remove("arrow-bottom");
                    standard.classList.remove("activated-state-on");
                    standard.classList.remove("arrow-bottom");
                    premium.classList.remove("activated-state-on");
                    premium.classList.remove("arrow-bottom");
                }

                mobile.addEventListener("click", function () {
                    resetState();
                    option="Mobile";
                    mobile.classList.add("arrow-bottom");
                    mobile.classList.add("activated-state-on");
                    basic.classList.add("activated-state-off");
                    standard.classList.add("activated-state-off");
                    premium.classList.add("activated-state-off");
                });

                basic.addEventListener("click", function () {
                    resetState();
                    option="Basic";
                    basic.classList.add("arrow-bottom");
                    mobile.classList.add("activated-state-off");
                    basic.classList.add("activated-state-on");
                    standard.classList.add("activated-state-off");
                    premium.classList.add("activated-state-off");
                });

                standard.addEventListener("click", function () {
                    resetState();
                    option="Standard";
                    standard.classList.add("arrow-bottom");
                    mobile.classList.add("activated-state-off");
                    basic.classList.add("activated-state-off");
                    standard.classList.add("activated-state-on");
                    premium.classList.add("activated-state-off");
                });

                premium.addEventListener("click", function () {
                    resetState();
                    option="Premium";
                    premium.classList.add("arrow-bottom");
                    mobile.classList.add("activated-state-off");
                    basic.classList.add("activated-state-off");
                    standard.classList.add("activated-state-off");
                    premium.classList.add("activated-state-on");
                });
            });
            
        })();
    </script>
</body>
</html>