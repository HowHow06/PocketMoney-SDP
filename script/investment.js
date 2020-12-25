var donutOptions = {
  series: [],
  labels: [],
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

var investmentTypes = $("#typesOfInvestments").val();
var investmentAmount = $("#amountsOfInvestments").val();
alert(investmentTypes);
alert(investmentAmount);

investmentTypes_donutChart.render();

investmentTypes_donutChart.updateOptions({
  series: investmentAmount,
  labels: investmentTypes,
});

var donutOptions = {
  series: [1350.0, 2032.0, 320.1],
  labels: ["Company ABC", "Apple", "Samsung"],
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
  document.querySelector("#donut-chart"),
  donutOptions
);
donutChart.render();

$(document).ready(function () {
  $("body").niceScroll();
});
