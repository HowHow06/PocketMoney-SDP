$(document).on("click", ".delete-feedback-anchor", function () {
    var fbID = $(this).parent().parent().find(".feedbackID").val();
    $("#delete_feedbackID").val(fbID);
  });
  
  $(document).on("change", ".delete-feedback-anchor", function () {
    var fbID = $(this).parent().parent().find(".feedbackID").val();
    $("#delete_feedbackID").val(fbID);
  });
  
  $(document).ready(function () {
    $("body").niceScroll();
  });
  
  window.addEventListener("resize", function () {
    console.log("helo");
    $("body").niceScroll().resize();
  });