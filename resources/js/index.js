import "./modules/gamburger"
import "./modules/slick"
import "./modules/graph"
import "./modules/module-edit-selections"
import "./modules/modal"
import "./modules/editor"
import "./modules/course-sections-edit"
import "./modules/test-page"
import "./modules/training-page"

import $ from "jquery"



$(document).ready(function () {

    $(".num-only").on("input", function (event) {
      this.value = this.value
        .replace(/^\./g, '')
        .replace(/\d\-/g, '$1')
        .replace(/\-\-/g, '$1')
        .replace(/[^0-9-.]/g, '')
        .replace(/(\..*)\./g, '$1');
    });

    // FORM DELETE COURSE course-header in profile
    $("#delete-course").on("click", function (event) {
        event.preventDefault();
        let del = confirm("Вы точно хотите удалить курс?");
        if (del) {
            document.getElementById('form-delete').submit();
        }
    });

    //FORM SAVE ALL SECTIONS AND MODULES
    $("#btn-save-sections").on("click", function (event) {
        event.preventDefault();
        // alert("sad")
        document.getElementById('form-save-sections').submit();

    });
    //

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
        $(".lesson-sidebar").removeClass("lesson-sidebar--active");
    });

    //course-edit
    $(".course-header-menu .btn").on('click', function () {
        $(this).siblings(".drop-down").slideToggle();
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

    $('.test-list .test-item-inner').on("click", function () {
        $(this).toggleClass("active")
            .siblings(".test-item-models")
            .slideToggle();
    });


    $('.notifications').on("click", ".btn-close", function () {
        $(this).closest(".notifications__item").slideUp(function () {
            $(this).remove();
        });
    });
});


// import "./../sass/style.scss"
