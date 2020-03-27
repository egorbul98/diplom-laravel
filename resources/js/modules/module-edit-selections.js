import $ from "jquery"
import "./module-edit-page/answers"
import "./module-edit-page/type-steps"


let competencesIn = [];
let competencesOut = [];
let competences = [];

//Проверка на наличие нажатых checkboxes
$(document).ready(function () {
    $(".select-competences__right .checkboxes input").each(function (index, element) {
        if ($(element).attr("data-checked")) {
            $(element).trigger('click');
        }
    });
});


$('.edit-module .checkboxes').on('click', "input", function () {
    let $parent = $(this).closest(".select-competences__right")
        .siblings(".select-competences__left").children(".list");
    // let text = $(this).siblings(".text").text().replace(/\s+/g, " ");
    let text = $(this).siblings(".text").text();
    if ($(this).closest(".module-header-item").hasClass("module-header-item__in-competence")) {
        competences = competencesIn;
    } else {
        competences = competencesOut;
    }

    if ($(this).prop('checked')) {
        competences[text] = text;
    } else {
        delete competences[text];
    }
    renderCompetences($parent, competences);
});

//Добавление компетенции
$(".select-competences__right .btn-add").on('click', function () {
    let val = $(this).siblings("input").val();
    let sectionId = $(this).attr("data-section-id");
    let $wrap = $(this).parent().siblings(".checkboxes");
    if (val != '') {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/profile/ajax-add-competence",
            data: {
                "title": val,
                "section_id": sectionId
            },
            success: function (response, status) {
                notificationMessage("Компетенция успешно добавлена");
                let str = `<p class="flex-b">
                <label>
                  <input type="checkbox" name="complex" value="2"><span class="check"></span><span class="text">${val}</span></label>
                  <button class="btn-delete-competence btn-bg" type="button"><span class="icon"><i class="fas fa-times"></i></span></button>
              </p> `;
                $wrap.append(str);
            },
            error: function (response, status) {
                notificationMessage("Неверно введено название, либо название слишком длинное", "error");
            },
        });

    }
});

//Удаление компетенции
$(".select-custom").on("click", ".btn-delete-competence", function () {
    let del = confirm("Вы точно хотите удалить компетенцию?");

    let id = $(this).attr("data-competence-id");
    let $item = $(this).parent();
    let $checkbox = $(this).siblings("label").find("input");
    if (del) {
        if ($checkbox.prop("checked")) {
            $checkbox.trigger("click"); //Необходимо для удаления компетенций, входящих в данный модуль (чисто визуально)
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/profile/ajax-del-competence",
            data: {
                "id": id,
            },
          success: function (response, status) {
                notificationMessage(response);
                console.log("response");
                $item.remove();
            },
          error: function (response, status) {
                notificationMessage("Ошибка удаления", "error");
            },
        });
    }
});
//
$(".module-header-item .form-field input").on('click', function () {
    if ($(this).prop("checked")) {
        $(this).parent().siblings(".select-wrap").slideDown();
    } else {
        $(this).parent().siblings(".select-wrap").slideUp();
    }

});

function renderCompetences($parent, arr) {
    let str = '';

    for (const key in arr) {
        // console.log("внутри");
        str += `
            <div class="select-competences-item">
            <p class="text"><input type="text" name="competencestitles[]" value='${arr[key]}' class="input-bg" readonly></p>
            </div>
    `;
    }
    $($parent).html(str);
}


function notificationMessage(msg, type = "success") {
    let str = `
    <div class="notifications__item notifications__item--${type}"><span class="text">${msg}</span><span class="btn-close"><i class="fas fa-times"></i></span></div>
  `;
  
    $(".notifications").append(str);
  }