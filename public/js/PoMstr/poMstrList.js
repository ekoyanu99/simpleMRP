$(document).ready(function() {
    
    const allColumns = {
        id: { data: "DT_RowIndex", name: "po_mstr_id" },
        nbr: { data: "po_mstr_nbr", name: "po_mstr_nbr", className: "text-nowrap" },
        vendor: { data: "po_mstr_vendor", name: "po_mstr_vendor", className: "text-nowrap" },
        date: { data: "po_mstr_date", name: "po_mstr_date", className: "text-nowrap" },
        delivery_date: { data: "po_mstr_delivery_date", name: "po_mstr_delivery_date", className: "text-nowrap text-end" },
        arrival_date: { data: "po_mstr_arrival_date", name: "po_mstr_arrival_date", className: "text-nowrap" },
        remarks: { data: "po_mstr_remarks", name: "po_mstr_remarks", className: "text-nowrap" },
        action: { data: "action", name: "action" },
    }

    const poColKey = ["id", "nbr", "vendor", "date", "delivery_date", "arrival_date", "remarks", "action"];
    const poCol = poColKey.map((key) => allColumns[key]);

    let table = initDataTable("#pomstrlistTable", "/PoMstr/json", poCol);

    $('#f_Sfilter, #f_addFilterForm, #f_CFilter').on('click', function() {
        table.draw();
    });
});

// Clear form filter
function clearForm() {
    $("#addFilterForm")[0].reset();
}