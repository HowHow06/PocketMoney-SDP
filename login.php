<?php
    if ($_GET['role'] == 'customer') {
        $display = 'show';
    }
    elseif ($_GET['role'] == 'admin'|| $_GET['role'] == 'advisor') {
        $display = 'hidden';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nerko+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style/login.css">
    <title>PocketMoney | Login</title>
</head>
<body>
    <div class="container row">
        <div class="left">
            <img src="./img/login.png">
        </div>
        <div class="right">
            <a href="#" class="logo"><img src="./img/logo.png" width="50px" height="50px"> POCKETMONEY</a>
            <h5>Sign into your account</h5>
            <form action="" method="post">
                <div class="form-group">
                    <input type="email" name="email" placeholder="Enter email address" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="showPass" id="showPass">
                    <label for="showPass" class="form-check-label">Show Password</label>
                </div>
                <button type="submit" class="btn" onclick="location.href='dashboard.php';">Login</button>
            </form>

            <?php
                if ($display == 'show') {
                    $msg = '
                        <a href="#" class="forgot">Forgot password?</a>
                        <br>
                        <a href="register.php" class="register">Don\'t have an account? Register here</a>
                    ';
                    echo $msg;
                }
            ?>
        
            <p class="terms">Term of use. Privacy Policy</p>
        </div>
    </div>
</body>
</html>