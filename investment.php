<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!-- <script src="./jquery_src/jquery.nicescroll-3.7.4/jquery.nicescroll.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nerko+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style/investment.css">
    <title>PocketMoney | Investment</title>
</head>
<body>
    <div class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a href="#" class="navbar-brand"><img src="./img/logo_i.png" width="50px" height="50px"> POCKETMONEY</a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Transactions</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Budgets</a>
                </li>
                <li class="nav-item active">
                    <a href="#" class="nav-link">Investments</a>
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
                        <a href="#" class="dropdown-item">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
    </div>

    <div class="container-fluid background">
        <div class="container-fluid body">
            <nav class="navbar navbar-expand-lg">
                <a href="#" class="navbar-brand">INVESTMENT</a>
            </nav>
    
            <div class="container-fluid row overall">
                <div>
                    <h5>Portfolio Value</h5>
                    <p>RM150,000.00</p>
                </div>
                <div>
                    <h5>Top Holding</h5>
                    <p>Company ABC</p>
                </div>
                <div>
                    <h5>Total Holdings</h5>
                    <p>3</p>
                </div>
            </div>
    
            <div class="container-fluid row chart">
                <!-- horizontal bar chart -->
                <div class="col-7 horizontal-chart" id="horizontal-chart"></div>
                <!-- pie chart -->
                <div class="col-5 donut-chart" id="donut-chart"></div>
            </div>
    
            <!-- table -->
            <table class="table table-bordered table-hover institution-table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">AS OF</th>
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
                    <td>2020-12-12</td>
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
                    <td>2020-12-12</td>
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
                    <td>2020-12-12</td>
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
    
            <h4>INVESTMENT TRANSACTIONS</h2>
            <hr>
    
            <div class="container-fluid row">
                <div>
                    <h5>INSTITUTION:</h5>
                    <select name="" id="" class="custom-select">
                        <option value="">ALL</option>
                        <option value=""></option>
                    </select>
                </div>
    
                <div>
                    <h5>TIME PERIOD:</h5>
                    <select name="" id="" class="custom-select">
                        <option value="">Last 3 Months</option>
                        <option value=""></option>
                    </select>
                </div>
            </div>
    
            <div class="container-fluid row">
                <div>
                    <h5>Show:</h5>
                    <select name="" id="" class="custom-select">
                        <option value="">50</option>
                        <option value=""></option>
                    </select>
                    <h5>entries</h5>
                </div>
    
                <div>
                    <h5>Search:</h5>
                    <input type="text" name="" id="">
                </div>
            </div>
    
            <!-- table -->
    
            <div class="container-fluid row">
                <div>
                    <h5>Showing 1 to 7 of 7 entries</h5>
                </div>
    
                <!-- popigation -->
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
            height: 300,
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
                barHeight: '55%'
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
</script>
</html>