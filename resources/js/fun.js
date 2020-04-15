import $ from "jquery"

export let MsgSuccess = "Успешно сохранено"
export let MsgSuccessDel = "Удаление прошло успешно"
export let MsgError = "Ошибка ввода формы"
export let TotalMsgError = "Ошибка"
export let MsgErrorInputFill = "Заполните все поля"

export function notificationMessage(msg, type = "success") {
    let str = `
      <div class="notifications__item notifications__item--${type}" style="display:none"><span class="text">${msg}</span><span class="btn-close"><i class="fas fa-times"></i></span></div>
    `;

  $(str).appendTo(".notifications").slideDown();
}
