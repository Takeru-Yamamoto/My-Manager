function define(name, value) {
    Object.defineProperty(window, name, {
        get: function () {
            return value;
        },
        set: function () {
            throw name + " is already defined !!";
        },
    });
}

/* form */
define("LOGOUT_BTN", ".logout-btn");
define("LOGOUT_FORM", "#logout-form");
define("FORM_SUBMIT_BTN", ".form-submit-btn");

/* modal */
define("MODAL_MARKS", ".modal-marks");
define("MODAL_BTN", ".modal-btn");
define("AJAX_MODAL_BTN", ".ajax-modal-btn");

/* tooltip */
define("TOOLTIP", ".tooltip-original");

/* sortable */
define("SORTABLE", ".sortable");

/* spinner */
define("START_SPINNER_BTN", ".start-spinner-btn");
define("CV_SPINNER_OVERLAY", ".cv-spinner-overlay");

/* accordion */
define("ACCORDION_HEADER", ".accordion-header");
define("ACCORDION_OPEN", ".accordion-open");
define("ACCORDION_CLOSE", ".accordion-close");

/* input file */
define("INPUT_FILE_DESTROY", ".input-file-destroy");

/* common button */
define("DELETE_BTN", ".delete-btn");
define("FLG_CHANGE_BTN", ".flg-change-btn");

/* unique */
define("ATTENDANCE_CREATE_BTN", ".attendance-create-btn");
