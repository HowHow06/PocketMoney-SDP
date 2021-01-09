<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(".head.php"); ?>
    <link rel="stylesheet" href="./style/dashboard.css">
    <title>PockeyMoney | Dashboard</title>
</head>

<body>
    <?php 
    $activePage = "dashboard";
    include(".navbar.php")
    ?>
    
    <div class="container-fluid background">
        <div class="col-6 left-body">
            <div class="container-fluid body transaction">
                <nav class="navbar navbar-expand-lg">
                    <a href="#" class="navbar-brand">RECENT TRANSACTIONS</a>
                </nav>
                <!-- table -->
                <table class="table table-bordered table-hover transaction-table table-sm" id="investmentTransactionTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">DATE</th>
                            <th scope="col">AMOUNT</th>
                            <th scope="col">CATEGORY</th>
                            <th scope="col">NAME</th>
                            <th scope="col">DESCRIPTION</th>
                            <th scope="col">TYPE</th>
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
                                    <td class="investType"><?php echo ($datarow[$i]['investmentType']); ?></td>
                                    <td class="investName"><?php echo ($datarow[$i]['investmentName']); ?></td>
                                    <td class="investRate"><?php echo ($datarow[$i]['ratePerAnnum']); ?></td>
                                    <td class="investType"><?php echo ($datarow[$i]['investmentType']); ?></td>
                                </tr>
                        <?php
                            }
                        } ?>
                    </tbody>
                </table>
                <br>
            </div>

            <div class="container-fluid body budget">
                <nav class="navbar navbar-expand-lg">
                    <a href="#" class="navbar-brand">BUDGETS</a>
                </nav>
                <div class="container-fluid budget-overview">
                    <div class="budget-row">
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
                        <hr>
                    </div>
                </div>
            </div>

            <div class="container-fluid body liability">
                <nav class="navbar navbar-expand-lg">
                    <a href="#" class="navbar-brand">LIABILITIES</a>
                </nav>

            </div>
        </div>

        <div class="col-6 right-body">
            <div class="container-fluid body snapshot">
                <nav class="navbar navbar-expand-lg">
                    <a href="#" class="navbar-brand">SNAPSHOT</a>
                </nav>
                <div class="container-fluid row">
                    <div>
                        <h5>Expenses</h5>
                        <p>RM50,000.00</p>
                    </div>
                    <div>
                        <h5>Income</h5>
                        <p>RM3,000.00</p>
                    </div>
                    <div>
                        <h5>Net Flow</h5>
                        <p>-RM47,000.00</p>
                    </div>
                    <div>
                        <h5>Balance</h5>
                        <p>RM132,050.00</p>
                    </div>
                </div>
                <div class="container-fluid row">
                    <div>
                        <h5>Debts</h5>
                        <p>RM4,000.00</p>
                    </div>
                    <div>
                        <h5>Investments</h5>
                        <p>RM3,200.00</p>
                    </div>
                    <div>
                        <h5>Assets</h5>
                        <p>RM10,000.00</p>
                    </div>
                    <div>
                        <h5>Net Worth</h5>
                        <p>RM6,000.00</p>
                    </div>
                </div>
            </div>

            <div class="container-fluid body investment">
                <nav class="navbar navbar-expand-lg">
                    <a href="#" class="navbar-brand">INVESTMENTS</a>
                </nav>
                <div class="container-fluid row chart">
                    <!-- horizontal bar chart -->
                    <div class="col-7 horizontal-chart" id="horizontal-chart"></div>
                    <!-- pie chart -->
                    <div class="col-5 donut-chart" id="donut-chart"></div>
                </div>
                <table class="table table-bordered table-hover institution-table table-sm">
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
                <br>
            </div>

            <div class="container-fluid body">
                <nav class="navbar navbar-expand-lg">
                    <a href="#" class="navbar-brand">FINANCIAL GOALS</a>
                </nav>

            </div>
        </div>
    </div>
</body>
<script>
    var horizontalOptions = {
        series: [{
            name: 'Institution Invest Amount',
            data: [{
                x: 'Company ABC',
                y: 1350.00
            }, {
                x: 'Apple',
                y: 2032.00
            }, {
                x: 'Samsung',
                y: 320.10
            }]
        }],
        chart: {
            type: 'bar',
            height: 250,
            dropShadow: {
                enabled: true,
                top: 0,
                left: 0,
                blur: 2,
                opacity: 0.2
            }
        },
        plotOptions: {
            bar: {
                horizontal: true,
                barHeight: '40%'
            }
        },
        dataLabels: {
            enabled: true
        },
        theme: {
            monochrome: {
                enabled: true,
                color: '#F89542',
                shadeIntensity: 0.65
            }
        },
        xaxis: {
            categories: ['Company ABC', 'Apple', 'Samsung']
        }
    };

    var horizontalChart = new ApexCharts(document.querySelector("#horizontal-chart"), horizontalOptions);
    horizontalChart.render();

    var donutOptions = {
        series: [1350.00, 2032.00, 320.10],
        labels: ['Company ABC', 'Apple', 'Samsung'],
        chart: {
            type: 'donut',
        },
        plotOptions: {
            pie: {
                customScale: 0.85,
                donut: {
                    size: '55%'
                }
            }
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 400
                },
                legend: {
                    position: 'bottom'
                }
            }
        }],
        colors: ['#D08F78', '#F89542', '#FFB07C']
    };

    var donutChart = new ApexCharts(document.querySelector("#donut-chart"), donutOptions);
    donutChart.render();

    $(document).ready(function() {
        $("body").niceScroll();
    });
</script>

</html>