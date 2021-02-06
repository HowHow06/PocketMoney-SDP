<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(".head.php"); ?>
    <link rel="stylesheet" href="./style/dashboard.css">
    <title>PockeyMoney | Dashboard</title>
</head>

<body>
    <?php
    $activePage = "dashboard";
    include(".navbar.php");
    $customer->setCurDate();
    ?>

    <div class="container-fluid background">
        <div class="col-6 left-body">
            <div class="container-fluid body transaction">
                <nav class="navbar navbar-expand-lg">
                    <a href="#" class="navbar-brand">RECENT TRANSACTIONS</a>
                </nav>
                <!-- table -->
                <table class="table table-bordered table-hover transaction-table table-sm" id="overallTransactionTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">DATE</th>
                            <!-- <th scope="col">TIME</th> -->
                            <th scope="col">AMOUNT</th>
                            <th scope="col">CATEGORY</th>
                            <th scope="col">NAME</th>
                            <th scope="col">TYPE</th>
                        </tr>
                    </thead>
                    <tbody id="overallTransactionTableBody">

                        <?php
                        // $datarow = $customer->getDataByQuery("SELECT t.transactionID, c.categoryName AS category, t.date, t.amount, t.description AS name, c.categoryType AS type
                        //                                         FROM transaction t
                        //                                         RIGHT JOIN category c
                        //                                         ON t.categoryID = c.categoryID
                        //                                         WHERE t.cusID = " . $customer->getId() . " 
                        //                                         AND (c.categoryType = 'income'
                        //                                         OR c.categoryType = 'expenses')"
                        //     . $customer->getCurrentDateQuery() .
                        //     " ORDER BY date DESC
                        //                                         LIMIT 15;
                        //                                         ");
                        $datarow = $customer->getDataByQuery("SELECT t.transactionID, c.categoryName AS category, t.date, t.amount, t.description AS name, c.categoryType AS type 
                        FROM transaction t 
                        RIGHT JOIN category c 
                        ON t.categoryID = c.categoryID 
                        WHERE t.cusID = " . $customer->getId() . " 
                        ORDER BY date DESC 
                        LIMIT 15;
                                                                ");

                        if (!empty($datarow)) {
                            for ($i = 0; $i < sizeof($datarow); $i++) {
                                if (empty($datarow[$i]['name'])) {
                                    $description = $datarow[$i]['category'];
                                } else {
                                    $description = $datarow[$i]['name'];
                                }
                        ?>
                                <tr>
                                    <input type="hidden" class="transactionID" value='<?php echo ($datarow[$i]['transactionID']); ?>'></input>
                                    <input type="hidden" class="transactionDateTime" value='<?php echo ($datarow[$i]['date']); ?>'></input>
                                    <th scope="row"><?php echo (($i + 1)); ?></th>
                                    <td class="transactionDate"><?php print_r($customer->getDate($datarow[$i]['transactionID'])); ?></td>
                                    <!-- <td class="transactionTime"><?php //print_r($customer->getTime($datarow[$i]['transactionID'])); 
                                                                        ?></td> -->
                                    <td class="transactionAmount"><?php echo ($datarow[$i]['amount']); ?></td>
                                    <td class="transactionCategory"><?php echo ($datarow[$i]['category']); ?></td>
                                    <td class="transactionName"><?php echo ($description); ?></td>
                                    <td class="transactionType"><?php echo ($datarow[$i]['type']); ?></td>
                                </tr>
                        <?php
                            }
                        } ?>
                    </tbody>
                </table>
                <br>
            </div>

            <div class="container-fluid body budget">
                <nav class="navbar navbar-expand-lg">
                    <a href="#" class="navbar-brand">BUDGETS</a>
                </nav>
                <div class="container-fluid budget-overview">
                    <?php
                    // $customer = new Customer();
                    $query = "SELECT * FROM budget b, category c WHERE b.categoryID = c.categoryID AND b.cusID = " . $customer->getId();
                    $data = $customer->getDataByQuery($query);
                    if (!empty($data)) {
                        for ($i = 0; $i < sizeof($data); $i++) {
                            if ($data[$i]['categoryName'] == 'other') {
                                $rowOfOthers = $data[$i];
                                unset($data[$i]);
                                break;
                            }
                        }
                        if (!empty($rowOfOthers))
                            array_push($data, $rowOfOthers);
                        $count = 0;
                        $customer->setCurDate();
                        $d = strtotime($customer->getCurDate());
                        $systemMonth = date("m", $d);
                        $systemYear = date("Y", $d);
                        foreach ($data as $row) {
                            $totalIncome = $customer->getTotalIncome();
                            $totalAmount = floatval($row['percentage']) / 100.0 * $totalIncome * 1.0;
                            if ($row['categoryName'] == "other") {
                                $getCateTypeSubQuery = "SELECT categoryType FROM Category WHERE categoryID = tr.categoryID";
                                $cateIdsSubQuery = "SELECT b.categoryID FROM budget b WHERE b.cusID = " . $customer->getId(); //get all categoryID in budget
                                $query = "SELECT SUM(tr.amount) as usedAmount 
                                FROM Transaction tr 
                                WHERE tr.cusID = 1 
                                AND (" . $getCateTypeSubQuery . ") <> 'income'
                                AND tr.categoryID NOT IN (" . $cateIdsSubQuery . ")
                                AND MONTH(tr.date) = " . $systemMonth . " AND YEAR(tr.date) = " . $systemYear . " 
                                "; //select amount of those categories that are not in budget

                                $amountResults = $customer->getDataByQuery($query);
                            } else {
                                $amountResults = $customer->getData("Transaction", "SUM(amount) as usedAmount", array('categoryID' => $row['categoryID'], 'cusID' => $customer->getId(), 'MONTH(date)' => $systemMonth, 'YEAR(date)' => $systemYear));
                            }
                            $amountUsed = $amountResults[0]['usedAmount']; //the amount used
                            if (!$amountUsed)
                                $amountUsed = 0; //if the record is not found in transaction table, the budget is not used at all
                            $amountUsedPercentage = floatval($amountUsed) / $totalAmount * 100.0;
                            $amountLeft = $totalAmount - $amountUsed;
                    ?>
                            <div class="budget-row">
                                <div class="row">
                                    <div class="col-3">
                                        <div>
                                            <sub><?php echo ($row['categoryName']); ?></sub>
                                        </div>
                                        <p>RM <?php echo (number_format($totalAmount * 1.0, 2, ".", "")); ?></p>
                                    </div>
                                    <div class="col-9">
                                        <!-- bar -->
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo (number_format($amountUsedPercentage * 1.0, 2, ".", "")); ?>" aria-valuemin="0" aria-valuemax="100" id="progress-bar<?php echo ($count); ?>"></div>
                                            <h6 class=""><?php echo (number_format($amountUsedPercentage * 1.0, 2, ".", "")); ?>%</h6>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <h6 class="spent">RM <?php echo (number_format($amountUsed, 2, ".", "")); ?></h6>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="target">RM <?php echo (number_format($amountLeft, 2, ".", "")); ?></h6>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <hr>
                            </div>
                    <?php
                            $count++;
                        }
                    } else {
                        echo ('<p class="text-center" style="color: grey;">No data shown.</p>');
                    }
                    ?>
                    <input type="hidden" name="numOfBudget" id="numOfBudget" value="<?php echo (sizeof($data)); ?>">
                </div>
            </div>

            <!-- <div class="container-fluid body">
                <nav class="navbar navbar-expand-lg">
                    <a href="#" class="navbar-brand">FINANCIAL GOALS</a>
                </nav>

            </div>

            <div class="container-fluid body">
                <nav class="navbar navbar-expand-lg">
                    <a href="#" class="navbar-brand">BALANCE SHEET</a>
                </nav>

            </div> -->
        </div>

        <div class="col-6 right-body">
            <div class="container-fluid body snapshot">
                <nav class="navbar navbar-expand-lg">
                    <a href="#" class="navbar-brand">SNAPSHOT</a>
                </nav>
                <?php
                $curMonth = $customer->getCurrentMonthValue();
                $curYear = $customer->getCurrentYearValue();

                $totalIncome = $customer->getTotalIncome();
                $totalExpenses = $customer->getTotalExpenses();
                $totalDebtPaid = $customer->getTotalDebtPaid();
                $totalExpensesAndDebtPaid = $totalExpenses + $totalDebtPaid;
                $totalBalance = $totalIncome - $totalExpensesAndDebtPaid;
                $totalInvestment = $customer->getTotalInvestmentAmount();
                $totalAsset = $totalInvestment + $totalBalance;
                $totalDebtToPay = $customer->getTotalDebtToPay();
                $totalNetWorth = $totalAsset - $totalDebtToPay;
                ?>
                <div class="container-fluid row">
                    <div>
                        <h5>Total Income</h5>
                        <!-- <p>RM<?php //echo ($customer->getTotalValueInMonth($curMonth, $curYear, 0)); 
                                    ?></p> -->
                        <p>RM<?php echo ($totalIncome); ?></p>
                    </div>
                    <h3>-</h3>
                    <div>
                        <h5>Total Expenses</h5>
                        <!-- <p>RM<?php //echo ($customer->getTotalValueInMonth($curMonth, $curYear, 1)); 
                                    ?></p> -->
                        <p>RM<?php echo ($totalExpensesAndDebtPaid); ?></p>
                    </div>
                    <h3>=</h3>
                    <div>
                        <h5>Total Balance</h5>
                        <!-- <p><?php //echo ($customer->getNetIncomeInMonth($curMonth, $curYear)); 
                                ?></p> -->
                        <p>RM<?php echo ($totalBalance); ?></p>
                    </div>
                </div>
                <div class="container-fluid row">
                    <div>
                        <h5>Asset</h5>
                        <!-- <p>RM<?php //echo ($customer->getTotalInvestmentAmount()); 
                                    ?></p> -->
                        <p>RM<?php echo ($totalAsset); ?></p>
                    </div>
                    <h3>-</h3>
                    <div>
                        <h5>Debt To Pay</h5>
                        <!-- <p>RM<?php // echo ($customer->getTotalDebtAmount()); 
                                    ?></p> -->
                        <p>RM<?php echo ($totalDebtToPay); ?></p>
                    </div>
                    <h3>=</h3>
                    <div>
                        <h5>Net Worth</h5>
                        <!-- <p><?php //echo ($customer->getNetWorth()); 
                                ?></p> -->
                        <p>RM<?php echo ($totalNetWorth); ?></p>
                    </div>
                </div>
            </div>

            <div class="container-fluid body investment">
                <nav class="navbar navbar-expand-lg">
                    <a href="#" class="navbar-brand">INVESTMENTS</a>
                </nav>
                <div class="container-fluid row chart">
                    <!-- pie chart -->
                    <input type="hidden" id="amountsOfInvestments" name="amountsOfInvestments" value='<?php echo ($customer->getTypeAmountsJSON()); ?>'></input>
                    <input type="hidden" id="typesOfInvestments" name="typesOfInvestments" value='<?php echo ($customer->getInvestTypesJSON()); ?>'></input>
                    <div class="col-6 horizontal-chart" id="investmentTypes-donut-chart"></div>
                    <!-- pie chart -->
                    <input type="hidden" id="amountsOfInvestmentByName" name="amountsOfInvestmentByName" value='<?php echo ($customer->getNameAmountsJSON()); ?>'>
                    <input type="hidden" id="nameOfInvestment" name="nameOfInvestment" value='<?php echo ($customer->getInvestNameJSON()); ?>'>
                    <div class="col-6 donut-chart" id="investmentNames-donut-chart"></div>
                </div>
                <!-- table -->
                <table class="table table-bordered table-hover institution-table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NAME</th>
                            <th scope="col">CATEGORY</th>
                            <th scope="col">TOTAL AMOUNT</th>
                            <th scope="col">AVG ANNUAL RATE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $datarow = $customer->getDataByQuery("SELECT investmentID, investmentName, investmentType, SUM(amountInvested) AS sumAmount, CAST(AVG(ratePerAnnum) AS DECIMAL(10,2)) AS avgRate 
                                                                FROM Investment 
                                                                WHERE cusID = '" . $customer->getId() . "'
                                                                GROUP BY investmentName
                                                                ORDER BY sumAmount DESC;
                                                                ");
                        if (!empty($datarow)) {
                            for ($i = 0; $i < sizeof($datarow); $i++) {
                        ?>
                                <tr>
                                    <input type="hidden" class="investmentID" value='<?php echo ($datarow[$i]['investmentID']); ?>'></input>
                                    <th scope="row"><?php echo (($i + 1)); ?></th>
                                    <td class="investName"><?php echo ($datarow[$i]['investmentName']); ?></td>
                                    <td class="investType"><?php echo ($datarow[$i]['investmentType']); ?></td>
                                    <td class="investAmount"><?php echo ($datarow[$i]['sumAmount']); ?></td>
                                    <td class="investRate"><?php echo ($datarow[$i]['avgRate']); ?></td>
                                </tr>
                        <?php
                            }
                        } ?>

                    </tbody>
                </table>
                <br>
            </div>

            <div class="container-fluid body liability">
                <nav class="navbar navbar-expand-lg">
                    <a href="#" class="navbar-brand">DEBTS</a>
                </nav>
                <!-- the pecentage bar -->
                <div class="container-fluid liability-overview">
                    <div class="container-fluid">
                        <?php $query = "SELECT (l.totalAmountToPay - (l.initialPaidAmount + IFNULL((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID AND (ct.preDefine = 1 OR (ct.preDefine = 0 AND ct.cusID =" . $customer->getID() . ")))), 0)))
                                        as remainder,
                                        l.liabilityName, 
                                        l.totalAmountToPay as total,
                                        l.initialPaidAmount + IFNULL((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID AND (ct.preDefine = 1 OR (ct.preDefine = 0 AND ct.cusID =" . $customer->getID() . ")))), 0) paidAmount, l.liabilityType 
                                        FROM liability l
                                        LEFT JOIN transaction tr
                                        ON l.liabilityName = tr.description
                                        AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = tr.categoryID AND (ct.preDefine = 1 OR (ct.preDefine = 0 AND ct.cusID =" . $customer->getID() . ")) )
                                        WHERE 
                                        l.initialPaidAmount + IFNULL((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID AND (ct.preDefine = 1 OR (ct.preDefine = 0 AND ct.cusID =" . $customer->getID() . ")))), 0) < l.totalAmountToPay
                                        AND l.cusID = " . $customer->getId() . "
                                        GROUP BY l.liabilityName";
                        $result = $customer->getDataByQuery($query);
                        if (!empty($result)) {
                            foreach ($result as $data) {
                                # code...

                        ?>
                                <div class="liability-row">
                                    <div class="row">
                                        <div class="col-3">
                                            <div>
                                                <sub>
                                                    <?php echo ($data['liabilityName']); ?> | <?php echo ($data['liabilityType']); ?>
                                                </sub>
                                            </div>
                                            <p>RM <?php echo ($data['total']); ?></p>
                                        </div>
                                        <div class="col-9">
                                            <!-- bar -->
                                            <div class="progress">
                                                <?php $percent = round(($data['paidAmount'] / $data['total']) * 100.0, 1);
                                                ?>

                                                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo ($percent); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                <h6><?php echo ($percent); ?>%</h6>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h6 class="paid">RM <?php echo (number_format($data['paidAmount'] * 1.0, 2)); ?></h6>
                                                </div>
                                                <div class="col-6">
                                                    <h6 class="target">RM <?php echo (number_format($data['remainder'], 2)); ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                        <?php
                            }
                        } else {
                            echo ('<p class="text-center" style="color: grey;">No data shown.</p>');
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="./script/dashboard.js"></script>

</html>