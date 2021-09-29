function addEducation() {
    $("#modal_title").html("Add new Education");
    $("#addEduModalBody").html(addEduHtml());
    $("#addEducationModal").show();
}

function addWorkHistory() {
    $("#modal_title").html("Add Work History");
    $("#addEduModalBody").html(addWorkHistoryHtml());
    $("#addEducationModal").show();
}

function closeModal() {
    $("#addEducationModal").hide();
}

function editEdu(education) {
    $("#modal_title").html("Update Education");
    $("#addEduModalBody").html(editEduHtml(education));
    $("#addEducationModal").show();
}

function editWorkHistory(workHistory) {
    $("#modal_title").html("Update Work History");
    $("#addEduModalBody").html(editWorkHistoryHtml(workHistory));
    $("#addEducationModal").show();
}

function addEduHtml() {
    let form = `<form method="POST" action="/applications/${application.id}/educations/" id="addEduForm" name="addEduForm" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="title" class="col-sm-4 col-form-label">Degree</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="title" id="title" />
            </div>
        </div>
        <div class="form-group row">
            <label for="institute_name" class="col-sm-4 col-form-label">Institute</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="institute_name" id="institute_name" />
            </div>
        </div>
        <div class="form-group row">
            <label for="marks_obtained" class="col-sm-4 col-form-label">Marks Obtained</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="marks_obtained" id="marks_obtained" />
            </div>
        </div>
        <div class="form-group row">
            <label for="division_grade" class="col-sm-4 col-form-label">Grade</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="division_grade" id="division_grade" />
            </div>
        </div>
        <div class="form-group row">
            <label for="year_completed" class="col-sm-4 col-form-label">Year Completed</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="year_completed" id="year_completed" />
            </div>
        </div>
        <div class="form-group row">
            <label for="campus_address" class="col-sm-4 col-form-label">Campus Address</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="campus_address" id="campus_address" />
            </div>
        </div>

        <div class="form-group row">
            <label for="education_image" class="col-sm-4 col-form-label">Image</label>
            <div class="col-sm-8">
                <input type="file" class="form-control" name="education_image" id="education_image" />
            </div>
        </div>
        <hr />
        <div class="form-group row">
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
            </div>
            <div class="col-sm-6">
                <button type="button" onclick="closeModal();" class="btn btn-danger btn-lg btn-block">Close</button>
            </div>
        </div>
    </form>`;

    return form;
}

function editEduHtml(education) {
    let form = `<form method="POST" action="/applications/${
        education.application_id
    }/educations/${
        education.id
    }" id="editEduForm" name="editEduForm" enctype="multipart/form-data">

    <input type="hidden" name="_token"  id="_token" />

    <input type="hidden" name="_method" value="put" />
        <div class="form-group row">
            <label for="title" class="col-sm-4 col-form-label">Degree</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" value="${
                    education.title ? education.title : ""
                }" name="title" id="title" />
            </div>
        </div>

        <div class="form-group row">
            <label for="institute_name" class="col-sm-4 col-form-label">Institute</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="institute_name" value="${
                    education.institute_name ? education.institute_name : ""
                }" id="institute_name" />
            </div>
        </div>

        <div class="form-group row">
            <label for="marks_obtained" class="col-sm-4 col-form-label">Marks Obtained</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="marks_obtained" value="${
                    education.marks_obtained ? education.marks_obtained : ""
                }" id="marks_obtained" />
            </div>
        </div>

        <div class="form-group row">
            <label for="division_grade" class="col-sm-4 col-form-label">Grade</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="division_grade" value="${
                    education.division_grade ? education.division_grade : ""
                }" id="division_grade" />
            </div>
        </div>

        <div class="form-group row">
            <label for="year_completed" class="col-sm-4 col-form-label">Year Completed</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="year_completed" value="${
                    education.year_completed ? education.year_completed : ""
                }" id="year_completed" />
            </div>
        </div>

        <div class="form-group row">
            <label for="campus_address" class="col-sm-4 col-form-label">Campus Address</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="campus_address" value="${
                    education.campus_address ? education.campus_address : ""
                }" id="campus_address" />
            </div>
        </div>`;

    if (
        education.attachment &&
        ["jpeg", "gif", "png", "bmp", "jpg"].includes(education.file_ext)
    ) {
        form += `<div class="form-group row">
                <label for="Image" class="col-sm-4 col-form-label"></label>
                <div class="col-sm-8">
                    <a href="/storage/images/applications/${application.folder_name}/${education.attachment}" target="_blank">
                        <img src="/storage/images/applications/${application.folder_name}/${education.attachment}" class="img-fluid" width="100px" alt="Image for edu">
                    </a>
                </div>
            </div>`;
    } else if (education.attachment) {
        const path = `/storage/images/applications/${application.folder_name}/${education.attachment}`;
        const title = education.attachment.slice(-7);
        form += `<div class="form-group row">
                <label for="Image" class="col-sm-4 col-form-label"></label>
                <div class="col-sm-8">
                    <a href="${path}" target="_blank">${title}</a>
                </div>
            </div>`;
    }

    form += `<div class="form-group row">
            <label for="education_image" class="col-sm-4 col-form-label">Image</label>
            <div class="col-sm-8">
                <input type="file" class="form-control" name="education_image" id="education_image" />
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
            </div>
            <div class="col-sm-6">
                <button type="button" onclick="closeModal();" class="btn btn-danger btn-lg btn-block">Close</button>
            </div>
        </div>
    </form>`;

    return form;
}

function addWorkHistoryHtml(workHistory) {
    let form = `<form method="POST" action="/applications/${application.id}/workhistory" id="addWorkHistoryForm" name="addWorkHistoryForm" enctype="multipart/form-data">
    <input type="hidden" name="_token"  id="_token" />
    <input type="hidden" name="_method" value="put" />
        <div class="form-group row">
            <label for="job_title" class="col-sm-4 col-form-label">Job Title</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="job_title" id="job_title" />
            </div>
        </div>

        <div class="form-group row">
            <label for="company_name" class="col-sm-4 col-form-label">Company Name</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="company_name" id="company_name" />
            </div>
        </div>

        <div class="form-group row">
            <label for="company_address" class="col-sm-4 col-form-label">Address</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="company_address" id="company_address" />
            </div>
        </div>

        <div class="form-group row">
            <label for="start_date" class="col-sm-4 col-form-label">Start Date</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="start_date" id="start_date" />
            </div>
        </div>

        <div class="form-group row">
            <label for="end_date" class="col-sm-4 col-form-label">End Date</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="end_date" id="end_date" />
            </div>
        </div>

        <div class="form-group row">
            <label for="attachment" class="col-sm-4 col-form-label">Image</label>
            <div class="col-sm-8">
                <input type="file" class="form-control" name="attachment" id="attachment" />
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
            </div>
            <div class="col-sm-6">
                <button type="button" onclick="closeModal();" class="btn btn-danger btn-lg btn-block">Close</button>
            </div>
        </div>

    </form>`;

    return form;
}

function editWorkHistoryHtml(workHistory) {
    const path = `/applications/${workHistory.application_id}/workhistory/${workHistory.id}`;
    let form = `<form method="POST" action="${path}" id="editWorkHistoryForm" name="editWorkHistoryForm" enctype="multipart/form-data">
        <input type="hidden" name="_token"  id="_token" />
        <input type="hidden" name="_method" value="put" />
        <div class="form-group row">
            <label for="job_title" class="col-sm-4 col-form-label">Job Title</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" value="${
                    workHistory.job_title ? workHistory.job_title : ""
                }" name="job_title" id="job_title" />
            </div>
        </div>

        <div class="form-group row">
            <label for="company_name" class="col-sm-4 col-form-label">Company Name</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="company_name" value="${
                    workHistory.company_name ? workHistory.company_name : ""
                }" id="company_name" />
            </div>
        </div>

        <div class="form-group row">
            <label for="company_address" class="col-sm-4 col-form-label">Address</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="company_address" value="${
                    workHistory.company_address
                        ? workHistory.company_address
                        : ""
                }" id="company_address" />
            </div>
        </div>

        <div class="form-group row">
            <label for="start_date" class="col-sm-4 col-form-label">Start Date</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="start_date" value="${
                    workHistory.start_date ? workHistory.start_date : ""
                }" id="start_date" />
            </div>
        </div>

        <div class="form-group row">
            <label for="end_date" class="col-sm-4 col-form-label">End Date</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="end_date" value="${
                    workHistory.end_date ? workHistory.end_date : ""
                }" id="end_date" />
            </div>
        </div>`;

    if (
        workHistory.attachment &&
        ["jpeg", "gif", "png", "bmp", "jpg"].includes(workHistory.file_ext)
    ) {
        form += `<div class="form-group row">
            <label for="Image" class="col-sm-4 col-form-label"></label>
            <div class="col-sm-8">
                <div class="clearfix">
                    <div class="float-left">
                        <a href="/storage/images/applications/${application.folder_name}/${workHistory.attachment}" target="_blank">
                            <img src="/storage/images/applications/${application.folder_name}/${workHistory.attachment}" class="img-fluid" width="100px" alt="Image for edu">
                        </a>
                    </div>
                </div>
            </div>

        </div>`;
    } else if (workHistory.attachment) {
        const imgPath = `/storage/images/applications/${application.folder_name}/${workHistory.attachment}`;
        const imgTitle = workHistory.attachment.slice(-7);
        form += `<div class="form-group row">
            <label for="Image" class="col-sm-4 col-form-label"></label>
            <div class="col-sm-8">
                <a href="${imgPath}" target="_blank">${imgTitle}</a>
            </div>
        </div>`;
    }

    form += `<div class="form-group row">
                <label for="attachment" class="col-sm-4 col-form-label">Image</label>
                <div class="col-sm-8">
                    <input type="file" class="form-control" name="attachment" id="attachment" />
                </div>
            </div>

        <div class="form-group row">
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
            </div>
            <div class="col-sm-6">
                <button type="button" onclick="closeModal();" class="btn btn-danger btn-lg btn-block">Close</button>
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

function ajaxWorkHistoryReq(url, type) {
    let formData = new FormData();

    const image = document.getElementById("attachment");
    const file = image.files[0];

    formData.append("attachment", file);
    formData.append("job_title", $("#job_title").val());
    formData.append("company_name", $("#company_name").val());
    formData.append("company_address", $("#company_address").val());
    formData.append("start_date", $("#start_date").val());
    formData.append("end_date", $("#end_date").val());

    if (type === "put") {
        formData.append("_method", "put");
    }

    axios
        .post(url, formData)
        .then(res => {
            if (res.data === "success") {
                window.location.reload();
            }
        })
        .catch(e => {
            alert("Error", e);
        });
}

function ajaxEduReq(url, type) {
    let formData = new FormData();

    const image = document.getElementById("education_image");
    const file = image.files[0];

    formData.append("education_image", file);
    formData.append("title", $("#title").val());
    formData.append("institute_name", $("#institute_name").val());
    formData.append("marks_obtained", $("#marks_obtained").val());
    formData.append("division_grade", $("#division_grade").val());
    formData.append("campus_address", $("#campus_address").val());
    formData.append("year_completed", $("#year_completed").val());

    if (type === "put") {
        formData.append("_method", "put");
    }

    axios
        .post(url, formData)
        .then(res => {
            if (res.data === "success") {
                window.location.reload();
            }
        })
        .catch(e => {
            alert("Error", e);
        });
}

$(document).on("change", "#dob", function() {
    const $this = $(this);

    const dob_in_words = $("#dob_in_words");

    // if (!dob_in_words.val().trim())

    dob_in_words.val(moment($this.val()).format("dddd, MMMM DD, YYYY"));
});
