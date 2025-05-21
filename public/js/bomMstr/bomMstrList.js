$(document).ready(function() {
    
    const allColumns = {
        id: { data: "DT_RowIndex", name: "item_id" },
        item_name_par: { data: "item_name_par", name: "item_name_par", className: "text-left text-nowrap" },
        item_parent_desc: { data: "item_parent_desc", name: "item_parent_desc" },
        item_name_comp: { data: "item_name_comp", name: "item_name_comp" },
        item_comp_desc: { data: "item_comp_desc", name: "item_comp_desc" },
        bom_mstr_qtyper: { data: "bom_mstr_qtyper", name: "bom_mstr_qtyper", className: "text-right text-nowrap text-bold" },
        item_comp_um: { data: "item_comp_um", name: "item_comp_um" },
        action: { data: "action", name: "action" },
    }

    const bomMstrColKey = ["id", "item_name_par", "item_parent_desc", "item_name_comp", "item_comp_desc", "bom_mstr_qtyper", "item_comp_um", "action"];
    const bomMstrCol = bomMstrColKey.map((key) => allColumns[key]);

    let table = initDataTable("#bommstrlistTable", "/BomMstr/json", bomMstrCol);
    
    $('#f_Sfilter, #f_addFilterForm, #f_CFilter').on('click', function() {
        table.draw();
    });
});

// Clear form filter
function clearForm() {
    $("#addFilterForm")[0].reset();
}