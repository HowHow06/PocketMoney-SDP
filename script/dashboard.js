$(document).ready(function () {
  $("body").niceScroll();

  $(".progress-bar").each(function () {
    progress_width = $(this).attr("aria-valuenow");
    $(this).css("width", progress_width + "%");
  });
});

var investmentTypes = $("#typesOfInvestments").val();
var investmentAmount = $("#amountsOfInvestments").val();
var typeJSON = JSON.parse(investmentTypes);
var amountJSON = JSON.parse([investmentAmount]);

var donutOptions = {
  series: amountJSON,
  labels: typeJSON,
  chart: {
    type: "donut",
  },
  title: {
    text: "Investments by Category",
    align: "center",
    margin: 15,
    offsetX: -60,
    floating: true,
    style: {
      fontSize: "12px",
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
            label: "Total",
            fontSize: "12px",
            fontFamily: "Helvetica, Arial, sans-serif",
            fontWeight: 600,
            color: "#373d3f",
            formatter: function (w) {
              return w.globals.seriesTotals.reduce((a, b) => {
                return a + b;
              }, 0);
            },
          },
        },
      },
    },
  },
  noData: {
    text: "No investment available",
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
    "#D08F78",
    "#F89542",
    "#FFB07C",
    "#f68a32",

    "#b27b56",

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
  title: {
    text: "Investments by Name",
    align: "center",
    margin: 15,
    offsetX: -45,
    floating: true,
    style: {
      fontSize: "12px",
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
            fontSize: "12px",
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
    text: "No investment available",
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
  document.querySelector("#investmentNames-donut-chart"),
  donutOptions
);
donutChart.render();
