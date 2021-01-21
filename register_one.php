<?php
require_once('class_customer.php');
$customer = new Customer();
if (isset($_POST['submitbtn'])) { //if the form is submitted
    $email = $_POST['email'];
    $params = array('email' => $email);
    $result = $customer->customerValidateEmail($params);

    if ($result['status'] == 'ok') { //the email is not been used and it is usable
        $customer->sendRegisterEmail($email);
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
    <link rel="stylesheet" href="./style/register.css">
    <title>PocketMoney | Register</title>
</head>

<body onload="showProgress(15);">
    <div class="container row">
        <div class="left">
            <img src="./img/login.png">
        </div>
        <div class="progress">
            <div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="progress-bar"></div>
        </div>
        <div class="right step1">
            <a href="#" class="logo"><img src="./img/logo.png" width="50px" height="50px"> POCKETMONEY</a>
            <h5>Step 1: Verify your email address</h5>
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
                    <input type="email" name="email" placeholder="Enter email address" required>
                </div>
                <button type="submit" name="submitbtn" class="btn">Verify</button>
            </form>
        </div>
    </div>
</body>
<script language="JavaScript" type="text/javascript">
    function showProgress(percentage) {
        $('#progress-bar').css('width', percentage + "%");
    }
</script>
</html>