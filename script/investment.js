var investmentTypes = $("#typesOfInvestments").val();
var investmentAmount = $("#amountsOfInvestments").val();
var typeJSON = JSON.parse(investmentTypes);
var amountJSON = JSON.parse([investmentAmount]);

$(document).ready(function () {
  var input = document.getElementById("search-transaction");
  input.addEventListener("keyup", function (event) {
    showsearch();
  });
  input;
});

function validateform(ele) {
  var id = "#" + ele.id;
  var investDate = $(id).find(".form-startDate");
  var investAmount = $(id).find(".form-amountInvested");
  var investName = $(id).find(".form-investmentName");
  var investType = $(id).find(".form-investmentType");
  var investRate = $(id).find(".form-ratePerAnnum");

  if (investDate.length) {
    if (!validDate(investDate.val())) {
      //set the error msg to display
      investDate.parent().find(".error").css("display", "inline-block");
      //decrease some margin-bottom for the form group
      investDate.parent().css("margin-bottom", "0.2rem");
      return failValidation("Invalid Date!");
    }
  }

  if (investAmount.length) {
  }

  if (investName.length) {
  }
  if (investType.length) {
  }
  if (investRate.length) {
  }

  // //validate file
  // if (filecheckresult == -1) {
  //   return failValidation("Please insert a valid image!");
  // }

  // //validate food name
  // if (!validfoodname(id)) {
  //   return failValidation(
  //     "Please insert a valid FOOD NAME \n (only alphabets and digits are allowed!)"
  //   );
  // }
  // //validate category
  // if (!validcate(id)) {
  //   return failValidation(
  //     "Please insert a valid CATEGORY NAME \n (only alphabets and digits are allowed!)"
  //   );
  // }

  // //validate price
  // if (!validprice(id)) {
  //   return failValidation(
  //     "Please insert a valid PRICE \n (only positive number under 150.00 is allowed!)"
  //   );
  // }

  // //validate price
  // if (!validdescription(id)) {
  //   return failValidation(
  //     "Please insert a valid DESCRIPTION: \nLength must not exceed 500 characters \nThese special characters are not allowed \n / \\ : * ? < > | "
  //   );
  // }

  // //to check if the category exist
  // var currentcate = document.getElementById("cateinput" + id).value;
  // if (categoryexist(id, currentcate) == false) {
  //   //if it is a new cateogory
  //   if (
  //     !confirm(
  //       currentcate +
  //         " is a new category, do you wish to create a new category?"
  //     )
  //   ) {
  //     //if the user dont want to create new category, then return false, else proceed
  //     return false;
  //   }
  // }

  // if (filecheckresult == 1) {
  //   return confirm("Are you sure u want to proceed without a picture?");
  // } else if (id == -1) {
  //   return confirm("Are you sure you want to add new food?");
  // } else {
  //   return confirm("Are you sure you want to update the food details?");
  // }
}

function validDate(date) {
  var GivenDate = date;
  var CurrentDate = new Date();
  GivenDate = new Date(GivenDate);

  if (GivenDate >= CurrentDate) {
    //the date is bigger then current date
    return false;
  } else {
    return true;
  }
}

function failValidation(msg) {
  alert(msg); // just an alert for now but you can spice this up later
  return false;
}

function showsearch() {
  var keyword = document.getElementById("search-transaction").value;
  var xmlhttp = new XMLHttpRequest();
  var timeFilter = document.getElementById("filter-transaction-time");
  var categoryFilter = document.getElementById("filter-transaction-category");
  var cusID = document.getElementById("cusID");
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById(
        "investmentTransactionTableBody"
      ).innerHTML = this.responseText;
      var rowCount = $("#investmentTransactionTableBody tr").length;
      $("#table-row-count").html(" " + rowCount + " ");
    }
  };
  xmlhttp.open(
    "GET",
    "form_process.php?time=" +
      timeFilter.value +
      "&cate=" +
      categoryFilter.value +
      "&searchInvest=" +
      keyword +
      "&cusID=" +
      cusID.value,
    true
  );
  xmlhttp.send();
}

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
  title: {
    text: "Investments by Category",
    align: "center",
    margin: 15,
    offsetX: -60,
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
            label: "Total",
            fontSize: "22px",
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
  colors: [
    "#D08F78",
    "#F89542",
    "#FFB07C",
    "#f68a32",

    "#16b183",

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
            fontSize: "22px",
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
    "#16b183",
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
