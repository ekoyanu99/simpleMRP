$(document).ready(function() {

    const allColumns = {
        id: { data: "DT_RowIndex", name: "sales_mstr_id" },
        nbr: { data: "sales_mstr_nbr", name: "sales_mstr_nbr" },
        bill: { data: "sales_mstr_bill", name: "sales_mstr_bill" },
        ship: { data: "sales_mstr_ship", name: "sales_mstr_ship" },
        date: { data: "sales_mstr_date", name: "sales_mstr_date", className: "text-right text-nowrap" },
        due_date: { data: "sales_mstr_due_date", name: "sales_mstr_due_date" },
        total: { data: "sales_mstr_total", name: "sales_mstr_total" },
        action: { data: "action", name: "action" },
    }

    const salesColKey = ["id", "nbr", "bill", "ship", "date", "due_date", "total", "action"];
    const salesCol = salesColKey.map((key) => allColumns[key]);

    let table = initDataTable("#salesmstrlistTable", "/SalesMstr/json", salesCol);

    $('#f_Sfilter, #f_addFilterForm, #f_CFilter').on('click', function() {
        table.draw();
    });
});

// Clear form filter
function clearForm() {
    $("#addFilterForm")[0].reset();
}