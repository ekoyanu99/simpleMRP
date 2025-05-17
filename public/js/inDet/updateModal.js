

$(document).on("click", ".editButton", function () {
    // console.log("Button clicked");

    const id = $(this).data("id");
    const item = $(this).data("item");
    const qty = $(this).data("qty");
    const itemDesc = $(this).data("itemdesc");

    const url = $(this).data("url");
    
    $("#efid_Item").val(item || "");
    $("#efid_ItemDesc").val(itemDesc || "");
    $("#efid_Qty").val(qty || "");
    $("#editForm").attr("action", url);
});
