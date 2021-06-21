function alert1(date) {
    alert("Did you enjoy your holidays?\n" + date + " has no data to edit.\nGood grief,You are really stupid.");
}

function alert2(date) {
    alert("Did you finally go insane?\nDid you think that " + date + " has data to delete?\nDo not joke,already your face looks like a joke.");
}

function alert3() {
    alert("Did you enjoy your holidays?\nThere has no data to edit.\nGood grief,You are really stupid.");
}

function alert4() {
    alert("Did you finally go insane?\nDid you think that There has data to delete?\nDo not joke,already your face looks like a joke.");
}

function alert_delete_attendance(id, date) {
    var res = confirm("Do you want to delete " + date + " Attendance Data?\nIt's a hassle to ask for confirmation many times,\nso I'll delete it the moment you press YES.");
    if (res) {
        location.href = "http://localhost/My_Manager/attendance/delete/" + id + "/" + date + "/";
    } else {
        alert("If you're scared, don't try to remove it from the beginning. Stupid guy.");
    }
}

function alert_delete_task(id, date) {
    var res = confirm("Do you want to delete " + date + " Task Data?\nIt's a hassle to ask for confirmation many times,\nso I'll delete it the moment you press YES.");
    if (res) {
        location.href = "http://localhost/My_Manager/task/delete/" + id + "/" + date + "/";
    } else {
        alert("If you're scared, don't try to remove it from the beginning. Stupid guy.");
    }
}

function alert_delete_deliverytime(id, date) {
    var res = confirm("Do you want to delete " + date + " Delivery Time Data?\nIt's a hassle to ask for confirmation many times,\nso I'll delete it the moment you press YES.");
    if (res) {
        location.href = "http://localhost/My_Manager/deliverytime/delete/" + id + "/" + date + "/";
    } else {
        alert("If you're scared, don't try to remove it from the beginning. Stupid guy.");
    }
}



function data_input(id, date, start_w, end_w, start_b, end_b, month_dates) {
    for (let i = 1; i <= month_dates; i++) {
        var chart_date = document.getElementById(i);
        if (chart_date.innerText == date) {
            html = '<tr class="table_cell" id="tr' + i + '">' +
                '<td id= "' + id + '"hidden>' + id + '</td>' +
                '<td class="td_cd" id="' + i + '">' + date + '</td>' +
                '<td class="td_cd">' + start_w + '</td>' +
                '<td class="td_cd">' + end_w + '</td>' +
                '<td class="td_cd">' + start_b + '</td>' +
                '<td class="td_cd">' + end_b + '</td>' +
                '<td id="wt' + id + '" class="td_cd">00:00:00</td>' +
                '<td id="bt' + id + '" class="td_cd">00:00:00</td>' +
                '<td class="function"><a href="http://localhost/My_Manager/attendance/edit_input/' + id + '/" class="button3-1">Edit</a></td>' +
                '<td class="function"><a onclick="' + 'alert_delete_attendance(' + id + ',' + "'" + date + "'" + ')" class="button3-2">Delete</a></td>' +
                '</tr>'
            document.getElementById("tr" + i).innerHTML = html;
        }
    }
}

function data_input_week(date, task_c) {
    for (let i = 1; i <= 7; i++) {
        var chart_date = document.getElementById("tw" + i);
        if (chart_date.innerText == date) {
            html = '<tr class="table_cell" id="tr_tw' + i + '">' +
                '<td class="td_cd" id="tw' + i + '">' + date + '</td>' +
                '<td class="td_cd">' + task_c + '</td>' +
                '</tr>'
            document.getElementById("tr_tw" + i).innerHTML = html;
        }
    }
}

function data_input_week_dt(date, content) {
    for (let i = 1; i <= 7; i++) {
        var chart_date = document.getElementById("dtw" + i);
        if (chart_date.innerText == date) {
            html = '<tr class="table_cell" id="tr_dtw' + i + '">' +
                '<td class="td_cd" id="dtw' + i + '">' + date + '</td>' +
                '<td class="td_cd">' + content + '</td>' +
                '</tr>'
            document.getElementById("tr_dtw" + i).innerHTML = html;
        }
    }
}

function data_input_month(month_dates, date, task_c) {
    for (let i = 1; i <= month_dates; i++) {
        var chart_date = document.getElementById("tm" + i);
        if (chart_date.innerText == date) {
            html = '<tr class="table_cell" id="tr_tm' + i + '">' +
                '<td class="td_cd" id="tm' + i + '">' + date + '</td>' +
                '<td class="td_cd">' + task_c + '</td>' +
                '</tr>'
            document.getElementById("tr_tm" + i).innerHTML = html;
        }
    }
}

function data_input_month_dt(month_dates, date, content) {
    for (let i = 1; i <= month_dates; i++) {
        var chart_date = document.getElementById("dtm" + i);
        if (chart_date.innerText == date) {
            html = '<tr class="table_cell" id="tr_dtm' + i + '">' +
                '<td class="td_cd" id="dtm' + i + '">' + date + '</td>' +
                '<td class="td_cd">' + content + '</td>' +
                '</tr>'
            document.getElementById("tr_dtm" + i).innerHTML = html;
        }
    }
}

function data_input_month2(month_dates, id, date, task_c) {
    for (let i = 1; i <= month_dates; i++) {
        var chart_date = document.getElementById("tm" + i);
        if (chart_date.innerText == date) {
            html = '<tr class="table_cell" id="tr_tm' + i + '">' +
                '<td id= "' + id + '"hidden>' + id + '</td>' +
                '<td class="function2_td_cd" id="tm' + i + '">' + date + '</td>' +
                '<td class="td_cd">' + task_c + '</td>' +
                '<td class="function"><a href="http://localhost/My_Manager/task/edit_input/' + id + '/" class="button3-1">Edit</a></td>' +
                '<td class="function"><a onclick="' + 'alert_delete_task(' + id + ',' + "'" + date + "'" + ')" class="button3-2">Delete</a></td>' +
                '</tr>'
            document.getElementById("tr_tm" + i).innerHTML = html;
        }
    }
}

function data_input_month2_dt(month_dates, id, date, content) {
    for (let i = 1; i <= month_dates; i++) {
        var chart_date = document.getElementById("dtm" + i);
        if (chart_date.innerText == date) {
            html = '<tr class="table_cell" id="tr_dtm' + i + '">' +
                '<td id= "' + id + '"hidden>' + id + '</td>' +
                '<td class="function2_td_cd" id="dtm' + i + '">' + date + '</td>' +
                '<td class="td_cd">' + content + '</td>' +
                '<td class="function"><a href="http://localhost/My_Manager/deliverytime/edit_input/' + id + '/" class="button3-1">Edit</a></td>' +
                '<td class="function"><a onclick="' + 'alert_delete_deliverytime(' + id + ',' + "'" + date + "'" + ')" class="button3-2">Delete</a></td>' +
                '</tr>'
            document.getElementById("tr_dtm" + i).innerHTML = html;
        }
    }
}

function calculation(id, date, start_w, end_w, start_b, end_b) {
    if (end_w != "00:00:00") {
        wt = new Date(date + " " + end_w).getTime() - new Date(date + " " + start_w).getTime();
        wt_h = Math.floor(wt / (60 * 60 * 1000));
        wt_m = Math.floor((wt - (wt_h * 60 * 60 * 1000)) / (60 * 1000));
        wt_s = Math.floor((wt - ((wt_h * 60 * 60 * 1000) + (wt_m * 60 * 1000))) / (1000));
        html_wt = wt_h + "h" + wt_m + "m" + wt_s + "s";
        document.getElementById("wt" + id).textContent = html_wt;
    }
    if (end_b != "00:00:00") {
        bt = new Date(date + " " + end_b).getTime() - new Date(date + " " + start_b).getTime();
        bt_h = Math.floor(bt / (60 * 60 * 1000));
        bt_m = Math.floor((bt - (bt_h * 60 * 60 * 1000)) / (60 * 1000));
        bt_s = Math.floor((bt - ((bt_h * 60 * 60 * 1000) + (bt_m * 60 * 1000))) / (1000));
        html_bt = bt_h + "h" + bt_m + "m" + bt_s + "s";
        document.getElementById("bt" + id).textContent = html_bt;
    }
}