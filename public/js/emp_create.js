let eduIDs = 1;
let workHistoryIDs = 1;
let submitForm = false;

$(document).on("submit", "#employeeCreateForm", function(event) {
    if (submitForm) {
        return;
    }
    event.preventDefault();
    const job_type_id = $("#job_type_id").val();
    const club_id = $("#club_id").val();
    if (!job_type_id) {
        alert("Job Type is required");
        return;
    }
    if (!club_id) {
        alert("Club is required");
        return;
    }
    const $this = $(this);
    const params = { params: { job_type_id, club_id } };

    axios
        .get("/staff-auth/validate-strength", params)
        .then(response => {
            console.log("response", response.data);
            if (response.data.difference >= 0) {
                const message = `You are exceeding your Authorization by ${response
                    .data.difference +
                    1}. \nAre you sure you want to continue?`;
                if (confirm(message)) {
                    submitForm = true;
                    $this.submit();

                    // $('#employeeCreateForm').submit();
                    console.log("submit form with a warning message ");
                }
            } else {
                $this.submit();
                submitForm = true;
                console.log("submit form NO Warning ");
            }
        })
        .catch(function(e) {
            console.log(e);
        });
});

$(document).on("blur", "#dob", function() {
    const $this = $(this);
    const dob_in_words = $("#dob_in_words");
    if (!dob_in_words.val().trim())
        dob_in_words.val(moment($this.val()).format("dddd, MMMM DD, YYYY"));
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
            <td><input placeholder="Degree Title" type="text" class="form-control" id="title${eduIDs}" value="{{ old('title') }}" name="title[]" /></td>
            <td><input placeholder="Institute Name" type="text" class="form-control" id="institute_name${eduIDs}" value="{{ old('institute_name') }}" name="institute_name[]" /></td>
            <td><input placeholder="Marks Obtained" type="text" class="form-control" id="marks_obtained${eduIDs}" value="{{ old('marks_obtained') }}" name="marks_obtained[]" /></td>
            <td><input placeholder="Grade" type="text" class="form-control" id="division_grade${eduIDs}" value="{{ old('division_grade') }}" name="division_grade[]" /></td>
            <td><input placeholder="Year Completed" type="text" class="form-control" id="year_completed${eduIDs}" value="{{ old('year_completed') }}" name="year_completed[]" /></td>
            <td><input placeholder="Campus Address" type="text" class="form-control" id="campus_address${eduIDs}" value="{{ old('campus_address') }}" name="campus_address[]" /></td>
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
            <td><input placeholder="Job Title" type="text" class="form-control" id="job_title${workHistoryIDs}" value="{{ old('job_title') }}" name="job_title[]" /></td>
            <td><input placeholder="Institute Name" type="text" class="form-control" id="company_name${workHistoryIDs}" value="{{ old('company_name') }}" name="company_name[]" /></td>
            <td><input placeholder="Marks Obtained" type="text" class="form-control" id="company_address${workHistoryIDs}" value="{{ old('company_address') }}" name="company_address[]" /></td>
            <td><input placeholder="Grade" type="text" class="form-control" id="start_date${workHistoryIDs}" value="{{ old('start_date') }}" name="start_date[]" /></td>
            <td><input placeholder="Year Completed" type="text" class="form-control" id="end_date${workHistoryIDs}" value="{{ old('end_date') }}" name="end_date[]" /></td>
            <td><input placeholder="Image" type="file" class="form-control" id="workhistory_images${workHistoryIDs}" name="workhistory_images[]" accept=".doc,.docx, image/*, application/pdf" /></td>
            <td id="tdAddworkHistory${workHistoryIDs}"><button type="button" class="addWorkHistory btn btn-primary btn-sm"><i class="fas fa-plus-square"></i></button></td>
        </tr>`);

    $("#job_title" + workHistoryIDs).focus();

    return false;
});
