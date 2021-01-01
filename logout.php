<?php
logout();

function logout()
{
    session_start();
    if (isset($_SESSION['customerData'])) { //execute this when admin session is set
        unset($_SESSION['customerData']);
        if (!empty($_COOKIE['customer_email']) || !empty($_COOKIE['customer_password'])) {
            setcookie("customer_email", null, time() - 3600 * 24 * 365);
            setcookie("customer_password", null, time() - 3600 * 24 * 365);
        }
    }
    // elseif (isset($_SESSION['cus_row'])) { //execute this when customer session is set
    //     unset($_SESSION['cus_row']);
    //     if (!empty($_COOKIE['cus_username']) || !empty($_COOKIE['cus_password'])) {
    //         setcookie("cus_username", null, time() - 3600 * 24 * 365);
    //         setcookie("cus_password", null, time() - 3600 * 24 * 365);
    //     }
    //     header("Location: index.php");
    // }
    header("Location: index.php");
}
