function initDataTable(selector, ajaxUrl, columns) {
    if (window.jQuery) {
        console.log("jQuery is loaded");
    } else {
        location.reload();
    }

    return $(selector).DataTable({
        autoWidth: true,
        processing: true,
        serverSide: true,
        deferRender: true,
        pageLength: 25,
        lengthMenu: [10, 25, 50, 100],
        scrollY: 350,
        scrollX: true,
        order: [[0, "desc"]],
        ajax: {
            url: ajaxUrl,
            data: function (d) {
                // item mstr
                d.f_item_name = $("#f_item_name").val();
                d.f_item_desc = $("#f_item_desc").val();
                d.f_item_pmcode = $("#f_item_pmcode").val();
                d.f_item_prod_line = $("#f_item_prod_line").val();
                d.f_item_rjrate = $("#f_item_rjrate").val();
                d.f_item_uom = $("#f_item_uom").val();

                // bom mstr
                d.f_item_parent_name = $("#f_item_parent_name").val();
                d.f_item_parent_desc = $("#f_item_parent_desc").val();
                d.f_item_child_name = $("#f_item_child_name").val();
                d.f_item_child_desc = $("#f_item_child_desc").val();

                // indet
                d.f_in_det_loc = $("#f_in_det_loc").val();

                // sales mstr
                d.f_sales_mstr_nbr = $("#f_sales_mstr_nbr").val();
                d.f_sales_mstr_bill = $("#f_sales_mstr_bill").val();
                d.f_sales_mstr_ship = $("#f_sales_mstr_ship").val();

                // po mstr
                d.f_po_mstr_nbr = $("#f_po_mstr_nbr").val();
                d.f_po_mstr_vdr = $("#f_po_mstr_vdr").val();

                d.isExactMatch = $("#isExactMatch").val();
            },
        },
        columns: columns,
        dom: "lrtip",
    });
}
