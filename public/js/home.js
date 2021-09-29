$(function() {
    $("[data-mask]").inputmask();
    $(".select2").select2();

    axios
        .get("/interviews/selected-count")
        .then(response => {
            $("#successfulCandidatesP").append(
                `<span class="badge badge-info right">${response.data}</span>`
            );
        })
        .catch(err => {});

    $(document).on("mousedown", ".modal-header", function(downEvent) {
        const $draggable = $(this);
        const x = downEvent.pageX - $draggable.offset().left;
        const y = downEvent.pageY - $draggable.offset().top;

        $("body").on("mousemove.draggable", function(moveEvent) {
            $draggable.closest(".modal-dialog").offset({
                left: moveEvent.pageX - x,
                top: moveEvent.pageY - y
            });
        });

        $("body").on("mouseup", function(upEvent) {
            $("body").off("mousemove.draggable");
        });

        $draggable.closest(".modal").one("bs.modal.hide", function() {
            $("body").off("mousemove.draggable");
        });
    });
});

$(".show-more-button").each(function(index) {
    const $this = $(this);

    $this.on("click", function() {
        if ($this.attr("data-more") == 0) {
            $this.attr("data-more", 1);
            $this.css("display", "block");
            $this.text("Read Less");
            $this.prev().css("display", "none");
            $this.prev().css("display", "inline");
        }

        // If text is shown complete, then show less
        else if (this.getAttribute("data-more") == 1) {
            $this.attr("data-more", 0);
            $this.css("display", "inline");
            $this.text("Read More");
            $this.prev().css("display", "inline");
            $this.prev().css("display", "none");
            // $this
            //     .prev()
            //     .prev()
            //     .css("display", "none");
        }
    });
});

function dtOptions(url, columns) {
    return {
        processing: true,
        serverSide: true,
        ajax: {
            url: url
        },
        order: [],
        // dom: 'lBfrtip',
        // lengthMenu: [
        //     [10, 25, 50, 100, 200, 500, 1000, -1],
        //     ['10', '25', '50', '100', '200', '500', '1000', 'Show all']
        // ],
        // buttons: [
        //     'copy', 'excelHtml5', 'pdfHtml5', 'print',
        //     {
        //         text: '<i class="fas fa-sync-alt"></i> Reload',
        //         action: function(e, dt, node, config) {
        //             dt.ajax.reload();
        //         }
        //     },
        // ],
        // buttons: [
        //     'copy',
        //     {
        //         extend: 'excelHtml5',
        //         // text: '<i class="fas fa-file-excel"></i> Export to Excel',
        //         // titleAttr: 'Export to Excel',
        //         // title: 'Insurance Companies',
        //         exportOptions: {
        //             columns: ':not(:first-child)',
        //         }
        //     },
        //     {
        //         extend: 'pdfHtml5',
        //         // text: '<i class="far fa-file-pdf"></i> Export to PDF',
        //         exportOptions: {
        //             columns: ':not(:first-child)',
        //         }
        //     },
        //     {
        //         text: '<i class="fas fa-sync-alt"></i> Reload',
        //         action: function(e, dt, node, config) {
        //             dt.ajax.reload();
        //         }
        //     },
        //     // 'colvis'
        // ],
        columns: columns
    };
}
