<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(".head.php"); ?>
    <link rel="stylesheet" href="./style/admin.css">
      <link rel="stylesheet" href="./style/account_setting.css">
    <title>PockeyMoney | Dashboard</title>
</head>
<body>
    <?php include("AD_navbar.php"); ?>
    <div class="container-fluid background">
      <div class="container-fluid">
          <div class="container-fluid body announcement">
                <nav class="navbar navbar-expand-lg">
                 <a href="#" class="navbar-brand">PROFILE SETTING</a>
                </nav>

                    <div class="settings-page">
                     <div class="settings-container">
                        <h1 class="page-title">Account</h1>
                          <div class="settings-section">
                        <h2 class="settings-title">General Information</h2>
                        <div>
                        <div class="non-active-form">
                        <p class="capitalize">Username</p>
                        </div>
                        </div>
                        <div>
                        <div class="non-active-form">
                            <p class="capitalize">Name</p>
                        </div>
                        </div>
                        <div>
                        <div class="non-active-form">
                            <p>abc@mail.com</p><i class="fas fa-pen"></i>
                        </div>
                        </div>
                    </div>
                    <div class="settings-section">
                    <h2 class="settings-title">Password</h2>
                    <form class="form my-form">
                        <div class="form-group">
                        <div class="input-group">
                            <input name="currentPassword" placeholder="Old Password" type="password" class="form-control" autocomplete="Old Password" value="">
                            <span class="focus-input"></span>
                        </div>
                        </div>
                        <div class="form-group">
                        <div class="input-group">
                            <input name="password" placeholder="New Password" type="password" class="form-control" autocomplete="New Password" value="">
                            <span class="focus-input"></span>
                        </div>
                        </div>
                    <div class="form-submit right">
                        <button class="btn button full" type="submit" disabled="">Change Password</button>
                        </div>
                    </form>
                    </div>
                    </div>
                    </div>
                 
             </div>
        </div>
    </div>


</body>
</html>
