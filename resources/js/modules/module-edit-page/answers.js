import $ from "jquery"
import {
    notificationMessage,
    MsgError,
    MsgSuccess,
    MsgSuccessDel,
} from "./../../fun"


//Создание ответа
$("#btn-add-answer").on("click", function () {
    let $wrap = $(this).siblings(".wrap-step-answer");
    let stepId = $(this).attr("data-step-id");
    let stepTypeId = $(this).attr("data-type-step-id");
    let $parent = $(this).siblings(".step-answer-form");
    let value = $parent.find(".value").val();
    let error = $parent.find(".error").val();
    let data = {};
    let url;
    data.value = value;
    data.step_id = stepId;
    let str = ``;
    if (stepTypeId == 2) { //задача с текстовым ответом
        url = "/profile/ajax-add-answer-string";
    } else if (stepTypeId == 3) { //Числовая задача
        data.error = error;
        url = "/profile/ajax-add-answer-num";
    }

    if (value != '' && error != '') {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: url,
            data: data,
            success: function (response, status) {
                notificationMessage(MsgSuccess);
                str = `
                    <div class="step-answer">
                        <div class="step-answer-inner">
                            <div class="step-answer__item"><p>Правильный ответ: ${value}</p></div> `;
                if (stepTypeId == 3) {
                    str += `<div class="step-answer__item"><p>Допустимая погрешность: ${error}</p></div>`;
                }
                
                str += `</div>
                            <button class="btn btn-del" data-answer-id="${response.id}">Удалить</button>
                        </div>`;

                $wrap.append(str);
            },
            error: function (response, status) {
                notificationMessage(MsgError, "error");
            },
        });
    }

});

//Удалить ответ
$(".wrap-step-answer").on("click", ".btn-del", function () {
    let $wrap = $(this).closest(".wrap-step-answer");
    let id = $(this).attr("data-answer-id");
    let $item = $(this).closest(".step-answer");
    let stepTypeId = $wrap.siblings("#btn-add-answer").attr("data-type-step-id");
    let url;
    if (stepTypeId == 2) { //задача с текстовым ответом
        url = "/profile/ajax-del-answer-string";
    } else if (stepTypeId == 3) { //Числовая задача
        url = "/profile/ajax-del-answer-num";
    }
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: url,
        data: {
            "id": id,
        },
        success: function (response, status) {
            notificationMessage(MsgSuccessDel);
            $item.remove();
        },
        error: function (response, status) {
            notificationMessage(MsgError, "error");
        },
    });
});
