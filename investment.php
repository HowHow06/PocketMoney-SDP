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
    <title>PocketMoney | Investment</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a href="#" class="navbar-brand"><img src="./img/logo_i.png" width="50px" height="50px"> POCKETMONEY</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
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
            <li class="nav-item active">
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
    
            <div class="container-fluid row filter2">
                <div class="col-6 row show">
                    <h6>Show:</h6>
                    <select name="" id="" class="custom-select">
                        <option value="">50</option>
                        <option value=""></option>
                    </select>
                    <h6>entries</h6>
                </div>
    
                <div class="col-6 search">
                    <input type="text" name="" id="">
                    <h6>Search:</h6>
                </div>
            </div>
    
            <!-- table -->
            <table class="table table-bordered table-hover transaction-table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">DATE</th>
                    <th scope="col">AMOUNT</th>
                    <th scope="col">DESCRIPTION</th>
                    <th scope="col">CATEGORY</th>
                    <th scope="col">INSTITUTION</th>
                    <th scope="col">TYPE</th>
                    <th scope="col">ACTION</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>2020-12-12</td>
                    <td>350.00</td>
                    <td>Service Tax</td>
                    <td>Tax</td>
                    <td>Company ABC</td>
                    <td>Crefit</td>
                    <td class="action">
                        <a href="#" class="edit" data-toggle="modal" data-target="#edit-row1">Edit</a>
                        <a href="#" class="delete" data-toggle="modal" data-target="#delete-row1">Delete</a>
                    </td>

                    <!-- edit-row1 modal -->
                    <div class="modal fade edit-modal" id="edit-row1" tabindex="-1" role="dialog" aria-labelledby="edit-title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="edit-title">Edit Transaction</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <div class="form-group row">
                                            <label class="col-4" for="">Date:</label>
                                            <input class="col-6" type="date" value="2020-12-12">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="">Insititution:</label>
                                            <input class="col-6" type="text" value="Company ABC" disabled>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="">Amount:</label>
                                            <input class="col-6" type="text" value="350.00">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="">Description:</label>
                                            <input class="col-6" type="text" value="Service Tax">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="">Category:</label>
                                            <select class="col-6" class="custom-select" id="category">
                                                <option value="">Tax</option>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="">Type:</label>
                                            <select class="col-6" class="custom-select" id="type">
                                                <option value="">Credit</option>
                                                <option value="">Debit</option>
                                            </select>
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

                    <!-- delete-row1 modal -->
                    <div class="modal fade edit-modal" id="delete-row1" tabindex="-1" role="dialog" aria-labelledby="edit-title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <p>Are you sure want to Delete this transaction?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary">Delete</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>2020-12-02</td>
                    <td>410.30</td>
                    <td>Dividence</td>
                    <td>Bonus</td>
                    <td>Company ABC</td>
                    <td>Debit</td>
                    <td class="action">
                        <a href="#" class="edit" data-toggle="modal" data-target="#edit-row2">Edit</a>
                        <a href="#" class="delete" data-toggle="modal" data-target="#delete-row2">Delete</a>
                    </td>

                    <!-- edit-row2 modal -->
                    <div class="modal fade edit-modal" id="edit-row2" tabindex="-1" role="dialog" aria-labelledby="edit-title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="edit-title">Edit Transaction</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <div class="form-group row">
                                            <label class="col-4" for="">Date:</label>
                                            <input class="col-6" type="date" value="2020-12-12">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="">Insititution:</label>
                                            <input class="col-6" type="text" value="Company ABC" disabled>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="">Amount:</label>
                                            <input class="col-6" type="text" value="350.00">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="">Description:</label>
                                            <input class="col-6" type="text" value="Service Tax">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="">Category:</label>
                                            <select class="col-6" class="custom-select" id="category">
                                                <option value="">Tax</option>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="">Type:</label>
                                            <select class="col-6" class="custom-select" id="type">
                                                <option value="">Credit</option>
                                                <option value="">Debit</option>
                                            </select>
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

                    <!-- delete-row2 modal -->
                    <div class="modal fade edit-modal" id="delete-row2" tabindex="-1" role="dialog" aria-labelledby="edit-title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <p>Are you sure want to Delete this transaction?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary">Delete</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>2020-11-30</td>
                    <td>10.10</td>
                    <td>Stock Price</td>
                    <td>Investment</td>
                    <td>Samsung</td>
                    <td>Debit</td>
                    <td class="action">
                        <a href="#" class="edit" data-toggle="modal" data-target="#edit-row3">Edit</a>
                        <a href="#" class="delete" data-toggle="modal" data-target="#delete-row3">Delete</a>
                    </td>

                    <!-- edit-row2 modal -->
                    <div class="modal fade edit-modal" id="edit-row3" tabindex="-1" role="dialog" aria-labelledby="edit-title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="edit-title">Edit Transaction</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <div class="form-group row">
                                            <label class="col-4" for="">Date:</label>
                                            <input class="col-6" type="date" value="2020-12-12">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="">Insititution:</label>
                                            <input class="col-6" type="text" value="Company ABC" disabled>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="">Amount:</label>
                                            <input class="col-6" type="text" value="350.00">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="">Description:</label>
                                            <input class="col-6" type="text" value="Service Tax">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="">Category:</label>
                                            <select class="col-6" class="custom-select" id="category">
                                                <option value="">Tax</option>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="">Type:</label>
                                            <select class="col-6" class="custom-select" id="type">
                                                <option value="">Credit</option>
                                                <option value="">Debit</option>
                                            </select>
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

                    <!-- delete-row2 modal -->
                    <div class="modal fade edit-modal" id="delete-row3" tabindex="-1" role="dialog" aria-labelledby="edit-title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <p>Are you sure want to Delete this transaction?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary">Delete</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                  </tr>
                </tbody>
            </table>
    
            <div class="container-fluid row filter3">
                <div class="show col-6">
                    <h6>Showing 1 to 3 of 3 entries</h6>
                </div>
    
                <!-- Pagination -->
                <nav class="col-6">
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

    $(document).ready(function() {
        $("body").niceScroll();
    });
</script>
</html>