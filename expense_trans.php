<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(".head.php"); ?>
    <link rel="stylesheet" href="./style/transaction.css">

    <title>PocketMoney | Transactions</title>
</head>
<body>
    <?php 
    $activePage = "transactions"; 
    include(".navbar.php"); 

    $customer->setCurDate();
    $customer->setFlag(0);

    if (isset($_GET['filter-month-year'])) {
        $filter = $_GET['filter-month-year'];
        if ($filter == 'Monthly') {
            $customer->setFlag(0);
        } elseif ($filter == 'Yearly') {
            $customer->setFlag(1);
        }
    }

    //update the transaction
    if (isset($_POST['edit_submit'])) {
        $params['tableName'] = 'Transaction';
        $params['idName'] = 'transactionID';
        $params['id'] = $_POST['edit_transactionID'];

        // Get categoryID based on categoryName
        $datarow = $customer->getDataByQuery('SELECT categoryID FROM category
                                                WHERE categoryName=\'' . $_POST['edit_transactionCategory'] . '\';
                                                ');
        
        // The categoryName is new, create a new categoryID for it 
        if (empty($datarow)) {
            // set new param
            $paramsNew['tableName'] = 'Category';
            $paramsNew['data'] = array(
                'categoryName' => $_POST['edit_transactionCategory'],
                'categoryType' => $_POST['edit_transactionType'],
                'preDefine' => 0, // usermade
                'cusID' => $customer->getId(),
            );
            $result = $customer->customerInsert($paramsNew);
            if ($result['status'] == 'ok') {
                // Get categoryID based on categoryName
                $datarow = $customer->getDataByQuery('SELECT categoryID FROM category
                WHERE categoryName=\'' . $_POST['edit_transactionCategory'] . '\';
                ');
            } else {
                $customer->showAlert($result['statusMsg']);
            }
        }

        $params['data'] = array(
            'date' => $_POST['edit_transactionDateTime'],
            'amount' => $_POST['edit_transactionAmount'],
            'categoryID' => $datarow[0]['categoryID'],
            'description' => $_POST['edit_transactionName']
        );
        $result = $customer->customerUpdate($params);
        if ($result['status'] == 'ok') {
            $customer->showAlert($result['statusMsg']);
        } else {
            $customer->showAlert($result['statusMsg']);
        }
        $customer->goTo('expense_trans.php?role=customer');
    }

    //delete transaction
    if (isset($_POST['delete_submit'])) {
        $params['tableName'] = 'Transaction';
        $params['idName'] = 'transactionID';
        $params['id'] = $_POST['delete_transactionID'];
        $result = $customer->customerDelete($params);
        if ($result['status'] == 'ok') {
            $customer->showAlert($result['statusMsg']);
        } else {
            $customer->showAlert($result['statusMsg']);
        }
        $customer->goTo('expense_trans.php?role=customer');
    }

    //new transaction
    if (isset($_POST['new_submit'])) {
        $params['tableName'] = 'Transaction';

        // Get categoryID based on categoryName
        $datarow = $customer->getDataByQuery('SELECT categoryID FROM category
        WHERE categoryName=\'' . $_POST['new_transactionCategory'] . '\';
        ');

        // The categoryName is new, create a new categoryID for it 
        if (empty($datarow)) {
            // set new param
            $paramsNew['tableName'] = 'Category';
            $paramsNew['data'] = array(
                'categoryName' => $_POST['new_transactionCategory'],
                'categoryType' => $_POST['new_transactionType'],
                'preDefine' => 0, // usermade
                'cusID' => $customer->getId(),
            );
            $result = $customer->customerInsert($paramsNew);
            if ($result['status'] == 'ok') {
                // Get categoryID based on categoryName
                $datarow = $customer->getDataByQuery('SELECT categoryID FROM category
                WHERE categoryName=\'' . $_POST['new_transactionCategory'] . '\';
                ');
            } else {
                $customer->showAlert($result['statusMsg']);
            }
        }

        $params['data'] = array(
            'cusID' => $customer->getId(),
            'description' => $_POST['new_transactionName'],
            'categoryID' => $datarow[0]['categoryID'],
            'date' => $_POST['new_transactionDateTime'],
            'amount' => $_POST['new_transactionAmount'],
        );
        $result = $customer->customerInsert($params);

        if ($result['status'] == 'ok') {
            $customer->showAlert($result['statusMsg']);
        } else {
            $customer->showAlert($result['statusMsg']);
        }
        $customer->goTo('expense_trans.php?role=customer');
    }

    if (isset($_POST['filter-previous'])) {
        $date = strtotime($_POST['current-previous-date']);
        if (!preg_match("/^[0-9-]+$/", $_POST['current-previous-date'])) {
            $d = date("Y-m-d",$date);
            $customer->setCurDate(-1,$d);
        } else {
            $d = date("Y-m-d",$date);
            $customer->setCurDate(-2,$d);
        }
        
    }

    if (isset($_POST['filter-next'])) {
        $date = strtotime($_POST['current-next-date']);
        if (!preg_match("/^[0-9-]+$/", $_POST['current-next-date'])) {
            $d = date("Y-m-d",$date);
            $customer->setCurDate(1,$d);
        } else {
            $d = date("Y-m-d",$date);
            $customer->setCurDate(2,$d);
        }
    }
    ?>

    <div class="container-fluid background">
        <div class="container-fluid body">
            <nav class="navbar navbar-expand-lg">
                <a href="#" class="navbar-brand">EXPENSES TRANSACTIONS</a>
            </nav>
            <div class="container-fluid row">
                <div class="col-6 left">
                    <div class="row">
                        <form action="" method="post">
                            <button class="btn" type="submit" id="filter-previous" name="filter-previous">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <input type="hidden" id="current-previous-date" name="current-previous-date" value="<?php echo ($customer->getCurrentFilterTime(0,1,$customer->getFlag())); ?>"></input>
                        </form>
                        <label id="filter-current-date" name="filter-current-date"><?php echo ($customer->getCurrentFilterTime(0,0,$customer->getFlag())); ?></label>
                        <form action="" method="post">
                            <input type="hidden" id="current-next-date" name="current-next-date" value="<?php echo ($customer->getCurrentFilterTime(0,1,$customer->getFlag())); ?>"></input>
                            <button class="btn" type="submit" id="filter-next" name="filter-next">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-6 right">
                    <form action="expense_trans.php" method="get">
                        <div class="row">
                            <h6>Show:</h6>
                            <input type="hidden" name="role" value="customer">
                            <select name="filter-month-year" id="filter-month-year" class="custom-select" onchange="this.form.submit()">
                                <option value="Monthly">Monthly</option>
                                <option value="Yearly">Yearly</option>
                            </select>
                        </div>
                    </form>

                </div>
            </div>

            <div class="container-fluid row overview">
                <div class="pie-chart col-5">
                    <div class="border rounded" id="expenseTypes-pie-chart">
                        <?php 
                            $chart = new FusionCharts("pie2d", "ex1", "100%", "100%", "expenseTypes-pie-chart", "json", $customer->getTypesAndAmount($customer->getCurrentFilterTime(1,0,$customer->getFlag()),$customer->getCurrentFilterTime(1,1,$customer->getFlag()),1));
                            $chart->render();
                        ?>
                    </div>
                </div>
                <div class="chart-explain col-7">
                    <div class="border rounded">
                        <?php 
                        $datarow = $customer->getDataByQuery("SELECT c.categoryName, SUM(t.amount) AS amount 
                                                                FROM category c
                                                                LEFT JOIN transaction t
                                                                ON c.categoryID = t.categoryID
                                                                WHERE t.cusID = " . $customer->getId() . "
                                                                AND c.categoryType = 'expenses'"
                                                                . $customer->getCurrentFilterTime(1,2,$customer->getFlag()) ."
                                                                GROUP BY c.categoryName
                                                                ORDER BY amount DESC
                                                            ");
                        if (!empty($datarow)) {
                            $percentageArray = $customer->getPercentage($customer->getCurrentFilterTime(1,0,$customer->getFlag()),$customer->getCurrentFilterTime(1,1,$customer->getFlag()),1);
                            for ($i = 0; $i < sizeof($datarow); $i++) {
                        ?>
                            <div class="container-fluid row category">
                                <div class="col-1">
                                    <p id="category<?php echo (($i + 1)); ?>"><?php echo $percentageArray[$i]['percentage'] ?></p>
                                </div>
                                <div class="col-5 forshowName">
                                    <h5 id="showName<?php echo ($datarow[$i]['categoryName']); ?>" name="showName"><?php echo ($datarow[$i]['categoryName']); ?></h5>
                                </div>
                                <div class="col-5 value forshowAmount">
                                    <h5 id="showAmount<?php echo ($datarow[$i]['categoryName']); ?>" name="showAmount"><?php echo ($datarow[$i]['amount']); ?></h5>
                                </div>
                                <div class="col-1 show forshowDetail">
                                    <button class="btn">
                                        <a href="#<?php echo ($datarow[$i]['categoryName']); ?>" id="showDetail<?php echo ($datarow[$i]['categoryName']); ?>" name="showDetail" data-toggle="row-hover" data-text="Show more" 
                                        onclick="showdetail('<?php echo ($datarow[$i]['categoryName']); ?>',<?php echo ($customer->getCurrentFilterTime(1,0,$customer->getFlag())) ?>,<?php echo ($customer->getCurrentFilterTime(1,1,$customer->getFlag())) ?>)">
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </button>
                                </div>
                            </div>
                        <?php
                            }
                        } ?>
                    </div>
                </div>
            </div>

            <div class="container-fluid category cate-overall" id="cate-overall">
                <div class="border round">
                    <div class="container-fluid title">
                        <h2 id="cateName" name="cateName">CATEGORY</h2>
                        <h5 id="cateAmount" name="cateAmount">Total: RM</h5>
                        <h5 id="cateAvg" name="cateAvg">Average Daily: RM</h5>
                    </div>
                    <div class="line-chart">
                        <div id="line-chart">
                        </div>
                    </div>
                </div>
            </div>

            <!-- table -->
            <table class="table table-bordered table-hover transaction-table" id="categoryTransactionTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">DATE</th>
                        <th scope="col">AMOUNT</th>
                        <th scope="col">NAME</th>
                        <th scope="col">DESCRIPTION</th>
                        <th scope="col">TYPE</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody id="categoryTransactionTableBody">
                </tbody>
            </table>

            <h4>ALL TRANSACTIONS</h4>
            <hr>

            <div class="container-fluid row filter">
                <div>
                    <h5>CATEGORY:</h5>
                    <select name="filter-transaction-category" id="filter-transaction-category" class="custom-select" onchange="showsearch('<?php echo ($customer->getCurrentFilterTime(1,2,$customer->getFlag())); ?>')">
                        <option value="ALL" selected>ALL</option>
                        <?php
                        $data = $customer->getDataByQuery("SELECT categoryName FROM category
                                                            WHERE categoryType = 'income' AND preDefine = 1 OR categoryType = 'income' AND cusID = " . $customer->getId() . "
                                                            OR categoryType = 'expenses' AND preDefine = 1 OR categoryType = 'expenses' AND cusID = " . $customer->getId() . "
                                                            ORDER BY categoryName ASC;
                                                            ");
                        foreach ($data as $row => $value) {
                        ?>
                            <option value="<?php echo ($value['categoryName']); ?>"><?php echo ($value['categoryName']); ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div>
                    <h5>TYPE:</h5>
                    <select name="filter-transaction-type" id="filter-transaction-type" class="custom-select" onchange="showsearch('<?php echo ($customer->getCurrentFilterTime(1,2,$customer->getFlag())); ?>')">
                        <option value="ALL">ALL</option>
                        <option value="Income">Income</option>
                        <option value="Expenses">Expenses</option>
                    </select>
                </div>
            </div>

            <div class="container-fluid row filter2">
                <div class="col-6 show">
                    <h6>Showing:<span id="table-row-count">
                        <?php
                        $datarow = $customer->getDataByQuery("SELECT t.transactionID, c.categoryName AS category, t.date, t.amount, t.description AS name, c.categoryType AS type
                                                        FROM transaction t
                                                        RIGHT JOIN category c
                                                        ON t.categoryID = c.categoryID
                                                        WHERE t.cusID = " . $customer->getId() . " 
                                                        AND (c.categoryType = 'income'
                                                        OR c.categoryType = 'expenses')"
                                                        . $customer->getCurrentFilterTime(1,2,$customer->getFlag()) .
                                                        "ORDER BY date DESC;
                                                        ");
                        if (empty($datarow)) {
                            echo (0);
                        } else {
                            echo (sizeof($datarow));
                        }
                    ?> </span>entries</h6>
                </div>

                <div class="col-6 search">
                    <input type="hidden" name="cusID" id="cusID" value="<?php echo ($customer->getId()) ?>">
                    <input type="hidden" name="filter-query" id="filter-query" value="<?php echo ($customer->getCurrentFilterTime(1,2,$customer->getFlag())); ?>">
                    <input type="text" name="" id="search-transaction" placeholder="  Transaction Name">
                    <h6>Search:</h6>
                </div>
            </div>

            <!-- new-row modal -->
            <div class="modal fade new-modal" id="new-row" tabindex="-1" role="dialog" aria-labelledby="new-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="new-title">New Transaction</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="POST" id="testing" onsubmit="return validateform(this);">
                            <div class="modal-body">
                                <div class="container">
                                    <div class="form-group row">
                                        <label class="col-5" for="new_transactionDateTime">Date & Time:</label>
                                        <input style="max-width: 57%" class="col-6 form-transactionDateTime" step="1" type="datetime-local" id="new_transactionDateTime" name="new_transactionDateTime" required />
                                        <label class="error" for="new_transactionDateTime">Please enter a valid date and time</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="new_transactionAmount">Amount:</label>
                                        <input class="col-6 form-transactionAmount" type="number" step='0.01' id="new_transactionAmount" name="new_transactionAmount" required />
                                        <label class="error" for="new_transactionAmount">Please enter a valid amount</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Type:</label>
                                        <input id="new_transactionType" class="col-6 form-transactionType" list="new_transactionTypeList" name="new_transactionType" required />
                                        <datalist id="new_transactionTypeList">
                                            <option id="typeIncome" value="income">income</option>
                                            <option id="typeExpense" value="expenses">expenses</option>
                                        </datalist>
                                        <label class="error" for="new_transactionType">Please enter a valid type</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" id="new_transactionCategoryLabel">Category:</label>
                                        <input id="new_transactionCategory" class="col-6 form-transactionCategory" list="" name="new_transactionCategory" required />
                                        <datalist id="new_transactionCategoryIncomeList">
                                            <?php
                                                $data = $customer->getDataByQuery("SELECT categoryName FROM category
                                                                                    WHERE categoryType = 'income'
                                                                                    AND preDefine = 1
                                                                                    OR categoryType = 'income'
                                                                                    AND cusID = " . $customer->getId() . "
                                                                                    ORDER BY categoryName ASC;
                                                                                    ");
                                                foreach ($data as $row => $value) {
                                                ?>
                                                    <option id="type<?php echo ($value['categoryName']); ?>" value="<?php echo ($value['categoryName']); ?>"><?php echo ($value['categoryName']); ?></option>
                                                <?php
                                                }
                                            ?>
                                        </datalist>
                                        <datalist id="new_transactionCategoryExpensesList">
                                            <?php
                                                $data = $customer->getDataByQuery("SELECT categoryName FROM category
                                                                                    WHERE categoryType = 'expenses'
                                                                                    AND preDefine = 1
                                                                                    OR categoryType = 'expenses'
                                                                                    AND cusID = " . $customer->getId() . "
                                                                                    ORDER BY categoryName ASC;
                                                                                    ");
                                                foreach ($data as $row => $value) {
                                                ?>
                                                    <option id="type<?php echo ($value['categoryName']); ?>" value="<?php echo ($value['categoryName']); ?>"><?php echo ($value['categoryName']); ?></option>
                                                <?php
                                                }
                                            ?>
                                        </datalist>
                                        <label class="error" for="new_transactionCategory">Please enter a valid category</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Name:</label>
                                        <input id="new_transactionName" class="col-6 form-transactionName" list="new_transactionNameList" name="new_transactionName"/>
                                        <datalist id="new_transactionNameList">
                                            <?php
                                            $data = $customer->getData('Transaction', "DISTINCT description");
                                            foreach ($data as $row => $value) {
                                            ?>
                                                <option value="<?php echo ($value['description']); ?>"><?php echo ($value['description']); ?></option>
                                            <?php
                                            }
                                            ?>
                                        </datalist>
                                        <label class="error" for="new_transactionName">Please enter a valid name</label>
                                    </div>
                                    <!-- Hold this first -->
                                    <!-- <div class="form-group row">
                                        <label class="col-5" for="">Repeat for:</label>
                                        <input id="new_transactionRepeat" class="col-6 form-transactionRepeat" name="new_transactionRepeat" disabled />
                                        <input type="checkbox" name="new_automate" id="new_automate">
                                        <label class="error" for="new_investmentType">Please enter a valid category</label>
                                    </div> -->
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
                            <h5 class="modal-title" id="edit-title">Edit Transaction</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="POST" id="edit-form" onsubmit="return validateform(this);">
                            <div class="modal-body">
                                <div class="container">
                                    <input type="hidden" id="edit_transactionID" name="edit_transactionID"></input>
                                    <div class="form-group row">
                                        <label class="col-5" for="edit_transactionDateTime">Date & Time:</label>
                                        <input style="max-width: 57%" class="col-6 form-transactionDateTime" step="1" type="datetime-local" id="edit_transactionDateTime" name="edit_transactionDateTime" required />
                                        <label class="error" for="edit_transactionDateTime">Please enter a valid date and time</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Amount:</label>
                                        <input class="col-6 form-transactionAmount" type="number" step='0.01' id="edit_transactionAmount" name="edit_transactionAmount" required />
                                        <label class="error" for="edit_transactionAmount">Please enter a valid amount</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Type:</label>
                                        <input id="edit_transactionType" class="col-6 form-transactionType" list="edit_transactionTypeList" name="edit_transactionType" required />
                                        <datalist id="edit_transactionTypeList">
                                            <option id="typeIncome" value="income">income</option>
                                            <option id="typeExpense" value="expenses">expenses</option>
                                        </datalist>
                                        <label class="error" for="edit_transactionType">Please enter a valid type</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" id="edit_transactionCategoryLabel">Category:</label>
                                        <input id="edit_transactionCategory" class="col-6 form-transactionCategory" list="" name="edit_transactionCategory" required />
                                        <datalist id="edit_transactionCategoryIncomeList">
                                            <?php
                                                $data = $customer->getDataByQuery("SELECT categoryName FROM category
                                                                                    WHERE categoryType = 'income'
                                                                                    AND preDefine = 1
                                                                                    OR categoryType = 'income'
                                                                                    AND cusID = " . $customer->getId() . "
                                                                                    ORDER BY categoryName ASC;
                                                                                    ");
                                                foreach ($data as $row => $value) {
                                                ?>
                                                    <option id="type<?php echo ($value['categoryName']); ?>" value="<?php echo ($value['categoryName']); ?>"><?php echo ($value['categoryName']); ?></option>
                                                <?php
                                                }
                                            ?>
                                        </datalist>
                                        <datalist id="edit_transactionCategoryExpensesList">
                                            <?php
                                                $data = $customer->getDataByQuery("SELECT categoryName FROM category
                                                                                    WHERE categoryType = 'expenses'
                                                                                    AND preDefine = 1
                                                                                    OR categoryType = 'expenses'
                                                                                    AND cusID = " . $customer->getId() . "
                                                                                    ORDER BY categoryName ASC;
                                                                                    ");
                                                foreach ($data as $row => $value) {
                                                ?>
                                                    <option id="type<?php echo ($value['categoryName']); ?>" value="<?php echo ($value['categoryName']); ?>"><?php echo ($value['categoryName']); ?></option>
                                                <?php
                                                }
                                            ?>
                                        </datalist>
                                        <label class="error" for="edit_transactionCategory">Please enter a valid category</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Name:</label>
                                        <input id="edit_transactionName" class="col-6 form-transactionName" list="edit_transactionNameList" name="edit_transactionName"/>
                                        <datalist id="edit_transactionNameList">
                                            <?php
                                            $data = $customer->getData('Transaction', "DISTINCT description");
                                            foreach ($data as $row => $value) {
                                            ?>
                                                <option value="<?php echo ($value['description']); ?>"><?php echo ($value['description']); ?></option>
                                            <?php
                                            }
                                            ?>
                                        </datalist>
                                        <label class="error" for="edit_transactionName">Please enter a valid name</label>
                                    </div>
                                    <!-- Hold this first -->
                                    <!-- <div class="form-group row">
                                        <label class="col-5" for="">Repeat for:</label>
                                        <input id="new_transactionRepeat" class="col-6 form-transactionRepeat" name="new_transactionRepeat" disabled />
                                        <input type="checkbox" name="new_automate" id="new_automate">
                                        <label class="error" for="new_investmentType">Please enter a valid category</label>
                                    </div> -->
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
            <div class="modal fade edit-modal" id="delete-row" tabindex="-1" role="dialog" aria-labelledby="delete-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <p>Are you sure want to Delete this transaction?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="" method="POST">
                                <input type="hidden" id="delete_transactionID" name="delete_transactionID"></input>
                                <button type="submit" class="btn btn-primary" name="delete_submit">Delete</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- table -->
            <table class="table table-bordered table-hover transaction-table" id="overallTransactionTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">DATE</th>
                        <th scope="col">TIME</th>
                        <th scope="col">AMOUNT</th>
                        <th scope="col">CATEGORY</th>
                        <th scope="col">NAME</th>
                        <th scope="col">TYPE</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody id="overallTransactionTableBody">

                    <?php 
                    $datarow = $customer->getDataByQuery("SELECT t.transactionID, c.categoryName AS category, t.date, t.amount, t.description AS name, c.categoryType AS type
                                                            FROM transaction t
                                                            RIGHT JOIN category c
                                                            ON t.categoryID = c.categoryID
                                                            WHERE t.cusID = " . $customer->getId() . " 
                                                            AND (c.categoryType = 'income'
                                                            OR c.categoryType = 'expenses')"
                                                            . $customer->getCurrentFilterTime(1,2,$customer->getFlag()) .
                                                            "ORDER BY date DESC;
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
                                <td class="transactionTime"><?php print_r($customer->getTime($datarow[$i]['transactionID'])); ?></td>
                                <td class="transactionAmount"><?php echo ($datarow[$i]['amount']); ?></td>
                                <td class="transactionCategory"><?php echo ($datarow[$i]['category']); ?></td>
                                <td class="transactionName"><?php echo ($description); ?></td>
                                <td class="transactionType"><?php echo ($datarow[$i]['type']); ?></td>
                                <td class="action">
                                    <a href="#" class="edit-transaction-anchor" data-toggle="modal" data-target="#edit-row">Edit</a>
                                    <span> | </span>
                                    <a href="#" class="delete-transaction-anchor" data-toggle="modal" data-target="#delete-row">Delete</a>
                                </td>
                            </tr>
                    <?php
                        }
                    } ?>
                </tbody>
            </table>

            <!-- the row below table, last thing to do  -->
            <!-- <div class="container-fluid row filter3">
                <div class="show col-6">
                    <h6>Showing 1 to 3 of 3 entries</h6>
                </div> -->

            <!-- Pagination -->
            <!-- <nav class="col-6">
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <span class="page-link">Previous</span>
                        </li>
                        <li class="page-item active">
                            <span class="page-link">
                                1
                                <span class="sr-only">(current)</span>
                            </span>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div> -->
        </div>
    </div>

    <button type="button" class="btn btn-circle btn-xl" data-toggle="modal" data-target="#new-row">
        <i class="fas fa-plus"></i>
    </button>
</body>
<script src="./script/transaction.js"></script>
</html>