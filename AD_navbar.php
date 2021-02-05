<?php

include('checkSessionCookie.php');

?>
<link rel="stylesheet" href="./style/modalbox.css">
<nav class="navbar navbar-expand-lg navbar-light">
    <a href="#" class="navbar-brand"><img src="./img/logo_i.png" width="50px" height="50px"> POCKETMONEY</a>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="admin_announcement.php?role=admin" class="nav-link">Announcement Status</a>
        </li>
        <li class="nav-item">
            <a href="admin_feedback.php?role=admin" class="nav-link">Feedback Studio</a>
        </li>
        <li class="nav-item dropdown">

            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown">Setting</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a href="admin_profile.php?role=admin" class="dropdown-item" id="updatebtn">Profile</a>
                <a href="#" class="dropdown-item">Enquiry</a>
                <a href="logout.php?role=admin" class="dropdown-item">Logout</a>
            </div> 
        </li>
    </ul>
</nav>

<!--Profile modal-->
<div class="modal fade edit-modal" id="edit-row" tabindex="-1" role="dialog" aria-labelledby="edit-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <span class="close">&times;</span>
            <section class="mb-5 text-center">
                <h4>Profile</h4>
                <hr>
                <form action="#!">
                    <div class="md-form md-outline">
                    <label class="form-control-label" for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="email" required>
                    </div>

                    <div class="md-form md-outline">
                    <label class="form-control-label" for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control form-control-alternative" placeholder="username" readonly>
                    </div>
                    <br>
                    <h4>Set a new password</h4>
                    <hr>
                    <div class="md-form md-outline">
                    <label class="form-control-label" for="newPass">New password</label>
                    <input type="password" id="newPass" class="form-control">
                    </div>

                    <div class="md-form md-outline">
                    <label class="form-control-label" for="newPassConfirm">Confirm password</label>
                    <input type="password" id="newPassConfirm" class="form-control">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary mb-4">Change password</button>
                </form>
            </section>
        </div>
    </div>
</div>
                
                
                
            