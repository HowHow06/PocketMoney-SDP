<?php

include('checkSessionCookie.php');

// changing active navbar link according to page
$isActiveDashboard = "";
$isActiveTransactions = "";
$isActiveBudgets = "";
$isActiveInvestments = "";
$isActiveLiabilities = "";
$isActiveFinancialGoals = "";
$isActiveReports = "";
$isActiveSetting = "";

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
    case "liabilities":
        $isActiveLiabilities = "active";
        break;
    case "financialgoals":
        $isActiveFinancialGoals = "active";
        break;
    case "reports":
        $isActiveReports = "active";
        break;
    case "settings":
        $isActiveReports = "active";
        break;
}

?>

<nav class="navbar navbar-expand-lg navbar-light">
    <a href="#" class="navbar-brand"><img src="./img/logo_i.png" width="50px" height="50px"> POCKETMONEY</a>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item <?php echo $isActiveDashboard; ?>">
            <a href="dashboard.php?role=customer" class="nav-link">Dashboard</a>
        </li>
        <li class="nav-item <?php echo $isActiveTransactions ?> dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown">Transactions</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a href="income_trans.php?role=customer" class="dropdown-item">Income Summary</a>
                <a href="expense_trans.php?role=customer" class="dropdown-item">Expenses Summary</a>
                <a href="overall_trans.php?role=customer" class="dropdown-item">All Transactions</a>
            </div>
        </li>
        <li class="nav-item <?php echo $isActiveBudgets ?> ">
            <a href="budget.php?role=customer" class="nav-link">Budgets</a>
        </li>
        <li class="nav-item <?php echo $isActiveInvestments ?> ">
            <a href="investment.php?role=customer" class="nav-link">Investments</a>
        </li>
        <li class="nav-item <?php echo $isActiveLiabilities ?> ">
            <a href="liability.php?role=customer" class="nav-link">Debts</a>
        </li>
        <!-- <li class="nav-item <?php //echo $isActiveFinancialGoals ?> ">
            <a href="#" class="nav-link">Financial Goals</a>
        </li> -->
        <!-- <li class="nav-item <?php // echo $isActiveReports ?> ">
            <a href="reports.php?role=customer" class="nav-link">Reports</a>
        </li> -->
        <li class="nav-item dropdown <?php echo $isActiveSetting ?>">
            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown">Setting</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a href="profile.php?role=customer" class="dropdown-item">Profile</a>
                <a href="enquiry.php?role=customer" class="dropdown-item">Enquiry</a>
                <a href="announcement.php?role=customer" class="dropdown-item">Announcements</a>
                <a href="logout.php?role=customer" class="dropdown-item">Logout</a>
            </div>
        </li>
    </ul>
</nav>