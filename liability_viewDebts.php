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

    //update liability
    if (isset($_POST['edit-liability-submit'])) {
        $newCate = intval($_POST['edit-liability-newCate']);
        //create new category
        if ($newCate == 1) {
            $params['tableName'] = 'category';
            $params['data'] = array(
                'categoryName' => $_POST['edit-liability-category'],
                'categoryType' => 'liability',
                'preDefine' => 0,
                'cusID' => 1
            );
            $result = $customer->customerInsert($params);
        }

        //update the transaction description
        $liabilityName = $_POST['edit-liability-name'];
        $liabilityOriName = $_POST['edit-liability-oriName'];
        $cusID = $customer->getId();
        $query = "UPDATE transaction tr
        SET tr.description= '" . $liabilityName . "'
        WHERE tr.description = '" . $liabilityOriName . "' 
        AND tr.cusID ='" . $cusID . "'
        AND (SELECT categoryType FROM category ct WHERE tr.categoryID = ct.categoryID) = 'liability'";

        $customer->getDataByQuery($query);

        $query = "UPDATE transaction tr
        SET tr.categoryID= (SELECT categoryID from category ct WHERE ct.categoryName='" . $_POST['edit-liability-category'] . "' AND ct.categoryType = 'liability')
        WHERE tr.description = '" . $liabilityName . "' 
        AND tr.cusID ='" . $cusID . "'
        AND (SELECT categoryType FROM category ct WHERE tr.categoryID = ct.categoryID) = 'liability'";

        $customer->getDataByQuery($query);

        $params['tableName'] = 'Liability';
        $params['idName'] = 'liabilityID';
        $params['id'] = $_POST['edit-liabilityID'];
        $scheduled = $_POST['edit-liability-scheduled'];
        $paymentDate = NULL;
        $paymentAmount = NULL;
        $paymentFrequency = NULL;
        $paymentReminder = 1;
        if ($scheduled == 'yes') {
            //since these controls might be disabled, so need to check before assign
            $paymentDate = $_POST['edit-liability-paymentDate'];
            $paymentAmount = $_POST['edit-liability-paymentAmount'];
            if (isset($_POST['edit-liability-paymentFrequency'])) {
                $paymentFrequency = $_POST['edit-liability-paymentFrequency'];
            }
            if (isset($_POST['edit-liability-paymentReminder'])) {
                $paymentReminder = $_POST['edit-liability-paymentReminder'];
            }
        }
        $params['data'] = array(
            'liabilityName' => $_POST['edit-liability-name'],
            'liabilityType' => $_POST['edit-liability-category'],
            'startDate' => $_POST['edit-liability-startDate'],
            'totalAmountToPay' => $_POST['edit-liability-totalAmount'],
            'initialPaidAmount' => $_POST['edit-liability-amountPaid'],
            'paymentDate' => $paymentDate,
            'paymentFrequency' => $paymentFrequency,
            'amountEachPayment' => $paymentAmount,
            'paymentReminder' => $paymentReminder
        );
        $result = $customer->customerUpdate($params);
        if ($result['status'] == 'ok') {
            $customer->showAlert($result['statusMsg']);
        } else {
            $customer->showAlert($result['statusMsg']);
        }
        $customer->goTo('liability_viewDebts.php?role=customer');
    }
    //update liability
    if (isset($_POST['edit-liability-submit'])) {
        $newCate = intval($_POST['edit-liability-newCate']);
        //create new category
        if ($newCate == 1) {
            $params['tableName'] = 'category';
            $params['data'] = array(
                'categoryName' => $_POST['edit-liability-category'],
                'categoryType' => 'liability',
                'preDefine' => 0,
                'cusID' => 1
            );
            $result = $customer->customerInsert($params);
        }

        //update the transaction description
        $liabilityName = $_POST['edit-liability-name'];
        $liabilityOriName = $_POST['edit-liability-oriName'];
        $cusID = $customer->getId();
        $query = "UPDATE transaction tr
        SET tr.description= '" . $liabilityName . "'
        WHERE tr.description = '" . $liabilityOriName . "' 
        AND tr.cusID ='" . $cusID . "'
        AND (SELECT categoryType FROM category ct WHERE tr.categoryID = ct.categoryID) = 'liability'";

        $customer->getDataByQuery($query);

        $query = "UPDATE transaction tr
        SET tr.categoryID= (SELECT categoryID from category ct WHERE ct.categoryName='" . $_POST['edit-liability-category'] . "' AND ct.categoryType = 'liability')
        WHERE tr.description = '" . $liabilityName . "' 
        AND tr.cusID ='" . $cusID . "'
        AND (SELECT categoryType FROM category ct WHERE tr.categoryID = ct.categoryID) = 'liability'";

        $customer->getDataByQuery($query);

        $params['tableName'] = 'Liability';
        $params['idName'] = 'liabilityID';
        $params['id'] = $_POST['edit-liabilityID'];
        $scheduled = $_POST['edit-liability-scheduled'];
        $paymentDate = NULL;
        $paymentAmount = NULL;
        $paymentFrequency = NULL;
        $paymentReminder = 1;
        if ($scheduled == 'yes') {
            //since these controls might be disabled, so need to check before assign
            $paymentDate = $_POST['edit-liability-paymentDate'];
            $paymentAmount = $_POST['edit-liability-paymentAmount'];
            if (!empty($_POST['edit-liability-paymentFrequency'])) {
                $paymentFrequency = $_POST['edit-liability-paymentFrequency'];
            }
            if (!empty($_POST['edit-liability-paymentReminder'])) {
                $paymentReminder = $_POST['edit-liability-paymentReminder'];
            }
        }
        $params['data'] = array(
            'liabilityName' => $_POST['edit-liability-name'],
            'liabilityType' => $_POST['edit-liability-category'],
            'startDate' => $_POST['edit-liability-startDate'],
            'totalAmountToPay' => $_POST['edit-liability-totalAmount'],
            'initialPaidAmount' => $_POST['edit-liability-amountPaid'],
            'paymentDate' => $paymentDate,
            'paymentFrequency' => $paymentFrequency,
            'amountEachPayment' => $paymentAmount,
            'paymentReminder' => $paymentReminder
        );
        $result = $customer->customerUpdate($params);
        if ($result['status'] == 'ok') {
            $customer->showAlert($result['statusMsg']);
        } else {
            $customer->showAlert($result['statusMsg']);
        }
        $customer->goTo('liability.php?role=customer');
    }

    //delete liability
    if (isset($_POST['delete-liability-submit'])) {
        $query = "DELETE FROM transaction tr 
        WHERE tr.description = (SELECT l.liabilityName FROM liability l WHERE l.liabilityID = '" . $_POST['delete-liability-liabilityID'] . "') 
        AND tr.cusID = '" . $customer->getId() . "' 
        AND (SELECT categoryType FROM category ct WHERE tr.categoryID = ct.categoryID) = 'liability';";
        $customer->getDataByQuery($query);

        $params['tableName'] = 'Liability';
        $params['idName'] = 'liabilityID';
        $params['id'] = $_POST['delete-liability-liabilityID'];
        $result = $customer->customerDelete($params);
        if ($result['status'] == 'ok') {
            $customer->showAlert($result['statusMsg']);
        } else {
            $customer->showAlert($result['statusMsg']);
        }
        $customer->goTo('liability_viewDebts.php?role=customer');
    }
    ?>

    <div class="container-fluid background">
        <div class="container-fluid body">
            <nav class="navbar navbar-expand-lg">
                <a href="#" class="navbar-brand">DEBTS</a>
                <input type="hidden" id="cusID" value="<?php echo $customer->getId(); ?>">
            </nav>

            <!-- payment table -->
            <table class="table table-bordered table-hover transaction-table" id="investmentTransactionTable" style="display: none;">
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
                    AND l.cusID = " . $customer->getId() . "
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
                    <select class="filter-liability custom-select" name="filter-liability-category" id="filter-liability-category" class="custom-select">
                        <option value="ALL" selected>ALL</option>
                        <?php
                        $data = $customer->getData('Liability', "DISTINCT liabilityType", array("cusID" => $customer->getId()));
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
                    <select class="filter-liability custom-select" name="filter-liability-time" id="filter-liability-time">
                        <option value="liability-sort-date">DATE</option>
                        <option value="liability-sort-name">NAME</option>
                    </select>
                </div>
            </div>

            <div class="container-fluid row filter2">
                <div class="col-6 row show">
                    <!-- <a class="btn" href="#" role="button">View All</a> -->
                    <button class="btn" data-toggle="modal" data-target="#new-liability">New</button>
                </div>

                <div class="col-6 search">
                    <input class="filter-liability" type="text" name="" id="search-liability" placeholder="  Apple eg.">
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
                        <form action="" method="POST" id="new-liability-form" onsubmit="return validateLiabilityform(this);">
                            <div class="modal-body">
                                <div class="container">
                                    <input type="hidden" id="new-liability" name="new-liability"></input>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Name:</label>
                                        <input type="text" id="new-liability-name" class="col-6 form-liabilityName" name="new-liability-name" required />
                                        <label class="error" for="new-liability-name">Please enter a valid name</label>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-5" for="">Category:</label>
                                        <input type="hidden" id="new-liability-newCate" class="form-liability-newCate" name="new-liability-newCate" value="0" />
                                        <input id="new-liability-category" class="col-6 form-liabilityType" list="new-liability-categoryList" name="new-liability-category" autocomplete="off" required />
                                        <datalist id="new-liability-categoryList">
                                            <?php
                                            $query = "SELECT * FROM category ct WHERE ct.categoryType = 'liability' AND (ct.preDefine = 1 OR (ct.preDefine = 0 AND ct.cusID =" . $customer->getID() . "))";
                                            $data = $customer->getDataByQuery($query);
                                            foreach ($data as $row => $value) {
                                            ?>
                                                <option id="type<?php echo ($value['categoryName']); ?>" value="<?php echo ($value['categoryName']); ?>"><?php echo ($value['categoryName']); ?></option>
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
                                        <input class="col-6 form-amountTotal" type="number" step='0.01' id="new-liability-totalAmount" name="new-liability-totalAmount" required />
                                        <label class="error" for="new-liability-totalAmount">Please enter a valid amount</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Amount Paid:</label>
                                        <input class="col-6 form-amountPaid" type="number" step='0.01' id="new-liability-amountPaid" name="new-liability-amountPaid" required />
                                        <label class="error" for="new-liability-amountPaid">Please enter a valid amount</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Scheduled Payment:</label>
                                        <select class="col-6 liability-scheduled-select" name="new-liability-scheduled" id="new-liability-scheduled" required>
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
                                        <input class="col-6 form-amountPayment" type="number" step='0.01' id="new-liability-paymentAmount" name="new-liability-paymentAmount" required />
                                        <label class="error" for="new-liability-paymentAmount">Please enter a valid amount</label>
                                    </div>
                                    <div class="form-group row scheduled-div">
                                        <label class="col-5" for="">Repeat:</label>
                                        <select class="col-6" name="new-liability-paymentFrequency" id="new-liability-paymentFrequency">
                                            <option value="" selected>no</option>
                                            <option value="M">monthly</option>
                                            <option value="Y">yearly</option>
                                        </select>
                                        <label class="error" for="new-liability-paymentFrequency">Please select one</label>
                                    </div>
                                    <div class="form-group row scheduled-div">
                                        <label class="col-5" for="">Reminder:</label>
                                        <select class="col-6" name="new-liability-paymentReminder" id="new-liability-paymentReminder" required>
                                            <option value="1" selected>yes</option>
                                            <option value="0">no</option>
                                        </select>
                                        <label class="error" for="new-liability-paymentReminder">Please select one</label>
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
                        <form action="" method="POST" id="edit-liability-form" onsubmit="return validateLiabilityform(this);">
                            <div class="modal-body">
                                <div class="container">
                                    <input type="hidden" id="edit-liabilityID" name="edit-liabilityID"></input>
                                    <input class="form-liability-totalPaid" type="hidden" id="edit-liability-totalPaid" name="edit-liability-totalPaid"></input>

                                    <div class="form-group row">
                                        <label class="col-5" for="">Payment Done:</label>
                                        <input class="col-6 form-liability-paymentDone" type="number" step='0.01' id="edit-liability-paymentDone" name="edit-liability-paymentDone" disabled />
                                        <label class="error" for="edit-liability-paymentDone">Please enter a valid amount</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Name:</label>
                                        <input type="hidden" id="edit-liability-oriName" name="edit-liability-oriName" required />
                                        <input type="text" id="edit-liability-name" class="col-6 form-liabilityName" name="edit-liability-name" required />
                                        <label class="error" for="edit-liability-name">Please enter a valid name</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Category:</label>
                                        <input id="edit-liability-category" class="col-6 form-liabilityType" list="edit-liability-categoryList" name="edit-liability-category" autocomplete="off" required />
                                        <input type="hidden" id="edit-liability-newCate" class="form-liability-newCate" name="edit-liability-newCate" value="0" />
                                        <datalist id="edit-liability-categoryList">
                                            <?php
                                            $query = "SELECT * FROM category ct WHERE ct.categoryType = 'liability' AND (ct.preDefine = 1 OR (ct.preDefine = 0 AND ct.cusID =" . $customer->getID() . "))";
                                            $data = $customer->getDataByQuery($query);
                                            foreach ($data as $row => $value) {
                                            ?>
                                                <option value="<?php echo ($value['categoryName']); ?>"><?php echo ($value['categoryName']); ?></option>
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
                                        <input class="col-6 form-amountTotal" type="number" step='0.01' id="edit-liability-totalAmount" name="edit-liability-totalAmount" required />
                                        <label class="error" for="edit-liability-totalAmount">Please enter a valid amount</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Initial Amount Paid:</label>
                                        <input class="col-6 form-amountPaid" type="number" step='0.01' id="edit-liability-amountPaid" name="edit-liability-amountPaid" required />
                                        <label class="error" for="edit-liability-amountPaid">Please enter a valid amount</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Scheduled Payment:</label>
                                        <select class="col-6 liability-scheduled-select" name="edit-liability-scheduled" id="edit-liability-scheduled" required>
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
                                        <input class="col-6 form-amountPayment" type="number" step='0.01' id="edit-liability-paymentAmount" name="edit-liability-paymentAmount" required />
                                        <label class="error" for="edit-liability-paymentAmount">Please enter a valid amount</label>
                                    </div>
                                    <div class="form-group row scheduled-div">
                                        <label class="col-5" for="">Repeat:</label>
                                        <select class="col-6" name="edit-liability-paymentFrequency" id="edit-liability-paymentFrequency">
                                            <option value="" selected>no</option>
                                            <option value="M">monthly</option>
                                            <option value="Y">yearly</option>
                                        </select>
                                        <label class="error" for="edit-liability-paymentFrequency">Please select one</label>
                                    </div>
                                    <div class="form-group row scheduled-div">
                                        <label class="col-5" for="">Reminder:</label>
                                        <select class="col-6" name="edit-liability-paymentReminder" id="edit-liability-paymentReminder" required>
                                            <option value="1" selected>yes</option>
                                            <option value="0">no</option>
                                        </select>
                                        <label class="error" for="edit-liability-paymentReminder">Please select one</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success" onclick="resetEditLiability()">Reset</button>
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
                            <p>Proceed to Delete this Debt? </p>
                            <p>(Will delete all related payment)</p>
                        </div>
                        <div class="modal-footer">
                            <form action="" method="POST">
                                <input type="hidden" id="delete-liability-liabilityID" name="delete-liability-liabilityID"></input>
                                <button type="submit" class="btn btn-primary" name="delete-liability-submit">Delete</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- table -->
            <table class="table table-bordered table-hover transaction-table" id="liabilityTransactionTable">
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
                    WHERE l.cusID = " . $customer->getId() . "
                    GROUP BY l.liabilityName
                    ORDER BY l.startDate DESC";
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


    <button type="button" class="btn btn-circle btn-xl" data-toggle="modal" data-target="#new-liability">
        <i class="fas fa-plus"></i>
    </button>
</body>
<script src="./script/liability_view.js"></script>

</html>