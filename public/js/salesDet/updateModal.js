

$(document).on("click", ".editButton", function () {
    // console.log("Button clicked");

    const id = $(this).data("id");
    const date = $(this).data("date");
    const duedate = $(this).data("due_date");
    const item = $(this).data("item");
    const desc = $(this).data("desc");
    const qty = $(this).data("qty");
    const price = $(this).data("price");
    
    const url = $(this).data("url");

    $("#editForm #efid_Date").val(date || "");
    $("#editForm #efid_Due").val(duedate || "");
    $("#editForm #efid_Qty").val(qty || "");
    $("#editForm #efid_Price").val(price || "");
    
    $("#editForm").attr("action", url);
});
