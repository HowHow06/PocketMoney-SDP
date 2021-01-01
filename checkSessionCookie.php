<?php
require_once('class_customer.php');
$customer = new Customer();
$customer->checksession();
$customer->setId($_SESSION['customerData']['cusID']);
