<?php

include('checkSessionCookie.php');

if (isset($_POST['edit_password'])) { //if the form is submitted
    $hashPassword = password_hash($_POST['newPass'], PASSWORD_BCRYPT);
    $params['tableName'] = 'admin';
    $params['idName'] = 'adminID';
    $params['id'] = $_POST['getadminID'];
    $params['data'] = array(
        'adminID' => $admin->getId(),
        'username' => $_POST['newusername'],
        'email' => $_POST['newemail'],
        'password' => $hashPassword,
    );
    $result = $admin->adminUpdate($params);
    if ($result['status'] == 'ok') {
        $admin->showAlert($result['statusMsg']);
    } else {
        $admin->showAlert($result['statusMsg']);
    }
    $admin->goTo('admin_announcement.php?role=admin');
}

?>
<!-- <link rel="stylesheet" href="./style/modalbox.css"> -->
<nav class="navbar navbar-expand-lg navbar-light">
    <a href="#" class="navbar-brand"><img src="./img/logo_i.png" width="50px" height="50px"> POCKETMONEY</a>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="admin_announcement.php?role=admin" class="nav-link">Announcement Status</a>
        </li>
        <li class="nav-item">
            <a href="admin_feedback.php?role=admin" class="nav-link">Feedback Studio</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link profile" data-toggle="modal" data-target="#profile">Profile</a>
        </li>
        <li class="nav-item">
            <a href="logout.php?role=admin" class="nav-link">Logout</a>
        </li>
    </ul>
</nav>

<?php
    $result = $admin->getData("Admin"); 
    $username = $result[0]['username'];
    $email = $result[0]['email'];
?>

<!--Profile modal-->
<div class="modal fade edit-modal" id="profile" tabindex="-1" role="dialog" aria-labelledby="edit-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <span class="close">&times;</span>
            <section class="mb-5 text-center">
                <h4>Profile</h4>
                <hr>
                <form action="" method="post" id="profile_form">
                    <input type="hidden" id="getadminID" name="getadminID" value="<?php echo($admin->getID()); ?>"></input>
                    <div class="md-form md-outline">
                    <label class="form-control-label">Email</label>
                    <input type="text" id="newemail" name="newemail" class="form-control" value="<?php echo($email); ?>" required>
                    </div>

                    <div class="md-form md-outline">
                    <label class="form-control-label">Username</label>
                    <input type="text" id="newusername" name="newusername" class="form-control form-control-alternative" placeholder="username" value="<?php echo($username); ?>" readonly>
                    </div>
                    <br>
                    <h4>Set a new password</h4>
                    <hr>
                    <div class="md-form md-outline">
                    <label class="form-control-label">New password</label>
                    <input type="password" id="newPass" name="newPass" class="form-control">
                    </div>
                    <br>
                    <button type="submit" id=edit_password name="edit_password" class="btn btn-primary mb-4">Change password</button>
                </form>
            </section>
        </div>
    </div>
</div>
<script>
var form = document.getElementById("profile_form");
document.getElementById("edit_submit").addEventListener("click", function () {
  form.submit();
});
</script>
                
                
                
            