<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(".head.php"); ?>
    <link rel="stylesheet" href="./style/investment.css">

    <title>PocketMoney | Investment</title>
</head>

<body>
    <?php include(".navbar.php"); ?>
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
                <!-- horizontal bar chart -->
                <input type="hidden" id="amountsOfInvestments" name="amountsOfInvestments" value='<?php echo ($customer->getTypeAmountsJSON()); ?>'></input>
                <input type="hidden" id="typesOfInvestments" name="typesOfInvestments" value='<?php echo ($customer->getInvestTypesJSON()); ?>'></input>
                <div class="col-6 horizontal-chart" id="investmentTypes-donut-chart"></div>
                <!-- pie chart -->
                <input type="hidden" id="amountsOfInvestmentByName" name="amountsOfInvestmentByName" value='<?php echo ($customer->getNameAmountsJSON()); ?>'>
                <input type="hidden" id="nameOfInvestment" name="nameOfInvestment" value='<?php echo ($customer->getInvestNameJSON()); ?>'>
                <div class="col-6 donut-chart" id="investmentNames-donut-chart"></div>
            </div>

            <!-- table -->
            <div class="container-fluid row head">
                <h4 class="col-6">INVESTMENT SUMMARY</h5>
                    <div class="col-6">
                        <a href="#" class="btn delete" data-toggle="modal" data-target="#delete">DELETE</a>
                        <a href="#" class="btn edit" data-toggle="modal" data-target="#edit">EDIT</a>
                        <a href="#" class="btn add" data-toggle="modal" data-target="#add">ADD</a>
                    </div>

                    <!-- delete modal -->
                    <div class="modal fade edit-modal" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete-title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="edit-title">Delete Institution</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Pick an institution and click Delete.</p>
                                    <form action="" method="post">
                                        <div class="form-group row">
                                            <label class="col-4" for="">Institution:</label>
                                            <select class="col-6" class="custom-select" id="category">
                                                <option value="">Company ABC</option>
                                                <option value="">Apple</option>
                                                <option value="">Samsung</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary">Delete</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- edit modal -->
                    <div class="modal fade edit-modal" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit-title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="edit-title">Edit Institution</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <div class="form-group row">
                                            <label class="col-4" for="">Institution:</label>
                                            <select class="col-6" class="custom-select" id="institution">
                                                <option value="">Company ABC</option>
                                                <option value="">Apple</option>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="">Description:</label>
                                            <input class="col-6" type="text">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="">Type:</label>
                                            <select class="col-6" class="custom-select" id="type">
                                                <option value="">Holding</option>
                                                <option value="">Diposed</option>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="">Price:</label>
                                            <input class="col-6" type="number">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="">Rate per Annum:</label>
                                            <input class="col-6" type="number">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="">Profit:</label>
                                            <input class="col-6" type="number" value="0.00" disabled>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="">Current Value:</label>
                                            <input class="col-6" type="number" value="1300.00" disabled>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- add modal -->
                    <div class="modal fade edit-modal" id="add" tabindex="-1" role="dialog" aria-labelledby="add-title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="edit-title">Add Institution</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <div class="form-group row">
                                            <label class="col-4" for="">Institution:</label>
                                            <input class="col-6" type="text">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="">Description:</label>
                                            <input class="col-6" type="text">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="">Type:</label>
                                            <select class="col-6" class="custom-select" id="type">
                                                <option value="">Holding</option>
                                                <option value="">Diposed</option>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="">Price:</label>
                                            <input class="col-6" type="number">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="">Rate per Annum:</label>
                                            <input class="col-6" type="number">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="">Profit:</label>
                                            <input class="col-6" type="number" value="0.00" disabled>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="">Current Value:</label>
                                            <input class="col-6" type="number" value="1300.00" disabled>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary">Add</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>


            </div>
            <table class="table table-bordered table-hover institution-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">INSTITUTION</th>
                        <th scope="col">DESCRIPTION</th>
                        <th scope="col">TYPE</th>
                        <th scope="col">PRICE</th>
                        <th scope="col">RATE PER ANNUM</th>
                        <th scope="col">PROFIT</th>
                        <th scope="col">CURRENT VALUE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Company ABC</td>
                        <td>Self-Developed Company</td>
                        <td>Holding</td>
                        <td>850.00</td>
                        <td>1.05</td>
                        <td>500.00</td>
                        <td>1350.00</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Apple</td>
                        <td>Phone Electronic Company</td>
                        <td>Holding</td>
                        <td>1682.00</td>
                        <td>1.25</td>
                        <td>350.00</td>
                        <td>2032.00</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Samsung</td>
                        <td>Phone Electronic Company</td>
                        <td>Holding</td>
                        <td>310.00</td>
                        <td>1.05</td>
                        <td>10.00</td>
                        <td>320.10</td>
                    </tr>
                </tbody>
            </table>

            <h4>INVESTMENT TRANSACTIONS</h4>
            <hr>

            <div class="container-fluid row filter">
                <div>
                    <h5>CATEGORY:</h5>
                    <select name="filter-transaction-category" id="filter-transaction-category" class="custom-select">
                        <option value="ALL" selected>ALL</option>
                        <?php
                        $data = $customer->getInvestmentData("DISTINCT investmentType");
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
                    <select name="filter-transaction-time" id="filter-transaction-time" class="custom-select">
                        <option value="ALL">ALL</option>
                        <option value="ThisMonth">This Month</option>
                        <option value="Last3Months">Last 3 Months</option>
                        <option value="ThisYear">This Year</option>
                    </select>
                </div>
            </div>

            <div class="container-fluid row filter2">
                <div class="col-6 row show">
                    <h6>Showing:
                        <?php $datarow = $customer->getInvestmentData();
                        if (empty($datarow)) {
                            echo (0);
                        } else {
                            echo (sizeof($datarow));
                        }
                        ?> entries</h6>
                </div>

                <div class="col-6 search">
                    <input type="text" name="" id="" placeholder="  Apple eg.">
                    <h6>Search:</h6>
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
                        <div class="modal-body">
                            <div class="container">
                                <form action="" method="post">
                                    <input type="hidden" id="edit_investmentID" name="edit_investmentID"></input>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Date:</label>
                                        <input class="col-6" type="date" id="edit_startDate" name="edit_startDate">
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Amount:</label>
                                        <input class="col-6" type="number" id="edit_amountInvested" name="edit_amountInvested">
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Name:</label>
                                        <input id="edit_investmentName" class="col-6" list="edit_investmentNameList" name="edit_investmentName" required>
                                        <datalist id="edit_investmentNameList">
                                            <?php
                                            $data = $customer->getInvestmentData("DISTINCT investmentName");
                                            foreach ($data as $row => $value) {
                                            ?>
                                                <option value="<?php echo ($value['investmentName']); ?>"><?php echo ($value['investmentName']); ?></option>
                                            <?php
                                            }
                                            ?>
                                        </datalist>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Category:</label>
                                        <input id="edit_investmentType" class="col-6" list="edit_investmentTypeList" name="edit_investmentType" required>
                                        <datalist id="edit_investmentTypeList">
                                            <?php
                                            $data = $customer->getInvestmentData("DISTINCT investmentType");
                                            foreach ($data as $row => $value) {
                                            ?>
                                                <option id="type<?php echo ($value['investmentType']); ?>" value="<?php echo ($value['investmentType']); ?>"><?php echo ($value['investmentType']); ?></option>
                                            <?php
                                            }
                                            ?>
                                        </datalist>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Annual Rate:</label>
                                        <input class="col-6" type="number" id="edit_ratePerAnnum" name="edit_ratePerAnnum">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
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
                            <input type="hidden" id="delete_investmentID" name="delete_investmentID"></input>
                            <button type="button" class="btn btn-primary">Delete</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
</body>
<script src="./script/investment.js"></script>

</html>