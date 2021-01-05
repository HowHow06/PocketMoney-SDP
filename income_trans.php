<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(".head.php"); ?>
    <link rel="stylesheet" href="./style/income_trans.css">

    <title>PocketMoney | Transactions</title>
</head>
<body>
    <?php 
    $activePage = "transactions"; 
    include(".navbar.php"); 
    ?>

    <div class="container-fluid background">
        <div class="container-fluid body">
            <nav class="navbar navbar-expand-lg">
                <a href="#" class="navbar-brand">INCOME TRANSACTIONS</a>
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
                <div class="col-6 right">
                    <form action="">
                        <div class="row">
                            <h6>Show:</h6>
                            <select name="" id="" class="custom-select">
                                <option value="">Monthly</option>
                                <option value="">Year</option>
                            </select>
                        </div>
                    </form>

                </div>
            </div>

            <div class="container-fluid row">
                <div class="pie-chart">
                    <div class="border rounded" id="pie-chart">
                    </div>
                </div>
                <div class="chart-explain">
                    <div class="border rounded">
                        <div class="container-fluid row category">
                            <div class="col-1">
                                <p id="category1">49%</p>
                            </div>
                            <div class="col-5">
                                <h5>Salary</h5>
                            </div>
                            <div class="col-5 value">
                                <h5>RM 1200.00</h5>
                            </div>
                            <div class="col-1 show">
                                <button class="btn">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>

                        <div class="container-fluid row category">
                            <div class="col-1">
                                <p id="category2">12%</p>
                            </div>
                            <div class="col-5">
                                <h5>Bonus</h5>
                            </div>
                            <div class="col-5 value">
                                <h5>RM 300.00</h5>
                            </div>
                            <div class="col-1 show">
                                <button class="btn">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>

                        <div class="container-fluid row category">
                            <div class="col-1">
                                <p id="category3">21%</p>
                            </div>
                            <div class="col-5">
                                <h5>Savings</h5>
                            </div>
                            <div class="col-5 value">
                                <h5>RM 500.00</h5>
                            </div>
                            <div class="col-1 show">
                                <button class="btn">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>

                        <div class="container-fluid row category">
                            <div class="col-1">
                                <p id="category4">18%</p>
                            </div>
                            <div class="col-5">
                                <h5>Sales</h5>
                            </div>
                            <div class="col-5 value">
                                <h5>RM 432.60</h5>
                            </div>
                            <div class="col-1 show">
                                <button class="btn">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid category">
                <div class="border round">
                    <div class="container-fluid title">
                        <h2>SALARY</h2>
                        <h5>Total: 1200.00</h5>
                        <h5>Average Daily: 40.00</h5>
                    </div>
                    <div class="line-chart">
                        <div id="line-chart">
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
                        <th scope="col">DESCRIPTION</th>
                        <th scope="col">TYPE</th>
                        <th scope="col">ACTION</th>
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
                                <th scope="row"><?php echo (($i + 1)); ?></th>
                                <td class="investDate"><?php echo ($datarow[$i]['startDate']); ?></td>
                                <td class="investAmount"><?php echo ($datarow[$i]['amountInvested']); ?></td>
                                <td class="investName"><?php echo ($datarow[$i]['investmentName']); ?></td>
                                <td class="investRate"><?php echo ($datarow[$i]['ratePerAnnum']); ?></td>
                                <td class="investType"><?php echo ($datarow[$i]['investmentType']); ?></td>
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

            <h4>ALL TRANSACTIONS</h4>
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
                                        <label class="col-5" for="">Date:</label>
                                        <input class="col-6 form-startDate" type="date" id="new_startDate" name="new_startDate" required />
                                        <label class="error" for="new_startDate">Please enter a valid date</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="">Type:</label>
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
                                        <label class="error" for="new_investmentType">Please enter a valid type</label>
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
                                        <label class="col-5" for="">Description:</label>
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
                                        <label class="error" for="new_investmentName">Please enter a valid description</label>
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
                                        <label class="col-5" for="">Type:</label>
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
                                        <label class="error" for="edit_investmentType">Please enter a valid type</label>
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
                                        <label class="col-5" for="">Description:</label>
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
                                        <label class="error" for="edit_investmentName">Please enter a valid description</label>
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
                        <th scope="col">CATEGORY</th>
                        <th scope="col">NAME</th>
                        <th scope="col">DESCRIPTION</th>
                        <th scope="col">TYPE</th>
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
                                <td class="investType"><?php echo ($datarow[$i]['investmentType']); ?></td>
                                <td class="investName"><?php echo ($datarow[$i]['investmentName']); ?></td>
                                <td class="investRate"><?php echo ($datarow[$i]['ratePerAnnum']); ?></td>
                                <td class="investType"><?php echo ($datarow[$i]['investmentType']); ?></td>
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
<script>
    $(document).ready(function () {
        $("body").niceScroll();
    });

    var pieOptions = {
        series: [1200.00, 300.00, 500.00, 432.60],
        chart: {
            width: 550,
            type: 'pie',
        },
        labels: ['Salary', 'Bonus', 'Savings', 'Sales'],
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

    var lineOptions = {
        series: [{
            name: "Salary",
            data: [1100.00, 1030.00, 950.00, 2000.00, 1250.00, 1200.00, 1000.00, 1200.00, 0.00, 0.00]
        }],
        chart: {
            height: 400,
            type: 'line',
            dropShadow: {
                enabled: true,
                color: '#000',
                top: 18,
                left: 7,
                blur: 10,
                opacity: 0.2
            }
        },
        dataLabels: {
            enabled: true
        },
        stroke: {
            curve: 'straight',
            width: 1
        },
        colors: ['#F89542'],
        grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
            },
        },
        xaxis: {
            max: 7,
            categories: ['May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb'],
        },
        yaxis: {
            min: function(min) {
                return min - 100
            },
            max: function(max) {
                return max + 100
            }
        }
    };

    var lineChart = new ApexCharts(document.querySelector("#line-chart"), lineOptions);
    lineChart.render();
</script>

</html>