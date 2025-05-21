$(document).ready(function() {

    const allColumns = {
        id: { data: "DT_RowIndex", name: "in_det_item", className: "text-left text-nowrap" },
        item_name: { data: "in_det_item", name: "in_det_item", className: "text-left text-nowrap" },
        item_desc: { data: "in_det_itemdesc", name: "in_det_itemdesc", className: "text-left text-nowrap" },
        loc: { data: "in_det_loc", name: "in_det_loc", className: "text-center text-nowrap" },
        qty: { data: "in_det_qty", name: "in_det_qty", className: "text-right text-nowrap text-bold" },
        uom: { data: "in_det_uom", name: "in_det_uom", className: "text-left text-nowrap" },
        action: { data: "action", name: "action", className: "text-center text-nowrap" },
    }

    const inDetColKey = ["id", "item_name", "item_desc", "loc", "qty", "uom", "action"];
    const inDetCol = inDetColKey.map((key) => allColumns[key]);

    let table = initDataTable("#indetlistTable", "/InDet/json", inDetCol);

    $('#f_Sfilter, #f_addFilterForm, #f_CFilter').on('click', function() {
        table.draw();
    });
});

// Clear form filter
function clearForm() {
    $("#addFilterForm")[0].reset();
}