

$(document).on("click", ".editButton", function () {
    // console.log("Button clicked");

    const id = $(this).data("id");
    const item = $(this).data("item");
    const desc = $(this).data("desc");
    const qty = $(this).data("qty");
    const price = $(this).data("price");
    const uuid = $(this).data("uuid");
    
    const url = $(this).data("url");

    $("#editForm #efid_Qty").val(qty || "");
    $("#editForm #efid_Price").val(price || "");
    
    $("#editForm").attr("action", url);
});
