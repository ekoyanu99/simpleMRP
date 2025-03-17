if(window.jQuery) {
    console.log("jQuery loaded");
} else {
    console.log("jQuery not loaded");
    // reload
    location.reload();
}

$(document).ready(function() {
    // $("#salesDetTable").DataTable({
    //     lengthMenu: [25, 50, 100],
    //     order: [
    //         [1, "asc"]
    //     ],
    //     scrollY: 300,
    //     scroller: true,
    //     // dom: "lrtip",
    // });

    $('#salesDetTable').DataTable({
        "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        "order": [[ 1, "asc" ]],
        "deferRender": true,
        "scrollX": true,
        "scrollY": 375,
    });

});