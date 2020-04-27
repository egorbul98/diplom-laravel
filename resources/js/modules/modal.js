import $ from "jquery"

$(document).ready(function () {
  
  $(".modal-close").on("click", function () {
    $(this).closest(".modal").addClass("modal--hidden");
  });
  
  $("#btn-add-step").on("click", function () {
    $(".modal-step-types").removeClass("modal--hidden");
  });

  
  // $("#btn-add-step").on("click", function () {
  //   $(".modal-modules").removeClass("modal--hidden");
  // });

  
});