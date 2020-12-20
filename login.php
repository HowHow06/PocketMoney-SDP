<?php
if ($_GET['role'] == 'customer') {
    $display = 'show';
} elseif ($_GET['role'] == 'admin' || $_GET['role'] == 'advisor') {
    $display = 'hidden';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(".head.php"); ?>
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