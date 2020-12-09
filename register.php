<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nerko+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style/register.css">
    <title>PocketMoney | Register</title>
</head>
<body>
    <div class="container row">
        <div class="left">
            <img src="./img/login.png">
        </div>
        <!-- First page -->
        <div class="right step1" >
            <a href="#" class="logo"><img src="./img/logo.png" width="50px" height="50px"> POCKETMONEY</a>
            <h5>Step 1: Create your personal account</h5>
            <form action="" method="post">
                <div class="form-group">
                    <input type="text" name="name" placeholder="Enter real full name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Enter email address" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="password" name="passwordConf" placeholder="Re-enter password" required>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="showPass" id="showPass">
                    <label for="showPass" class="form-check-label">Show Password</label>
                </div>
                <button type="submit" class="btn">Next</button>
            </form>
        </div>

        <!-- Second page -->
        <div class="right step2" hidden>
            <a href="#" class="logo"><img src="./img/logo.png" width="50px" height="50px"> POCKETMONEY</a>
            <h5>Step 2: Set up your asset information</h5>
            <form action="" method="post">
                <div class="form-group">
                    <input type="number" name="cashAmount" placeholder="Enter Total Cash in Hand">
                </div>
                <div class="form-group">
                    <input type="number" name="savingAmount" placeholder="Enter Total Savings in Banks">
                </div>
                <h5>Income Information</h5>
                <small>You can record more than one upon successful registration.</small>
                <div class="form-group">
                    <input type="number" name="income" placeholder="Enter Income Name">
                </div>
                <div class="form-group">
                    <input type="number" name="" id="" placeholder="Monthly Income Amount">
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <select name="" id="" class="custom-select">
                            <option value="">Select income category</option>
                            <option value="">Salary</option>
                            <option value="">Sales</option>
                            <option value="">Rental</option>
                            <option value="">Others</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <input type="date" name="" id="" class="custom-select" placeholder="Received Date">
                    </div>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="automate" id="autoIncome">
                    <label for="autoIncome" class="form-check-label">Auto-Record</label>
                </div>
                <button type="submit" class="btn">Next</button>
            </form>
        </div>

        <!-- Third page -->
        <div class="right step3" hidden>
            <a href="#" class="logo"><img src="./img/logo.png" width="50px" height="50px"> POCKETMONEY</a>
            <h5>Step 3: Set up your debt information</h5>
            <small>You can record more than one upon successful registration.</small>
            <form action="" method="post">
                <div class="form-group">
                    <input type="name" name="debtAmount" placeholder="Enter Debt Name">
                </div>
                <div class="form-group">
                    <input type="name" name="debtAmount" placeholder="Enter Debt Description">
                </div>
                <div class="form-group">
                    <input type="number" name="savingAmount" placeholder="Enter Debt Amount">
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <select name="" class="custom-select" id="">
                            <option value="">Payment type</option>
                            <option value="">Month</option>
                            <option value="">Year</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <input type="date" name="" id="" class="custom-select" placeholder="Payment Date">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <select name="month" class="custom-select">
                            <option selected>Select End Month</option>
                            <option value="1">January</option>
                            <option value="2">Febuary</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <select name="year" class="custom-select">
                            <option selected>Select End Year</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn">Next</button>
            </form>
        </div>

        <!-- Last page -->
        <div class="right step4" hidden>
            <a href="#" class="logo"><img src="./img/logo.png" width="50px" height="50px"> POCKETMONEY</a>
            <h5>Step 4: Set up your financial goal</h5>
            <small>You can record more than one upon successful registration.</small>
            <form action="" method="post">
                <div class="form-group">
                    <input type="text" name="goalName" placeholder="Financial Goal Name" required>
                </div>
                <div class="form-group">
                    <input type="text" name="goalDes" placeholder="Financial Goal Description" required>
                </div>
                <div class="form-group">
                    <select name="" id="" class="custom-select">
                        <option value="">Goal Type</option>
                        <option value="">Short-Term Goals</option>
                        <option value="">Middle-Term Goals</option>
                        <option value="">Long-Term Goals</option>
                    </select>
                </div>
                <!-- For Short -->
                <div class="" >
                    <div class="form-group">
                        <input type="number" name="goalAmount" placeholder="Goal Amount">
                    </div>
                    <div class="form-row">
                        <div class="col-6">
                            <select name="month" class="custom-select">
                                <option selected>Select Start Month</option>
                                <option value="1">January</option>
                                <option value="2">Febuary</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <select name="year" class="custom-select">
                                <option selected>Select Start Year</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <select name="month" class="custom-select">
                            <option selected>Select Tenure (Months)</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                        </select>
                    </div>
                </div>
                
                <!-- For Middle -->
                <div class="" hidden>
                    <div class="form-group">
                        <input type="number" name="goalAmount" placeholder="Goal Amount">
                    </div>
                    <div class="form-row">
                        <div class="col-6">
                            <select name="month" class="custom-select">
                                <option selected>Select Start Month</option>
                                <option value="1">January</option>
                                <option value="2">Febuary</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <select name="year" class="custom-select">
                                <option selected>Select Start Year</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-6">
                            <select name="month" class="custom-select">
                                <option selected>Select End Month</option>
                                <option value="1">January</option>
                                <option value="2">Febuary</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <select name="year" class="custom-select">
                                <option selected>Select End Year</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- For Long -->
                <div hidden>
                    <div class="form-group">
                        <input type="number" name="goalAmount" placeholder="Goal Amount Invested per Year">
                    </div>
                    <div class="form-group">
                        <select name="year" class="custom-select">
                            <option selected>Select End Year</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="showPass" class="form-check-label">Monthly Deposit</label>
                    <br>
                    <sup>MYR</sup><strong class="amountBefore"> 0.<sup class="amountAfter">00</sup></strong>
                </div>
                <button type="submit" class="btn">Sign Up</button>
            </form>
        </div>
    </div>
</body>
</html>