function addConduct(employee_id, folder_name) {
    $("#modal_title").html("Add a Conduct");
    $("#modalDialog").addClass("modal-lg");
    $("#formModalBody").html(
        conductModalHtml(undefined, employee_id, folder_name)
    );
    $("#formModal").show();
}

function editConduct(conduct, employee_id, folder_name) {
    $("#modal_title").html("Update Conduct");
    $("#modalDialog").addClass("modal-lg");
    $("#formModalBody").html(
        conductModalHtml(conduct, employee_id, folder_name)
    );
    $("#formModal").show();
}

function editConductDT(conduct_id, employee_id) {
    const formModalBody = $("#formModalBody");
    $("#modal_title").html("Update Conduct");
    $("#modalDialog").addClass("modal-lg");
    formModalBody.html(
        `<div align="center"><div align="center" class="spinner-border text-primary" style="width: 5rem; height: 5rem;" role="status"><span class="sr-only">Loading...</span></div></div>`
    );
    $("#formModal").show();

    axios
        .get(`/employees/${employee_id}/getConduct?conduct=${conduct_id}`)
        .then(response => {
            console.log(response.data);
            const { data, success } = response.data;
            if (success) {
                const { id, folder_name } = data.employee;
                formModalBody.html(conductModalHtml(data, id, folder_name));
            }
        })
        .catch(err => {
            // insert error response in the database
            console.error("error", err);
        });
}

function conductModalHtml(conduct = undefined, employee_id, folder_name) {
    let form = "";
    if (conduct) {
        form += `<form method="POST" action="/employees/${employee_id}/conducts/${conduct.id}" id="editConductForm" name="editConductForm" enctype="multipart/form-data">`;
    } else {
        form += `<form method="POST" action="/employees/${employee_id}/conducts/" id="addConductForm" name="addConductForm" enctype="multipart/form-data">`;
    }
    form += `<div class="form-group row">
                <label for="title" class="col-sm-3 col-form-label">Title</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" value="${
                        conduct && conduct.title ? conduct.title : ""
                    }" name="title" id="title" required oninvalid="this.setCustomValidity('Title is required')" oninput="this.setCustomValidity('')" />
                    <div class="invalid-feedback" id="title_error"></div>
                </div>
                <label for="score" class="col-sm-2 col-form-label">Score</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" value="${
                        conduct && conduct.score ? conduct.score : ""
                    }" name="score" id="score"  min="1" max="10" required />
                    <div class="invalid-feedback" id="score_error"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="place_of_offence" class="col-sm-3 col-form-label">Place of Offence</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" value="${
                        conduct && conduct.place_of_offence
                            ? conduct.place_of_offence
                            : ""
                    }" name="place_of_offence" id="place_of_offence" required oninvalid="this.setCustomValidity('Place of offence is required')" oninput="this.setCustomValidity('')" />
                    <div class="invalid-feedback" id="place_of_offence_error"></div>
                </div>
                <label for="date_of_offence" class="col-sm-2 col-form-label">Date of Offence</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" value="${
                        conduct && conduct.date_of_offence
                            ? moment(conduct.date_of_offence).format(
                                  "YYYY-MM-DD"
                              )
                            : ""
                    }" name="date_of_offence" id="date_of_offence" required oninvalid="this.setCustomValidity('Date of offence is required')" oninput="this.setCustomValidity('')" />
                    <div class="invalid-feedback" id="date_of_offence_error"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="offence_details" class="col-sm-3 col-form-label">Particulars of Offence</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="offence_details" name="offence_details" rows="5">${
                        conduct && conduct.offence_details
                            ? conduct.offence_details
                            : ""
                    }</textarea>
                    <div class="invalid-feedback" id="offence_details_error"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="punishment" class="col-sm-3 col-form-label">Punishment / Award</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" value="${
                        conduct && conduct.punishment ? conduct.punishment : ""
                    }" name="punishment" id="punishment" />
                    <div class="invalid-feedback" id="punishment_error"></div>
                </div>
                <label for="punishment_date" class="col-sm-2 col-form-label">Date of Award</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" value="${
                        conduct && conduct.punishment_date
                            ? moment(conduct.punishment_date).format(
                                  "YYYY-MM-DD"
                              )
                            : ""
                    }" name="punishment_date" id="punishment_date" />
                    <div class="invalid-feedback" id="punishment_date_error"></div>
                </div>
            </div>`;
    if (
        conduct &&
        conduct.authority_letter_image &&
        ["jpeg", "gif", "png", "bmp", "jpg", "JPG"].includes(
            conduct.authority_letter_image.split(".").pop()
        )
    ) {
        form += `<div class="form-group row">
                <label for="Image" class="col-sm-4 col-form-label"></label>
                <div class="col-sm-8">
                <a href="/storage/images/applications/${folder_name}/${conduct.authority_letter_image}" target="_blank">
                <img src="/storage/images/applications/${folder_name}/${conduct.authority_letter_image}" class="img-fluid modal-img" width="100px" alt="Image for edu">
                </a>
                </div>
            </div>`;
    } else if (conduct && conduct.authority_letter_image) {
        form += `<div class="form-group row">
                <label for="Image" class="col-sm-4 col-form-label"></label>
                <div class="col-sm-8">
                <a href="/storage/images/applications/${folder_name}/${
            conduct.authority_letter_image
        }" target="_blank">${conduct.authority_letter_image.slice(-7)}</a>
                </div>
            </div>`;
    }
    form += `<div class="form-group row">
                <label for="authority_letter_image" class="col-sm-3 col-form-label">Authority Letter Image</label>
                <div class="col-sm-4">
                    <input type="file" class="form-control" name="authority_letter_image" id="authority_letter_image" />
                    <div class="invalid-feedback" id="authority_letter_image_error"></div>
                </div>
                <label for="authority_letter_date" class="col-sm-2 col-form-label">Auth Ltr Date</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" value="${
                        conduct && conduct.authority_letter_date
                            ? moment(conduct.authority_letter_date).format(
                                  "YYYY-MM-DD"
                              )
                            : ""
                    }" name="authority_letter_date" id="authority_letter_date" />
                    <div class="invalid-feedback" id="authority_letter_date_error"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="authorized_by_name" class="col-sm-3 col-form-label">Authorized by</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="authorized_by_name" id="authorized_by_name" value="${
                        conduct && conduct.authenticated_by
                            ? conduct.authenticated_by.name
                            : ""
                    }" />
                    <input type="hidden" class="form-control" name="authorized_by" id="authorized_by" value="${
                        conduct && conduct.authenticated_by
                            ? conduct.authenticated_by.id
                            : ""
                    }" />
                    <div id="usersList" class="usersList"></div>
                    <div class="invalid-feedback" id="authorized_by_error"></div>
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

$(document).on("submit", "#editConductForm", function(event) {
    event.preventDefault();
    const url = $(this).attr("action");

    ajaxConductReq(url, "put");
});

$(document).on("submit", "#addConductForm", function(event) {
    event.preventDefault();
    const url = $(this).attr("action");
    ajaxConductReq(url);
});

function ajaxConductReq(url, type) {
    let formData = new FormData();

    const image = document.getElementById("authority_letter_image");
    const file = image.files[0];

    formData.append("authority_letter_image", file);
    formData.append("title", $("#title").val());
    formData.append("place_of_offence", $("#place_of_offence").val());
    formData.append("date_of_offence", $("#date_of_offence").val());
    formData.append("offence_details", $("#offence_details").val());
    formData.append("punishment", $("#punishment").val());
    formData.append("punishment_date", $("#punishment_date").val());
    formData.append("authority_letter_date", $("#authority_letter_date").val());
    formData.append("authorized_by", $("#authorized_by").val());
    formData.append("score", $("#score").val());
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
            console.log(e.response.data.errors);
            if (e.response && e.response.data) {
                const errors = e.response.data.errors;
                console.log("errors", errors);

                if (errors.title) {
                    $("#title").addClass("is-invalid");
                    $("#title_error").html(errors.title);
                } else {
                    $("#title").removeClass("is-invalid");
                }

                if (errors.score) {
                    $("#score").addClass("is-invalid");
                    $("#score_error").html(errors.score);
                } else {
                    $("#score").removeClass("is-invalid");
                }

                if (errors.place_of_offence) {
                    $("#place_of_offence").addClass("is-invalid");
                    $("#place_of_offence_error").html(errors.place_of_offence);
                } else {
                    $("#place_of_offence").removeClass("is-invalid");
                }
                if (errors.date_of_offence) {
                    $("#date_of_offence").addClass("is-invalid");
                    $("#date_of_offence_error").html(errors.date_of_offence);
                } else {
                    $("#date_of_offence").removeClass("is-invalid");
                }

                if (errors.offence_details) {
                    $("#offence_details").addClass("is-invalid");
                    $("#offence_details_error").html(errors.offence_details);
                } else {
                    $("#offence_details").removeClass("is-invalid");
                }

                if (errors.punishment) {
                    $("#punishment").addClass("is-invalid");
                    $("#punishment_error").html(errors.punishment);
                } else {
                    $("#punishment").removeClass("is-invalid");
                }
                if (errors.punishment_date) {
                    $("#punishment_date").addClass("is-invalid");
                    $("#punishment_date_error").html(errors.punishment_date);
                } else {
                    $("#punishment_date").removeClass("is-invalid");
                }

                if (errors.authority_letter_image) {
                    $("#authority_letter_image").addClass("is-invalid");
                    $("#authority_letter_image_error").html(
                        errors.authority_letter_image
                    );
                } else {
                    $("#authority_letter_image").removeClass("is-invalid");
                }
                if (errors.authority_letter_date) {
                    $("#authority_letter_date").addClass("is-invalid");
                    $("#authority_letter_date_error").html(
                        errors.authority_letter_date
                    );
                } else {
                    $("#authority_letter_date").removeClass("is-invalid");
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
