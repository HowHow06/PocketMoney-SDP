<?php
require_once('class_customer.php');
$customer = new Customer();
require_once('class_admin.php');
$admin = new Admin();
if ($_GET['role'] == 'customer') {
    if ($customer->havesession()) {
        header("location:dashboard.php?role=customer"); //if the cookie or session is empty, go to dashboard
    }
    $display = 'show';
    $form = 'login.php?role=customer';
} elseif ($_GET['role'] == 'admin') {
    if ($admin->havesession()) {
        header("location:admin_announcement.php?role=admin"); //if the cookie or session is empty, go to dashboard
    }
    $display = 'hidden';
    $form = 'login.php?role=admin';
}

if (isset($_GET['welcome'])) {
    if ($_GET['welcome'] == 'welcome') {
        $customer->showAlert('Successful register.');
    }
}

if (isset($_POST['submitbtn'])) { //if the login form is submitted

    if ($_GET['role'] == 'customer') {
        $params = array('loginInfo' => $_POST['email'], 'password' => $_POST['password']);
        $result = $customer->customerLogin($params);
    }

    if ($_GET['role'] == 'admin') {
        //admin login here
        $params = array('loginInfo' => $_POST['email'], 'password' => $_POST['password']);
        $result = $admin->adminLogin($params);
    }

    if ($result['status'] == 'ok') { //successfully login
        $userdata = $result['data'];
        //set session
        if ($_GET['role'] == 'customer') {
            $customer->setSession('customerData', $userdata);
            //if the user choose to "remember me", store the credential into cookie
            if (!empty($_POST["rememberMe"])) {
                if ($_GET['role'] == 'customer') {
                    setcookie("customer_email", $userdata['email'], time() + 3600 * 24 * 365);
                    setcookie("customer_password", $_POST['password'], time() + 3600 * 24 * 365);
                }
            }
            header("Location:dashboard.php?role=customer");
        }
        if ($_GET['role'] == 'admin') {
            //set adminData session here
            $admin->setSession('adminData', $userdata);
            //if the user choose to "remember me", store the credential into cookie
            if (!empty($_POST["rememberMe"])) {
                if ($_GET['role'] == 'admin') {
                    //set adminData cookie here
                    setcookie("admin_email", $userdata['email'], time() + 3600 * 24 * 365);
                    setcookie("admin_password", $_POST['password'], time() + 3600 * 24 * 365);
                }
            }
            header("Location:admin_announcement.php?role=admin");
        }
    }

    if ($result['status'] == 'error') { //wrong credential
        $error = true;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(".head.php"); ?>
    <link rel="stylesheet" href="./style/login.css">
    <title>PocketMoney | Login</title>
    <script>
        function showpass() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</head>

<body>
    <div class="container row">
        <div class="left">
            <img src="./img/login.png">
        </div>
        <div class="right">
            <a href="#" class="logo"><img src="./img/logo.png" width="50px" height="50px"> POCKETMONEY</a>
            <h5>Sign into your account</h5>
            <br>
            <span>For testing purpose, use "customer1" as username and "customer"as password</span>
            <br>
            <span>or "admin1" and "admin" for admin account</span>
            <?php
            if (isset($error)) {
                $errorMsg =
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-bottom:0;">' . $result['statusMsg'] .
                    '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
                echo ($errorMsg);
            }
            ?>
            <form action="<?php echo ($form); ?>" method="post">
                <div class="form-group">
                    <input type="text" name="email" placeholder="Enter email address or username" autocomplete="off" required>

                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" id="password" autocomplete="off" required>

                </div>
                <div class="form-check">
                    <input type="checkbox" name="showPass" id="showPass" onchange="showpass()">
                    <label for="showPass" class="form-check-label">Show Password</label>
                </div>
                <div class=" form-check">
                    <input type="checkbox" name="rememberMe" id="rememberMe">
                    <label for="rememberMe" class="form-check-label">Remember Me</label>
                </div>
                <button type=" submit" name="submitbtn" class="btn">Login</button>
            </form>

            <?php
            if ($display == 'show') {
                $msg = '
                        <a href="#" class="forgot">Forgot password?</a>
                        <br>
                        <a href="register_one.php" class="register">Don\'t have an account? Register here</a>
                    ';
                echo $msg;
            }
            ?>

            <p class="terms">Term of use. Privacy Policy</p>
        </div>
    </div>
</body>

</html>