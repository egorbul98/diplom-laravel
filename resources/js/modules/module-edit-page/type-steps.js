import $ from "jquery"

$(".modal").on("click", ".overlay", function (e) {
  e.preventDefault();
  $(this).parent().submit();
});