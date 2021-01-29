<!DOCTYPE html>
<html lang="en">
<head>
    <?php

    use function PHPUnit\Framework\isEmpty;

    include(".head.php"); ?>
    <link rel="stylesheet" href="./style/profile.css">

    <title>PocketMoney | Profile</title>
</head>
<body>
    <?php
        $activePage = "settings";
        include(".navbar.php");
    ?>
    <div class="container-fluid background">
        <div class="container-fluid body">
            <nav class="navbar navbar-expand-lg">
                <a href="#" class="navbar-brand">USER PROFILE</a>
            </nav>
            <div class="container-fluid">
                <div>
                    <!-- delete-row modal -->
                    <div class="modal fade edit-modal" id="edit-row" tabindex="-1" role="dialog" aria-labelledby="edit-title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <p>Are you sure all the information are correct?</p>
                                </div>
                                <div class="modal-footer">
                                    <form action="" method="POST">
                                        <input type="hidden" id="delete_investmentID" name="delete_investmentID"></input>
                                        <button type="submit" class="btn btn-primary" name="delete_submit">Save Change</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </form>
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

                    <form action="" method="post">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="name">Real Name Information</label>
                                    <input type="text" id="name" name="name" class="form-control form-control-alternative" value="Jerry Cus" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="username">Username</label>
                                    <input type="text" id="username" name="username" class="form-control form-control-alternative" value="customer1" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label class="form-control-label" for="email">Email address</label>
                                    <input type="email" id="email" name="email" class="form-control form-control-alternative" value="howard_bb@hotmail.com" required>
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
</script>
</html>