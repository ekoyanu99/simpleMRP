$(document).ready(function() {
    let table = $("#indetlistTable").DataTable({
        lengthMenu: [25, 50, 100],
        order: [
            [1, "asc"]
        ],
        deferRender: true,
        scrollY: 300,
        scroller: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "/InDet/json",
            data: function(d) {

            },
        },
        columns: [{
                data: "DT_RowIndex",
                orderable: false,
                searchable: false
            },
            {
                data: "in_det_item",
                name: "in_det_item"
            },
            {
                data: "in_det_itemdesc",
                name: "in_det_itemdesc"
            },
            {
                data: "in_det_loc",
                name: "in_det_loc"
            },
            {
                data: "in_det_qty",
                name: "in_det_qty",
                className: "text-nowrap text-end"
            },
            {
                data: "in_det_uom",
                name: "in_det_uom"
            },
            {
                data: "action",
                orderable: false,
                searchable: false
            },
        ],
        dom: "lrtip",
    });

    $('#f_Sfilter, #f_addFilterForm, #f_CFilter').on('click', function() {
        table.draw();
    });
});

// Clear form filter
function clearForm() {
    $("#addFilterForm")[0].reset();
}