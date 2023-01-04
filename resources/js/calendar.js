import { Calendar } from "@fullcalendar/core";
import interactionPlugin from "@fullcalendar/interaction";
import dayGridPlugin from "@fullcalendar/daygrid";
// import timeGridPlugin from "@fullcalendar/timegrid";
// import listPlugin from "@fullcalendar/list";
import * as f from "./functions";

var calendarEl = document.getElementById("calendar");

if (calendarEl) {
    var createFormUrl = calendarEl.dataset.createFormUrl;
    var createFormUrlType = calendarEl.dataset.createFormUrlType;
    var updateFormUrl = calendarEl.dataset.updateFormUrl;
    var updateFormUrlType = calendarEl.dataset.updateFormUrlType;
    var fetchUrl = calendarEl.dataset.fetchUrl;
    var fetchUrlType = calendarEl.dataset.fetchUrlType;

    let calendar = new Calendar(calendarEl, {
        // plugins: [interactionPlugin, dayGridPlugin, timeGridPlugin, listPlugin],
        plugins: [interactionPlugin, dayGridPlugin],
        initialView: "dayGridMonth",
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            // right: "dayGridMonth,timeGridWeek,listWeek",
            right: "",
        },
        locale: "ja",
        height: 'auto',
        selectable: true,
        select: function (info) {
            var data = {
                start_date: info.startStr,
                end_date: info.endStr,
            };
            var callback = function (response) {
                $(MODAL_MARKS).html(response);
                $("#modal").modal();
            };
            f.ajaxRequest(createFormUrl, createFormUrlType, data, callback);
        },
        events: function (info, successCallback, failureCallback) {
            var data = {
                start_date: $.datepicker.formatDate("yy-mm-dd", info.start),
                end_date: $.datepicker.formatDate("yy-mm-dd", info.end),
            };
            var callback = function (response) {
                calendar.removeAllEvents();
                successCallback(response);
            };
            f.ajaxRequest(fetchUrl, fetchUrlType, data, callback);
        },
        eventClick: function (info) {
            var data = {
                id: info.event.id,
            };
            var callback = function (response) {
                $(MODAL_MARKS).html(response);
                $("#modal").modal();
            };
            f.ajaxRequest(updateFormUrl, updateFormUrlType, data, callback);
        },
        eventMouseEnter (info) {
            $(info.el).popover({
                title: info.event.title,
                content: info.event.extendedProps.description,
                trigger: 'hover',
                placement: 'top',
                container: 'body',
                html: true
            });
        }
    });

    calendar.render();
}
