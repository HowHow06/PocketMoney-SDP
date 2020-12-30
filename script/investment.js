var investmentTypes = $("#typesOfInvestments").val();
var investmentAmount = $("#amountsOfInvestments").val();
var typeJSON = JSON.parse(investmentTypes);
var amountJSON = JSON.parse([investmentAmount]);

function resetEdit() {
  var investID = $("#edit_investmentID").val();
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var data = JSON.parse(this.responseText);

      var investDate = data["startDate"];
      var investAmount = data["amountInvested"];
      var investName = data["investmentName"];
      var investType = data["investmentType"];
      var investRate = data["ratePerAnnum"];

      $("#edit_startDate").val(investDate);
      $("#edit_amountInvested").val(investAmount);
      $("#edit_investmentName").val(investName);
      $("#edit_investmentType").val(investType);
      $("#edit_ratePerAnnum").val(investRate);
    }
  };
  xmlhttp.open("GET", "form_process.php?resetEditInvest=" + investID, true);
  xmlhttp.send();
}

var donutOptions = {
  series: amountJSON,
  labels: typeJSON,
  chart: {
    type: "donut",
  },
  plotOptions: {
    pie: {
      customScale: 0.85,
      donut: {
        size: "55%",
      },
    },
  },
  noData: {
    text: "Loading...",
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
  colors: ["#D08F78", "#F89542", "#FFB07C"],
};

var investmentTypes_donutChart = new ApexCharts(
  document.querySelector("#investmentTypes-donut-chart"),
  donutOptions
);
investmentTypes_donutChart.render();

var investmentName = $("#nameOfInvestment").val();
var investmentNameAmount = $("#amountsOfInvestmentByName").val();
var nameJSON = JSON.parse(investmentName);
var nameAmountJSON = JSON.parse([investmentNameAmount]);

var donutOptions = {
  series: nameAmountJSON,
  labels: nameJSON,
  chart: {
    type: "donut",
  },
  plotOptions: {
    pie: {
      customScale: 0.85,
      donut: {
        size: "55%",
      },
    },
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
  colors: ["#D08F78", "#F89542", "#FFB07C"],
};

var donutChart = new ApexCharts(
  document.querySelector("#investmentNames-donut-chart"),
  donutOptions
);
donutChart.render();

$(document).on("click", ".edit-investment-anchor", function () {
  var investID = $(this).parent().parent().find(".investmentID").val();
  var investDate = $(this).parent().parent().find(".investDate").text();
  var investAmount = $(this).parent().parent().find(".investAmount").text();
  var investName = $(this).parent().parent().find(".investName").text();
  var investType = $(this).parent().parent().find(".investType").text();
  var investRate = $(this).parent().parent().find(".investRate").text();

  $("#edit_investmentID").val(investID);
  $("#edit_startDate").val(investDate);
  $("#edit_amountInvested").val(investAmount);
  $("#edit_investmentName").val(investName);
  $("#edit_investmentType").val(investType);
  $("#edit_ratePerAnnum").val(investRate);
});

$(document).on("click", ".delete-investment-anchor", function () {
  var investID = $(this).parent().parent().find(".investmentID").val();
  $("#delete_investmentID").val(investID);
});

$(document).ready(function () {
  $("body").niceScroll();
});
