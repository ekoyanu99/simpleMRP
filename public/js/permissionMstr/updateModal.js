$(document).on("click", ".editButton", function () {

    const id = $(this).data("id");
    const url = $(this).data("url");
    const name = $(this).data("name");

    $("#editForm #modalName").val(name ? name : "");

    $("#editForm").attr("action", url);
});
