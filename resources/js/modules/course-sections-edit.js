import $ from "jquery"

import {
  notificationMessage,
  MsgError,
  MsgSuccess,
  MsgSuccessDel
} from "./../fun"

//Создание раздела
$(".course-sections #btn-create-section").on('click', function () {
    let $wrap = $(this).closest(".course-sections").find(".course-sections-list");

    let title = $(this).siblings(".section-edit-wrap").find("#title").val();
    let description = $(this).siblings(".section-edit-wrap").find(" #description").val();
    let courseId = +$(this).attr("data-id-course");

    if (title != "" && description != "" && courseId != "") {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/profile/ajax-add-section",
            data: {
                "title": title,
                "description": description,
                "course_id": courseId
            },
            success: function (response, status) {
                notificationMessage(response.msg);

                let lengthItems = $wrap.children().length
                let str = `
                <div class="course-sections-item" data-section-id="${response.id}">
                <div class="course-sections-item__inner section-edit shadow-light">
                  <div class="section-edit-wrap">
                    <div class="section-edit-wrap__num">${++lengthItems}</div>
                    <div class="section-edit-wrap__inputs">
                      <div class="">
                       
                        <div class="form-field">
                          <input class="input-control  input-title" name="title[${response.id}]" id="title" type="text" maxlength="128" value="${title}">
                        </div>
                      </div>
              
                      <div class="">
                        <div class="form-field">
                        <textarea name="description[${response.id}]" id="" cols="30" rows="5" class="description">${description}</textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="list-modules shadow-light">
                  <div class="list-modules-item">
                    <h4 class="list-modules-item__inner">
                      <input type="text" class="input-control input-create-module" placeholder="Название модуля">
                    </h4>
                    <div class="list-modules-item__btns">
                      <button type="button" class="btn btn-create-module  list-modules-item__btn"  data-section-id="${response.id}">Создать модуль</button>
                      <button type="button" class="btn btn-add-module  list-modules-item__btn" data-section-id="${response.id}">Добавить существующий</button>
                    </div>
                  </div>
                  <div class="list-modules-inner">
                    
                  </div>
                </div>
                <button type="button" class="btn-delete-section" data-section-id="${response.id}"><i class="fas fa-times"></i></button>
              </div>
              
                  `;

                $wrap.append(str);
            },
            error: function (response, status) {
                notificationMessage(response.msg, "error");
            },
        });
    }
});

//Удалить раздел
$(".course-sections").on("click", ".btn-delete-section", function () {
    let id = $(this).attr("data-section-id");
    let $item = $(this).closest(".course-sections-item");
    let del = confirm("Вы точно хотите удалить раздел?");
    if (del) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/profile/ajax-del-section",
            data: {
                "id": id,
            },
            success: function (response, status) {
                notificationMessage(response.msg);

                $item.remove();
                $(".course-sections-item .section-edit-wrap__num").each(function (index, element) {
                    $(element).html(++index);
                });
            },
            error: function (response, status) {
                notificationMessage(response.msg, "error");
            },
        });
    }
});

//Создание модуля
$(".course-sections").on('click', '.btn-create-module', function () {
    let $wrap = $(this).closest(".list-modules-item").siblings(".list-modules-inner");
    let title = $(this).closest(".list-modules-item").find(".input-create-module").val();
    let sectionId = $(this).attr("data-section-id");
    let authorId = $(this).closest(".course-sections-list").attr("data-author-id");
    let courseId = $(this).closest(".course-sections").attr("data-course-id");
    let sectionNum = $(this).closest(".course-sections-item ").find(".section-edit-wrap__num").text();
    let str = '';
    console.log(courseId);

    if (title != "") {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/profile/ajax-add-module",
            data: {
                "title": title,
                "section_id": sectionId,
                "author_id": authorId,
                "course_id": courseId,
            },
            success: function (response, status) {
                notificationMessage(response.msg);
                let lengthItems = $wrap.children().length

                let str = `
              <div class="list-modules-item">
                <h4 class="list-modules-item__inner">
                  <span class="num">${sectionNum}.${++lengthItems}</span>
                  <input type="text" class="input-control input-bg" name="module-title[${response.id}]" value="${title}" placeholder="Название модуля">
                </h4>
                <p class="list-modules-item__steps"><span>0</span> шагов</p>
                <div class="list-modules-item__btns">
                  <a href="/profile/course/module/${response.id}/section/${sectionId}/" class="btn ">Редактировать</a>
                  <button type="button" class="btn-delete-module" data-module-id="${response.id}"><i class="fas fa-times"></i></button>
                </div>
              </div>
            `;
                $wrap.append(str);
            },
            error: function (response, status) {
                notificationMessage(response.msg, "error");
            },
        });
        $wrap.append(str);
    }

});

//Удалить модуль
$(".course-sections").on("click", ".btn-delete-module", function () {
    let id = $(this).attr("data-module-id");
    let $item = $(this).closest(".list-modules-item");
    let del = confirm("Вы точно хотите удалить модуль?");
    let sectionId = $(this).closest(".list-modules").attr("data-section-id");
    let $section = $(this).closest(".course-sections-item");
    let sectionNum = $section.find(".section-edit-wrap__num").text();

    if (del) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/profile/ajax-del-module",
            data: {
                "id": id,
                "section_id": sectionId,
            },
            success: function (response, status) {
                console.log("suc");
                notificationMessage(response.msg);
                console.log("response");

                $item.remove();

                $section.find(".list-modules-item .num").each(function (index, element) {
                    $(element).html(`${sectionNum}.${++index}`);
                });
            },
            error: function (response, status) {
                console.log("asddasd");

                notificationMessage(response.msg, "error");
            },
        });
    }
});

//Открытие модульного окна для Добавления существующего модуля
$(".course-sections").on('click', '.btn-add-module', function () {
    let $wrap = $(".modal-modules .modal-list-modules");
    let sectionId = $(this).attr("data-section-id");

    let url = "/profile/ajax-list-modules-section";
    let type = "GET";
    let data = {
        "section_id": sectionId
    };
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: type,
        url: url,
        data: data,
        success: function (response, status) {
            renderModalListModules(response.modules, sectionId, $wrap);
            $wrap.attr("data-section-id", sectionId);
            $(".modal-modules").removeClass("modal--hidden");
        },
        error: function (response, status) {
            notificationMessage(response.msg, "error");
        },
    });
});

//Поиск модулей в модалке
$(".edit-course .modal-modules .btn-search").on('click', function () {
    let $wrap = $(".modal-modules .modal-list-modules");
    let sectionId = $wrap.attr("data-section-id");
    let text = $(this).siblings(".search").val();

    let url = "/profile/ajax-search-modules-section";
    let type = "GET";
    let data = {
        "section_id": sectionId,
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
                renderModalListModules(response.modules, sectionId, $wrap);
            },
            error: function (response, status) {
                notificationMessage(response.msg, "error");
            },
        });
    }

});


//Добавление существующего модуля
$(".edit-course .modal-list-modules").on('click', '.modal-list-modules-item', function () {
  let moduleId = $(this).attr("data-module-id");
  let sectionId = $(this).attr("data-section-id");
let courseId = $(".course-sections").attr("data-course-id");
    
  let title = $(this).children(".list-modules-item__title").text();
  console.log(moduleId, sectionId, title);
  let $wrap = $(`.course-sections-item[data-section-id=${sectionId}]`).find(".list-modules-inner");
  let sectionNum = $(`.course-sections-item[data-section-id=${sectionId}]`).find(".section-edit-wrap__num").text();
  let url = "/profile/ajax-add-module-in-section";
  let type = "POST";
  let data = {
      "section_id": sectionId,
      "module_id": moduleId,
      "course_id": courseId,
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
        let lengthItems = $wrap.children().length
        let str = `
              <div class="list-modules-item">
                <h4 class="list-modules-item__inner">
                  <span class="num">${sectionNum}.${++lengthItems}</span>
                  <input type="text" class="input-control input-bg" name="module-title[${response.module.id}]" value="${response.module.title}" placeholder="Название модуля">
                </h4>
                <p class="list-modules-item__steps"><span>${response.step_count}</span> шагов</p>
                <div class="list-modules-item__btns">
                  <a href="/profile/course/module/${response.module.id}/section/${sectionId}/" class="btn ">Редактировать</a>
                  <button type="button" class="btn-delete-module" data-module-id="${response.module.id}"><i class="fas fa-times"></i></button>
                </div>
              </div>
            `;
                $wrap.append(str);
      },
      error: function (response, status) {
          notificationMessage(response.msg, "error");
      },
  });
});

function renderModalListModules(arr, sectionId, $wrap) {
    let str = '';
    for (let i = 0; i < arr.length; i++) {
        const element = arr[i];
        str += `
      <div class="modal-list-modules-item" data-module-id="${element.id}" data-section-id="${sectionId}">
        <h5 class="list-modules-item__title">${element.title}</h5>
        <button class="modal-list-modules-item__add-btn"><i class="fas fa-plus"></i></button>
      </div >
    `;
    }
    $wrap.empty();
    $wrap.html(str);
}
