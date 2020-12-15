<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="./jquery/jquery.nicescroll-3.7.4/jquery.nicescroll.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nerko+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style/dashboard.css">
    <title>PockeyMoney | Dashboard</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a href="#" class="navbar-brand"><img src="./img/logo_i.png" width="50px" height="50px"> POCKETMONEY</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a href="dashboard.php" class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown">Transactions</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a href="income_trans.php" class="dropdown-item">Income Summary</a>
                    <a href="#" class="dropdown-item">Expenses Summary</a>
                </div>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Budgets</a>
            </li>
            <li class="nav-item">
                <a href="investment.php" class="nav-link">Investments</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Debts</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Financial Goals</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Reports</a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown">Setting</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a href="#" class="dropdown-item">Profile</a>
                    <a href="#" class="dropdown-item">Enquiry</a>
                    <a href="index.html" class="dropdown-item">Logout</a>
                </div>
            </li>
        </ul>
    </nav>

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
            categories: ['Company ABC', 'Apple', 'Samsung'
        ]}
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