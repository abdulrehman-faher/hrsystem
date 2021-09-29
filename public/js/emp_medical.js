function addMedical(employee_id, folder_name) {
    $("#modal_title").html("Add a Medical");
    $("#modalDialog").addClass("modal-lg");
    $("#formModalBody").html(
        medicalModalHtml(undefined, employee_id, folder_name)
    );
    $("#formModal").show();
}

function editMedical(medical, employee_id, folder_name) {
    $("#modal_title").html("Update Medical");
    $("#modalDialog").addClass("modal-lg");
    $("#formModalBody").html(
        medicalModalHtml(medical, employee_id, folder_name)
    );
    $("#formModal").show();
}

function editMedicalDT(medical_id, employee_id) {
    const formModalBody = $("#formModalBody");
    $("#modal_title").html("Update Medical");
    $("#modalDialog").addClass("modal-lg");
    formModalBody.html(
        `<div align="center"><div align="center" class="spinner-border text-primary" style="width: 5rem; height: 5rem;" role="status"><span class="sr-only">Loading...</span></div></div>`
    );
    $("#formModal").show();

    axios
        .get(`/employees/${employee_id}/getMedical?medical=${medical_id}`)
        .then(response => {
            const { data, success } = response.data;
            if (success) {
                const { id, folder_name } = data.employee;
                formModalBody.html(medicalModalHtml(data, id, folder_name));
            }
        })
        .catch(err => {
            // insert error response in the database
            console.error("error", err);
        });
}

function medicalModalHtml(medical = undefined, employee_id, folder_name) {
    let form = "";
    if (medical) {
        // medical = JSON.parse(medical);
        form += `<form method="POST" action="/employees/${employee_id}/medicals/${medical.id}" id="editMedicalForm" name="editMedicalForm" enctype="multipart/form-data">`;
    } else {
        form += `<form method="POST" action="/employees/${employee_id}/medicals/" id="addMedicalForm" name="addMedicalForm" enctype="multipart/form-data">`;
    }
    form += `<div class="form-group row">
                <label for="title" class="col-sm-3 col-form-label">Title</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" value="${
                        medical && medical.title ? medical.title : ""
                    }" name="title" id="title" required oninvalid="this.setCustomValidity('Title is required')" oninput="this.setCustomValidity('')" />
                    <div class="invalid-feedback" id="title_error"></div>
                </div>
                <label for="score" class="col-sm-2 col-form-label">Score</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" value="${
                        medical && medical.score ? medical.score : ""
                    }" name="score" id="score"  min="1" max="10" />
                    <div class="invalid-feedback" id="score_error"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="hospital_name" class="col-sm-3 col-form-label">Hospital Name</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" value="${
                        medical && medical.hospital_name
                            ? medical.hospital_name
                            : ""
                    }" name="hospital_name" id="hospital_name" />
                    <div class="invalid-feedback" id="hospital_name_error"></div>
                </div>
                <label for="appt" class="col-sm-2 col-form-label">Appt</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" value="${
                        medical && medical.appt ? medical.appt : ""
                    }" name="appt" id="appt"  min="1" max="10" />
                    <div class="invalid-feedback" id="appt_error"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="admission_date" class="col-sm-3 col-form-label">Admission Date</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" value="${
                        medical && medical.admission_date
                            ? moment(medical.admission_date).format(
                                  "YYYY-MM-DD"
                              )
                            : ""
                    }" name="admission_date" id="admission_date" />
                    <div class="invalid-feedback" id="admission_date_error"></div>
                </div>
                <label for="discharge_date" class="col-sm-2 col-form-label">Discharge Date</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" value="${
                        medical && medical.discharge_date
                            ? moment(medical.discharge_date).format(
                                  "YYYY-MM-DD"
                              )
                            : ""
                    }" name="discharge_date" id="discharge_date" />
                    <div class="invalid-feedback" id="discharge_date_error"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="ion_number" class="col-sm-3 col-form-label">ION Number</label>
                <div class="col-sm-4">
                <input type="text" class="form-control" value="${
                    medical && medical.ion_number ? medical.ion_number : ""
                }" name="ion_number" id="ion_number" />
                    <div class="invalid-feedback" id="ion_number_error"></div>
                </div>
                <label for="ion_date" class="col-sm-2 col-form-label">ION Date</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" value="${
                        medical && medical.ion_date
                            ? moment(medical.ion_date).format("YYYY-MM-DD")
                            : ""
                    }" name="ion_date" id="ion_date" />
                    <div class="invalid-feedback" id="ion_date_error"></div>
                </div>
            </div>`;
    if (
        medical &&
        medical.attachment &&
        ["jpeg", "gif", "png", "bmp", "jpg", "JPG"].includes(
            medical.attachment.split(".").pop()
        )
    ) {
        form += `<div class="form-group row">
                <label for="Image" class="col-sm-4 col-form-label"></label>
                <div class="col-sm-8">
                <a href="/storage/images/applications/${folder_name}/${medical.attachment}" target="_blank">
                <img src="/storage/images/applications/${folder_name}/${medical.attachment}" class="img-fluid modal-img" width="100px" alt="Image for edu">
                </a>
                </div>
            </div>`;
    } else if (medical && medical.attachment) {
        form += `<div class="form-group row">
                <label for="Image" class="col-sm-4 col-form-label"></label>
                <div class="col-sm-8">
                <a href="/storage/images/applications/${folder_name}/${
            medical.attachment
        }" target="_blank">${medical.attachment.slice(-7)}</a>
                </div>
            </div>`;
    }
    form += `<div class="form-group row">
                <label for="authorized_by_name" class="col-sm-3 col-form-label">Authorized by</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="authorized_by_name" id="authorized_by_name" value="${
                        medical && medical.authenticated_by
                            ? medical.authenticated_by.name
                            : ""
                    }" />
                    <input type="hidden" class="form-control" name="authorized_by" id="authorized_by" value="${
                        medical && medical.authenticated_by
                            ? medical.authenticated_by.id
                            : ""
                    }" />
                    <div id="usersList" class="usersList"></div>
                    <div class="invalid-feedback" id="authorized_by_error"></div>
                </div>
                <label for="attachment" class="col-sm-2 col-form-label">Attachment</label>
                <div class="col-sm-3">
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
                    <button type="submit" class="btn btn-primary btn-lg btn-block" id="btnSubmitMedical">Save</button>
                </div>
            </div>
        </form>`;

    return form;
}

$(document).on("submit", "#editMedicalForm", function(event) {
    event.preventDefault();
    const url = $(this).attr("action");
    ajaxMedicalReq(url, "put");
});

$(document).on("submit", "#addMedicalForm", function(event) {
    event.preventDefault();
    const url = $(this).attr("action");
    ajaxMedicalReq(url);
});

function ajaxMedicalReq(url, type) {
    const btnSubmitMedical = $("#btnSubmitMedical");
    btnSubmitMedical.text("Please wait...").attr("disabled", true);
    let formData = new FormData();

    const image = document.getElementById("attachment");
    const file = image.files[0];

    formData.append("attachment", file);
    formData.append("title", $("#title").val());
    formData.append("score", $("#score").val());
    formData.append("hospital_name", $("#hospital_name").val());
    formData.append("appt", $("#appt").val());
    formData.append("admission_date", $("#admission_date").val());
    formData.append("discharge_date", $("#discharge_date").val());
    formData.append("ion_number", $("#ion_number").val());
    formData.append("ion_date", $("#ion_date").val());
    formData.append("authorized_by", $("#authorized_by").val());
    // formData.append("_token", "{{ csrf_token() }}");
    if (type === "put") {
        formData.append("_method", "put");
    }

    axios
        .post(url, formData)
        .then(res => {
            if (res.data === "success") {
                window.location.reload();
            } else {
                alert("Error Occured please try again");
            }
            btnSubmitMedical.text("Save").attr("disabled", false);
            closeModal();
            // console.log("response.data", res.data);
        })
        .catch(e => {
            alert("Error Occured please try again");
            btnSubmitMedical.text("Save").attr("disabled", false);
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

                if (errors.hospital_name) {
                    $("#hospital_name").addClass("is-invalid");
                    $("#hospital_name_error").html(errors.hospital_name);
                } else {
                    $("#hospital_name").removeClass("is-invalid");
                }
                if (errors.appt) {
                    $("#appt").addClass("is-invalid");
                    $("#appt_error").html(errors.appt);
                } else {
                    $("#appt").removeClass("is-invalid");
                }

                if (errors.admission_date) {
                    $("#admission_date").addClass("is-invalid");
                    $("#admission_date_error").html(errors.admission_date);
                } else {
                    $("#admission_date").removeClass("is-invalid");
                }

                if (errors.discharge_date) {
                    $("#discharge_date").addClass("is-invalid");
                    $("#discharge_date_error").html(errors.discharge_date);
                } else {
                    $("#discharge_date").removeClass("is-invalid");
                }
                if (errors.ion_number) {
                    $("#ion_number").addClass("is-invalid");
                    $("#ion_number_error").html(errors.ion_number);
                } else {
                    $("#ion_number").removeClass("is-invalid");
                }
                if (errors.ion_date) {
                    $("#ion_date").addClass("is-invalid");
                    $("#ion_date_error").html(errors.ion_date);
                } else {
                    $("#ion_date").removeClass("is-invalid");
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
