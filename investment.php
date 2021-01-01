<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(".head.php"); ?>
    <link rel="stylesheet" href="./style/investment.css">

    <title>PocketMoney | Investment</title>
</head>

<body>
    <?php include(".navbar.php");

    //update the investment transaction
    if (isset($_POST['edit_submit'])) {
        $params['tableName'] = 'Investment';
        $params['idName'] = 'investmentID';
        $params['id'] = $_POST['edit_investmentID'];
        $params['data'] = array(
            'investmentName' => $_POST['edit_investmentName'],
            'investmentType' => $_POST['edit_investmentType'],
            'startDate' => $_POST['edit_startDate'],
            'amountInvested' => $_POST['edit_amountInvested'],
            'ratePerAnnum' => $_POST['edit_ratePerAnnum']
        );
        $result = $customer->customerUpdate($params);
        if ($result['status'] == 'ok') {
            $customer->showAlert($result['statusMsg']);
        } else {
            $customer->showAlert($result['statusMsg']);
        }
        $customer->goTo('investment.php');
    }


    //delete transaction
    if (isset($_POST['delete_submit'])) {
        $params['tableName'] = 'Investment';
        $params['idName'] = 'investmentID';
        $params['id'] = $_POST['delete_investmentID'];
        $result = $customer->customerDelete($params);
        if ($result['status'] == 'ok') {
            $customer->showAlert($result['statusMsg']);
        } else {
            $customer->showAlert($result['statusMsg']);
        }
        $customer->goTo('investment.php');
    }

    //new transaction
    if (isset($_POST['new_submit'])) {
        $params['tableName'] = 'Investment';
        $params['data'] = array(
            'cusID' => $customer->getId(),
            'investmentName' => $_POST['new_investmentName'],
            'investmentType' => $_POST['new_investmentType'],
            'startDate' => $_POST['new_startDate'],
            'amountInvested' => $_POST['new_amountInvested'],
            'ratePerAnnum' => $_POST['new_ratePerAnnum']
        );
        $result = $customer->customerInsert($params);

        if ($result['status'] == 'ok') {
            $customer->showAlert($result['statusMsg']);
        } else {
            $customer->showAlert($result['statusMsg']);
        }
        $customer->goTo('investment.php');
    }

    //edit general investment
    if (isset($_POST['edit-general-submit'])) {
        $params['tableName'] = 'Investment';
        $params['idName'] = 'investmentName';
        $params['id'] = $_POST['edit-general-name'];
        $params['data'] = array(
            'investmentName' => $_POST['edit-general-newName'],
            'investmentType' => $_POST['edit-general-investmentType'],
            'ratePerAnnum' => $_POST['edit-general-ratePerAnnum']
        );
        $result = $customer->customerUpdate($params);
        if ($result['status'] == 'ok') {
            $customer->showAlert($result['statusMsg']);
        } else {
            $customer->showAlert($result['statusMsg']);
        }
        $customer->goTo('investment.php');
    }

    //delete general invesment
    if (isset($_POST['delete-general-submit'])) {
        $params['tableName'] = 'Investment';
        $params['idName'] = 'investmentName';
        $params['id'] = $_POST['delete-general-name'];
        $result = $customer->customerDelete($params);
        if ($result['status'] == 'ok') {
            $customer->showAlert($result['statusMsg']);
        } else {
            $customer->showAlert($result['statusMsg']);
        }
        $customer->goTo('investment.php');
    }

    ?>
    <div class="container-fluid background">
        <div class="container-fluid body">
            <nav class="navbar navbar-expand-lg">
                <a href="#" class="navbar-brand">INVESTMENT</a>
            </nav>

            <div class="container-fluid row overall">
                <div>
                    <h5>Total Amount</h5>
                    <p>
                        RM <?php echo ($customer->getTotalInvestedAmount()); ?>
                    </p>
                </div>
                <div>
                    <h5>Top Holding</h5>
                    <p><?php echo ($customer->getTopHolding()); ?></p>
                </div>
                <div>
                    <h5>Total Holdings</h5>
                    <p><?php echo ($customer->getHoldingCount()); ?></p>
                </div>
            </div>

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


            <div class="container-fluid row head">
                <h4 class="col-6">INVESTMENT SUMMARY</h5>
                    <div class="col-6">
                        <a href="#" class="btn delete" data-toggle="modal" data-target="#delete">DELETE</a>
                        <a href="#" class="btn edit" data-toggle="modal" data-target="#edit">EDIT</a>
                    </div>

                    <!-- delete modal -->
                    <div class="modal fade edit-modal" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete-title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="edit-title">Delete Investment</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="" method="post" onsubmit="return confirm('This cannot be undone, are you sure you want to proceed?');">
                                    <div class="modal-body">
                                        <p>Pick an investment and click Delete.</p>

                                        <div class="form-group row">
                                            <label class="col-5" for="">Please Select:</label>
                                            <select class="col-6" class="custom-select" id="delete-general-name" name="delete-general-name" required>
                                                <option value="" selected>Select an investment</option>
                                                <?php
                                                $data = $customer->getData('Investment', "DISTINCT investmentName");
                                                foreach ($data as $row => $value) {
                                                ?>
                                                    <option value="<?php echo ($value['investmentName']); ?>"><?php echo ($value['investmentName']); ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="delete-general-submit" class="btn btn-primary">Delete</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- edit modal -->
                    <div class="modal fade edit-modal" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit-title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="edit-title">Edit by Investment</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="" method="POST" id="edit-general-form" onsubmit="return validateform(this);">
                                    <div class="modal-body">

                                        <div class="form-group row">
                                            <label class="col-5" for="">Please Select:</label>
                                            <select class="col-6" class="custom-select" id="edit-general-name" name="edit-general-name" required>
                                                <option value="" selected>Select an investment</option>
                                                <?php
                                                $data = $customer->getData('Investment', "DISTINCT investmentName");
                                                foreach ($data as $row => $value) {
                                                ?>
                                                    <option value="<?php echo ($value['investmentName']); ?>"><?php echo ($value['investmentName']); ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-5" for="">Name:</label>
                                            <input class="col-6 form-investmentName" type="text" id="edit-general-newName" name="edit-general-newName" required disabled>
                                            <label class="error" for="edit-general-newName">Please enter a valid name</label>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-5" for="">Category:</label>
                                            <input id="edit-general-investmentType" class="col-6 form-investmentType" list="edit-general-investmentTypeList" name="edit-general-investmentType" required disabled />
                                            <datalist id="edit-general-investmentTypeList">
                                                <?php
                                                $data = $customer->getData('Investment', "DISTINCT investmentType");
                                                foreach ($data as $row => $value) {
                                                ?>
                                                    <option id="type<?php echo ($value['investmentType']); ?>" value="<?php echo ($value['investmentType']); ?>"><?php echo ($value['investmentType']); ?></option>
                                                <?php
                                                }
                                                ?>
                                            </datalist>
                                            <label class="error" for="edit-general-investmentType">Please enter a valid category</label>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-5" for="">Rate per Annum:</label>
                                            <input class="col-6 form-ratePerAnnum" type="number" name="edit-general-ratePerAnnum" step='0.01' id="edit-general-ratePerAnnum" required disabled>
                                            <label class="error" for="edit-general-ratePerAnnum">Please enter a valid rate</label>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-5" for="">Total Amount:</label>
                                            <input class="col-6" id="edit-general-totalAmount" type="number" step='0.01' value="" disabled>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="edit-general-submit">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>




            </div>
            <!-- table -->
            <table class="table table-bordered table-hover institution-table">
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

            <h4>INVESTMENT TRANSACTIONS</h4>
            <hr>

            <div class="container-fluid row filter">
                <div>
                    <h5>CATEGORY:</h5>
                    <select name="filter-transaction-category" id="filter-transaction-category" class="custom-select" onchange="showsearch('')">
                        <option value="ALL" selected>ALL</option>
                        <?php
                        $data = $customer->getData('Investment', "DISTINCT investmentType");
                        foreach ($data as $row => $value) {
                        ?>
                            <option value="<?php echo ($value['investmentType']); ?>"><?php echo ($value['investmentType']); ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div>
                    <h5>TIME PERIOD:</h5>
                    <select name="filter-transaction-time" id="filter-transaction-time" class="custom-select" onchange="showsearch('')">
                        <option value="ALL">ALL</option>
                        <option value="ThisMonth">This Month</option>
                        <option value="Last3Months">Last 3 Months</option>
                        <option value="ThisYear">This Year</option>
                    </select>
                </div>
            </div>

            <div class="container-fluid row filter2">
                <div class="col-6 row show">
                    <h6>Showing:<span id="table-row-count">
                            <?php $datarow = $customer->getData('Investment');
                            if (empty($datarow)) {
                                echo (0);
                            } else {
                                echo (sizeof($datarow));
                            }
                            ?> </span>entries</h6>
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
                            <h5 class="modal-title" id="new-title">New Transaction</h5>
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
                                        <label class="col-5" for="">Amount:</label>
                                        <input class="col-6 form-amountInvested" type="number" step='0.01' id="new_amountInvested" name="new_amountInvested" required />
                                        <label class="error" for="new_amountInvested">Please enter a valid amount</label>
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
                                        <label class="col-5" for="">Annual Rate:</label>
                                        <input class="col-6 form-ratePerAnnum" type="number" step='0.01' id="new_ratePerAnnum" name="new_ratePerAnnum" required />
                                        <label class="error" for="new_ratePerAnnum">Please enter a valid rate</label>
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
                            <h5 class="modal-title" id="edit-title">Edit Transaction</h5>
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
                                        <label class="col-5" for="">Amount:</label>
                                        <input class="col-6 form-amountInvested" type="number" step='0.01' id="edit_amountInvested" name="edit_amountInvested" required />
                                        <label class="error" for="edit_amountInvested">Please enter a valid amount</label>
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
                                        <label class="col-5" for="">Annual Rate:</label>
                                        <input class="col-6 form-ratePerAnnum" type="number" step='0.01' id="edit_ratePerAnnum" name="edit_ratePerAnnum" required />
                                        <label class="error" for="edit_ratePerAnnum">Please enter a valid rate</label>
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
                            <p>Are you sure want to Delete this transaction?</p>
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
                        <th scope="col">DATE</th>
                        <th scope="col">AMOUNT</th>
                        <th scope="col">NAME</th>
                        <th scope="col">CATEGORY</th>
                        <th scope="col">ANNUAL RATE</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody id="investmentTransactionTableBody">

                    <?php if (!empty($datarow)) {
                        for ($i = 0; $i < sizeof($datarow); $i++) {
                    ?>
                            <tr>
                                <input type="hidden" class="investmentID" value='<?php echo ($datarow[$i]['investmentID']); ?>'></input>
                                <th scope="row"><?php echo (($i + 1)); ?></th>
                                <td class="investDate"><?php echo ($datarow[$i]['startDate']); ?></td>
                                <td class="investAmount"><?php echo ($datarow[$i]['amountInvested']); ?></td>
                                <td class="investName"><?php echo ($datarow[$i]['investmentName']); ?></td>
                                <td class="investType"><?php echo ($datarow[$i]['investmentType']); ?></td>
                                <td class="investRate"><?php echo ($datarow[$i]['ratePerAnnum']); ?></td>
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
<script src="./script/investment.js"></script>

</html>