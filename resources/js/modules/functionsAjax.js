function notificationMessage(msg, type = "success") {
  let str = `
  <div class="notifications__item notifications__item--${type}"><span class="text">${msg}</span><span class="btn-close"><i class="fas fa-times"></i></span></div>
`;

  $(".notifications").append(str);
}