# SDP-Assignment
> A software project for Software Development Project

Financial Management System (Website)

## Contributor:
- Lim Zhi Hao         TP054890
- Moses Lau Yi Hieng  TP054834
- Law Li Yaw          TP054819
- Howard Lim          TP055278

## Work Progress
### 2021-02-05
> Moses's Part
- Fixing bugs
- Create ```profile.php``` for customer to view announcement.
### 2021-02-05
> Moses's Part
- Fixing bugs
- Create ```announcement.php``` for customer to view announcement.
- Add DML for announcement.
### 2021-02-04
> Moses's Part
- Update ```profile.php``` and ```enquiry.php```
- Add DDL for feedback and announcement.
- Fixing naming error on budget entity.
- Update transaction page to accept investment and liability data.

### 2021-02-03
> Howard's Part For Dashboard
- Update ```dashboard.php```
- The recent transaction table updated, shouldnt be retricted by date and month, since it is "most recent"
- The snap shot formula is revised:
    income == all income
    expenses == all expenses + debt paid (money out as well)
    balance == income - expenses

    asset == balance + investment made
    debt to pay == total debt amount - debt paid
    networth == asset - debt to pay


### 2021-01-21
> Moses's Part
- Create ```profile.php``` and ```enquiry.php```
- Update ```dashboard.php```
### 2021-01-21
> Law's Part
- Update ```budget.php``` and ```budget.js```
> Moses's Part
- Fixing bugs
- Update ```budget.scss```

### 2021-01-20
> Moses's Part
- Create ```phpmailer``` file
- PHP Mailer is a plug-ins used to send email
- Specific requirements can view in ```sendRegisterEmail()``` function
- TO NOTE THAT: 
1. kindly change your localhost address so that it match as below
```
http://localhost/SDP-Assignment/register_three.php?email=
```
2. When turn from localhost to live database, kindly change the url to respective website
```
//Content
$url = "http://localhost/SDP-Assignment/register_three.php?email=" . $email;
```
- Create ```register_one.php``` and ```register_two.php``` and ```register_three.php```
- Update ```register.scss``` and it is only available to above register.php
- Fixing bugs in transaction pages

### 2021-01-14
> Moses's Part
- Update ```income_trans.php``` and ```expense_trans.php``` and ```overall_trans.php```

> Howard's Part
- Update ```class.customer.php```

### 2021-01-13
> Moses's Part
- Update ```expense_trans.php``` and ```overall_trans.php```
- Rename ```income_trans.scss``` to ```transaction.scss```
- Rename ```income_trans.js``` to ```transaction.js```
- Both three transactions pages sharing same stylesheet and JavaScript, as well as PHP functions

### 2021-01-12
> Moses's Part
- Update ```class.customer.php``` and ```income_trans.js```  and ```form_process.php``` mostly for income page
- At this point 95% of income page done

### 2021-01-11
> Moses's Part
- Update ```class.customer.php``` and ```income_trans.js```  and ```form_process.php``` mostly for income page
- At this point 80% of income page done

### 2021-01-10
> Moses's Part
- Update ```class.customer.php``` and ```income_trans.js``` mostly for income page
- Create ```fusioncharts-suite-xt``` file
- Fasioncharts can be used in php therefore is implemented in server side
- These are the reference used for fasioncharts (another chart)
```
<script src="./fusioncharts-suite-xt/js/fusioncharts.js"></script>
```
```
<script src="./fusioncharts-suite-xt/js/themes/fusioncharts.theme.fusion.js"></script>
```
```
<?php include('./fusioncharts-suite-xt/integrations/php/fusioncharts-wrapper/fusioncharts.php') ?>
```


### 2021-01-08
> Moses's Part
- Update ```class.customer.php``` and ```income_trans.js``` and ```form_process.php``` mostly for income page

### 2021-01-07
> Moses's Part
- Update ```class.customer.php``` mostly for income page

### 2021-01-06
> Moses's Part
- Fix bugs on ```.navbar.php```
- Create ```liability.php```
- Update ```dashboard.php```
- Update transaction functions
Backend Progress
- Change abit layout of ```class.customer.php```
- Create ```income_trans.js```

### 2021-01-05
> Moses's Part
- Fix bugs on ```.navbar.php```
- Create ```budget.php```
- Update ```income_trans.php``` and ```expense_trans.php```
- Create ```overall_trans.php``` just showing all transaction records.
- Update ```dashboard.php```

### 2020-12-17 - 2021-01-02
> Howard's Part
- Fully established ```investment.php``` along with supportive files.
- Create ```class_customer.php```
- Create ```pocketmoney.db```
- Create ```Validation.php```
- Create ```investment.js```

> Law's Part
- Draft ```budget``` layout
- Draft ```liability``` layout

> Nash's Part
- Draft ```financial gaol``` layout
- Draft ```admin``` layout
### 2020-12-16
> Howard's Part
- Create ```_background.scss``` and ```_navbar.scss```
- Change structure of the scss code.

> Moses's Part
- **Update navbar of for customer site** Important if u guys has pulled, might have conflict
- Update ```income_trans.php```
- Create ```expense_trans.php```
- This is the reference used for fontawesome (some icons)
```
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
```
### 2020-12-15
> Moses's Part
- Update ```investment.php```
- Create ```dashboard.php```
- Create ```income_trans.php```
### 2020-12-14
> Moses's Part
- Create ```investment.php```
- This is the reference used for apexchart (making charts)
```
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
```
### 2020-12-11
> Moses's Part
- Update ```register.php```
- Create ```lib.scss```, storing all ```@mixin``` and variables for certain same scss files.
### 2020-12-09
> Moses's Part
- Create ```login.php```
- Create ```register.php```
### 2020-12-05
> Moses's Part
- Update ```index.html```
- Create logo
### 2020-11-27
> Mash's Part
- Update ```index.html```
### 2020-11-26
> Li Yaw's Part
- Update ```index.html```

> Moses' Part
- Update ```index.html```
### 2020-11-25
> Moses' Part
- Initialize ```index.html``` for customer
- Create related material for ```index.html```
- These four references is used when using ```Bootstrap 4``` 
``` 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
```
```
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
```
```
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
```
```
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
```
- These two is the fonts used for logo and overall wording
```
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Nerko+One&display=swap" rel="stylesheet">
```
```
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
```
- These one is for scroll effect
```
<script src="./jquery/jquery.nicescroll-3.7.4/jquery.nicescroll.js"></script>
```
## License 
This project is only editable for contributors.
