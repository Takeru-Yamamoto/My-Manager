import * as f from "./functions";

$(function ($) {
    $(document).on("click", ATTENDANCE_CREATE_BTN, function () {
        var url      = $(this).data("url");
        var type     = $(this).data("type");
        var relation = $(this).data("relation");

        var callback = function (response) {
            location.reload();
        }

        f.ajaxRequest(url, "POST", { type: type, relation: relation }, callback);
    });
});