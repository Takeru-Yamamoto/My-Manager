import * as f from "./functions";

$(function ($) {
    $(document).on("click", ATTENDANCE_CREATE_BTN, function () {
        var url = $(this).data("url");
        var type = $(this).data("type");
        var relation = $(this).data("relation");

        var callback = function (response) {
            location.reload();
        }

        f.ajaxRequest(url, "POST", { type: type, relation: relation }, callback);
    });

    $(document).on("click", TASK_COLOR_CREATE_BTN, function () {
        var url = $(this).data("url");

        var color = $("#color").val();
        var description = $("#description").val();

        var callback = function (response) {
            if (!alert(response)) {
                location.reload();
            }
        }

        f.ajaxRequest(url, "POST", { color: color, description: description }, callback);
    });

    $(document).on("click", TASK_COLOR_UPDATE_BTN, function () {
        var url = $(this).data("url");
        var id = $(this).data("id");

        var color = $("#color" + id).val();
        var description = $("#description" + id).val();

        var callback = function (response) {
            if (!alert(response)) {
                location.reload();
            }
        }

        f.ajaxRequest(url, "POST", { id: id, color: color, description: description }, callback);
    });
});