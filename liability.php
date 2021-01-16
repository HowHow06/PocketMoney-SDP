<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(".head.php"); ?>
    <link rel="stylesheet" href="./style/liability.css">

    <title>PocketMoney | Debts</title>
</head>

<body>
    <?php
    $activePage = "liabilities";
    include(".navbar.php");
    ?>

    <div class="container-fluid background">
        <div class="container-fluid body">
            <nav class="navbar navbar-expand-lg">
                <a href="#" class="navbar-brand">DEBTS</a>
            </nav>
            <h6 class="go-to">GO TO:</h6>
            <hr>
            <div class="row overall align">
                <a class="btn" href="#mark-upcoming-payment" role="button"><i>Upcoming Payment</i></a>
                <a class="btn" href="#mark-payment-history" role="button"><i>Payment History</i></a>
                <a class="btn" href="#mark-all-liabilities" role="button"><i>All Debts</i></a>
            </div>
            <div class="row chart">
                <!-- pie chart -->
                <?php $query = "SELECT
                                CASE
                                    WHEN (l.totalAmountToPay - (SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID))) IS NOT NULL THEN  (l.totalAmountToPay - (SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID)))
                                    ELSE l.totalAmountToPay
                                END as remainder, l.liabilityName
                                FROM liability l
                                LEFT JOIN transaction tr
                                ON l.liabilityName = tr.description
                                AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = tr.categoryID)
                                WHERE
                                ((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID)) IS NULL 
                                OR (SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID)) < l.totalAmountToPay)
                                GROUP BY l.liabilityName"; ?>
                <!-- pie chart -->
                <input type="hidden" id="amountsOfInvestmentByName" name="amountsOfInvestmentByName" value='<?php echo ($customer->getJSONbyRawQuery($query, 'remainder', true)); ?>'>
                <input type="hidden" id="nameOfInvestment" name="nameOfInvestment" value='<?php echo ($customer->getJSONbyRawQuery($query, 'liabilityName')); ?>'>
                <div class="col-12 donut-chart d-flex justify-content-center" id="liabilityNames-donut-chart"></div>
            </div>

            <!-- the pecentage bar -->
            <div class="container-fluid liability-overview">
                <div class="container-fluid rounded border">
                    <div class="col-12">
                        <h4>DEBTS OVERVIEW</h4>
                    </div>
                    <?php $query = "SELECT CASE
                                            WHEN (l.totalAmountToPay - (SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID))) IS NOT NULL THEN  (l.totalAmountToPay - (SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID)))
                                            ELSE l.totalAmountToPay
                                        END as remainder,
                                        l.liabilityName, 
                                        l.totalAmountToPay as total,
                                        (SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID)) as paidAmount, l.liabilityType 
                                        FROM liability l
                                        LEFT JOIN transaction tr
                                        ON l.liabilityName = tr.description
                                        AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = tr.categoryID)
                                        WHERE 
                                        ((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID)) IS NULL 
                                        OR (SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID)) < l.totalAmountToPay)
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
            <br>
            <div class="row upcoming-payment  justify-content-center">
                <div class="col-5 pie-chart left-div">
                    <div class="border rounded ">
                        <table class="table table-bordered table-hover transaction-table table-sm" id="investmentTransactionTable">
                            <thead>
                                <tr>
                                    <th colspan="5" class="title">COMPLETED DEBTS</th>
                                </tr>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">NAME</th>
                                    <th scope="col">CATEGORY</th>
                                    <th scope="col">AMOUNT PAID</th>
                                    <th scope="col">END DATE</th>
                                </tr>
                            </thead>
                            <tbody id="investmentTransactionTableBody">

                                <?php
                                $query = "SELECT 
                                (l.totalAmountToPay - (SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID))  ) as remainder, 
                                l.liabilityName, l.liabilityType, l.totalAmountToPay, 
                                DATE((SELECT MAX(tran.date) FROM transaction tran WHERE tran.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = tran.categoryID))) as endDate
                                FROM liability l, transaction tr
                                WHERE l.liabilityName = tr.description
                                AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = tr.categoryID)
                                AND (SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID)) >= l.totalAmountToPay 
                                GROUP BY l.liabilityName
                                ";
                                $datarow = $customer->getDataByQuery($query);
                                if (!empty($datarow)) {
                                    for ($i = 0; $i < sizeof($datarow); $i++) {
                                ?>
                                        <tr>

                                            <th scope="row"><?php echo (($i + 1)); ?></th>
                                            <td class="investName"><?php echo ($datarow[$i]['liabilityName']); ?></td>
                                            <td class="investType"><?php echo ($datarow[$i]['liabilityType']); ?></td>
                                            <td class="investAmount"><?php echo ($datarow[$i]['totalAmountToPay']); ?></td>
                                            <td class="investRate"><?php echo ($datarow[$i]['endDate']); ?></td>
                                        </tr>
                                <?php
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-7 chart-explain right-div">
                    <div class="border rounded" id="mark-upcoming-payment">
                        <!-- table -->
                        <table class="table table-bordered table-hover transaction-table table-sm" id="investmentTransactionTable">
                            <thead>
                                <tr>
                                    <th colspan="5" class="title">UPCOMING PAYMENT</th>
                                </tr>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">NAME</th>
                                    <th scope="col">CATEGORY</th>
                                    <th scope="col">COMING PAYMENT AMOUNT</th>
                                    <th scope="col">DUE ON</th>
                                </tr>
                            </thead>
                            <tbody id="investmentTransactionTableBody">

                                <?php
                                $query = "SELECT l.liabilityName, l.liabilityType, l.amountEachPayment, l.paymentTime
                                FROM liability l 
                                LEFT JOIN transaction tr
                                ON l.liabilityName = tr.description
                                AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = tr.categoryID)
                                WHERE 
                                ((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID)) IS NULL 
                                OR (SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID)) < l.totalAmountToPay)
                                AND l.paymentTime IS NOT NULL
                                ";
                                $datarow = $customer->getDataByQuery($query);
                                if (!empty($datarow)) {
                                    for ($i = 0; $i < sizeof($datarow); $i++) {
                                        $paymentTime = json_decode($datarow[$i]['paymentTime']);
                                        $frequency = $paymentTime->frequency;
                                        $period = $paymentTime->period;
                                        $newdate = $customer->getDateByFrequency($frequency, $period);
                                ?>
                                        <tr>
                                            <th scope="row"><?php echo (($i + 1)); ?></th>
                                            <td class="investName"><?php echo ($datarow[$i]['liabilityName']); ?></td>
                                            <td class="investType"><?php echo ($datarow[$i]['liabilityType']); ?></td>
                                            <td class="investAmount"><?php echo ($datarow[$i]['amountEachPayment']); ?></td>
                                            <td class="investRate"><?php echo ($newdate); ?></td>
                                        </tr>
                                <?php
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>


            <!-- new-payment modal -->
            <div class="modal fade new-modal" id="new-payment" tabindex="-1" role="dialog" aria-labelledby="new-payment-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="new-payment-title">New Payment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="POST" id="new-payment-form" onsubmit="return validateform(this);">
                            <div class="modal-body">
                                <div class="container">
                                    <input type="hidden" id="new-payment-liabilityID" name="new-payment-liabilityID"></input>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Name:</label>
                                        <select class="col-6" name="new-payment-name" id="new-payment-name" onchange="//showsearch('')" required>
                                            <?php
                                            $data = $customer->getData('Liability', "DISTINCT liabilityName");
                                            foreach ($data as $row => $value) {
                                            ?>
                                                <option value="<?php echo ($value['liabilityName']); ?>"><?php echo ($value['liabilityName']); ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <label class="error" for="new-payment-name">Please enter a valid name</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Category:</label>
                                        <select class="col-6" name="new-payment-category" id="new-payment-category" onchange="//showsearch('')" disabled>
                                            <?php
                                            $data = $customer->getData('Liability', "DISTINCT liabilityType");
                                            foreach ($data as $row => $value) {
                                            ?>
                                                <option value="<?php echo ($value['liabilityType']); ?>"><?php echo ($value['liabilityType']); ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <label class="error" for="new-payment-category">Please enter a valid category</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="new-payment-date">Date:</label>
                                        <input class="col-6 form-startDate" type="date" id="new-payment-date" name="new-payment-date" required />
                                        <label class="error" for="new-payment-date">Please enter a valid date</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Amount Paid:</label>
                                        <input class="col-6 form-amountInvested" type="number" step='0.01' id="new-payment-amount" name="new-payment-amount" required />
                                        <label class="error" for="new-payment-amount">Please enter a valid amount</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="new-payment-submit" class="btn btn-primary">Add new</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- edit-payment modal -->
            <div class="modal fade edit-modal" id="edit-payment" tabindex="-1" role="dialog" aria-labelledby="edit-payment-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit-payment-title">Edit Payment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="POST" id="edit-payment-form" onsubmit="//return validateform(this);">
                            <div class="modal-body">
                                <div class="container">
                                    <input type="hidden" id="edit-payment-liabilityID" name="edit-payment-liabilityID"></input>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Name:</label>
                                        <select class="col-6" name="edit-payment-name" id="edit-payment-name" onchange="//showsearch('')" required>
                                            <?php
                                            $data = $customer->getData('Liability', "DISTINCT liabilityName");
                                            foreach ($data as $row => $value) {
                                            ?>
                                                <option value="<?php echo ($value['liabilityName']); ?>"><?php echo ($value['liabilityName']); ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <label class="error" for="edit-payment-name">Please enter a valid name</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Category:</label>
                                        <select class="col-6" name="edit-payment-category" id="edit-payment-category" onchange="//showsearch('')" disabled>
                                            <?php
                                            $data = $customer->getData('Liability', "DISTINCT liabilityType");
                                            foreach ($data as $row => $value) {
                                            ?>
                                                <option value="<?php echo ($value['liabilityType']); ?>"><?php echo ($value['liabilityType']); ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <label class="error" for="edit-payment-category">Please enter a valid category</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="edit-payment-date">Date:</label>
                                        <input class="col-6 form-startDate" type="date" id="edit-payment-date" name="edit-payment-date" required />
                                        <label class="error" for="edit-payment-date">Please enter a valid date</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Amount Paid:</label>
                                        <input class="col-6 form-amountInvested" type="number" step='0.01' id="edit-payment-amount" name="edit-payment-amount" required />
                                        <label class="error" for="edit-payment-amount">Please enter a valid amount</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="reset" class="btn btn-success" onclick="resetEdit()">Reset</button>
                                <button type="submit" name="edit-payment-submit" class="btn btn-primary">Save changes</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- delete-payment modal -->
            <div class="modal fade edit-modal" id="delete-payment" tabindex="-1" role="dialog" aria-labelledby="edit-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <p>Are you sure want to Delete this payment?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="" method="POST">
                                <input type="hidden" id="delete-payment-liabilityID" name="delete-payment-liabilityID"></input>
                                <button type="submit" class="btn btn-primary" name="delete-payment-submit">Delete</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <h4 id="mark-payment-history">PAYMENT HISTORY</h4>
            <hr>
            <div class="container-fluid row filter">
                <div>
                    <h5>CATEGORY:</h5>
                    <select name="filter-transaction-category" id="filter-transaction-category" class="custom-select" onchange="showsearch('')">
                        <option value="ALL" selected>ALL</option>
                        <?php
                        $data = $customer->getData('Liability', "DISTINCT liabilityType");
                        foreach ($data as $row => $value) {
                        ?>
                            <option value="<?php echo ($value['liabilityType']); ?>"><?php echo ($value['liabilityType']); ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div>
                    <h5>SORY BY:</h5>
                    <select name="filter-transaction-time" id="filter-transaction-time" class="custom-select" onchange="showsearch('')">
                        <option value="payment-sort-date">DATE</option>
                        <option value="payment-sort-name">NAME</option>
                    </select>
                </div>
            </div>

            <div class="container-fluid row filter2">
                <div class="col-6 row show">
                    <a class="btn" href="#" role="button">View All</a>
                    <button class="btn" data-toggle="modal" data-target="#new-payment">New</button>
                </div>
                <div class="col-6 search">
                    <input type="text" name="" id="search-transaction" placeholder="  Apple eg.">
                    <h6>Search:</h6>
                </div>
            </div>

            <!-- payment table -->
            <table class="table table-bordered table-hover transaction-table" id="investmentTransactionTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">DATE</th>
                        <th scope="col">NAME</th>
                        <th scope="col">CATEGORY</th>
                        <th scope="col">AMOUNT PAID</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody id="payment-table-body">

                    <?php
                    $query = "SELECT *, DATE(date) as paymentdate FROM transaction tr, liability l
                    WHERE l.liabilityName = tr.description
                    AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = tr.categoryID)
                    ORDER BY tr.date DESC";
                    $datarow = $customer->getDataByQuery($query);

                    if (!empty($datarow)) {
                        for ($i = 0; $i < sizeof($datarow); $i++) {
                    ?>
                            <tr>
                                <input type="hidden" class="paymentID" value='<?php echo ($datarow[$i]['transactionID']); ?>'></input>
                                <th scope="row"><?php echo (($i + 1)); ?></th>
                                <td class="paymentDate"><?php echo ($datarow[$i]['paymentdate']); ?></td>
                                <td class="paymentName"><?php echo ($datarow[$i]['liabilityName']); ?></td>
                                <td class="paymentType"><?php echo ($datarow[$i]['liabilityType']); ?></td>
                                <td class="paymentAmount"><?php echo ($datarow[$i]['amount']); ?></td>
                                <td class="action">
                                    <a href="#" class="edit-investment-anchor" data-toggle="modal" data-target="#edit-payment">Edit</a>
                                    <span> | </span>
                                    <a href="#" class="delete-investment-anchor" data-toggle="modal" data-target="#delete-payment">Delete</a>
                                </td>
                            </tr>
                    <?php
                        }
                    } ?>
                </tbody>
            </table>




            <h4 id="mark-all-liabilities">ALL DEBTS</h4>
            <hr>

            <div class="container-fluid row filter">
                <div>
                    <h5>CATEGORY:</h5>
                    <select name="filter-transaction-category" id="filter-transaction-category" class="custom-select" onchange="showsearch('')">
                        <option value="ALL" selected>ALL</option>
                        <?php
                        $data = $customer->getData('Liability', "DISTINCT liabilityType");
                        foreach ($data as $row => $value) {
                        ?>
                            <option value="<?php echo ($value['liabilityType']); ?>"><?php echo ($value['liabilityType']); ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div>
                    <h5>SORY BY:</h5>
                    <select name="filter-transaction-time" id="filter-transaction-time" class="custom-select" onchange="showsearch('')">
                        <option value="payment-sort-date">DATE</option>
                        <option value="payment-sort-name">NAME</option>
                    </select>
                </div>
            </div>

            <div class="container-fluid row filter2">
                <div class="col-6 row show">
                    <a class="btn" href="#" role="button">View All</a>
                </div>

                <div class="col-6 search">
                    <input type="text" name="" id="search-transaction" placeholder="  Apple eg.">
                    <h6>Search:</h6>
                </div>
            </div>

            <!-- new-row modal -->
            <div class="modal fade new-modal" id="new-row" tabindex="-1" role="dialog" aria-labelledby="new-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="new-title">New Debt</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="POST" id="testing" onsubmit="return validateform(this);">
                            <div class="modal-body">
                                <div class="container">
                                    <div class="form-group row">
                                        <label class="col-5" for="">Date:</label>
                                        <input class="col-6 form-startDate" type="date" id="new_startDate" name="new_startDate" required />
                                        <label class="error" for="new_startDate">Please enter a valid date</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Name:</label>
                                        <input id="new_investmentName" class="col-6 form-investmentName" list="new_investmentNameList" name="new_investmentName" required />
                                        <datalist id="new_investmentNameList">
                                            <?php
                                            $data = $customer->getData('Investment', "DISTINCT investmentName");
                                            foreach ($data as $row => $value) {
                                            ?>
                                                <option value="<?php echo ($value['investmentName']); ?>"><?php echo ($value['investmentName']); ?></option>
                                            <?php
                                            }
                                            ?>
                                        </datalist>
                                        <label class="error" for="new_investmentName">Please enter a valid name</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Category:</label>
                                        <input id="new_investmentType" class="col-6 form-investmentType" list="new_investmentTypeList" name="new_investmentType" required />
                                        <datalist id="new_investmentTypeList">
                                            <?php
                                            $data = $customer->getData('Investment', "DISTINCT investmentType");
                                            foreach ($data as $row => $value) {
                                            ?>
                                                <option id="type<?php echo ($value['investmentType']); ?>" value="<?php echo ($value['investmentType']); ?>"><?php echo ($value['investmentType']); ?></option>
                                            <?php
                                            }
                                            ?>
                                        </datalist>
                                        <label class="error" for="new_investmentType">Please enter a valid category</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Total Amount To Pay:</label>
                                        <input class="col-6 form-amountInvested" type="number" step='0.01' id="new_amountInvested" name="new_amountInvested" required />
                                        <label class="error" for="new_amountInvested">Please enter a valid amount</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Amount Paid:</label>
                                        <input class="col-6 form-amountInvested" type="number" step='0.01' id="new_amountInvested" name="new_amountInvested" required />
                                        <label class="error" for="new_amountInvested">Please enter a valid amount</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Amount Left:</label>
                                        <input class="col-6 form-amountInvested" type="number" step='0.01' id="new_amountInvested" name="new_amountInvested" required disabled />
                                        <label class="error" for="new_amountInvested">Please enter a valid amount</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Each Payment:</label>
                                        <input class="col-6 form-amountInvested" type="number" step='0.01' id="new_amountInvested" name="new_amountInvested" required disabled />
                                        <label class="error" for="new_amountInvested">Please enter a valid amount</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Time Needed:</label>
                                        <input class="col-6 form-ratePerAnnum" type="number" step='0.01' id="new_ratePerAnnum" name="new_ratePerAnnum" required />
                                        <label class="error" for="new_ratePerAnnum">Please enter a valid rate</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Reminder:</label>
                                        <input id="new_investmentType" class="col-6 form-investmentType" list="new_investmentTypeList" name="new_investmentType" disabled />
                                        <datalist id="new_investmentTypeList">
                                            <?php
                                            $data = $customer->getData('Investment', "DISTINCT investmentType");
                                            foreach ($data as $row => $value) {
                                            ?>
                                                <option id="type<?php echo ($value['investmentType']); ?>" value="<?php echo ($value['investmentType']); ?>"><?php echo ($value['investmentType']); ?></option>
                                            <?php
                                            }
                                            ?>
                                        </datalist>
                                        <input class="reminder" type="checkbox" name="new_automate" id="new_automate">
                                        <label class="error" for="new_investmentType">Please enter a valid category</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Repeat for:</label>
                                        <input id="new_investmentType" class="col-6 form-investmentType" list="new_investmentTypeList" name="new_investmentType" disabled />
                                        <datalist id="new_investmentTypeList">
                                            <?php
                                            $data = $customer->getData('Investment', "DISTINCT investmentType");
                                            foreach ($data as $row => $value) {
                                            ?>
                                                <option id="type<?php echo ($value['investmentType']); ?>" value="<?php echo ($value['investmentType']); ?>"><?php echo ($value['investmentType']); ?></option>
                                            <?php
                                            }
                                            ?>
                                        </datalist>
                                        <input type="checkbox" name="new_automate" id="new_automate">
                                        <label class="error" for="new_investmentType">Please enter a valid category</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="new_submit" class="btn btn-primary">Add new</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- edit-row modal -->
            <div class="modal fade edit-modal" id="edit-row" tabindex="-1" role="dialog" aria-labelledby="edit-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit-title">Edit Debt</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="POST" id="edit-form" onsubmit="return validateform(this);">
                            <div class="modal-body">
                                <div class="container">
                                    <input type="hidden" id="edit_investmentID" name="edit_investmentID"></input>
                                    <div class="form-group row">
                                        <label class="col-5" for="edit_startDate">Date:</label>
                                        <input class="col-6 form-startDate" type="date" id="edit_startDate" name="edit_startDate" required />
                                        <label class="error" for="edit_startDate">Please enter a valid date</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Name:</label>
                                        <input id="edit_investmentName" class="col-6 form-investmentName" list="edit_investmentNameList" name="edit_investmentName" required />
                                        <datalist id="edit_investmentNameList">
                                            <?php
                                            $data = $customer->getData('Investment', "DISTINCT investmentName");
                                            foreach ($data as $row => $value) {
                                            ?>
                                                <option value="<?php echo ($value['investmentName']); ?>"><?php echo ($value['investmentName']); ?></option>
                                            <?php
                                            }
                                            ?>
                                        </datalist>
                                        <label class="error" for="edit_investmentName">Please enter a valid name</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Category:</label>
                                        <input id="edit_investmentType" class="col-6 form-investmentType" list="edit_investmentTypeList" name="edit_investmentType" required />
                                        <datalist id="edit_investmentTypeList">
                                            <?php
                                            $data = $customer->getData('Investment', "DISTINCT investmentType");
                                            foreach ($data as $row => $value) {
                                            ?>
                                                <option id="type<?php echo ($value['investmentType']); ?>" value="<?php echo ($value['investmentType']); ?>"><?php echo ($value['investmentType']); ?></option>
                                            <?php
                                            }
                                            ?>
                                        </datalist>
                                        <label class="error" for="edit_investmentType">Please enter a valid category</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Total Amount To Pay:</label>
                                        <input class="col-6 form-amountInvested" type="number" step='0.01' id="edit_amountInvested" name="edit_amountInvested" required />
                                        <label class="error" for="edit_amountInvested">Please enter a valid amount</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Amount Paid:</label>
                                        <input class="col-6 form-amountInvested" type="number" step='0.01' id="edit_amountInvested" name="edit_amountInvested" required />
                                        <label class="error" for="edit_amountInvested">Please enter a valid amount</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Amount Left:</label>
                                        <input class="col-6 form-amountInvested" type="number" step='0.01' id="edit_amountInvested" name="edit_amountInvested" required disabled />
                                        <label class="error" for="edit_amountInvested">Please enter a valid amount</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Each Payment:</label>
                                        <input class="col-6 form-amountInvested" type="number" step='0.01' id="edit_amountInvested" name="edit_amountInvested" required disabled />
                                        <label class="error" for="edit_amountInvested">Please enter a valid amount</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Time Needed:</label>
                                        <input class="col-6 form-ratePerAnnum" type="number" step='0.01' id="edit_ratePerAnnum" name="edit_ratePerAnnum" required />
                                        <label class="error" for="edit_ratePerAnnum">Please enter a valid rate</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Reminder:</label>
                                        <input id="new_investmentType" class="col-6 form-investmentType" list="new_investmentTypeList" name="new_investmentType" disabled />
                                        <datalist id="new_investmentTypeList">
                                            <?php
                                            $data = $customer->getData('Investment', "DISTINCT investmentType");
                                            foreach ($data as $row => $value) {
                                            ?>
                                                <option id="type<?php echo ($value['investmentType']); ?>" value="<?php echo ($value['investmentType']); ?>"><?php echo ($value['investmentType']); ?></option>
                                            <?php
                                            }
                                            ?>
                                        </datalist>
                                        <input class="reminder" type="checkbox" name="new_automate" id="new_automate">
                                        <label class="error" for="new_investmentType">Please enter a valid category</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Repeat for:</label>
                                        <input id="new_investmentType" class="col-6 form-investmentType" list="new_investmentTypeList" name="new_investmentType" disabled />
                                        <datalist id="new_investmentTypeList">
                                            <?php
                                            $data = $customer->getData('Investment', "DISTINCT investmentType");
                                            foreach ($data as $row => $value) {
                                            ?>
                                                <option id="type<?php echo ($value['investmentType']); ?>" value="<?php echo ($value['investmentType']); ?>"><?php echo ($value['investmentType']); ?></option>
                                            <?php
                                            }
                                            ?>
                                        </datalist>
                                        <input type="checkbox" name="new_automate" id="new_automate">
                                        <label class="error" for="new_investmentType">Please enter a valid category</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="reset" class="btn btn-success" onclick="resetEdit()">Reset</button>
                                <button type="submit" name="edit_submit" class="btn btn-primary">Save changes</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- delete-row modal -->
            <div class="modal fade edit-modal" id="delete-row" tabindex="-1" role="dialog" aria-labelledby="edit-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <p>Are you sure want to Delete this Debt?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="" method="POST">
                                <input type="hidden" id="delete_investmentID" name="delete_investmentID"></input>
                                <button type="submit" class="btn btn-primary" name="delete_submit">Delete</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- table -->
            <table class="table table-bordered table-hover transaction-table" id="investmentTransactionTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">START DATE</th>
                        <th scope="col">NAME</th>
                        <th scope="col">CATEGORY</th>
                        <th scope="col">TOTAL AMOUNT TO PAY</th>
                        <th scope="col">AMOUNT PAID</th>
                        <th scope="col">AMOUNT LEFT</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody id="investmentTransactionTableBody">

                    <?php
                    $query = "SELECT *, CASE
                    WHEN (l.totalAmountToPay - (SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID))) IS NOT NULL THEN  (l.totalAmountToPay - (SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID)))
                    ELSE l.totalAmountToPay
                    END as remainder,
                    l.liabilityName, 
                    l.totalAmountToPay as total,
                    (SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID)) as paidAmount, l.liabilityType 
                    FROM liability l
                    LEFT JOIN transaction tr
                    ON l.liabilityName = tr.description
                    AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = tr.categoryID)
                    GROUP BY l.liabilityName";
                    $datarow = $customer->getDataByQuery($query);
                    if (!empty($datarow)) {
                        for ($i = 0; $i < sizeof($datarow); $i++) {
                    ?>
                            <tr>
                                <input type="hidden" class="investmentID" value='<?php echo ($datarow[$i]['liabilityID']); ?>'></input>
                                <th scope="row"><?php echo (($i + 1)); ?></th>
                                <td class="investDate"><?php echo ($datarow[$i]['startDate']); ?></td>
                                <td class="investName"><?php echo ($datarow[$i]['liabilityName']); ?></td>
                                <td class="investType"><?php echo ($datarow[$i]['liabilityType']); ?></td>
                                <td class="investAmount"><?php echo ($datarow[$i]['totalAmountToPay']); ?></td>
                                <td class="investAmount"><?php echo (number_format($datarow[$i]['paidAmount'] * 1.0, 2, ".", "")); ?></td>
                                <td class="investAmount"><?php echo ($datarow[$i]['remainder']); ?></td>
                                <td class="action">
                                    <a href="#" class="edit-investment-anchor" data-toggle="modal" data-target="#edit-row">Edit</a>
                                    <span> | </span>
                                    <a href="#" class="delete-investment-anchor" data-toggle="modal" data-target="#delete-row">Delete</a>
                                </td>
                            </tr>
                    <?php
                        }
                    } ?>
                </tbody>
            </table>


        </div>
    </div>

    <button type="button" class="btn btn-circle btn-xl" data-toggle="modal" data-target="#new-row">
        <i class="fas fa-plus"></i>
    </button>
</body>
<script src="./script/liability.js"></script>

</html>