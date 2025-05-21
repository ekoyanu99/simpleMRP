$(document).ready(function () {

    const allColumns = {
        id: { data: "DT_RowIndex", name: "item_id" },
        item_name: { data: "item_name", name: "item_name" },
        desc: { data: "item_desc", name: "item_desc" },
        pmcode: { data: "item_pmcode", name: "item_pmcode" },
        prod_line: { data: "item_prod_line", name: "item_prod_line" },
        rjrate: { data: "item_rjrate", name: "item_rjrate" },
        uom: { data: "item_uom", name: "item_uom" },
        action: { data: "action", name: "action" },
    }

    const itemColKey = ["id", "item_name", "desc", "pmcode", "prod_line", "rjrate", "uom", "action"];
    const itemCol = itemColKey.map((key) => allColumns[key]);

    let table = initDataTable("#itemmstrlistTable", "/ItemMstr/json", itemCol);

    $('#f_Sfilter, #f_addFilterForm, #f_CFilter').on('click', function () {
        // console.log("Filter button clicked");
        table.draw();
    });
});

// Clear form filter
function clearForm() {
    $("#addFilterForm")[0].reset();
}

function exportReport() {
    console.log("Export Report");
    document.getElementById('exportBtn2').addEventListener('click', function () {

        var f_item_name = $("#f_item_name").val();
        var f_item_desc = $("#f_item_desc").val();
        var f_item_pmcode = $("#f_item_pmcode").val();
        var f_item_prod_line = $("#f_item_prod_line").val();
        var f_item_rjrate = $("#f_item_rjrate").val();
        var f_item_uom = $("#f_item_uom").val();
        var isExactMatch = $("#isExactMatch").val();

        var exportUrl = 'ItemMstrList/export?';
        exportUrl += 'f_item_name=' + f_item_name;
        exportUrl += '&f_item_desc=' + f_item_desc;
        exportUrl += '&f_item_pmcode=' + f_item_pmcode;
        exportUrl += '&f_item_prod_line=' + f_item_prod_line;
        exportUrl += '&f_item_rjrate=' + f_item_rjrate;
        exportUrl += '&f_item_uom=' + f_item_uom;
        exportUrl += '&isExactMatch=' + isExactMatch;

        window.location.href = exportUrl;

    });
}