<?php
if (isset($_GET['role']))
{
    if ($_GET['role'] == 'customer') {
        require_once('class_customer.php');
        $customer = new Customer();
        $customer->checksession();
        $customer->setId($_SESSION['customerData']['cusID']);
    }
    
    if ($_GET['role'] == 'admin') {
        require_once('class_admin.php');
        $admin = new Admin();
        $admin->checksession();
        $admin->setId($_SESSION['adminData']['adminID']);
    }
}

// if (isset($role)) {
//     if ($role == 'customer') {
//         require_once('class_customer.php');
//         $customer = new Customer();
//         $customer->checksession();
//         $customer->setId($_SESSION['customerData']['cusID']);
//     }

//     if ($role == 'admin') {
//         require_once('class_admin.php');
//         $admin = new Admin();
//         $admin->checksession();
//         $admin->setId($_SESSION['adminData']['adminID']);
//     }
// }
