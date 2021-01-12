<?php
require_once('class_customer.php');
$customer = new Customer();

/**
 * 
 * echo the JSON format of fields within Investment Edit modal
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


/**
 * 
 * echo the JSON format of data for investment summary edit modal
 */
if (isset($_GET['editGeneralInvestName'])) {
    $cusID = $_GET['cusID'];
    $investName = $_GET["editGeneralInvestName"];
    $data = $customer->getDataByQuery(
        "SELECT investmentID, investmentName, investmentType, SUM(amountInvested) AS sumAmount, CAST(AVG(ratePerAnnum) AS DECIMAL(10,2)) AS avgRate 
    FROM Investment 
    WHERE cusID = '" . $cusID . "'
    AND investmentName = '" . $investName . "'
    GROUP BY investmentName
    ORDER BY sumAmount DESC;
    "
    );
    $dataJSON = json_encode($data[0]);
    echo ($dataJSON);
}

/**
 * 
 * echo the JSON format of fields within Transaction Edit modal
 */
if (isset($_GET['resetEditTransaction'])) {
    $transaction_id = $_GET['resetEditTransaction'];
    $cusID = $_GET['cusID'];
    $data = $customer->getDataByQuery("SELECT t.transactionID, c.categoryName, t.date, t.amount, t.description, c.categoryType
                                FROM transaction t, category c
                                WHERE t.cusID = '" . $cusID . "' 
                                AND t.transactionID = '" . $transaction_id . "' 
                                AND t.categoryID = c.categoryID
                                ORDER BY t.date DESC;
                                ");
    $dataJSON = json_encode($data[0]);
    echo ($dataJSON);
}

/**
 * 
 * @return String 
 * the body of transaction
 */
if (isset($_GET['searchTransaction'])) {
    $cusID = $_GET['cusID'];
    $searchname = $_GET['searchTransaction'];
    $typeFilter = $_GET['type'];
    $cateFilter = $_GET['cate'];
    $query = $_GET['query'];
    if ($typeFilter == "Income") {
        $typeSQL = "income";
    } elseif ($typeFilter == "Expenses") {
        $typeSQL = "expenses";
    } elseif ($typeFilter == "ALL") {
        $typeSQL = '';
    }
    if ($cateFilter == 'ALL') {
        $cateFilter = '';
    }
    if (empty($searchname)) {
        $searchname = '';
    }

    $datarow = $customer->getDataByQuery("SELECT *
    FROM Transaction t, Category c
    WHERE t.cusID = '" . $cusID . "'
    AND t.categoryID = c.categoryID"
    . $query .
    " AND t.description LIKE '%" . $searchname . "%'
    AND c.categoryType LIKE  '%" . $typeSQL . "%'
    AND c.categoryName LIKE  '%" . $cateFilter . "%'
    ORDER BY t.date DESC
    ;");
    if (!empty($datarow)) {
        for ($i = 0; $i < sizeof($datarow); $i++) {
            echo ('
            <tr>
                <input type="hidden" class="transactionID" value="' . ($datarow[$i]['transactionID']) . '"></input>
                <input type="hidden" class="transactionDateTime" value="' . ($datarow[$i]['date']) . '"></input>
                <th scope="row">' . (($i + 1)) . '</th>
                <td class="transactionDate">' . ($customer->getDate($datarow[$i]['transactionID'],$cusID)) . '</td>
                <td class="transactionTime">' . ($customer->getTime($datarow[$i]['transactionID'],$cusID)) . '</td>
                <td class="transactionAmount">' .($datarow[$i]['amount']) . '</td>
                <td class="transactionCategory">' . ($datarow[$i]['categoryName']) . '</td>
                <td class="transactionName">' . ($datarow[$i]['description']) . '</td>
                <td class="transactionType">' . ($datarow[$i]['categoryType']) . '</td>
                <td class="action">
                    <a href="#" class="edit-transaction-anchor" data-toggle="modal" data-target="#edit-row">Edit</a>
                    <span> | </span>
                    <a href="#" class="delete-transaction-anchor" data-toggle="modal" data-target="#delete-row">Delete</a>
                </td>
            </tr>
            ');
        }
    }
}

/**
 * 
 * echo the JSON format of fields within Transaction Edit modal
 */
if (isset($_GET['cateName'])) {
    $cateName = $_GET['cateName'];
    $cusID = $_GET['cusID'];
    $month = $_GET['date'];
    $year = $_GET['year'];
    $data = $customer->getCategoryAmountJSON($cateName,$cusID,$month,$year);
    $data1 = $customer->getCategoryMonthJSON($cateName,$cusID,$month,$year);
    
    if (!empty($month)) 
    {  
        // table
        $datarow = $customer->getDataByQuery("SELECT t.transactionID, c.categoryName AS category, t.date, t.amount, t.description AS name, c.categoryType AS type
                                                FROM transaction t, category c
                                                WHERE t.cusID = " . $cusID . " 
                                                AND c.categoryName = '" . $cateName . "' 
                                                AND MONTH(t.date) = " . $month . "
                                                AND YEAR(t.date) = " . $year . "
                                                AND t.categoryID = c.categoryID
                                                ORDER BY t.date DESC;
                                            ");
        if (!empty($datarow)) {
            $datalist = "";
            for ($i = 0; $i < sizeof($datarow); $i++) {
            $datalist .= ('
                            <tr>
                            <input type="hidden" class="transactionID" value="' . ($datarow[$i]['transactionID']) . '"></input>
                            <input type="hidden" class="transactionDateTime" value="' . ($datarow[$i]['date']) . '"></input>
                            <th style="display:none;" class="transactionCategory">' . ($datarow[$i]['category']) . '</th>
                            <th scope="row">' . (($i + 1)) . '</th>
                            <td class="transactionDate">' . ($customer->getDate($datarow[$i]['transactionID'],$cusID)) . '</td>
                            <td class="transactionTime">' . ($customer->getTime($datarow[$i]['transactionID'],$cusID)) . '</td>
                            <td class="transactionAmount">' .($datarow[$i]['amount']) . '</td>
                            <td class="transactionName">' . ($datarow[$i]['name']) . '</td>
                            <td class="transactionType">' . ($datarow[$i]['type']) . '</td>
                            <td class="action">
                            <a href="#" class="edit-transaction-anchor" data-toggle="modal" data-target="#edit-row">Edit</a>
                            <span> | </span>
                            <a href="#" class="delete-transaction-anchor" data-toggle="modal" data-target="#delete-row">Delete</a>
                            </td>
                            </tr>
                        ');
            }
        }
    }
    else 
    {
        // table
        $datarow = $customer->getDataByQuery("SELECT t.transactionID, c.categoryName AS category, t.date, t.amount, t.description AS name, c.categoryType AS type
                                                FROM transaction t, category c
                                                WHERE t.cusID = " . $cusID . " 
                                                AND c.categoryName = '" . $cateName . "' 
                                                AND YEAR(t.date) = " . $year . "
                                                AND t.categoryID = c.categoryID
                                                ORDER BY t.date DESC;
                                            ");
        if (!empty($datarow)) {
            $datalist = "";
            for ($i = 0; $i < sizeof($datarow); $i++) {
                $datalist .= ('
                            <tr>
                            <input type="hidden" class="transactionID" value="' . ($datarow[$i]['transactionID']) . '"></input>
                            <input type="hidden" class="transactionDateTime" value="' . ($datarow[$i]['date']) . '"></input>
                            <th style="display:none;" class="transactionCategory">' . ($datarow[$i]['category']) . '</th>
                            <th scope="row">' . (($i + 1)) . '</th>
                            <td class="transactionDate">' . ($customer->getDate($datarow[$i]['transactionID'],$cusID)) . '</td>
                            <td class="transactionTime">' . ($customer->getTime($datarow[$i]['transactionID'],$cusID)) . '</td>
                            <td class="transactionAmount">' .($datarow[$i]['amount']) . '</td>
                            <td class="transactionName">' . ($datarow[$i]['name']) . '</td>
                            <td class="transactionType">' . ($datarow[$i]['type']) . '</td>
                            <td class="action">
                            <a href="#" class="edit-transaction-anchor" data-toggle="modal" data-target="#edit-row">Edit</a>
                            <span> | </span>
                            <a href="#" class="delete-transaction-anchor" data-toggle="modal" data-target="#delete-row">Delete</a>
                            </td>
                            </tr>
                        ');
            }
        }
    }
    

    $arr = array(['amount'=>$data,'month'=>$data1,'datalist'=>$datalist]);
    $dataJSON = json_encode($arr[0]);
    echo ($dataJSON);
}

