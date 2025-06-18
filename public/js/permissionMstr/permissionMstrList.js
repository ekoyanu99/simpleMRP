
if (window.jQuery) {
    console.log("jQuery is loaded");
} else {
    location.reload();
}

$(document).ready(function () {

    let table = $("#PermissionMstrListTable").DataTable({
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100],
        ],
        processing: true,
        serverSide: true,
        deferRender: true,
        pageLength: 25,
        scrollY: 350,
        scrollX: false,
        // scrollCollapse: true,
        lengthMenu: [25, 50, 100],
        order: [[0, "asc"]],
        ajax: {
            url: "PermissionMstrList/data",
            data: function (d) {
                d.fid_Name = $("#fid_Name").val();
            },
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "id",
                orderable: false,
                searchable: false,
                className: "text-nowrap text-end"
            },
            {
                data: "name",
                name: "name",
                className: "text-nowrap text-start"
            },
            {
                data: "updated_at",
                name: "updated_at",
                className: "text-nowrap text-end"
            },
            {
                data: "action",
                name: "action",
                className: "text-nowrap text-center"
            },
        ],
        rowCallback: function (row, data) {
            $(row).find("td").css({
                padding: "4px",
                "font-size": "13px",
                "line-height": "1",
            });
        },
        dom: "lrtip",
    });

    $('#f_Sfilter, #f_addFilterForm, #f_CFilter').on('click', function () {
        table.draw();
    });
});

function clearForm() {
    document.getElementById("addFilterForm").reset();
}

function clearFormm() {
    document.getElementById("addFilterForm").reset();
}