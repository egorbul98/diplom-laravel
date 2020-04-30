import $ from "jquery"

import {
    notificationMessage,
    MsgError,
    MsgSuccess,
    MsgSuccessDel
} from "./../fun"


$(".admin .btn-add-role").click(function (e) {
    let $modal = $(".modal-roles");
    let userId = this.getAttribute("data-user-id");
    let $username = $modal.find(".username");

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/admin/ajax-get-roles-user",
        data: {
            "user_id": userId
        },
        dataType: "JSON",
        success: function (response) {
          let $inputs = $modal.find("input[type='checkbox']").each(function (index, input) {
              input.checked = false;
              response.roles.forEach(role => {
                    if (role.id == input.id.slice(5)) {
                        input.checked = true;
                    }
                });
          });
          $username.text(response.username);
          $modal.find(".user_id").val(response.user_id);
          $modal.removeClass("modal--hidden");
        },
        error: function (response) {
            notificationMessage(response.msg, "error");
        }
    });
});

$(".admin .btn-user-roles-save").click(function (e) {

    let data = $(this).closest(".form-roles").serializeArray();
    
    $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "POST",
      url: "/admin/ajax-save-roles-user",
      data: data,
      dataType: "JSON",
      success: function (response) {
        console.log(response);
        
        notificationMessage(response.msg);
      },
      error: function (response) {
          notificationMessage(response.msg, "error");
      }
    });
  
});
