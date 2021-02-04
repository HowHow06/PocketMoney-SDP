$(document).ready(function () {
  var query = document.getElementById("filter-query").value;
  var input = document.getElementById("search-transaction");
  input.addEventListener("keyup", function (event) {
    showsearch(query);
  });
  input;

  var keyword = $("#current-previous-date").val();
  var numbers = /^[0-9-]+$/;
  if (String(keyword).match(numbers)) {
    $("#filter-month-year").val("Yearly");
  } else {
    $("#filter-month-year").val("Monthly");
  }

  $(".progress-bar").each(function () {
    progress_width = $(this).attr("aria-valuenow");
    $(this).css("width", progress_width + "%");
  });

  $("body").niceScroll();
});

function validateform(ele) {
  var id = "#" + ele.id;
  var transactionDateTime = $(id).find(".form-transactionDateTime");
  var transactionAmount = $(id).find(".form-transactionAmount");
  var transactionType = $(id).find(".form-transactionType");
  var transactionCategory = $(id).find(".form-transactionCategory");
  var transactionName = $(id).find(".form-transactionName");

  //validate datetime-local
  if (transactionDateTime.length) {
    if (!validDate(transactionDateTime.val())) {
      //set the error msg to display
      transactionDateTime
        .parent()
        .find(".error")
        .css("display", "inline-block");
      //decrease some margin-bottom for the form group
      transactionDateTime.parent().css("margin-bottom", "0.2rem");
      return failValidation("Invalid Date!");
    } else {
      transactionDateTime.parent().find(".error").css("display", "none");
      //decrease some margin-bottom for the form group
      transactionDateTime.parent().css("margin-bottom", "1rem");
    }
  }

  //validate amount
  if (transactionAmount.length) {
    // alert(validAmount(transactionAmount.val()));
    if (!validAmount(transactionAmount.val())) {
      transactionAmount.parent().find(".error").css("display", "inline-block");
      //decrease some margin-bottom for the form group
      transactionAmount.parent().css("margin-bottom", "0.2rem");
      return failValidation("Invalid Amount!");
    } else {
      transactionAmount.parent().find(".error").css("display", "none");
      //decrease some margin-bottom for the form group
      transactionAmount.parent().css("margin-bottom", "1rem");
    }
  }

  //validate name
  if (transactionName.length) {
    // alert(transactionName.val());
    if (!validTransactionName(transactionName.val())) {
      transactionName.parent().find(".error").css("display", "inline-block");
      //decrease some margin-bottom for the form group
      transactionName.parent().css("margin-bottom", "0.2rem");
      return failValidation("Name cannot contain any special character!");
    } else {
      transactionName.parent().find(".error").css("display", "none");
      //decrease some margin-bottom for the form group
      transactionName.parent().css("margin-bottom", "1rem");
    }
  }

  //validate type
  if (transactionType.length) {
    if (!validTransactionType(transactionType.val())) {
      transactionType.parent().find(".error").css("display", "inline-block");
      //decrease some margin-bottom for the form group
      transactionType.parent().css("margin-bottom", "0.2rem");
      return failValidation("Type must be income or expenses!");
    } else {
      transactionType.parent().find(".error").css("display", "none");
      //decrease some margin-bottom for the form group
      transactionType.parent().css("margin-bottom", "1rem");
    }
  }

  //to check if the category exist
  if (transactionCategory.length) {
    var category = transactionCategory.val();
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

function validTransactionType(name) {
  if (!isAlNum(name)) {
    return false;
  }
  if (name != "income" && name != "expenses") {
    return false;
  }
  return true;
}

function validTransactionName(name) {
  if (isEmpty(name)) {
    return true;
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

function showMonthYear() {
  var keyword = document.getElementById("current-date").value;
  if (String(keyword).length < 5) {
    document.getElementById("filter-month-year").value = "Monthly";
  } else {
    document.getElementById("filter-month-year").value = "Yearly";
  }
}

function showsearch(query) {
  var keyword = document.getElementById("search-transaction").value;
  var xmlhttp = new XMLHttpRequest();
  var typeFilter = document.getElementById("filter-transaction-type");
  var categoryFilter = document.getElementById("filter-transaction-category");
  var cusID = document.getElementById("cusID");
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById(
        "overallTransactionTableBody"
      ).innerHTML = this.responseText;
      var rowCount = $("#overallTransactionTableBody tr").length;
      $("#table-row-count").html(" " + rowCount + " ");
      $("body").niceScroll().resize();
    }
  };
  xmlhttp.open(
    "GET",
    "form_process.php?type=" +
      typeFilter.value +
      "&cate=" +
      categoryFilter.value +
      "&searchTransaction=" +
      keyword +
      "&cusID=" +
      cusID.value +
      "&query=" +
      query,
    true
  );
  xmlhttp.send();
}

function resetEdit() {
  var xmlhttp = new XMLHttpRequest();
  var transactionID = document.getElementById("edit_budgetID").value;
  var cusID = document.getElementById("cusID").value;
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var data = JSON.parse(this.responseText);
      var transactionDateTime = data["date"];
      var transactionAmount = data["amount"];
      var transactionCategory = data["categoryName"];
      var transactionName = data["description"];
      var transactionType = data["categoryType"];
      const formattedDateTime = transactionDateTime.replace(/\s/, "T");
      $("#edit_transactionDateTime").val(formattedDateTime);
      $("#edit_transactionAmount").val(transactionAmount);
      $("#edit_transactionCategory").val(transactionCategory);
      $("#edit_transactionName").val(transactionName);
      $("#edit_transactionType").val(transactionType);
    }
  };
  xmlhttp.open(
    "GET",
    "form_process.php?resetEditTransaction=" +
      transactionID +
      "&cusID=" +
      cusID,
    true
  );
  xmlhttp.send();
}

function showdetail(name, month, year) {
  var xmlhttp = new XMLHttpRequest();
  var cateAmount = document.getElementById("showAmount" + name).textContent;
  document.getElementById("cateName").textContent = name.toUpperCase();
  document.getElementById("cateAmount").textContent = "Total: RM" + cateAmount;
  raw = parseFloat(cateAmount);
  if (month != 0) {
    switch (month) {
      case 1:
      case 3:
      case 5:
      case 7:
      case 8:
      case 10:
      case 12:
        avg = raw / 31;
        break;
      case 4:
      case 6:
      case 9:
      case 11:
        avg = raw / 30;
        break;
      case 2:
        year % 4 == 0 ? (avg = raw / 29) : (avg = raw / 28);
        break;
    }
    document.getElementById("cateAvg").textContent =
      "Average Daily: RM" + avg.toFixed(2);
    document.getElementsByClassName("cate-overall")[0].id = name;
    cusID = document.getElementById("cusID").value;
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        var data = JSON.parse(this.responseText);

        var amount = String(data["amount"]);
        var month = String(data["month"]);

        var datalist = data["datalist"];
        document.getElementById(
          "categoryTransactionTableBody"
        ).innerHTML = datalist;

        refreshchart(amount, month);
        $("#cate-overall").css({ visibility: "visible" });
        $("#categoryTransactionTable").css({ visibility: "visible" });
        $("#cate-overall").css({ display: "block" });
        $("body").niceScroll().resize();
      }
    };
    xmlhttp.open(
      "GET",
      "form_process.php?cateName=" +
        name +
        "&cusID=" +
        cusID +
        "&date=" +
        month +
        "&year=" +
        year,
      true
    );
    xmlhttp.send();
  } else {
    avg = raw / 12;
    document.getElementById("cateAvg").textContent =
      "Average Monthly: RM" + avg.toFixed(2);
    document.getElementsByClassName("cate-overall")[0].id = name;
    cusID = document.getElementById("cusID").value;

    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        var data = JSON.parse(this.responseText);
        var amount = String(data["amount"]);
        var month = String(data["month"]);

        var datalist = data["datalist"];
        document.getElementById(
          "categoryTransactionTableBody"
        ).innerHTML = datalist;

        refreshchart(amount, month);
        $("#cate-overall").css({ visibility: "visible" });
        $("#categoryTransactionTable").css({ visibility: "visible" });
        $("#cate-overall").css({ display: "block" });
        $("body").niceScroll().resize();
      }
    };
    xmlhttp.open(
      "GET",
      "form_process.php?cateName=" +
        name +
        "&cusID=" +
        cusID +
        "&date=" +
        month +
        "&year=" +
        year,
      true
    );
    xmlhttp.send();
  }
}

function refreshchart(amount, month) {
  amountJSON = JSON.parse(amount);
  monthJSON = JSON.parse(month);
  var lineOptions = {
    series: [
      {
        data: amountJSON,
      },
    ],
    chart: {
      height: 400,
      type: "line",
      dropShadow: {
        enabled: true,
        color: "#000",
        top: 18,
        left: 7,
        blur: 10,
        opacity: 0.2,
      },
      toolbar: {
        show: false,
      },
      zoom: {
        enabled: false,
      },
    },
    dataLabels: {
      enabled: true,
    },
    stroke: {
      curve: "straight",
      width: 1,
    },
    colors: ["#F89542"],
    grid: {
      row: {
        colors: ["#f3f3f3", "transparent"], // takes an array which will be repeated on columns
        opacity: 0.5,
      },
    },
    xaxis: {
      categories: monthJSON,
    },
    yaxis: {
      min: function (min) {
        return min - 100;
      },
      max: function (max) {
        return max + 100;
      },
    },
  };

  $("#line-chart").contents().remove();
  var lineChart = new ApexCharts(
    document.querySelector("#line-chart"),
    lineOptions
  );
  lineChart.render();
}

$(document).on("click", ".edit-transaction-anchor", function () {
  var budgetID = $(this).parent().parent().find(".budgetID").val();
  //var transactionDateTime = $(this).parent().parent().find(".transactionDateTime").val();
  var budgetPercentage = $(this)
    .parent()
    .parent()
    .find(".budgetPercentage")
    .text();
  //var transactionCategory = $(this).parent().parent().find(".transactionCategory").text();
  //var transactionName = $(this).parent().parent().find(".transactionName").text();
  var budgetCategory = $(this).parent().parent().find(".budgetCategory").text();

  $("#edit_budgetID").val(budgetID);
  //$("#edit_transactionDateTime").val(formattedDateTime);
  $("#edit_budgetPercentage").val(budgetPercentage);
  $("#edit_budgetCategory").val(budgetCategory);
  //$("#edit_transactionName").val(transactionName);
  //$("#edit_transactionType").val(transactionType);
});

$(document).on("click", ".delete-transaction-anchor", function () {
  var budgetID = $(this).parent().parent().find(".budgetID").val();
  $("#delete_budgetID").val(budgetID);
});

$(document).on("change", "#edit_transactionType", function () {
  var keyword = document.getElementById("edit_transactionType").value;
  if (keyword == "income") {
    $x = $("#edit_transactionCategory").clone();
    $("#edit_transactionCategory").remove();
    $x.attr("list", "edit_transactionCategoryIncomeList").insertAfter(
      "#edit_transactionCategoryLabel"
    );
  } else if (keyword == "expenses") {
    $x = $("#edit_transactionCategory").clone();
    $("#edit_transactionCategory").remove();
    $x.attr("list", "edit_transactionCategoryExpensesList").insertAfter(
      "#edit_transactionCategoryLabel"
    );
  }
});

$(document).on("change", "#new_transactionType", function () {
  var keyword = document.getElementById("new_transactionType").value;
  if (keyword == "income") {
    $x = $("#new_transactionCategory").clone();
    $("#new_transactionCategory").remove();
    $x.attr("list", "new_transactionCategoryIncomeList").insertAfter(
      "#new_transactionCategoryLabel"
    );
  } else if (keyword == "expenses") {
    $x = $("#new_transactionCategory").clone();
    $("#new_transactionCategory").remove();
    $x.attr("list", "new_transactionCategoryExpensesList").insertAfter(
      "#new_transactionCategoryLabel"
    );
  }
});

$('[data-toggle="row-hover"]').popover({
  html: true,
  trigger: "hover",
  placement: "top",
  content: function () {
    return $(this).data("text");
  },
});

// smoothing the bookmark section
// let anchorlinks = document.querySelectorAll('a[href^="#"]')

// for (let item of anchorlinks) { // relitere
//     item.addEventListener('click', (e)=> {
//         let hashval = item.getAttribute('href')
//         let target = document.querySelector(hashval)
//         target.scrollIntoView({
//             behavior: 'smooth',
//             block: 'start'
//         })
//         history.pushState(null, null, hashval)
//         e.preventDefault()
//     })
// }

// Bookmarks JQuery code, only put at the end of code
(function ($) {
  var h = window.location.hash;
  if (h.length > 1) {
    var target = $(h);
    if (target.length) {
      $("html,body").animate({ scrollTop: target.offset().top }, 400);
    }
  }
  $(document).on("click", "a", function (e) {
    var a = $(this),
      href = a.attr("href");
    if (href && ~href.indexOf("#")) {
      var name = href.substr(href.indexOf("#") + 1),
        target = $("a[name=" + name + "]"),
        target2 = $("#" + name);
      console.log(name);
      target = target.length ? target : target2;
      if (target.length) {
        e.preventDefault();
        $("html,body").animate(
          {
            scrollTop: target.offset().top,
          },
          400
        );
      }
    }
  });
})(jQuery);
