let fromDate = undefined;
let toDate = undefined;

function addLeave(employee_id, folder_name) {
    $("#modal_title").html("Add Leave(s)");
    $("#modalDialog").addClass("modal-lg");
    $("#formModalBody").html(
        leaveModalHtml(undefined, employee_id, folder_name)
    );
    $("#formModal").show();
}

function editLeave(leave, employee_id, folder_name) {
    if (!leave) {
        return addLeave();
    }

    fromDate = leave.from;
    toDate = leave.to;
    $("#modal_title").html("Update Leave");
    $("#modalDialog").addClass("modal-lg");
    $("#formModalBody").html(leaveModalHtml(leave, employee_id, folder_name));
    $("#formModal").show();
}

function leaveModalHtml(leave = undefined, employee_id, folder_name) {
    let htmlLeaveTypes = "";

    leaveTypes.forEach(leaveType => {
        htmlLeaveTypes += `<option value="${leaveType.id}" ${
            leave && leave.type_of_leave_id === leaveType.id ? "selected" : ""
        }>${leaveType.name}</option>`;
    });

    let form = "";
    if (leave) {
        form += `<form method="POST" action="/employees/${employee_id}/leaves/${leave.id}" id="editLeaveForm" name="editLeaveForm" enctype="multipart/form-data">`;
    } else {
        form += `<form method="POST" action="/employees/${employee_id}/leaves/" id="addLeaveForm" name="addLeaveForm" enctype="multipart/form-data">`;
    }
    form += `<div class="form-row">
                <div class="form-group col-md-4">
                    <label for="type_of_leave_id">Leave Type</label>
                    <select id="type_of_leave_id" name="type_of_leave_id" class="form-control" required>
                        <option value="">Choose...</option>
                        ${htmlLeaveTypes}
                    </select>
                    <div class="invalid-feedback" id="type_of_leave_id_error"></div>
                </div>
                <div class="form-group col-md-3">
                    <label for="from">Leave from</label>
                    <input type="date" class="form-control" value="${
                        leave && leave.from
                            ? moment(leave.from).format("YYYY-MM-DD")
                            : ""
                    }" name="from" id="from" required oninvalid="this.setCustomValidity('Leave from is required')" oninput="this.setCustomValidity('')" />
                    <div class="invalid-feedback" id="from_error"></div>
                </div>
                <div class="form-group col-md-3">
                    <label for="to">Leave to</label>
                    <input type="date" class="form-control" value="${
                        leave && leave.to
                            ? moment(leave.to).format("YYYY-MM-DD")
                            : ""
                    }" name="to" id="to" required oninvalid="this.setCustomValidity('Leave to is required')" oninput="this.setCustomValidity('')" />
                    <div class="invalid-feedback" id="to_error"></div>
                </div>
                <div class="form-group col-md-2">
                    <label for="total_days">Total days</label>
                    <input type="text" class="form-control" value="${
                        leave && leave.total_days ? leave.total_days : ""
                    }" name="total_days" id="total_days"  />
                    <div class="invalid-feedback" id="total_days_error"></div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="purpose">Purpose / Reason</label>
                    <textarea class="form-control" name="purpose" id="purpose" rows="4">${
                        leave && leave.purpose ? leave.purpose : ""
                    }</textarea>
                    <div class="invalid-feedback" id="purpose_error"></div>
                </div>
            </div>`;

    if (
        leave &&
        leave.attachment &&
        ["jpeg", "gif", "png", "bmp", "jpg", "JPG"].includes(
            leave.attachment.split(".").pop()
        )
    ) {
        form += `<div class="form-group row">
                <label for="Image" class="col-sm-6 col-form-label"></label>
                <div class="col-sm-6 d-flex justify-content-center">
                    <a href="/storage/images/applications/${folder_name}/${leave.attachment}" target="_blank">
                        <img src="/storage/images/applications/${folder_name}/${leave.attachment}" class="img-fluid modal-img" width="100px" alt="Image for edu">
                    </a>
                </div>
            </div>`;
    } else if (leave && leave.attachment) {
        form += `<div class="form-group row">
                <label for="Image" class="col-sm-4 col-form-label"></label>
                <div class="col-sm-8">
                    <a href="/storage/images/applications/${folder_name}/${
            leave.attachment
        }" target="_blank">${leave.attachment.slice(-7)}</a>
                </div>
            </div>`;
    }
    form += `<div class="form-row">
                <div class="col-sm-6">
                    <label for="authorized_by_name">Authorized by</label>
                    <input type="text" class="form-control" name="authorized_by_name" id="authorized_by_name" value="${
                        leave && leave.authenticated_by
                            ? leave.authenticated_by.name
                            : ""
                    }" />
                    <input type="hidden" class="form-control" name="authorized_by" id="authorized_by" value="${
                        leave && leave.authenticated_by
                            ? leave.authenticated_by.id
                            : ""
                    }" />
                    <div id="usersList" class="usersList"></div>
                    <div class="invalid-feedback" id="authorized_by_error"></div>
                </div>
                <div class="col-sm-6">
                    <label for="attachment">Attachment</label>
                    <input type="file" class="form-control" name="attachment" id="attachment" />
                    <div class="invalid-feedback" id="attachment_error"></div>
                </div>
            </div>

            <hr />
            <div class="form-group row">
                <div class="col-sm-4">
                    <button type="button" onclick="closeModal();" class="btn btn-secondary btn-lg btn-block">Close</button>
                </div>
                <div class="col-sm-8">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" id="btnSubmitLeave">Save</button>
                </div>
            </div>
        </form>`;

    return form;
}

$(document).on("submit", "#editLeaveForm", function(event) {
    event.preventDefault();
    const url = $(this).attr("action");
    ajaxLeaveReq(url, "put");
});

$(document).on("change", "#from", function(event) {
    fromDate = $(this).val();
    const diff = calculateDays(fromDate, toDate);
});

$(document).on("change", "#to", function(event) {
    toDate = $(this).val();
    calculateDays(fromDate, toDate);
});

function calculateDays(from, to) {
    let total_days;
    if (from && to) {
        const start = moment(from);
        const end = moment(to);
        total_days = end.diff(start, "days") + 1;
    }
    $("#total_days").val(total_days > 0 ? total_days : "");
}

$(document).on("submit", "#addLeaveForm", function(event) {
    event.preventDefault();
    const url = $(this).attr("action");
    ajaxLeaveReq(url);
});

function ajaxLeaveReq(url, type) {
    const btnSubmitLeave = $("#btnSubmitLeave");
    btnSubmitLeave.text("Please wait...").attr("disabled", true);
    let formData = new FormData();

    const image = document.getElementById("attachment");
    const file = image.files[0];

    formData.append("attachment", file);
    formData.append("type_of_leave_id", $("#type_of_leave_id").val());
    formData.append("from", $("#from").val());
    formData.append("to", $("#to").val());
    formData.append("total_days", $("#total_days").val());
    formData.append("purpose", $("#purpose").val());
    formData.append("authorized_by", $("#authorized_by").val());
    // formData.append("_token", "{{ csrf_token() }}");
    if (type === "put") {
        formData.append("_method", "put");
    }

    axios
        .post(url, formData)
        .then(res => {
            // if (res.data === 'success') {
            //     window.location.reload();
            // }
            btnSubmitLeave.text("Save").attr("disabled", false);
            console.log("response.data", res.data);
        })
        .catch(e => {
            btnSubmitLeave.text("Save").attr("disabled", false);
            console.log(e.response.data);
            console.log(e.response.data.errors);
            if (e.response && e.response.data) {
                const errors = e.response.data.errors;
                console.log("errors", errors);

                if (errors.type_of_leave_id) {
                    $("#type_of_leave_id").addClass("is-invalid");
                    $("#type_of_leave_id_error").html(errors.type_of_leave_id);
                } else {
                    $("#type_of_leave_id").removeClass("is-invalid");
                }

                if (errors.from) {
                    $("#from").addClass("is-invalid");
                    $("#from_error").html(errors.from);
                } else {
                    $("#from").removeClass("is-invalid");
                }

                if (errors.to) {
                    $("#to").addClass("is-invalid");
                    $("#to_error").html(errors.to);
                } else {
                    $("#to").removeClass("is-invalid");
                }
                if (errors.total_days) {
                    $("#total_days").addClass("is-invalid");
                    $("#total_days_error").html(errors.total_days);
                } else {
                    $("#total_days").removeClass("is-invalid");
                }

                if (errors.purpose) {
                    $("#purpose").addClass("is-invalid");
                    $("#purpose_error").html(errors.purpose);
                } else {
                    $("#purpose").removeClass("is-invalid");
                }

                if (errors.attachment) {
                    $("#attachment").addClass("is-invalid");
                    $("#attachment_error").html(errors.attachment);
                } else {
                    $("#attachment").removeClass("is-invalid");
                }
                if (errors.authorized_by) {
                    $("#authorized_by_name").addClass("is-invalid");
                    $("#authorized_by_error").html(errors.authorized_by);
                } else {
                    $("#authorized_by_name").removeClass("is-invalid");
                }
            }
        });
}
