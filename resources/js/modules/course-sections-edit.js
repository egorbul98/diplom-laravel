import $ from "jquery"

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
                notificationMessage("Раздел успешно создан");

                let lengthItems = $wrap.children().length
                let str = `
                <div class="course-sections-item ">
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
                notificationMessage("Неверно введены данные формы", "error");
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
                notificationMessage(response);

                $item.remove();
                $(".course-sections-item .section-edit-wrap__num").each(function (index, element) {
                    $(element).html(++index);
                });
            },
            error: function (response, status) {
                notificationMessage("Ошибка удаления", "error");
            },
        });
    }
});

//Создание модуля
$(".course-sections").on('click', '.btn-create-module', function () {
    let $wrap = $(this).closest(".list-modules-item").siblings(".list-modules-inner");
    let title = $(this).closest(".list-modules-item").find(".input-create-module").val();
    let sectionId = $(this).attr("data-section-id");
    let sectionNum = $(this).closest(".course-sections-item ").find(".section-edit-wrap__num").text();
    let str = '';

    if (title != "") {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/profile/ajax-add-module",
            data: {
                "title": title,
                "section_id": sectionId
            },
            success: function (response, status) {
                notificationMessage("Модуль успешно добавлен");
                let lengthItems = $wrap.children().length

                let str = `
              <div class="list-modules-item">
                <h4 class="list-modules-item__inner">
                  <span class="num">${sectionNum}.${++lengthItems}</span>
                  <input type="text" class="input-control input-bg" name="module-title[${response.id}]" value="${title}" placeholder="Название модуля">
                </h4>
                <p class="list-modules-item__steps"><span>11</span> шагов</p>
                <div class="list-modules-item__btns">
                  <a href="#" class="btn ">Редактировать</a>
                  <button type="button" class="btn-delete-module" data-module-id="${response.id}"><i class="fas fa-times"></i></button>
                </div>
              </div>
            `;
                $wrap.append(str);
            },
            error: function (response, status) {
                notificationMessage("Неверно введено название формы, либо название слишком динное", "error");
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
            },
          success: function (response, status) {
            console.log("suc");
                notificationMessage(response);
                console.log("response");
                
                $item.remove();

                $section.find(".list-modules-item .num").each(function (index, element) {
                    $(element).html(`${sectionNum}.${++index}`);
                });
            },
          error: function (response, status) {
              console.log("asddasd");
              
                notificationMessage("Ошибка удаления", "error");
            },
        });
    }
});




function notificationMessage(msg, type = "success") {
  let str = `
  <div class="notifications__item notifications__item--${type}"><span class="text">${msg}</span><span class="btn-close"><i class="fas fa-times"></i></span></div>
`;

  $(".notifications").append(str);
}