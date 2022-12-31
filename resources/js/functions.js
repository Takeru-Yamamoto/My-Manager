/* ajax */
function ajax(setting, successCallback, failureCallback, alwaysCallback) {
    $.ajax(setting).done((result) => successCallback(result)).fail((error) => failureCallback(error)).always(() => alwaysCallback());
}

export function ajaxRequest(url, type, data, successCallback = function (result) { console.log(result); }, failureCallback = function (error) { console.log(error); }, alwaysCallback = function () { }) {
    var setting = {
        url: url,
        type: type,
        cache: false,
        data: data,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    };

    ajax(setting, successCallback, failureCallback, alwaysCallback);
}

export function formAjaxRequest(url, type, formData, successCallback = function (result) { console.log(result); }, failureCallback = function (error) { console.log(error); }, alwaysCallback = function () { }) {
    var setting = {
        url: url,
        type: type,
        cache: false,
        processData: false,
        contentType: false,
        data: formData,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    };

    ajax(setting, successCallback, failureCallback, alwaysCallback);
}
// export { ajaxRequest, formAjaxRequest };


/* type */
function type(obj) {
    var className = Object.prototype.toString.call(obj);
    var matches = className.match(/^[objects(.*)]$/);
    if (matches.length > 0) {
        return matches[1].toLowerCase();
    } else {
        return className.toLowerCase();
    }
}

export function isNull(any) {
    return type(any) === "null";
}

export function isUndefined(any) {
    return type(any) === "undefined";
}

export function isString(any) {
    return type(any) === "string";
}

export function isNumber(any) {
    return type(any) === "number";
}

export function isBoolean(any) {
    return type(any) === "boolean";
}

export function isObject(any) {
    return type(any) === "object";
}

export function isArray(any) {
    return type(any) === "array";
}

export function isJSON(any) {
    return type(any) === "json";
}

export function isFunction(any) {
    return type(any) === "function";
}

export function isError(any) {
    return type(any) === "error";
}

export function isDate(any) {
    return type(any) === "date";
}

export function isMath(any) {
    return type(any) === "math";
}

export function isRegExp(any) {
    return type(any) === "regexp";
}

export function isInt(any) {
    return Number.isInteger(any);
}
// export { isNull, isUndefined, isString, isNumber, isBoolean, isObject, isArray, isJSON, isFunction, isError, isDate, isMath, isRegExp, isInt }


/* string */
export function nl2br(str) {
    str = str.replace(/\r\n/g, "<br>");
    str = str.replace(/(\n|\r)/g, "<br>");
    return str;
}

export function characterLimit(str, limit, ellipsis = "...") {
    if (str.length < limit) return str;

    return str.substr(0, limit) + ellipsis;
}
// export { nl2br, characterLimit }