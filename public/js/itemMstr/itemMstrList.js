$(document).ready(function() {
    let table = $("#itemmstrlistTable").DataTable({
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
            url: "/ItemMstr/json",
            data: function(d) {
                d.item_name = $("#f_item_name").val();
                d.item_desc = $("#f_item_desc").val();
                d.item_pmcode = $("#f_item_pmcode").val();
                d.item_prod_line = $("#f_item_prod_line").val();
                d.item_rjrate = $("#f_item_rjrate").val();
                d.item_uom = $("#f_item_uom").val();
            },
        },
        columns: [{
                data: "DT_RowIndex",
                orderable: false,
                searchable: false
            },
            {
                data: "item_name",
                name: "item_name"
            },
            {
                data: "item_desc",
                name: "item_desc"
            },
            {
                data: "item_pmcode",
                name: "item_pmcode"
            },
            {
                data: "item_prod_line",
                name: "item_prod_line"
            },
            {
                data: "item_rjrate",
                name: "item_rjrate"
            },
            {
                data: "item_uom",
                name: "item_uom"
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