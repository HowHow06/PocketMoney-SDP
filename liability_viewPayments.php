<!DOCTYPE html>
<html lang="en">

<head>
    <?php

    use function PHPUnit\Framework\isEmpty;

    include(".head.php"); ?>
    <link rel="stylesheet" href="./style/liability.css">

    <title>PocketMoney | Debts</title>
</head>

<body>
    <?php
    $activePage = "liabilities";
    include(".navbar.php");

    //update the debt payment transaction
    if (isset($_POST['edit-payment-submit'])) {
        $params['tableName'] = 'Transaction';
        $params['idName'] = 'transactionID';
        $params['id'] = $_POST['edit-payment-transactionID'];
        $params['data'] = array(
            'date' => $_POST['edit-payment-date'],
            'amount' => $_POST['edit-payment-amount']
        );
        $result = $customer->customerUpdate($params);
        if ($result['status'] == 'ok') {
            $customer->showAlert($result['statusMsg']);
        } else {
            $customer->showAlert($result['statusMsg']);
        }
        $customer->goTo('liability_viewPayments.php?role=customer');
    }

    //new debt payment
    if (isset($_POST['new-payment-submit'])) {
        $params['tableName'] = 'Transaction';
        $categoryName = $_POST['new-payment-categoryHidden'];
        $categoryType = 'liability';

        $params['data'] = array(
            'cusID' => $customer->getId(),
            'categoryID' => $customer->getCategoryIDByNameType($categoryName, $categoryType),
            'date' => $_POST['new-payment-date'],
            'amount' => $_POST['new-payment-amount'],
            'description' => $_POST['new-payment-name']
        );
        $result = $customer->customerInsert($params);
        if ($result['status'] == 'ok') {
            $customer->showAlert($result['statusMsg']);
        } else {
            $customer->showAlert($result['statusMsg']);
        }
        $customer->goTo('liability_viewPayments.php?role=customer');
    }

    //delete payment
    if (isset($_POST['delete-payment-submit'])) {
        $params['tableName'] = 'Transaction';
        $params['idName'] = 'transactionID';
        $params['id'] = $_POST['delete-payment-transactionID'];
        $result = $customer->customerDelete($params);
        if ($result['status'] == 'ok') {
            $customer->showAlert($result['statusMsg']);
        } else {
            $customer->showAlert($result['statusMsg']);
        }
        $customer->goTo('liability_viewPayments.php?role=customer');
    }


    ?>

    <div class="container-fluid background">
        <div class="container-fluid body">
            <nav class="navbar navbar-expand-lg">
                <a href="#" class="navbar-brand">DEBTS</a>
                <input type="hidden" id="cusID" value="<?php $customer->getID(); ?>">
            </nav>



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
                        <form action="" method="POST" id="new-payment-form" onsubmit="return validatePaymentform(this);">
                            <div class="modal-body">
                                <div class="container">
                                    <input type="hidden" id="new-payment-liabilityID" name="new-payment-liabilityID"></input>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Name:</label>
                                        <select class="col-6" name="new-payment-name" id="new-payment-name" onchange="//showsearch('')" required>
                                            <option value="" selected>Please select a debt</option>
                                            <?php
                                            $query = "SELECT * FROM liability l LEFT JOIN transaction tr
                                            ON l.liabilityName = tr.description
                                            AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = tr.categoryID AND (ct.preDefine = 1 OR (ct.preDefine = 0 AND ct.cusID =" . $customer->getID() . ")) )
                                            WHERE (l.initialPaidAmount + IFNULL((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID AND (ct.preDefine = 1 OR (ct.preDefine = 0 AND ct.cusID =" . $customer->getID() . ")))), 0)) < l.totalAmountToPay 
                                            GROUP BY l.liabilityName
                                            ORDER BY tr.date DESC ";
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
                                        <input type="hidden" name="new-payment-categoryHidden" id="new-payment-categoryHidden" value='' />
                                        <select class="col-6" name="new-payment-category" id="new-payment-category" onchange="//showsearch('')" disabled>
                                            <option value="" selected>Please select a debt</option>
                                            <?php
                                            $query = "SELECT * FROM category ct WHERE ct.categoryType = 'liability' AND (ct.preDefine = 1 OR (ct.preDefine = 0 AND ct.cusID =" . $customer->getID() . "))";
                                            $data = $customer->getDataByQuery($query);
                                            foreach ($data as $row => $value) {
                                            ?>
                                                <option value="<?php echo ($value['categoryName']); ?>"><?php echo ($value['categoryName']); ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <label class="error" for="new-payment-category">Please enter a valid category</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Payable Amount:</label>
                                        <input type="text" class="col-6 form-payableAmount" id="new-payment-remainder" disabled></input>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="new-payment-date">Date:</label>
                                        <input class="col-6 form-startDate" type="date" id="new-payment-date" name="new-payment-date" required />
                                        <label class="error" for="new-payment-date">Please enter a valid date</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Amount Paid:</label>
                                        <input class="col-6 form-amount" type="number" step='0.01' id="new-payment-amount" name="new-payment-amount" required />
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
                        <form action="" method="POST" id="edit-payment-form" onsubmit="return validatePaymentform(this);">
                            <div class="modal-body">
                                <div class="container">
                                    <input type="hidden" id="edit-payment-transactionID" name="edit-payment-transactionID"></input>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Payable Amount:</label>
                                        <input type="text" class="col-6 form-payableAmount" id="edit-payment-remainder" disabled></input>
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
                                            $query = "SELECT * FROM category ct WHERE ct.categoryType = 'liability' AND (ct.preDefine = 1 OR (ct.preDefine = 0 AND ct.cusID =" . $customer->getID() . "))";
                                            $data = $customer->getDataByQuery($query);
                                            foreach ($data as $row => $value) {
                                            ?>
                                                <option value="<?php echo ($value['categoryName']); ?>"><?php echo ($value['categoryName']); ?></option>
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
                                        <input class="col-6 form-amount" type="number" step='0.01' id="edit-payment-amount" name="edit-payment-amount" required />
                                        <label class="error" for="edit-payment-amount">Please enter a valid amount</label>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success" onclick="resetEditPayment()">Reset</button>
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
                                <input type="hidden" id="delete-payment-transactionID" name="delete-payment-transactionID"></input>
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
                    <select class="filter-payment custom-select" name="filter-transaction-category" id="filter-transaction-category">
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
                    <select class="filter-payment custom-select" name="filter-transaction-time" id="filter-transaction-time">
                        <option value="payment-sort-date">DATE</option>
                        <option value="payment-sort-name">NAME</option>
                    </select>
                </div>
            </div>

            <div class="container-fluid row filter2">
                <div class="col-6 row show">
                    <!-- <a class="btn" href="#" role="button">View All</a> -->
                    <button class="btn" data-toggle="modal" data-target="#new-payment">New</button>
                </div>
                <div class="col-6 search">
                    <input class="filter-payment" type="text" name="" id="search-payment" placeholder="  Apple eg.">
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
                    $query = "SELECT *, DATE(date) as paymentdate, (l.totalAmountToPay - (l.initialPaidAmount + IFNULL((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID AND (ct.preDefine = 1 OR (ct.preDefine = 0 AND ct.cusID =" . $customer->getID() . ")))), 0))) + tr.amount
                    as remainder FROM transaction tr, liability l
                    WHERE l.liabilityName = tr.description
                    AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = tr.categoryID AND (ct.preDefine = 1 OR (ct.preDefine = 0 AND ct.cusID =" . $customer->getID() . ")) )
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





            <!-- table -->
            <table class="table table-bordered table-hover transaction-table" id="liabilityTransactionTable" style="display: none;">
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
                <tbody id="liability-table-body">

                    <?php
                    $query = "SELECT *, (l.totalAmountToPay - (l.initialPaidAmount + IFNULL((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID AND (ct.preDefine = 1 OR (ct.preDefine = 0 AND ct.cusID =" . $customer->getID() . ")))), 0)))
                    as remainder,
                    l.liabilityName, 
                    l.totalAmountToPay as total,
                    l.initialPaidAmount + IFNULL((SELECT SUM(amount) FROM transaction trac WHERE trac.description = l.liabilityName AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = trac.categoryID AND (ct.preDefine = 1 OR (ct.preDefine = 0 AND ct.cusID =" . $customer->getID() . ")))), 0) as paidAmount, l.liabilityType 
                    FROM liability l
                    LEFT JOIN transaction tr
                    ON l.liabilityName = tr.description
                    AND l.liabilityType = (SELECT categoryName FROM category ct WHERE ct.categoryID = tr.categoryID AND (ct.preDefine = 1 OR (ct.preDefine = 0 AND ct.cusID =" . $customer->getID() . ")) )
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



    <button type="button" class="btn btn-circle btn-xl" data-toggle="modal" data-target="#new-payment">
        <i class="fas fa-plus"></i>
    </button>
</body>
<script src="./script/liability_view.js"></script>

</html>