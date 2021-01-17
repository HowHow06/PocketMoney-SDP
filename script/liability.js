$(document).ready(function () {
  $("body").niceScroll();
  $(".transaction-table").niceScroll();

  $(".progress-bar").each(function () {
    progress_width = $(this).attr("aria-valuenow");
    $(this).css("width", progress_width + "%");
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
  $("#delete-payment-liabilityID").val(paymentID);
});

//listener for edit payment button
$(document).on("click", ".edit-liability-anchor", function () {
  var liabilityID = $(this).parent().parent().find(".liabilityID").val();
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var data = JSON.parse(this.responseText);
      var liabilityStartDate = data["startDate"];
      var liabilityTotalAmount = data["totalAmountToPay"];
      var liabilityAmountPaid = data["paidAmount"]; //MIGHT BE NULL
      var liabilityName = data["liabilityName"];
      var liabilityType = data["liabilityType"];
      var liabilityPaymentDate = data["paymentDate"];
      var liabilityPaymentAmount = data["amountEachPayment"];
      var liabilityPaymentFrequency = data["paymentFrequency"];
      if (!data["paidAmount"]) {
        //if null
        var liabilityAmountPaid = 0; //MIGHT BE NULL
      } else {
        var liabilityAmountPaid = data["paidAmount"]; //MIGHT BE NULL
      }
      $("#edit-liabilityID").val(liabilityID);
      $("#edit-liability-startDate").val(liabilityStartDate);
      $("#edit-liability-totalAmount").val(liabilityTotalAmount);
      $("#edit-liability-amountPaid").val(liabilityAmountPaid);
      $("#edit-liability-name").val(liabilityName);
      $("#edit-liability-category").val(liabilityType);

      if (!liabilityPaymentDate && !liabilityPaymentAmount) {
        //if null, meaning not a scheduled
        $("#edit-liability-scheduled").val("no");
        $("#edit-liability-scheduled")
          .parent()
          .parent()
          .find(".scheduled-div")
          .css("display", "none");
        $("#edit-liability-paymentDate").prop("disabled", true);
        $("#edit-liability-paymentAmount").prop("disabled", true);
        $("#edit-liability-paymentFrequency").prop("disabled", true);
      } else {
        $("#edit-liability-scheduled").val("yes");
        $("#edit-liability-scheduled")
          .parent()
          .parent()
          .find(".scheduled-div")
          .css("display", "flex");
        $("#edit-liability-paymentDate").prop("disabled", false);
        $("#edit-liability-paymentAmount").prop("disabled", false);
        $("#edit-liability-paymentFrequency").prop("disabled", false);
        $("#edit-liability-paymentDate").val(liabilityPaymentDate);
        $("#edit-liability-paymentAmount").val(liabilityPaymentAmount);
        switch (liabilityPaymentFrequency) {
          case "M":
            liabilityPaymentFrequency = "monthly";
            break;
          case "Y":
            liabilityPaymentFrequency = "yearly";
            break;

          default:
            liabilityPaymentFrequency = "";
            break;
        }
        $("#edit-liability-paymentFrequency").val(liabilityPaymentFrequency);
      }
    }
  };
  xmlhttp.open("GET", "form_process.php?editLiabilityID=" + liabilityID, true);
  xmlhttp.send();
});

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
