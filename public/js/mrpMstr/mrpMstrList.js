$(document).ready(function () {
    let detailRows = [];

    let table = $("#mrpmstrlistTable").DataTable({
        lengthMenu: [25, 50, 100],
        order: [[1, "asc"]],
        deferRender: true,
        scrollY: 300,
        scroller: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "/MrpMstr/json",
            data: function (d) {
            },
        },
        columns: [
            {
                className: 'dt-control',
                orderable: false,
                searchable: false,
                data: null,
                defaultContent: '<i class="bi bi-caret-right-fill"></i>',
                width: "1%"
            },
            {
                data: "DT_RowIndex",
                orderable: false,
                searchable: false
            },
            { data: "mrp_mstr_item" },
            { data: "mrp_mstr_itemdesc" },
            { data: "mrp_mstr_saldo" },
            { data: "mrp_mstr_outstanding" },
            { data: "mrp_mstr_summary" },
            {data: "mrp_mstr_uom"},
        ],
        dom: "lrtip",
        rowId: 'mrp_mstr_id',
    });

    $('#mrpmstrlistTable tbody').on('click', 'td.dt-control', function () {
        let tr = $(this).closest('tr');
        let row = table.row(tr);
        let rowId = row.id();

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
            $(this).find('i').toggleClass('bi-caret-down-fill bi-caret-right-fill');
            detailRows = detailRows.filter(id => id !== rowId);
        } else {
            row.child(format(row.data())).show();
            tr.addClass('shown');
            $(this).find('i').toggleClass('bi-caret-right-fill bi-caret-down-fill');
            if (!detailRows.includes(rowId)) detailRows.push(rowId);
        }
    });


    function format(d) {
        const id = d.mrp_mstr_id;
        console.log(id);
        const divId = `child-${id}`;
        const html = `<div id="${divId}">Loading detail...</div>`;

        $.get(`/MrpMstr/detail/${id}`, function (res) {
            $(`#${divId}`).html(res);
        }).fail(function () {
            $(`#${divId}`).html('<div class="text-danger">Failed to load detail.</div>');
        });

        return html;
    }

    $('#f_Sfilter, #f_addFilterForm, #f_CFilter').on('click', function () {
        table.draw();
    });
});

function clearForm() {
    $("#addFilterForm")[0].reset();
}
