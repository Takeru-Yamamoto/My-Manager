import * as f from "./functions";

$(function ($) {
    $(SORTABLE).sortable({
        connectWith: '.sortable'
    });

    $(SORTABLE).disableSelection();

    $(document).on("click", LOGOUT_BTN, function () {
        $(LOGOUT_FORM).trigger("submit");
    });

    $(document).on("click", START_SPINNER_BTN, function () {
        $(CV_SPINNER_OVERLAY).fadeIn(300);
    });

    $(document).on("click", TOOLTIP, function () {
        $(this).toggleClass("tooltip-active");
    });

    $(document).on("click", FORM_SUBMIT_BTN, function () {
        var formId = $(this).data("form");

        $("#" + formId).trigger("submit");
    });

    $(document).on("click", MODAL_BTN, function () {
        $("#modal").modal();
    });

    $(document).on("click", AJAX_MODAL_BTN, function () {
        var url = $(this).data("url");
        var type = $(this).data("type");
        var id = $(this).data("id");

        var callback = function (response) {
            $(MODAL_MARKS).html(response);
            $("#modal").modal();
        }

        f.ajaxRequest(url, type, { id: id }, callback);
    });

    $(document).on("click", ACCORDION_HEADER, function () {
        var flg = $(this).attr("aria-expanded");

        $(ACCORDION_CLOSE).addClass("active");
        $(ACCORDION_OPEN).removeClass("active");

        if (flg === "false") {
            $(this)
                .children(".accordion-close")
                .removeClass("active");
            $(this)
                .children(".accordion-open")
                .addClass("active");
        }
    });

    $(document).on("click", INPUT_FILE_DESTROY, function () {
        var type = $(this).data("type");

        var elem = $("#input-file-" + type);
        elem.val(null);
        elem.trigger("change");
    });

    $(document).on("click", DELETE_BTN, function () {
        var url = $(this).data("url");
        var id = $(this).data("id");

        if (confirm("該当項目を削除してよろしいですか？")) {
            var callback = function () {
                if (!alert("該当項目の削除に成功しました。")) {
                    location.reload();
                }
            }

            f.ajaxRequest(url, "POST", { id: id }, callback);
        }
    });

    $(document).on("click", FLG_CHANGE_BTN, function () {
        var url = $(this).data("url");
        var id = $(this).data("id");
        var flg = $(this).data("flg");

        var callback = function () {
            location.reload();
        }

        f.ajaxRequest(url, "POST", { id: id, flg: flg }, callback);
    });
});