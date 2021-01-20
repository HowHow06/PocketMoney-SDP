<?php

include('checkSessionCookie.php');

?>

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
                <a href="#" class="dropdown-item">Profile</a>
                <a href="#" class="dropdown-item">Enquiry</a>
                <a href="logout.php?role=admin" class="dropdown-item">Logout</a>
            </div>
        </li>
    </ul>
</nav>
