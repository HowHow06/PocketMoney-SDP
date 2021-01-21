<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(".head.php"); ?>
    <link rel="stylesheet" href="./style/register.css">
    <title>PocketMoney | Register</title>
</head>

<body onload="showProgress(50);">
    <div class="container row">
        <div class="left">
            <img src="./img/login.png">
        </div>
        <div class="progress">
            <div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="progress-bar"></div>
        </div>
        <div class="right step2">
            <a href="#" class="logo"><img src="./img/logo.png" width="50px" height="50px"> POCKETMONEY</a>
            <h5>Step 2: Confirm your email address</h5>
            <div>
                <h2><b>Hi,</b></h2>
                <p>Please verify your email address with PocketMoney.</p>
                <p>We sent an email to <a href="https://www.gmail.com" target="_blank"><?php echo $_GET['email']; ?></a></p>
                <p>
                    Just click on the link in that email to complete your sign up.
                    If you don’t see it, you may need to check your spam folder.
                </p>
                <p>Have a Great Day with PocketMoney!</p>
                <br><br>
                <h5><b>Best Regards,</b></h5>
                <h4><b>The PocketMoney Team</b></h4>
            </div>
        </div>
    </div>
</body>
<script language="JavaScript" type="text/javascript">
    function showProgress(percentage) {
        $('#progress-bar').css('width', percentage + "%");
    }
</script>
</html>