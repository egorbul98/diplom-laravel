import $ from "jquery"
$(document).ready(function () {

  $(".recommend-list").slick({
    nextArrow: `<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></i></button>`,
    prevArrow: `<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></i></button>`
  });


  $('.lesson-page .lesson-content__slider').slick({
    infinite: false,
    slidesToShow: 3,
    slidesToScroll: 3,
    nextArrow: `<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></i></button>`,
    prevArrow: `<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></i></button>`,
    responsive: [{
        breakpoint: 1200,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
        }
      },
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        }
      },
    ]
  });
});