$(document).on("click", ".editButton", function () {
    // console.log("Button clicked");

    const id = $(this).data("id");
    const desc = $(this).data("desc");
    const url = $(this).data("url");

    // console.log("Data attributes:", { id, desc, url });

    $("#efid_Desc").val(desc || "");
    $("#editForm").attr("action", url);
});
