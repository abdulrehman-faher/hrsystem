function relationshipsDropdown(kindered) {
    let relationships_dropdown = "";
    Object.keys(relationships).forEach(relationship => {
        relationships_dropdown += `<option value="${relationship}" ${
            kindered && kindered.relationship === relationship ? "selected" : ""
        }>${relationships[relationship]}</option>`;
    });

    return relationships_dropdown;
}

function addKindered(employee_id) {
    $("#modal_title").html("Add a Kindered");
    $("#modalDialog").addClass("modal-lg");
    $("#formModalBody").html(kinderedModalHtml(undefined, employee_id));
    $("#formModal").show();
}

function editKindered(kindered, employee_id) {
    $("#modal_title").html("Update Kindered");
    $("#modalDialog").addClass("modal-lg");
    $("#formModalBody").html(kinderedModalHtml(kindered, employee_id));
    $("#formModal").show();
}

function kinderedModalHtml(kindered = undefined, employee_id) {
    let form = "";
    if (kindered) {
        form += `<form method="POST" action="/employees/${employee_id}/kindereds/${kindered.id}" id="editKinderedForm" name="editKinderedForm" enctype="multipart/form-data">`;
    } else {
        form += `<form method="POST" action="/employees/${employee_id}/kindereds/" id="addKinderedForm" name="addKinderedForm" enctype="multipart/form-data">`;
    }

    const hide_if_wife =
        kindered && kindered.relationship !== "wife"
            ? 'style="display: none;"'
            : "";

    form += `<div class="form-group row">
                <label for="relationship" class="col-sm-3 col-form-label">Relationship</label>
                <div class="col-sm-9">
                    <select class="form-control" name="relationship" id="relationship" required>
                        <option value="">Choose...</option>
                        ${relationshipsDropdown(kindered)}
                    </select>
                    <div class="invalid-feedback" id="relationship_error"></div>
                </div>
            </div>`;

    if ((kindered && kindered.relationship !== "wife") || !kindered) {
        form += `<div style="display: none;" class="form-group row" id="marriage_date_here">
                <label for="marriage_date" class="col-sm-3 col-form-label">Marriage Date</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" value="${
                        kindered && kindered.marriage_date
                            ? moment(kindered.marriage_date).format(
                                  "YYYY-MM-DD"
                              )
                            : ""
                    }" name="marriage_date" id="marriage_date" />
                    <div class="invalid-feedback" id="marriage_date_error"></div>
                </div>
            </div>`;
    } else {
        form += `<div class="form-group row" id="marriage_date_here">
                <label for="marriage_date" class="col-sm-3 col-form-label">Marriage Date</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" value="${
                        kindered && kindered.marriage_date
                            ? moment(kindered.marriage_date).format(
                                  "YYYY-MM-DD"
                              )
                            : ""
                    }" name="marriage_date" id="marriage_date" />
                    <div class="invalid-feedback" id="marriage_date_error"></div>
                </div>
            </div>`;
    }

    form += `<div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" value="${
                        kindered && kindered.name ? kindered.name : ""
                    }" name="name" id="name" required />
                    <div class="invalid-feedback" id="name_error"></div>
                </div>
                <label for="cnic" class="col-sm-2 col-form-label">CNICs</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="cnic" value="${
                        kindered && kindered.cnic ? kindered.cnic : ""
                    }" name="cnic" data-inputmask="'mask': ['99999-9999999-9', '999999-999999-9']" data-mask />
                    <div class="invalid-feedback" id="cnic_error"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="dob" class="col-sm-3 col-form-label">Date of Birth</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" value="${
                        kindered && kindered.dob
                            ? moment(kindered.dob).format("YYYY-MM-DD")
                            : ""
                    }" name="dob" id="dob" />
                    <div class="invalid-feedback" id="dob_error"></div>
                </div>
                <label for="next_of_kin" class="col-sm-2 col-form-label">Next of Kin</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" value="${
                        kindered && kindered.next_of_kin
                            ? kindered.next_of_kin
                            : ""
                    }" name="next_of_kin" id="next_of_kin" />
                    <div class="invalid-feedback" id="next_of_kin_error"></div>
                </div>
                
            </div>

            <div class="form-group row">
                <label for="authorized_by_name" class="col-sm-3 col-form-label">Authorized by</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="authorized_by_name" id="authorized_by_name" value="${
                        kindered && kindered.authenticated_by
                            ? kindered.authenticated_by.name
                            : ""
                    }" />
                    <input type="hidden" class="form-control" name="authorized_by" id="authorized_by" value="${
                        kindered && kindered.authenticated_by
                            ? kindered.authenticated_by.id
                            : ""
                    }" />
                    <div id="usersList" class="usersList"></div>
                    <div class="invalid-feedback" id="authorized_by_error"></div>
                </div>
                <label for="date_of_entry" class="col-sm-2 col-form-label">Date of entry</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" value="${
                        kindered && kindered.date_of_entry
                            ? moment(kindered.date_of_entry).format(
                                  "YYYY-MM-DD"
                              )
                            : ""
                    }" name="date_of_entry" id="date_of_entry" />
                    <div class="invalid-feedback" id="date_of_entry_error"></div>
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

$(document).on("change", "#relationship", function(event) {
    const $this = $(this);
    if ($this.val() === "wife") {
        $("#marriage_date_here").show();
    } else {
        $("#marriage_date_here").hide();
    }
});

$(document).on("submit", "#editKinderedForm", function(event) {
    event.preventDefault();
    const url = $(this).attr("action");
    ajaxKinderedReq(url, "put");
});

$(document).on("submit", "#addKinderedForm", function(event) {
    event.preventDefault();
    const url = $(this).attr("action");
    ajaxKinderedReq(url);
});

function ajaxKinderedReq(url, type) {
    const btnSubmitMedical = $("#btnSubmitMedical");
    btnSubmitMedical.text("Please wait...").attr("disabled", true);
    let formData = new FormData();

    // const image = document.getElementById('attachment');
    // const file = image.files[0];

    // formData.append('attachment', file);
    formData.append("relationship", $("#relationship").val());
    formData.append("name", $("#name").val());
    formData.append("dob", $("#dob").val());
    formData.append("marriage_date", $("#marriage_date").val());
    formData.append("next_of_kin", $("#next_of_kin").val());
    formData.append("cnic", $("#cnic").val());
    formData.append("date_of_entry", $("#date_of_entry").val());
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
            }
            btnSubmitMedical.text("Save").attr("disabled", false);
            // console.log("response.data", res.data);
        })
        .catch(e => {
            btnSubmitMedical.text("Save").attr("disabled", false);
            // console.log(e.response.data.errors);
            if (e.response && e.response.data) {
                const errors = e.response.data.errors;
                console.log("errors", errors);

                if (errors.relationship) {
                    $("#relationship").addClass("is-invalid");
                    $("#relationship_error").html(errors.relationship);
                } else {
                    $("#relationship").removeClass("is-invalid");
                }

                if (errors.marriage_date) {
                    $("#marriage_date").addClass("is-invalid");
                    $("#marriage_date_error").html(errors.marriage_date);
                } else {
                    $("#marriage_date").removeClass("is-invalid");
                }

                if (errors.name) {
                    $("#name").addClass("is-invalid");
                    $("#name_error").html(errors.name);
                } else {
                    $("#name").removeClass("is-invalid");
                }
                if (errors.cnic) {
                    $("#cnic").addClass("is-invalid");
                    $("#cnic_error").html(errors.cnic);
                } else {
                    $("#cnic").removeClass("is-invalid");
                }

                if (errors.dob) {
                    $("#dob").addClass("is-invalid");
                    $("#dob_error").html(errors.dob);
                } else {
                    $("#dob").removeClass("is-invalid");
                }

                if (errors.next_of_kin) {
                    $("#next_of_kin").addClass("is-invalid");
                    $("#next_of_kin_error").html(errors.next_of_kin);
                } else {
                    $("#next_of_kin").removeClass("is-invalid");
                }

                if (errors.authorized_by) {
                    $("#authorized_by_name").addClass("is-invalid");
                    $("#authorized_by_error").html(errors.authorized_by);
                } else {
                    $("#authorized_by_name").removeClass("is-invalid");
                }
                if (errors.date_of_entry) {
                    $("#date_of_entry").addClass("is-invalid");
                    $("#date_of_entry_error").html(errors.date_of_entry);
                } else {
                    $("#date_of_entry").removeClass("is-invalid");
                }
            }
        });
}
