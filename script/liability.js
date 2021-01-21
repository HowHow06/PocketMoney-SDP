$(document).ready(function () {
  $("body").niceScroll();
  $(".transaction-table").niceScroll();

  $(".progress-bar").each(function () {
    progress_width = $(this).attr("aria-valuenow");
    $(this).css("width", progress_width + "%");
  });

  $(window).resize(function () {
    console.log("heloooo");
    $("body").niceScroll().resize();
  });
});

//listener for edit payment button
$(document).on("click", ".edit-payment-anchor", function () {
  var paymentID = $(this).parent().parent().find(".paymentID").val();
  var paymentDate = $(this).parent().parent().find(".paymentDate").text();
  var paymentName = $(this).parent().parent().find(".paymentName").text();
  var paymentType = $(this).parent().parent().find(".paymentType").text();
  var paymentAmount = $(this).parent().parent().find(".paymentAmount").text();
  var paymentRemainder = $(this)
    .parent()
    .parent()
    .find(".paymentRemainder")
    .val();

  $("#edit-payment-remainder").val(paymentRemainder);
  $("#edit-payment-transactionID").val(paymentID);
  $("#edit-payment-date").val(paymentDate);
  $("#edit-payment-amount").val(paymentAmount);
  $("#edit-payment-name").val(paymentName);
  $("#edit-payment-category").val(paymentType);
});

//listener for the delete payment button
$(document).on("click", ".delete-payment-anchor", function () {
  var paymentID = $(this).parent().parent().find(".paymentID").val();
  $("#delete-payment-transactionID").val(paymentID);
});

//listener for the liability scheduled select (both new and edit)
$(document).on("change", ".liability-scheduled-select", function () {
  me = $(this);
  value = me.val();
  toggleEditScheduledForm(value, me);
});

//listener for the delete liability button
$(document).on("click", ".delete-liability-anchor", function () {
  var liabilityID = $(this).parent().parent().find(".liabilityID").val();
  $("#delete-liability-liabilityID").val(liabilityID);
});

//listener for edit liability button
$(document).on("click", ".edit-liability-anchor", function () {
  var liabilityID = $(this).parent().parent().find(".liabilityID").val();
  fillEditLiability(liabilityID);
});

//to fill in the edit liability form based on id
function fillEditLiability(liabilityID) {
  var cusID = $("#cusID").val();
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var data = JSON.parse(this.responseText);
      var liabilityStartDate = data["startDate"];
      var liabilityTotalAmount = data["totalAmountToPay"];
      var liabilityAmountPaid = data["paidAmount"]; //MIGHT BE NULL
      var liabilityAmountIni = data["initialPaidAmount"]; //MIGHT BE NULL
      var liabilityName = data["liabilityName"];
      var liabilityType = data["liabilityType"];
      var liabilityPaymentDate = data["paymentDate"];
      var liabilityPaymentAmount = data["amountEachPayment"];
      var liabilityPaymentFrequency = data["paymentFrequency"];
      var liabilityPaymentReminder = data["paymentReminder"];
      if (!data["paidAmount"]) {
        //if null
        var liabilityAmountPaid = 0; //MIGHT BE NULL
      } else {
        var liabilityAmountPaid = data["paidAmount"]; //MIGHT BE NULL
      }
      var liabilityPaymentDone =
        parseFloat(liabilityAmountPaid) - parseFloat(liabilityAmountIni);
      $("#edit-liabilityID").val(liabilityID);
      $("#edit-liability-startDate").val(liabilityStartDate);
      $("#edit-liability-totalAmount").val(liabilityTotalAmount);
      $("#edit-liability-amountPaid").val(liabilityAmountIni);
      $("#edit-liability-totalPaid").val(liabilityAmountPaid);
      $("#edit-liability-paymentDone").val(liabilityPaymentDone);
      $("#edit-liability-name").val(liabilityName);
      $("#edit-liability-oriName").val(liabilityName);
      $("#edit-liability-category").val(liabilityType);
      $("#edit-liability-paymentReminder").val(liabilityPaymentReminder);

      if (!liabilityPaymentDate && !liabilityPaymentAmount) {
        //if null, meaning not a scheduled
        toggleEditScheduledForm("no", $("#edit-liability-scheduled"));
        $("#edit-liability-paymentDate").val("");
        $("#edit-liability-paymentAmount").val("");
        $("#edit-liability-paymentFrequency").val("");
      } else {
        toggleEditScheduledForm("yes", $("#edit-liability-scheduled"));
        $("#edit-liability-paymentDate").val(liabilityPaymentDate);
        $("#edit-liability-paymentAmount").val(liabilityPaymentAmount);
        $("#edit-liability-paymentFrequency").val(liabilityPaymentFrequency);
      }
    }
  };
  xmlhttp.open(
    "GET",
    "form_process.php?getDataLiabilityID=" + liabilityID + "&cusID=" + cusID,
    true
  );
  xmlhttp.send();
}

function toggleEditScheduledForm(status, ele) {
  if (status == "yes") {
    ele.val("yes");
    var scheduledDiv = ele.parent().parent().find(".scheduled-div");
    scheduledDiv.css("display", "flex");
    scheduledDiv.find("input").prop("disabled", false);
    scheduledDiv.find("select").prop("disabled", false);
  } else if (status == "no") {
    ele.val("no");
    var scheduledDiv = ele.parent().parent().find(".scheduled-div");
    scheduledDiv.css("display", "none");
    scheduledDiv.find("input").prop("disabled", true);
    scheduledDiv.find("select").prop("disabled", true);
  }
}

//listener for liability name selection in new payment form
$(document).on("change", "#new-payment-name", function () {
  var liabilityName = $(this).val();
  chooseliabilityType(liabilityName);
  displayPaymentRemainder(liabilityName);
});

//to get the liability type
function chooseliabilityType(liabilityName) {
  var tableRow = $('.liabilityName:contains("' + liabilityName + '")');
  var liabilityType = tableRow.parent().find(".liabilityType").text();
  $("#new-payment-category").val(liabilityType);
  $("#new-payment-categoryHidden").val(liabilityType);
}

//to display the remainder in new payment modal
function displayPaymentRemainder(liabilityName) {
  var cusID = $("#cusID").val();
  var tableRow = $('.liabilityName:contains("' + liabilityName + '")');
  var liabilityID = tableRow.parent().find(".liabilityID").val();
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var data = JSON.parse(this.responseText);
      var remainder = data["remainder"];
      console.log(remainder);
      $("#new-payment-remainder").val(remainder);
    }
  };
  xmlhttp.open(
    "GET",
    "form_process.php?getDataLiabilityID=" + liabilityID + "&cusID=" + cusID,
    true
  );
  xmlhttp.send();
}

//GET THE FULL LIABILITY DATA, not a function, just to display here, for easier copy paste
function getLiabilityData(cusID, liabilityID) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var data = JSON.parse(this.responseText);
    }
  };
  xmlhttp.open(
    "GET",
    "form_process.php?getDataLiabilityID=" + liabilityID + "&cusID=" + cusID,
    true
  );
  xmlhttp.send();
}

//reset for edit payment form
function resetEditPayment() {
  var transactionID = $("#edit-payment-transactionID").val();
  var tableRow = $('.paymentID[value="' + transactionID + '"]');
  var paymentID = tableRow.parent().find(".paymentID").val();
  var paymentDate = tableRow.parent().find(".paymentDate").text();
  var paymentName = tableRow.parent().find(".paymentName").text();
  var paymentType = tableRow.parent().find(".paymentType").text();
  var paymentAmount = tableRow.parent().find(".paymentAmount").text();
  var paymentRemainder = tableRow.parent().find(".paymentRemainder").val();

  $("#edit-payment-remainder").val(paymentRemainder);
  $("#edit-payment-transactionID").val(paymentID);
  $("#edit-payment-date").val(paymentDate);
  $("#edit-payment-amount").val(paymentAmount);
  $("#edit-payment-name").val(paymentName);
  $("#edit-payment-category").val(paymentType);
}

//reset for edit payment form
function resetEditLiability() {
  liabilityID = $("#edit-liabilityID").val();
  fillEditLiability(liabilityID);
}

$(document).on("keyup change", ".filter-payment", function () {
  var keyword = $("#search-payment").val();
  if (keyword == "" || isAlNum(keyword)) {
    showSearchPayment();
  }
});

$(document).on("keyup change", ".filter-liability", function () {
  var keyword = $("#search-liability").val();
  if (keyword == "" || isAlNum(keyword)) {
    showSearchLiability();
  }
});

function showSearchPayment() {
  var keyword = $("#search-payment").val();
  var categoryFilter = $("#filter-transaction-category").val();
  var timeFilter = $("#filter-transaction-time").val();
  var cusID = $("#cusID").val();
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      $("#payment-table-body").html(this.responseText);
    }
  };
  xmlhttp.open(
    "GET",
    "form_process.php?time=" +
      timeFilter +
      "&cate=" +
      categoryFilter +
      "&searchPayment=" +
      keyword +
      "&cusID=" +
      cusID,
    true
  );
  xmlhttp.send();
}

function showSearchLiability() {
  var keyword = $("#search-liability").val();
  var categoryFilter = $("#filter-liability-category").val();
  var timeFilter = $("#filter-liability-time").val();
  var cusID = $("#cusID").val();
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      $("#liability-table-body").html(this.responseText);
    }
  };
  xmlhttp.open(
    "GET",
    "form_process.php?time=" +
      timeFilter +
      "&cate=" +
      categoryFilter +
      "&searchLiability=" +
      keyword +
      "&cusID=" +
      cusID,
    true
  );
  xmlhttp.send();
}

function validatePaymentform(ele) {
  var id = "#" + ele.id;
  var startDate = $(id).find(".form-startDate");
  var amount = $(id).find(".form-amount");

  //validate date
  if (startDate.length) {
    if (!validStartDate(startDate.val())) {
      //set the error msg to display
      startDate.parent().find(".error").css("display", "inline-block");
      //decrease some margin-bottom for the form group
      startDate.parent().css("margin-bottom", "0.2rem");
      return failValidation("Invalid Date!");
    } else {
      startDate.parent().find(".error").css("display", "none");
      //decrease some margin-bottom for the form group
      startDate.parent().css("margin-bottom", "1rem");
    }
  }

  //validate amount
  if (amount.length) {
    if (!validAmount(amount.val())) {
      amount.parent().find(".error").css("display", "inline-block");
      //decrease some margin-bottom for the form group
      amount.parent().css("margin-bottom", "0.2rem");
      return failValidation("Invalid Amount!");
    } else {
      amount.parent().find(".error").css("display", "none");
      //decrease some margin-bottom for the form group
      amount.parent().css("margin-bottom", "1rem");
    }
  }

  //to check if the paid amount is greater than payableAmount
  var payableAmount = parseFloat($(id).find(".form-payableAmount").val());
  var paid = parseFloat(amount.val());
  if (paid > payableAmount) {
    //if the amount paid exceed the payable amount
    amount.parent().find(".error").css("display", "inline-block");
    //decrease some margin-bottom for the form group
    amount.parent().css("margin-bottom", "0.2rem");
    return failValidation(
      "The amount paid must be smaller than payable amount!"
    );
  }

  return confirm("Are you sure you want to proceed?");
}

function validateLiabilityform(ele) {
  var id = "#" + ele.id;
  var liabilityName = $(id).find(".form-liabilityName");
  var liabilityType = $(id).find(".form-liabilityType");
  var startDate = $(id).find(".form-startDate");
  var amountTotal = $(id).find(".form-amountTotal");
  var amountPaid = $(id).find(".form-amountPaid");
  var scheduled = $(id).find(".liability-scheduled-select").val();

  var paymentDate = $(id).find(".form-paymentDate");
  var paymentAmount = $(id).find(".form-amountPayment");

  //validate name
  if (liabilityName.length) {
    if (!validName(liabilityName.val())) {
      //set the error msg to display
      liabilityName.parent().find(".error").css("display", "inline-block");
      //decrease some margin-bottom for the form group
      liabilityName.parent().css("margin-bottom", "0.2rem");
      return failValidation("Invalid liability name!");
    } else {
      liabilityName.parent().find(".error").css("display", "none");
      //decrease some margin-bottom for the form group
      liabilityName.parent().css("margin-bottom", "1rem");
    }
  }

  //validate type
  if (liabilityType.length) {
    if (!validName(liabilityType.val())) {
      //set the error msg to display
      liabilityType.parent().find(".error").css("display", "inline-block");
      //decrease some margin-bottom for the form group
      liabilityType.parent().css("margin-bottom", "0.2rem");
      return failValidation("Invalid liability type!");
    } else {
      liabilityType.parent().find(".error").css("display", "none");
      //decrease some margin-bottom for the form group
      liabilityType.parent().css("margin-bottom", "1rem");
    }
  }

  //validate date
  if (startDate.length) {
    if (!validStartDate(startDate.val())) {
      //set the error msg to display
      startDate.parent().find(".error").css("display", "inline-block");
      //decrease some margin-bottom for the form group
      startDate.parent().css("margin-bottom", "0.2rem");
      return failValidation("Invalid Date!");
    } else {
      startDate.parent().find(".error").css("display", "none");
      //decrease some margin-bottom for the form group
      startDate.parent().css("margin-bottom", "1rem");
    }
  }

  //validate total amount
  if (amountTotal.length) {
    if (!validAmount(amountTotal.val())) {
      //set the error msg to display
      amountTotal.parent().find(".error").css("display", "inline-block");
      //decrease some margin-bottom for the form group
      amountTotal.parent().css("margin-bottom", "0.2rem");
      return failValidation("Invalid total amount!");
    } else {
      amountTotal.parent().find(".error").css("display", "none");
      //decrease some margin-bottom for the form group
      amountTotal.parent().css("margin-bottom", "1rem");
    }
  }

  //validate paid amount
  if (amountPaid.length) {
    if (!validNotNegative(amountPaid.val())) {
      //set the error msg to display
      amountPaid.parent().find(".error").css("display", "inline-block");
      //decrease some margin-bottom for the form group
      amountPaid.parent().css("margin-bottom", "0.2rem");
      return failValidation("Invalid paid amount!");
    } else {
      amountPaid.parent().find(".error").css("display", "none");
      //decrease some margin-bottom for the form group
      amountPaid.parent().css("margin-bottom", "1rem");
    }
  }

  // //validate payment date
  // if (paymentDate.length) {
  //   console.log("checking paymetndate");
  //   if (!validFutureDate(paymentDate.val())) {
  //     //set the error msg to display
  //     paymentDate.parent().find(".error").css("display", "inline-block");
  //     //decrease some margin-bottom for the form group
  //     paymentDate.parent().css("margin-bottom", "0.2rem");
  //     return failValidation("Invalid Date!");
  //   } else {
  //     paymentDate.parent().find(".error").css("display", "none");
  //     //decrease some margin-bottom for the form group
  //     paymentDate.parent().css("margin-bottom", "1rem");
  //   }
  // }

  //only validate the payment amount when the scheduled is yes
  if (scheduled == "yes") {
    //validate payment amount
    if (paymentAmount.length) {
      if (!validAmount(paymentAmount.val())) {
        paymentAmount.parent().find(".error").css("display", "inline-block");
        //decrease some margin-bottom for the form group
        paymentAmount.parent().css("margin-bottom", "0.2rem");
        return failValidation("Invalid Payment Amount!");
      } else {
        paymentAmount.parent().find(".error").css("display", "none");
        //decrease some margin-bottom for the form group
        paymentAmount.parent().css("margin-bottom", "1rem");
      }
    }
  }

  amountTotal = parseFloat(amountTotal.val()); //total to pay
  amountPaid = parseFloat(amountPaid.val()); //initial paid amount

  if (scheduled == "yes") {
    paymentAmount = parseFloat(paymentAmount.val()); //payment to make
  } else {
    paymentAmount = parseFloat(0);
  }

  var paymentMade = parseFloat($(id).find(".form-liability-paymentDone").val()); //payment done
  var amountTotalPaid = parseFloat(
    $(id).find(".form-liability-totalPaid").val()
  ); //initial + payment done

  //if the total amount is smaller than SUM of INITIAL PAID AMOUNT and PAYMENT TO MAKE
  if (amountTotal < amountPaid + paymentAmount) {
    return failValidation(
      "Total amount must be larger than SUM of initial payment and future payment!"
    );
  }

  //for new liability form, no payment made, so this is only for edit liability form
  if (amountTotalPaid) {
    //if the total amount - initial amount < than the total paid amount in the transaction
    if (amountTotal - amountPaid < paymentMade) {
      return failValidation(
        "Total amount must be larger than the payment done."
      );
    }
  }

  //check in new liability form, check category name if unique
  if ($(id).find("#new-liability-name").val()) {
    var allNames = $(".liabilityName").toArray();
    for (let i = 0; i < allNames.length; i++) {
      if (liabilityName.val() == allNames[i].innerText) {
        liabilityName.parent().find(".error").css("display", "inline-block");
        //decrease some margin-bottom for the form group
        liabilityName.parent().css("margin-bottom", "0.2rem");
        return failValidation(
          "The debt name is used, please use enter another name."
        );
      } else {
        liabilityName.parent().find(".error").css("display", "none");
        //decrease some margin-bottom for the form group
        liabilityName.parent().css("margin-bottom", "1rem");
      }
    }
  }

  //check category name if unique
  var flag = 0; //never appear
  $("#new-liability-categoryList option").each(function () {
    if (liabilityType.val() == $(this).val()) flag = 1; //appear
  });

  if (flag == 0) {
    //if appear
    $(id).find(".form-liability-newCate").val(1);
    return confirm(
      liabilityType.val() + " is a new, do you want to create a new category?"
    );
  }

  return confirm("Are you sure you want to proceed?");
}

function validName(name) {
  if (isEmpty(name)) {
    return false;
  }
  if (!isAlNum(name)) {
    return false;
  }
  return true;
}

function isAlNum(inputtext) {
  var letterNumber = /^[0-9a-zA-Z ]+$/;
  if (inputtext.match(letterNumber)) {
    return true;
  } else {
    return false;
  }
}

function validStartDate(date) {
  var GivenDate = date;
  if (isEmpty(GivenDate)) {
    return false;
  }
  var CurrentDate = new Date();
  GivenDate = new Date(GivenDate);

  if (GivenDate > CurrentDate) {
    //the date is bigger then current date
    return false;
  } else {
    return true;
  }
}

function validFutureDate(date) {
  var GivenDate = date;
  if (isEmpty(GivenDate)) {
    return false;
  }
  var CurrentDate = new Date();
  GivenDate = new Date(GivenDate);

  if (GivenDate <= CurrentDate) {
    //the date is bigger then current date
    return false;
  } else {
    return true;
  }
}

function isEmpty(value) {
  return value.trim() == "";
}

function validNotNegative(price) {
  if (price.includes("e")) {
    return false;
  }
  if (Math.sign(price) != 1 && Math.sign(price) != 0) {
    return false;
  }
  return true;
}

function validAmount(price) {
  if (isEmpty(price)) {
    return false;
  }
  if (price.includes("e")) {
    return false;
  }
  if (Math.sign(price) != 1) {
    return false;
  }
  return true;
}

function failValidation(msg) {
  alert(msg); // just an alert for now but you can spice this up later
  return false;
}

function liabilityCategoryExist(category) {
  var x = $("#filter-transaction-category option");
  var i;
  for (i = 1; i < x.length; i++) {
    if (category == x[i].text) {
      //turn the flag true when the cate matches
      return true;
    }
  }
  return false;
}

// var investmentName = $("#typesOfInvestments").val();
// var investmentNameAmount = $("#amountsOfInvestments").val();
// var typeJSON = JSON.parse(investmentName);
// var amountJSON = JSON.parse([investmentNameAmount]);

// var donutOptions = {
//   series: amountJSON,
//   labels: typeJSON,
//   chart: {
//     type: "donut",
//   },
//   title: {
//     text: "Liabilities by Category",
//     align: "center",
//     margin: 15,
//     offsetX: -60,
//     floating: true,
//     style: {
//       fontSize: "22px",
//       fontWeight: "bold",
//       fontFamily: "Helvetica, Arial, sans-serif",
//       color: "#373d3f",
//     },
//   },
//   plotOptions: {
//     pie: {
//       expandOnClick: false,
//       customScale: 0.85,
//       donut: {
//         background: "transparent",
//         size: "55%",
//         labels: {
//           show: true,
//           total: {
//             show: true,
//             showAlways: false,
//             label: "Total",
//             fontSize: "22px",
//             fontFamily: "Helvetica, Arial, sans-serif",
//             fontWeight: 600,
//             color: "#373d3f",
//             formatter: function (w) {
//               return w.globals.seriesTotals.reduce((a, b) => {
//                 return a + b;
//               }, 0);
//             },
//           },
//         },
//       },
//     },
//   },
//   noData: {
//     text: "Loading...",
//   },
//   responsive: [
//     {
//       breakpoint: 480,
//       options: {
//         chart: {
//           width: 400,
//         },
//         legend: {
//           position: "bottom",
//         },
//       },
//     },
//   ],
//   colors: [
//     "#D08F78",
//     "#F89542",
//     "#FFB07C",
//     "#f68a32",

//     "#b27b56",

//     "#db5f43",
//     "#963727",
//     "#511d28",

//     "#263A4A",
//     "#45465B",
//     "#C5D3A9",
//     "#B0CA3C",
//     "#917580",
//   ],
// };

// var investmentTypes_donutChart = new ApexCharts(
//   document.querySelector("#liabilityTypes-donut-chart"),
//   donutOptions
// );
// investmentTypes_donutChart.render();

var investmentName = $("#nameOfInvestment").val();
var investmentNameAmount = $("#amountsOfInvestmentByName").val();
var nameJSON = JSON.parse(investmentName);
var nameAmountJSON = JSON.parse([investmentNameAmount]);

var donutOptions = {
  series: nameAmountJSON,
  labels: nameJSON,
  chart: {
    type: "donut",
    width: "50%",
  },
  title: {
    text: "Current Debts To Pay",
    align: "center",
    margin: 15,
    offsetX: -55,
    floating: true,
    style: {
      fontSize: "22px",
      fontWeight: "bold",
      fontFamily: "Helvetica, Arial, sans-serif",
      color: "#373d3f",
    },
  },
  plotOptions: {
    pie: {
      expandOnClick: false,
      customScale: 0.85,
      donut: {
        background: "transparent",
        size: "55%",
        labels: {
          show: true,
          total: {
            show: true,
            showAlways: false,
            label: "Highest Amount",
            fontSize: "1rem",
            fontFamily: "Helvetica, Arial, sans-serif",
            fontWeight: 600,
            color: "#373d3f",
            formatter: function (w) {
              return w.globals.seriesTotals.reduce((a, b) => {
                if (a > b) {
                  return a;
                } else {
                  return b;
                }
              }, 0);
            },
          },
        },
      },
    },
  },
  noData: {
    text: "Seems like you have no debt, Good Job",
  },
  responsive: [
    {
      breakpoint: 480,
      options: {
        chart: {
          width: 400,
        },
        legend: {
          position: "bottom",
        },
      },
    },
  ],
  colors: [
    "#FFB07C",
    "#b27b56",
    "#D08F78",
    "#F89542",
    "#f68a32",
    "#db5f43",
    "#963727",
    "#511d28",

    "#263A4A",
    "#45465B",
    "#C5D3A9",
    "#B0CA3C",
    "#917580",
  ],
};

var donutChart = new ApexCharts(
  document.querySelector("#liabilityNames-donut-chart"),
  donutOptions
);
donutChart.render();

// smoothing the bookmark section
let anchorlinks = document.querySelectorAll('a[href^="#"]')

for (let item of anchorlinks) { // relitere 
    item.addEventListener('click', (e)=> {
        let hashval = item.getAttribute('href')
        let target = document.querySelector(hashval)
        target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        })
        history.pushState(null, null, hashval)
        e.preventDefault()
    })
}