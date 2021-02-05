<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include(".head.php"); ?>
    <link rel="stylesheet" href="./style/enquiry.css">

    <title>PocketMoney | Enquiry</title>
</head>
<body>
    <?php
        $activePage = "settings";
        include(".navbar.php");


        if (isset($_POST['cusID'])) { //if the form is submitted
            $params = array(
                'username' => $_POST['username'], 
                'email' => $_POST['email']
            );
            $result = $customer->customerValidateUsername($params,1);
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
                    $params['tableName'] = 'Feedback';
                    $params['data'] = array(
                        'contact_name' => $_POST['username'],
                        'contact_email' => $_POST['email'],
                        'content' => $_POST['content']
                    );
                    $result = $customer->customerInsert($params);
                    if ($result['status'] == 'ok') {
                        $customer->showAlert($result['statusMsg']);
                    } else {
                        $customer->showAlert($result['statusMsg']);
                    }
                    $customer->goTo('enquiry.php?role=customer');
                }
            }
        }
    ?>
    <div class="container-fluid background">
        <div class="container-fluid body">
            <nav class="navbar navbar-expand-lg">
                <a href="#" class="navbar-brand">FEEDBACK FORM</a>
            </nav>
            <div class="container-fluid">
                <form action="" method="post">
                    <div>
                        <!-- submit-form modal -->
                        <div class="modal fade edit-modal" id="submit-form" tabindex="-1" role="dialog" aria-labelledby="form-title" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <p>Are you sure all the information are correct?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="form_submit">Submit</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <h4 class="col-6">USER INFORMATION</h4>
                            <div class="col-6">
                                <a href="#" class="btn edit" data-toggle="modal" data-target="#submit-form">SUBMIT THE FORM</a>
                            </div>
                        </div>

                        <?php
                            $result = $customer->getData("Customer"); 
                            $username = $result[0]['username'];
                            $email = $result[0]['email'];
                        ?>

                        <input type="hidden" id="cusID" name="cusID" value="<?php echo($customer->getId()); ?>"></input>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="username">Username</label>
                                    <input type="text" id="username" name="username" class="form-control form-control-alternative" value="<?php echo($username); ?>" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="email">Email address</label>
                                    <input type="email" id="email" name="email" class="form-control form-control-alternative" value="<?php echo($email); ?>" required>
                                </div>
                            </div>
                        </div> 
                    </div>

                    <hr>

                    <div>
                        <div class="row">
                            <h4 class="col-6">FEEDBACK FORM</h4>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="content">Content</label>
                                    <textarea type="text" id="content" name="content" class="form-control form-control-alternative" required></textarea>
                                </div>
                            </div>
                        </div>
                        <br><br>
                    </div>
                </form>
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