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
    <link rel="stylesheet" href="./style/investment.css">
    <title>PocketMoney | Transaction</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a href="#" class="navbar-brand"><img src="./img/logo_i.png" width="50px" height="50px"> POCKETMONEY</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item dropdown active">
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
        <div class="container-fluid body">
            <nav class="navbar navbar-expand-lg">
                <a href="#" class="navbar-brand">INCOME TRANSACTIONS</a>
            </nav>
            <div class="container-fluid row">
                <div clsas="col-6 row">
                    <button class="btn">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </button>
                    <h6>Dec</h6>
                    <button class="btn">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </button>
                </div>
                <div class="col-6 row">
                    <h6>Show:</h6>
                    <select name="" id="" class="custom-select">
                        <option value="">Monthly</option>
                        <option value="">Year</option>
                    </select>
                </div>
            </div>

            <div class="container-fluid row">
                <div class="container col-4 pie-chart" id="pie-chart">

                </div>
                <div class="container col-8 chart-explain">
                    <div class="container-fluid row category">
                        <div class="col-1">
                            <p>50%</p>
                        </div>
                        <div class="col-4">
                            <h5>Category 1</h5>
                        </div>
                        <div class="col-4">
                            <h5>RM 349.90</h5>
                        </div>
                        <div class="col-1">
                        <button class="btn">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    var pieOptions = {
          series: [44, 55, 13, 43, 22],
          chart: {
          width: 380,
          type: 'pie',
        },
        labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

    var pieChart = new ApexCharts(document.querySelector("#pie-chart"), pieOptions);
    pieChart.render();
</script>
</html>