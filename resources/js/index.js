
import "slick-carousel"
import "./../libs/editor/summernote-lite"

import "./modules/gamburger"
import "./modules/slick"
import "./modules/select"
import "./modules/modal"
import $ from "jquery"


$(document).ready(function () {
  //editor
  $('#summernote').summernote({
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'clear']],
      ['fontname', ['fontname']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['insert', ['link', 'picture']],
      ['view', ['fullscreen', 'codeview', 'help']],
    ]
});


  //
  $(".btn-gamburger").on("click", function () {
    $(".header-wrap").toggleClass("active");
  });
  $(".filter-btn").on("click", function () {
    $(".filter .drop-down").slideToggle();
  });
  $(".header-top .auth .user").on("click", function () {
    $(".header-top .auth .drop-down").slideToggle();
  });

  //LESSON_PAGE
  $(".lesson-page .btn-gamburger").on("click", function () {
    $(".lesson-sidebar").toggleClass("lesson-sidebar--active");
  });
  $(".lesson-page .lesson-header__name").on("click", function () {
    $(this).siblings(".drop-down")
      .slideToggle();
  });

  $('.lesson-page .section').on("click", function () {
    // $('.notifications').toggleClass("notifications--active");
    $(".lesson-sidebar").removeClass("lesson-sidebar--active");
  });

  //course-edit
  $(".course-header-menu .btn").on('click', function () {
    $(this).siblings(".drop-down").slideToggle();
  });


  $(".list-modules-inner").on('click', ".btn-delete", function () {
    let del = confirm("Вы точно хотите удалить модуль?");
    if (del) {
      $(this).closest(".list-modules-item").remove();
    }
  });


  $(".list-modules .btn-create-module").on('click', function () {
    let text = $(this).closest(".list-modules-item").children(".list-modules-item__inner").children(".input-create-module").val();
    let $result = $(this).closest(".list-modules-item").siblings(".list-modules-inner");
    let str = '';
    if (text != "") {
      str += `
      <div class="list-modules-item">
        <h4 class="list-modules-item__inner">
         
          <input type="text" class="input-control input-bg" placeholder="Название модуля" value="${text}">
        </h4>
        
        <p class="list-modules-item__steps"><span>0</span> шагов</p>
        <div class="list-modules-item__btns">
          <a href="#" class="btn ">Редактировать</a>
          <button type="button" class="btn-delete"><i class="fas fa-times"></i></button>
        </div>
      </div>
      `;

      $result.append(str);
    }

  });

  if ($("body").hasClass("editor")) {
    window.onbeforeunload = function (evt) {
      var message = "вйцв";
      if (typeof evt == "undefined") {
        evt = window.event;
      }
      if (evt) {
        evt.returnValue = message;
      }
      return message;
    }
  }
  

  //------------

  $(".btn-close").on("click", function () {
    $(".header-wrap").removeClass("active");
  });


  $('.item-page .item-sections-item').on("click", function () {
    $(this).toggleClass("active")
      .children(".item-sections-item__cometencies")
      .slideToggle();
  });

  //NOTIFICATION
  // $('.section').on("click", function () {
  //   // $('.notifications').toggleClass("notifications--active");
  //   $('.notifications').slideToggle();
  // });
});


// import "./../sass/style.scss"