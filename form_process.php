<?php
require_once('class_customer.php');
$customer = new Customer();




if (isset($_GET['budgetEditData'])) {
    $cusID = $_GET['cusID'];
    $query = "SELECT b.*, c.categoryName FROM budget b, category c WHERE b.categoryID = c.categoryID AND b.cusID = " . $cusID;
    $data = $customer->getDataByQuery($query);
    echo ('<div class="row">
            <div class="col-12">
            <span id="edit-percentage-error">This is error mesg<br></span>
            </div>
            </div>
    ');
    $totalPercentage = 0;
    if ($data) {
        for ($i = 0; $i < sizeof($data); $i++) {
            if ($data[$i]['categoryName'] == 'other') {
                $rowOfOthers = $data[$i];
                unset($data[$i]);
                break;
            }
        }
        array_push($data, $rowOfOthers);
        foreach ($data as $budgetRow) {
            $totalPercentage += $budgetRow['percentage'];
            echo (' <div class="budget-data">
                    <input type="hidden" class="edit-budgetID" value="' . $budgetRow['budgetID'] . '">
                    <div class="form-group row">
                       <label class="col-5" for="edit_budgetCategory">Category:</label>
                       <input value="' . $budgetRow['categoryName'] . '" class="col-6 form-budgetName" list="edit_budgetCategoryList" name="edit_budgetCategory[]" autocomplete="off" required />
                       <label class="error" for="edit_budgetCategory">Please enter a valid category</label>
                       <i class="fas fa-trash col-1 align-self-center budget-delete-icon"></i>
                   </div>
                   <div class="form-group row">
                       <label class="col-5" for="edit_budgetPercentage">Percentage:</label>
                       <input class="col-6 form-budgetPercentage" type="number" step=\'1.00\' name="edit_budgetPercentage[]" value="' . $budgetRow['percentage'] . '" required />
                       <label class="error" for="edit_budgetPercentage">Total Percentage must not be larger than 100</label>
                   </div><hr>
                   </div>');
        }
    } else {
        echo (' <div class="budget-data">
                    <input type="hidden" class="edit-budgetID" ">
                    <div class="form-group row">
                       <label class="col-5" for="edit_budgetCategory">Category:</label>
                       <input class="col-6 form-budgetName" list="edit_budgetCategoryList" name="edit_budgetCategory" autocomplete="off" required />
                       <label class="error" for="edit_budgetCategory">Please enter a valid category</label>
                       <i class="fas fa-trash col-1 align-self-center budget-delete-icon"></i>
                   </div>
                   <div class="form-group row">
                       <label class="col-5" for="edit_budgetPercentage">Percentage:</label>
                       <input class="col-6 form-budgetPercentage" type="number" step=\'1.00\' name="edit_budgetPercentage" required />
                       <label class="error" for="edit_budgetPercentage">Total Percentage must not be larger than 100</label>
                   </div><hr>
                   </div>');
    }

    //the hiddent input to get the data and percentage
    echo ('<input type="hidden" id="budget-data" value="">
               <input type="hidden" id="budget-percentage" value="' . $totalPercentage . '">');

    //below is the creation of datalist, all datalist input are using the same datalist
    echo ('<datalist id="edit_budgetCategoryList">');
    $data = $customer->getDataByQuery("SELECT categoryName, categoryID FROM category
                                       WHERE categoryType <> 'income'
                                       AND categoryName <> 'other'
                                       AND (preDefine = 1 OR
                                       cusID = " . $cusID . ")
                                       ORDER BY categoryName ASC;
                                       ");
    foreach ($data as $row) {
        echo ('<option id="type' . $row['categoryName'] . '" value="' . $row['categoryName'] . '">' . $row['categoryName'] . '</option>');
    }
    echo ('</datalist>');
}


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
 * echo the JSON format of fields within Liability Edit modal
 */
if (isset($_GET['getDataLiabilityID'])) {
    $liability_id = $_GET['getDataLiabilityID'];
    $cusID = $_GET['cusID'];
    $query = "SELECT *, (l.totalAmountToPay - (l.initialPaidAmount + IFNULL((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID AND (ct.preDefine = 1 OR (ct.preDefine = 0 AND ct.cusID =" . $cusID . ")))), 0)))
    as remainder,
    l.liabilityName, 
    l.totalAmountToPay as total,
    l.initialPaidAmount + IFNULL((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID AND (ct.preDefine = 1 OR (ct.preDefine = 0 AND ct.cusID =" . $cusID . ")))), 0) as paidAmount, l.liabilityType 
    FROM liability l
    LEFT JOIN transaction tr
    ON l.liabilityName = tr.description
    AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = tr.categoryID AND (ct.preDefine = 1 OR (ct.preDefine = 0 AND ct.cusID =" . $cusID . "))) 
    WHERE l.liabilityID = " . $liability_id . "
    AND l.cusID = " . $cusID . "
    GROUP BY l.liabilityName";
    $datarow = $customer->getDataByQuery($query);
    $dataJSON = json_encode($datarow[0]);
    echo ($dataJSON);
}

/**
 * 
 * @return String 
 * the body of payment
 */
if (isset($_GET['searchPayment'])) {
    $cusID = $_GET['cusID'];
    $searchname = $_GET['searchPayment'];
    $timeFilter = $_GET['time'];
    $cateFilter = $_GET['cate'];
    if ($timeFilter == "payment-sort-date") {
        $orderSQL = "ORDER BY tr.date DESC";
    } elseif ($timeFilter == "payment-sort-name") {
        $orderSQL = "ORDER BY l.liabilityName ASC";
    }
    if ($cateFilter == 'ALL') {
        $cateFilter = '';
    }

    $datarow = $customer->getDataByQuery("SELECT *, DATE(date) as paymentdate, (l.totalAmountToPay - (l.initialPaidAmount + IFNULL((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID AND (ct.preDefine = 1 OR (ct.preDefine = 0 AND ct.cusID =" . $cusID . ")))), 0))) + tr.amount
    as remainder FROM transaction tr, liability l
    WHERE l.liabilityName = tr.description
    AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = tr.categoryID AND (ct.preDefine = 1 OR (ct.preDefine = 0 AND ct.cusID =" . $cusID . ")) )
    AND l.liabilityName LIKE '%" . $searchname . "%'
    AND l.liabilityType LIKE '%" . $cateFilter . "%'
    AND l.cusID = " . $cusID . "
    " . $orderSQL . "
    ;
    ");
    if (!empty($datarow)) {
        for ($i = 0; $i < sizeof($datarow); $i++) {
            echo ('
            <tr>
                <input type="hidden" class="paymentID" value="' . $datarow[$i]['transactionID'] . '"></input>
                <input type="hidden" class="paymentRemainder" value="' . $datarow[$i]['remainder'] . '"></input>
                <th scope="row">' . ($i + 1) . '</th>
                <td class="paymentDate">' . $datarow[$i]['paymentdate'] . '</td>
                <td class="paymentName">' . $datarow[$i]['liabilityName'] . '</td>
                <td class="paymentType">' . $datarow[$i]['liabilityType'] . '</td>
                <td class="paymentAmount">' . $datarow[$i]['amount'] . '</td>
                <td class="action">
                    <a href="#" class="edit-payment-anchor" data-toggle="modal" data-target="#edit-payment">Edit</a>
                    <span> | </span>
                    <a href="#" class="delete-payment-anchor" data-toggle="modal" data-target="#delete-payment">Delete</a>
                </td>
            </tr>
            ');
        }
    }
}


/**
 * 
 * @return String 
 * the body of liability
 */
if (isset($_GET['searchLiability'])) {
    $cusID = $_GET['cusID'];
    $searchname = $_GET['searchLiability'];
    $timeFilter = $_GET['time'];
    $cateFilter = $_GET['cate'];
    if ($timeFilter == "liability-sort-date") {
        $orderSQL = "ORDER BY l.startDate DESC";
    } elseif ($timeFilter == "liability-sort-name") {
        $orderSQL = "ORDER BY l.liabilityName ASC";
    }
    if ($cateFilter == 'ALL') {
        $cateFilter = '';
    }
    $datarow = $customer->getDataByQuery("SELECT *, (l.totalAmountToPay - (l.initialPaidAmount + IFNULL((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID AND (ct.preDefine = 1 OR (ct.preDefine = 0 AND ct.cusID =" . $cusID . ")))), 0)))
    as remainder,
    l.liabilityName, 
    l.totalAmountToPay as total,
    l.initialPaidAmount + IFNULL((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID AND (ct.preDefine = 1 OR (ct.preDefine = 0 AND ct.cusID =" . $cusID . ")))), 0) as paidAmount, l.liabilityType 
    FROM liability l
    LEFT JOIN transaction tr
    ON l.liabilityName = tr.description
    AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = tr.categoryID AND (ct.preDefine = 1 OR (ct.preDefine = 0 AND ct.cusID =" . $cusID . ")) )
    WHERE l.liabilityName LIKE '%" . $searchname . "%'
    AND l.liabilityType LIKE '%" . $cateFilter . "%'
    AND l.cusID = " . $cusID . "
    GROUP BY l.liabilityName
    " . $orderSQL . "
    ;
    ");
    if (!empty($datarow)) {
        for ($i = 0; $i < sizeof($datarow); $i++) {
            echo ('
            <tr>
            <input type="hidden" class="liabilityID" value="' . $datarow[$i]['liabilityID'] . '"></input>
            <th scope="row">' . ($i + 1) . '</th>
            <td class="liabilityDate">' . $datarow[$i]['startDate'] . '</td>
            <td class="liabilityName">' . $datarow[$i]['liabilityName'] . '</td>
            <td class="liabilityType">' . $datarow[$i]['liabilityType'] . '</td>
            <td class="liabilityTotalAmount">' . $datarow[$i]['totalAmountToPay'] . '</td>
            <td class="liabilityPaidAmount">' . number_format($datarow[$i]['paidAmount'] * 1.0, 2, ".", "") . '</td>
            <td class="liabilityRemainder">' . $datarow[$i]['remainder'] . '</td>
            <td class="liabilityInitialAmount">' . $datarow[$i]['initialPaidAmount'] . '</td>
            <td class="action">
                <a href="#" class="edit-liability-anchor" data-toggle="modal" data-target="#edit-liability">Edit</a>
                <span> | </span>
                <a href="#" class="delete-liability-anchor" data-toggle="modal" data-target="#delete-liability">Delete</a>
            </td>
        </tr>
            ');
        }
    }
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
    ORDER BY startDate DESC
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
 * @return JSON
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
 * the body of transaction table
 */
if (isset($_GET['searchTransaction'])) {
    $cusID = $_GET['cusID'];
    $searchname = $_GET['searchTransaction'];
    $typeFilter = $_GET['type'];
    $cateFilter = $_GET['cate'];
    $query = $_GET['query'];
    if ($typeFilter == "Income") {
        $typeQuery = "AND c.categoryType = 'income'";
    } elseif ($typeFilter == "Expenses") {
        $typeQuery = "AND c.categoryType = 'expenses'";
    } elseif ($typeFilter == "Investment") {
        $typeQuery = "AND c.categoryType = 'investment'";
    } elseif ($typeFilter == "Liability") {
        $typeQuery = "AND c.categoryType = 'liability'";
    } elseif ($typeFilter == "ALL") {
        $typeQuery = "AND (c.categoryType = 'income' OR c.categoryType = 'expenses' OR c.categoryType = 'investment' OR c.categoryType = 'liability')";
    }
    if ($cateFilter == 'ALL') {
        $cateFilter = '';
    }
    if (!empty($searchname)) {
        $searchnameQuery = "AND (t.description LIKE '%" . $searchname . "%' OR c.categoryName LIKE '%" . $searchname . "%')";
    } else {
        $searchnameQuery = '';
    }

    $datarow = $customer->getDataByQuery("SELECT *
    FROM Transaction t, Category c
    WHERE t.cusID = '" . $cusID . "'
    AND t.categoryID = c.categoryID"
        . $query . " " .
        $searchnameQuery . " " .
        $typeQuery . " " .
        " AND c.categoryName LIKE  '%" . $cateFilter . "%'
    ORDER BY t.date DESC
    ;");
    if (!empty($datarow)) {
        for ($i = 0; $i < sizeof($datarow); $i++) {
            if (empty($datarow[$i]['description'])) {
                $description = $datarow[$i]['categoryName'];
            } else {
                $description = $datarow[$i]['description'];
            }
            echo ('
            <tr>
                <input type="hidden" class="transactionID" value="' . ($datarow[$i]['transactionID']) . '"></input>
                <input type="hidden" class="transactionDateTime" value="' . ($datarow[$i]['date']) . '"></input>
                <th scope="row">' . (($i + 1)) . '</th>
                <td class="transactionDate">' . ($customer->getDate($datarow[$i]['transactionID'], $cusID)) . '</td>
                <td class="transactionTime">' . ($customer->getTime($datarow[$i]['transactionID'], $cusID)) . '</td>
                <td class="transactionAmount">' . ($datarow[$i]['amount']) . '</td>
                <td class="transactionCategory">' . ($datarow[$i]['categoryName']) . '</td>
                <td class="transactionName">' . ($description) . '</td>
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
 * @return JSON
 * echo the JSON format of fields consists of amount, months, datalist
 */
if (isset($_GET['cateName'])) {
    $cateName = $_GET['cateName'];
    $cusID = $_GET['cusID'];
    $month = $_GET['date'];
    $year = $_GET['year'];
    $data = $customer->getCategoryAmountJSON($cateName, $cusID, $month, $year);
    $data1 = $customer->getCategoryMonthJSON($cateName, $cusID, $month, $year);

    if (!empty($month)) {
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
                if (empty($datarow[$i]['name'])) {
                    $description = $datarow[$i]['category'];
                } else {
                    $description = $datarow[$i]['name'];
                }
                $datalist .= ('
                            <tr>
                            <input type="hidden" class="transactionID" value="' . ($datarow[$i]['transactionID']) . '"></input>
                            <input type="hidden" class="transactionDateTime" value="' . ($datarow[$i]['date']) . '"></input>
                            <th style="display:none;" class="transactionCategory">' . ($datarow[$i]['category']) . '</th>
                            <th scope="row">' . (($i + 1)) . '</th>
                            <td class="transactionDate">' . ($customer->getDate($datarow[$i]['transactionID'], $cusID)) . '</td>
                            <td class="transactionTime">' . ($customer->getTime($datarow[$i]['transactionID'], $cusID)) . '</td>
                            <td class="transactionAmount">' . ($datarow[$i]['amount']) . '</td>
                            <td class="transactionName">' . ($description) . '</td>
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
    } else {
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
                if (empty($datarow[$i]['name'])) {
                    $description = $datarow[$i]['category'];
                } else {
                    $description = $datarow[$i]['name'];
                }
                $datalist .= ('
                            <tr>
                            <input type="hidden" class="transactionID" value="' . ($datarow[$i]['transactionID']) . '"></input>
                            <input type="hidden" class="transactionDateTime" value="' . ($datarow[$i]['date']) . '"></input>
                            <th style="display:none;" class="transactionCategory">' . ($datarow[$i]['category']) . '</th>
                            <th scope="row">' . (($i + 1)) . '</th>
                            <td class="transactionDate">' . ($customer->getDate($datarow[$i]['transactionID'], $cusID)) . '</td>
                            <td class="transactionTime">' . ($customer->getTime($datarow[$i]['transactionID'], $cusID)) . '</td>
                            <td class="transactionAmount">' . ($datarow[$i]['amount']) . '</td>
                            <td class="transactionName">' . ($description) . '</td>
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


    $arr = array(['amount' => $data, 'month' => $data1, 'datalist' => $datalist]);
    $dataJSON = json_encode($arr[0]);
    echo ($dataJSON);
}
