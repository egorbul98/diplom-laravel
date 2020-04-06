import $ from "jquery"

import {
    notificationMessage,
    MsgError,
    MsgSuccess,
    MsgErrorInputFill
} from "./../fun"

//удаление ответа
$(".answers-list-inner").on("click", ".icon--delete", function () {
    let lengthAnswers = $(this).closest(".answers-list-inner").find(".answer").length;
    if (lengthAnswers > 2) {
        $(this).closest(".answer").remove();
    }
});
//Создание ответа
$(".answers-list-inner").on("click", ".icon--add", function () {
    let $wrap = $(this).closest(".answers-list-inner");
    let str = `
  <div class="answer">
  <div class="answer-inner">
    <div class="check"><input type="checkbox" name="checkbox" value=""></div>
    <input type="text" name="text" value="" class="input-control text">
  </div>
  <div class="answer-icon-wrap">
    <div class="icon icon--delete"><i class="fas fa-times"></i></div>
    <div class="icon icon--add"><i class="fas fa-plus"></i></div>
  </div>
</div>
  `
    $wrap.append(str);
});

//Сохранение секции
$(".edit-test .btn-save-test-section").on("click", function () {
    let arrObjAnswers = getInputsAnswers();
    let title = $("#test-section-title").val();
    
    if (!arrObjAnswers|| title=='') {
        console.log("Нужно заполнить все поля и выбрать правильный ответ");
        return false;
  }
    let testSectionId = $(".btn-save-test-section").attr("data-test-section-id");
    let testId = $(this).closest(".test-sections*").attr("data-test-id");
    let url = "/profile/ajax-save-test-section";
    let type = "POST";
    let data = {
        "answers": arrObjAnswers,
        "test_id": testId,
        "title": title,
        "test_section_id": testSectionId,
    };

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
});
//Добавить новый вопрос
$(".edit-test .btn-add-test-section").on("click", function () {
  let $wrap = $(".edit-test .answers-list-inner");
  let testId = $(this).closest(".test-sections*").attr("data-test-id");
  let url = "/profile/ajax-add-test-section";
  let type = "POST";
  let data = {
      "test_id": testId,
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
        let linksWrap = $(".test-sections-links");
        linksWrap.append(`
            <div class="test-sections-links__item">
            <a href="#" class="test-sections-links__item-link" data-test-section-id="${response.testSection.id}">${(linksWrap.children().length + 1)}</a>
          </div>
        `);
        renderQuerstion(response.testSection,response.answerTestSections);
      },
      error: function (response, status) {
          notificationMessage(response.msg, "error");
      },
  });
});
//Удалить вопрос
$(".edit-test .btn-del-test-section").on("click", function () {
  let testSectionId = $(".btn-save-test-section").attr("data-test-section-id");
  let $block = $('.test-sections-content'); //Для появления и исчезновения
  $block.fadeOut(300);
  let url = "/profile/ajax-delete-test-section";
  let type = "POST";
  let data = {
      "test_section_id": testSectionId,
  };
  $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: type,
      url: url,
      data: data,
      success: function (response, status) {
        $(`.test-sections-links__item-link[data-test-section-id=${testSectionId}]`).parent().remove();
        let $items = $(".test-sections-links__item-link");
        $($items).first().trigger("click");
        $($items).each(function (index, element) {
          $(element).text(1+index);
        });
      },
      error: function (response, status) {
          notificationMessage(response.msg, "error");
      },
  });
});
//LINKS
$(".edit-test .test-sections-links").on("click", ".test-sections-links__item-link", function (e) {
  e.preventDefault();
  
  let $block = $('.test-sections-content'); //Для появления и исчезновения
  $block.fadeOut(300);
  let testSectionId = $(this).attr("data-test-section-id");
  console.log(testSectionId);
  let $item = $(this).closest(".test-sections-links__item");
  let url = "/profile/ajax-get-test-section";
  let type = "GET";
  let data = {
      "test_section_id": testSectionId,
  };
  
  
  $.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: type,
    url: url,
    data: data,
    success: function (response, status) {
      $item.addClass("active").siblings().removeClass("active");
      renderQuerstion(response.testSection, response.answers);
      $block.fadeIn(300);
    },
    error: function (response, status) {
        notificationMessage(response.msg, "error");
    },
});
});
$(".edit-test .btn-del-test-section").on("click", function () {

});

function renderQuerstion(arrTestSection, arrAnswers) { 
  let $wrap = $(".edit-test .answers-list-inner");
  let str = ``;
  $("#test-section-title").val(arrTestSection.title);
  $(".test-sections__img img").attr("src", arrTestSection.image);
  $(".btn-save-test-section").attr("data-test-section-id", arrTestSection.id);
  for (let i = 0; i < arrAnswers.length; i++) {
    const answer = arrAnswers[i];
    str += `
    <div class="answer">
    <div class="answer-inner">
    <div class="check"><input type="checkbox" name="checkbox" value=""`
    if (answer.correct == 1) { str += ` checked `;} 
    str += `></div>
        <input type="text" name="text" value="${answer.value}" class="input-control text">
      </div>
      <div class="answer-icon-wrap">
        <div class="icon icon--delete"><i class="fas fa-times"></i></div>
        <div class="icon icon--add"><i class="fas fa-plus"></i></div>
      </div>
    </div>`;
  }
  $wrap.html(str);
}

function getInputsAnswers() {
    let $wrap = $(".edit-test .answers-list-inner");
    let inputs = $wrap.find(".text");
    let arr = [];
    let isTrue = true;
    let val, correct, sumCorrect = 0;
    $(inputs).each(function (index, element) {
        val = $(element).val();
        if (val == '') {
            isTrue = false;
        }
        correct = $(element).siblings(".check").find("input").prop("checked");
        if (correct) {
            sumCorrect++;
        }
        arr.push({
            "value": val,
            "correct": correct
        });
    });
    if (!isTrue || sumCorrect == 0) {
        arr.length = 0;
        return false;
    }
    return arr;
}
