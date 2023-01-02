import { Calendar } from "@fullcalendar/core";
import interactionPlugin from "@fullcalendar/interaction";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
import * as f from "./functions";

var calendarEl = document.getElementById("calendar");
var createFormUrl = calendarEl.dataset.createFormUrl;
var createFormUrlType = calendarEl.dataset.createFormUrlType;
var fetchUrl = calendarEl.dataset.fetchUrl;
var fetchUrlType = calendarEl.dataset.fetchUrlType;

let calendar = new Calendar(calendarEl, {
    // plugins: [interactionPlugin, dayGridPlugin, timeGridPlugin, listPlugin],
    plugins: [interactionPlugin, dayGridPlugin],
    initialView: "dayGridMonth",
    headerToolbar: {
        // left: "prev,next today",
        left: "",
        center: "title",
        // right: "dayGridMonth,timeGridWeek,listWeek",
        right: "prev,next today",
    },
    locale: "ja",

    selectable: true,
    select: function (info) {
        var data = {
            start_date: info.start.valueOf(),
            end_date: info.end.valueOf(),
        };
        var callback = function (response) {
            $(MODAL_MARKS).html(response);
            $("#modal").modal();
        };
        f.ajaxRequest(createFormUrl, createFormUrlType, data, callback);
    },
    events: function (info, successCallback, failureCallback) {
        var data = {
            start_date: info.start.valueOf(),
            end_date: info.end.valueOf(),
        };
        var callback = function (response) {
            calendar.removeAllEvents();
            successCallback(response.data);
        };
        f.ajaxRequest(fetchUrl, fetchUrlType, data, callback);
    },
});

calendar.render();