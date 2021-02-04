<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include(".head.php"); ?>
    <link rel="stylesheet" href="./style/profile.css">

    <title>PocketMoney | Profile</title>
</head>
<body>
    <?php
        $activePage = "settings";
        include(".navbar.php");


        if (isset($_POST['cusID'])) { //if the form is submitted
            $params = array(
                'name' => $_POST['name'], 
                'username' => $_POST['username'], 
                'email' => $_POST['email']
            );
            $result = $customer->customerValidateUsername($params,1);
            if ($result['status'] == 'error') { //format wrong
                $customer->showAlert($result['statusMsg']);
            }
            else {
                $result = $customer->customerValidateName($params);
                if ($result['status'] == 'error') { //format wrong
                    $customer->showAlert($result['statusMsg']);
                }
                else {
                    $result = $customer->customerValidateEmail($params,1);
                    if ($result['status'] == 'error') { //format wrong
                        $customer->showAlert($result['statusMsg']);
                    }
                    else {
                        // Validation pass
                        $params['tableName'] = 'Customer';
                        $params['idName'] = 'cusID';
                        $params['id'] = $_POST['cusID'];
                        $params['data'] = array(
                            'name' => $_POST['name'], 
                            'username' => $_POST['username'], 
                            'email' => $_POST['email']
                        );
                        $result = $customer->customerUpdate($params);
                        if ($result['status'] == 'ok') {
                            $customer->showAlert($result['statusMsg']);
                        } else {
                            $customer->showAlert($result['statusMsg']);
                        }
                        $customer->goTo('profile.php?role=customer');
                    }
                }
            }
        }
    ?>
    <div class="container-fluid background">
        <div class="container-fluid body">
            <nav class="navbar navbar-expand-lg">
                <a href="#" class="navbar-brand">USER PROFILE</a>
            </nav>
            <div class="container-fluid">
                <div>
                    <!-- edit-row modal -->
                    <div class="modal fade edit-modal" id="edit-row" tabindex="-1" role="dialog" aria-labelledby="edit-title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <p>Are you sure all the information are correct?</p>
                                </div>
                                <div class="modal-footer">
                                    <!-- <form action="" method="POST"> -->
                                        <button type="submit" class="btn btn-primary" name="edit_submit" id="edit_submit">Save Change</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <!-- </form> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <h4 class="col-6">USER INFORMATION</h4>
                        <div class="col-6">
                            <a href="#" class="btn edit" data-toggle="modal" data-target="#edit-row">SAVE CHANGE</a>
                        </div>
                    </div>

                    <?php
                        $result = $customer->getData("Customer"); 
                        $name = $result[0]['name'];
                        $username = $result[0]['username'];
                        $email = $result[0]['email'];
                    ?>

                    <form action="" method="post" id="profile_form">
                        <input type="hidden" id="cusID" name="cusID" value="<?php echo($customer->getId()); ?>"></input>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="name">Real Name Information</label>
                                    <input type="text" id="name" name="name" class="form-control form-control-alternative" value="<?php echo($name); ?>" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="username">Username</label>
                                    <input type="text" id="username" name="username" class="form-control form-control-alternative" value="<?php echo($username); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label class="form-control-label" for="email">Email address</label>
                                    <input type="email" id="email" name="email" class="form-control form-control-alternative" value="<?php echo($email); ?>"  required>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <hr>

                <div>
                    <div class="row">
                        <h4 class="col-6">PASSWORD SETTING</h4>
                    </div>

                    <form action="" method="">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="cur_pass">Current Password</label>
                                    <input type="password" id="cur_pass" name="cur_pass" class="form-control form-control-alternative">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="new_pass">New Password</label>
                                    <input type="password" id="new_pass" name="new_pass" class="form-control form-control-alternative">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="conf_pass">Confirm Password</label>
                                    <input type="password" id="conf_pass" name="conf_pass" class="form-control form-control-alternative">
                                </div>
                            </div>
                        </div>
                    </form>

                    <br><br>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
$(document).ready(function () {
    $("body").niceScroll();
    $(".transaction-table").niceScroll();
});

var form = document.getElementById("profile_form");
document.getElementById("edit_submit").addEventListener("click", function () {
  form.submit();
});
</script>
</html>