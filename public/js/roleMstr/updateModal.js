$(document).on("click", ".editButton", function () {

    const id = $(this).data("id");
    const url = $(this).data("url");
    const name = $(this).data("name");
    const desc = $(this).data("desc");

    // $("#editForm #id").val(id ? id : "");
    $("#editForm #modalName").val(name ? name : "");
    $("#editForm #modalDesc").val(desc ? desc : "");

    $("#editForm").attr("action", url);
});
