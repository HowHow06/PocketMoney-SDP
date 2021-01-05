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

  //validate date
  if (investDate.length) {
    if (!validDate(investDate.val())) {
      //set the error msg to display
      investDate.parent().find(".error").css("display", "inline-block");
      //decrease some margin-bottom for the form group
      investDate.parent().css("margin-bottom", "0.2rem");
      return failValidation("Invalid Date!");
    } else {
      investDate.parent().find(".error").css("display", "none");
      //decrease some margin-bottom for the form group
      investDate.parent().css("margin-bottom", "1rem");
    }
  }

  //validate amount
  if (investAmount.length) {
    if (!validAmount(investAmount.val())) {
      investAmount.parent().find(".error").css("display", "inline-block");
      //decrease some margin-bottom for the form group
      investAmount.parent().css("margin-bottom", "0.2rem");
      return failValidation("Invalid Amount!");
    } else {
      investAmount.parent().find(".error").css("display", "none");
      //decrease some margin-bottom for the form group
      investAmount.parent().css("margin-bottom", "1rem");
    }
  }

  //validate name
  if (investName.length) {
    if (!validTransactionName(investName.val())) {
      investName.parent().find(".error").css("display", "inline-block");
      //decrease some margin-bottom for the form group
      investName.parent().css("margin-bottom", "0.2rem");
      return failValidation("Name cannot contain any special character!");
    } else {
      investName.parent().find(".error").css("display", "none");
      //decrease some margin-bottom for the form group
      investName.parent().css("margin-bottom", "1rem");
    }
  }

  //validate type
  if (investType.length) {
    if (!validTransactionName(investType.val())) {
      investType.parent().find(".error").css("display", "inline-block");
      //decrease some margin-bottom for the form group
      investType.parent().css("margin-bottom", "0.2rem");
      return failValidation("Category cannot contain any special character!");
    } else {
      investType.parent().find(".error").css("display", "none");
      //decrease some margin-bottom for the form group
      investType.parent().css("margin-bottom", "1rem");
    }
  }
  //validate rate
  if (investRate.length) {
    if (!validAmount(investRate.val())) {
      investRate.parent().find(".error").css("display", "inline-block");
      //decrease some margin-bottom for the form group
      investRate.parent().css("margin-bottom", "0.2rem");
      return failValidation("Invalid rate!");
    } else {
      investRate.parent().find(".error").css("display", "none");
      //decrease some margin-bottom for the form group
      investRate.parent().css("margin-bottom", "1rem");
    }
  }

  //to check if the category exist
  if (investType.length) {
    var category = investType.val();
    if (!investCategoryExist(category)) {
      //if it is a new cateogory
      if (
        !confirm(
          category + " is a new category, do you wish to create a new category?"
        )
      ) {
        //if the user dont want to create new category, then return false, else proceed
        return false;
      }
    }
  }

  return confirm("Are you sure you want to proceed?");
}

function investCategoryExist(category) {
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

function validTransactionName(name) {
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

function validDate(date) {
  var GivenDate = date;
  if (isEmpty(GivenDate)) {
    return false;
  }
  var CurrentDate = new Date();
  GivenDate = new Date(GivenDate);

  if (GivenDate >= CurrentDate) {
    //the date is bigger then current date
    return false;
  } else {
    return true;
  }
}

function isEmpty(value) {
  return value.trim() == "";
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

$(document).on("change", ".delete-investment-anchor", function () {
  var investID = $(this).parent().parent().find(".investmentID").val();
  $("#delete_investmentID").val(investID);
});

$(document).ready(function () {
  $("body").niceScroll();
});

$(document).on("change", "#edit-general-name", function () {
  var investName = $(this).val();
  var cusID = $("#cusID").val();
  if (investName == "") {
    //if the user select the first "select an investment" option
    $("#edit-general-newName").val("");
    $("#edit-general-totalAmount").val("");
    $("#edit-general-investmentType").val("");
    $("#edit-general-ratePerAnnum").val("");
    $("#edit-general-newName").prop("disabled", true);
    $("#edit-general-investmentType").prop("disabled", true);
    $("#edit-general-ratePerAnnum").prop("disabled", true);
    return;
  }
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var data = JSON.parse(this.responseText);
      var investTotalAmount = data["sumAmount"];
      var investName = data["investmentName"];
      var investType = data["investmentType"];
      var investRate = data["avgRate"];
      $("#edit-general-newName").val(investName);
      $("#edit-general-totalAmount").val(investTotalAmount);
      $("#edit-general-investmentType").val(investType);
      $("#edit-general-ratePerAnnum").val(investRate);
      $("#edit-general-newName").prop("disabled", false);
      $("#edit-general-investmentType").prop("disabled", false);
      $("#edit-general-ratePerAnnum").prop("disabled", false);
    }
  };
  xmlhttp.open(
    "GET",
    "form_process.php?editGeneralInvestName=" + investName + "&cusID=" + cusID,
    true
  );
  xmlhttp.send();
});
