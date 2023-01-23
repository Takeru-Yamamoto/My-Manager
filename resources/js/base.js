import * as f from "./functions";

$(function ($) {
    $(SORTABLE).sortable({
        connectWith: '.sortable'
    });

    $(SORTABLE).disableSelection();

    $(document).on("click", SEARCH_ADDRESS_PREFECTURE_POSTCODE_BTN, function () {
        var postCodeInput = $(this).data("postCodeInput");
        var addressInput = $(this).data("addressInput");
        var prefectureSelect = $(this).data("prefectureSelect");

        var url = "https://zipcloud.ibsnet.co.jp/api/search";

        var postCode = $("#" + postCodeInput).val();

        if (postCode) {
            f.startSpinner();

            var callback = function (response) {
                f.stopSpinner();

                var result = response.results[0];

                $("#" + postCodeInput).val(result.zipcode.slice(0, 3) + "-" + result.zipcode.slice(-4));
                $("#" + addressInput).val(result.address1 + result.address2 + result.address3);
                if (prefectureSelect) $("#" + prefectureSelect).prop('selectedIndex', result.prefcode);
            }

            var setting = {
                url: url,
                type: "GET",
                cache: false,
                dataType: "json",
                data: {
                    zipcode: postCode
                },
            };

            f.fullSettingAjaxRequest(setting, callback);
        }
    });

    $(document).on("keyup", SEARCH_INPUT, function () {
        var value = $(this).val();

        var url = $(this).data("url");
        var model = $(this).data("model");
        var eloquent = $(this).data("eloquent");
        var from = $(this).data("from");
        var to = $(this).data("to");
        var limit = $(this).data("limit");
        var additional = $(this).data("additional");

        var data = {
            value: value,
            model: model,
            eloquent: eloquent,
            from: from,
            to: to,
            limit: limit,
            additional: additional
        };

        var duplicateCount = $(this).data("duplicateCount");

        var callback = function (response) {
            var html = "";

            html += "<div class='card'>"
            html += "<div class='card-header'>検索結果 (最大" + limit + "件)</div>"
            html += "<div class='card-body'>"
            html += "<div class='list-group'>"

            if (response.length) {
                for (var result of response) {
                    html += "<a class='list-group-item list-group-item-action search-result' data-model='" + model + "' data-from='" + from + "' data-to='" + to + "' data-duplicate-count='" + duplicateCount + "' data-value='" + result["to"] + "'>" + result["from"] + "</li>";
                }
            } else {
                html += "<p class='m-0'>検索結果がありません。</p>";
            }

            html += "</div></div></div>";

            $("#search-result" + duplicateCount).html(html);
        }

        if (value) f.jsonAjaxRequest(url, "POST", data, callback);
    });

    $(document).on("click", SEARCH_RESULT, function () {
        var model = $(this).data("model");
        var from = $(this).data("from");
        var to = $(this).data("to");
        var value = $(this).data("value");
        var duplicateCount = $(this).data("duplicateCount");

        $("#" + model + "_" + to).val(value);
        $("#" + model + "_" + from).val($(this).text());

        $("#search-result" + duplicateCount).html("");
    });

    $(document).on("change", COLORS_SELECT, function () {
        var color = $(this).val();

        $(this).removeClass(function (index, className) {
            return (className.match(/\bbg-\S+/g) || []).join(' ');
        });
        $(this).addClass("bg-" + color);
    });

    $(document).on("click", LOGOUT_BTN, function () {
        $(LOGOUT_FORM).trigger("submit");
    });

    $(document).on("click", START_SPINNER_BTN, function () {
        f.startSpinner();
    });

    $(document).on("click", STOP_SPINNER_BTN, function () {
        f.stopSpinner();
    });

    $(document).on("click", TOOLTIP, function () {
        $(this).toggleClass("tooltip-active");
    });

    $(document).on("click", FORM_SUBMIT_BTN, function () {
        var formId = $(this).data("form");

        $("#" + formId).trigger("submit");
    });

    $(document).on("click", MODAL_BTN, function () {
        $(MODAL).modal("show");
    });

    $(document).on("click", AJAX_MODAL_BTN, function () {
        var url = $(this).data("url");
        var type = $(this).data("type");
        var id = $(this).data("id");

        f.modalAjaxRequest(url, type, { id: id });
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