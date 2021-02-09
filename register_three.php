<?php
require_once('class_customer.php');
$customer = new Customer();
if (isset($_POST['submitbtn'])) { //if the sign up form is submitted

    $params = array(
        'email' => $_POST['email'], 
        'name' => $_POST['name'], 
        'username' => $_POST['username'], 
        'password' => $_POST['password'],
        'passwordConf' => $_POST['passwordConf']
    );
    $result = $customer->customerValidateUsername($params);
    if ($result['status'] == 'error') { //wrong credential
        $error = true;
    }
    else {
        $result = $customer->customerValidateName($params);
        if ($result['status'] == 'error') { //wrong credential
            $error = true;
        }
        else {
            $result = $customer->customerValidatePassword($params);
            if ($result['status'] == 'error') { //wrong credential
                $error = true;
            }
            else {
                // Validation pass
                $hashPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $params['tableName'] = 'Customer';
                $params['data'] = array(
                    'email' => $_POST['email'], 
                    'name' => $_POST['name'], 
                    'username' => $_POST['username'], 
                    'password' => $hashPassword
                );
                $result = $customer->customerInsert($params);
                if ($result['status'] == 'ok') { //successfully register
                    sleep(2);
                    header("Location:login.php?role=customer&welcome=welcome");
                }
                if ($result['status'] == 'error') { //wrong credential
                    $error = true;
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(".head.php"); ?>
    <link rel="stylesheet" href="./style/register.css">
    <title>PocketMoney | Register</title>
</head>

<body onload="showProgress(80);">
    <div class="container row">
        <div class="left">
            <img src="./img/login.png">
        </div>
        <div class="progress">
            <div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="progress-bar"></div>
        </div>
        <div class="right step3">
            <a href="#" class="logo"><img src="./img/logo.png" width="50px" height="50px"> POCKETMONEY</a>
            <h5>Step 3: Create your personal account</h5>
            <?php
            if (isset($error)) {
                $errorMsg =
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-bottom:0; width:400px;">' . $result['statusMsg'] .
                    '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
                echo ($errorMsg);
            }
            ?>
            <form action="" method="post">
                <div class="form-group">
                    <input type="email" name="email" value="<?php echo ($_GET['email']); ?>" required readonly>
                </div>
                <div class="form-group">
                    <input type="text" name="name" placeholder="Enter real name information" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input type="text" name="username" placeholder="Enter username" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" placeholder="Password" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input type="password" name="passwordConf" id="passwordConf" placeholder="Re-enter password" autocomplete="off" required>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="showPass" id="showPass" onchange="showpass()">
                    <label for="showPass" class="form-check-label">Show Password</label>
                </div>
                <button type="submit" name="submitbtn" class="btn">Sign Up</button>
            </form>
        </div>
    </div>
</body>
<script language="JavaScript" type="text/javascript">
    function showProgress(percentage) {
        $('#progress-bar').css('width', percentage + "%");
    }

    function showpass() {
            var x = document.getElementById("password");
            var y = document.getElementById("passwordConf");
            if (x.type === "password") {
                x.type = "text";
                y.type = "text";
            } else {
                x.type = "password";
                y.type = "password";
            }
    }
</script>
</html>