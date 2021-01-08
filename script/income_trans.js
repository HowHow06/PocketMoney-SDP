$(document).ready(function () {
    var input = document.getElementById("search-transaction");
    input.addEventListener("keyup", function (event) {
      showsearch();
    });
    input;
});

function showsearch() {
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
        cusID.value,
      true
    );
    xmlhttp.send();
}

function resetEdit() {
    var xmlhttp = new XMLHttpRequest();
    var transactionID = document.getElementById("edit_transactionID").value;
    var cusID = document.getElementById("cusID").value;
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            
            var data = JSON.parse(this.responseText);
            var transactionDateTime = data["date"];
            var transactionAmount = data["amount"];
            var transactionCategory = data["categoryName"];
            var transactionName = data["description"];
            var transactionType = data["categoryType"];
            const formattedDateTime = transactionDateTime.replace(/\s/,'T');
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

$(document).on("click", ".edit-transaction-anchor", function () {
    var transactionID = $(this).parent().parent().find(".transactionID").val();
    var transactionDateTime = $(this).parent().parent().find(".transactionDateTime").val();
    var transactionAmount = $(this).parent().parent().find(".transactionAmount").text();
    var transactionCategory = $(this).parent().parent().find(".transactionCategory").text();
    var transactionName = $(this).parent().parent().find(".transactionName").text();
    var transactionType = $(this).parent().parent().find(".transactionType").text();

    //change format to match datetime-local format
    const formattedDateTime = transactionDateTime.replace(/\s/,'T');

    $("#edit_transactionID").val(transactionID);
    $("#edit_transactionDateTime").val(formattedDateTime);
    $("#edit_transactionAmount").val(transactionAmount);
    $("#edit_transactionCategory").val(transactionCategory);
    $("#edit_transactionName").val(transactionName);
    $("#edit_transactionType").val(transactionType);
});

$(document).on("click", ".delete-transaction-anchor", function () {
    var transactionID = $(this).parent().parent().find(".transactionID").val();
    $("#delete_transactionID").val(transactionID);
});

$(document).on("change", ".delete-transaction-anchor", function () {
    var transactionID = $(this).parent().parent().find(".transactionID").val();
    $("#delete_transactionID").val(transactionID);
});

$(document).on("change", "#edit_transactionType", function () {
    var keyword = document.getElementById("edit_transactionType").value;
    if (keyword == 'income') {
        $x = $("#edit_transactionCategory").clone();
        $("#edit_transactionCategory").remove();
        $x.attr('list','edit_transactionCategoryIncomeList').insertAfter('#edit_transactionCategoryLabel');
    } else if (keyword == 'expenses') {
        $x = $("#edit_transactionCategory").clone();
        $("#edit_transactionCategory").remove();
        $x.attr('list','edit_transactionCategoryExpensesList').insertAfter('#edit_transactionCategoryLabel');
    }
});

$(document).on("change", "#new_transactionType", function () {
    var keyword = document.getElementById("new_transactionType").value;
    if (keyword == 'income') {
        $x = $("#new_transactionCategory").clone();
        $("#new_transactionCategory").remove();
        $x.attr('list','new_transactionCategoryIncomeList').insertAfter('#new_transactionCategoryLabel');
    } else if (keyword == 'expenses') {
        $x = $("#new_transactionCategory").clone();
        $("#new_transactionCategory").remove();
        $x.attr('list','new_transactionCategoryExpensesList').insertAfter('#new_transactionCategoryLabel');
    }
});

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

$('[data-toggle="row-hover"]').popover({
  html: true,
  trigger: 'hover',
  placement: 'top',
  content: function () { return $(this).data('text'); }
});

$(document).ready(function () {
    $("body").niceScroll();
});