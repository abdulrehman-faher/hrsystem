// $(function() {
//     const checkAll = $('#checkAll').prop('checked', false);
//     // console.log('checkAll is', checkAll);
//     // // if($('#checkAll').)
//     // if (checkAll) {
//     //     $('input[name="shortlisted[]"]').prop('checked', checkAll);
//     // }
// });

$(document).on("submit", "#addInterviewForm", function(event) {
    var checked = $("#interview_data").find(":checked").length;
    if (!checked) {
        event.preventDefault();
        event.stopPropagation();
        alert("Please select atleast one of the applicant.");
    }
});

// $(document).on("change", 'input[name="shortlisted[]"]', function(event) {
//     // event.preventDefault();
//     // const url = $(this).attr('action');
//     // ajaxEduReq(url);
//     const $this = $(this);
//     const value = $this.val();

//     if ($this.prop("checked") == true) {
//         console.log("Checkbox is checked. ", value);
//     } else if ($this.prop("checked") == false) {
//         console.log("Checkbox is unchecked.");
//     }
// });

$(document).on("change", "#checkAll", function() {
    $("input:checkbox")
        .not(this)
        .prop("checked", this.checked);
});

const table = $("#interview_data").DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: url
    },
    // buttons: ["copy", "excel", "pdf"],
    columns: [
        {
            data: "id",
            name: "id"
        },
        {
            data: "shortlist",
            name: "shortlist",
            orderable: false
        },
        {
            data: "name",
            name: "name"
        },
        {
            data: "job_type_id",
            name: "job_type_id"
        },
        {
            data: "years_of_experience",
            name: "years_of_experience"
        },
        {
            data: "referee_name",
            name: "referee_name"
        },
        {
            data: "created_at",
            name: "created_at"
        }
    ],
    order: []
});

$(document).on("change", "#job_type_id", function() {
    const $this = $(this);
    let search = $this.find("option:selected").text();
    // let search = $("option:selected", $this).text();
    $("#title").val(search);
    if (search === "All job types" || $this.val() == 0) {
        search = "";
    }

    $("#checkAll")
        .prop("checked", false)
        .trigger("change");

    table.search(search).draw();
});
