$(document).ready(function() {
    let table = $("#bommstrlistTable").DataTable({
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
            url: "/BomMstr/json",
            data: function(d) {

            },
        },
        columns: [{
                data: "DT_RowIndex",
                orderable: false,
                searchable: false
            },
            {
                data: "item_name_par",
                name: "item_name_par"
            },
            {
                data: "item_parent_desc",
                name: "item_parent_desc"
            },
            {
                data: "item_name_comp",
                name: "item_name_comp"
            },
            {
                data: "item_comp_desc",
                name: "item_comp_desc"
            },
            {
                data: "bom_mstr_qtyper",
                name: "bom_mstr_qtyper"
            },
            {
                data: "item_comp_um",
                name: "item_comp_um"
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