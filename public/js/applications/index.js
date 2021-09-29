$("#application_remaining").DataTable(renderDT("apis/applications/remaining"));
$("#application_shortlisted").DataTable(
    renderDT("apis/applications/short-listed")
);
$("#application_employeed").DataTable(renderDT("apis/applications/employeed"));
$("#application_all").DataTable(renderDT("apis/applications/all"));

function renderDT(url) {
    return {
        processing: true,
        serverSide: true,
        ajax: { url },
        order: [],

        // dom: "lBfrtip",
        // lengthMenu: [
        //     [10, 25, 50, 100, 200, 500, 1000, -1],
        //     ["10", "25", "50", "100", "200", "500", "1000", "Show all"]
        // ],
        // buttons: [
        //     // 'print',
        //     {
        //         extend: "excelHtml5",
        //         text: '<i class="fas fa-file-excel"></i> Export to Excel',
        //         // titleAttr: 'Export to Excel',
        //         // title: 'Insurance Companies',
        //         exportOptions: { columns: ":not(:first-child)" }
        //     },
        //     {
        //         extend: "pdfHtml5",
        //         text: '<i class="far fa-file-pdf"></i> Export to PDF',
        //         exportOptions: { columns: ":not(:first-child)" }
        //     },
        //     {
        //         text: '<i class="fas fa-sync-alt"></i> Reload',
        //         action: function(e, dt, node, config) {
        //             dt.ajax.reload();
        //         }
        //     }
        //     // 'colvis'
        // ],

        columns: [
            {
                data: "id",
                name: "id"
            },
            {
                data: "name",
                name: "name"
            },
            {
                data: "father_name",
                name: "father_name"
            },
            {
                data: "education",
                name: "education"
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
                data: "phone_number",
                name: "phone_number"
            },
            {
                data: "referee_name",
                name: "referee_name"
            },
            {
                data: "cnic",
                name: "cnic"
            },
            {
                data: "created_at",
                name: "created_at"
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false
            }
        ],

        initComplete: function() {
            this.api()
                .columns()
                .every(function() {
                    var column = this;

                    var input = document.createElement("input");

                    $(input)
                        .appendTo($(column.footer()).empty())

                        .on("change", function() {
                            column
                                .search($(this).val(), false, false, true)
                                .draw();
                        });
                });
        }
    };
}
