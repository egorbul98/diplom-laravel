import $ from "jquery";

$(document).ready(function () {
  $(".tabs-container .tab-btn").click(function () {
    let data = $(this).attr("data-tab");
    let $parent = this.closest(".tabs-container");
    $(this).addClass("active").siblings().removeClass("active");
    $($parent).find(".tab").removeClass("tab--active")
      .siblings(".tab[data-tab=" + data + "]").addClass("tab--active");
   
    // $($parent).find(".tab").fadeOut( "slow", function() {
      
    // });
    
  });
});