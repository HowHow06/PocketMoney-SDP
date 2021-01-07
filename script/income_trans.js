$(document).on("click", ".delete-transaction-anchor", function () {
    var transactionID = $(this).parent().parent().find(".transactionID").val();
    $("#delete_transactionID").val(transactionID);
});

$(document).on("change", ".delete-transaction-anchor", function () {
    var transactionID = $(this).parent().parent().find(".transactionID").val();
    $("#delete_transactionID").val(transactionID);
});