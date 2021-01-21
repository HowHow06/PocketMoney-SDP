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
        $customer->goTo('budget.php');
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
        $customer->goTo('budget.php');
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
        $customer->goTo('budget.php');
    }
    ?>

    <div class="container-fluid background">
        <div class="container-fluid body">
            <nav class="navbar navbar-expand-lg">
                <a href="#" class="navbar-brand">BUDGETS</a>
            </nav>
            <div class="container-fluid budget-overview">
                <div class="container-fluid rounded border">
                    <div class="col-12">
                        <h4>BUDGET OVERVIEW</h4>
                    </div>
                    <div class="budget-row-head">
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
                    </div>
                </div>
            </div>
            
			<br></br>
            <div class="container-fluid budget-manage">
                    <div class="col-12">
                        <h4>MANAGE BUDGET</h4>
                    </div>
                    <div class="row">
                        <table class="table table-bordered table-hover transaction-table" id="overallTransactionTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">CATEGORY</th>
						<th scope="col">PERCENTAGE</th>
						<th scope="col">ACTION</th>
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
            </div>
					<button type="button" class="btn btn-circle btn-xl" data-toggle="modal" data-target="#new-budget">
                    <i class="fas fa-plus"></i>
                    </button>
            </div>
	
            <!-- new-budget modal -->
            <div class="modal fade new-modal" id="new-budget" tabindex="-1" role="dialog" aria-labelledby="new-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="new-title">New Budget</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="POST" id="testing" onsubmit="return validateform(this);">
                            <div class="modal-body">
                                <div class="container">
                                    <div class="form-group row">
                                        <label class="col-5" for="new_budgetCategory">Category:</label>
                                        <input id="new_budgetCategory" class="col-6 form-investmentType" list="new_budgetCategoryList" name="new_budgetCategory" required />
                                        <datalist id="new_budgetCategoryList">
											<?php
                                                $data = $customer->getDataByQuery("SELECT categoryName FROM category
                                                                                    WHERE (categoryType = 'budget'
                                                                                    OR categoryType = 'expenses')
                                                                                    AND (preDefine = 1 OR
																					cusID = " . $customer->getId() . ")
                                                                                    ORDER BY categoryName ASC;
                                                                                    ");
                                                foreach ($data as $row => $value) {
                                                ?>
                                                    <option id="type<?php echo ($value['categoryName']); ?>" value="<?php echo ($value['categoryName']); ?>"><?php echo ($value['categoryName']); ?></option>
                                                <?php
                                                }
                                            ?>
                                        </datalist>
                                        <label class="error" for="new_budgetCategory">Please enter a valid category</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="new_budgetPercentage">Percentage:</label>
                                        <input class="col-6 form-amountInvested" type="number" step='1.00' id="new_budgetPercentage" name="new_budgetPercentage" required />
                                        <label class="error" for="new_budgetPercentage">Please enter a valid percentage</label>
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
            <!-- edit-budget modal -->
            <div class="modal fade edit-modal" id="edit-row" tabindex="-1" role="dialog" aria-labelledby="edit-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit-title">Edit Budget</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="POST" id="edit-form" onsubmit="return validateform(this);">
                            <div class="modal-body">
                                <div class="container">
                                    <input type="hidden" id="edit_budgetID" name="edit_budgetID"></input>
                                    <div class="form-group row">
                                        <label class="col-5" for="edit_budgetCategory">Category:</label>
                                        <input id="edit_budgetCategory" class="col-6 form-investmentType" list="edit_budgetCategoryList" name="edit_budgetCategory" required />
                                        <datalist id="edit_budgetCategoryList">
                                            <?php
                                                $data = $customer->getDataByQuery("SELECT categoryName FROM category
                                                                                    WHERE (categoryType = 'budget'
                                                                                    OR categoryType = 'expenses')
                                                                                    AND (preDefine = 1 OR
																					cusID = " . $customer->getId() . ")
                                                                                    ORDER BY categoryName ASC;
                                                                                    ");
                                                foreach ($data as $row => $value) {
                                                ?>
                                                    <option id="type<?php echo ($value['categoryName']); ?>" value="<?php echo ($value['categoryName']); ?>"><?php echo ($value['categoryName']); ?></option>
                                                <?php
                                                }
                                            ?>
                                        </datalist>
                                        <label class="error" for="edit_budgetCategory">Please enter a valid category</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="edit_budgetPercentage">Percentage:</label>
                                        <input class="col-6 form-amountInvested" type="number" step='1.00' id="edit_budgetPercentage" name="edit_budgetPercentage" required />
                                        <label class="error" for="edit_budgetPercentage">Please enter a valid percentage</label>
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
                    <select name="filter-transaction-category" id="filter-transaction-category" class="custom-select" onchange="showsearch('<?php echo ($customer->getCurrentFilterTime(1,2,$customer->getFlag())); ?>')">
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
                            <?php $datarow = $customer->getTableRowCount($customer->getCurrentFilterTime(1,0,$customer->getFlag()),$customer->getCurrentFilterTime(1,1,$customer->getFlag()));
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
                                                            . $customer->getCurrentFilterTime(1,2,$customer->getFlag()) .
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
