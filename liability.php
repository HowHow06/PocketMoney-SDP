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
                <a class="btn" href="#mark-scheduled-payment" role="button"><i>Scheduled Payment</i></a>
                <a class="btn" href="#mark-payment-history" role="button"><i>Payment History</i></a>
                <a class="btn" href="#mark-all-liabilities" role="button"><i>All Debts</i></a>
            </div>
            <div class="row chart">
                <!-- pie chart -->
                <?php $query = "SELECT
                                (l.totalAmountToPay - (l.initialPaidAmount + IFNULL((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID)), 0)))
                                as remainder, l.liabilityName,l.initialPaidAmount,
                                 l.initialPaidAmount + IFNULL((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID)), 0) as paid
                                FROM liability l
                                LEFT JOIN transaction tr
                                ON l.liabilityName = tr.description
                                AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = tr.categoryID)
                                WHERE
                                l.initialPaidAmount + IFNULL((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID)), 0) < l.totalAmountToPay
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
                    <?php $query = "SELECT (l.totalAmountToPay - (l.initialPaidAmount + IFNULL((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID)), 0)))
                                    as remainder,
                                    l.liabilityName, 
                                    l.totalAmountToPay as total,
                                    l.initialPaidAmount + IFNULL((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID)), 0) paidAmount, l.liabilityType 
                                    FROM liability l
                                    LEFT JOIN transaction tr
                                    ON l.liabilityName = tr.description
                                    AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = tr.categoryID)
                                    WHERE 
                                    l.initialPaidAmount + IFNULL((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID)), 0) < l.totalAmountToPay
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

            <!--completed debts-->
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
                                (l.totalAmountToPay - (l.initialPaidAmount + IFNULL((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID)), 0)))
                                as remainder, 
                                l.liabilityName, l.liabilityType, l.totalAmountToPay, 
                                DATE((SELECT MAX(tran.date) FROM transaction tran WHERE tran.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = tran.categoryID))) as endDate
                                FROM liability l, transaction tr
                                WHERE l.liabilityName = tr.description
                                AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = tr.categoryID)
                                AND l.initialPaidAmount + IFNULL((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID)), 0) >= l.totalAmountToPay 
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
                <!--coming payment-->
                <div class="col-7 chart-explain right-div">
                    <div class="border rounded" id="mark-scheduled-payment">
                        <!-- table -->
                        <table class="table table-bordered table-hover transaction-table table-sm" id="investmentTransactionTable">
                            <thead>
                                <tr>
                                    <th colspan="5" class="title">SCHEDULED PAYMENT</th>
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
                                $query = "SELECT l.liabilityName, l.liabilityType, l.amountEachPayment, l.paymentDate, l.paymentFrequency
                                FROM liability l 
                                LEFT JOIN transaction tr
                                ON l.liabilityName = tr.description
                                AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = tr.categoryID)
                                WHERE 
                                l.initialPaidAmount + IFNULL((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID)), 0) < l.totalAmountToPay
                                AND l.paymentDate IS NOT NULL
                                ";
                                $datarow = $customer->getDataByQuery($query);
                                if (!empty($datarow)) {
                                    for ($i = 0; $i < sizeof($datarow); $i++) {
                                        $frequency = $datarow[$i]['paymentFrequency'];
                                        $paymentDate = $datarow[$i]['paymentDate'];
                                        $newdate = $customer->getDateByFrequency($frequency, $paymentDate);
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
                                            $query = "SELECT * FROM liability l LEFT JOIN transaction tr
                                            ON l.liabilityName = tr.description
                                            AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = tr.categoryID)
                                            WHERE (l.initialPaidAmount + IFNULL((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID)), 0)) < l.totalAmountToPay 
                                            ORDER BY tr.date DESC";
                                            $data = $customer->getDataByQuery($query);
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
                                    <input type="hidden" id="edit-payment-transactionID" name="edit-payment-transactionID"></input>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Payable Amount:</label>
                                        <input type="text" class="col-6" id="edit-payment-remainder" disabled></input>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Name:</label>
                                        <select class="col-6" name="edit-payment-name" id="edit-payment-name" onchange="//showsearch('')" required disabled>
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
                                        <select class="col-6" name="edit-payment-category" id="edit-payment-category" onchange="//showsearch('')" disabled required>
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
                    $query = "SELECT *, DATE(date) as paymentdate, (l.totalAmountToPay - (l.initialPaidAmount + IFNULL((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID)), 0))) + tr.amount
                    as remainder FROM transaction tr, liability l
                    WHERE l.liabilityName = tr.description
                    AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = tr.categoryID)
                    ORDER BY tr.date DESC";
                    $datarow = $customer->getDataByQuery($query);

                    if (!empty($datarow)) {
                        for ($i = 0; $i < sizeof($datarow); $i++) {
                    ?>
                            <tr>
                                <input type="hidden" class="paymentID" value='<?php echo ($datarow[$i]['transactionID']); ?>'></input>
                                <input type="hidden" class="paymentRemainder" value='<?php echo ($datarow[$i]['remainder']); ?>'></input>
                                <th scope="row"><?php echo (($i + 1)); ?></th>
                                <td class="paymentDate"><?php echo ($datarow[$i]['paymentdate']); ?></td>
                                <td class="paymentName"><?php echo ($datarow[$i]['liabilityName']); ?></td>
                                <td class="paymentType"><?php echo ($datarow[$i]['liabilityType']); ?></td>
                                <td class="paymentAmount"><?php echo ($datarow[$i]['amount']); ?></td>
                                <td class="action">
                                    <a href="#" class="edit-payment-anchor" data-toggle="modal" data-target="#edit-payment">Edit</a>
                                    <span> | </span>
                                    <a href="#" class="delete-payment-anchor" data-toggle="modal" data-target="#delete-payment">Delete</a>
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
                    <button class="btn" data-toggle="modal" data-target="#new-liability">New</button>
                </div>

                <div class="col-6 search">
                    <input type="text" name="" id="search-transaction" placeholder="  Apple eg.">
                    <h6>Search:</h6>
                </div>
            </div>

            <!-- new-liability modal -->
            <div class="modal fade new-modal" id="new-liability" tabindex="-1" role="dialog" aria-labelledby="new-liability" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="new-liability">New Debt</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="POST" id="new-liability-form" onsubmit="//return validateform(this);">
                            <div class="modal-body">
                                <div class="container">
                                    <input type="hidden" id="new-liability" name="new-liability"></input>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Name:</label>
                                        <input id="new-liability-name" class="col-6 form-investmentName" list="new-liability-nameList" name="new-liability-name" required />
                                        <datalist id="new-liability-nameList">
                                            <?php
                                            $data = $customer->getData('liability', "DISTINCT liabilityName");
                                            foreach ($data as $row => $value) {
                                            ?>
                                                <option value="<?php echo ($value['liabilityName']); ?>"><?php echo ($value['liabilityName']); ?></option>
                                            <?php
                                            }
                                            ?>
                                        </datalist>
                                        <label class="error" for="new-liability-name">Please enter a valid name</label>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-5" for="">Category:</label>
                                        <input id="new-liability-category" class="col-6 form-investmentType" list="new-liability-categoryList" name="new-liability-category" required />
                                        <datalist id="new-liability-categoryList">
                                            <?php
                                            $data = $customer->getData('liability', "DISTINCT liabilityType");
                                            foreach ($data as $row => $value) {
                                            ?>
                                                <option id="type<?php echo ($value['liabilityType']); ?>" value="<?php echo ($value['liabilityType']); ?>"><?php echo ($value['liabilityType']); ?></option>
                                            <?php
                                            }
                                            ?>
                                        </datalist>
                                        <label class="error" for="new-liability-category">Please enter a valid category</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="new-liability-startDate">Start Date:</label>
                                        <input class="col-6 form-startDate" type="date" id="new-liability-startDate" name="new-liability-startDate" required />
                                        <label class="error" for="new-liability-startDate">Please enter a valid date</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Total Amount To Pay:</label>
                                        <input class="col-6 form-amountInvested" type="number" step='0.01' id="new-liability-totalAmount" name="new-liability-totalAmount" required />
                                        <label class="error" for="new-liability-totalAmount">Please enter a valid amount</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Amount Paid:</label>
                                        <input class="col-6 form-amountInvested" type="number" step='0.01' id="new-liability-amountPaid" name="new-liability-amountPaid" required />
                                        <label class="error" for="new-liability-amountPaid">Please enter a valid amount</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Scheduled Payment:</label>
                                        <select class="col-6" name="new-liability-scheduled" id="new-liability-scheduled" required>
                                            <option value="yes" selected>yes</option>
                                            <option value="no">no</option>
                                        </select>
                                        <label class="error" for="new-liability-scheduled">Please select one</label>
                                    </div>
                                    <div class="form-group row scheduled-div">
                                        <label class="col-5" for="new-liability-paymentDate">Payment Date:</label>
                                        <input class="col-6 form-paymentDate" type="date" id="new-liability-paymentDate" name="new-liability-paymentDate" required />
                                        <label class="error" for="new-liability-paymentDate">Please enter a valid date</label>
                                    </div>
                                    <div class="form-group row scheduled-div">
                                        <label class="col-5" for="">Payment Amount:</label>
                                        <input class="col-6 form-amountInvested" type="number" step='0.01' id="new-liability-paymentAmount" name="new-liability-paymentAmount" required />
                                        <label class="error" for="new-liability-paymentAmount">Please enter a valid amount</label>
                                    </div>
                                    <div class="form-group row scheduled-div">
                                        <label class="col-5" for="">Repeat:</label>
                                        <select class="col-6" name="new-liability-paymentFrequency" id="new-liability-paymentFrequency" required>
                                            <option value="" selected>no</option>
                                            <option value="monthly">monthly</option>
                                            <option value="yearly">yearly</option>
                                        </select>
                                        <label class="error" for="new-liability-paymentFrequency">Please select one</label>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="new-liability-submit" class="btn btn-primary">Add new</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- edit-liability modal -->
            <div class="modal fade edit-modal" id="edit-liability" tabindex="-1" role="dialog" aria-labelledby="edit-liability" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit-liability">Edit Debt</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="POST" id="edit-liability-form" onsubmit="return validateform(this);">
                            <div class="modal-body">
                                <div class="container">
                                    <input type="hidden" id="edit-liabilityID" name="edit-liability"></input>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Name:</label>
                                        <input id="edit-liability-name" class="col-6 form-investmentName" list="edit-liability-nameList" name="edit-liability-name" required />
                                        <datalist id="edit-liability-nameList">
                                            <?php
                                            $data = $customer->getData('liability', "DISTINCT liabilityName");
                                            foreach ($data as $row => $value) {
                                            ?>
                                                <option value="<?php echo ($value['liabilityName']); ?>"><?php echo ($value['liabilityName']); ?></option>
                                            <?php
                                            }
                                            ?>
                                        </datalist>
                                        <label class="error" for="edit-liability-name">Please enter a valid name</label>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-5" for="">Category:</label>
                                        <input id="edit-liability-category" class="col-6 form-investmentType" list="edit-liability-categoryList" name="edit-liability-category" required />
                                        <datalist id="edit-liability-categoryList">
                                            <?php
                                            $data = $customer->getData('liability', "DISTINCT liabilityType");
                                            foreach ($data as $row => $value) {
                                            ?>
                                                <option id="type<?php echo ($value['liabilityType']); ?>" value="<?php echo ($value['liabilityType']); ?>"><?php echo ($value['liabilityType']); ?></option>
                                            <?php
                                            }
                                            ?>
                                        </datalist>
                                        <label class="error" for="edit-liability-category">Please enter a valid category</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="edit-liability-startDate">Start Date:</label>
                                        <input class="col-6 form-startDate" type="date" id="edit-liability-startDate" name="edit-liability-startDate" required />
                                        <label class="error" for="edit-liability-startDate">Please enter a valid date</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Total Amount To Pay:</label>
                                        <input class="col-6 form-amountInvested" type="number" step='0.01' id="edit-liability-totalAmount" name="edit-liability-totalAmount" required />
                                        <label class="error" for="edit-liability-totalAmount">Please enter a valid amount</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Amount Paid:</label>
                                        <input class="col-6 form-amountInvested" type="number" step='0.01' id="edit-liability-amountPaid" name="edit-liability-amountPaid" required />
                                        <label class="error" for="edit-liability-amountPaid">Please enter a valid amount</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Scheduled Payment:</label>
                                        <select class="col-6" name="edit-liability-scheduled" id="edit-liability-scheduled" required>
                                            <option value="yes" selected>yes</option>
                                            <option value="no">no</option>
                                        </select>
                                        <label class="error" for="edit-liability-scheduled">Please select one</label>
                                    </div>
                                    <div class="form-group row scheduled-div">
                                        <label class="col-5" for="edit-liability-paymentDate">Payment Date:</label>
                                        <input class="col-6 form-paymentDate" type="date" id="edit-liability-paymentDate" name="edit-liability-paymentDate" required />
                                        <label class="error" for="edit-liability-paymentDate">Please enter a valid date</label>
                                    </div>
                                    <div class="form-group row scheduled-div">
                                        <label class="col-5" for="">Payment Amount:</label>
                                        <input class="col-6 form-amountInvested" type="number" step='0.01' id="edit-liability-paymentAmount" name="edit-liability-paymentAmount" required />
                                        <label class="error" for="edit-liability-paymentAmount">Please enter a valid amount</label>
                                    </div>
                                    <div class="form-group row scheduled-div">
                                        <label class="col-5" for="">Repeat:</label>
                                        <select class="col-6" name="edit-liability-paymentFrequency" id="edit-liability-paymentFrequency" required>
                                            <option value="" selected>no</option>
                                            <option value="monthly">monthly</option>
                                            <option value="yearly">yearly</option>
                                        </select>
                                        <label class="error" for="edit-liability-paymentFrequency">Please select one</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="reset" class="btn btn-success" onclick="resetEdit()">Reset</button>
                                <button type="submit" name="edit-liability-submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- delete-liability modal -->
            <div class="modal fade edit-modal" id="delete-liability" tabindex="-1" role="dialog" aria-labelledby="edit-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <p>Are you sure want to Delete this Debt?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="" method="POST">
                                <input type="hidden" id="delete_investmentID" name="delete_investmentID"></input>
                                <button type="submit" class="btn btn-primary" name="delete-liability-submit">Delete</button>
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
                        <th scope="col">TOTAL PAID</th>
                        <th scope="col">AMOUNT LEFT</th>
                        <th scope="col">INITIAL AMOUNT</th>
                        <th scope="col">ACTION</th>

                    </tr>
                </thead>
                <tbody id="investmentTransactionTableBody">

                    <?php
                    $query = "SELECT *, (l.totalAmountToPay - (l.initialPaidAmount + IFNULL((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID)), 0)))
                    as remainder,
                    l.liabilityName, 
                    l.totalAmountToPay as total,
                    l.initialPaidAmount + IFNULL((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID)), 0) as paidAmount, l.liabilityType 
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
                                <input type="hidden" class="liabilityID" value='<?php echo ($datarow[$i]['liabilityID']); ?>'></input>
                                <th scope="row"><?php echo (($i + 1)); ?></th>
                                <td class="liabilityDate"><?php echo ($datarow[$i]['startDate']); ?></td>
                                <td class="liabilityName"><?php echo ($datarow[$i]['liabilityName']); ?></td>
                                <td class="liabilityType"><?php echo ($datarow[$i]['liabilityType']); ?></td>
                                <td class="liabilityTotalAmount"><?php echo ($datarow[$i]['totalAmountToPay']); ?></td>
                                <td class="liabilityPaidAmount"><?php echo (number_format($datarow[$i]['paidAmount'] * 1.0, 2, ".", "")); ?></td>
                                <td class="liabilityRemainder"><?php echo ($datarow[$i]['remainder']); ?></td>
                                <td class="liabilityInitialAmount"><?php echo ($datarow[$i]['initialPaidAmount']); ?></td>
                                <td class="action">
                                    <a href="#" class="edit-liability-anchor" data-toggle="modal" data-target="#edit-liability">Edit</a>
                                    <span> | </span>
                                    <a href="#" class="delete-liability-anchor" data-toggle="modal" data-target="#delete-liability">Delete</a>
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