import $ from "jquery";
(function () {

  $(document).ready(function () {

      // let $tests = $(".lesson-content__tests .test");
      // $($tests).each(function (index, element) {
      //   if ($(element).find(".test__module").length == 0) {
      //     $(element).remove();
      //   }

    $(".create_review").click(function () {
      
      $(".modal-review").removeClass("modal--hidden");
    });

  });

})();
