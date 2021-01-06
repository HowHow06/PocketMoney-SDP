<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(".head.php"); ?>
    <link rel="stylesheet" href="./style/liability.css">

    <title>PocketMoney | Liabilities</title>
</head>

<body>
    <?php
    $activePage = "liabilities"; 
    include(".navbar.php");
    ?>

    <div class="container-fluid background">
        <div class="container-fluid body">
            <nav class="navbar navbar-expand-lg">
                <a href="#" class="navbar-brand">LIABILITIES</a>
            </nav>

            <div class="container-fluid row overall">
                <div>
                    <h5>Total Amount</h5>
                    <p>
                        RM <?php echo ($customer->getTotalInvestedAmount()); ?>
                    </p>
                </div>
                <div>
                    <h5>Top Liability</h5>
                    <p><?php echo ($customer->getTopHolding()); ?></p>
                </div>
                <div>
                    <h5>Total Liabilities</h5>
                    <p><?php echo ($customer->getHoldingCount()); ?></p>
                </div>
            </div>

            <div class="container-fluid liability-overview">
                <div class="container-fluid rounded border">
                    <div class="col-12">
                        <h4>LIABILITY OVERVIEW</h4>
                    </div>
                    <div class="liability-row">
                        <div class="row">
                            <div class="col-3">
                                <div>
                                    <sub>Proton Car Loan</sub>
                                </div>
                                <p>RM 57000.00</p>
                            </div>
                            <div class="col-9">
                                <!-- bar -->
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="16" aria-valuemin="0" aria-valuemax="100" id="progress-bar"></div>
                                    <h6>16%</h6>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="paid">RM 4200.00</h6>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="target">RM 52800.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="liability-row">
                        <div class="row">
                            <div class="col-3">
                                <div>
                                    <sub>PTPTN</sub>
                                </div>
                                <p>RM 120000.00</p>
                            </div>
                            <div class="col-9">
                                <!-- bar -->
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100" id="progress-bar"></div>
                                    <h6>32%</h6>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="paid">RM 12000.00</h6>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="target">RM 91800.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="liability-row">
                        <div class="row">
                            <div class="col-3">
                                <div>
                                    <sub>VKB-A1 House Loan</sub>
                                </div>
                                <p>RM 110000.00</p>
                            </div>
                            <div class="col-9">
                                <!-- bar -->
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100" id="progress-bar"></div>
                                    <h6>58%</h6>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="paid">RM 56000.00</h6>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="target">RM 52800.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>

            <div class="container-fluid row upcoming-payment">
                <div class="pie-chart">
                    <div class="border rounded" id="pie-chart">
                    </div>
                </div>
                <div class="chart-explain">
                    <div class="border rounded">
                        <!-- table -->
                        <form action="" method="POST">
                            <input type="radio" name="filter" id="month" checked><label class="radio-inline month" for="month">Month</label>
                            <input type="radio" name="filter" id="year"><label class="radio-inline year" for="year">Year</label>
                            <table class="table table-bordered table-hover transaction-table table-sm" id="investmentTransactionTable">
                                <thead>
                                    <tr>
                                        <th colspan="4" class="title">UPCOMING PAYMENT</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">NAME</th>
                                        <th scope="col">CATEGORY</th>
                                        <th scope="col">TOTAL AMOUNT TO PAY</th>
                                        <th scope="col">DUE ON</th>
                                    </tr>
                                </thead>
                                <tbody id="investmentTransactionTableBody">

                                    <?php 
                                        $datarow = $customer->getData('Investment');
                                        if (!empty($datarow)) {
                                        for ($i = 0; $i < sizeof($datarow); $i++) {
                                    ?>
                                            <tr>
                                                <input type="hidden" class="investmentID" value='<?php echo ($datarow[$i]['investmentID']); ?>'></input>
                                                <td class="investName"><?php echo ($datarow[$i]['investmentName']); ?></td>
                                                <td class="investType"><?php echo ($datarow[$i]['investmentType']); ?></td>
                                                <td class="investAmount"><?php echo ($datarow[$i]['amountInvested']); ?></td>
                                                <td class="investRate"><?php echo ($datarow[$i]['startDate']); ?></td>
                                            </tr>
                                    <?php
                                        }
                                    } ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>

            <h4>LIABILITIES SUMMARY</h4>
            <hr>

            <div class="container-fluid row chart">
                <!-- pie chart -->
                <input type="hidden" id="amountsOfInvestments" name="amountsOfInvestments" value='<?php echo ($customer->getTypeAmountsJSON()); ?>'></input>
                <input type="hidden" id="typesOfInvestments" name="typesOfInvestments" value='<?php echo ($customer->getInvestTypesJSON()); ?>'></input>
                <div class="col-6 horizontal-chart" id="liabilityTypes-donut-chart"></div>
                <!-- pie chart -->
                <input type="hidden" id="amountsOfInvestmentByName" name="amountsOfInvestmentByName" value='<?php echo ($customer->getNameAmountsJSON()); ?>'>
                <input type="hidden" id="nameOfInvestment" name="nameOfInvestment" value='<?php echo ($customer->getInvestNameJSON()); ?>'>
                <div class="col-6 donut-chart" id="liabilityNames-donut-chart"></div>
            </div>

            <h4>ALL LIABILITIES</h4>
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
                            <h5 class="modal-title" id="new-title">New Liability</h5>
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
                                        <input class="col-6 form-amountInvested" type="number" step='0.01' id="new_amountInvested" name="new_amountInvested" required disabled/>
                                        <label class="error" for="new_amountInvested">Please enter a valid amount</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Each Payment:</label>
                                        <input class="col-6 form-amountInvested" type="number" step='0.01' id="new_amountInvested" name="new_amountInvested" required disabled/>
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
                            <h5 class="modal-title" id="edit-title">Edit Liability</h5>
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
                                        <input class="col-6 form-amountInvested" type="number" step='0.01' id="edit_amountInvested" name="edit_amountInvested" required disabled/>
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
                            <p>Are you sure want to Delete this liability?</p>
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
                        <th scope="col">AMOUNT EACH PAYMENT</th>
                        <th scope="col">TIME NEEDED</th>
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
                                <td class="investName"><?php echo ($datarow[$i]['investmentName']); ?></td>
                                <td class="investType"><?php echo ($datarow[$i]['investmentType']); ?></td>
                                <td class="investAmount"><?php echo ($datarow[$i]['amountInvested']); ?></td>
                                <td class="investAmount"><?php echo ($datarow[$i]['amountInvested']); ?></td>
                                <td class="investAmount"><?php echo ($datarow[$i]['amountInvested']); ?></td>
                                <td class="investAmount"><?php echo ($datarow[$i]['amountInvested']); ?></td>
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
<script>

$(document).ready(function () {
  $("body").niceScroll();
});

var pieOptions = {
        series: [400.00, 350.00, 150.00, 50.00],
        chart: {
            width: 650,
            type: 'pie',
        },
        labels: ['Food', 'Transportation', 'Fashion', 'Others'],
        theme: {
            monochrome: {
                enabled: true,
                color: '#F89542',
                shadeIntensity: 0.65
            }
        },
    };

    var pieChart = new ApexCharts(document.querySelector("#pie-chart"), pieOptions);
    pieChart.render();

var donutOptions = {
  series: amountJSON,
  labels: typeJSON,
  chart: {
    type: "donut",
  },
  title: {
    text: "Liabilities by Category",
    align: "center",
    margin: 15,
    offsetX: -60,
    floating: true,
    style: {
      fontSize: "22px",
      fontWeight: "bold",
      fontFamily: "Helvetica, Arial, sans-serif",
      color: "#373d3f",
    },
  },
  plotOptions: {
    pie: {
      expandOnClick: false,
      customScale: 0.85,
      donut: {
        background: "transparent",
        size: "55%",
        labels: {
          show: true,
          total: {
            show: true,
            showAlways: false,
            label: "Total",
            fontSize: "22px",
            fontFamily: "Helvetica, Arial, sans-serif",
            fontWeight: 600,
            color: "#373d3f",
            formatter: function (w) {
              return w.globals.seriesTotals.reduce((a, b) => {
                return a + b;
              }, 0);
            },
          },
        },
      },
    },
  },
  noData: {
    text: "Loading...",
  },
  responsive: [
    {
      breakpoint: 480,
      options: {
        chart: {
          width: 400,
        },
        legend: {
          position: "bottom",
        },
      },
    },
  ],
  colors: [
    "#D08F78",
    "#F89542",
    "#FFB07C",
    "#f68a32",

    "#b27b56",

    "#db5f43",
    "#963727",
    "#511d28",

    "#263A4A",
    "#45465B",
    "#C5D3A9",
    "#B0CA3C",
    "#917580",
  ],
};

var investmentTypes_donutChart = new ApexCharts(
  document.querySelector("#liabilityTypes-donut-chart"),
  donutOptions
);
investmentTypes_donutChart.render();

var investmentName = $("#nameOfInvestment").val();
var investmentNameAmount = $("#amountsOfInvestmentByName").val();
var nameJSON = JSON.parse(investmentName);
var nameAmountJSON = JSON.parse([investmentNameAmount]);

var donutOptions = {
  series: nameAmountJSON,
  labels: nameJSON,
  chart: {
    type: "donut",
  },
  title: {
    text: "Liabilities by Name",
    align: "center",
    margin: 15,
    offsetX: -45,
    floating: true,
    style: {
      fontSize: "22px",
      fontWeight: "bold",
      fontFamily: "Helvetica, Arial, sans-serif",
      color: "#373d3f",
    },
  },
  plotOptions: {
    pie: {
      expandOnClick: false,
      customScale: 0.85,
      donut: {
        background: "transparent",
        size: "55%",
        labels: {
          show: true,
          total: {
            show: true,
            showAlways: false,
            label: "Highest Amount",
            fontSize: "22px",
            fontFamily: "Helvetica, Arial, sans-serif",
            fontWeight: 600,
            color: "#373d3f",
            formatter: function (w) {
              return w.globals.seriesTotals.reduce((a, b) => {
                if (a > b) {
                  return a;
                } else {
                  return b;
                }
              }, 0);
            },
          },
        },
      },
    },
  },
  responsive: [
    {
      breakpoint: 480,
      options: {
        chart: {
          width: 400,
        },
        legend: {
          position: "bottom",
        },
      },
    },
  ],
  colors: [
    "#FFB07C",
    "#b27b56",
    "#D08F78",
    "#F89542",
    "#f68a32",
    "#db5f43",
    "#963727",
    "#511d28",

    "#263A4A",
    "#45465B",
    "#C5D3A9",
    "#B0CA3C",
    "#917580",
  ],
};

var donutChart = new ApexCharts(
  document.querySelector("#liabilityNames-donut-chart"),
  donutOptions
);
donutChart.render();

</script>

</html>