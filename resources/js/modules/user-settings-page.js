import $ from "jquery"

import {
    notificationMessage,
    MsgError,
    MsgSuccess,
    MsgErrorInputFill
} from "./../fun"


//Сохранение аватарки
$(".edit-user #image").on("input", function () {
    let file = document.getElementById("image").files;
    let data = new FormData();
    data.append("image", file[0]);
    let image = $(".edit-user #user-avatar");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/profile/ajax-upload-avatar",
        data: data,
        dataType: "JSON",
        processData: false,
        contentType: false,
        success: function (response) {
          notificationMessage(response.msg);
          console.log(response.image);
          
            image.attr("src", response.image);
        },
        error: function (response) {
            notificationMessage(response.msg, "error");
        }
    });
});
