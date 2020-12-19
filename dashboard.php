<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(".head.php"); ?>
    <link rel="stylesheet" href="./style/dashboard.css">
    <title>PockeyMoney | Dashboard</title>
</head>

<body>
    <?php include(".navbar.php"); ?>

    <div class="container-fluid background">
        <div class="col-6 left-body">
            <div class="container-fluid body">
                <nav class="navbar navbar-expand-lg">
                    <a href="#" class="navbar-brand">RECENT TRANSACTIONS</a>
                </nav>

            </div>

            <div class="container-fluid body">
                <nav class="navbar navbar-expand-lg">
                    <a href="#" class="navbar-brand">BUDGETS</a>
                </nav>

            </div>

            <div class="container-fluid body">
                <nav class="navbar navbar-expand-lg">
                    <a href="#" class="navbar-brand">DEBTS</a>
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
                    <a href="#" class="navbar-brand">INVESTMENT</a>
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