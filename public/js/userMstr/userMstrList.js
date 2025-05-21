if (window.jQuery) {
    console.log("jQuery is loaded");
} else {
    location.reload();
}

$(document).ready(function () {

    $("#IdRoles").select2({
        placeholder: "Select Role",
        dropdownParent: $("#modalAddUser"),
        // theme: "material",
        // minimumInputLength: 3,
    });

    let table = $("#UserMstrListTable").DataTable({
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
            url: "UserMstrList/data",
            data: function (d) {
                d.fid_Name = $("#fid_Name").val();
                d.fid_Email = $("#fid_Email").val();
            },
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                title: "No",
                orderable: false,
                searchable: false,
            },
            {
                data: "name",
                name: "name",
            },
            {
                data: "email",
                name: "email",
            },
            {
                data: "role",
                name: "role",
            },
            {
                data: "created_at",
                name: "created_at",
            },
            {
                data: "action",
                name: "action",
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