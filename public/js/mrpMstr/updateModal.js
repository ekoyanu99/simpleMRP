

$(document).on("click", ".editButton", function () {
    // console.log("Button clicked");

    const id = $(this).data("id");
    const date = $(this).data("date");
    const duedate = $(this).data("due_date");

    const url = $(this).data("url");
    
    $("#efid_Due").val(duedate || "");
    $("#editForm").attr("action", url);
});
