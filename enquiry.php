<!DOCTYPE html>
<html lang="en">
<head>
    <?php

    use function PHPUnit\Framework\isEmpty;

    include(".head.php"); ?>
    <link rel="stylesheet" href="./style/profile.css">

    <title>PocketMoney | Enquiry</title>
</head>
<body>
    <?php
        $activePage = "settings";
        include(".navbar.php");
    ?>
    <div class="container-fluid background">
        <div class="container-fluid body">
            <nav class="navbar navbar-expand-lg">
                <a href="#" class="navbar-brand">FEEDBACK FORM</a>
            </nav>
            <div class="container-fluid">
                <div>
                    <!-- submit-row modal -->
                    <div class="modal fade edit-modal" id="edit-row" tabindex="-1" role="dialog" aria-labelledby="edit-title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <p>Are you sure all the information are correct?</p>
                                </div>
                                <div class="modal-footer">
                                    <form action="" method="POST">
                                        <input type="hidden" id="delete_investmentID" name="delete_investmentID"></input>
                                        <button type="submit" class="btn btn-primary" name="delete_submit">Submit</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <h4 class="col-6">USER INFORMATION</h4>
                        <div class="col-6">
                            <a href="#" class="btn edit" data-toggle="modal" data-target="#edit-row">SUBMIT THE FORM</a>
                        </div>
                    </div>

                    <form action="" method="post">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="username">Username</label>
                                    <input type="text" id="username" name="username" class="form-control form-control-alternative" value="customer1" readonly>
                                </div>
                            </div>
                            <div class="col-6">
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
                        <h4 class="col-6">FEEDBACK FORM</h4>
                    </div>

                    <form action="" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="username">Content</label>
                                    <textarea type="text" id="username" name="username" class="form-control form-control-alternative" required></textarea>
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