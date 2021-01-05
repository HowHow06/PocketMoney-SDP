<?php 

include('checkSessionCookie.php'); 

// changing active navbar link according to page
$isActiveDashboard = "";
$isActiveTransactions = "";
$isActiveBudgets = "";
$isActiveInvestments = "";
$isActiveDebts = "";
$isActiveFinancialGoals = "";
$isActiveReports = "";

switch ($activePage) {
    case "dashboard":
        $isActiveDashboard = "active";
        break;
    case "transactions":
        $isActiveTransactions = "active";
        break;
    case "budgets":
        $isActiveBudgets = "active";
        break;
    case "investments":
        $isActiveInvestments = "active";
        break;
    case "debts":
        $isActiveDebts = "active";
        break;
    case "financialgoals":
        $isActiveFinancialGoals = "active";
        break;
    case "reports":
        $isActiveReports = "active";
        break;
}

?>

<nav class="navbar navbar-expand-lg navbar-light">
    <a href="#" class="navbar-brand"><img src="./img/logo_i.png" width="50px" height="50px"> POCKETMONEY</a>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item <?php echo $isActiveDashboard; ?>">
            <a href="dashboard.php" class="nav-link">Dashboard</a>
        </li>
        <li class="nav-item <?php echo $isActiveTransactions ?> dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown">Transactions</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a href="income_trans.php" class="dropdown-item">Income Summary</a>
                <a href="expense_trans.php" class="dropdown-item">Expenses Summary</a>
            </div>
        </li>
        <li class="nav-item <?php echo $isActiveBudgets ?> ">
            <a href="budget.php" class="nav-link">Budgets</a>
        </li>
        <li class="nav-item <?php echo $isActiveInvestments ?> ">
            <a href="investment.php" class="nav-link">Investments</a>
        </li>
        <li class="nav-item <?php echo $isActiveDebts ?> ">
            <a href="#" class="nav-link">Debts</a>
        </li>
        <li class="nav-item <?php echo $isActiveFinancialGoals ?> ">
            <a href="#" class="nav-link">Financial Goals</a>
        </li>
        <li class="nav-item <?php echo $isActiveReports ?> ">
            <a href="#" class="nav-link">Reports</a>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown">Setting</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a href="#" class="dropdown-item">Profile</a>
                <a href="#" class="dropdown-item">Enquiry</a>
                <a href="logout.php" class="dropdown-item">Logout</a>
            </div>
        </li>
    </ul>
    <input type="hidden" id="cusID" value="<?php echo ($customer->getId()); ?>"></input>
</nav>