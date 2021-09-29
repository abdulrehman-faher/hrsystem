let eduIDs = 1;
let workHistoryIDs = 1;

$(document).on("blur", "#cnic", function() {
    const cnic = $(this).val();

    if (cnic.trim().length) {
        if (cnic.includes("_")) {
            return alert("Invalid CNIC");
        }
        console.log("proceeding to axios");
        // console.log("cnic.length", cnic.length);
        // console.log("cnic", cnic);
        // console.log("cnic.includes('_')", cnic.includes("_"));
        axios
            .get(`/applications/search?cnic=${cnic}`)
            .then(function(response) {
                const data = response.data;

                if (data) {
                    $("#btnSubmit").prop("disabled", true);
                    alert(
                        `Applicant already exists \n\n Applicant Name: ${data.name}`
                    );
                } else {
                    $("#btnSubmit").prop("disabled", false);
                }
            })
            .catch(err => console.log(err));
    }
});

// Delete a row from educatin details table
$("#educationTable").on("click", ".delete-row", function() {
    if (confirm("Are you sure, you want to delete this?")) {
        $(this)
            .closest("tr")
            .remove();
    }
});

$("#tblWorkHistory").on("click", ".delete-wh-row", function() {
    if (confirm("Are you sure, you want to delete this?")) {
        $(this)
            .closest("tr")
            .remove();
    }
});

// add a row to education details table
$(document).on("click", ".addEducation", function(e) {
    const title = $("#title" + eduIDs).val();

    if (title.trim() == "") {
        $("#errorModal").modal("show");

        return false;
    }

    $("#tdAddEdu" + eduIDs).html(
        '<button type="button" class="delete-row btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>'
    );

    eduIDs++;

    $("#educationTable tbody>tr:last").after(`<tr>
            <td><input placeholder="Degree Title" type="text" class="form-control" id="title${eduIDs}" name="title[]" /></td>
            <td><input placeholder="Institute Name" type="text" class="form-control" id="institute_name${eduIDs}" name="institute_name[]" /></td>
            <td><input placeholder="Marks Obtained" type="text" class="form-control" id="marks_obtained${eduIDs}" name="marks_obtained[]" /></td>
            <td><input placeholder="Grade" type="text" class="form-control" id="division_grade${eduIDs}" name="division_grade[]" /></td>
            <td><input placeholder="Year Completed" type="text" class="form-control" id="year_completed${eduIDs}" name="year_completed[]" /></td>
            <td><input placeholder="Campus Address" type="text" class="form-control" id="campus_address${eduIDs}" name="campus_address[]" /></td>
            <td><input placeholder="Image" type="file" class="form-control" id="education_images${eduIDs}" name="education_images[]" accept=".doc,.docx, image/*, application/pdf" /></td>
            <td id="tdAddEdu${eduIDs}"><button type="button" class="addEducation btn btn-primary btn-sm"><i class="fas fa-plus-square"></i></button></td>
        </tr>`);

    $("#title" + eduIDs).focus();

    return false;
});

// add a row to education details table
$(document).on("click", ".addWorkHistory", function(e) {
    const title = $("#job_title" + workHistoryIDs).val();

    if (title.trim() == "") {
        $("#errorModal").modal("show");

        return false;
    }

    $("#tdAddworkHistory" + workHistoryIDs).html(
        '<button type="button" class="delete-wh-row btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>'
    );

    workHistoryIDs++;

    $("#tblWorkHistory tbody>tr:last").after(`<tr>
            <td><input placeholder="Job Title" type="text" class="form-control" id="job_title${workHistoryIDs}" name="job_title[]" /></td>
            <td><input placeholder="Institute Name" type="text" class="form-control" id="company_name${workHistoryIDs}" name="company_name[]" /></td>
            <td><input placeholder="Marks Obtained" type="text" class="form-control" id="company_address${workHistoryIDs}" name="company_address[]" /></td>
            <td><input placeholder="Grade" type="text" class="form-control" id="start_date${workHistoryIDs}" name="start_date[]" /></td>
            <td><input placeholder="Year Completed" type="text" class="form-control" id="end_date${workHistoryIDs}" name="end_date[]" /></td>
            <td><input placeholder="Image" type="file" class="form-control" id="workhistory_images${workHistoryIDs}" name="workhistory_images[]" accept=".doc,.docx, image/*, application/pdf" /></td>
            <td id="tdAddworkHistory${workHistoryIDs}"><button type="button" class="addWorkHistory btn btn-primary btn-sm"><i class="fas fa-plus-square"></i></button></td>
        </tr>`);

    $("#job_title" + workHistoryIDs).focus();

    return false;
});

$(function() {
    $("[data-mask]").inputmask();
});

$(document).on("blur", "#dob", function() {
    const $this = $(this);

    const dob_in_words = $("#dob_in_words");

    // if (!dob_in_words.val().trim())

    dob_in_words.val(moment($this.val()).format("dddd, MMMM DD, YYYY"));
});

function validateForm() {
    "use strict";
    window.addEventListener(
        "load",
        function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName("needs-validation");
            console.log("forms are", forms);
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener(
                    "submit",
                    function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add("was-validated");
                    },
                    false
                );
            });
            console.log("validation function", validation);
        },
        false
    );
}
validateForm();

$(document).on("submit", "#application_create_form", function(e) {
    const cnic = $("#cnic").val();

    if (!cnic.trim().length || cnic.includes("_")) {
        e.preventDefault();
        e.stopPropagation();
        return alert("Invalid CNIC");
    }
});
