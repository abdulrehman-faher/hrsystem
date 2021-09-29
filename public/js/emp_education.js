function addEducation(employee_id, folder_name) {
    $("#modal_title").html("Add new Education");
    $("#modalDialog").removeClass("modal-lg");
    $("#formModalBody").html(
        educationHTML(undefined, employee_id, folder_name)
    );
    $("#formModal").show();
}

function editEdu(education, employee_id, folder_name) {
    $("#modal_title").html("Update Education");
    $("#modalDialog").removeClass("modal-lg");
    $("#formModalBody").html(
        educationHTML(education, employee_id, folder_name)
    );
    $("#formModal").show();
}

function educationHTML(education, employee_id, folder_name) {
    let form = "";
    if (education) {
        form += `<form method="POST" action="/employees/${education.employee_id}/educations/${education.id}" id="editEduForm" name="editEduForm" enctype="multipart/form-data">`;
    } else {
        form += `<form method="POST" action="/employees/${employee_id}/educations/" id="addEduForm" name="addEduForm" enctype="multipart/form-data">`;
    }
    form += `<div class="form-group row">
            <label for="title" class="col-sm-4 col-form-label">Degree</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" value="${
                    education && education.title ? education.title : ""
                }" name="title" id="job_title" />
                <div class="invalid-feedback" id="job_title_error"></div>
            </div>
        </div>
        <div class="form-group row">
            <label for="institute_name" class="col-sm-4 col-form-label">Institute</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="institute_name" value="${
                    education && education.institute_name
                        ? education.institute_name
                        : ""
                }" id="institute_name" />
            </div>
        </div>
        <div class="form-group row">
            <label for="marks_obtained" class="col-sm-4 col-form-label">Marks Obtained</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="marks_obtained" value="${
                    education && education.marks_obtained
                        ? education.marks_obtained
                        : ""
                }" id="marks_obtained" />
            </div>
        </div>
        <div class="form-group row">
            <label for="division_grade" class="col-sm-4 col-form-label">Grade</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="division_grade" value="${
                    education && education.division_grade
                        ? education.division_grade
                        : ""
                }" id="division_grade" />
            </div>
        </div>
        <div class="form-group row">
            <label for="year_completed" class="col-sm-4 col-form-label">Year Completed</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="year_completed" value="${
                    education && education.year_completed
                        ? education.year_completed
                        : ""
                }" id="year_completed" />
            </div>
        </div>
        <div class="form-group row">
            <label for="campus_address" class="col-sm-4 col-form-label">Campus Address</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="campus_address" value="${
                    education && education.campus_address
                        ? education.campus_address
                        : ""
                }" id="campus_address" />
            </div>
        </div>`;
    if (
        education &&
        education.attachment &&
        ["jpeg", "gif", "png", "bmp", "jpg"].includes(education.file_ext)
    ) {
        form += `<div class="form-group row">
            <label for="Image" class="col-sm-4 col-form-label"></label>
            <div class="col-sm-8">
            <a href="/storage/images/applications/${folder_name}/${education.attachment}" target="_blank">
            <img src="/storage/images/applications/${folder_name}/${education.attachment}" class="img-fluid" width="100px" alt="Image for edu">
            </a>
            </div>
        </div>`;
    } else if (education && education.attachment) {
        form += `<div class="form-group row">
            <label for="Image" class="col-sm-4 col-form-label"></label>
            <div class="col-sm-8">
            <a href="/storage/images/applications/${folder_name}/${
            education.attachment
        }" target="_blank">${education.attachment.slice(-7)}</a>
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

$(document).on("submit", "#editEduForm", function(event) {
    event.preventDefault();
    const url = $(this).attr("action");

    ajaxEduReq(url, "put");
});

$(document).on("submit", "#addEduForm", function(event) {
    event.preventDefault();
    const url = $(this).attr("action");
    ajaxEduReq(url);
});

function ajaxEduReq(url, type) {
    let formData = new FormData();

    const image = document.getElementById("attachment");
    const file = image.files[0];

    formData.append("attachment", file);
    formData.append("title", $("#job_title").val());
    formData.append("institute_name", $("#institute_name").val());
    formData.append("marks_obtained", $("#marks_obtained").val());
    formData.append("division_grade", $("#division_grade").val());
    formData.append("campus_address", $("#campus_address").val());
    formData.append("year_completed", $("#year_completed").val());
    // formData.append("_token", "{{ csrf_token() }}");
    if (type === "put") {
        formData.append("_method", "put");
    }

    axios
        .post(url, formData)
        .then(res => {
            if (res.data === "success") {
                window.location.reload();
            }
            // console.log('response.data', res.data);
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

                if (errors.title) {
                    $("#job_title").addClass("is-invalid");
                    $("#job_title_error").html(errors.title);
                } else {
                    $("#job_title").removeClass("is-invalid");
                }
            }
        });
}
