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
    ?>

    <div class="container-fluid background">
        <div class="container-fluid body">
            <nav class="navbar navbar-expand-lg">
                <a href="#" class="navbar-brand">BUDGETS</a>
            </nav>
            <div class="container-fluid row">
                <div class="col-6 left">
                    <form action="" method="post">
                        <div class="row">
                            <button class="btn">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <h6>Dec 2020</h6>
                            <button class="btn">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

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
                        <hr>
                    </div>
                </div>
            </div>
            
            <div class="container-fluid budget-manage">
                <div class="container-fluid rounded border">
                    <div class="col-12">
                        <h4>MANAGE BUDGET</h4>
                    </div>
                    <div class="row">
                        <div class="col-5 pie-chart">
                            <div id="pie-chart">
                            </div>
                        </div>
                        <div class="col-7 chart-explain">
                            <div>
                                <div class="container-fluid row category">
                                    <div class="col-1">
                                        <p id="category1">100%</p>
                                    </div>
                                    <div class="col-5">
                                        <h5>Total Budget</h5>
                                    </div>
                                    <div class="col-3 value">
                                        <h5>RM 1000.00</h5>
                                    </div>
                                    <div class="col-3 action row">
                                        <a href="#" class="edit-investment-anchor" data-toggle="modal" data-target="#edit-row">Edit</a>
                                        <div class="vl"></div>
                                        <a href="#" class="delete-investment-anchor" data-toggle="modal" data-target="#delete-row">Delete</a>
                                    </div>
                                </div>

                                <div class="container-fluid row category">
                                    <div class="col-1">
                                        <p id="category2">42%</p>
                                    </div>
                                    <div class="col-5">
                                        <h5>Food</h5>
                                    </div>
                                    <div class="col-3 value">
                                        <h5>RM 400.00</h5>
                                    </div>
                                    <div class="col-3 action row">
                                        <a href="#" class="edit-investment-anchor" data-toggle="modal" data-target="#edit-row">Edit</a>
                                        <div class="vl"></div>
                                        <a href="#" class="delete-investment-anchor" data-toggle="modal" data-target="#delete-row">Delete</a>
                                    </div>
                                </div>

                                <div class="container-fluid row category">
                                    <div class="col-1">
                                        <p id="category3">37%</p>
                                    </div>
                                    <div class="col-5">
                                        <h5>Transportation</h5>
                                    </div>
                                    <div class="col-3 value">
                                        <h5>RM 350.00</h5>
                                    </div>
                                    <div class="col-3 action row">
                                        <a href="#" class="edit-investment-anchor" data-toggle="modal" data-target="#edit-row">Edit</a>
                                        <div class="vl"></div>
                                        <a href="#" class="delete-investment-anchor" data-toggle="modal" data-target="#delete-row">Delete</a>
                                    </div>
                                </div>

                                <div class="container-fluid row category">
                                    <div class="col-1">
                                        <p id="category4">5%</p>
                                    </div>
                                    <div class="col-5">
                                        <h5>Others</h5>
                                    </div>
                                    <div class="col-3 value">
                                        <h5>RM 50.00</h5>
                                    </div>
                                    <div class="col-3 action row">
                                        <a href="#" class="edit-investment-anchor" data-toggle="modal" data-target="#edit-row">Edit</a>
                                        <div class="vl"></div>
                                        <a href="#" class="delete-investment-anchor" data-toggle="modal" data-target="#delete-row">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-circle btn-xl" data-toggle="modal" data-target="#new-row">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <h4>ALL EXPENSES TRANSACTIONS</h4>
            <hr>

            <div class="container-fluid filter">
                <div class="col-3">
                    <div class="row">
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
                    
                </div>
            </div>

            <div class="container-fluid row filter2">
                <div class="col-6 show">
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
                    <input type="text" name="" id="search-transaction" placeholder="  Expenses Name">
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
</body>
<script>
    $(document).ready(function () {
        $("body").niceScroll();
    });

    $('[data-toggle="vl-hover"]').popover({
      html: true,
      trigger: 'hover',
      placement: 'top',
      content: function () { return $(this).data('text'); }
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
</script>
</html>