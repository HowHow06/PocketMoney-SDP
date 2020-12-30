<?php
require_once('class_customer.php');
$customer = new Customer();

/**
 * 
 * @return String 
 * the JSON format of fields within Investment Edit modal
 */
if (isset($_GET['resetEditInvest'])) {
    $investment_id = $_GET['resetEditInvest'];
    $data = $customer->getOneInvestmentData("*", $investment_id);
    $dataJSON = json_encode($data);
    echo ($dataJSON);
}
