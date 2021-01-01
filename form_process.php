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



/**
 * 
 * @return String 
 * the body of investmentTransaction
 */
if (isset($_GET['searchInvest'])) {
    $cusID = $_GET['cusID'];
    $searchname = $_GET['searchInvest'];
    $timeFilter = $_GET['time'];
    $cateFilter = $_GET['cate'];
    if ($timeFilter == "ThisMonth") {
        $timeSQL = "AND MONTH(startDate) = MONTH(CURDATE())";
    } elseif ($timeFilter == "Last3Months") {
        $timeSQL = "AND MONTH(startDate) >= MONTH(DATE_SUB(CURDATE(), INTERVAL 3 MONTH))";
    } elseif ($timeFilter == "ThisYear") {
        $timeSQL = "AND YEAR(startDate) =YEAR(CURDATE())";
    } elseif ($timeFilter == "ALL") {
        $timeSQL = "";
    }
    if ($cateFilter == 'ALL') {
        $cateFilter = '';
    }

    $datarow = $customer->getDataByQuery("SELECT *
    FROM Investment 
    WHERE cusID = '" . $cusID . "'
    AND investmentName LIKE  '%" . $searchname . "%'
    AND investmentType LIKE  '%" . $cateFilter . "%'
    " . $timeSQL . "
    ;
    ");
    if (!empty($datarow)) {
        for ($i = 0; $i < sizeof($datarow); $i++) {
            echo ('
            <tr>
                <input type="hidden" class="investmentID" value="' . ($datarow[$i]['investmentID']) . '"></input>
                <th scope="row">' . ($i + 1) . '</th>
                <td class="investDate">' . $datarow[$i]['startDate'] . '</td>
                <td class="investAmount">' . $datarow[$i]['amountInvested'] . '</td>
                <td class="investName">' . $datarow[$i]['investmentName'] . '</td>
                <td class="investType">' . $datarow[$i]['investmentType'] . '</td>
                <td class="investRate">' . $datarow[$i]['ratePerAnnum'] . '</td>
                <td class="action">
                    <a href="#" class="edit-investment-anchor" data-toggle="modal" data-target="#edit-row">Edit</a>
                    <span> | </span>
                    <a href="#" class="delete-investment-anchor" data-toggle="modal" data-target="#delete-row">Delete</a>
                </td>
            </tr>
            ');
        }
    }
}
