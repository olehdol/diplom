<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Менеджер витрат</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js" crossorigin="anonymous"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
</head>
<body>
    
     <form action="vendor/signin.php" method="POST">
        <div onclick="show('none')" id="gray"></div>
        <div id="window">
        <img class="close" onclick="show('none')" src="1/close.png">
     <div class="container">
        <h1>Sign in</h1>
        <p><b>Please fill in this form to sign in.<b></p>
        <hr>

        <label for="login"><b>Login</b></label>
        <input type="text" name="login" placeholder="Enter Login" required>
        <label for="password"><b>Password</b></label>
        <input type="password" name="password" placeholder="Enter Password" required>
        <hr>

        <button type="submit" class="signinbtn">Sign in</button>
     </div>  
     <div class=" signin">
    <p>Sign in or <button onclick="ok('block')" type="submit" class="registerbutt"><b> create an account</b></button></p>
  </div>
     <?php
        if ($_SESSION['message']){
            
            echo '<p class="msg">' . $_SESSION['message'] . '</p>';
        }
        unset ($_SESSION['message']);
     ?>
</div>
</form>




<form action="vendor/signup.php" method="POST">
<div onclick="ok('none')" id="gray1"></div>
    <div id="window1">
        <img class="close" onclick="ok('none')" src="1/close.png">
            <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="email"><b>Email</b></label>
    <input type="text" name="email" placeholder="Enter Email"  id="email" required>

    <label for="login"><b>Login</b></label>
    <input type="text" name="login" placeholder="Enter Login" required>

    <label for="password"><b>Password</b></label>
    <input type="password" name="password" placeholder="Enter Password" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" name="password_confirm" placeholder="Repeat Password"  id="psw-repeat" required>
    <hr>

    <button type="submit" class="registerbtn">Register</button>

    <?php
        if ($_SESSION['message']){
            
            echo '<p class="msg">' . $_SESSION['message'] . '</p>';
        }
        unset ($_SESSION['message']);
     ?>
  </div>
    </div> 
</form>


<div class="row">
    <div class="col-4 left-container">
        <div class="month-container">
            <div class="header fs-white">My budget</div>
            <div id="current-month" class="sub-text fs-white"></div>
            <div class="budget-container p-2 mt-4">
                <span id="month-budget" class="month-amount">₴ 0</span>
            </div>
        </div>
        <div class="chart-container">
            <canvas id="expense-chart"></canvas>
        </div>
    </div>
    <div class="col-8 right-container">
        <button class="signbutt" onclick="show('block')">Sign in</button>
        <div class="calc-container">
            <div class="header fs-dark-grey">Track Your Budget</div>
            <div class="dropdown open">
                <button class="btn btn-info dropdown-toggle"
                        type="button" id="dropdownMenu3" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    Expense Type
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" id="type-savings">Savings</a>
                    <a class="dropdown-item" id="type-expense">Expense</a>
                    <a class="dropdown-item" id="type-investment">Investment</a>
                </div>
            </div>
            <div class="mt-3 tracking-text text-capitalize sub-text bottom-border">Tracking Savings 💰</div>
            <div class="row mt-4">
                <div class="col-7">
                    <input class="form-control input-expense-description" type="text" placeholder="Description">
                </div>
                <div class="col-4">
                    <input class="form-control input-expense-value" type="number" placeholder="Value">
                </div>
                <div class="col-1">
                    <button type="button" class="btn btn-success btn-submit-expense">&check;</button>
                </div>
            </div>
            <div id='foo' class="expense-list mt-4">

            </div>

        </div>
    </div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js" ></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="app.js"></script>
<script>
   // Set the options that I want
toastr.options = {
    "closeButton": true,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}


// $(function () { //ready
//           toastr.info('If all three of these are referenced correctly, then this should toast should pop-up.');
//       });
      
      </script>
      <script>
    $(function(){
        <?php
        // toastr output & session reset
        session_start();
        if(isset($_SESSION['toastr']))
        {
            echo 'toastr.'.$_SESSION['toastr']['type'].'("'.$_SESSION['toastr']['message'].'", "'.$_SESSION['toastr']['title'].'")';
            unset($_SESSION['toastr']);
        }
        ?>          
    });
</script>   
</body>
</html>
