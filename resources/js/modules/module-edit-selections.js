import $ from "jquery"
import "./module-edit-page/answers"
import "./module-edit-page/type-steps"
import {
    notificationMessage,
    MsgError,
    MsgSuccess,
    MsgErrorInputFill
} from "./../fun"

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
    $(".module-header-item .form-field input").on('click', function () {
        if ($(this).prop("checked")) {
            $(this).parent().siblings(".select-wrap").slideDown();
        } else {
            $(this).parent().siblings(".select-wrap").slideUp();
        }
    });

    if (!$("#in-competences").prop("checked")) {
        $("#in-competences").parent().siblings(".select-wrap").slideUp();
    }
    if (!$("#out-competences").prop("checked")) {
        $("#out-competences").parent().siblings(".select-wrap").slideUp();
    }

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
    // let $wrap = $(this).parent().siblings(".checkboxes");
    let $wrap = $(this).closest(".module-header-inner").find(".checkboxes");
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
                  <input type="checkbox" class="checkboxes__input" name="complex" value="${response.id}"><span class="check"></span><span class="text">${val}</span></label>
                  <button class="btn-delete-competence btn-bg" type="button" data-competence-id="${response.id}"><span class="icon"><i class="fas fa-times"></i></span></button>
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


//СОхранение данных модуля
$(".module-header .btn-save-module").on("click", function () {
    let $parent = $(this).closest('.module-header');
    let moduleId = $parent.attr("data-module-id");
    let moduleTitle = $parent.find(".module-header-item__title-input").val();

    let competencesOutArr = [];
    let competencesInArr = [];

    if ($("#out-competences").prop("checked")) {
        $($parent.find(".module-header-item__out-competence .checkboxes .checkboxes__input")).each(function (index, element) {
            if ($(element).prop("checked")) {
                competencesOutArr.push($(element).val())
            }
        }); //Получили все выходные компетенции
    }
    if ($("#in-competences").prop("checked")) {
        $($parent.find(".module-header-item__in-competence .checkboxes .checkboxes__input")).each(function (index, element) {
            if ($(element).prop("checked")) {
                competencesInArr.push($(element).val())
            }
        }); //Получили все входные компетенции

    }
    console.log(moduleId, competencesInArr, competencesOutArr, moduleTitle);

    let url = "/profile/ajax-update-module-data";
    let type = "POST";
    let data = {
        "competences_out": competencesOutArr,
        "competences_in": competencesInArr,
        "title": moduleTitle,
        "id": moduleId,
    };

    if (moduleTitle != '') {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: type,
            url: url,
            data: data,
            success: function (response, status) {
                notificationMessage(response.msg);
            },
            error: function (response, status) {
                notificationMessage(response.msg, "error");
            },
        });
    } else {
        notificationMessage(MsgErrorInputFill, "error");
    }
})

//Модалка тестов
$("#btn-attach-test").on("click", function () {
    let $wrap = $(".modal-modules .modal-list-modules");
    let moduleId = $(this).attr("data-module-id");
    console.log("moduleId", moduleId);

    let url = "/profile/ajax-get-tests-for-module";
    let type = "GET";
    let data = {
        "module_id": moduleId
    };
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: type,
        url: url,
        data: data,
        success: function (response, status) {
            console.log(response);
            renderTestlListModules(response.tests, moduleId, $wrap);
            $wrap.attr("data-module-id", moduleId);
            $(".modal-modules").removeClass("modal--hidden");
        },
        error: function (response, status) {
            notificationMessage(response.msg, "error");
        },
    });
});

//Добавление теста к модулю через модалку
$(".edit-module .modal-list-modules").on('click', '.modal-list-modules-item', function () {
    let moduleId = $(this).attr("data-module-id");
    let testId = $(this).attr("data-test-id");

    let url = "/profile/ajax-attach-test-for-module";
    let type = "POST";
    let data = {
        "test_id": testId,
        "module_id": moduleId,
    };
    $(".modal-modules").addClass("modal--hidden");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: type,
        url: url,
        data: data,
        success: function (response, status) {
            notificationMessage(response.msg);
            console.log(response);
            $(".current-test").html(`
                Текущий тест: <a href="/profile/test/${response.test.id}/edit">${response.test.title}</a>
            `)
        },
        error: function (response, status) {
            notificationMessage(response.msg, "error");
        },
    });
});

//Поиск модулей в модалке
$(".edit-module .modal-modules .btn-search").on('click', function () {
    let $wrap = $(".modal-modules .modal-list-modules");
    let moduleId = $(this).attr("data-module-id");
    let text = $(this).siblings(".search").val();

    let url = "/profile/ajax-search-tests-for-module";
    let type = "GET";
    let data = {
        "text": text
    };
    if (text != '') {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: type,
            url: url,
            data: data,
            success: function (response, status) {
                renderTestlListModules(response.tests, moduleId, $wrap);
                $wrap.attr("data-module-id", moduleId);
            },
            error: function (response, status) {
                notificationMessage(response.msg, "error");
            },
        });
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


function renderTestlListModules(arr, moduleId, $wrap) {
    let str = '';
    for (let i = 0; i < arr.length; i++) {
        const element = arr[i];
        str += `
    <div class="modal-list-modules-item" data-test-id="${element.id}" data-module-id="${moduleId}">
      <h5 class="list-modules-item__title">${element.title}</h5>
      <button class="modal-list-modules-item__add-btn"><i class="fas fa-plus"></i></button>
    </div >
  `;
    }
    $wrap.empty();
    $wrap.html(str);
}
