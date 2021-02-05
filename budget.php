<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(".head.php"); ?>
    <link rel="stylesheet" href="./style/budget.css">

    <title>PocketMoney | Budgets</title>
</head>

<body>
    <?php
    $activePage = "budgets";
    include(".navbar.php");

    $customer->setCurDate();
    $customer->setFlag(0);

    //update the budget
    if (isset($_POST['edit_submit'])) {
        $params['tableName'] = 'Budget';
        $params['idName'] = 'budgetID';
        $params['id'] = $_POST['edit_budgetID'];

        // Get categoryID based on categoryName
        $datarow = $customer->getDataByQuery('SELECT categoryID FROM category
                                                WHERE categoryName=\'' . $_POST['edit_budgetCategory'] . '\';
                                                ');

        $params['data'] = array(
            'cusID' => $customer->getId(),
            'percentage' => $_POST['edit_budgetPercentage'],
            'categoryID' => $datarow[0]['categoryID']
        );
        $result = $customer->customerUpdate($params);
        if ($result['status'] == 'ok') {
            $customer->showAlert($result['statusMsg']);
        } else {
            $customer->showAlert($result['statusMsg']);
        }
        $customer->goTo('budget.php?role=customer');
    }

    //delete budget
    if (isset($_POST['delete_submit'])) {
        $params['tableName'] = 'Budget';
        $params['idName'] = 'budgetID';
        $params['id'] = $_POST['delete_budgetID'];
        $result = $customer->customerDelete($params);
        if ($result['status'] == 'ok') {
            $customer->showAlert($result['statusMsg']);
        } else {
            $customer->showAlert($result['statusMsg']);
        }
        $customer->goTo('budget.php?role=customer');
    }

    //new budget
    if (isset($_POST['new_submit'])) {
        $params['tableName'] = 'Budget';

        // Get categoryID based on categoryName
        $datarow = $customer->getDataByQuery('SELECT categoryID FROM category
        WHERE categoryName=\'' . $_POST['new_budgetCategory'] . '\';
        ');
        $params['data'] = array(
            'cusID' => $customer->getId(),
            'categoryID' => $datarow[0]['categoryID'],
            'percentage' => $_POST['new_budgetPercentage'],
        );
        $result = $customer->customerInsert($params);

        if ($result['status'] == 'ok') {
            $customer->showAlert($result['statusMsg']);
        } else {
            $customer->showAlert($result['statusMsg']);
        }
        $customer->goTo('budget.php?role=customer');
    }
    ?>

    <div class="container-fluid background">
        <div class="container-fluid body">
            <nav class="navbar navbar-expand-lg">
                <a href="#" class="navbar-brand">BUDGET PLAN</a>
            </nav>
            <div class="container-fluid budget-overview">
                <div class="container-fluid rounded border">
                    <div class="col-12">
                        <h4>BUDGET OVERVIEW</h4>
                    </div>
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
                        array_push($data, $rowOfOthers);
                        $count = 0;
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
                                AND tr.categoryID NOT IN (" . $cateIdsSubQuery . ")"; //select amount of those categories that are not in budget

                                $amountResults = $customer->getDataByQuery($query);
                            } else {
                                $amountResults = $customer->getData("Transaction", "SUM(amount) as usedAmount", array('categoryID' => $row['categoryID'], 'cusID' => $customer->getId()));
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

            <br></br>

            <!-- the manage budget section -->
            <div class="container-fluid budget-manage">
                <div class="border round">
                    <div class="row">
                        <div class="col-6">
                            <h4>MANAGE BUDGET</h4>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-secondary float-right edit-budget-btn" id="btn-edit" data-toggle="modal" data-target="#edit-row">Edit / Add New</button>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-bordered table-hover transaction-table" id="overallTransactionTable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">CATEGORY</th>
                                    <th scope="col">PERCENTAGE</th>
                                    <!-- <th scope="col">ACTION</th> -->
                                </tr>
                            </thead>
                            <tbody id="overallTransactionTableBody">
                                <?php
                                $datarow = $customer->getDataByQuery("SELECT b.budgetID, c.categoryName AS category, 
                                                                        c.categoryType AS type,
                                                                        b.percentage AS percentage
                                                                        FROM budget b, category c
                                                                        WHERE b.cusID = " . $customer->getId() . " 
                                                                        AND b.categoryID = c.categoryID
                                                                        ORDER BY categoryName DESC;
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
                                            <input type="hidden" class="budgetID" value='<?php echo ($datarow[$i]['budgetID']); ?>'></input>
                                            <th scope="row"><?php echo (($i + 1)); ?></th>
                                            <td class="budgetCategory"><?php echo ($datarow[$i]['category']); ?></td>
                                            <td class="budgetPercentage"><?php echo ($datarow[$i]['percentage']); ?></td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo ("<p>You have not setup your budget plan, please click 'Edit / Add New' button to create one</p>");
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!-- edit-budget modal -->
            <div class="modal fade edit-modal" id="edit-row" tabindex="-1" role="dialog" aria-labelledby="edit-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit-title">Edit / Add New Budget</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="POST" id="edit-form" onsubmit="return false;">
                            <div class="modal-body">
                                <div class="container" id="edit-body-data">
                                    <!-- ajax in php will handle this part -->
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="reset" class="btn btn-success edit-budget-btn">Reset</button>
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
                            <p>Are you sure want to Delete this budget?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="" method="POST">
                                <input type="hidden" id="delete_budgetID" name="delete_budgetID"></input>
                                <button type="submit" class="btn btn-primary" name="delete_submit">Delete</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- dont touch anything from here -->
            <h4>ALL EXPENSES TRANSACTIONS</h4>
            <hr>

            <div class="container-fluid row filter">
                <div>
                    <h5>CATEGORY:</h5>
                    <select name="filter-transaction-category" id="filter-transaction-category" class="custom-select" onchange="showsearch('<?php echo ($customer->getCurrentFilterTime(1, 2, $customer->getFlag())); ?>')">
                        <option value="ALL" selected>ALL</option>
                        <?php
                        $data = $customer->getDataByQuery("SELECT categoryName FROM category
                                                            	WHERE categoryType = 'expenses' AND preDefine = 1 OR categoryType = 'expenses' AND cusID = " . $customer->getId() . "
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
            </div>

            <div class="container-fluid row filter2">
                <div class="col-6 show">
                    <h6>Showing:<span id="table-row-count">
                            <?php $datarow = $customer->getTableRowCount($customer->getCurrentFilterTime(1, 0, $customer->getFlag()), $customer->getCurrentFilterTime(1, 1, $customer->getFlag()));
                            if (empty($datarow)) {
                                echo (0);
                            } else {
                                echo (sizeof($datarow));
                            }
                            ?> </span>entries</h6>
                </div>

                <div class="col-6 search">
                    <input type="hidden" name="cusID" id="cusID" value="<?php echo ($customer->getId()) ?>">
                    <input type="hidden" name="filter-query" id="filter-query" value="<?php echo ($customer->getCurrentFilterTime(1, 2, $customer->getFlag())); ?>">
                    <input type="text" name="" id="search-transaction" placeholder="  Transaction Name">
                    <h6>Search:</h6>
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
                    </tr>
                </thead>
                <tbody id="overallTransactionTableBody">

                    <?php
                    $datarow = $customer->getDataByQuery("SELECT t.transactionID, c.categoryName AS category, t.date, t.amount, t.description AS name, c.categoryType AS type
                                                            FROM transaction t, category c
                                                            WHERE t.cusID = " . $customer->getId() . " 
                                                            AND t.categoryID = c.categoryID "
                        . $customer->getCurrentFilterTime(1, 2, $customer->getFlag()) .
                        "
															ORDER BY date DESC;
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
</body>
<script src="./script/budget.js"></script>

</html>