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
                    <div class="budget-row">
                        <div class="row">
                            <div class="col-3">
                                <div>
                                    <sub>Total Budget</sub>
                                </div>
                                <p>RM 1000.00</p>
                            </div>
                            <div class="col-9">
                                <!-- bar -->
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" id="progress-bar"></div>
                                    <h6>50%</h6>
                                    <div class="vl" data-toggle="vl-hover" data-text="Today"></div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="spent">RM 350.00</h6>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="target">RM 650.00</h6>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>
                    </div>
                    <!-- When a row is being clicked, it will direct to expense transaction page, with a bookmark category there  -->
                    <div class="budget-row">
                        <div class="row">
                            <div class="col-3">
                                <div>
                                    <sub>Food</sub>
                                </div>
                                <p>RM 400.00</p>
                            </div>
                            <div class="col-9">
                                <!-- bar -->
                                <div class="progress">
                                    <div class="progress-bar excess-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" id="progress-bar"></div>
                                    <h6 class="excess-value">110%</h6>
                                    <div class="vl" data-toggle="vl-hover" data-text="Today"></div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="spent excess">RM 550.00</h6>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="target">Excess RM -110.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="budget-row">
                        <div class="row">
                            <div class="col-3">
                                <div>
                                    <sub>Transportation</sub>
                                </div>
                                <p>RM 350.00</p>
                            </div>
                            <div class="col-9">
                                <!-- bar -->
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" id="progress-bar"></div>
                                    <h6>30%</h6>
                                    <div class="vl" data-toggle="vl-hover" data-text="Today"></div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="spent">RM 100.00</h6>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="target">RM 250.00</h6>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="budget-row">
                        <div class="row">
                            <div class="col-3">
                                <div>
                                    <sub>Fashion</sub>
                                </div>
                                <p>RM 150.00</p>
                            </div>
                            <div class="col-9">
                                <!-- bar -->
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" id="progress-bar"></div>
                                    <h6>50%</h6>
                                    <div class="vl" data-toggle="vl-hover" data-text="Today"></div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="spent">RM 75.00</h6>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="target">RM 75.00</h6>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>
                    </div>
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
                        <!-- <p>RM<?php // echo ($customer->getTotalDebtAmount()); ?></p> -->
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
                                        GROUP BY l.liabilityName";
                        $result = $customer->getDataByQuery($query);
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
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="./script/dashboard.js"></script>

</html>