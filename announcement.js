// Get the modal
var modal = document.getElementById("AnnouncementModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

$(document).on("click", ".delete-announcement-anchor", function () {
  var announceID = $(this).parent().parent().find(".announcementID").val();
  $("#delete_announcementID").val(announceID);
});

$(document).on("change", ".delete-announcement-anchor", function () {
  var announceID = $(this).parent().parent().find(".announcementID").val();
  $("#delete_announcementID").val(announceID);
});

$(document).ready(function () {
  $("body").niceScroll();
});

window.addEventListener("resize", function () {
  console.log("helo");
  $("body").niceScroll().resize();
});

function validateform(ele) {
  var id = "#" + ele.id;
  var announcementDate = $(id).find(".form-announcement_date");

   //validate date
   if (announcement_date.length) {
    if (!validDate(announcement_date.val())) {
    //set the error msg to display
    announcementDate.parent().find(".error").css("display", "inline-block");
    //decrease some margin-bottom for the form group
    announcementDate.parent().css("margin-bottom", "0.2rem");
    return failValidation("Invalid Date!");
    } else {
      announcementDate.parent().find(".error").css("display", "none");
    //decrease some margin-bottom for the form group
    announcementDate.parent().css("margin-bottom", "1rem");
    } 
   }
}

$(document).on("click", ".edit-announcement-anchor", function () {
  var announcementID = $(this).parent().parent().find(".announcementID").val();
  var announcementDate = $(this).parent().parent().find(".announcement_date").val();
  var announcementTitle = $(this).parent().parent().find(".title").text();
  var announcementContent = $(this).parent().parent().find(".content").text();

  $("#edit_announcementID").val(announcementID);
  $("#edit_announcementDate").val(announcementDate);
  $("#edit_announcementTitle").val(announcementTitle);
  $("#edit_announcementContent").val(announcementContent);
});