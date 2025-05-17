$(document).ready(function() {
    let table = $("#pomstrlistTable").DataTable({
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
            url: "/PoMstr/json",
            data: function(d) {

            },
        },
        columns: [{
                data: "DT_RowIndex",
                orderable: false,
                searchable: false
            },
            {
                data: "po_mstr_nbr",
                name: "po_mstr_nbr"
            },
            {
                data: "po_mstr_vendor",
                name: "po_mstr_vendor"
            },
            {
                data: "po_mstr_date",
                name: "po_mstr_date"
            },
            {
                data: "po_mstr_delivery_date",
                name: "po_mstr_delivery_date",
                className: "text-nowrap text-end"
            },
            {
                data: "po_mstr_arrival_date",
                name: "po_mstr_arrival_date"
            },
            {
                data: "po_mstr_remarks",
                name: "po_mstr_remarks"
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