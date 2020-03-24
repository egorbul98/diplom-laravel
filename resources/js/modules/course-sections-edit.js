import $ from "jquery"

//Создание раздела
$(".course-sections #btn-create-section").on('click', function () {
  let $wrap = $(this).siblings(".course-sections-list");


  let str = `
  <div class="course-sections-item ">
  <div class="course-sections-item__inner section-edit shadow-light">
    <div class="section-edit-wrap">
      <div class="section-edit-wrap__num">1</div>
      <div class="section-edit-wrap__inputs">
        <div class="form-row">
          <div class="form-row__left">
            <p><label class="" for="title">Название<span class="required-input">*</span></label></p>
          </div>
          <div class="form-row__right form-field">
            <input class="input-control" maxlength="64" id="title" type="text">
          </div>
        </div>
        <div class="form-row">
          <div class="form-row__left">
            <p><label class="" for="title">Описание</p>
          </div>
          <div class="form-row__right form-field">
            <textarea name="" id="" cols="30" rows="5"></textarea>
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
        <button type="button" class="btn btn-create-module  list-modules-item__btn">Создать модуль</button>
      </div>
    </div>
  </div>
</div>
  `;

  $wrap.append(str);
});

//Создание модуля
$(".list-modules").on('click', '.btn-create-module', function () {
  let text = $(this).closest(".list-modules-item").children(".list-modules-item__inner").children(".input-create-module").val();
  let $wrap = $(this).closest(".list-modules-item").siblings(".list-modules-inner");
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

    $wrap.append(str);
  }

});