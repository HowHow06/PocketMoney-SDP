<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(".head.php"); ?>
    <link rel="stylesheet" href="./style/index.css">
    <title>PocketMoney | Homepage</title>
</head>

<body>
    <div class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <a href="#" class="navbar-brand"><img src="./img/logo.png" width="50px" height="50px"> POCKETMONEY</a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a href="index.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown">Login / Sign Up</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a href="login.php?role=customer" class="dropdown-item">Customer</a>
                        <a href="login.php?role=admin" class="dropdown-item">Admin</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="progress-container">
            <div class="progress-bar" id="myBar"></div>
        </div>
    </div>

    <div class="jumbotron text-center">
        <h1 class="display-4">POCKETMONEY</h1>
        <p class="lead">Serve your money better.</p>
        <a href="login.php?role=customer" class="btn btn-light btn-lg" role="button">GET STARTED</a>
    </div>

    <div class="container-fluid section1">
        <h1 class="display-5 text-center">What is PocketMoney?</h1>
        <div class="row">
            <div class="card" id="card1">
                <div class="card-body">
                    <h3 class="card-title">Ease to Use</h3>
                    <p class="card-text"> Click-and-Drag function, record and modify your every transaction easier.</p>
                </div>
            </div>
            <div class="card" id="card2">
                <div class="card-body">
                    <h3 class="card-title">Accountable</h3>
                    <p class="card-text">Our own algorithm to calculate any complex calculations verified by experts. Theoritical assist on your saving plans and expenses plan.</p>
                </div>
            </div>
            <div class="card" id="card3">
                <div class="card-body">
                    <h3 class="card-title">Unlimited Storage</h3>
                    <p class="card-text">Wasteless way to keep your expenses records. Storing and retrieve any historical record at any time, just by click and tap.</p>
                </div>
            </div>
            <div class="card" id="card4">
                <div class="card-body">
                    <h3 class="card-title">Visualise Effects</h3>
                    <p class="card-text">Graphs, Tables, Lists: Perfect and simplest visualising effects helps every record has its own analysis details.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid section2">
        <h1 class="display-5 text-center">How to use PocketMoney?</h1>
        <div class="container-fluid row" id="guide1">
            <div class="container col-5 text">
                <h2 class="display-5">1st: Set-up Account</h2>
                <p class="lead">
                    In PocketMoney, it is very easy to set up an account.
                    All users have to do, is enter their current active email and the password desired.
                    Once user clicked register, an email will be sent to the email provided.
                    Check the inbox, click on the link, and the acconut will be successfully activated.
                </p>
            </div>
            <div class="container col-7 image">
                <img src="./img/guide1.png" width="850" height="600">
            </div>
        </div>

        <div class="container-fluid row" id="guide2">
            <div class="container col-6 image">
                <img src="./img/guide2.png" width="850" height="600">
            </div>
            <div class="container col-4 text">
                <h2 class="display-5">2nd: Do Record</h2>
                <p class="lead">
                    This is the place where user can do their daily records for both expenses and incomes.
                    If the user wants to do records for expenses, click the expense button and input the details.
                    If the user wants to do records for incomes, click the income button and input the details.
                    Once everything is entered, click save and the records are available for viewing and edit anytime.
                    With this function, user could view all the expenses and incomes in the simplest way.
                </p>
            </div>
        </div>

        <div class="container-fluid row" id="guide3">
            <div class="container col-4 text">
                <h2 class="display-5">3rd: Analysis Records</h2>
                <p class="lead">
                    Analysis Records is used to summarise users expenses and incomes for easier viewing.
                    Since this function is developed as real-time analysing, users will not have to do anything.
                    To view the anylysed records, click on the view analysis records button.
                    Inside the page, users could view all their analysed data, from expense, incomes to savings, progession and suggestion.
                </p>
            </div>
            <div class="container col-7 image">
                <img src="./img/guide3.png" width="850" height="600">
            </div>
        </div>
    </div>

    <div class="container-fluid section3">
        <h1 class="display-5 text-center">OUR TEAM</h1>
        <div class="row">
            <div class="card col-3" id="about1">
                <div class="card-body">
                    <h3 class="card-title">Moses Lau</h3>
                    <hr>
                    <p class="card-text" id="tp_num">TP054834</p>
                    <p class="card-text">
                        Hello world. Tired of record using record book?
                        Then PocketMoney is perfectly designed for you.
                        It’s free, ease of use, and more!
                        We hope you can enjoy using this webapp.
                    </p>
                </div>
            </div>
            <div class="card col-3" id="about2">
                <div class="card-body">
                    <h3 class="card-title">Lim Zhi Hao</h3>
                    <hr>
                    <p class="card-text" id="tp_num">TP054890</p>
                    <p class="card-text">
                    Hi! Lim Zhi Hao here! 
                    Tired of always jotting down and calculating about your incomes, expenses. 
                    Let's us help you with managing all of your money usage!
                    </p>
                </div>
            </div>
            <div class="card col-3" id="about3">
                <div class="card-body">
                    <h3 class="card-title">Howard Lim</h3>
                    <hr>
                    <p class="card-text" id="tp_num">TP055278</p>
                    <p class="card-text">
                        I'm a Howard. Please use our system, thou maybe its goodn't, but it took half of my life. So yea.
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                    </p>
                </div>
            </div>
            <div class="card col-3" id="about4">
                <div class="card-body">
                    <h3 class="card-title">Law Li Yaw</h3>
                    <hr>
                    <p class="card-text" id="tp_num">TP054819</p>
                    <p class="card-text">
                        <!-- Hi, I'm Law Li Yaw. One of the developers for PocketMoney. 
			            Nowadays, majority of people have the habit to record their expenses and incomes, which is a good habit.
                        Therefore, PocketMoney is developed for these user to manage their financial status while using this web app. 
                        We hope all the users will be benefited from this web app, and enjoying using PocketMoney. -->
                        Hi, I'm Law Li Yaw.
                        PocketMoney is developed for those have the habit to record their expenses and incomes to manage their financial status.
                        We hope all the users will be benefited from this web app and enjoying using PocketMoney.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <h6 class="display-6 text-center">Copyright © 2020 PocketMoney All Rights Reserved</h6>
    </footer>
</body>
<script>
    window.onscroll = function() {
        myFunction()
    };

    function myFunction() {
        var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        var scrolled = (winScroll / height) * 100;
        document.getElementById("myBar").style.width = scrolled + "%";
    }

    $(document).ready(function() {
        $("html").niceScroll();
    });
</script>

</html>