<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(".head.php"); ?>
    <link rel="stylesheet" href="./style/income_trans.css">
    <title>PocketMoney | Transaction</title>
</head>

<body>
    <?php include(".navbar.php"); ?>

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
            <table class="table table-bordered table-hover transaction-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">DATE</th>
                        <th scope="col">AMOUNT</th>
                        <th scope="col">DESCRIPTION</th>
                        <th scope="col">ACCOUNT</th>
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

            <h4>ALL TRANSACTIONS</h4>
            <hr>

            <div class="container-fluid row filter">
                <div>
                    <h5>TYPE:</h5>
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
                <div class="col row show">
                    <h6>Show:</h6>
                    <select name="" id="" class="custom-select">
                        <option value="">50</option>
                        <option value=""></option>
                    </select>
                    <h6>entries</h6>
                </div>

                <div class="col search">
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
                        <th scope="col">ACCOUNT</th>
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

    <button type="button" class="btn btn-circle btn-xl">
        <i class="fas fa-plus"></i>
    </button>
</body>
<script>
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