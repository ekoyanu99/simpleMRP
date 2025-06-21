$(document).ready(function() {
    
    const allColumns = {
        id: { data: "DT_RowIndex", name: "item_id" },
        nbr: {data: "odm_mstr_nbr", name: "odm_mstr_nbr", className: "text-left text-nowrap"},
        level : { data: "odm_mstr_level", name: "odm_mstr_level", className: "text-left text-nowrap" },
        item_name_par: { data: "item_name_par", name: "item_name_par", className: "text-left text-nowrap" },
        item_parent_desc: { data: "item_parent_desc", name: "item_parent_desc" },
        item_name_comp: { data: "item_name_comp", name: "item_name_comp" },
        item_comp_desc: { data: "item_comp_desc", name: "item_comp_desc" },
        odm_mstr_req: { data: "odm_mstr_req", name: "odm_mstr_req", className: "text-right text-nowrap text-bold" },
        item_comp_um: { data: "item_comp_um", name: "item_comp_um" },
        action: { data: "action", name: "action" },
        ut: { data: "updated_at", name: "updated_at", className: "text-nowrap text-center" }
    }

    const odmMstrColKey = ["id", "nbr", "level", "item_name_par", "item_parent_desc", "item_name_comp", "item_comp_desc", "odm_mstr_req", "item_comp_um", "ut"];
    const odmMstrCol = odmMstrColKey.map((key) => allColumns[key]);

    let table = initDataTable("#odmmstrlistTable", "/OdmMstr/json", odmMstrCol);
    
    $('#f_Sfilter, #f_addFilterForm, #f_CFilter').on('click', function() {
        table.draw();
    });
});

// Clear form filter
function clearForm() {
    $("#addFilterForm")[0].reset();
}