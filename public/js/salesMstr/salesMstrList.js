$(document).ready(function() {
    let table = $("#salesmstrlistTable").DataTable({
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
            url: "/SalesMstr/json",
            data: function(d) {

            },
        },
        columns: [{
                data: "DT_RowIndex",
                orderable: false,
                searchable: false
            },
            {
                data: "sales_mstr_nbr",
                name: "sales_mstr_nbr"
            },
            {
                data: "sales_mstr_bill",
                name: "sales_mstr_bill"
            },
            {
                data: "sales_mstr_ship",
                name: "sales_mstr_ship"
            },
            {
                data: "sales_mstr_date",
                name: "sales_mstr_date"
            },
            {
                data: "sales_mstr_due_date",
                name: "sales_mstr_due_date"
            },
            {
                data: "sales_mstr_total",
                name: "sales_mstr_total"
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