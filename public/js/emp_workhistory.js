function addWorkHistory(employee_id, folder_name) {
    $("#modal_title").html("Add Work History");
    $("#modalDialog").removeClass("modal-lg");
    $("#formModalBody").html(
        workHistoryHTML(undefined, employee_id, folder_name)
    );
    $("#formModal").show();
}

function editWorkHistory(workHistory, employee_id, folder_name) {
    $("#modal_title").html("Update Work History");
    $("#modalDialog").removeClass("modal-lg");
    $("#formModalBody").html(
        workHistoryHTML(workHistory, employee_id, folder_name)
    );
    $("#formModal").show();
}

function workHistoryHTML(workHistory, employee_id, folder_name) {
    let form = "";
    let action = "";
    if (workHistory) {
        form += `<form method="POST" action="/employees/${employee_id}/workhistory/${workHistory.id}" id="editWorkHistoryForm" name="editWorkHistoryForm" enctype="multipart/form-data">`;
    } else {
        form += `<form method="POST" action="/employees/${employee_id}/workhistory" id="addWorkHistoryForm" name="addWorkHistoryForm" enctype="multipart/form-data">`;
    }
    form += `<div class="form-group row">
                <label for="job_title" class="col-sm-4 col-form-label">Job Title</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" value="${
                        workHistory && workHistory.job_title
                            ? workHistory.job_title
                            : ""
                    }" name="job_title" id="job_title" />
                    <div class="invalid-feedback" id="job_title_error"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="company_name" class="col-sm-4 col-form-label">Company Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="company_name" value="${
                        workHistory && workHistory.company_name
                            ? workHistory.company_name
                            : ""
                    }" id="company_name" />
                </div>
            </div>
            <div class="form-group row">
                <label for="company_address" class="col-sm-4 col-form-label">Address</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="company_address" value="${
                        workHistory && workHistory.company_address
                            ? workHistory.company_address
                            : ""
                    }" id="company_address" />
                </div>
            </div>
            <div class="form-group row">
                <label for="start_date" class="col-sm-4 col-form-label">Start Date</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="start_date" value="${
                        workHistory && workHistory.start_date
                            ? workHistory.start_date
                            : ""
                    }" id="start_date" />
                </div>
            </div>
            <div class="form-group row">
                <label for="end_date" class="col-sm-4 col-form-label">End Date</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="end_date" value="${
                        workHistory && workHistory.end_date
                            ? workHistory.end_date
                            : ""
                    }" id="end_date" />
                </div>
            </div>`;
    if (
        workHistory &&
        workHistory.attachment &&
        ["jpeg", "gif", "png", "bmp", "jpg"].includes(workHistory.file_ext)
    ) {
        form += `<div class="form-group row">
                <label for="Image" class="col-sm-4 col-form-label"></label>
                <div class="col-sm-8">
                <div class="clearfix">
                    <div class="float-left">
                        <a href="/storage/images/applications/${folder_name}/${workHistory.attachment}" target="_blank">
                            <img src="/storage/images/applications/${folder_name}/${workHistory.attachment}" class="img-fluid" width="100px" alt="Image for edu">
                        </a>
                    </div>
                    <!-- <span class="float-right">If you upload another file this file will be deleted.</span> -->
                </div>
                </div>
            </div>`;
    } else if (workHistory && workHistory.attachment) {
        form += `<div class="form-group row">
                <label for="Image" class="col-sm-4 col-form-label"></label>
                <div class="col-sm-8">
                <a href="/storage/images/applications/${folder_name}/${
            workHistory.attachment
        }" target="_blank">${workHistory.attachment.slice(-7)}</a>
                </div>
            </div>`;
    }
    form += `<div class="form-group row">
                <label for="attachment" class="col-sm-4 col-form-label">Image</label>
                <div class="col-sm-8">
                    <input type="file" class="form-control" name="attachment" id="attachment" />
                    <div class="invalid-feedback" id="attachment_error"></div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4">
                    <button type="button" onclick="closeModal();" class="btn btn-secondary btn-lg btn-block">Close</button>
                </div>
                <div class="col-sm-8">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
                </div>
            </div>
        </form>`;

    return form;
}

$(document).on("submit", "#editWorkHistoryForm", function(event) {
    event.preventDefault();
    const url = $(this).attr("action");

    ajaxWorkHistoryReq(url, "put");
});

$(document).on("submit", "#addWorkHistoryForm", function(event) {
    event.preventDefault();
    const url = $(this).attr("action");
    ajaxWorkHistoryReq(url);
});

function ajaxWorkHistoryReq(url, type) {
    const job_title = $("#job_title").val();

    let formData = new FormData();

    const image = document.getElementById("attachment");
    const file = image.files[0];

    formData.append("attachment", file);
    formData.append("job_title", job_title);
    formData.append("company_name", $("#company_name").val());
    formData.append("company_address", $("#company_address").val());
    formData.append("start_date", $("#start_date").val());
    formData.append("end_date", $("#end_date").val());
    // formData.append("_token", "{{ csrf_token() }}");
    if (type === "put") {
        formData.append("_method", "put");
    }

    // if (image.value !== '') {
    //     alert('File Attached');
    // } else {
    //     alert('No File Attached');
    // }

    axios
        .post(url, formData)
        .then(res => {
            if (res.data === "success") {
                window.location.reload();
            }
            // console.log('response is', res);
        })
        .catch(e => {
            if (e.response && e.response.data) {
                const errors = e.response.data.errors;
                console.log("errors", errors);
                if (errors.attachment) {
                    $("#attachment").addClass("is-invalid");
                    $("#attachment_error").html(errors.attachment);
                } else {
                    $("#attachment").removeClass("is-invalid");
                }

                if (errors.job_title) {
                    $("#job_title").addClass("is-invalid");
                    $("#job_title_error").html(errors.job_title);
                } else {
                    $("#job_title").removeClass("is-invalid");
                }
            }
        });
}
