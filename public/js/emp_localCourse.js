let reloadPage = true;

function addLocalCourse(employee_id, folder_name) {
    $("#modal_title").html("Add Local Course");
    $("#modalDialog").addClass("modal-lg");
    $("#formModalBody").html(
        localCourseModalHtml(undefined, employee_id, folder_name)
    );
    $("#formModal").show();
}

function editLocalCourse(localCourse, employee_id, folder_name) {
    $("#modal_title").html("Local Course");
    $("#modalDialog").addClass("modal-lg");
    $("#formModalBody").html(
        localCourseModalHtml(localCourse, employee_id, folder_name)
    );
    $("#formModal").show();
}

function editConductDT(localCourse_id, employee_id) {
    reloadPage = false;
    const formModalBody = $("#formModalBody");
    $("#modal_title").html("Local Course");
    $("#modalDialog").addClass("modal-lg");
    formModalBody.html(
        `<div align="center"><div align="center" class="spinner-border text-primary" style="width: 5rem; height: 5rem;" role="status"><span class="sr-only">Loading...</span></div></div>`
    );

    $("#formModal").show();
    const url = `/employees/${employee_id}/getLocalCourse?id=${localCourse_id}`;

    axios
        .get(url)
        .then(response => {
            // console.log(response.data);
            const { data, success } = response.data;

            if (success) {
                const { id, folder_name } = data.employee;
                formModalBody.html(localCourseModalHtml(data, id, folder_name));
            }
        })
        .catch(err => {
            // insert error response in the database
            console.error("error", err);
        });
}

function localCourseModalHtml(
    localCourse = undefined,
    employee_id,
    folder_name
) {
    let form = "";

    if (localCourse) {
        form += `<form method="POST" action="/employees/${employee_id}/local-courses/${localCourse.id}" id="editLocalCourse" name="editLocalCourse" enctype="multipart/form-data">`;
    } else {
        form += `<form method="POST" action="/employees/${employee_id}/local-courses/" id="addLocalCourse" name="addLocalCourse" enctype="multipart/form-data">`;
    }

    form += `<div class="form-group row">
                <label for="title" class="col-sm-3 col-form-label">Title</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" value="${
                        localCourse && localCourse.title
                            ? localCourse.title
                            : ""
                    }" name="title" id="title" required oninvalid="this.setCustomValidity('Course title is required')" oninput="this.setCustomValidity('')" />
                    <div class="invalid-feedback" id="title_error"></div>
                </div>

                <label for="held_at_place" class="col-sm-2 col-form-label">Held at Place</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" value="${
                        localCourse && localCourse.held_at_place
                            ? localCourse.held_at_place
                            : ""
                    }" name="held_at_place" id="held_at_place" />
                    <div class="invalid-feedback" id="held_at_place_error"></div>
                </div>
            </div>

            <div class="form-group row">
                <label for="date_from" class="col-sm-3 col-form-label">Date from</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" value="${
                        localCourse && localCourse.date_from
                            ? moment(localCourse.date_from).format("YYYY-MM-DD")
                            : ""
                    }" name="date_from" id="date_from" />
                    <div class="invalid-feedback" id="date_from_error"></div>
                </div>

                <label for="date_to" class="col-sm-2 col-form-label">Date to</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" value="${
                        localCourse && localCourse.date_to
                            ? moment(localCourse.date_to).format("YYYY-MM-DD")
                            : ""
                    }" name="date_to" id="date_to" />
                    <div class="invalid-feedback" id="date_to_error"></div>
                </div>
            </div>

            <div class="form-group row">
                <label for="grade" class="col-sm-3 col-form-label">Grade</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" value="${
                        localCourse && localCourse.grade
                            ? localCourse.grade
                            : ""
                    }" name="grade" id="grade" />
                    <div class="invalid-feedback" id="grade_error"></div>
                </div>
                <label for="marks" class="col-sm-2 col-form-label">Marks</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" value="${
                        localCourse && localCourse.marks
                            ? localCourse.marks
                            : ""
                    }" name="marks" id="marks" />
                    <div class="invalid-feedback" id="marks_error"></div>
                </div>
            </div>`;

    if (
        localCourse &&
        localCourse.attachment &&
        ["jpeg", "gif", "png", "bmp", "jpg", "JPG"].includes(
            localCourse.attachment.split(".").pop()
        )
    ) {
        form += `<div class="form-group row">
                <label for="Image" class="col-sm-4 col-form-label"></label>
                <div class="col-sm-8">
                    <a href="/storage/images/applications/${folder_name}/${localCourse.attachment}" target="_blank">
                        <img src="/storage/images/applications/${folder_name}/${localCourse.attachment}" class="img-fluid modal-img" width="100px" alt="${localCourse.title}">
                    </a>
                </div>
            </div>`;
    } else if (localCourse && localCourse.attachment) {
        form += `<div class="form-group row">
                <label for="Image" class="col-sm-4 col-form-label"></label>
                <div class="col-sm-8">
                    <a href="/storage/images/applications/${folder_name}/${
            localCourse.attachment
        }" target="_blank">${localCourse.attachment.slice(-7)}</a>
                </div>
            </div>`;
    }

    form += `<div class="form-group row">
                <label for="attachment" class="col-sm-3 col-form-label">Authority Letter Image</label>
                <div class="col-sm-4">
                    <input type="file" class="form-control" name="attachment" id="attachment" />
                    <div class="invalid-feedback" id="attachment_error"></div>
                </div>
                <label for="authorized_by_date" class="col-sm-2 col-form-label">Auth Ltr Date</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" value="${
                        localCourse && localCourse.authorized_by_date
                            ? moment(localCourse.authorized_by_date).format(
                                  "YYYY-MM-DD"
                              )
                            : ""
                    }" name="authorized_by_date" id="authorized_by_date" />
                    <div class="invalid-feedback" id="authorized_by_date_error"></div>
                </div>
            </div>

            <div class="form-group row">
                <label for="authorized_by_name" class="col-sm-3 col-form-label">Authorized by</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="authorized_by_name" id="authorized_by_name" value="${
                        localCourse && localCourse.authenticated_by
                            ? localCourse.authenticated_by.name
                            : ""
                    }" />
                    <input type="hidden" class="form-control" name="authorized_by" id="authorized_by" value="${
                        localCourse && localCourse.authenticated_by
                            ? localCourse.authenticated_by.id
                            : ""
                    }" />
                    <div class="invalid-feedback" id="authorized_by_error"></div>
                    <div id="usersList" class="usersList"></div>
                </div>
            </div>

            <hr />
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

$(document).on("submit", "#editLocalCourse", function(event) {
    event.preventDefault();
    const url = $(this).attr("action");
    ajaxLocalCourseReq(url, "put");
});

$(document).on("submit", "#addLocalCourse", function(event) {
    event.preventDefault();
    const url = $(this).attr("action");
    ajaxLocalCourseReq(url);
});

function ajaxLocalCourseReq(url, type) {
    let formData = new FormData();
    const image = document.getElementById("attachment");

    // if (image && image.files) {
    const file = image.files[0];
    formData.append("attachment", file);
    // }

    formData.append("title", $("#title").val());
    formData.append("date_from", $("#date_from").val());
    formData.append("date_to", $("#date_to").val());
    formData.append("held_at_place", $("#held_at_place").val());
    formData.append("grade", $("#grade").val());
    formData.append("marks", $("#marks").val());
    formData.append("authorized_by_date", $("#authorized_by_date").val());
    formData.append("authorized_by", $("#authorized_by").val());

    if (type === "put") {
        formData.append("_method", "put");
    }

    axios
        .post(url, formData)
        .then(res => {
            if (reloadPage && res.data === "success") {
                window.location.reload();
            }
            closeModal();
            table.draw();
        })
        .catch(e => {
            // console.log(e.response.data.errors);
            if (e.response && e.response.data) {
                const errors = e.response.data.errors;

                if (errors.title) {
                    $("#title").addClass("is-invalid");
                    $("#title_error").html(errors.title);
                } else {
                    $("#title").removeClass("is-invalid");
                }

                if (errors.held_at_place) {
                    $("#held_at_place").addClass("is-invalid");
                    $("#held_at_place_error").html(errors.held_at_place);
                } else {
                    $("#held_at_place").removeClass("is-invalid");
                }

                if (errors.date_from) {
                    $("#date_from").addClass("is-invalid");

                    $("#date_from_error").html(errors.date_from);
                } else {
                    $("#date_from").removeClass("is-invalid");
                }

                if (errors.date_to) {
                    $("#date_to").addClass("is-invalid");
                    $("#date_to_error").html(errors.date_to);
                } else {
                    $("#date_of_offence").removeClass("is-invalid");
                }

                if (errors.grade) {
                    $("#grade").addClass("is-invalid");
                    $("#grade_error").html(errors.grade);
                } else {
                    $("#grade").removeClass("is-invalid");
                }

                if (errors.marks) {
                    $("#marks").addClass("is-invalid");
                    $("#marks_error").html(errors.marks);
                } else {
                    $("#marks").removeClass("is-invalid");
                }

                if (errors.attachment) {
                    $("#attachment").addClass("is-invalid");
                    $("#attachment_error").html(errors.attachment);
                } else {
                    $("#attachment").removeClass("is-invalid");
                }

                if (errors.authorized_by_date) {
                    $("#authorized_by_date").addClass("is-invalid");
                    $("#authorized_by_date_error").html(
                        errors.authorized_by_date
                    );
                } else {
                    $("#authorized_by_date").removeClass("is-invalid");
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
