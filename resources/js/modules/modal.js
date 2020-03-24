import $ from "jquery"

$(document).ready(function () {
  
  $(".modal-close").on("click", function () {
    $(this).closest(".modal").addClass("modal--hidden");
  });
  $(".step-list__item--add").on("click", function () {
    $(".modal").removeClass("modal--hidden");
  });
});